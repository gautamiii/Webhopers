<?php
/**
 * Plugin Name: Custom Contact Form
 * Description: A simple custom contact form with validation.
 * Version: 1.0
 * Author: Gautam Prasad
 */

if (!defined('ABSPATH')) {
    exit;
}

function ccf_display_form() {
    ob_start();
    ?>

    <form method="post" action="">
        <label for="ccf_name">Name (Required):</label>
        <input type="text" name="ccf_name" required>

        <label for="ccf_email">Email (Required):</label>
        <input type="email" name="ccf_email" required>

        <label for="ccf_phone">Phone (Optional):</label>
        <input type="text" name="ccf_phone">

        <label for="ccf_message">Message (Required):</label>
        <textarea name="ccf_message" required></textarea>

        <input type="submit" name="ccf_submit" value="Send Message">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ccf_submit'])) {
        ccf_handle_form_submission();
    }

    return ob_get_clean();
}
add_shortcode('custom_contact_form', 'ccf_display_form');

function ccf_handle_form_submission() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_contact';

  
    $name = sanitize_text_field($_POST['ccf_name']);
    $email = sanitize_email($_POST['ccf_email']);
    $phone = sanitize_text_field($_POST['ccf_phone']);
    $message = sanitize_textarea_field($_POST['ccf_message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format!</p>";
        return;
    }

    if (!empty($phone) && !preg_match('/^[0-9]+$/', $phone)) {
        echo "<p style='color:red;'>Invalid phone number!</p>";
        return;
    }

    $wpdb->insert(
        $table_name,
        array(
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'message' => $message
        ),
        array('%s', '%s', '%s', '%s') 
    );

    echo "<p style='color:green;'>Message sent successfully!</p>";
}
