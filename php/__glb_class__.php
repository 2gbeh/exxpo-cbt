<?PHP
class Main
{
    public static function getJSON($src, $root = true)
    {
        $data = file_get_contents($src);
        $map = json_decode($data);
        return $root == true ? current($map) : $map;
    }

    public static function putJSON($src, $data)
    {
        $map = json_encode($data);
        return file_put_contents($src, $map);
    }

    public static function userLogin($src, $exam_no)
    {
        $rows = self::getJSON($src);
        foreach ($rows as $row) {
            $e = (array) $row;
            if ($exam_no == $e['exam_no']) {
                return $e;
            }
        }
    }

    public static function disableExam($nav, $exam)
    {
        if ($_SESSION['auth'] == true &&
            $_SESSION['user']['exam_id'] != $exam['exam_id']) {
            return '#';
        }
        return $nav . '?exam_id=' . $exam['exam_id'] . '&exam=' . $exam['title'];
    }

    public static function iniDeed()
    {
        $user = $_SESSION['user'];
        $deed = $_SESSION['deed'];
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $datetime = date('Y-m-d\TH:i:s');

        $arr = array(
            'auth' => $_SESSION['auth'],
            'exam' => $user['exam'],
            'exam_id' => $user['exam_id'],
            'exam_no' => $user['exam_no'],
            'date' => $date,
            'date_f' => date_t($date),
            'time_in' => $time,
            'time_in_h' => date_f($time, 'H:i'),
            'time_in_f' => time_t($time),
            'time_in_i' => strtotime($datetime),
        );
        foreach ($arr as $key => $value) {
            if (!isset($deed[$key])) {
                $_SESSION['deed'][$key] = $value;
            }
        }

        return $_SESSION['deed'];
    }

    public static function endDeed($quiz, $post)
    {
        // get post answers and remove last post (exam_id)
        $post_values = array_values($post);
        $exam_id = array_pop($post_values);
        $exam = array_pop($post_values);

        // get attempts (ansed) and scores
        $n = count($quiz);
        $ansed = $score = 0;
        for ($i = 0; $i < count($quiz); $i++) {
            $q = (array) $quiz[$i];
            $q_ans = strtolower($q['answer']);
            $p_ans = strtolower($post_values[$i]);

            if (strlen($p_ans) > 0) {
                $ansed++;
                if ($p_ans == $q_ans) {
                    $score++;
                }
            }
        }

        // grade and update deed
        $time = date('H:i:s');
        $arr = array(
            'postback' => self::isPostback(),
            'exam' => $exam,
            'exam_id' => $exam_id,
            'time_out' => $time,
            'time_out_h' => date_f($time, 'H:i'),
            'time_out_f' => time_t($time),
        );
        foreach ($arr as $key => $value) {
            $_SESSION['deed'][$key] = $value;
        }

        $arr = Grader::compute($n, $score, $ansed);
        foreach ($arr as $key => $value) {
            $_SESSION['deed'][$key] = $value;
        }

        $data = $_SESSION['deed'];
        return array('root' => $data);
    }

    public static function setDeedEvil($quiz, $post)
    {
        // exam snapshot
    }

    public static function getUser()
    {
        $user = $_SESSION['user'];

        if (!$user['photo'] && $user['sex'] == 'm') {
            $photo_f = 'avatar_m.png';
        } else if ((!$user['photo'] && $user['sex'] == 'f')) {
            $photo_f = 'avatar_f.png';
        } else {
            $photo_f = 'default.png';
        }

        $user['photo_f'] = $photo_f;
        $user['names_f'] = ucwords($user['names']);
        $user['gender'] = gender_f($user['sex']);
        $user['email_f'] = mailto_f($user['email']) ?: 'N/A';
        $user['exam_no_f'] = strtoupper($user['exam_no']);
        return $user;
    }

