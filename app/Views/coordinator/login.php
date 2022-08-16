<!DOCTYPE html>

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
        <title>Coordinator Login</title> 
    </head>
    <body class="bg-light">
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">
                <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                    <!-- Card -->
                    <div class="card smooth-shadow-md">
                        <!-- Card body -->
                        <div class="card-body p-6">
                            <div class="mb-4">
                                <h2 class="text-success">Barangay Coordinator</h2>
                                <span class="text-dark">Sign in Barangay Coordinator Account</span>
                                <p class="mb-6">Please enter your user information.</p>
                            </div>
                            <!-- Form -->
                            <form action="<?=base_url('coordinator/login');?>" method="post">
                                <?=csrf_field();?>
                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        <span class="align-middle material-icons">error</span>
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Username or email</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="username"  value="<?=set_value('username')?>">
                                    <span class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('username')): ?> 
                                            <?=$validation->getError('username')?>
                                        <?php endif ?>
                                    </span>
                                    <!-- <small class="text-danger">< ?= isset($validation) ? display_error($validation, 'username') : '';?></small> -->
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••••" value="<?=set_value('password')?>">
                                    <span class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('password')): ?> 
                                            <?=$validation->getError('password')?>
                                        <?php endif ?>
                                    </span>
                                    <!-- <small class="text-danger">< ?= isset($validation) ? display_error($validation, 'password') : '';?></small> -->
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
                                        <button type="submit" class="btn btn-success">Sign in</button>
                                    </div>

                                    <div class="d-md-flex justify-content-between mt-4">
                                        <div class="mb-2 mb-md-0">
                                            <a href="<?=base_url('registration/brgy_coordinator')?>" class="fs-5">Create An Account </a>
                                        </div>
                                    <div>
                                    <a href="<?=base_url('coordinator/forgot_password')?>" class="text-inherit fs-5">Forgot your password?</a>
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
                    text: "<?= session()->getFlashdata('fail')?>",
                    icon: "error",
                    button: "Close",
                });
            <?php endif ?>
        </script>
    </body>
</html>