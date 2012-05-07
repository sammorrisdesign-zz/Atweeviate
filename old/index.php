<?php
ini_set('display_errors', 'On');
// Insert your keys/tokens
$consumerKey = 'wdXVYQ73qSUGdg2jiSDtA';
$consumerSecret = 'S8FRnrDEIpld94EAYUKlHagwm4MEQZ9ICytpYVxv2s';
$OAuthToken = '8604152-m8tv8swnhouhz7HY75v7wDBrUspOcEz1bMlBoHFFko';
$OAuthSecret = '4KfiH8TA6QMhOXj7ndA8b9wISxJSmwgsNVncJJGzE';


// Full path to twitterOAuth.php (change OAuth to your own path)
require_once('twitteroauth.php');

// create new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $OAuthToken, $OAuthSecret);
// Your Message
$message = "This is a test message."; 
// Send tweet
$tweet->post('statuses/update', array('status' => "$message"));

?>

WINNER