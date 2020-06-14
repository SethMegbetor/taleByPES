<?php
//success alert
if(isset($_SESSION['success'])){
    ?>
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php echo $_SESSION['success']; ?>
        </div>
    </div>
<?php 
} $_SESSION['success'] = null; 
?>


<?php
//error alert
if(isset($_SESSION['error'])){
    ?>
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <?php echo $_SESSION['error']; ?>
        </div>
    </div>
<?php 
} $_SESSION['error'] = null; 
?>