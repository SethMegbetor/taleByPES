<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$data = new Fetch($connection);
$date = new DateFormat($connection);

//pagination
$pagination = $data->getTotal('students');
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

$students = $data->getItemsWithLimitOffset('SELECT students.id, students.full_name, students.index_no, students.department_id, students.level_id, students.programme_id, students.email, students.campus_id, students.address, departments.name AS department, levels.name AS level, programmes.name AS  programme, campuses.name AS campus', 'students', 'JOIN departments ON departments.id =  students.department_id JOIN levels ON levels.id =  students.level_id JOIN programmes ON programmes.id = students.programme_id JOIN campuses ON campuses.id = students.campus_id', $rows, $offset);

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Students</title>
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
          <div class="d-flex justify-content-end mb-2">
            <a href="create_student.php" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
          </div>
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Student List</h4>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                            <th class="pl-4">Name</th>
                            <th>Index No.</th>
                            <th>Department</th>
                            <th>Level</th>
                            <th>Programme</th>
                            <th>Campus</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($students AS $student): ?>
                          <tr>
                              <td class="pl-4"><?php echo $student->full_name; ?></td>
                              <td class="align-middle">
                                <?php echo $student->index_no; ?>
                              </td>
                              <td><?php echo $student->department; ?></td>
                              <td><?php echo $student->level; ?></td>
                              <td><?php echo $student->programme; ?></td>
                              <td><?php echo $student->campus; ?></td>
                              <td><?php echo $student->email; ?></td>
                              <td><?php echo $date->timeAgo($student->created_at); ?></td>
                              <td>
                                <a href="update_student.php?id=<?php echo $student->id; ?>" class="text-warning"><i class="fa fa-edit"></i></a>
                                <a href="../Submits/delete.php?student_id=<?php echo $student->id; ?>" data-toggle="tooltip" data-placement="left" title="Do you really want to delete this student permanently? NB: Action can not be undone!" class="text-danger"><i class="fa fa-times"></i></a>
                              </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination float-right mr-3">
                        <?php if(($page - 1) >= 1): ?>
                          <li class="page-item"><a class="page-link" href="students.php?page=<?php echo $prevPage; ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php if(($page + 1) <= $pages): ?>
                          <li class="page-item"><a class="page-link" href="students.php?page=<?php echo $nextPage; ?>">Next</a></li>
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