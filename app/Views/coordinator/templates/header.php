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
        <link rel="stylesheet" href="<?=base_url('public/sources')?>/assets/css/chat.css">
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css">
        <script src="<?=base_url('public/sources')?>/fullcalendar/main.js"></script>
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Two+Tone|Material+Icons+Sharp">
        <title>Brgy Coordinator |</title>
        
    </head>
    <body class="bg-light"> 
        <div id="db-wrapper">
            <!-- navbar vertical -->
            <!-- Sidebar -->
            <nav class="navbar-vertical navbar">
                <div class="nav-scroller">
                    <!-- Brand logo -->
                    <a class="navbar-brand text-center fw-bold fs-3 text-light" href="#">
                        
                    </a>
                    <!-- Navbar nav -->
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item text-center">
                            <?php if(empty($brgy_profile['logo']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $brgy_profile['logo'])):?>
                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-xxl rounded-circle" />
                            <?php else: ?>
                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo']?>" class="avatar avatar-xxl rounded-circle" />
                            <?php endif ?>
                        </li>

                        <li class="nav-item text-center">
                            <div class="navbar-heading text-light mb-0 fs-4"><?=strtoupper($brgy_profile['barangay'])?>
                            </div>
                            <span class="fw-bold">Barangay Coordinator</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="<?=base_url('coordinator/home')?>">
                                <span class="material-icons">dashboard</span>&nbsp;
                                Dashboard
                            </a>    
                        </li>
                        <!-- Nav item -->
                        <!-- <li class="nav-item">
                            <div class="navbar-heading">Layouts & Pages</div>
                        </li> -->
                        <!-- Nav item -->
                        <!-- <li class="nav-item">
                            <div class="navbar-heading">BRGY Coordinator</div>
                        </li> -->
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#brgyPages" aria-expanded="false" aria-controls="brgyPages">
                                <span class="material-icons">business</span>&nbsp;
                                Barangay
                            </a>
                            <div id="brgyPages" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow"  href="<?=base_url('coordinator/reports')?>" >
                                            <span class="material-icons">analytics</span>&nbsp;     
                                            Reports
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond" aria-expanded="false" aria-controls="navMenuLevelSecond">
                                            <span class="material-icons">badge</span>&nbsp;      
                                            Staffs
                                        </a>
                                        <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?=base_url('coordinator/validate_staff')?>">
                                                        <i data-feather="user-plus" class="nav-icon icon-sm me-2"></i>  
                                                        Registration
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link has-arrow"  href="<?=base_url('coordinator/staff')?>" >
                                                        <i data-feather="users" class="nav-icon icon-sm me-2"></i>
                                                        All Staff
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>    
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('coordinator/announcement')?>">
                                            <span class="material-icons">announcement</span>&nbsp;
                                            Announcement
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="<?=base_url('coordinator/teacher')?>" >
                                            <span class="material-icons">assignment_ind</span>&nbsp;
                                            Teachers
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="<?=base_url('coordinator/facility')?>" >
                                            <span class="material-icons">apartment</span>&nbsp;
                                            Facilities
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#activestaffs" aria-expanded="false" aria-controls="activestaffs">
                                <span class="material-icons">people</span>&nbsp;
                                Active Staff
                            </a>
                            
                            <div id="activestaffs" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <?php if(isset($staffs) && !empty($staffs) && is_array($staffs)):?>
                                        <?php foreach($staffs as $staff): ?>
                                            <?php if($staff['status'] == 1): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?=base_url('coordinator/view_staff')  . '/' . $staff['user_id']?>">
                                                        <div class="avatar avatar-sm avatar-indicators avatar-online me-1">
                                                            <?php if(empty($staff['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $staff['image']))):?>
                                                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle">
                                                            <?php else: ?>
                                                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') .'/' . $staff['image'] ?>" class="rounded-circle" >
                                                            <?php endif ?>
                                                        </div>
                                                        <span class="fw-bold fs-6"><?=$staff['name']?></span>
                                                    </a>
                                                </li>
                                            <?php else : ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="<?=base_url('coordinator/view_staff')  . '/' . $staff['user_id']?>">
                                                        <div class="avatar avatar-sm avatar-indicators avatar-offline me-1">
                                                            <?php if(empty($staff['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $staff['image']))):?>
                                                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle">
                                                            <?php else: ?>
                                                                <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') .'/' . $staff['image'] ?>" class="rounded-circle" >
                                                            <?php endif ?>
                                                        </div>
                                                        <span class="fw-bold fs-6"><?=$staff['name']?></span>
                                                    </a>
                                                </li>
                                            <?php endif ?>
                                        <?php endforeach?>
                                    <?php endif ?>
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
                                <span class="material-icons">admin_panel_settings</span>&nbsp;
                                Settings
                            </a>
                            
                            <div id="navAuthentication" class="collapse" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('coordinator/backup')?>">
                                            <span class="material-icons">cloud_download</span>&nbsp;
                                            Back up
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('coordinator/migration')?>">
                                            <span class="material-icons">compare_arrows</span>&nbsp;
                                            Migration
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('coordinator/account')?>">
                                            <span class="material-icons">account_circle</span>&nbsp;
                                            My Account
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('coordinator/settings')?>">
                                            <span class="material-icons">settings</span>&nbsp;
                                            Barangay Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('coordinator/logout')?>">
                                            <span class="material-icons">logout</span>&nbsp;
                                            Log out
                                        </a>
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
                        <!-- <div class="container-fluid">
                            <a class="navbar-brand align-middle" href="">
                                <img src="< ?=base_url('public/sources/assets/images/favicon')?>/logo.png" alt="" width="45" height="40" class="d-inline-block align-text-top">
                            </a> 
                        </div> -->
                       
                        <!-- <div class="ms-lg-3 d-none d-md-none d-lg-block">
                            <a class="navbar-brand fw-bold fs-3" href="#">
                                <span class="text-danger">A</span><span class="text-success">L</span><span style="color:blue;">S</span>
                            </a>
                        </div> -->
                        <!--Navbar nav -->
                        
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <?php if(isset($pages) && $pages['page']=='reports'):?>
                                    <ul class="nav justify-content-center" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Summary</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Report</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">List of Reports</a>
                                        </li>
                                    </ul>
                                <?php endif ?>
                            </div>
                        </div>
                        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                            
                            <?php if(isset($pages) && $pages['page']=='facility'):?>
                                <li class="nav-item">
                                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                        <span class="material-icons">add_circle</span>
                                    </a>
                                </li>
                            <?php endif?>
                            <?php if(isset($pages) && $pages['page']=='view_staff'):?>
                                <li class="nav-item">
                                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                        <span class="material-icons">assignment</span>
                                    </a>
                                </li>
                            <?php endif?> 
                            <li class="dropdown stopevent">
                                <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="material-icons">notifications</span>
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
                                        <!-- List group -->
                                        <ul class="list-group list-group-flush notification-list-scroll" id="notification">
                                            <!-- List group item -->
                                            <span id="notifLists"></span>

                                            <li class="list-group-item bg-light">
                                                span
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Empty</h5>
                                                    <p class="mb-0">No Available notification</p>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if(empty($c_info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $c_info['image'])):?>
                                        <div class="avatar avatar-md avatar-indicators avatar-online me-1">
                                            <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle" />
                                        </div>
                                    <?php else: ?>
                                        <div class="avatar avatar-md avatar-indicators avatar-online me-1">
                                            <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $c_info['image']?>" class="rounded-circle" />
                                        </div>
                                    <?php endif ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">
                                        <div class="lh-1 ">
                                            <p class="mb-1 fw-bold"><?=$c_info['firstname'] . ' ' . $c_info['lastname']?></p>
        
                                            <a href="<?=base_url('coordinator/account')?>" class="text-inherit fs-6">View my profile</a>
                                        </div>
                                        <div class=" dropdown-divider mt-3 mb-2"></div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class="mb-1">
                                            <a class="dropdown-item" href="<?=base_url('coordinator/account')?>">
                                                <i class="me-2 icon-sm dropdown-item-icon" data-feather="user"></i>Edit
                                                Profile
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a class="dropdown-item" href="<?=base_url('coordinator/settings')?>">
                                                <i class="me-2 icon-sm dropdown-item-icon"
                                                data-feather="settings"></i>Barangay Settings
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a class="dropdown-item" href="<?=base_url('coordinator/logout')?>">
                                                <i class="me-2 icon-sm dropdown-item-icon"
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
                <div class="container-fluid mt-n22">
                        <!-- this is where the content page goes -->
                
                    
                <script>
                    setInterval(() =>{
                        fetch('<?=base_url('coordinator/notification')?>', {
                            method:'get'
                        })
                        .then(response => response.json())
                        .then(data => {
                            const notif = document.querySelector('#notification');
                            data.forEach(post => {
                                notif.innerHTML = `<li class='list-group-item bg-light'>
                                    <a href='<?=base_url('coordinator/validate_staff')?>' class='text-muted'>
                                        <h5 class='mb-1'>${post.notif_type}</h5>
                                        <p class='mb-0'>${post.notif_content}</p>
                                        <small class='fs-bold'>${post.date_created}</small>
                                    </a>
                                </li>`;
                                // const notificationList = document.createElement('li');
                                // const header5 = document.createElement('h5');
                                // const registrationLink = document.createElement('a');
                                // const date_created = document.createElement('small');
                                // const description = document.createElement('p');
                                // description.classList = "mb-0 ";
                                // registrationLink.href = '< ?=base_url('coordinator/validate_staff')?>';
                                // header5.appendChild(document.createTextNode(post.notif_type));
                                // description.appendChild(document.createTextNode(post.notif_content));
                                // date_created.appendChild(document.createTextNode(post.date_created));
                                // notificationList.classList = "list-group-item bg-light";
                                // notificationList.appendChild(header5);
                                // notificationList.appendChild(description);
                                // notificationList.appendChild(date_created);
                                
                                
                                // let notifLists = document.querySelector('#notifLists');
                                // notif.insertBefore(notificationList, notifLists);
                            });
                        })
                    }, 500);
                </script>