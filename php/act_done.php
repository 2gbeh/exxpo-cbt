<?PHP
$nav = 'index.php';
$dir = $_SESSION['auth'] == true? $DIR_PASSPORTS : 'img/';

if (!isset($_SESSION['done'])) {
    $err = 'Error loading exam scores! ';
    $err .= ' Try again or contact administrator.';
    goto_page($nav . '?err=' . $err);
}

$done = $_SESSION['done'];
#var_dump(Grader::compute(40, 20, 40), $done['deed'], $done);

$passport= $dir . $done['user']['photo_f'];
$names_f = $done['user']['names_f'];
$gender = $done['user']['gender'];
$email_f = $done['user']['email_f'];
$phone = $done['user']['phone'];
$address = $done['user']['address'];

$exam = $done['exam']['title'];
$exam_no_f = $done['user']['exam_no_f'];
$exam_date_f = $done['deed']['date_f'];
$quiz_f = $done['exam']['faqs_f'];
$timer_f = $done['exam']['timer_f'];

$time_in_h = $done['deed']['time_in_h'];
$time_out_h = $done['deed']['time_out_h'];
$score_f = $done['deed']['score_f'];
$score_p = $done['deed']['score_p'];
$grade_w = $done['deed']['grade_w'];
$remarks_w = $done['deed']['remarks_w'];

if ($remarks_w) {
    $hue_w = $done['deed']['hue_w'];
    $remarks_cc = '<b style="color:'.$hue_w.';">'.$remarks_w.'</b>';
}
