<?php
/**
 * GitHub webhook handler template.
 * 
 * @see  https://developer.github.com/webhooks/
 * @author  Miloslav Hůla (https://github.com/milo)
 *
 *	Modified by Bonnie Souter, bsouter@jhu.edu.
 */

//set secret token, date, event, git id of webhook event.
$hookSecret = 'ypusSt2eQxawYV6Uvk7qty3XNqLtGdB9' ;
$test_branch = "test_elgg_idies";
$prod_branch = "prod_elgg_idies";

$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?: 'null-event';
$gitid = $_SERVER['HTTP_X_GITHUB_DELIVERY'] ?: 'null-id';
$date = date("Y-m-d H:i:s; ");

$log_id = $date . "Git ID: " . $gitid;

// Append to log file
// The soft link for the webhook-data leads to the directory on dsa010, so this is only written to dsa010.
$logFile = fopen( "webhook-data/github-webhook-log.txt" , "w") or die(  );

// Write the event to the log file
fwrite( $logFile , $log_id . "; Event: $event\n" );

if ( !empty( $hookSecret ) ) {
	list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
	$rawPost = file_get_contents('php://input');

	if ($hash !== hash_hmac($algo, $rawPost, $hookSecret)) {
		fwrite( $logFile , $log_id . "Error: Hash does not match\n" );
		die();
	}
}

switch ($_SERVER['CONTENT_TYPE']) {
	case 'application/json':
		$json = !empty( $rawPost ) ? $rawPost : file_get_contents('php://input');
		break;

	case 'application/x-www-form-urlencoded':
		$json = $_POST['payload'];
		break;

	default:
		fwrite( $logFile , $log_id . "Error: Unsupported content type: " . var_export( $_SERVER[CONTENT_TYPE] , true ) );
		die();
}

# Payload structure depends on triggered event
# https://developer.github.com/v3/activity/events/types/
$payload = json_decode($json);

// Write payload to data file
fwrite( $logFile , "\n" );
fwrite( $logFile , $log_id . var_export( $_SERVER , true ) );
fwrite( $logFile , "\n" );
fwrite( $logFile , $log_id . var_export( $payload , true ) );

$info['event'] =  $event;
$info['branch'] =  $payload->ref;
$info['commit'] =  $payload->commits->id;

$eventFile = fopen( "webhook-data/github-webhook-event.txt" , "w") or fwrite( $logFile , $log_id . "Error: Could not write to event file." );

for ($i=0; $i<5; $i++) {
	if ( flock( $eventFile, LOCK_EX ) ) {  // acquire an exclusive lock
		fwrite($eventFile, json_encode($info));
		fflush($eventFile);            // flush output before releasing the lock
		flock($eventFile, LOCK_UN);    // release the lock
		$success = true;
		break;
	} 
}
if ( empty( $success ) ) mail('bsouter@jhu.edu', 'Webhook failure', "Could not obtain lock to write event: " . json_encode($info));

fclose( $eventFile );

// BRANCH:  'ref'     => 'refs/heads/test_elgg_idies'
// COMMIT:  'after'   => '4ace21db67e2e0b12adbcdf0ecea37b65e11f96a'
// REPO:    'compare' => 'https://github.com/sciserver/GLUSEEN-ELGG/compare/122f20cece67...4ace21db67e2',
// OR 'repository' =>   stdClass::__set_state(array(     'name' => 'GLUSEEN-ELGG',

fclose( $logFile );

// Write event to event file if this is a push event



?>