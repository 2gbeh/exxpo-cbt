<?php
require_once 'lib/jrad-min/php/autoload.php';
require_once 'lib/jrad-min/php/session.php';
require_once 'lib/jrad-min/php/master.php';
require_once 'lib/jrad-min/php/widget.php';
include_once 'php/__cfg_urls__.php';
include_once 'php/__cfg_app__.php';
include_once 'php/__glb_class__.php';
include_once 'php/__glb_action__.php';
include_once 'php/' . $page_ctx_action;
// var_dump($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Cache-Control" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- Search Engine Optimization (SEO) -->
  <meta name="author" content="<?php echo $META->author; ?>" />
  <meta name="classification" content="<?php echo $META->classification; ?>" />
  <meta name="copyright" content="<?php echo $META->copyright; ?>" />
  <meta name="coverage" content="<?php echo $META->coverage; ?>" />
  <meta name="description" content="<?php echo $META->description; ?>" />
  <meta name="designer" content="<?php echo $META->designer; ?>" />
  <meta name="keywords" content="<?php echo $META->keywords; ?>"/>
  <meta name="language" content="<?php echo $META->language; ?>" />
  <meta name="owner" content="<?php echo $META->owner; ?>" />
  <meta name="reply-to" content="<?php echo $META->reply_to; ?>" />
  <meta name="revised" content="<?php echo $META->revised; ?>" />
  <meta name="robots" content="<?php echo $META->robots; ?>" />
  <meta name="theme-color" content="<?php echo $META->theme_color; ?>" />
  <meta name="url" content="<?php echo $META->url; ?>" />
  <meta name="viewport" content="<?php echo $META->viewport; ?>" />
  <!-- Open Graph -->
  <meta property="og:site_name" content="<?php echo $META->appname; ?>" />
  <meta property="og:title" content="<?php echo $META->title; ?>" />
  <meta property="og:url" content="<?php echo $META->url; ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="<?php echo $META->description; ?>" />
  <meta property="og:image" content="<?php echo $META->preview; ?>" />
  <meta property="og:determiner" content="auto" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:locale:alternate" content="en_GB" />
  <meta property="og:locale:alternate" content="fr_FR" />
  <!-- Twitter Card -->
  <meta property="twitter:card" content="summary" />
  <meta property="twitter:title" content="<?php echo $META->title; ?>" />
  <meta property="twitter:url" content="<?php echo $META->url; ?>" />
  <meta property="twitter:description" content="<?php echo $META->description; ?>" />
  <meta property="twitter:image" content="<?php echo $META->preview; ?>" />

  <title><?php echo $META->title; ?></title>
  <!-- <link type="image/png" href="img/favicon.png"  sizes="32x32" rel="icon" /> -->
  <!-- FONT-AWESOME -->
  <link type="text/css" href="lib/fa/top.css" rel="stylesheet" />
  <link type="text/css" href="lib/fa/use.css" rel="stylesheet" />
  <link type="text/css" href="lib/fa/end.css" rel="stylesheet" />
  <!-- jrad-min CSS -->
  <link type="text/css" href="lib/jrad-min/css/master.css" rel="stylesheet" />
  <link type="text/css" href="lib/jrad-min/css/widget.css" rel="stylesheet" />
  <!-- LOCAL CSS -->
  <link type="text/css" href="css/template.css" rel="stylesheet" />  
  <link type="text/css" href="css/login.css" rel="stylesheet" />
  <link type="text/css" href="css/home.css" rel="stylesheet" />
  <link type="text/css" href="css/exam.css" rel="stylesheet" />
  <link type="text/css" href="css/done.css" rel="stylesheet" />
  <link type="text/css" href="css/admin.css" rel="stylesheet" />
  <link type="text/css" href="css/theme.css" rel="stylesheet" />
  <link type="text/css" href="css/viewport.css" rel="stylesheet" />
  <!-- jrad-min JS -->
  <script type="text/javascript" src="lib/jrad-min/js/master.js"></script>
  <script type="text/javascript" src="lib/jrad-min/js/widget.js"></script>
  <script type="text/javascript" src="lib/jrad-min/js/bom.js"></script>
  <script type="text/javascript" src="lib/jrad-min/js/ajax.js"></script>
  <!-- LOCAL JS -->
  <script type="text/javascript" src="js/events.js"></script>
</head>
<body>
  <header ID="TOP">
    <a href="?logout=true" title="Exit">
      <h1><?php echo TYPEFACE; ?></h1>      
      <p>
        <i class="fas fa-code-branch"></i> 
	<!--3.1.12.21-->
        <?php echo BUNDLE; ?>
      </p>
    </a>
  </header>