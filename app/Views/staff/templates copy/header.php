<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="< ?=base_url('public/bootstrap-litera.css');?>"> -->
        <link rel="stylesheet" href="<?=base_url('public/css/main.min.css');?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
        <!-- <link rel="stylesheet" href="< ?=base_url('public/login.css')?>"> -->
        <link rel="stylesheet" href="<?=base_url('public/dashboard.css')?>">
        <style>
            body{
                background-color:#edf8f6;
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
    <body class="light-grey">
        
        <div id="mySidenav" class="sidenav bg-blue-2">
            <div style="text-align: center;" class="mb-2">
            <!-- <?php 
                // if(empty($staff_info['image']) || !file_exists( FCPATH . '\\' . 'uploads\\assets\\profiles\\' . $staff_info['image'] ))
                // {
                    ?>
                        <img style = "width:200px;height:200px;" class="rounded-circle border border-light border-5" src="<?=base_url('public/uploads/assets/profiles') . '/default.png'?>" >
                    <?php
                //}else{
                    ?>
                        <img style = "width:200px;height:200px;" class="rounded-circle border border-light border-5" src="<?=base_url('public/uploads/assets/profiles') . '/' . str_replace('\\', '/' , $staff_info['image'])?>" alt="">
                    <?php
                //}
            ?> -->
                
                <p class="text-blue-1 fw-bold fs-4 m-2">
                    <?php 
                        if(empty($staff_info['firstname']) && empty($staff_info['lastname'])){
                            echo '';
                        }else{
                            echo $staff_info['firstname'] . ' ' . $staff_info['lastname'];
                        } 
                    ?>
                </p>
            </div>
            <a href="<?=base_url('staff/home')?>"><span class="align-middle material-icons">space_dashboard</span>&nbsp;Dashboard</a>
            <a href="<?=base_url('staff/add_oscya')?>"><span class="align-middle material-icons">add_box</span>&nbsp;Add OSCYA</a>
            <a href="<?=base_url('staff/view_oscya')?>"><span class="align-middle material-icons">visibility</span>&nbsp;View OSCYA</a>
            <a href="<?=base_url('staff/account')?>"><span class="align-middle material-icons">person_outline</span>&nbsp;Account</a>
        </div>
        
        <div id="main">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top border-bottom shadow-sm light">
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
                            <a href="<?=base_url('coordinator/home')?>">
                                <?php if(!empty($brgy_profile['logo'])){?>
                                    <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo']?>" alt="blank image" class="rounded-circle mx-4" style="width:px38px;height:38px;">
                                <?php } else { ?>
                                    <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="rounded-circle border border-3" style="width:px38px;height:38px;">
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <span class="fw-bold fs-5"><?=$brgy_profile['barangay']?></span>
                        </li>
                    </ul>
                    <div class="d-flex p-0">
                        <a href="<?=base_url('staff/account')?>" class="navlinks text-blue-2">
                            <span class="material-icons pt-1">person_outline</span>
                        </a>
                        <a href="" class="navlinks text-blue-2">
                            <span class="material-icons pt-1">logout</span>
                        </a>
                    </div>  
                </div>
            </nav>

        
    