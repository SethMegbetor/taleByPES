<?php 
require_once dirname(__DIR__).'/Core/init.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;


if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

//pagination
$pagination = $fetch_data->getTotal('student_attendance');
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

$attendance = $fetch_data->getAllAttendanceTakenForAdmin($rows, $offset);

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

$attendance_list = $fetch_data->getAllAttendanceTakenForAdmin(100000, 0);


//check if export button has been clicked
if(isset($_POST["export"])) {
  
  //create an instance of the spreasheet class
  $file = new Spreadsheet();

  //get table header
  $active_sheet = $file->getActiveSheet();

  //set table header
  $active_sheet->setCellValue('A1', 'Student Name');
  $active_sheet->setCellValue('B1', 'Course');
  $active_sheet->setCellValue('C1', 'Faculty');
  $active_sheet->setCellValue('D1', 'Attendance Status');
  $active_sheet->setCellValue('E1', 'Date');

  //roll number
  $count = 2;

  //print values
  foreach($attendance_list AS $row) {
    $active_sheet->setCellValue('A' . $count, $row->student);
    $active_sheet->setCellValue('B' . $count, $row->course);
    $active_sheet->setCellValue('C' . $count, $row->faculty);
    $active_sheet->setCellValue('D' . $count, $row->attendance);
    $active_sheet->setCellValue('E' . $count, $row->date);

    //increase count variable by one
    $count = $count + 1;

  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

  //create filename
  $file_name = time() . '.' . strtolower($_POST["file_type"]);

  //save file
  $writer->save($file_name);

  // force download content
  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"".$file_name."\"");

  readfile($file_name);

  //remove excel sheet from the working folder
  unlink($file_name);

  exit;
}

/* end file export */



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Attendance Report</title>
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
                        <th>Faculty</th>
                        <th>Attendance Status</th>
                        <th>Date</th>
                      </thead>
                      <tbody>
                        <?php foreach($attendance AS $new): ?>
                          <tr>
                            <td class="pl-4"><?php echo $new->student; ?></td>
                            <td><?php echo $new->course; ?></td>
                            <td><?php echo $new->faculty; ?></td>
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
                <br>
                <div class="row">
                  <div class="col-md-4">
                  <form class="pl-3" method="POST">
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