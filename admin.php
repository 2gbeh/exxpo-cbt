<?php require_once 'php/inc_top.php';?>
  <div class="admin">
    <nav>
      <ul>
        <li>
          <a href="index.php">
            <i class="fas fa-sign-in-alt"></i>
            Login
          </a>
        </li>
        <li>
          <a href="home.php" target="_blank">
            <i class="fas fa-home"></i>
            Home
          </a>
        </li>
        <li>
          <a href="exam.php" target="_blank">
            <i class="fas fa-graduation-cap"></i>
            Exam
          </a>
        </li>
        <li>
          <a href="done.php" target="_blank">
            <i class="fas fa-check-circle"></i>
            Done
          </a>
        </li>
        <li>
          <a href="admin.php" class="selected">
            <i class="fas fa-user-cog"></i>
            Admin (<?php echo $bio; ?>)
          </a>
        </li>
      </ul>
    </nav>

    <main>
      <div class="container">
        <section>
          <?php echo Main::adminUrls('dir=.exc/docs/AAA/&pfx=DPF/NUT/&bybio'); ?>
        </section>

        <article>
          <?php echo Main::adminViews(); ?>
          <!-- <table border="0">
            <caption><?php echo caption_f(140); ?></caption>
            <tr>
              <th>#</th>
              <th>Candidate</th>
              <th>Sex</th>
              <th>Phone No.</th>
              <th>Exam ID</th>
              <th>Exam No.</th>
              <th>Exam Date</th>
              <th>Score</th>
              <th>Average</th>
              <th>Grade</th>
              <th>Remarks</th>
              <th></th>
            </tr>
            <tr>
              <td>1</td>
              <td>John Doe</td>
              <td>M</td>
              <td>(123)456-7890</td>
              <td>Website Design</td>
              <td>HWP/APX/271221</td>
              <td>Tue, Dec 7, 2021</td>
              <td>48 / 50</td>
              <td>96%</td>
              <td>A</td>
              <td>Passed</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jane Doe</td>
              <td>F</td>
              <td>(123)456-7891</td>
              <td>Website Design</td>
              <td>HWP/APX/381221</td>
              <td>Wed, Dec 8, 2021</td>
              <td>15 / 50</td>
              <td>30%</td>
              <td>D</td>
              <td>Failed</td>
              <td>&nbsp;</td>
            </tr>
          </table> -->
        </article>
      </div>
    </main>
  </div>

<?php require_once 'php/inc_end.php';?>