<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$data = new Fetch($connection);
$date = new DateFormat($connection);

$users = $data->getItemsWithLimitOffset('SELECT users.id, users.full_name, users.email, users.created_at, users.account_status, users.department_id, users.category_id, departments.name AS department, user_categories.name AS category, account_status.name AS status, users.grade_id, grades.name AS grade',
'users', 'JOIN departments ON departments.id = users.department_id JOIN user_categories ON user_categories.id = users.category_id JOIN account_status ON account_status.id = users.account_status JOIN grades ON grades.id = users.grade_id',
10, 0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Users</title>
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
            <a href="create_user.php" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
          </div>
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Users List</h4>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                            <th class="pl-4">Full Name</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Email</th>
                            <th>Grade</th>
                            <th>Account Status</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($users AS $user): ?>
                          <tr>
                              <td class="pl-4"><?php echo $user->full_name; ?></td>
                              <td class="align-middle">
                                <?php echo $user->department; ?>
                              </td>
                              <td><?php echo $user->category; ?></td>
                              <td><?php echo $user->email; ?></td>
                              <td><?php echo $user->grade; ?></td>
                              <td>
                                <?php if($user->account_status == 1){ ?>
                                  <div class="badge badge-info"><?php echo $user->status; ?></div>
                                <?php } else { ?>
                                  <div class="badge badge-danger"><?php echo $user->status; ?></div>
                                <?php } ?>
                              </td>
                              <td><?php echo $date->timeAgo($user->created_at); ?></td>
                              <?php if($user->category_id != 1): ?>
                              <td>
                                <a href="update_user.php?id=<?php echo $user->id; ?>" class="text-warning"><i class="fa fa-edit"></i></a>
                                <a href="../Submits/delete.php?user_id=<?php echo $user->id; ?>" data-toggle="tooltip" data-placement="left" title="Do you really want to delete this user permanently? NB: Action can not be undone!" class="text-danger"><i class="fa fa-times"></i></a>
                              </td>
                              <?php endif; ?>
                          </tr>
                        <?php endforeach; ?>
                    </tbody></table>
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