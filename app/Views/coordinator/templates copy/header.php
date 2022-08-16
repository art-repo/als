<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="< ?=base_url('public/bootstrap-litera.css');?>"> -->
        <link rel="stylesheet" href="<?=base_url('public/css/main.min.css');?>">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('public/login.css')?>">
        <link rel="stylesheet" href="<?=base_url('public/dashboard.css')?>">
        <style>
            body{
                background-color: #e6f5ff;
            }
            .navlinks{
                border-radius: 50px;
                padding: 5px 10px;
                color: var(--bs-blue-2);
            }
            .navlinks:hover{
                /* outline-color: grey; */
                /* outline: 1px solid lightgray; */
                background-color: lightgray;
                            
            }
        </style>
        <title>Dashboard|</title>

    </head>
    <body class="" >
        <div id="mySidenav" class="sidenav bg-blue-2">
            <div style="text-align: center;" class="mb-2">
                <?php 
                    if(empty($c_info['image']) || !file_exists( FCPATH . '\\' . 'uploads\\assets\\profiles\\' . $c_info['image'] ))
                    {
                        ?>
                            <img style = "width:200px;height:200px;border-color:#b3b3b3c2;" class="rounded-circle border border-5" src="<?=base_url('public/uploads/assets/profiles') . '/default.png'?>" >
                        <?php
                    }else{
                        ?>
                            <img style = "width:200px;height:200px;border-color:#b3b3b3c2;" class="rounded-circle border border-5" src="<?=base_url('public/uploads/assets/profiles') . '/' . str_replace('\\', '/' , $c_info['image'])?>" alt="">
                        <?php
                    }
                ?>
                <p class="text-dark fw-bold fs-4 m-2">
                    <?php 
                        if(empty($c_info['firstname']) && empty($c_info['lastname'])){
                            echo '';
                        }else{
                            echo $c_info['firstname'] . ' ' . $c_info['lastname'];
                        } 
                    ?>
                </p>
            </div>
            <a href="<?=base_url('coordinator/home')?>"><span class="align-middle material-icons">space_dashboard</span>&nbsp;Dashboard</a>
            <a href="<?=base_url('coordinator/staff')?>"><span class="align-middle material-icons">add_box</span>&nbsp;Staff Account</a>
            <a href="<?=base_url('coordinator/announcement')?>"><span class="align-middle material-icons">campaign</span>&nbsp;Announcement</a>
            <a href="<?=base_url('coordinator/facility')?>"><span class="align-middle material-icons">location_city</span>&nbsp;Facilities</a>
            <a href="<?=base_url('coordinator/reports')?>"><span class="align-middle material-icons">bar_chart</span>&nbsp;Reports</a>
            <a href="<?=base_url('coordinator/account')?>"><span class="align-middle material-icons">person_outline</span>&nbsp;Account</a>
            <a href="<?=base_url('coordinator/settings')?>"><span class="align-middle material-icons">tune</span>&nbsp;Settings</a>
        </div>
        
        <div id="main" >
            <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm light">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-1">
                            <a role="button" id = "toggle-open" class="navlinks text-blue-2 visible">
                                <span class="material-icons pt-1">menu</span>
                            </a>
                            <a role="button" id = "toggle-close" class="navlinks text-blue-2 invisible">
                                <span class="material-icons pt-1">menu</span>
                            </a>
                        </li>
                        <li class="nav-item me-2">
                            <!-- <a href="< ?=base_url('coordinator/home')?>">
                                < ?php if(!empty($brgy_profile['logo'])){?>
                                    <img src="< ?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo']?>" alt="blank image" class="rounded-circle border border-3" style="width:45px;height:45px;">
                                < ?php } else { ?>
                                    <img src="< ?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="rounded-circle border border-3" style="width:px38px;height:38px;">
                                < ?php } ?>
                            </a> -->
                        </li>
                        <li class="nav-item pt-2">
                            <a class="navbar-brand mx-2 fw-bold" href="#"><span class="text-red-10">A</span><span class="text-green-2">L</span><span class="text-blue-3">S</span> Program</a>
                        </li>
                    </ul>
                    
                    <div class="d-flex p-0">
                        
                        <div class="btn-group dropstart">
                            <a type="button" class="rounded-circle fs-5 fs-bold" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php 
                                            if(empty($c_info['image']) || !file_exists( FCPATH . '\\' . 'uploads\\assets\\profiles\\' . $c_info['image'] ))
                                            {
                                                ?>
                                                    <img style = "width:40px;height:40px;border-color:#b3b3b3c2;" class="rounded-circle border" src="<?=base_url('public/uploads/assets/profiles') . '/default.png'?>" >
                                                <?php
                                            }else{
                                                ?>
                                                    <img style = "width:40px;height:40px;border-color:#b3b3b3c2;" class="rounded-circle border" src="<?=base_url('public/uploads/assets/profiles') . '/' . str_replace('\\', '/' , $c_info['image'])?>" alt="">
                                                <?php
                                            }
                                        ?>
                            </a>
                            <ul class="dropdown-menu shadow border-0" >
                                <li>
                                    <a href="<?=base_url('coordinator/account')?>" class="dropdown-item text-blue-3 py-2">
                                        <?php 
                                            if(empty($c_info['image']) || !file_exists( FCPATH . '\\' . 'uploads\\assets\\profiles\\' . $c_info['image'] ))
                                            {
                                                ?>
                                                    <img style = "width:30px;height:30px;border-color:#b3b3b3c2;" class="rounded-circle border" src="<?=base_url('public/uploads/assets/profiles') . '/default.png'?>" >
                                                <?php
                                            }else{
                                                ?>
                                                    <img style = "width:30px;height:30px;border-color:#b3b3b3c2;" class="rounded-circle border" src="<?=base_url('public/uploads/assets/profiles') . '/' . str_replace('\\', '/' , $c_info['image'])?>" alt="">
                                                <?php
                                            }
                                        ?>
                                        <span class="align-middle fw-bold fs-6">&nbsp;Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('coordinator/settings')?>" class="dropdown-item text-blue-3 py-2">
                                        <span class="material-icons align-middle">tune</span>
                                        <span class="align-middle fw-bold fs-6">&nbsp;Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('coordinator/logout')?>" class="dropdown-item text-blue-3 py-2">
                                        <span class="material-icons align-middle">logout</span>
                                        <span class="align-middle fw-bold fs-6">&nbsp;Log out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                    
                </div>
            </nav>

        
    