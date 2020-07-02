<?php
    require_once '../Classes/Functions.php';
    $active_page = new Functions();
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="index.php"> <img alt="image" src="../assets/img/logo.png" class="header-logo" /> <span
            class="logo-name">Tales</span>
        </a>
        </div>
        <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="<?php echo $active_page->activePage('index.php'); ?>">
            <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="<?php echo $active_page->activePage('course_materials.php'); ?>"><a class="nav-link" href="course_materials.php"><i data-feather="book"></i><span>Courses Materials</span></a></li>
        <li class="<?php echo $active_page->activePage('evaluate.php'); ?>"><a class="nav-link" href="evaluate.php"><i data-feather="bar-chart-2"></i><span>Evaluate Faculty</span></a></li>
        <li class="<?php echo $active_page->activePage('profile.php'); ?>"><a class="nav-link" href="profile.php"><i data-feather="user"></i><span>Profile</span></a></li>
        <li><a class="nav-link" href="../Submits/user_logout.php"><i data-feather="log-out"></i><span>Logout</span></a></li>
        </ul>
    </aside>
</div>