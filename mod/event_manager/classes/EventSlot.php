<?php 

	class EventSlot extends ElggObject 
	{
		const SUBTYPE = "eventslot";
		
		protected function initialise_attributes() 
		{
			global $CONFIG;
			parent::initialise_attributes();
			
			$this->attributes["subtype"] = self::SUBTYPE;
		}
		
		public function countRegistrations($userid = null)
		{
			return $this->countEntitiesFromRelationship(EVENT_MANAGER_RELATION_SLOT_REGISTRATION, true);
		}		
	}