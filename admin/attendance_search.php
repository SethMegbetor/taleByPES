<?php 
require_once dirname(__DIR__).'/Core/init.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);
$database = new Database($connection);

if(Inputs::submitType()) {
  $course_id = intval(Inputs::assignValue('course_id'));
  $from = date('Y-m-d', strtotime(Inputs::assignValue('from')));
  $to = date('Y-m-d', strtotime(Inputs::assignValue('to')));

  $attendance_list = $fetch_data->searchAttendanceListForAdmin($course_id,  $from, $to);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Attendance Result</title>
  <?php include 'includes/links.php'; ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
          <!-- <div class="row">
            <div class="col-md-4 offset-8">
            <form class="pl-0" method="POST">
              <div class="form-group">
                <div class="input-group">
                  <select class="custom-select" name="file_type" id="inputGroupSelect05">
                    <option value="Xlsx">Xlsx</option>
                    <option value="Xls">Xls</option>
                    <option value="Csv">Csv</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-warning" type="submit" name="export"><i class="fa fa-file-excel"></i> Export</button>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div> -->
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Result</h4>
                </div>
                <div class="card-body p-0">
                  <?php if(!empty($attendance_list)){ ?>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <th class="pl-4">Student</th>
                          <th>Course</th>
                          <th>Faculty</th>
                          <th>Attendance Status</th>
                          <th>Date</th>
                        </thead>
                        <tbody>
                          <?php foreach($attendance_list AS $new): ?>
                          <?php 

                            $status = '';
                            if($new->attendance_id == 1){
                              $total_present++;
                              $status = '<button class="btn btn-success btn-sm">Present</button>';
                            }

                            if($new->attendance_id == 2){
                              $total_absent++;
                              $status = '<button class="btn btn-danger btn-sm">Absent</button>';
                            }

                            $total_present = $fetch_data->getTotalSearchedAttendance($new->course_id, 1);
                            $total_absent = $fetch_data->getTotalSearchedAttendance($new->course_id, 2);

                          ?>
                            <tr>
                              <td class="pl-4"><?php echo $new->student; ?></td>
                              <td><?php echo $new->course; ?></td>
                              <td><?php echo $new->faculty; ?></td>
                              <td>
                                <?php echo $status; ?>
                              </td>
                              <td><?php echo $new->date; ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <!-- analytics -->
                    <script type="text/javascript">
                      google.charts.load("current", {packages:["corechart"]});
                      google.charts.setOnLoadCallback(drawChart);
                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Attendance', 'Analytics'],
                          ['Present',     <?php echo $total_present; ?>],
                          ['Absent',      <?php echo $total_absent; ?>]
                        ]);

                        var options = {
                          title: 'Overall Attendance Analytics',
                          is3D: true,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('course_analytics'));
                        chart.draw(data, options);
                      }
                    </script>
                    <div class="row mb-5">
                      <div class="col-12">
                        <div id="course_analytics" style="width: 1000px; height: 400px;"></div>
                      </div>
                    </div>
                  <?php } else{ ?>
                    <h2 class="text-center text-danger">No Data Found!</h2>
                  <?php } ?>
                </div>
              </div>
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