    public static function getExam($exam_id, $src)
    {
        $rows = self::getJSON($src);
        foreach ($rows as $row) {
            $e = (array) $row;
            if ($exam_id == $e['exam_id']) {
                $e['slug_f'] = $e['slug'] ?: $e['title'];
                $e['exam_date_f'] = date_t($e['exam_date']);
                $e['exam_time_f'] = time_t($e['exam_time']);
                $e['faqs_f'] = $e['faqs'] . ' questions';
                $e['timer_f'] = $e['timer'] . ' minutes';
                $e['timer_i'] = ((int) $e['timer'] * 2) + 60;
                $e['icon_f'] = $e['icon'] ?: 'fas fa-graduation-cap';
                return $e;
            }
        }
    }

    public static function isPostback()
    {
        $user = $_SESSION['user'];
        $post = $_SESSION['post'];
        return $user['exam_id'] == $post['exam_id'];
    }

    public static function scrollspy($len)
    {
        $post = $_SESSION['post'];
        $buf = '<li><a href="#TOP">top</a></li>';
        for ($n = 1; $n <= $len; $n++) {
            $name = 'q' . $n;

            // smart scrollspy
            if ($n == 1) {
                $href = '#';
            } else if ($n >= 2 && $n <= $len) {
                $href = '#goto_q' . ($n - 1);
            } else {
                $href = '#goto_q' . $n;
            }

            // aware scrollspy
            if (self::isPostback() && strlen($post[$name]) > 0) {
                $buf .= '<li>
                    <a href="' . $href . '" title="Answered" class="ans">
                        ' . $name . '
                    </a>
                </li>';
            } else {
                $buf .= '<li>
                <a href="' . $href . '" title="Unanswered">
                    ' . $name . '
                </a>
            </li>';
            }

        }
        $buf .= '<li><a href="#END">end</a></li>';
        return '<ul>' . $buf . '</ul>';
    }

    public static function getForms($quiz, $dir)
    {
        $n = 1;
        $buf = '';
        foreach ($quiz as $row) {
            $e = (array) $row;

            $for = 'goto_q' . $n;
            $txt = 'Q' . $n . '. ' . $e['question'];
            $img = $e['figure'];
            $img_src = $dir . $img;
            $figure = '<figure>
                <img src="' . $img_src . '" alt="' . $img . '" title="' . $img . '"/>
            </figure>';
            $figure_f = is_null($img) ? '' : $figure;
            $radios = self::getRadios($e['options'], $n);

            $buf .= '<div class="form-group">
                <label id="' . $for . '">' . $txt . '</label>
                ' . $figure_f . '
                <div class="radio-group">
                    ' . $radios . '
                </div>
            </div>';
            $n++;
        }
        return $buf;
    }

    public static function getRadios($options, $n)
    {
        $post = $_SESSION['post'];
        $alphas = range('a', 'j');
        $name = 'q' . $n;
        $buf = '<input type="hidden" name="' . $name . '" value="" checked />';
        for ($i = 0; $i < count($options); $i++) {
            $alpha = $alphas[$i];
            $value = strtolower($alpha);
            $for = $name . '_' . $value;
            $text = $options[$i];
            $text_f = ucfirst($alpha) . '. ' . $text;

            // retain checked option until subject swap or logout
            $checked = self::isPostback() && $post[$name] == $alpha ? 'checked' : '';

            $buf .= '<input type="radio" name="' . $name . '"
                        value="' . $value . '" id="' . $for . '"
                        onclick="selectScrollspy(this.name)" ' . $checked . ' />
            <label for="' . $for . '">' . $text_f . '</label> <br/>';
        }
        return $buf;
    }

    public static function getTiming($exam, $deed)
    {
        $then = $exam['timer_i'];
        $now = $deed['time_in_i'];
        $when = strtotime('+' . $then . ' minutes', $now);
        return date('Y-m-d\TH:i:s', $when);
    }

    public static function adminLogin($post)
    {
        return in_array('WEBMASTER', $post);
    }

    public static function adminUrls($req = '')
    {
        // dir=.exc/docs/AAA/&pfx=DPF/NUT/&by=bio
        $pg = $_GET['pg'];
        $arr = array('Results', 'Users', 'Exams');
        $fas = array('fas fa-tasks', 'fas fa-users', 'fas fa-graduation-cap');
        $buf = '<ul>';
        for ($i = 0; $i < count($arr); $i++) {
            $href = '?pg=' . $i;
            if ($i == 0 && strlen($req) > 0) {
                $href .= '&' . $req;
            }
            $class = $pg == $i ? 'focus' : '';
            $txt = $arr[$i];
            $buf .= '<li>
                <a href="' . $href . '" class="' . $class . '">
                    <i class="'.$fas[$i].'"></i> &nbsp;
                    ' . $txt . '
                </a>
            </li>';
        }
        $buf .= '</ul>';
        return $buf;
    }

