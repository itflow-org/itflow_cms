<?php

function SeoUrl($string){
 	$tempUrl = str_replace('-', ' ', $string);
  $tempUrl = trim(strtolower($tempUrl));
 	$tempUrl = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $tempUrl);
 	$tempUrl = trim($tempUrl, '-');

	return $tempUrl;
}

function sanitizeInput($input) {
    global $mysqli;

    // Remove HTML and PHP tags
    $input = strip_tags($input);

    // Remove white space from beginning and end of input
    $input = trim($input);

    // Escape special characters
    $input = mysqli_real_escape_string($mysqli, $input);

    // Return sanitized input
    return $input;
}

$_SESSION['records_per_page'] = 10;