<?php

	global $CONFIG;
					
	$title_text = elgg_echo("event_manager:registration:register:title");
	
	$guid = get_input("guid");
	$relation = get_input("relation");
	
	if(!empty($guid) && ($entity = get_entity($guid)))
	{	
		if($entity->getSubtype() == Event::SUBTYPE)
		{
			$event = $entity;
		
			if($registration_form = $event->getRegistrationFormQuestions())
			{
				$form_body .= elgg_view('input/hidden', array('internalname' => 'event_guid', 'value' => $guid));
				$form_body .= elgg_view('input/hidden', array('internalname' => 'relation', 'value' => $relation));
				
				foreach($registration_form as $question)
				{
					$sessionValue = $_SESSION['registerevent_values']['question_'.$question->getGUID()];					
					$answer = $question->getAnswerFromUser();
					
					$value = (($sessionValue != '')?$sessionValue:$answer->value);
					
					$form_body .= elgg_view('event_manager/registration/question', array('entity' => $question, 'register' => true, 'value' => $value));
				}
			}
			else
			{
				system_message(elgg_echo('event_manager:event:register:no_registrationform'));
				forward($event->getURL());
			}
			
			if($event->with_program)
			{
				$form_body .= $event->getProgramData(get_loggedin_userid(), true);
			}
			
			$form_body .= 	elgg_view('input/button', array('type' => 'button', 'internalid' => 'event_manager_event_register_submit', 'value' => elgg_echo('register')));
			
			$form_body = '<ul>'.$form_body.'</ul>';
			
			$back_text = '<div class="event_manager_back"><a href="'.$event->getURL().'">'.elgg_echo('event_manager:title:backtoevent').'</a></div>';
			
			$title = elgg_view_title($title_text . $back_text);
			
			$form = elgg_view('input/form', array(	'internalid' 	=> 'event_manager_event_register', 
													'internalname' 	=> 'event_manager_event_register', 
													'action' 		=> $vars['url'].'/action/event_manager/event/register', 
													'body' 			=> $form_body));
			
			$page_data = $title . elgg_view('page_elements/contentwrapper', array('body' => $form));
				
			$body = elgg_view_layout("two_column_left_sidebar", "", $page_data);
			
			page_draw($title_text, $body);
			$_SESSION['registerevent_values'] = null;
		}
	}
	else
	{
		system_message(elgg_echo("no guid"));
		forward(REFERER);
	}