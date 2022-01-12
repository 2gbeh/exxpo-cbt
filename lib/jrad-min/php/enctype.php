<?php
#var_dump($_SERVER);

# STOP WARNING ERRORS
error_reporting(E_ALL ^ E_DEPRECATED);
set_error_handler(function () {});

# STOP CACHE MEMORY
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

# EXTEND VAR_DUMP
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
ini_set('xdebug.var_display_max_depth', -1);

# START SESSION
session_start();

# CONSTANT VARS
define('FORM_ATTRIB', 'action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post" autocomplete="off" enctype="multipart/form-data"');
define('COPYRIGHT', 'Copyright &copy; 2017 <a href="https://hwplabs.com.ng" target="_blank" title="Visit Webmaster">HWP Labs.</a> <span>CRBN 658815</span>');

#
function sanitize_request($post_array)
{
    $new_post_array = array();
    foreach ($post_array as $key => $value) {
        if (!is_array($value) && strtolower($key) != 'id') {
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
            $new_post_array[$key] = $value;
        }
    }
    return $new_post_array;
}

#
$md5 = 'md5';
$sha1 = 'sha1';
$hash = 'hash';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = sanitize_request($_POST);
    $password = $post['password'];

    $md5 = md5($password);
    $sha1 = sha1($password);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // var_dump($post, $md5, $sha1, $hash);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>&#9889; Enctype</title>
    <style type="text/css">
    * {
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
            "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        box-sizing: border-box;
    }
    body {
        padding: 0;
        margin: 0;
        background-color: #eee;
        color: #111;
        font-size: 14px;
        font-size-adjust: 100%/1.4;
    }
    main {
        margin: 100px auto 0;
        order: solid thin red;
        text-align: center;
        width: 90%;
    }
    main a {
        text-decoration: none;
    }
    main a h1 {
        font-size: 52px;
        display: inline-block;
    }
    main form input {
        padding: 0 15px;
        outline: none;
        border-radius: 5px;
        width: 720px;
        text-align: center;
        font-size: 42px;
        letter-spacing: 1px;
    }
    main ul {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }
    main ul li {
        margin: 25px 0;
    }
    main ul li i {
        font-size: 24px;
        font-style: normal;
        cursor: help;
    }
    main ul li kbd {
        margin: 0 0 10px 0;
        white-space: normal;
        display: block;
    }
    main ul li var {
        font-size: 12px;
    }
    footer  {
        padding: 20px 10px;
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
    footer  address {
        text-shadow: 0 2px #fff;
        font-style: normal;
    }
    @media only screen and (max-width: 1024px) {
        main form input {
            width: 100%;
        }
    }
    @media only screen and (max-width: 683px) {
        main {
            margin: 10px auto 0;
        }
        main form input {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <main>
        <a href="?" title="Reset">
            <h1>&#9889;</h1>
        </a>

        <form <?php echo FORM_ATTRIB; ?>>
            <input type="search" name="password"
                value="<?php echo $_POST['password']; ?>"
                _placeholder="Search with Google or enter address"
                _placeholder="Type your password string here.."
                autofocus required />
        </form>

        <ul>
            <li>
                <i title="md5 format">&diams;</i>
                <kbd><?php echo $md5; ?></kbd>
                <var>(<b>32-bit</b> encryption)</var>
            </li>
            <li>
                <i title="sha1 format">&spades;</i>
                <kbd><?php echo $sha1; ?></kbd>
                <var>(<b>40-bit</b> encryption)</var>
            </li>
            <li>
                <i title="hash format">&clubs;</i>
                <kbd><?php echo $hash; ?></kbd>
                <var>(<b>60-bit</b> encryption)</var>
            </li>
        </ul>
    </main>
    <footer>
        <address><?php echo COPYRIGHT; ?></address>
    </footer>
</body>
</html>
