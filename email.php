<?php

// Get client IP address (honor X-Forwarded-For)
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// Send Email
if (strpos($_SERVER['HTTP_REFERER'], 'gamily.in') !== false || strpos($_SERVER['HTTP_REFERER'], '127.0.0.1') !== false ) {
    $success = mail(
        'shivam.khandelwal@research.iiit.ac.in',
        'Gamily.in Form Response : ' . $_POST['subject'],
        $_POST['message']. '\n\n' . $_POST['email']. '\n\n' . $ip
    );
    if($success) {
        echo 'Thanks for writing to us. We will try to get back asap!';
    }
    else {
        echo 'Error. Please send to shivam.khandelwal@research.iiit.ac.in directly. Sorry. :(';
    }
}

