<?PHP
$nav = 'home.php';
$nav2 = 'done.php';
$dir = $DIR_DIAGRAMS;
$src = $SRC_EXAMS;
$src2 = $SRC_QUESTION;
$src3 = $SRC_RESULT;


if (!isset($_REQUEST['exam_id']) && !isset($_SESSION['user']['exam_id'])) {
    $err = 'Error loading exam questions! ';
    $err .= ' Try again or contact administrator.';
    goto_page($nav . '?err=' . $err);
} else {    
    $_SESSION['user']['exam_id'] = $_REQUEST['exam_id'];
    $_SESSION['user']['exam'] = $_REQUEST['exam'];
}

$deed = Main::iniDeed();
#var_dump($deed);

$user = Main::getUser($EXAM_NO);
#var_dump($user);

$exam = Main::getExam($EXAM_ID, $src);
#var_dump($exam);

$len = (int) $exam['faqs'];
$scrollspy = Main::scrollspy($len);
#var_dump($scrollspy);

$quiz = Main::getJSON($src2);
#var_dump($quiz);

$forms = Main::getForms($quiz, $dir);
#var_dump($forms);

$timing = Main::getTiming($exam, $deed);
#var_dump($timing);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = sanitize_request($_POST);

    $data = Main::endDeed($quiz, $post);
    $_SESSION['post'] = $_POST;
    $_SESSION['done'] = array(
        'user' => $user,
        'exam' => $exam,
        'deed' => current($data),
    );

    #var_dump($_POST, $post, $data);
    Main::putJSON($src3, $data);
    goto_page($nav2);
}