    public static function adminViews()
    {
        $pg = $_GET['pg'];
        $data = array();
        switch ($pg) {
            case 1:
                $src = $GLOBALS['SRC_USERS'];
                $data = self::getJSON($src);
                break;
            case 2:
                $src = $GLOBALS['SRC_EXAMS'];
                $data = self::getJSON($src);
                break;
            default:
                $dir = $_GET['dir'] ?: $GLOBALS['DIR_RESULTS'];
                $by = $_GET['by'] ?: '*';
                $data = self::adminFilterResult($dir, $by);
        }
        return self::adminViewsTabulate($data);
    }

    public static function adminFilterResult($dir, $k = '*')
    {
        $src = $GLOBALS['SRC_EXAMS'];
        $dirs = glob($dir . '*');
        $datas = array();
        foreach ($dirs as $src2) {
            $data = self::getJSON($src2);
            $e = (array) $data;

            $date = $e['date'];
            $date_f = date_t($date);

            $exam_id = $e['exam_id'];
            $exam_id_esc = str_replace('_', '-', $exam_id);
            $exam_id_pfx = $_GET['pfx'] ?: '';
            $exam_id_f = $exam_id_pfx . $exam_id_esc;

            $exam = self::getExam($exam_id, $src);
            $exam_f = strtoupper($exam['title']);

            $exam_no = $e['exam_no'];
            $exam_no_f = strtoupper($exam_no);
            if (substr($exam_no, 0, 1) == '0' and strlen($exam_no) == 11) {
                $exam_no_f = substr($exam_no, 0, 4);
                $exam_no_f .= '-' . substr($exam_no, 4, 3);
                $exam_no_f .= '-' . substr($exam_no, -4);
            }

            $gpax = explode(' / ', $e['score_f']);
            $xps = (int) $gpax[0];
            $n = (int) $gpax[1];
            $perc = round(($xps * 100) / $n);
            $perc_f = $perc . '%';

            $data_f = array(
                'date' => $date,
                'exam' => $exam_f,
                'exam_id' => $exam_id_f,
                'exam_no' => $exam_no_f,
                'faqs' => $n,
                'score_f' => $xps,
                'score_p' => $perc_f,
            );

            $datas[$exam_id][] = $data_f;
        }

        if ($k != '*') {
            return $datas[$k];
        } else {
            $arr = array();
            foreach ($datas as $assoc) {
                foreach ($assoc as $value) {
                    array_push($arr, $value);
                }
            }
            return $arr;
        }
    }

    public static function adminViewsTabulate($data)
    {
        $n = count($data);
        $sn = 1;
        $tr = '';
        foreach ($data as $assoc) {
            $row = (array) $assoc;
            // thead
            if ($sn == 1) {
                $th = '<th>#</th>';
                foreach (array_keys($row) as $value) {
                    $th .= '<th>' . $value . '</th>';
                }
                #$th .= '<th>&nbsp;</th>';
                $tr .= '<tr>' . $th . '</tr>';
            }
            // tbody
            $td = '<td>' . $sn . '</td>';
            foreach ($row as $key => $value) {
                $value = $key == 'names' ? strtoupper($value) : $value;
                $value = $key == 'sex' ? ucfirst($value) : $value;
                $value = $key == 'email' ? mailto_f($value) : $value;
                $value = $key == 'exam_id' ? strtoupper($value) : $value;
                $value = $key == 'exam_no' ? strtoupper($value) : $value;
                $td .= '<td>' . null_f($value) . '</td>';
            }
            #$td .= '<td>&nbsp;</td>';
            $tr .= '<tr>' . $td . '</tr>';
            $sn++;
        }
        // table
        $table = '<table border="0">
            <caption>' . caption_f($n) . '</caption>
            ' . $tr . '
        </table>';
        return $table;
    }
}
