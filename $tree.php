<?php require_once 'php/inc_top.php';?>
<?php echo Notice::main($error, $errno); ?>

  <main class="">
    <?php echo tree_f($_SESSION); ?>
  </main>

<?php require_once 'php/inc_end.php';?>