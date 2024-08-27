<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form_type value is set
    if (isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];

        // Redirect to the appropriate form based on the selected option
        if ($formType === 'contact_requests') {
            header('Location: portal.php');
            exit;
        } elseif ($formType === 'editing_form') {
            header('Location: editing_form.php');
            exit;
        } else {
            // Invalid form type selected, handle the error
            header('Location: error.php');
            exit;
        }
    } else {
        // Form type value not set, handle the error
        header('Location: error.php');
        exit;
    }
} else {
    // Redirect if the form is not submitted via POST method
    header('Location: error.php');
    exit;
}
?>
