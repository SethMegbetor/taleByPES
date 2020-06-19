<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['faculty'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);

$departments = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'departments');
$user_categories = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'user_categories');
$account_status = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'account_status');

$selected_user = $fetch_data->getSigleJoinItem('SELECT users.id, users.full_name, users.email, users.created_at, users.account_status, users.department_id, users.category_id, departments.name AS department, user_categories.name AS category, account_status.name AS status', 'users', 'JOIN departments ON departments.id = users.department_id JOIN user_categories ON user_categories.id = users.category_id JOIN account_status ON account_status.id = users.account_status', 'users.id', $_SESSION['faculty'] );

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
        <?php include 'includes/alert.php'; ?>
          <div class="row">
              <div class="col-10">
              <div class="card">
                <div class="card-header">
                  <h4>Update My Account</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/update_admin_account.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $_SESSION['faculty']; ?>" required>
                    <div class="form-group row mb-4">
                      <label for="full_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Full Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="full_name" data-minlength="4"  name="full_name" value="<?php echo $selected_user->full_name; ?>" data-error="Bruh, the fullname field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Department</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="department_id" id="department_id" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->department_id; ?>" class="selected"><?php echo $selected_user->department; ?></option>
                            <!-- <?php foreach($departments as $dept): ?>
                              <?php if($dept->id != $selected_user->department_id): ?>
                                <option value="<?php echo $dept->id; ?>"><?php echo $dept->name; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?> -->
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User Category</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="category_id" id="category_id" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->category_id; ?>" class="selected"><?php echo $selected_user->category; ?></option>
                            <!-- <?php foreach($user_categories as $cat): ?>
                              <?php if($cat->id != $selected_user->category_id): ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?> -->
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email Address</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $selected_user->email; ?>" data-error="Bruh, that email address is invalid" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Account Status</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="account_status" id="account_status" data-error="Bruh, select an item from the option" class="form-control" disabled required>
                            <option value="<?php echo $selected_user->account_status; ?>" class="selected"><?php echo $selected_user->status; ?></option>
                            <!-- <?php foreach($account_status as $status): ?>
                              <?php if($status->id != $selected_user->account_status): ?>
                                <option value="<?php echo $status->id; ?>"><?php echo $status->name; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?> -->
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Old Password</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="password" name="old_password" id="old_password" class="form-control" data-error="Bruh, the old password field is required" required>
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