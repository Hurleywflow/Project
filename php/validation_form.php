<?php

// load the header content
include_once 'includes/header.php';
include_once 'includes/validation_functions.php';
// store the error messages as key => value in associative array
// Key is the field name, value is the data entered by user for that field
$errors = [];
$fullName = $email = $phone = $dob = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // form submitted - now process the data
    // Process and validate fullName field data
    if (empty($_POST['fullName'])) {
        // validation fullName
        $errors['fullName'] = 'Your name is required!';
    } else {
        $fullName = test_input($_POST['fullName']);
        // check if fullName only contains alphabet and whitespace
        if (!preg_match('/^[a-zA-Z\s]+$$/', $fullName)) {
            $errors['fullName'] = 'Name must be letters and spaces only!';
        }
    }
    // Process and validate email field data
    if (empty($_POST['email'])) {
        // validation email
        $errors['email'] = 'Email is required!';
    } else {
        $email = test_input($_POST['email']);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format!';
        }
    }
    // Process and validate phone field data
    if (empty($_POST['phone'])) {
        // validation phone number
        $errors['phone'] = 'Phone number is required!';
        $phone = test_input($_POST['phone']);
        // check if phone only contains numeric and no whitespace
    } else {
        $phone = test_input($_POST['phone']);
        if (!preg_match('/^\d{10}$$/', $phone)) {
            $errors['phone'] = 'Telephone must be a valid Australia phone number (10 digits)!';
        }
    }
    // Process and validate date of birth field data
    if (empty($_POST['dob'])) {
        // validation date of birth format (dd/mm/yyyy) or (yyyy/mm/dd)
        $errors['dob'] = 'Date of Birth is required!';
    } else {
        $dob = test_input($_POST['dob']);
        // check if date of birth well-format
        if (!validateDOB($dob)) {
            $errors['dob'] = 'Your date of birth must be less than yesterday!';
        }
    }
    // check for any  validation error messages
    // no errors display data table
    // else redisplay the form with the error messages
    if (empty($errors)) {
        // display the data page
        include_once 'includes/display_data.php';
    } else {
        // redisplay the form with error messages
        include_once 'includes/registration_form.php';
    }
} else {
    // load the form content by default
    include_once 'includes/registration_form.php';
}
// end processing checked
// processing data input avoid malicious
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} // end processing data field
// load the footer content
include_once 'includes/footer.php';
