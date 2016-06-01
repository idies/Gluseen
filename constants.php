<?php
  // Single sign-on portal URL
   if (!defined('ROOT_URL')) define("ROOT_URL","http://scitest09.pha.jhu.edu");
  if (!defined('PORTAL_URL')) define("PORTAL_URL","http://scitest02.pha.jhu.edu/login-portal");
  //define("PORTAL_URL","http://scitest02.pha.jhu.edu/login-portal");
  if (!defined('KEYSTONE_URL')) define("KEYSTONE_URL", "http://scitest09.pha.jhu.edu/keystone");
 if (!defined('KEYSTONE_PROXY'))  define("KEYSTONE_PROXY", "http://scitest09.pha.jhu.edu/keystone");

 //  Service credentials
   if (!defined('SERVICE_NAME')) define("SERVICE_NAME", "gluseen");
 if (!defined('SERVICE_PASSWORD'))  define("SERVICE_PASSWORD", "gluseen");
  if (!defined('SERVICE_PROJECT')) define("SERVICE_PROJECT", "Services");
  if (!defined('API_URL')) define("API_URL","http://scitest02.pha.jhu.edu");
 if (!defined('API_Token')) define("API_Token","6c09c8f8-0fff-45d4-9750-588227ed1a1c");
 if (!defined('DB_URL')) define("DB_URL","http://scitest02.pha.jhu.edu//CasJobs/RestApi/contexts/EarthSciTest_dev/query"); 
?>