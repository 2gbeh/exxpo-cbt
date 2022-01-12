<?PHP
Context::set(NULL,'index.php');
Context::set('$','$tree.php');
Context::set('Home','home.php');
Context::set($_GET['exam'] . ' Exam','exam.php');
Context::set('Done','done.php');
Context::set('Admin','admin.php');

//Context::map();
extract(Context::get());
?>
