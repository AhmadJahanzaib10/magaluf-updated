<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your actual email
    $to = "jahanzaibahmad200@gmail.com";
    $subject = "New Form Submission - Mario Suardiaz";

    // Clean and assign posted data
    $firstName = htmlspecialchars($_POST['first_name__180'] ?? '');
    $lastName = htmlspecialchars($_POST['last_name__181'] ?? '');
    $email = htmlspecialchars($_POST['email__182'] ?? '');
    $location = htmlspecialchars($_POST['where_do_you_live_185'] ?? '');
    $country = htmlspecialchars($_POST['country_187'] ?? '');
    $emails = isset($_POST['emails']) ? $_POST['emails'] : [];

    // Format selected email preferences
    $emailPrefs = [];
    if (!empty($_POST['newsletter__the_latest_news_from_the_museum_including_exhibitions_and_events_new_videos_and_highlights_from_our_blog_188'])) $emailPrefs[] = "Newsletter";
    if (!empty($_POST['shop__special_offers_and_the_first_news_about_online_shop_products_inspired_by_the_collection_189'])) $emailPrefs[] = "Shop";
    if (!empty($_POST['families__sign_up_for_free_to_our_young_friends_scheme_for_emails_featuring_a_wealth_of_fun_activities_the_digital_remus_magazine_plus_updates_on_family_events_across_the_museum_and_prebooking_for_our_sleepovers_191'])) $emailPrefs[] = "Families";
    if (!empty($_POST['schools__dedicated_emails_for_teachers_featuring_school_sessions_visit_planning_and_classroom_resources_190'])) $emailPrefs[] = "Schools";
    if (!empty($_POST['events__be_among_the_first_to_find_out_about_the_museums_special_events_including_performances_courses_and_online_talks_561'])) $emailPrefs[] = "Events";

    $emailPrefsStr = implode(", ", $emailPrefs);

    // Compose message body
    $message = "
        First Name: $firstName\n
        Last Name: $lastName\n
        Email: $email\n
        Location: $location\n
        Country: $country\n
        Email Preferences: $emailPrefsStr\n
    ";

    // Email headers
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // reCAPTCHA validation (basic check)
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6Le6CnUrAAAAAGjijBDyEv5aUvRMovxLSNmrKd_D";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        if (mail($to, $subject, $message, $headers)) {
            echo "Thank you for signing up!";
        } else {
            echo "Failed to send message. Please try again.";
        }
    } else {
        echo "Captcha failed. Please try again.";
    }
}
?>
