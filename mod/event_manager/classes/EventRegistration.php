<?php 

	class EventRegistration extends ElggObject 
	{
		const SUBTYPE = "eventregistration";
		
		protected function initialise_attributes() 
		{
			global $CONFIG;
			parent::initialise_attributes();
			
			$this->attributes["subtype"] = self::SUBTYPE;
		}
		
		public function getURL()
		{
			global $CONFIG;
			
			return EVENT_MANAGER_BASEURL."/registration/view/" . $this->getGUID();
		}
		
		public function getEvent($count = false, $user_guid = null)
		{
			$entities = $this->getEntitiesFromRelationship(EVENT_MANAGER_RELATION_USER_REGISTERED, true);
			
			return $entities[0];
		}
	}

?>