<?php require_once 'php/inc_top.php';?>

<div class="exam">
  <div class="toolbar">
    <nav>
      <ul>
        <li title="Return" onclick="redirect('home.php')" class="action">
          <i class="fas fa-home"></i>
          <var>Home</var>
        </li>      
        <li title="Candidate Name">
          <i class="fas fa-user-alt"></i>
          <var><?php echo $user['names_f']; ?></var>
        </li>
        <li title="Exam Title">
          <i class="fas fa-graduation-cap"></i>
          <var><?php echo $exam['title']; ?></var>
        </li>
        <li title="Exam No.">
          <i class="fas fa-key"></i>
          <var><?php echo $user['exam_no_f']; ?></var>
        </li>
        <li title="Today's Date">
          <i class="fas fa-calendar-alt"></i>
          <var><?php echo $deed['date_f']; ?></var>
        </li>
        <li title="Start Time">
          <i class="fas fa-clock"></i>
          <var><?php echo $deed['time_in_f']; ?></var>
        </li>
        <li title="Show/Hide" onclick="toggleScrollspy()" class="action">
          <i class="fas fa-eye"></i>
          <var>Scrollspy</var>
        </li>
        <li title="Open Calculator" onclick="bom.calc()" class="action">
          <i class="fas fa-calculator"></i>
          <var>Use Calculator</var>
        </li>
      </ul>
    </nav>

    <section>
      <?php echo $scrollspy; ?>
    </section>
  </div>

  <main>
    <div class="container-md">
      <form <?php echo FORM_ATTRIB; ?>>
        <?php echo $forms; ?>

        <div class="fab">
          <time id="<?php echo $timing; ?>">
            00:00
          </time>

          <input type="hidden" name="exam" value="<?php echo $EXAM; ?>" readonly required /> 
          <input type="hidden" name="exam_id" value="<?php echo $EXAM_ID; ?>" readonly required /> 
          
          <button type="button" onclick="confirmSubmit()">
            <i class="fas fa-paper-plane"></i>
            Submit
          </button>
        </div>

        <div class="action">
          <input type="submit" />
        </div>
      </form>
    </div>
  </main>
</div>

<script type="text/javascript">
  window.onscroll = () => stickyNav();
  // setInterval(examTimer, 1000);
  startTimer();
</script>

<?php require_once 'php/inc_end.php';?>