<?php 

	class Event extends ElggObject 
	{
		const SUBTYPE = "event";
		
		protected function initialise_attributes() 
		{
			global $CONFIG;
			parent::initialise_attributes();
			
			$this->attributes["subtype"] = self::SUBTYPE;
		}
		
		public function getURL()
		{
			global $CONFIG;
			
			return EVENT_MANAGER_BASEURL."/event/view/" . $this->getGUID() . "/" . elgg_get_friendly_title($this->title);
		}
		
		public function setAccessToProgramEntities($access_id = null)
		{
			if(!$access_id)
			{
				$access_id = $this->access_id;
			}
			
			$eventDays = $this->getEventDays();
			if($eventDays)
			foreach($eventDays as $day)
			{
				$day->access_id = $access_id;
				$day->save();
				
				$eventSlots = $day->getEventSlots();
				if($eventSlots)
				foreach($eventSlots as $slot)
				{
					$slot->access_id = $access_id;
					$slot->save();
				}
			}
		}
		
		public function hasFiles()
		{
			$files = json_decode($this->files);
			if(count($files) > 0)
			{
				return $files;
			}
			return false;
		}
		
		public function rsvp($type = EVENT_MANAGER_RELATION_UNDO, $user_guid = null)
		{
			global $CONFIG;
			$result = false;
			
			if(empty($user_guid))
			{
				$user_guid = get_loggedin_userid();
			}
			
			if(!empty($user_guid))
			{
				$event_guid = $this->getGUID();
				
				// remove registrations
				if($type == EVENT_MANAGER_RELATION_UNDO)
				{
					if($this->with_program)
					{
						$this->relateToAllSlots(false);
					}
					$this->clearRegistrations();
				}
				
				// remove current relationships
				delete_data("DELETE FROM {$CONFIG->dbprefix}entity_relationships WHERE guid_one=$event_guid AND guid_two=$user_guid");
				
				// remove river events
				if($items = get_river_items($user_guid, $event_guid, "", "", "", "event_relationship", 9999)){
					foreach($items as $item){
						if($item->view == "river/event_relationship/create"){
							remove_from_river_by_id($item->id);
						}
					}
				}
				
				// add the new relationship
				if($type && ($type != EVENT_MANAGER_RELATION_UNDO) && (in_array($type, event_manager_event_get_relationship_options())))
				{
					if($result = $this->addRelationship($user_guid, $type))
					{
						// add river events
						add_to_river('river/event_relationship/create', 'event_relationship', $user_guid, $event_guid);
					}
				}
				else
				{
					$result = true;
				}
				
				if($this->notify_onsignup)
				{
					$this->notifyOnRsvp($type);
				}
			}
			
			return $result;
		}
		
		public function openForRegistration()
		{
			$result = true;
			if($this->registration_ended || ($this->endregistration_day != 0 && $this->endregistration_day < time())){
				$result = false;
			}
			return $result;
		}
		
		public function clearRegistrations($user_guid = null)
		{
			if($user_guid == null)
			{
				$user_guid = get_loggedin_userid();
			}			
			
			if($questions = $this->getRegistrationFormQuestions())
			{
				foreach($questions as $question)
				{
					$question->deleteAnswerFromUser($user_guid);
				}
			}
		}
		
		public function getRegistrationsByUser($count = false, $user_guid = null)
		{
			global $CONFIG;
			if($user_guid == null)
			{
				$user_guid = get_loggedin_userid();
			}
			
			$entities_options = array(
				'type' => 'object',
				'subtype' => 'eventregistration',
				'joins' => array("JOIN {$CONFIG->dbprefix}entity_relationships e_r ON e.guid = e_r.guid_two"),
				'wheres' => array("e_r.guid_one = " . $this->getGUID()),
				'owner_guids' => array($user_guid),
				'count' => $count
			);
			
			return elgg_get_entities($entities_options);
		}
		
		public function getAllRegistrations($filter)
		{
			global $CONFIG;
			
			if($filter == 'waiting')
			{
				$approved = 0;
			}
			else
			{
				$approved = 1;
			}
			
			$entities_options = array(
				'type' => 'object',
				'subtype' => 'eventregistration',
				'full_view' => false,
				'offset' => $offset,
				'joins' => array(	"JOIN {$CONFIG->dbprefix}entity_relationships e_r ON e.guid = e_r.guid_two",

									//Wachtrij check dingetje
									//"JOIN {$CONFIG->dbprefix}metadata n_table on e.guid = n_table.entity_guid",
									//"JOIN {$CONFIG->dbprefix}metastrings msn on n_table.name_id = msn.id",
									//"JOIN {$CONFIG->dbprefix}metastrings msv on n_table.value_id = msv.id"
									),
				'wheres' => array(	"e_r.guid_one = " . $this->getGUID(),
									"e_r.relationship = '" . EVENT_MANAGER_RELATION_USER_REGISTERED . "'",

									//Wachtrij check dingetje
									//"(msn.string IN ('approved'))",
									//"msv.string = $approved"
								)								
			);
			
			$return['entities'] = elgg_get_entities($entities_options);
			
			$entities_options['count'] = true;
			$return['count'] = elgg_get_entities($entities_options);
			
			return $return;
		}
		
		public function getRegistrationQuestions()
		{
			$entities = $this->getEntitiesFromRelationship(EVENT_MANAGER_RELATION_REGISTRATION_QUESTION);
			
			return $entities[0];
		}
		
		public function getRegistrationData($user_guid = null)
		{
			$result = false;
			
			if($user_guid == null)
			{
				$user_guid = get_loggedin_userid();
			}
			
			if($registration_form = $this->getRegistrationFormQuestions())
			{
				$registration_table = '<table>';
				foreach($registration_form as $question)
				{				
					$answer = $question->getAnswerFromUser($user_guid);
					
					$registration_table .= '<tr><td><label>'.$question->title.'</label></td><td>: '.$answer->value.'</td></tr>';
				}
				$registration_table .= '</table>';
			
				$result = elgg_view('page_elements/contentwrapper', array('body' => $registration_table));
			}
			
			return $result;
		}
		
		public function getProgramData($user_guid = null, $participate = false)
		{
			$result = false;
			
			if($user_guid == null)
			{
				$user_guid = get_loggedin_userid();
			}
			
			if($eventDays = $this->getEventDays())
			{
				if(!$participate)
				{
					$currentContext = get_context();
					set_context('programmailview');
					
					$program .= elgg_view('event_manager/program/view', array('entity' => $this));
										
					set_context($currentContext);
					
					$result = elgg_view('page_elements/contentwrapper', array('body' => $program));
				}
				else
				{
					$program .= elgg_view('event_manager/program/edit', array('entity' => $this));	
					
					$result = elgg_view('page_elements/contentwrapper', array('body' => $program));				
				}
			}
			
			return $result;
		}
		
		public function notifyOnRsvp($type, $to = null)
		{
			if($to == null)
			{
				$to = get_loggedin_userid();
			}
			
			if($type == EVENT_MANAGER_RELATION_ATTENDING)
			{
				//if($this->with_program)
				{
						$registrationLink 	= '<br />'.elgg_echo('event_manager:event:registration:notification:program:linktext').'<br /><a href="'.EVENT_MANAGER_BASEURL.'/registration/view/?guid='.$this->getGUID().'&u_g='.$to.'&k='.md5($this->time_created.get_site_secret().$to).'">'.EVENT_MANAGER_BASEURL.'/registration/view/?guid='.$this->getGUID().'&u_g='.$to.'&k='.md5($this->time_created.get_site_secret().$to).'</a>';
				}
			}
			
			//notify_user($to, 
			notify_user($this->owner_guid,
						$this->getGUID(), 
						elgg_echo('event_manager:event:registration:notification:owner:subject'), 
						sprintf(elgg_echo('event_manager:event:registration:notification:owner:text:'.$type), 
								get_entity($this->owner_guid)->name, 
								get_entity($to)->name, 
								$this->getURL(), 
								$this->title).
								$registrationLink
						);
			
			notify_user($to, 
						$this->getGUID(), 
						elgg_echo('event_manager:event:registration:notification:user:subject'),
						sprintf(elgg_echo('event_manager:event:registration:notification:user:text:'.$type), 
								get_entity($to)->name,  
								$this->getURL(), 
								$this->title).
								$registrationLink
						);
		}
		
		public function relateToAllSlots($relate = true, $user = null)
		{
			if($user == null)
			{
				$user = get_loggedin_user();
			}
			
			if($this->getEventDays())
			{
				foreach($this->getEventDays() as $eventDay)
				{
					foreach($eventDay->getEventSlots() as $eventSlot)
					{
						if($relate)
						{
							$user->addRelationship($eventSlot->getGUID(), EVENT_MANAGER_RELATION_SLOT_REGISTRATION);
						}
						else
						{
							$user->removeRelationship($eventSlot->getGUID(), EVENT_MANAGER_RELATION_SLOT_REGISTRATION);
						}
					}
				}
			}
		}
		
		public function getLocation($type = false)
		{
			$location = $this->location;
			if($type)
			{
				$location = str_replace(',', '<br />',$this->location);
			}
			
			return $location;
		}
		
		public function getRelationshipByUser($user_guid = null)
		{
			global $CONFIG;
			
			$user_guid = (int)$user_guid;
			if(empty($user_guid))
			{
				$user_guid = get_loggedin_userid();
			}
			
			$event_guid = $this->getGUID();
			
			$row = get_data_row("SELECT * FROM {$CONFIG->dbprefix}entity_relationships WHERE guid_one=$event_guid AND guid_two=$user_guid");
			return $row->relationship;
		}

		public function getRelationships($count = false)
		{
			global $CONFIG;
			
			$result = false;
			
			$event_guid = $this->getGUID();
			
			if($count){
				$query = "SELECT relationship, count(*) as count FROM {$CONFIG->dbprefix}entity_relationships WHERE guid_one=$event_guid GROUP BY relationship ORDER BY relationship ASC";
			} else {
				$query = "SELECT * FROM {$CONFIG->dbprefix}entity_relationships WHERE guid_one=$event_guid ORDER BY relationship ASC";	
			}
			
			$all_relations = get_data($query);
			
			if(!empty($all_relations)){
				$result = array();
				foreach($all_relations as $row){
					$relationship = $row->relationship;
					
					if($count){
						$result[$relationship] = $row->count;
						$result["total"] += $row->count;	
					} else {
						if(!array_key_exists($relationship, $result)){
							$result[$relationship] = array();
						}
						$result[$relationship][] = $row->guid_two;
					}
				}
			}
			
			return $result;
		}
		
		public function getRegistrationFormQuestions($count = false)
		{
			$result = false;
			
			$entities = event_manager_get_eventregistrationform_fields($this->getGUID(), $count);
			
			if($entities)
			{
				$result = $entities;
			}
			
			return $result;
		}
		
		public function isAttending($user_guid = null)
		{
			$result = false;
			
			if(empty($user_guid))
			{
				$user_guid = get_loggedin_userid();
			} 
			
			$result = check_entity_relationship($this->getGUID(), EVENT_MANAGER_RELATION_ATTENDING, $user_guid);
			
			return $result;			
		}
		
		public function getIcon($size = "medium", $icontime = 0)
		{
			if (!in_array($size, array('small','medium','large','tiny','master','topbar')))
			{
				$size = 'medium';
			}
			
			if ($icontime = $this->icontime)
			{
				$icontime = $icontime;
			}
			else
			{
				$icontime = "default";
			}
			return get_entity_icon_url($this, $size);
		}
		
		public function getEventDays($order = 'ASC')
		{
			global $CONFIG;
			
			$entities_options = array(
				'type' => 'object',
				'subtype' => 'eventday',
				'relationship_guid' => $this->getGUID(),
				'relationship' => 'event_day_relation',
				'inverse_relationship' => true,
				'full_view' => false,
				'joins' => array(
					"JOIN {$CONFIG->dbprefix}metadata n_table on e.guid = n_table.entity_guid",
					"JOIN {$CONFIG->dbprefix}metastrings msn on n_table.name_id = msn.id",
					"JOIN {$CONFIG->dbprefix}metastrings msv on n_table.value_id = msv.id"),
				'wheres' => array("(msn.string IN ('date'))"),
				'order_by' => "msv.string {$order}",
				'limit' => false,
					
			);
		 
			return elgg_get_entities_from_relationship($entities_options);
		}
	
		
		public function isUserRegistered($userid = null, $count = true)
		{
			global $CONFIG;
			if($userid == null)
			{
				$userid = get_loggedin_userid();
			}
			
			$entities_options = array(
				'type' => 'object',
				'subtype' => 'eventregistration',
				'joins' => array("JOIN {$CONFIG->dbprefix}entity_relationships e_r ON e.guid = e_r.guid_two"),
				'wheres' => array("e_r.guid_one = " . $this->getGUID()),
				'count' => $count,
				'owner_guids' => array($userid)
			);
			
			$entityCount = elgg_get_entities_from_relationship($entities_options);
			
			if($count)
			{
				if($entityCount > 0)
				{
					return true;
				}
				return false;
			}
			else
			{
				return $entityCount[0];
			}
		}
		
		public function countAttendees()
		{
			$entities = $this->countEntitiesFromRelationship(EVENT_MANAGER_RELATION_ATTENDING);			
			return $entities;
		}
		
		public function exportAttendees()
		{
			$entities = $this->getEntitiesFromRelationship(EVENT_MANAGER_RELATION_ATTENDING);
			return $entities;
		}
	}

?>