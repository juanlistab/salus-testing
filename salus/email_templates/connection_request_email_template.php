<?php
/**
 * Email template for connection request.
 */

$subject = 'Connection Request';
$body = file_get_contents( dirname( __FILE__ ) . '/email_templates/connection_request_email_template.html' );

// Replace placeholders in the email body with dynamic content.
$body = str_replace( '{first_name}', $first_name, $body );
$body = str_replace( '{requester_profile_url}', $requester_profile_url, $body );
$body = str_replace( '{requester_first_name}', $requester_first_name, $body );
$body = str_replace( '{percentage}', $percentage, $body );

// Set up logging
ini_set( 'log_errors', 1 );
ini_set( 'error_log', '/wp-content/log.log' );

// Send email
if ( wp_mail( $to, $subject, $body ) ) {
    error_log( 'Email sent successfully!' );
} else {
    error_log( 'Email could not be sent.' );
}
