<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['faculty']) && ($_SESSION['faculty_grade'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

$courses = $fetch_data->getItemsWithNoComparison('SELECT id, course_name', 'courses');
$students = $fetch_data->getStudentsForAttendance($_SESSION['faculty_grade']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Course Materials</title>
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
              <div class="col-10">
              <div class="card">
                <div class="card-header">
                  <h4>Take Attendance</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/faculty_take_attendance.php" method="POST">
                    <input type="hidden" name="faculty_id" value="<?php echo $_SESSION['faculty']; ?>" required>
                      <div class="form-group row mb-4">
                        <label for="course_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course</label>
                        <div class="col-sm-12 col-md-7">
                          <select name="course_id" id="course_id" data-error="Select an item from the options." class="form-control" required>
                            <option value="" class="selected">Select Course</option>
                            <?php foreach($courses AS $course): ?>
                              <option value="<?php echo $course->id; ?>"><?php echo $course->course_name; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <div class="help-block with-errors text-danger"></div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <th class="pl-5">#</th>
                            <th>Student</th>
                            <th>Action</th>
                          </thead>
                          <tbody>
                            <?php foreach($students AS $student): ?>
                              <input type="hidden" name="student_id[<?php echo $student->id; ?>]" value="<?php echo $student->id; ?>" required>
                              <tr>
                                <td class="pl-5"><?php echo $student->id; ?></td>
                                <td><?php echo $student->full_name; ?></td>
                                <td>
                                  <div class="form-group">
                                    <div class="pretty p-icon p-curve p-pulse">
                                      <input type="radio" name="attendance[<?php echo $student->id; ?>]" value="1" required>
                                      <div class="state p-success-o">
                                        <i class="icon material-icons">done</i>
                                        <label> Present</label>
                                      </div>
                                    </div>
                                    <div class="pretty p-icon p-curve p-pulse">
                                      <input type="radio" name="attendance[<?php echo $student->id; ?>]" value="2" required>
                                      <div class="state p-danger-o">
                                        <i class="icon material-icons">done</i>
                                        <label> Absent</label>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="form-group text-center row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>
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