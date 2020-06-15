<?php 
require_once dirname(__DIR__).'/Core/init.php';

if(empty($_SESSION['admin'])) {
  $link->redirect('../index.php');
}

$fetch_data = new Fetch($connection);
$date = new DateFormat($connection);

$programmes = $fetch_data->getItemsWithNoComparison('SELECT id, name, created_at', 'programmes');


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'includes/meta.php'; ?>
  <title>Tales - Programmes</title>
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
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Create New Programme</h4>
                </div>
                <div class="card-body p-0">
                  <form data-toggle="validator" role="form" action="../Submits/create_programme.php" method="POST">
                    <div class="form-group row mb-4">
                      <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="name"  name="name" data-error="Bruh, the programme name field is required" required>
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
          <br><br>
          <div class="row">
              <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Programme List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <?php if(!empty($programmes)){ ?>
                      <table class="table table-hover">
                        <thead>
                            <th class="pl-4">Name</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </thead>
                          <tbody>
                            <?php foreach($programmes AS $program): ?>
                              <tr>
                                <td class="pl-4"><?php echo $program->name; ?></td>
                                <td><?php echo $date->timeAgo($program->created_at); ?></td>
                                <td>
                                  <a href="update_programme.php?id=<?php echo $program->id; ?>" class="text-warning"><i class="fas fa-edit"></i></a>
                                  <a href="../Submits/delete.php?programme_id=<?php echo $program->id; ?>" class="text-danger" data-toggle="tooltip" data-placement="left" title="Do you really want to delete this item permanently? NB: Action can not be undone!"><i class="fas fa-times"></i></a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                      <?php } else { ?>
                        <h3 class="text-danger mb-5 text-center">No data available!</h3>
                      <?php } ?>
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