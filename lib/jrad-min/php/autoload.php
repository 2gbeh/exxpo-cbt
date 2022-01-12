<?PHP
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
define('LOGIN_URL', 'index.php');
define('BASE_DIR', $_SERVER['SERVER_NAME'] == 'localhost' ? '' : dirname($_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']) . '/');
define('FORM_ATTRIB', 'action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post" autocomplete="off" enctype="multipart/form-data"');
define('FORM_ATTRIB_GET', 'action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get" autocomplete="off"');
define('COPYRIGHT', 'Copyright &copy; 2017 <a href="https://www.facebook.com/hwplabs" target="_blank" rel="noreferrer" title="Visit Webmaster">HWP Labs.</a> <span>CRBN 658815</span>');