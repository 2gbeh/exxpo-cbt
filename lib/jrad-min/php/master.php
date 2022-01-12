<?PHP
# VALIDATION SUB-ROUTINE
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

function selected_option($name, $value)
{
    return $_POST[$name] === $value ? 'selected' : '';
}

function validate_number($args)
{
    $regex = '/\\d+/';
    return preg_match($regex, $args);
}

function validate_name($args)
{
    // contains only uppercase and lowercase letter, and whitespaces
    $regex = '/^[a-zA-Z ]*$/';
    return preg_match($regex, $args);
}

function validate_email($args)
{
    return filter_var($args, FILTER_VALIDATE_EMAIL);
}

function validate_password($args)
{
    // strong password without special chars
    $regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])(?=\\S+$).{8, 25}$/';
    return preg_match($regex, $args);
}

function validate_url($args)
{
    $regex = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';
    return preg_match($regex, $args);
}

# SESSION SUB-ROUTINE
function start_session($key, $value)
{
    session_start();
}

function stop_session()
{
    session_destroy();
}

function end_session()
{
    session_unset();
}

function set_session($key, $value)
{
    $_SESSION[$key] = $value;
}

function get_sessions($key)
{
    return $_SESSION;
}

function get_session($key)
{
    return $_SESSION[$key];
}

function del_session($key)
{
    unset($_SESSION[$key]);
}

# MAIL SUB-ROUTINE
function smtp_text($from, $to, $subject, $body)
{
    $message = wordwrap($body, 70, "\r\n");
    $headers = "From: " . $from . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $compose = mail($to, $subject, $message, $headers);
    return $_SERVER['SERVER_NAME'] == 'localhost' ? true : $compose;
}

function smtp_html($from, $to, $subject, $body)
{
    // $from eg. "Staff Name" <staff@company.com>
    $message = $body;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $from . "\r\n";
    $compose = mail($to, $subject, $message, $headers);
    return $_SERVER['SERVER_NAME'] == 'localhost' ? true : $compose;
}

# FILESYSTEM SUB-ROUTINE
function read_folder($dir)
{
    return glob($dir . '*');
}
function file_crawl($dir = './', &$results = array())
{
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            file_crawl($path, $results);
            $results[] = $path;
        }
    }
    return $results;
}
function file_exist($file_name)
{
    return file_exists($file_name);
}

function file_ext($file_name)
{
    return pathinfo($file_name, PATHINFO_EXTENSION);
}

function upload_file($file_array, $dir, $use_file_name = null)
{
    $ext = '.' . pathinfo($file_array['name'], PATHINFO_EXTENSION);
    $gen_file_name = date('YmdHisu');
    $new_file_name = is_null($use_file_name) ? $gen_file_name . $ext : $use_file_name . $ext;

    $from = $file_array['tmp_name'];
    $to = $dir . $new_file_name;
    return move_uploaded_file($from, $to) ? $new_file_name : false;
}

function replace_file($old_file_name, $file_array, $dir, $use_file_name = null)
{
    delete_file($old_file_name, $dir);

    return upload_file($file_array, $dir, $use_file_name);
}

function rename_file($old_file_name, $new_file_name)
{
    return rename($old_file_name, $new_file_name);
}

function create_file($file_name, $content)
{
    $file_syst = fopen($file_name, 'w+') or die('Unable to open file!');
    $file_size = fwrite($file_syst, $content);
    fclose($file_syst);
    return $file_size;
}

function read_file($file_name)
{
    $file_syst = fopen($file_name, 'r+') or die('Unable to open file!');
    $content = fread($file_syst, filesize($file_name));
    fclose($file_syst);
    return $content;
}

function update_file($file_name, $content)
{
    $file_syst = fopen($file_name, 'a+') or die('Unable to open file!');
    $file_size = fwrite($file_syst, $content);
    fclose($file_syst);
    return $file_size;
}

function delete_file($file_name, $dir)
{
    $target = $dir . $file_name;
/*    if ($_SERVER['SERVER_NAME'] !== 'localhost') {
$ftp_dir = dirname($_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']) . '/';
$target = $ftp_dir . $dir . $file_name;
}*/
    return unlink($target);
}

# XML SUB-ROUTINE
function xml_header($xml_str)
{
    return '<?xml version="1.0" encoding="UTF-8" ?>';
}

function xml_to_object($xml_str)
{
    $xml_obj = json_encode($xml_str);
    return json_decode($xml_obj);
}

function xml_to_array($xml_str)
{
    $xml_obj = json_encode($xml_str);
    return json_decode($xml_obj, true);
}

function convert_to_xml($assoc_array)
{
    $buf = '';
    foreach ($assoc_array as $key => $value) {
        $buf = '<' . $key . '>';
        $buf .= htmlentities($value);
        $buf .= '</' . $key . '>';
        $xm_str .= $buf . '\n';
    }
    return '<node>\n' . $xm_str . '</node>';
}

