<?php 

	$day = $vars["entity"];
	$participate = $vars['participate'];
	
	if(!empty($day) && ($day instanceof EventDay)){

		$details = $day->title;
		if($day->canEdit() && (get_context() != 'programmailview') && ($participate == false))
		{
			$edit_day = "<a href='#' class='event_manager_program_day_edit' rel='" . $day->getGUID() . "'>" . elgg_echo("edit") . "</a>";
			$delete_day = "<a href='#' class='event_manager_program_day_delete'>" . elgg_echo("delete") . "</a>";
			
			$details .= " [ " . $edit_day . " | " . $delete_day . " ]";
		}
		
		if($vars["details_only"]){
			$result = $details;
		} else {
			$result = '<div class="event_manager_program_day"';
			if($vars["selected"]){
				$result .= ' style="display: block;"';
			}
			$result .= ' id="day_' . $day->getGUID() . '">';
			
			$result .= '<div class="event_manager_program_day_details" rel="' . $day->getGUID() . '">';
			
			$result .= $details;
			
			$result .= '</div>';
			
			if($daySlots = $day->getEventSlots()){
				foreach($daySlots as $slot){
					$result .= elgg_view("event_manager/program/elements/slot", array("entity" => $slot, 'participate' => $participate));							
				}
			}
			if($day->canEdit() && (get_context() != 'programmailview') && ($participate == false)){
				$result .= "<a href='#' class='event_manager_program_slot_add' rel='" . $day->getGUID() . "'>" . elgg_echo("event_manager:program:slot:add") . "</a>";
			}
			$result .= '</div>';
		}
		
		echo $result;
	}