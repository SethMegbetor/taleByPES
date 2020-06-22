<?php 
require_once dirname(__DIR__).'/Core/init.php';
$data = new Fetch($connection);

if(empty($_SESSION['faculty'])) {
  $link->redirect('../index.php');
}

$students_total = $data->getTotal('students');
$course_materials_total = $data->getFacultyTotalCourseMaterial($_SESSION['faculty']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Faculty Dashboard</title>
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
          <div class="row">
              <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon l-bg-green">
                    <i data-feather="layers"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="padding-20">
                      <div class="text-right">
                        <h3 class="font-light mb-0">
                          <i class="ti-arrow-up text-success"></i> <?php echo $students_total; ?>
                        </h3>
                        <span class="text-muted">Students</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon l-bg-orange">
                    <i class="far fa-file-pdf"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="padding-20">
                      <div class="text-right">
                        <h3 class="font-light mb-0">
                          <i class="ti-arrow-up text-success"></i> <?php echo $course_materials_total; ?>
                        </h3>
                        <span class="text-muted">Course Materials</span>
                      </div>
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