# JSON SUB-ROUTINE
function json_header()
{
    header('Content-Type:application/json;charset=UTF-8');
}

function json_to_object($json_str)
{
    return json_decode($json_str);
}

function json_to_array($json_str)
{
    return json_decode($json_str, true);
}

function convert_to_json($assoc_array)
{
    return json_encode($assoc_array);
}

# JAVASCRIPT SUB-ROUTINE
function alert($args)
{
    echo '<script type="text/javascript">alert("' . $args . '");</script>';
}

function goto_page($page)
{
    echo '<script type="text/javascript">location.assign("' . $page . '");</script>';
}

function reload_page()
{
    echo '<script type="text/javascript">location.reload();</script>';
}

function print_page()
{
    echo '<script type="text/javascript">window.print();</script>';
}

function is_online()
{
    // website, port  (try 80 or 443)
    $connect = @fsockopen('www.fsockopen.com', 80);
    if ($connect) {
        return fclose($connect);
    } else {
        return false;
    }
}

# MISC SUB-ROUTINE
function page_name($page)
{
    return basename($_SERVER['PHP_SELF']);
}

function go_to($page)
{
    header('location: ' . $page);
    exit();
}

function enum_f($array, $i)
{
    if (array_key_exists($i, $array)) {
        return $array[$i];
    } else if (in_array($i, $array)) {
        return array_search($i, $array);
    } else {
        return $i;
    }

}

function null_f($args, $null = 'N/A')
{
    if (strlen($args) > 0) {
        return $args;
    } else {
        return $null;
    }

}

function money_f($amount)
{
    return number_format((int) $amount);
}

function name_f($names)
{
    return ucwords(strtolower($names));
}

function crop_f($str, $len = 75)
{
    if (strlen($str) > $len) {
        $i = $len - 5;
        $sub = substr($str, 0, $i);
        $buf = '<x title="' . $str . '">' . $sub . '[...]</x>';
        return $buf;
    }
    return $str;
}

function trim_f($date_time)
{
    // 2020-04-21 12:47:00
    $date_time = str_replace(' ', '', $date_time); // 2020-04-2112:47:00
    $date_time = str_replace('-', '', $date_time); // 2020042112:47:00
    $date_time = str_replace(':', '', $date_time); // 20200421124700

    $date_time = str_replace('_', '', $date_time); // delimiters
    $date_time = str_replace(',', '', $date_time);
    $date_time = str_replace('/', '', $date_time);
    return $date_time;
}

function proxy_f($date_time, $id)
{
    return trim_f($date_time) . $id;
}

function proxy_t($date_time, $id)
{
    $trim = trim_f($date_time);
    $date = substr($trim, 0, 8);
    $time = substr($trim, 8);
    $sn = serial_f($id);
    return $date . 'T' . $time . 'I' . $sn;
}

function endate_f($post_date)
{
    $arr = explode('/', $post_date);
    $d = $arr[0] < 10 ? '0' . $arr[0] : $arr[0];
    $m = $arr[1] < 10 ? '0' . $arr[1] : $arr[1];
    $y = $arr[2];
    return $y . '-' . $m . '-' . $d;
}

function undate_f($entry_date)
{
    $arr = explode('-', $entry_date);
    $y = $arr[0];
    $m = $arr[1];
    $d = $arr[2];
    return $d . '/' . $m . '/' . $y;
}

function date_f($date_time, $f = 'd/m/Y')
{
    return date($f, strtotime($date_time));
}

function date_d($date_time)
{
    return date('Y-m-d', strtotime($date_time));
}

function time_d($date_time)
{
    return date('H:i:s', strtotime($date_time));
}

function date_t($date_time)
{
    return date('D, M d, Y', strtotime($date_time));
}

function time_t($date_time)
{
    return date('h:i A', strtotime($date_time));
}

function datetime_t($date_time)
{
    return date('D, M d, Y \a\t H:i A', strtotime($date_time));
}

function now()
{
    return date('Y-m-d H:i:s');
}

function when($date, $days)
{
    $arr = explode('-', $date);
    $from = mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
    $to = strtotime('+' . $days . ' days', $from);
    return date('Y-m-d', $to);
}

function is626()
{
    $hr = (int) date('H');
    return $hr <= 6 || $hr >= 18;
}

function keygen($n = 6)
{
    $buf = '';
    for ($i = 0; $i < $n; $i++) {
        $buf .= mt_rand(1, 9);
    }

    return $buf;
}

function sex_f($gender)
{
    if (strlen($gender) >= 1) {
        return ucfirst($gender);
    } else {
        return 'N/A';
    }
}

function gender_f($sex)
{
    if ($sex == 'm') {
        return 'Male';
    } else if ($sex == 'f') {
        return 'Female';
    } else {
        return 'N/A';
    }
}

