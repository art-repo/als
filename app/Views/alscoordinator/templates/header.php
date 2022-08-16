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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css">
        <script src="<?=base_url('public/sources')?>/fullcalendar/main.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Two+Tone|Material+Icons+Sharp">

        <title>Administrator</title>
    </head>

    <body style="background-color: #f2f2f2;">
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
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item pt-0 px-4">
                            <?php if(empty($info['profile_img']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $info['profile_img']))):?>
                                <img src="<?=base_url('public/uploads/assets/profiles') . '/default.png'?>" alt="" class="avatar rounded-circle me-3">
                            <?php else: ?>
                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' .$info['profile_img']?>" alt="" class="avatar rounded-circle me-3">
                            <?php endif ?>
                            <span class="fw-bold fs-4"><?=$info['firstname'] . ' ' . $info['lastname']?></span>
                            <br>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="<?=base_url('alscoordinator/dashboard')?>">
                                <i data-feather="home" class="nav-icon icon-sm me-2"></i>  Dashboard
                            </a>

                        </li>
                        <!-- Nav item -->
                        <!-- <li class="nav-item">
                            <div class="navbar-heading">Layouts & Pages</div>
                        </li> -->
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">ALS Coordinator</div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#brgyPages" aria-expanded="false" aria-controls="brgyPages">
                                <i data-feather="layers" class="nav-icon icon-sm me-2"></i>
                                Barangay
                            </a>
                            <div id="brgyPages" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                <li class="nav-item">
                                        <a class="nav-link has-arrow"  href="<?=base_url('alscoordinator/barangay')?>" >
                                            All Barangay
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('alscoordinator/registration')?>">
                                            Registration
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow"  href="<?=base_url('alscoordinator/coordinator')?>" >
                                            Coordinator
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#teacherPages" aria-expanded="false" aria-controls="teacherPages">
                                <i data-feather="layers" class="nav-icon icon-sm me-2"></i>
                                Teacher
                            </a>
                            <div id="teacherPages" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('alscoordinator/teacher_registration')?>">
                                            Registration
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('alscoordinator/olcm')?>">
                                            Community Mapping
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow"  href="#" >
                                            Teacher
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">General Settings</div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="lock" class="nav-icon icon-sn me-2"></i>
                                Settings
                            </a>
                            <div id="navAuthentication" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('alscoordinator/my_account')?>">My Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('alscoordinator/district_settings')?>"> District 5</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('alscoordinator/logout')?>">Sign out</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                    
                </div>
            </nav>
            <!-- Page content -->
            <div id="page-content">
                <div class="header">
                    <!-- navbar -->
                    <nav class="navbar-classic navbar navbar-expand-lg">
                        <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                        <div class="ms-lg-3 d-none d-md-none d-lg-block">
                            <a class="navbar-brand fw-bold fs-3" href="#">
                                <span class="text-danger">A</span><span class="text-success">L</span><span style="color:blue;">S</span>
                            </a>
                        </div>
                        <!--Navbar nav -->
                        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                            <?php if(isset($pages) && !empty($pages['view_staff_records']) && $pages['view_staff_records']=='view_staff_records'):?>
                                <li class="nav-item">
                                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                        <i class="icon-xs" data-feather="plus"></i>
                                    </a>
                                </li>
                            <?php else: ?>
                                <!-- nothing to show -->
                            <?php endif?>
                            <!-- <li class="dropdown stopevent">
                                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-xs" data-feather="bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                                    <div>
                                        <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                                            <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                                            <a href="#" class="text-muted">
                                                <span>
                                                    <i class="me-1 icon-xxs" data-feather="settings"></i>
                                                </span>
                                            </a>
                                        </div>
                                       
                                        <ul class="list-group list-group-flush notification-list-scroll">
                                            
                                            <li class="list-group-item bg-light">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Rishi Chopra</h5>
                                                    <p class="mb-0">Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.</p>
                                                </a>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Neha Kannned</h5>
                                                    <p class="mb-0">
                                                        Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                                                    </p>
                                                </a>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Nirmala Chauhan</h5>
                                                    <p class="mb-0">
                                                    Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                                                    </p>
                                                </a>
                                            </li>
                                            
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Sina Ray</h5>
                                                    <p class="mb-0">
                                                        Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="border-top px-3 py-2 text-center">
                                            <a href="#" class="text-inherit fw-semi-bold">
                                                View all Notifications
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <?php if(empty($info['profile_img']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $info['profile_img']))):?>
                                            <div class="avatar avatar-md avatar-indicators avatar-online me-1">
                                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle" />
                                            </div>
                                        <?php else: ?>
                                            <div class="avatar avatar-md avatar-indicators avatar-online me-1">
                                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' .$info['profile_img']?>" alt="" class="rounded-circle me-3">
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">
                                        <div class="lh-1 ">
                                            <h5 class="mb-1"><?=$info['firstname'] . ', ' . $info['lastname']?></h5>
                                            
                                            <a href="#" class="text-inherit fs-6">View my profile</a>
                                        </div>
                                        <div class=" dropdown-divider mt-3 mb-2"></div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('alscoordinator/my_account')?>">
                                                <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit
                                                Profile
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="me-2 icon-xxs dropdown-item-icon"
                                                data-feather="settings"></i>Account Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('alscoordinator/logout')?>">
                                                <i class="me-2 icon-xxs dropdown-item-icon"
                                                data-feather="power"></i>Sign Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        
                    </nav>
                </div>
                <div class="pt-10 pb-21"></div>
                <!-- style="background-image: url(< ?=base_url('public/uploads/assets/profiles')?>/dot-grid.png); " -->
                <div class="container-fluid mt-n22 px-6">
                        <!-- this is where the content page goes -->
                
                    
            