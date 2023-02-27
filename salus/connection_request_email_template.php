<?php
/**
 * Email template for connection request.
 */

$subject = 'Connection Request';
$body = file_get_contents( dirname( __FILE__ ) . '/../email_templates/connection_request_email_template.html' );

// Replace placeholders in the email body with dynamic content.
$body = str_replace( '{profile_url}', $profile_url, $body );
$body = str_replace( '{profile_name}', $profile_name, $body );
$body = str_replace( '{matching_percentage}', $match_percentage, $body );

// Debugging code to check if wp_mail function is being called
error_log('before wp_mail');
// Send the email.
$result = wp_mail( $to, $subject, $body );
error_log('after wp_mail');
error_log(print_r($result, true));
