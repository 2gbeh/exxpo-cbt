<?PHP
$errno = 400;
$nav = 'admin.php';
$nav_2 = 'home.php';
$src = $SRC_USERS;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = sanitize_request($_POST);
    $auth = isset($post['exam_no']);
    $post['exam_no'] = $post['exam_no'] ?: $post[$_POST['ID']];

    $_SESSION['auth'] = $auth;
    $_SESSION['user'] = $post;
    unset($_SESSION['deed']);
    unset($_SESSION['post']);
    unset($_SESSION['done']);

    #var_dump($_POST, $post);
    if (Main::adminLogin($post)) {
        $_SESSION['user']['admin'] = true;
        goto_page($nav);
    } else if ($auth == true) {
        $row = Main::userLogin($src, $post['exam_no']);
        if (is_array($row)) {
            $_SESSION['user'] = $row;
            goto_page($nav_2);
        } else {
            $error = 'Unauthorized access!';
            $error .= ' Enter a valid exam/candidate number or contact administrator.';
        }
    } else {
        goto_page($nav_2);
    }
}
