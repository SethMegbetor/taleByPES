<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);

$courses = $fetch_data->getItemsWithNoComparison('SELECT id, course_name', 'courses');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Evaluate faculty</title>
  <?php include 'includes/links.php'; ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Courses', 'Strongly Disagree', 'Disagree', 'Nuetral', 'Agree', 'Strongly Agree'],
          <?php 
          foreach($courses AS $course) {

            $q1_likert1 = $fetch_data->getEvaluationTotalForAnalysis(1, 1, $course->id);
            $q1_likert2 = $fetch_data->getEvaluationTotalForAnalysis(1, 2, $course->id);
            $q1_likert3 = $fetch_data->getEvaluationTotalForAnalysis(1, 3, $course->id);
            $q1_likert4 = $fetch_data->getEvaluationTotalForAnalysis(1, 4, $course->id);
            $q1_likert5 = $fetch_data->getEvaluationTotalForAnalysis(1, 5, $course->id);

            // questions 2
            $q2_likert1 = $fetch_data->getEvaluationTotalForAnalysis(2, 1, $course->id);
            $q2_likert2 = $fetch_data->getEvaluationTotalForAnalysis(2, 2, $course->id);
            $q2_likert3 = $fetch_data->getEvaluationTotalForAnalysis(2, 3, $course->id);
            $q2_likert4 = $fetch_data->getEvaluationTotalForAnalysis(2, 4, $course->id);
            $q2_likert5 = $fetch_data->getEvaluationTotalForAnalysis(2, 5, $course->id);

            // questions 3
            $q3_likert1 = $fetch_data->getEvaluationTotalForAnalysis(3, 1, $course->id);
            $q3_likert2 = $fetch_data->getEvaluationTotalForAnalysis(3, 2, $course->id);
            $q3_likert3 = $fetch_data->getEvaluationTotalForAnalysis(3, 3, $course->id);
            $q3_likert4 = $fetch_data->getEvaluationTotalForAnalysis(3, 4, $course->id);
            $q3_likert5 = $fetch_data->getEvaluationTotalForAnalysis(3, 5, $course->id);

            // questions 3
            $q4_likert1 = $fetch_data->getEvaluationTotalForAnalysis(4, 1, $course->id);
            $q4_likert2 = $fetch_data->getEvaluationTotalForAnalysis(4, 2, $course->id);
            $q4_likert3 = $fetch_data->getEvaluationTotalForAnalysis(4, 3, $course->id);
            $q4_likert4 = $fetch_data->getEvaluationTotalForAnalysis(4, 4, $course->id);
            $q4_likert5 = $fetch_data->getEvaluationTotalForAnalysis(4, 5, $course->id);

            // questions 3
            $q5_likert1 = $fetch_data->getEvaluationTotalForAnalysis(5, 1, $course->id);
            $q5_likert2 = $fetch_data->getEvaluationTotalForAnalysis(5, 2, $course->id);
            $q5_likert3 = $fetch_data->getEvaluationTotalForAnalysis(5, 3, $course->id);
            $q5_likert4 = $fetch_data->getEvaluationTotalForAnalysis(5, 4, $course->id);
            $q5_likert5 = $fetch_data->getEvaluationTotalForAnalysis(5, 5, $course->id);

           echo " ['". $course->course_name ."', '". $q1_likert1 ."', '". $q1_likert2 ."', '". $q1_likert3 ."', '". $q1_likert4 ."', '". $q1_likert5 ."',], ";
           echo " ['". $course->course_name ."', '". $q2_likert1 ."', '". $q2_likert2 ."', '". $q2_likert3 ."', '". $q2_likert4 ."', '". $q2_likert5 ."',], ";
           echo " ['". $course->course_name ."', '". $q3_likert1 ."', '". $q3_likert2 ."', '". $q3_likert3 ."', '". $q3_likert4 ."', '". $q3_likert5 ."',], ";
           echo " ['". $course->course_name ."', '". $q4_likert1 ."', '". $q4_likert2 ."', '". $q4_likert3 ."', '". $q4_likert4 ."', '". $q4_likert5 ."',], ";
           echo " ['". $course->course_name ."', '". $q5_likert1 ."', '". $q5_likert2 ."', '". $q5_likert3 ."', '". $q5_likert4 ."', '". $q5_likert5 ."',], ";

          }

          ?>
        ]);

        var options = {
          chart: {
            title: 'Evaluation Analytics'
          },
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php include 'includes/top-bar.php'; ?>
      <?php include 'includes/side-bar.php'; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <?php include 'includes/alert.php'; ?>
          <div class="row">
              <div class="col-10">
                <div id="barchart_material" style="width: 1000px; height: 500px;"></div>
              </div>
          </div>
        </section>
      </div>
      <?php include 'includes/footer.php'; ?>
    </div>
  </div>
  <?php include 'includes/scripts.php'; ?>
</body>

</html>