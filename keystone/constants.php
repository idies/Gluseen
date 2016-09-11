<?php
  // Single sign-on portal URL
  define("PORTAL_URL","http://scitest02.pha.jhu.edu/login-portal");
  define("KEYSTONE_URL", "http://zinc26.pha.jhu.edu:5000");
  define("KEYSTONE_PROXY", "http://zinc26.pha.jhu.edu:8082/keystone");

  // Service credentials
  define("SERVICE_NAME", "gluseen");
  define("SERVICE_PASSWORD", "gluseen");
  define("SERVICE_PROJECT", "Services");
  // Users DB credentials
  define("DB_CONNECTION","mysql:host=10.55.15.29;dbname=elgg");
  define("DB_LOGIN","keystone_user");
  define("DB_PASSWORD","mongoDB42771");
?>