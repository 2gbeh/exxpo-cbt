<?php require_once 'php/inc_top.php';?>

  <main class="done">
    <div class="container">
      <section>
        <div class="h1">
          <i class="fas fa-check-circle"></i> <br/>
          Submitted!
        </div>
        <div class="p">
          Score and Grade stated in <u>SECTION C</u> below :-
        </div>
      </section>

      <ul>
        <li>
          <table border="0">
            <caption>Passport Photo</caption>
            <tr>
              <td rowspan="5" colspan="2">
                <img src="<?php echo $passport; ?>" class="passport"
                  alt="Attach Passport Photograph (35mm x 45mm)"
                  title="<?php echo null_f($names_f); ?>" />
              </td>
            </tr>
          </table>
        </li>
        <li>
          <table border="0">
            <caption>Section A</caption>
            <tr>
              <th>Full Name</th>
              <td uc><?php echo null_f($names_f); ?></td>
            </tr>
            <tr>
              <th>Gender</th>
              <td><?php echo null_f($gender); ?></td>
            </tr>
            <tr>
              <th>Email Address</th>
              <td><?php echo null_f($email_f); ?></td>
            </tr>
            <tr>
              <th>Telephone No.</th>
              <td><?php echo null_f($phone); ?></td>
            </tr>
            <tr>
              <th>Home Address</th>
              <td><?php echo null_f($address); ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table border="0">
            <caption>Section B</caption>
            <tr>
              <th>Course Title</th>
              <td><?php echo null_f($exam); ?></td>
            </tr>
            <tr>
              <th>Exam No.</th>
              <td uc><?php echo null_f($exam_no_f); ?></td>
            </tr>
            <tr>
              <th>Exam Date</th>
              <td><?php echo null_f($exam_date_f); ?></td>
            </tr>
            <tr>
              <th>Multi-Choice</th>
              <td><?php echo null_f($quiz_f); ?></td>
            </tr>
            <tr>
              <th>Duration</th>
              <td><?php echo null_f($timer_f); ?></td>
            </tr>
          </table>
        </li>
        <li>
          <table border="0">
            <caption>Section C</caption>
            <tr>
              <th>Time Used</th>
              <td>
                <?php echo null_f($time_in_h); ?> to
                <?php echo null_f($time_out_h); ?>
            </td>
            </tr>
            <tr>
              <th>Score</th>
              <td><?php echo null_f($score_f); ?></td>
            </tr>
            <tr>
              <th>Percentage</th>
              <td><?php echo null_f($score_p); ?></td>
            </tr>            
            <tr>
              <th>Grade</th>
              <td uc><?php echo null_f($grade_w); ?></td>
            </tr>
            <tr>
              <th>Remarks</th>
              <td uc><?php echo null_f($remarks_cc); ?></td>
            </tr>
          </table>
        </li>
      </ul>

      <div class="action">
        <button onClick="bom.print()">
          <i class="fas fa-print"></i>
          Print Result
        </button>
      </div>
    </div>
  </main>

<?php require_once 'php/inc_end.php';?>