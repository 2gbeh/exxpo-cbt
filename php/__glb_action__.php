<?PHP
$AUTH = $_SESSION['auth'];

$user = $_SESSION['user'];
$NAMES = $user['names'];
$PHONE = $user['phone'];
$EXAM = $_REQUEST['exam']?: $user['exam'];
$EXAM_ID = $_REQUEST['exam_id']?: $user['exam_id'];
$EXAM_NO = $user['exam_no'];

$DIR_DIAGRAMS = 'src/diagrams/';
$DIR_PASSPORTS = 'src/passports/';
$DIR_QUESTIONS = 'src/questions/';
$DIR_RESULTS = 'src/results/';

$SRC_EXAMS = 'src/Exams.json';
$SRC_USERS = 'src/Users.json';
$SRC_QUESTION = $DIR_QUESTIONS . $EXAM_ID . '.json';
$SRC_RESULT = $DIR_RESULTS . $EXAM_ID . '-' . $EXAM_NO . '.json';
