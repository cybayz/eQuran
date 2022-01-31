<?php

use App\Utility\Config;
use App\Utility\Flash;
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $this->escapeHTML($this->title . " - " . APP_NAME); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="" rel="shortcut icon">
    <!-- <link href="<?= $this->makeURL("bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= $this->makeURL("bower_components/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css" /> -->
    <link href="<?= $this->makeURL("css/dashboard.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= $this->makeURL("js/dashboard.js"); ?>" type="text/javascript" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="<?= $this->makeURL("js/jquery.min.js"); ?>" type="text/javascript"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
    <!-- <link rel="stylesheet" href="<?= $this->makeURL("css/bootstrap.min.css"); ?>"> -->
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/font-awesome/css/font-awesome.min.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/themify-icons/css/themify-icons.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/flag-icon-css/css/flag-icon.min.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/selectFX/css/cs-skin-elastic.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/jqvmap/dist/jqvmap.min.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("assets/css/style.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css"); ?>">
    <link rel="stylesheet" href="<?= $this->makeURL("vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"); ?>">
    <?= $this->getCSS(); ?>

    <?= $this->addCSS("dashboard"); ?>
    
</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="<?= $this->makeURL("images/logo.png")?>" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="<?= $this->makeURL("images/logo2.png")?>" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?= $this->makeURL("dashboard"); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Academics</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Students</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- <li><i class="fa fa-puzzle-piece"></i><a href="<?= $this->makeURL("student/details"); ?>">Student Details</a></li> -->
                            <li><i class="fa fa-id-badge"></i><a href="<?= $this->makeURL("student/addstudent"); ?>">New Student</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= $this->makeURL("student/studentlist"); ?>">Students List</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Attedance</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="tables-basic.html">Add daily Attedance</a></li>
                            <li><i class="fa fa-table"></i><a href="tables-data.html">View Batch Attedance</a></li>
                            <li><i class="fa fa-table"></i><a href="tables-data.html">View Student's Attedance</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Courses</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("course/addcourse"); ?>">Add Course</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("course/courselist"); ?>">Course List</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Batches</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("batch/batchlist"); ?>">View Batches</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("batch/addbatch"); ?>">Add New Batch</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Mark List</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("mark/marklist"); ?>">View Marks</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("mark/addmark"); ?>">Add Marks</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Teachers</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("teacher/teacherlist"); ?>">View Teachers</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="<?= $this->makeURL("teacher/addteacher"); ?>">Add Teacher</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Fees & Payments</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Students</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Pending Students</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Paid Students</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-login.html">Add Admin</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Change Password</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary">9</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header>
            