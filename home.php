<?php require_once 'php/inc_top.php'; ?>
<?php echo Notice::main($error, $errno); ?>
  
  <main class="home">
    <div class="container">
      <ul class="tiles tiles">
        <?php echo $tiles; ?>       
      </ul>
    </div>
  </main>

<?php require_once 'php/inc_end.php'; ?>