<?php 
require_once dirname(__DIR__).'/Core/init.php';
$data = new Fetch($connection);

if(empty($_SESSION['student'])) {
  $link->redirect('../student_login.php');
}

// $students_total = $data->getTotal('students');
// $course_materials_total = $data->getFacultyTotalCourseMaterial($_SESSION['faculty']);

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
             <div class="col-12">
               <div class="jumbotron">
                 <h1 class="display-3">Welcome</h1>
                 <p class="lead"><?php echo $_SESSION['student_name']; ?></p>
                 <hr class="my-2">
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