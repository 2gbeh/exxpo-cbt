<?PHP
// CONSTANTS
define('APPNAME',   'Exxpo CBT');
define('TYPEFACE',  'Exxpo CBT &trade;');
define('ALIAS', 	'XPO');
define('OWNER', 	'HWP Labs');
define('TITLE',     'On-Demand CBT Application');
define('CAPTION', 	'');
define('SUMMARY', 	'HWP Labs is a Nigerian-based software company specialized in enterprise software development and training. Contact: webmaster@hwplabs.com, (234)81-6996-0927.');
define('KEYWORDS', 	'exxpo,expo,exxpo cbt,expo cbt,exxpo exam,expo exam,software development,enterprise application software,website design and development,mobile app development,computer training,computer programming,hwp labs,emmanuel tugbeh');
define('COPYRIGHT',	'Copyright &copy; 2021 '.OWNER);
define('EMAIL',		'webmaster@hwplabs.com');
define('PHONE',		'(234)81-6996-0927');
define('ADDRESS',	'6, Orikeze Avenue, Agbor-Obi, Delta');
define('THEME',		'#44b78b');
define('CREATED',	'2021-12-01');
define('HOSTED',	'2021-12-06');
define('REVISED',	'2022-11-09');
define('VERSION',	'1');
define('BUNDLE',	'4.9.12.21');

// APACHE
define('SERVER', 	'exxpo');	
define('WEBHOST', 	'id17839796_');
if ($_SERVER['SERVER_NAME'] == 'localhost') 
{	
	define('DATABASE',	'exxpo_db');
	define('USERNAME',	'root');
	define('PASSWORD',	'');
} 
else 
{
    define('DATABASE', 'exxpo_db');
    define('USERNAME', 'exxpo_root');
    define('PASSWORD', '_Strongp@ssw0rd');
}

// ISP
define('SITE',      'index.php');
define('DOMAIN', 	'exxpo.com.ng');
define('CPANEL', 	'https://'.DOMAIN.'/cpanel');
define('WEBMAIL', 	'https://'.DOMAIN.'/webmail');;
define('WEBMAIL_1',	'admin@'.DOMAIN);
define('WEBMAIL_2',	'contact@'.DOMAIN);
define('WEBMAIL_3',	'info@'.DOMAIN);
define('WEBMAIL_4',	'support@'.DOMAIN);
define('WEBMAIL_5',	'ticket@'.DOMAIN);

// META TAGS
$m = array();
$m['appname'] = 	    APPNAME;
$m['author'] =			'HWP Labs';
$m['classification'] = 	'Enterprise Application Software';
$m['copyright'] = 		date('Y');
$m['coverage'] = 		'Nigeria';
$m['description'] = 	SUMMARY;
$m['designer'] = 		'Tugbeh, E.O.';
$m['keywords'] = 		KEYWORDS;
$m['language'] = 		'en';
$m['owner'] = 			OWNER;
$m['reply_to'] = 		WEBMAIL_4;
$m['revised'] = 		REVISED;
$m['robots'] = 			'index,follow';
$m['url'] = 			'https://'.DOMAIN.'/';
$m['preview'] = 		'/img/preview.png';
$m['viewport'] = 		isset($page_ctx_viewport)? '': 'width=device-width, initial-scale=1.0';
$m['title'] = 			! isset($page_ctx_title)? TITLE: '.:: ' . $page_ctx_title.' - '.TYPEFACE;
$META = (object)$m;
?>