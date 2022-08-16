<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="< ?=base_url('public/bootstrap-litera.css');?>"> -->
        <link href="<?=base_url('public/sources/bootstrap-icons/font')?>/bootstrap-icons.css" rel="stylesheet">
        <link href="<?=base_url('public/sources/dropzone/dist')?>/dropzone.css"  rel="stylesheet">
        <link href="<?=base_url('public/sources/@mdi/font/css')?>/materialdesignicons.min.css" rel="stylesheet" />
        <link href="<?=base_url('public/sources/prismjs/themes')?>/prism-okaidia.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('public/sources')?>/assets/css/theme.css">
        <title>Staff Login</title> 
    </head>
    <body class="bg-light-danger">
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">
                <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                    <!-- Card -->
                    <div class="card smooth-shadow-md">
                        <!-- Card body -->
                        <div class="card-body p-6">
                            <div class="mb-4">
                                <h2 class="text-danger">Barangay Staff</h2>
                                <span class="text-dark">Sign in Staff Account</span>
                                
                            </div>
                            <!-- Form -->
                            <form action="<?=base_url('staff/submit');?>" method="post">
                                <?=csrf_field();?>
                                
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Username or Email</label>
                                    <?php if(isset($validation) && $validation->hasError('username')): ?> 
                                        <input type="text" name="username" id="username" class="form-control border-danger text-danger" placeholder="username"  value="<?=set_value('username')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('username')==false): ?> 
                                        <input type="text" name="username" id="username" class="form-control border-success text-success" placeholder="username"  value="<?=set_value('username')?>">
                                    <?php else: ?>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="username"  value="<?=set_value('username')?>">
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('username')): ?> 
                                            <?=$validation->getError('username')?>
                                        <?php endif ?>
                                    </small>
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <?php if(isset($validation) && $validation->hasError('password')): ?>
                                        <input type="password" name="password" id="password" class="form-control border-danger text-danger" placeholder="••••••••••" value="<?=set_value('password')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('password')==false): ?>
                                        <input type="password" name="password" id="password" class="form-control border-success text-success" placeholder="••••••••••" value="<?=set_value('password')?>">
                                    <?php else: ?>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••••" value="<?=set_value('password')?>">
                                    <?php endif?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('password')): ?> 
                                            <?=$validation->getError('password')?>
                                        <?php endif ?>
                                    </small>
                                </div>
                                <!-- Checkbox -->
                                <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="rememberme">
                                        <label class="form-check-label" for="rememberme">Remember me</label>
                                    </div>
                                </div>
                                <div>
                                    <!-- Button -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-danger">Sign in</button>
                                    </div>

                                    <div class="d-md-flex justify-content-between mt-4">
                                        <div class="mb-2 mb-md-0">
                                            <a href="<?=base_url('registration/brgy_staff')?>" class="fs-5">Create An Account </a>
                                        </div>
                                    <div>
                                    <a href="<?=base_url('staff/forgot_password')?>" class="text-inherit fs-5">Forgot your password?</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="<?=base_url('public/sources')?>/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url('public/sources')?>/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url('public/sources')?>/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url('public/sources')?>/feather-icons/dist/feather.min.js"></script>
        <script src="<?=base_url('public/sources')?>/prismjs/prism.js"></script>
        <script src="<?=base_url('public/sources')?>/apexcharts/dist/apexcharts.min.js"></script>
        <script src="<?=base_url('public/sources')?>/dropzone/dist/min/dropzone.min.js"></script>
        <script src="<?=base_url('public/sources')?>/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
        <script src="<?=base_url('public/sources')?>/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
        <!-- Theme JS -->
        <!-- build:js @@webRoot/assets/js/theme.min.js -->
        <script src="<?=base_url('public/sources')?>/assets/js/main.js"></script>
        <script src="<?=base_url('public/sources')?>/assets/js/feather.js"></script>
        <script src="<?=base_url('public/sources')?>/assets/js/sidebarMenu.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            <?php if(session()->getFlashdata('fail')) : ?>
                swal({
                    title: "Login Failed!",
                    text: "<?=session()->getFlashdata('fail')?>",
                    icon: "error",
                    button: "Close",
                });
            <?php endif ?>
        </script>
    </body>
</html>