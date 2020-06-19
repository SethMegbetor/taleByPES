<div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                                    collapse-btn"> <i data-feather="align-justify"></i></a></li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="../assets/img/faculty.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello <?php echo $_SESSION['faculty_name']; ?></div>
                <a href="profile.php" class="dropdown-item has-icon"> <i class="far
                                        fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="../Submits/user_logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
                </a>
            </div>
            </li>
        </ul>
    </nav>