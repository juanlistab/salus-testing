<?php

/**
 * Sends a connection request email to the user being viewed.
 *
 * @param int $profile_user_id The ID of the user being viewed.
 * @return void
 */
function send_connection_request_email( $profile_user_id ) {
    // Get the IDs of the logged-in user and the profile being viewed.
    $current_user_id = get_current_user_id();

    // Get the email address of the user being viewed.
    $user_email = get_the_author_meta( 'user_email', $profile_user_id );

    // Get the profile name and url.
    $profile_user = get_user_by( 'id', $profile_user_id );
    $profile_name = $profile_user->display_name;
    $profile_url = bp_core_get_user_domain( $profile_user_id );

    // Get the subject and body of the email from the HTML template file.
    $subject = 'Connection Request';
    $body = file_get_contents( dirname( __FILE__ ) . '/email-templates/connection-request-email-template.php' );

    // Replace placeholders in the email body with dynamic content.
    $body = str_replace( '{first_name}', get_user_meta( $profile_user_id, 'first_name', true ), $body );
    $body = str_replace( '{requester_first_name}', bp_core_get_user_displayname( $current_user_id ), $body );
    $body = str_replace( '{requester_profile_url}', bp_core_get_user_domain( $current_user_id ), $body );

    // Send the email.
    $to = $user_email;
    $headers = array( 'Content-Type: text/html; charset=UTF-8' );
    $sent = wp_mail( $to, $subject, $body, $headers );

    // Log the results of the email sending attempt.
    error_log( 'Email sent to ' . $to . ': ' . ( $sent ? 'success' : 'failure' ) );
}
