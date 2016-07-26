<?php 

	$event = $vars["entity"];
	
	if($relationships = $event->getRelationships())
	{
		$i = 0;
		
		if($event->canEdit())
		{
			elgg_extend_view('profile/menu/actions', 'event_manager/profile/menu/actions');
		}
		// force correct order
		foreach(event_manager_event_get_relationship_options() as $rel)
		{
			if(array_key_exists($rel, $relationships))
			{
				$members = $relationships[$rel];

				
				$tab_titles .= "<li";
				if($i == 0){
					$tab_titles .= " class='selected'";	
				}
				$tab_titles .= "><a href='javascript:void(0);' rel='" . $event->getGUID() . "_relation_". $rel . "'>" . elgg_echo("event_manager:event:relationship:" . $rel) . " (" . count($members) . ")</a></li>";
				
				$tab_content .= "<div";
				if($i == 0){
					$tab_content .= " style='display:block;'";	
				}
				$tab_content .= " class='event_manager_event_view_attendees' id='" . $event->getGUID() . "_relation_". $rel . "'>"; 
				
				foreach($members as $member)
				{
					$tab_content .= elgg_view("profile/icon", array("entity" => get_entity($member), "size" => "small"));
				}
				
				$tab_content .= "</div>";
				$i++;
			}
		}
		
		if($tab_content)
		{
			$output = "<h3 class='settings'>" . elgg_echo('event_manager:event:attendees') . "</h3>";
			
			$output .= "<div id='event_manager_event_view_attendees'>";
			$output .= "<div id='elgg_horizontal_tabbed_nav'><ul>" . $tab_titles . "</ul></div>";
			$output .= "</div>";
			$output .= $tab_content;
			$output .= "<div class='clearfloat'></div>";
			
			echo $output;
			
			?>
			<script type='text/javascript'>
				$(document).ready(function(){
					$("#event_manager_event_view_attendees a").live("click", function(){
						$(".event_manager_event_view_attendees").hide();
						$("#event_manager_event_view_attendees li").removeClass("selected");
						var selected = $(this).attr("rel");
						$(this).parent().addClass("selected");
						$("#" + selected).show();
					});
				});
			</script>
			<?php
		} 
	}
	
?>