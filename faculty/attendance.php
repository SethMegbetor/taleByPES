<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['faculty'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

//pagination
$pagination = $fetch_data->getFacultyTotalAttendance($_SESSION['faculty']);
$total = $pagination;

$page = (int)$_GET['page'];
$rows = 50;

if($page < 1) {
  $page = 1;
}

$pages = ceil($pagination / $rows);

if(($page > $pages) && ($page > 1)) {
  $page = $pages;
}

$offset = ($page - 1) * $rows;

$attendance = $fetch_data->getFcultyAttendanceTaken($_SESSION['faculty'], $rows, 0);

//getting previous page value
if(($page - 1) >= 1) {
  $prevPage = $page - 1;
} else {
  $prevPage = 1;
}

//getting next page value
if(($page + 1) <= $pages) {
  $nextPage = $page + 1;
} else {
  $nextPage = $pages;
}


$courses = $fetch_data->getItemsWithNoComparison('SELECT id, course_name', 'courses');


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Attendance List</title>
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
          <div class="d-flex bd-highlight mb-1">
            <form action="attendance_search.php" method="POST">
              <div class="p-2 bd-highlight">
                <div class="form-group">
                  <div class="input-group">
                    <select class="custom-select" name="course_id" id="inputGroupSelect05" required>
                      <option selected="">Choose Course</option>
                      <?php foreach($courses AS $course): ?>
                        <option value="<?php echo $course->id; ?>"><?php echo $course->course_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <input type="date" name="from" class="form-control" required>
                    <input type="date" name="to" class="form-control" required>
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="ml-auto p-2 bd-highlight">
              <a href="take_attendance.php" class="btn btn-success"><i class="fa fa-check"> Take Attendance</i></a>
            </div>
          </div>
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Recent Attendance</h4>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <th class="pl-4">Student</th>
                        <th>Course</th>
                        <th>Attendance Status</th>
                        <th>Date</th>
                      </thead>
                      <tbody>
                        <?php foreach($attendance AS $new): ?>
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
                    <nav aria-label="Page navigation example">
                      <ul class="pagination float-right mr-3">
                        <?php if(($page - 1) >= 1): ?>
                          <li class="page-item"><a class="page-link" href="attendance.php?page=<?php echo $prevPage; ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php if(($page + 1) <= $pages): ?>
                          <li class="page-item"><a class="page-link" href="attendance.php?page=<?php echo $nextPage; ?>">Next</a></li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                  </div>
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