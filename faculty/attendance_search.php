<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['faculty'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

if(Inputs::submitType()) {
  $course_id = intval(Inputs::assignValue('course_id'));
  $from = date('Y-m-d', strtotime(Inputs::assignValue('from')));
  $to = date('Y-m-d', strtotime(Inputs::assignValue('to')));

  $attendance_list = $fetch_data->searchAttendanceList($course_id, $_SESSION['faculty'], $from, $to);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Attendance Result</title>
  <?php include 'includes/links.php'; ?>
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
            <div class="col-12">
              <div class="jumbotron">
                <h3 class="display-3">Date Range</h3>
                <p class="lead">From: <?php echo $from; ?>&nbsp;&nbsp;&nbsp;  &ndash; &nbsp;&nbsp;&nbsp; to: <?php echo $to; ?></p>
                <hr class="my-2">
              </div>
            </div>
          </div>
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
                          <th>Attendance Status</th>
                          <th>Date</th>
                        </thead>
                        <tbody>
                          <?php foreach($attendance_list AS $new): ?>
                            <tr>
                              <td class="pl-4"><?php echo $new->student; ?></td>
                              <td><?php echo $new->course; ?></td>
                              <td>
                                <?php if($new->attendance_id == 1){ ?>
                                  <button class="btn btn-success btn-sm">Present</button>
                                <?php } else { ?>
                                  <button class="btn btn-danger btn-sm">Absent</button>
                                <?php } ?>
                              </td>
                              <td><?php echo $new->date; ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
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