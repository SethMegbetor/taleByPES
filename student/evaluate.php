<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['student'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);

$courses = $fetch_data->getItemsWithNoComparison('SELECT id, course_name', 'courses');

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
                  <form data-toggle="validator" role="form" action="../Submits/student_evaluation.php" method="POST">
                  <input type="hidden" name="student_id" value="<?php echo $_SESSION['student']; ?>">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Course</label>
                      <div class="col-sm-12 col-md-7">
                        <select name="course_id" id="course_id" data-error="Select an item from the option" class="form-control" required>
                            <option value="" class="selected">-- Choose course --</option>
                            <?php foreach($courses as $user): ?>
                              <?php if($user->category_id != 1):?>
                                <option value="<?php echo $user->id; ?>"><?php echo $user->course_name; ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-md-9 col-md-7">
                        <div class="section-title">Lecture presented learning objectives of the course clearly</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Neutral</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Agree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon1" value="1" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly agree</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-md-9 col-md-7">
                        <div class="section-title">Lecture encouraged and provided apportunity for students to ask questions</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon7" value="7" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon7" value="7" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon7" value="7" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Neutral</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon7" value="7" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Agree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon7" value="7" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly agree</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-md-9 col-md-7">
                        <div class="section-title">Online teaching environment felt like a welcoming place to express my ideas</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon11" value="11" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon11" value="11" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon11" value="11" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Neutral</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon11" value="11" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Agree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon11" value="11" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly agree</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-md-9 col-md-7">
                        <div class="section-title">Lecturer provided a list of current reading and recommended textbooks</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Neutral</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Agree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon2" value="2" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly Agree</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-md-9 col-md-7">
                        <div class="section-title">Lecturer provided links to relevant web-based technology resources</div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-primary-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-success-o">
                              <i class="icon material-icons">done</i>
                              <label>Disagree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-info-o">
                              <i class="icon material-icons">done</i>
                              <label>Neutral</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-warning-o">
                              <i class="icon material-icons">done</i>
                              <label>Agree</label>
                            </div>
                          </div>
                          <div class="pretty p-icon p-round">
                            <input type="radio" name="icon3" value="3" />
                            <div class="state p-danger-o">
                              <i class="icon material-icons">done</i>
                              <label>Strongly agree</label>
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