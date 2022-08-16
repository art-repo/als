<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="< ?=base_url('public/bootstrap-litera.css');?>"> -->
        <link rel="stylesheet" href="<?=base_url('public/css/main.min.css');?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('public/login.css')?>">
        <link rel="stylesheet" href="<?=base_url('public/dashboard.css')?>">
        <style>
            body{
                /* background-image: url('<?=base_url('public/uploads/svgs')?>/LoginCoordinator.svg');
                background-repeat:no-repeat; */
                background-color: var(--bs-blue-2);
            }
        </style>
        <title>Dashboard|</title> 
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="light p-2 rounded shadow">
                        <form action="<?=base_url('alscoordinator/forgot_password')?>" method="post">
                            <?=csrf_field();?>
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <span class="align-middle material-icons">error</span>
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <h4 class="text-blue-3 fw-bold">Forgot Password</h4>
                            <span class="form-text">Don't worry , we'll send you an email to reset your password.</span>
                            <br><br>
                            <div class="mb-3">
                                <label for="pass" class="form-text">Email</label>
                                <input type="text" name="email" id="email" class="login-input" placeholder="email"  value="<?=set_value('email')?>">
                                <small class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '';?></small>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-blue-3 text-light py-2 fw-bold fs-6" type="submit">Reset Password</button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <br>
                                    <small ><a href="<?=base_url('alscoordinator/login')?>" class="text-blue-3" style="text-decoration: none!important;" >Sign In</a></small>
                                </div>
                                <div class="col-md-6 text-end">
                                    <br>
                                    <small ><a href="<?=base_url('registration/als_coordinator')?>" class="text-dark" style="text-decoration: none!important;" >Create Account</a></small>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <div class="col-md-12" style="text-align: center; padding-top: 100px;">
                    <small class="fw-bold text-light">Created By: Group IA, QCU</small>
                    <br>
                    <small class="fw-bold text-light">@2021</small>
                </div>
            </div>
        </div>
        <script src="<?=base_url('public/bootstrap.bundle.js');?>"></script>
    </body>
</html>