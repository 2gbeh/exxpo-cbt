<?PHP
# SESSION MANAGER
$landing = $LOGIN_URL?: LOGIN_URL;
$appstate = array($landing, 'test.php');
$basename = basename($_SERVER['PHP_SELF']);

if (!in_array($basename, $appstate) &&
    (
        substr($basename, 0, 1) != '.' &&        
        substr($basename, 0, 1) != '@' &&
        substr($basename, 0, 1) != '$' &&
        substr($basename, 0, 2) != '__' &&
        substr($basename, -5) != '.html'
    )
) {
    if (!isset($_SESSION['user'])) {
        $_SESSION['page'] = $basename;
        echo '<script type="text/javascript">location.assign("'.$landing.'?err=Session expired. Log in required.");</script>';
    } else {
        $_USER = $_SESSION['user'];
    }

}

if (isset($_GET['logout'])) {
    session_destroy();
    echo '<script type="text/javascript">location.assign("'.$landing.'");</script>';
}
