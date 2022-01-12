<?php require_once 'php/inc_top.php';?>
<?php echo Notice::main($error, $errno); ?>

  <main class="login">
    <div class="container-sm">
      <form <?php echo FORM_ATTRIB; ?>>
        <label for="input-1">Candidate Name</label>
        <div class="fieldset">
          <input type="text" id="input-1" name="names" value="<?php echo $_POST['names']; ?>" placeholder="Type your full name" required />
          <i class="fas fa-user-alt"></i>
        </div>

        <label for="input-2">Telephone No.</label>
        <div class="fieldset">
          <input type="tel" id="input-2" name="phone" value="<?php echo $_POST['phone']; ?>" placeholder="Type your phone number" required />
          <i class="fas fa-phone"></i>
        </div>

        <!-- <label for="input-3">Exam No.</label>
        <div class="fieldset">
          <input type="search" id="input-3" name="exam_no" value="<?php echo $_POST['exam_no']; ?>" placeholder="Ex. HWP/APX/311221" required />
          <i class="fas fa-key" title="Ex. HWP/APX/311221"></i>
        </div> -->

        <input type="hidden" name="ID" value="phone" readonly required />
        <button type="submit">Next</button>
      </form>
    </div>
  </main>

<script type="text/javascript">
  const doc = document.querySelector('main form input');
  doc.onkeyup = function () {
    this.value = this.value.toUpperCase()
  };
</script>

<?php require_once 'php/inc_end.php';?>