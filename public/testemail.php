<?php 
/**
 * Example 2
 * Validate a single Email via SMTP
 */

// include SMTP Email Validation Class
require_once('lib/smtp_validateEmail.class.php');

// the email to validate
$emails = array('tudt@tintuc.vn');
// an optional sender
$sender = 'tudt@tintuc.vn';
// instantiate the class
$SMTP_Validator = new SMTP_validateEmail();
// turn on debugging if you want to view the SMTP transaction
$SMTP_Validator->debug = true;
// do the validation
$results = $SMTP_Validator->validate($emails, $sender);

// view results
foreach($results as $email=>$result) {
	// send email? 
  if ($result) {
    //mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email
  } else {
    echo 'The email address '. $email.' is not valid';
  }
}
?>