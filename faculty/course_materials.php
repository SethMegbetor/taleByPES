<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['faculty'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

$academic_years = $fetch_data->getItemsWithNoComparison('SELECT id, year', 'academic_year');
$semester = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'semester');

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
          <div class="d-flex justify-content-end mb-3">
            <a href="create_course_material.php" class="btn btn-success"><i class="fa fa-plus"> Add New</i></a>
          </div>
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Course Materials</h4>
                </div>
                <div class="card-body p-0">
                <?php foreach($academic_years as $year): ?>
                <div id="accordion<?php echo $year->id; ?>" class="mr-4 ml-4"> 
                    <?php
                      $course_materials = $fetch_data->getFacultyCourseMaterials($_SESSION['faculty']);
                    ?>
                    <div class="accordion">
                      <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-<?php echo $year->id; ?>" aria-expanded="false">
                        <h4><?php echo $year->year . " Academic Year"; ?></h4>
                      </div>
                      <div class="accordion-body collapse" id="panel-body-<?php echo $year->id; ?>" data-parent="#accordion<?php echo $year->id; ?>">
                        <p class="mb-0">
                        <div id="accordion2<?php echo $sem->id; ?>">
                          <?php foreach($semester as $sem): ?>
                            <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2<?php echo $sem->id; ?>" aria-expanded="true">
                                <h4><?php echo "Semester " . $sem->name; ?></h4>
                              </div>
                              <div class="accordion-body collapse show" id="panel-body-2<?php echo $sem->id; ?>" data-parent="#accordion2<?php echo $sem->id; ?>">
                                <p class="mb-0">
                                  <div class="table-responsive">
                                    <table class="table table-hover">
                                      <thead>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Dated Created</th>
                                        <th>Action</th>
                                      </thead>
                                      <tbody>
                                        <?php foreach($course_materials as $new): ?>
                                          <?php if(($new->academic_id == $year->id) && ($new->semester_id == $sem->id)): ?>
                                            <tr>
                                              <td><i class="text-danger fas fa-file-pdf"></i></td>
                                              <td>&nbsp;&nbsp; <?php echo $new->title; ?></td>
                                              <td><?php echo $date->timeAgo($new->created_at); ?></td>
                                              <td>
                                                <a href="../uploads/course_materials/<?php echo $new->file; ?>" class="text-warning"><i class="fa fa-download" downloand=""></i></a>&nbsp;
                                                <a href="../Submits/delete.php?file_id=<?php echo $new->id; ?>" class="text-danger"><i class="fa fa-times"></i></a>
                                              </td>
                                            </tr>
                                          <?php endif; ?>
                                        <?php endforeach; ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </p>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        </p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
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