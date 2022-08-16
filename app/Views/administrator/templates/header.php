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
        <title>Administrator|</title>
    </head>

    <body class="bg-light">
        <div id="db-wrapper">
            <!-- navbar vertical -->
            <!-- Sidebar -->
            <nav class="navbar-vertical navbar">
                <div class="nav-scroller">
                    <!-- Brand logo -->
                    <a class="navbar-brand" href="@@webRoot/index.html">
                        <img src="@@webRoot/assets/images/brand/logo/logo.svg" alt="" />
                    </a>
                    <!-- Navbar nav -->
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page ===  'dashboard') { active }" href="@@webRoot/index.html">
                                <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Dashboard
                            </a>

                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">Layouts & Pages</div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page_group !== 'pages') { collapsed }" href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
                                <i data-feather="layers" class="nav-icon icon-xs me-2"></i>
                                Pages
                            </a>
                            <div id="navPages" class="collapse @@if (context.page_group === 'pages') { show }" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === 'profile') { active }" href="@@webRoot/pages/profile.html">
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow  @@if (context.page === 'settings') { active } "  href="@@webRoot/pages/settings.html" >
                                            Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === 'billing') { active }" href="@@webRoot/pages/billing.html">
                                            Billing
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === 'pricing') { active }" href="@@webRoot/pages/pricing.html">
                                        Pricing
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === '404error') { active }" href="@@webRoot/pages/404-error.html">
                                            404 Error
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page_group !== 'authentication') { collapsed }" href="#!" data-bs-toggle="collapse" data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
                                <i data-feather="lock" class="nav-icon icon-xs me-2"></i>
                                Authentication
                            </a>
                            <div id="navAuthentication" class="collapse @@if (context.page_group === 'authentication') { show }" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === 'signin') { active }" href="@@webRoot/pages/sign-in.html"> Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === 'signup') { active } " href="@@webRoot/pages/sign-up.html"> Sign Up</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @@if (context.page === 'forgetpassword') { active }" href="@@webRoot/pages/forget-password.html">
                                            Forget Password
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @@if (context.page === 'layouts') { active }" href="@@webRoot/pages/layout.html">
                                <i data-feather="sidebar" class="nav-icon icon-xs me-2"></i>
                                Layouts
                            </a>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">UI Components</div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page === 'docs') { active }" href="@@webRoot/docs/accordions.html" >
                                <i data-feather="package" class="nav-icon icon-xs me-2" ></i> Components
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page_group !== 'menulevel') { collapsed }" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevel" aria-expanded="false" aria-controls="navMenuLevel">
                                <i data-feather="corner-left-down" class="nav-icon icon-xs me-2"></i> Menu Level
                            </a>
                            <div id="navMenuLevel" class="collapse @@if (context.page_group === 'menulevel') { show }" data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow @@if (context.page === 'twolevel') { active }" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond" aria-expanded="false" aria-controls="navMenuLevelSecond">
                                            Two Level
                                        </a>
                                        <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link @@if (context.page === 'navitem1') { active }" href="#!">  NavItem 1</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link @@if (context.page === 'navitem2') { active }" href="#!">  NavItem 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link has-arrow @@if (context.page_group !== 'threelevel') { collapsed } " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThree" aria-expanded="false" aria-controls="navMenuLevelThree">
                                            Three Level
                                        </a>
                                        <div id="navMenuLevelThree" class="collapse @@if (context.page_group === 'threelevel') { show }" data-bs-parent="#navMenuLevel">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link @@if (context.page_group !== 'navitemthree1') { collapsed }" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThreeOne" aria-expanded="false" aria-controls="navMenuLevelThreeOne">
                                                        NavItem 1
                                                    </a>
                                                    <div id="navMenuLevelThreeOne" class="collapse collapse @@if (context.page_group === 'navitemthree1') { show }" data-bs-parent="#navMenuLevelThree">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link @@if (context.page === 'navchilitem') { active }" href="#!">
                                                                    NavChild Item 1
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link @@if (context.page === 'navitem2') { active }" href="#!">  Nav Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <div class="navbar-heading">Documentation</div>
                        </li>
                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page === 'docs') { active }" href="@@webRoot/docs/index.html" >
                                <i data-feather="clipboard" class="nav-icon icon-xs me-2" ></i> 
                                Docs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow @@if (context.page === 'docs') { active }" href="@@webRoot/docs/changelog.html" >
                                <i data-feather="git-pull-request" class="nav-icon icon-xs me-2" ></i> Changelog
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Page content -->
            <div id="page-content">
                <div class="header @@classList">
                    <!-- navbar -->
                    <nav class="navbar-classic navbar navbar-expand-lg">
                        <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                        <div class="ms-lg-3 d-none d-md-none d-lg-block">
                            <!-- Form -->
                            <form class="d-flex align-items-center">
                                <input type="search" class="form-control" placeholder="Search" />
                            </form>
                        </div>
                        <!--Navbar nav -->
                        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                            <li class="dropdown stopevent">
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
                                        <!-- List group -->
                                        <ul class="list-group list-group-flush notification-list-scroll">
                                            <!-- List group item -->
                                            <li class="list-group-item bg-light">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Rishi Chopra</h5>
                                                    <p class="mb-0">Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.</p>
                                                </a>
                                            </li>
                                            <!-- List group item -->
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Neha Kannned</h5>
                                                    <p class="mb-0">
                                                        Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                                                    </p>
                                                </a>
                                            </li>
                                            <!-- List group item -->
                                            <li class="list-group-item">
                                                <a href="#" class="text-muted">
                                                    <h5 class=" mb-1">Nirmala Chauhan</h5>
                                                    <p class="mb-0">
                                                    Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                                                    </p>
                                                </a>
                                            </li>
                                            <!-- List group item -->
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
                            </li>
                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="@@webRoot/assets/images/avatar/avatar-1.jpg" class="rounded-circle" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">


                                        <div class="lh-1 ">
                                        <h5 class="mb-1"> John E. Grainger</h5>
                                        <a href="#" class="text-inherit fs-6">View my profile</a>
                                        </div>
                                        <div class=" dropdown-divider mt-3 mb-2"></div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit
                                                Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="#">
                                                <i class="me-2 icon-xxs dropdown-item-icon"
                                                data-feather="activity"></i>Activity Log
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-primary" href="#">
                                                <i class="me-2 icon-xxs text-primary dropdown-item-icon"
                                                data-feather="star"></i>Go Pro
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="me-2 icon-xxs dropdown-item-icon"
                                                data-feather="settings"></i>Account Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="@@webRoot/index.html">
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
                <div class="bg-primary pt-10 pb-21"></div>
                <div class="container-fluid mt-n22 px-6">
                        <!-- this is where the content page goes -->
                
                    
            