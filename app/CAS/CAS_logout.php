<?php
// Load the CAS lib
//	include('CAS.php');

// Parameters of the CAS server
$cas_host = 'cas-uga.grenet.fr';
$cas_context = '';
$cas_port = 443;

// Initialize phpCAS
phpCAS::client(SAML_VERSION_1_1, $cas_host, $cas_port, $cas_context);

// Some small code triggered by the logout button
phpCAS::logout();

?>
