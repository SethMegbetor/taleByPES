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
        <li class="<?php echo $active_page->activePage('users.php'); ?>"><a class="nav-link" href="users.php"><i data-feather="users"></i><span>Users</span></a></li>
        <li class="<?php echo $active_page->activePage('students.php'); ?>"><a class="nav-link" href="students.php"><i data-feather="layers"></i><span>Students</span></a></li>
        <li class="<?php echo $active_page->activePage('programmes.php'); ?>"><a class="nav-link" href="programmes.php"><i data-feather="briefcase"></i><span>Programmes</span></a></li>
        <li class="<?php echo $active_page->activePage('courses.php'); ?>"><a class="nav-link" href="courses.php"><i data-feather="book"></i><span>Courses</span></a></li>
        <li class="<?php echo $active_page->activePage('evaluate.php'); ?>"><a class="nav-link" href="evaluate.php"><i data-feather="edit"></i><span>Faculty Evaluation</span></a></li>
        <li class="<?php echo $active_page->activePage('profile.php'); ?>"><a class="nav-link" href="profile.php"><i data-feather="user"></i><span>Profile</span></a></li>
        <li><a class="nav-link" href="../Submits/user_logout.php"><i data-feather="log-out"></i><span>Logout</span></a></li>
        </ul>
    </aside>
    </div>