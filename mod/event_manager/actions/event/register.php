<?php

	$guid = get_input("event_guid");
	$relation = get_input("relation");
	
	$program_guids = get_input('program_guids');
	
	$answers = array();
	foreach($_POST as $key => $value)
	{		
		if(substr($key, 0, 9) == 'question_')
		{
			if(is_array($value))
			{
				$value = $value[0];
			}
			
			$answers[substr($key, 9, strlen($key))] = $value;
		}
	}
	
	
	if(!empty($guid) && !empty($relation) && ($entity = get_entity($guid)))
	{
		if($entity instanceof Event)
		{
			$event = $entity;
			$user = get_loggedin_user();
			
			if($event)
			{
				$questions = $event->getRegistrationFormQuestions();
				foreach($questions as $question)
				{
					if($question->required && empty($answers[$question->getGUID()]))
					{
						$required_error = true;
					}
					
					$_SESSION['registerevent_values']['question_'.$question->getGUID()]	= $answers[$question->getGUID()];
				}
				
				if($event->with_program)
				{
					if(empty($program_guids))
					{
						$required_error = true;
					}
					else
					{	
						$event->relateToAllSlots(false);
						
						$guid_explode = explode(',', $program_guids);
						foreach($guid_explode as $slot_guid)
						{
							if(!empty($slot_guid))
							{
								$user->addRelationship($slot_guid, EVENT_MANAGER_RELATION_SLOT_REGISTRATION);
							}
						}
					}
				}
				
				if($required_error)
				{					
					register_error(elgg_echo("event_manager:action:registration:edit:error_fields"));
					forward(REFERER);
				}
				else
				{
					$_SESSION['registerevent_values'] = null;
				}

				foreach($answers as $question_guid => $answer)
				{
					if(!empty($question_guid) && ($question = get_entity($question_guid)))
					{
						if($question instanceof EventRegistrationQuestion)
						{
							$question->updateAnswerFromUser($event, $answer);
						}
					}
				}
				
				if($rsvp = $event->rsvp($relation))
				{
					system_message(elgg_echo('event_manager:event:relationship:message:'.$relation));
				} 
				else
				{
					register_error(elgg_echo('event_manager:event:relationship:message:error'));
				}
				
				forward($event->getURL());
			}
			else
			{	
				register_error(elgg_echo("event_manager:event_not_found"));
				forward(REFERER);
			}
		}
	}
	else
	{
		system_message(elgg_echo("no guid"));
		forward(REFERER);
	}