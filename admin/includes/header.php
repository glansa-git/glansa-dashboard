<?php
include("../config/db_config.php");
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['name'])) {
    // If the user is not logged in or username is not set, redirect them to the login page
    header("Location: ../login.php");
    exit;
}

// Example usage:
$user_id = $_SESSION['user_id'];
$username = $_SESSION['name'];
$user_role = $_SESSION['role']; 

// For now, let's just display a simple welcome message
$welcome_message = "$username!";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Saburi LMS </title>
    <!-- plugins:css -->

    <script src="./assets/js/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="./assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="./assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="./assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="./assets/vendors/datatables/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="https://glansa.com/Tickets/uploads/company/favicon.png" />
    <link rel="stylesheet" href="./assets/vendors/richtexteditor/rte_theme_default.css" />
    <link rel="stylesheet" href="./assets/vendors/datatables/dataTables.bootstrap4.min.css">
    <!-- flora headers -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.15/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>


    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9">-->

    <style>
        /*div#editor {*/
        /*    width: 100%;*/
        /*    margin: auto;*/
        /*    text-align: left;*/
        /*}*/

        .ss {
            background-color: red;
        }

        #fr-logo {
            visibility: hidden;
        }
        
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="<?= $mainlink; ?>admin/dashboard">
                        <img src="../assets/images/gllogo-pl1l6bmjhmx3czxexrdpaod6usjyu1ohofup34yo3o.png" alt="logo" />
                        <!-- <h3 style="color:white;">LMS - SABURI</h3> -->
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="./assets/images/saburi.png" alt="logo" />
                        <h3 style="color:white;">Glansa</h3>
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Welcome
                            <?php echo $welcome_message; ?>
                        </h1>
                        <!-- <h3 class="welcome-sub-text">Your performance summary this week </h3> -->
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="countDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="./assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="./assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="./assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="./assets/images/faces/face8.jpg"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="./assets/images/faces/face8.jpg"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">
                                    <?= $welcome_message ?>
                                </p>
                                <p class="fw-light text-muted mb-0">
                                    <!-- <?= $email ?> -->
                                </p>
                            </div>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <a class="dropdown-item" href="./user.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> User</a>
                                <a class="dropdown-item" href="./department.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Department</a>
                                <a class="dropdown-item" href="<?= $mainlink?>admin/adminProfile"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                                <a class="dropdown-item" href="./modules.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Modules</a>
                                
                                <?php } elseif ($_SESSION['role'] == 'user') { ?>
                                <!-- Only show user profile and logout option for regular users -->
                                <a class="dropdown-item" href="./user_profile.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                            <?php } elseif ($_SESSION['role'] == 'department') { ?>
                                <!-- Show reports option for department heads -->
                                <a class="dropdown-item" href="./reports.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Reports</a>
                            <?php } ?>
                            <a class="dropdown-item" href="./logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">