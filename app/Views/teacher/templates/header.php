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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <title>Teacher</title>
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
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item text-center">
                            <?php if(empty($t_info['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $t_info['image']))):?>
                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-xxl rounded-circle" />
                            <?php else: ?>
                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $t_info['image']?>" class="avatar avatar-xxl rounded-circle" />
                            <?php endif ?>
                        </li>
                        <li class="nav-item pt-1 px-4 text-center">
                           
                            <span class="fw-bold fs-4 text-light"><?=$t_info['firstname'] . ' ' . $t_info['lastname']?></span>
                            
                            <div class="navbar-heading fs-4">ALS Teacher</div>
                        
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="<?=base_url('teacher/home')?>">
                                <i data-feather="home" class="nav-icon icon-sm me-2"></i>  Dashboard
                            </a>
                        </li>
                        
                        <!-- Nav item -->
                        <!-- <li class="nav-item">
                            <div class="navbar-heading">Layouts & Pages</div>
                        </li> -->
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">Task</div>
                        </li>
                        <!-- Nav item -->

                        
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#brgyPages" aria-expanded="false" aria-controls="brgyPages">
                                <i data-feather="layers" class="nav-icon icon-sm me-2"></i>
                                Barangays
                            </a>
                            <?php if(isset($barangays) && is_array($barangays)): ?>
                                <?php foreach($barangays as $barangay): ?>
                                    <div id="brgyPages" class="collapse" data-bs-parent="#sideNavbar">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?=base_url('teacher/barangay') . '/' . $barangay['user_id'];?>">
                                                    <div class="icon-shape rounded-circle">
                                                        <?php if(empty($barangay['logo']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $barangay['logo']))):?>
                                                            <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-sm rounded-circle"/>
                                                        <?php else: ?>
                                                            <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $barangay['logo']?>" class="avatar avatar-sm rounded-circle" />
                                                        <?php endif ?>
                                                    </div>
                                                    &nbsp;<?=$barangay['barangay']?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>

                            <?php endif ?>
                            
                        </li>
                        
                        
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">General Settings</div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('teacher/account')?>">
                                <span class="material-icons">account_circle</span>&nbsp;
                                Account
                            </a>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('teacher/logout')?>">
                                <span class="material-icons">logout</span>&nbsp;
                                Log out
                            </a>
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
                            

                            <?php if(isset($page_info) && isset($page_info['title']) && $page_info['title'] == 'staff_records'): ?>
                                <li class="dropdown stopevent">
                                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted me-2" href="<?=base_url('teacher/generate_osy_mapping') .'/'.$page_info['staff_id'] ?>" target="_blank">
                                    <i class="bi bi-file-earmark-excel fs-4"></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            
                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                    <?php if(empty($t_info['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $t_info['image']))):?>
                                        <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-xxl rounded-circle" />
                                    <?php else: ?>
                                        <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $t_info['image']?>" class="avatar avatar-xxl rounded-circle" />
                                    <?php endif ?>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">
                                        <div class="lh-1 ">
                                            <h5 class="mb-1"><?=$t_info['firstname'] . ' ' . $t_info['lastname']?></h5>
                                            
                                            
                                        </div>
                                        <div class=" dropdown-divider mt-3 mb-2"></div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('teacher/logout')?>">
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
                <!-- <div class="bg-primary pt-10 pb-21"></div> -->
                <div class="pt-10 pb-21" ></div>
                <!-- style="background-image: url(< ?=base_url('public/uploads/assets/profiles')?>/dot-grid.png); " -->
                <div class="container-fluid mt-n22 px-6">
                        <!-- this is where the content page goes -->
                
                    
            