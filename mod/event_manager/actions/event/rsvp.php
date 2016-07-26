<?php 

	$guid = get_input("guid");
	$user_guid = get_input("user", get_loggedin_userid());
	
	if(!empty($guid) && $entity = get_entity($guid))
	{
		if($entity->getSubtype() == Event::SUBTYPE)
		{
			$event = $entity;

			if($event && ($user = get_loggedin_user()) && ($rel = get_input("type")))
			{
				if($rel == EVENT_MANAGER_RELATION_ATTENDING)
				{
					if(!$event->registration_needed)
					{
						$rsvp = $event->rsvp($rel, $user_guid);
						system_message(elgg_echo('event_manager:event:relationship:message:'.$rel));
						forward(REFERER);
					}
					else
					{				
						if(!$event->openForRegistration())
						{
							system_message(elgg_echo('event_manager:event:rsvp:registration_ended'));
							forward(REFERER);
						}
						else
						{
							if($event->max_attendees != '')
							{
								if($attendees = $event->getEntitiesFromRelationship(EVENT_MANAGER_RELATION_ATTENDING))
								{
									if($event->max_attendees > count($attendees))
									{
										forward(EVENT_MANAGER_BASEURL.'/event/register/'.$guid.'/'.$rel);
									}
									else
									{
										system_message(elgg_echo('event_manager:event:rsvp:event_full'));
										forward(REFERER);
									}
								}
							}
							
							forward(EVENT_MANAGER_BASEURL.'/event/register/'.$guid.'/'.$rel);					
						}
					}
				}
				else
				{
					$rsvp = $event->rsvp($rel, $user_guid);
				}
				
				if($rsvp)
				{
					system_message(elgg_echo('event_manager:event:relationship:message:'.$rel));
				} 
				else
				{
					register_error(elgg_echo('event_manager:event:relationship:message:error'));
				}
				
				forward(REFERER);
			} 
			else 
			{
				register_error(elgg_echo('event_manager:event:relationship:message:error'));	
			}
		}
	}
	else
	{
		system_message(elgg_echo("noguid"));
		forward(REFERER);
	}