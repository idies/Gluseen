<?php
/**
 * GitHub webhook handler template.
 * 
 * @author Bonnie Souter, bsouter@jhu.edu.
 */
 
function webhookError( $severity , $message , $file , $line ) {
	
	switch ( $severity ) {
		case (E_USER_ERROR):  // Fatal user-generated run-time error. Errors that can not be recovered from. Execution of the script is halted
			$this_error = " ERROR ";
			break;
		case ( E_USER_WARNING ):  // E_USER_WARNING - Non-fatal user-generated run-time warning. Execution of the script is not halted
			$this_error = " WARNING ";
			break;
		case ( E_USER_NOTICE ):  // Default. User-generated run-time notice. The script found something that might be an error, but could also happen when running a script normally
			$this_error = " NOTICE ";
			break;
		default:
			$this_error = " ERROR [$severity] in file $file on line $line ";
			break;
	}
	$logFile = fopen( "webhook-data/github-webhook-log.txt" , "a") or die(  );
	fwrite( $logFile , $this_error . $message . "\n" );
	fclose( $logFile );
	if ( E_USER_ERROR == $severity ) die();
	
};
set_error_handler( "webhookError" ) ;


// FUNCTIONS
function write_event( $new_info ) {
	$events_fname = 'webhook-data/github-webhook-event.txt';
	$waitIfLocked = true;

	// Write push event info to events file, to be picked up by cron and acted on.
	$eventFile = fopen( $events_fname , "c+") or trigger_error( $log_id . " Could not open $events_fname" );

	flock( $eventFile, LOCK_EX, $waitIfLocked ) or trigger_error( $log_id . " Could not lock $events_fname" );

	$info =  ( $contents = fread( $eventFile, filesize( $events_fname ) ) ) ? json_decode($contents) : array() ;
	$info[] = $new_info;
	
	ftruncate( $eventFile , 0 );
	rewind($eventFile);
	fwrite( $eventFile , json_encode($info) . "\n" ) ;

	fflush($eventFile);            // flush output before releasing the lock
	flock($eventFile, LOCK_UN);    // release the lock
	
	fclose( $eventFile );
	return true;
}


//set secret token, date, event, git id of webhook event.
$hookSecret = 'ypusSt2eQxawYV6Uvk7qty3XNqLtGdB9' ;
//$test_branch = "test_elgg_idies";
//$prod_branch = "prod_elgg_idies";

$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?: 'null-event';
$gitid = $_SERVER['HTTP_X_GITHUB_DELIVERY'] ?: 'null-id';

date_default_timezone_set('America/New_York');
$date = date("Y-m-d H:i:s ");
$time = time();

$log_id = $date . " " . $gitid;

// Check the hash
if ( !empty( $hookSecret ) ) {
	list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
	$rawPost = file_get_contents('php://input');

	if ($hash !== hash_hmac($algo, $rawPost, $hookSecret)) {
		trigger_error( $log_id . " Hash does not match" , E_USER_ERROR );
		die();
	}
}

// Get the json of the payload
switch ($_SERVER['CONTENT_TYPE']) {
	case 'application/json':
		$json = !empty( $rawPost ) ? $rawPost : file_get_contents('php://input');
		break;

	case 'application/x-www-form-urlencoded':
		$json = $_POST['payload'];
		break;

	default:
		 trigger_error( $log_id . " Unsupported content type: " . var_export( $_SERVER[CONTENT_TYPE] , true ) , E_USER_ERROR  );
		exit;
}
$payload = json_decode($json);

// Write the event to the log file
$branch = array_pop( explode('/', $payload->ref ));
$commit = $payload->commits[0]->id ;
$repo =  $payload->repository->name;
trigger_error( $log_id . " Received Event $event for Branch $branch in repository $repo" , E_USER_NOTICE );

$new_info = array( 	'timestamp' => $time ,
					'event' => $event ,
					'branch' =>  $branch , 
					'commit' =>  $commit ,
					'repo' =>  $repo ,
					);
					
if ( 'push' == $event ) write_event( $new_info ) ;

