<?php
// Load the CAS lib
require_once('CAS.php');

// Parameters of the CAS server
$cas_host = 'cas-uga.grenet.fr';
$cas_context = '';
$cas_port = 443;

// Initialize phpCAS
phpCAS::client(SAML_VERSION_1_1, $cas_host, $cas_port, $cas_context);


// For quick testing you can disable SSL validation of the CAS server.
// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
phpCAS::setNoCasServerValidation();

// Force CAS authentication on any page that includes this file
phpCAS::forceAuthentication();

// Some small code triggered by the logout button
if (isset($_REQUEST['logout'])) {
    phpCAS::logout();
}

// get the user login
$login = $_SESSION["phpCAS"];

// Reform the structure of $_SESSION
$_SESSION["currentUser"]["login"] = $login;

// remove the structure of phpCAS in $_SESSION
unset($_SESSION["phpCAS"]);

/*
array(1) {
  ["phpCAS"]=> array(2) {
    ["user"]=> string(8) "login"
    ["attributes"]=> array(2) {
      ["Name"]=> string(16) "Prenom Nom"
      ["Mail"]=> string(43) "Prenom.Nom@etu.univ-grenoble-alpes.fr"
    }
  }
}
*/

?>
