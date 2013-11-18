<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$question_type = mysql_query("SELECT * FROM hss_tertiary_question_type");
while ($question_types = mysql_fetch_array($question_type)) {
 // myprint_r($question_types);
  if (questionTypeBelongsToOrgTar($question_types['type_id'], $org_code)) {
    ?>
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#sample-accordion" href="#collapse<?php echo $question_types['type_id']; ?>">
        <?php
        echo $question_types['type_name'];
        $question_types_id = $question_types['type_id'];
        ?>
      </a>
      <i class="icon-plus toggle-icon"></i>
    </div>
    <div id="collapse<?php echo $question_types['type_id']; ?>" class="accordion-body collapse">
      <div class="accordion-inner">

        <?php
        $question = mysql_query("SELECT * FROM hss_tertiary_question where question_type_id=$question_types_id order by question_id asc");
        if ($question_types['type_name'] == 'Co-ordination Meeting') {
          echo "Note:<br/>Inter Unit/Inter Department co-ordination meeting with service provider of indoor/Outdoor
/Labroatory/Radiology,etc.<br/>N.B. This is <b>not</b> the monthly field staff meeting.<br/><br/>";
        }
        $i = 0;
        while ($results = mysql_fetch_array($question)) {
          $i++;
          $qid = $results['question_id'];

          echo '<div class="">' . $i . '. ' . $results['question_desc'] . '</div>';
          $answer_qid = $results['question_id'];

          $answers = mysql_query("SELECT * FROM hss_answers_tertiary where answer_q_id=$qid");
          while ($answer = mysql_fetch_assoc($answers)) {
            $answer1 = $answer['answer_ans1'];
            $answer2 = $answer['answer_ans2'];
            $answer3 = $answer['answer_ans3'];
            $answer_id = $answer['answer_id'];
            $q_id = $answer['answer_q_id'];
            ?>

            <?php
            echo '<input type="hidden" name="answer_storage_q' . $q_id . '" value=' . $q_id . '>&nbsp;';
            echo '<input type="radio" name="answer_storage_q' . $q_id . '_answer" value=' . $answer1 . '> ' . $answer1 . '&nbsp;&nbsp;';
            echo '<input type="radio" name="answer_storage_q' . $q_id . '_answer" value=' . $answer2 . '> ' . $answer2 . '&nbsp;&nbsp;';

            if ($answer3) {
              echo '<input type="radio" name="answer_storage_q' . $q_id . '_answer" value=' . $answer3 . '> ' . $answer3;
            } else {
              
            }
            ?>


            <?php
          }
          //echo   '<div>&nbsp;&nbsp;  <a href="evidence.php?question_id='.$qid.'&&org_email='.$user_email.'&&month='.$month.'">Add Photograph</a> | <a href="doc.php?question_id='.$qid.'&&org_email='.$user_email.'&&month='.$month.'">Add Document</a></div><div></div>';
          //echo   '<div></div>';
        }
        ?>

      </div>

    </div>

    <?php
  }
}
?>
