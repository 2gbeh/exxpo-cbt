<?PHP
$nav = 'exam.php';
$src = $SRC_EXAMS;

$rows = Main::getJSON($src);
#var_dump($rows);

$buf = '';
foreach ($rows as $row) {
    $e = (array) $row;

    $slug_f = $e['slug'] ?: $e['title'];
    $icon_f = $e['icon'] ?: 'fas fa-graduation-cap';    
    $nav_f = Main::disableExam($nav, $e);

    $buf .= '<li>
    <div class="h1" title="' . $e['title'] . '">' . $slug_f . '</div>
    <div class="p">
      <i class="' . $icon_f . '"></i>
      <b>' . $e['faqs'] . '</b> multi-choice questions <br/>
      complete within <b>' . $e['timer'] . '</b> minutes
    </div>
    <div class="a">
      <a href="' . $nav_f . '">
        Start Exam
        <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </li>';
}
$tiles = $buf;
