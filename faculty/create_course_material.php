<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['faculty']) && ($_SESSION['faculty_grade'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);

$academic_year = $fetch_data->getItemsWithNoComparison('SELECT id, year', 'academic_year');
$semesters = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'semester');
$courses = $fetch_data->getItemsWithNoComparison('SELECT id, course_name', 'courses');

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
          <div class="row">
              <div class="col-10">
              <div class="card">
                <div class="card-header">
                  <h4>Add Course Material</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/create_course_material1.php" enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="id" value="<?php echo $_SESSION['faculty']; ?>" required>
                  <input type="hidden" name="faculty_grade_id" value="<?php echo $_SESSION['faculty_grade']; ?>" required>
                    <div class="form-group row mb-4">
                      <label for="title" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="title" data-minlength="4"  name="title" data-error="The title field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="course_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="course_id" id="course_id" data-error="Select an item from the option" class="form-control" required>
                          <option value="" class="selected">Select Course</option>
                          <?php foreach($courses as $course): ?>
                            <option value="<?php echo $course->id; ?>"><?php echo $course->course_name; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="semester_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Semester</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="semester_id" id="semester_id" data-error="Select an item from the option" class="form-control" required>
                          <option value="" class="selected">Select semester</option>
                          <?php foreach($semesters as $sem): ?>
                            <option value="<?php echo $sem->id; ?>"><?php echo $sem->name; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="academic_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Academic Year</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="academic_id" id="academic_id" data-error="Select an item from the option" class="form-control" required>
                          <option value="" class="selected">Select academic year</option>
                          <?php foreach($academic_year as $year): ?>
                            <option value="<?php echo $year->id; ?>"><?php echo $year->year; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="file" name="file" id="file" data-error="The file is required" class="form-control" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
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