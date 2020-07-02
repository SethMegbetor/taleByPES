<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['student'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);

$selected_user = $fetch_data->getSigleJoinItem('SELECT students.id, students.full_name, students.index_no, students.department_id, students.level_id, students.programme_id, students.email, students.campus_id, students.grade_id, students.address, departments.name AS department, levels.name AS level, programmes.name AS programme, campuses.name AS campus, grades.name AS grade', 'students', 'JOIN departments ON departments.id = students.department_id JOIN levels ON levels.id = students.level_id JOIN programmes ON programmes.id = students.programme_id JOIN campuses ON campuses.id = students.campus_id JOIN grades ON grades.id = students.grade_id', 'students.id', $_SESSION['student'] );

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - My Account</title>
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
              <div class="col-10">
              <div class="card">
                <div class="card-header">
                  <h4>My Account</h4>
                </div>
                <div class="card-body p-0">
                  <form role="form">
                    <div class="form-group row mb-4">
                      <label for="full_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Full Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="full_name" data-minlength="4"  name="full_name" value="<?php echo $selected_user->full_name; ?>" data-error="Bruh, the fullname field is required" readonly required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Department</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="department_id" id="department_id" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->department_id; ?>" class="selected"><?php echo $selected_user->department; ?></option>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Level</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="level_id" id="level_id" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->level_id; ?>" class="selected"><?php echo $selected_user->level; ?></option>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email Address</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $selected_user->email; ?>" data-error="Bruh, that email address is invalid" readonly required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Campus</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="campus_id" id="campus_id" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->campus_id; ?>" class="selected"><?php echo $selected_user->campus; ?></option>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Grade</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="grade_id" id="grade_id" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->grade_id; ?>" class="selected"><?php echo $selected_user->grade; ?></option>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </form>
                  <br><br>
                  <?php include 'includes/alert.php'; ?>
                  <p class="lead ml-5">Change My Password</p>
                  <hr class="ml-5 mr-5">
                  <form data-toggle="validator" role="form" action="../Submits/student_update_account.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['student']; ?>" required>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Old Password</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="password" name="old_password" id="old_password" class="form-control" data-error="The old password field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New Password</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="password" name="password" data-minlength="6" id="password" class="form-control" required>
                        <div class="help-block with-errors text-danger">Minimum of 6 characters</div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Repeat New Password</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="password" name="confirm_password" id="confirm_password" data-match="#password" data-match-error="Whoops, these don't match" class="form-control" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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