function mailto_f($email)
{
    if (strpos($email, '@')) {
        $e = strtolower($email);
        return '<a href="mailto:' . $e . '" target="_new">' . $e . '</a>';
    }
    return $email;
}

function file_f($file, $dir = './')
{
    if (strpos($file, '.')) {
        $f = $dir . $file;
        return '<a href="' . $f . '" target="_new">' . $file . '</a>';
    }
    return $file;
}

function bull_f($password)
{
    $buf = '';
    for ($i = 0; $i < strlen($password); $i++) {
        $buf .= '&bull;';
    }

    return $buf;
}

function mask_f($password)
{
    $buf = '';
    for ($i = 0; $i < strlen($password); $i++) {
        $buf .= '*';
    }

    return $buf;
}

function serial_f($n, $len = 3)
{
    $n_len = strlen($n);
    if ($n_len > $len) {
        return $n;
    } else {
        $diff = $len - $n_len;
        $prefix = '';
        for ($i = 1; $i <= $diff; $i++) {
            $prefix .= '0';
        }
        return $prefix . $n;
    }
}

function caption_f($total)
{
    $index = $total - 1;
    $secs = date('s');
    return 'Showing rows 0 - ' . $index . ' (~' . $total . ' total), query took 0.00' . $secs . ' secs.';
}

function get_ip()
{
    // get IP
    if ($_SERVER['HTTP_CLIENT_IP']) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if ($_SERVER['HTTP_X_FORWARDED']) {
        $ip = $_SERVER['HTTP_X_FORWARDED'];
    } else if ($_SERVER['HTTP_FORWARDED_FOR']) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if ($_SERVER['HTTP_FORWARDED']) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    } else if ($_SERVER['REMOTE_ADDR']) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = $_SERVER['SERVER_ADDR'];
    }

    // validate IP
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
        return $ip;
    } else if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) {
        return $ip;
    } else {
        return $ip;
    }

}

function md5_f($password, $db_password = null)
{ // 32bit Ex. 1234 => 81dc9bdb52d04dc20036dbd8313ed055
    if (isset($db_password)) {
        return md5($password) == $db_password;
    } else {
        return md5($password);
    }
}

function sha1_f($password, $db_password = null)
{ // 40bit Ex. 1234 => 7110eda4d09e062aa5e4a390b0a572ac0d2c0220
    if (isset($db_password)) {
        return sha1($password) == $db_password;
    } else {
        return sha1($password);
    }
}

function hash_f($password, $db_password = null)
{ // 60bit Ex. 1234 => $2y$10$4sUF0GjBTL5nOdUTiRHS2OrUVL2PP9N8o1371EF/ERMeyaF0uG7Uq
    if (isset($db_password)) {
        return password_verify($password, $db_password);
    } else {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

function get_env($var = null)
{
    $fs = fopen('.env', 'r') or die('No such directory');
    $arr = array();
    while (!feof($fs)) {
        $e = fgets($fs);
        $e = trim($e); // remove whitespace
        $e = explode('=', $e); // separate key-value pairs
        $key = current($e);
        $value = end($e);
        $value = substr($value, 1); // remove start quote
        $value = substr($value, 0, -1); // remove end quote

        $arr[$key] = $value;
    }
    fclose($fs);
    return isset($var) ? $arr[$var] : $arr;
}

function lorem($len = 160)
{
    $lorem = 'On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look.
        <br/><br/>
        You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab. Most controls offer a choice of using the look from the current theme or using a format that you specify directly.
        <br/><br/>
        To change the overall look of your document, choose new Theme elements on the Page Layout tab. To change the looks available in the Quick Style gallery, use the Change Current Quick Style Set command. Both the Themes gallery and the Quick Styles gallery provide reset commands so that you can always restore the look of your document to the original contained in your current template.
        <br/><br/>
        On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look.
        <br/><br/>
        You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab. Most controls offer a choice of using the look from the current theme or using a format that you specify directly.';
    return is_numeric($len) ? substr($lorem, 0, $len) : $lorem;
}

function tree_f($args)
{
    $args = (array) $args;
    $css = 'width:1px; white-space:nowrap;';
    $tbody = '';
    foreach ($args as $key => $value) {
        $value = is_array($value) || is_object($value) ? tree_f($value) : $value;
        $tbody .= '<tr>
            <th style="' . $css . '">' . $key . '</th>
            <td>' . $value . '</td>
        </tr>';
    }

    $n = count($args);
    $i = $n - 1;
    $ms = date('s');
    $caption = 'Showing rows 0 - ' . $i . ' (~' . $n . ' total), query took 0000' . $ms . 'secs.';

    $table = '<table border="1" width="100%" cellpadding="3">
        <caption>' . $caption . '</caption>
        <tbody>' . $tbody . '</tbody>
    </table>';
    return $table;
}