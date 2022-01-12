<?php
#var_dump($_SESSION);
$nav = 'index.php';
$bio = $NAMES ?: $EXAM_NO;

if (!isset($_SESSION['user']['admin'])) {
    $err = 'Unauthorized page access! ';
    $err .= ' Sign in as administrator to view admin portal.';
    goto_page($nav . '?err=' . $err);
}

