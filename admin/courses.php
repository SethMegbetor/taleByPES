<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

$courses = $fetch_data->getItemsWithNoComparison('SELECT id, course_name, course_code, created_at', 'courses');


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
                  <h4>Add new Course</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/create_course.php" method="POST">
                    <div class="form-group row mb-4">
                      <label for="course_code" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Code</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="course_code"  name="course_code" data-error="Bruh, the course code field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="course_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="course_name"  name="course_name" data-error="Bruh, the course name field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary">Create</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              </div>
          </div>
          <br><br>
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Course List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <?php if(!empty($courses)){ ?>
                      <table class="table table-hover">
                        <thead>
                            <th class="pl-4">Course Name</th>
                            <th class="pl-4">Course Code</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </thead>
                          <tbody>
                            <?php foreach($courses AS $course): ?>
                              <tr>
                                <td class="pl-4"><?php echo $course->course_name; ?></td>
                                <td class="pl-4"><?php echo $course->course_code; ?></td>
                                <td><?php echo $date->timeAgo($course->created_at); ?></td>
                                <td>
                                  <a href="update_course.php?id=<?php echo $course->id; ?>" class="text-warning"><i class="fas fa-edit"></i></a>
                                  <a href="../Submits/delete.php?course_id=<?php echo $course->id; ?>" class="text-danger" data-toggle="tooltip" data-placement="left" title="Do you really want to delete this course permanently? NB: Action can not be undone!"><i class="fas fa-times"></i></a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                      <?php } else { ?>
                        <h3 class="text-danger mb-5 text-center">No data available!</h3>
                      <?php } ?>
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