<?php 

	$slot = $vars["entity"];
	$participate = $vars["participate"];
	
	if(!empty($slot) && ($slot instanceof EventSlot))
	{
		$result = "<table id='" . $slot->getGUID() . "'>";
	
		$result .= "<tr><td rowspan='2' class='event_manager_program_slot_attending'>";
		
		
		if($user_guid = get_loggedin_userid())
		{
			if(check_entity_relationship($user_guid, EVENT_MANAGER_RELATION_SLOT_REGISTRATION, $slot->getGUID()))
			{
				if(!$participate)
				{
					$registered_for_slot = '<div title="' . elgg_echo("event_manager:event:relationship:event_attending") . '" class="event_manager_program_slot_attending_user"></div>';
				}
				else
				{
					
					$registered_for_slot = elgg_view('input/checkboxes', array('value' => '1', 'internalname' => 'slotguid_'.$slot->getGUID(), 'internalid' => 'slotguid_'.$slot->getGUID(), 'class' => 'event_manager_program_participatetoslot', 'options' => array(''=>'1')));
				}
			}
			else
			{
				if($participate)
				{
					$registered_for_slot = elgg_view('input/checkboxes', array('internalname' => 'slotguid_'.$slot->getGUID(), 'internalid' => 'slotguid_'.$slot->getGUID(), 'class' => 'event_manager_program_participatetoslot', 'options' => array(''=>'1')));
				}
			}
		}	
		
		if($registered_for_slot){
			$result .= $registered_for_slot;
		} else {
			$result .= "&nbsp;";
		}
		
		$start_time = $slot->start_time;
		$end_time = $slot->end_time;
		
		$result .= "</td><td class='event_manager_program_slot_time'>";
		$result .= date('H',$start_time) . ":" . date('i',$start_time) . " - " . date('H',$end_time) . ":" . date('i',$end_time);
		$result .= "</td><td class='event_manager_program_slot_details' rel='" . $slot->getGUID() . "'>";
		$result .= "<span class='event_manager_program_slot_title'>" . $slot->title . "</span>";
		
		if($slot->canEdit() && (get_context() != 'programmailview') && ($participate == false)){
			$edit_slot = "<a href='#' class='event_manager_program_slot_edit' rel='" . $slot->getGUID() . "'>" . elgg_echo("edit") . "</a>";
			$delete_slot = "<a href='#' class='event_manager_program_slot_delete'>" . elgg_echo("delete") . "</a>";
			
			$result .= " [ " . $edit_slot . " | " . $delete_slot . " ]";
		}
		
		$subtitle_data = array();
		if($location = $slot->location){
			$subtitle_data[] = $location;
		}
		if(!empty($slot->max_attendees)){
			$subtitle_data[] = ($slot->max_attendees - $slot->countRegistrations()) . ' ' . strtolower(elgg_echo('event_manager:edit:form:spots_left'));
		}
		if(!empty($subtitle_data)){
			$result .= "<div class='event_manager_program_slot_subtitle'>" . implode(" - ", $subtitle_data) . "</div>";
		}
		
		$result .= "</td></tr>";
		
		$result .= "<tr><td>";
		$result .= "&nbsp;";
		$result .= "</td><td>";
		$result .= "<div class='event_manager_program_slot_description'>" . elgg_view("output/text", array("value" => $slot->description)) . "</div>";
		
		$result .= "</td></tr>";
		
		$result .= "</table>";
		
		echo $result;
	}
	