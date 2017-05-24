<?php
# Interface for Mautic PHP API from command line.

#### Command line options parsing ####

# See link below to learn how to specify many types of parameters.
# http://php.net/manual/en/function.getopt.php

$longopts  = array(
    "baseUrl:",
    "userName:",
    "password:",
    "emailName:",
    "emailSubject:",
    "emailHtml:",    
    "emailSegments:"    
);
$opt = getopt('',$longopts);
#var_dump($opt);
#### END of command line argument parsing ####





// Bootup the Composer autoloader
include __DIR__ . '/vendor/autoload.php';  

use Mautic\Auth\ApiAuth;
session_start();

// ApiAuth->newAuth() will accept an array of Auth settings
$settings = array(
    'baseUrl'    => trim($opt['baseUrl'],'/'),        // Base URL of the Mautic instance
    'userName'   => $opt['userName'],       // Username
    'password'   => $opt['password'],       // Password
);


// Initiate the auth object specifying to use BasicAuth
$initAuth = new ApiAuth();
$auth = $initAuth->newAuth($settings, 'BasicAuth');

// Nothing else to do ... It's ready to use.
// Just pass the auth object to the API context you are creating.


use Mautic\MauticApi;

// Create an api context by passing in the desired context (Contacts, Forms, Pages, etc), the $auth object from above
// and the base URL to the Mautic server (i.e. http://my-mautic-server.com/api/)

$api = new MauticApi();
$emailsApi = $api->newApi('emails', $auth, $settings['baseUrl'] . '/api/');

$data = array(
    'subject'     => trim($opt['emailSubject']),
    'name'        => trim($opt['emailName']) . ' (via script)', 
    'customHtml'  => trim($opt['emailHtml']), 
    'lists'       => explode(',',$opt['emailSegments']),     
    'emailType'   => 'list',    
    'isPublished' => 1,
    'language'    => 'pt_BR'
);

$email = $emailsApi->create($data);

# Returns the json_encoded array of created email or errror
print(json_encode($email));
return 0;