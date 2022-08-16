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
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="light p-2 rounded shadow">
                        <form action="<?=base_url('coordinator/reset_password' .'/'.$user_id)?>" method="post">
                            <?=csrf_field();?>
                            <input type="hidden" name="coordinator_id" value="<?=$user_id?>">
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <span class="align-middle material-icons">error</span>
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <h4 class="text-blue-3 fw-bold">Forgot Password</h4>
                            <span class="form-text"><?=$username?> Change your password.</span>
                            <br><br>
                            <div class="mb-3">
                                <label for="new_pass" class="form-text">New Password</label>
                                <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="New Password"  value="<?=set_value('new_pass')?>">
                                <small class="text-danger"><?= isset($validation) ? display_error($validation, 'new_pass') : '';?></small>
                            </div>
                            <div class="mb-3">
                                <label for="conf_pass" class="form-text">Confirm Password</label>
                                <input type="password" name="conf_pass" id="conf_pass" class="form-control" placeholder="Confirm Password"  value="<?=set_value('conf_pass')?>">
                                <small class="text-danger"><?= isset($validation) ? display_error($validation, 'conf_pass') : '';?></small>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-blue-3 text-light py-2 fw-bold fs-6" type="submit">Submit</button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <br>
                                    <small ><a href="<?=base_url('staff/login')?>" class="text-blue-3" style="text-decoration: none!important;" >Sign In</a></small>
                                </div>
                                <div class="col-md-6 text-end">
                                    <br>
                                    <small ><a href="<?=base_url('registration/brgy_staff')?>" class="text-dark" style="text-decoration: none!important;" >Create Account</a></small>
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
        <script>
            const new_pass = document.querySelector('#new_pass');
            const conf_pass = document.querySelector('#conf_pass');

            new_pass
        </script>
    </body>
</html>