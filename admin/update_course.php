<?php 
require_once dirname(__DIR__).'/Core/init.php';

$fetch_data = new Fetch($connection);

if(empty($_GET['id'])){
    header('location: courses.php');
}

$courses = $fetch_data->getSingleData('SELECT id, course_name, course_code', 'courses', array('id', '=', $_GET['id']));


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Courses</title>
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
              <div class="card">
                <div class="card-header">
                  <h4>Edit Course</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/update_course.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group row mb-4">
                      <label for="course_code" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Code</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="course_code"  name="course_code" value="<?php echo $courses->course_code; ?>" data-error="Bruh, the course code field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="course_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="course_name"  name="course_name" value="<?php echo $courses->course_name; ?>" data-error="Bruh, the course name field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary">Save changes</button>
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