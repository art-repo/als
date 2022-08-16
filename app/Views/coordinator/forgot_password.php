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
        <title>Forgot Password</title> 
    </head>
    <body class="bg-success">
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">
                <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">

                    <div class="card p-6 smooth-shadow-md">
                        <form action="<?=base_url('coordinator/forgot_password');?>" method="post">
                            <?=csrf_field();?>
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <span class="align-middle material-icons">error</span>
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="text-success fw-bold">Forgot Password</h3>
                            <p class="mb-6">Don't worry, we'll send you an email to reset your password.</p>
                        
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email"  value="<?=set_value('email')?>">
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                <button class="btn btn-success py-2 fw-bold" type="submit">Reset Password</button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <a href="<?=base_url('coordinator/login')?>" class="link-success">Sign In</a>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="<?=base_url('registration/brgy_coordinator')?>" class="link-primary" >Create Account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <!-- div class="col-md-12" style="text-align: center; ">
                    <small class="fw-bold text-light">Created By: Group IA, QCU</small>
                    <br>
                    <small class="fw-bold text-light">@2021</small>
                </div -->
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
            <?php if(session()->getFlashdata('success')) : ?>
                swal({
                    title: "Success",
                    text: "<?= session()->getFlashdata('success')?>",
                    icon: "success",
                    button: "Close"
                });
            <?php endif ?>
            <?php if(session()->getFlashdata('fail')) : ?>
                swal({
                    title: "Login Failed!",
                    text: "<?= session()->getFlashdata('fail')?>",
                    icon: "error",
                    button: "Close"
                });
            <?php endif ?>
        </script>
    </body>
</html>