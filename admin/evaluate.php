<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);

$faculty = $fetch_data->getItemsWithNoComparison('SELECT id, full_name, category_id', 'users');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Evaluate faculty</title>
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
                  <h4>Evaluation Form</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/admin_evaluate_faculty.php" method="POST">
                  <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin']; ?>">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Faculty</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="faculty_id" id="faculty_id" data-error="Bruh, select an item from the option" class="form-control" required>
                            <option value="" class="selected">Select Faculty</option>
                            <?php foreach($faculty as $user): ?>
                              <?php if($user->category_id != 1):?>
                                <option value="<?php echo $user->id; ?>"><?php echo $user->full_name; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <div class="section-title">How many peoples were you bi?</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Dollar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Euro</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Dinar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Pound</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Rupee</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <div class="section-title">How many peoples were you bi?</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Dollar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Euro</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Dinar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Pound</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Rupee</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <div class="section-title">How many peoples were you bi?</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Dollar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Euro</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Dinar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Pound</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Rupee</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <div class="section-title">How many peoples were you bi?</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon4" value="4" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Dollar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon4" value="4" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Euro</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon4" value="4" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Dinar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon4" value="4" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Pound</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon4" value="4" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Rupee</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <div class="section-title">How many peoples were you bi?</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon5" value="5" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Dollar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon5" value="5" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Euro</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon5" value="5" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Dinar</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon5" value="5" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Pound</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon5" value="5" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Rupee</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Comments</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea name="comment" id="comment" placeholder="Please enter your comments here..." class="form-control" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary">Submit</button>
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