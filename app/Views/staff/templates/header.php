<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="<?=base_url('public/sources/bootstrap-icons/font')?>/bootstrap-icons.css" rel="stylesheet">
        <link href="<?=base_url('public/sources/dropzone/dist')?>/dropzone.css"  rel="stylesheet">
        <link href="<?=base_url('public/sources/@mdi/font/css')?>/materialdesignicons.min.css" rel="stylesheet" />
        <link href="<?=base_url('public/sources/prismjs/themes')?>/prism-okaidia.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('public/sources')?>/assets/css/theme.css">
        <!-- <link rel="stylesheet" href="<?=base_url('public/sources')?>/bootstrap/css/bootstrap.css"> -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <title>Staff|</title>
    </head>
    <body class="bg-light">
        <div id="db-wrapper">
            <!-- navbar vertical -->
            <!-- Sidebar -->
            <nav class="navbar-vertical navbar">
                <div class="nav-scroller">
                    <!-- Brand logo -->
                    <a class="navbar-brand" href="#">
                        <img src="#" alt="" />
                    </a>
                    <!-- Navbar nav -->
                    <ul class="navbar-nav flex-column " id="sideNavbar">
                        <li class="nav-item pt-0 px-4 text-center">
                            <a href="<?=base_url('staff/home')?>">
                                <?php if(empty($brgy_profile['logo']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $brgy_profile['logo'])): ?>
                                    <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="avatar avatar-xxl rounded-circle me-3">
                                <?php else: ?>
                                    <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo']?>" alt="blank image" class="avatar avatar-xxl rounded-circle me-3" >
                                <?php endif ?>
                            </a>
                        </li>
                        <li class="nav-item text-center my-0">
                            <div class="navbar-heading fs-4 text-light mb-0"><?=strtoupper($brgy_profile['barangay'])?></div>
                            <span class="fw-bold">BRGY. STAFF</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="<?=base_url('staff/home')?>">
                                <i data-feather="home" class="nav-icon icon-sm me-2"></i>  
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#brgyPages" aria-expanded="false" aria-controls="brgyPages">
                                <i data-feather="layers" class="nav-icon icon-sm me-2"></i>
                                OSY
                            </a>
                            <div id="brgyPages" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow" href="<?=base_url('staff/data_privacy')?>">
                                            <i data-feather="user-plus" class="nav-icon icon-sm me-2"></i>
                                            Add
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow" href="<?=base_url('staff/view_oscya')?>">
                                            <i data-feather="users" class="nav-icon icon-sm me-2"></i>
                                            View
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        
                        <li class="nav-item">
                            <div class="navbar-heading">Settings</div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('staff/account')?>">
                                <i data-feather="user" class="nav-icon icon-sn me-2"></i>
                                My Account
                            </a>
                        </li>
                        <!-- Nav item -->
                        <!-- <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!">
                                <i data-feather="settings" class="nav-icon icon-sn me-2"></i>
                                Settings
                            </a>
                        </li> -->
                    </ul>
                    
                </div>
            </nav>
            <!-- Page content -->
            <div id="page-content" >
                <div class="header">
                    <!-- navbar -->
                    <nav class="navbar-classic navbar navbar-expand-lg">
                        <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                        <!-- <div class="container-fluid">
                            <a class="navbar-brand align-middle" href="#">
                                <img src="< ?=base_url('public/sources/assets/images/favicon')?>/logo.png" alt="" width="45" height="40" class="d-inline-block align-text-top">
                            </a>
                            
                        </div> -->
                        <div class="ms-lg-3 d-none d-md-none d-lg-block">
                            <!-- Form -->
                            <form class="d-flex align-items-center">
                                <!-- <span class="fw-bold navbar-brand">BARANGAY < ?=strtoupper($staff_contact['barangay'])?></span> -->
                                <!-- <input type="search" class="form-control" placeholder="Search" /> -->
                            </form>
                        </div>
                        <!--Navbar nav -->
                        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                        
                            <li class="dropdown stopevent ms-2">
                                
                                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if(empty($staff_info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $staff_info['image'])): ?>
                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="profilepic" class="avatar avatar-md rounded-circle">
                                    <?php else: ?>
                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/<?=$staff_info['image']?>" alt="profilepic" class="avatar avatar-md rounded-circle">
                                    <?php endif ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">


                                        <div class="lh-1 ">
                                        <h5 class="mb-1"><?=$staff_info['firstname'] . ' ' .$staff_info['lastname']?></h5>
                                        <a href="<?=base_url('staff/account')?>" class="text-inherit fs-6">View my profile</a>
                                        </div>
                                        <div class=" dropdown-divider mt-3 mb-2"></div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('staff/logout')?>">
                                                <i class="me-2 icon-xs dropdown-item-icon"
                                                data-feather="power"></i>Sign Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                        </ul>
                        
                    </nav>
                </div>
                <!-- <div class="bg-primary pt-10 pb-21"></div> -->
                <div class="pt-10 pb-15" ></div>
                <!-- style="background-image: url(< ?=base_url('public/uploads/assets/profiles')?>/dot-grid.png); " -->
                <div class="container-fluid mt-n22 px-6">
                        <!-- this is where the content page goes -->
                        
                    
            