<?php 
require_once dirname(__DIR__).'/Core/init.php';

$fetch_data = new Fetch($connection);

$departments = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'departments');
$programme = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'programmes');
$levels = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'levels');
$campuses = $fetch_data->getItemsWithNoComparison('SELECT id, name', 'campuses');

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
                  <form data-toggle="validator" role="form" action="../Submits/create_student.php" method="POST">
                    <div class="form-group row mb-4">
                      <label for="full_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Full Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="full_name" data-minlength="4"  name="full_name" data-error="Bruh, the fullname field is required" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Department</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="department_id" id="department_id" data-error="Bruh, select an item from the option" class="form-control" required>
                            <option value="" class="selected">Select Department</option>
                            <?php foreach($departments as $dept): ?>
                                <option value="<?php echo $dept->id; ?>"><?php echo $dept->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User Category</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="department_id" id="department_id" data-error="Bruh, select an item from the option" class="form-control" required>
                            <option value="" class="selected">Select Department</option>
                            <?php foreach($departments as $dept): ?>
                                <option value="<?php echo $dept->id; ?>"><?php echo $dept->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email Address</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="email" name="email" id="email" class="form-control" data-error="Bruh, that email address is invalid" required>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Account Status</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="campus_id" id="campus_id" data-error="Bruh, select an item from the option" class="form-control" required>
                            <option value="" class="selected">Select Campus</option>
                            <?php foreach($campuses as $campus): ?>
                                <option value="<?php echo $campus->id; ?>"><?php echo $campus->name; ?></option>
                            <?php endforeach; ?>
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
                        <button type="submit" class="btn btn-primary">Create</button>
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