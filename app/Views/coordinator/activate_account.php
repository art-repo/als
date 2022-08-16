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
        <title>Avtivate Your Account</title> 
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="light p-3 rounded shadow">
                        <form action="<?=base_url('coordinator/activation')?>" method="post">
                            <h5 class="text-success fw-bold">Activate your account</h5>
                            <input type="hidden" name="coordinator_id" value="<?=$coordinator_id?>">
                            <div class="mb-3">
                                <label for="activation_code" class="form-label">Activation Code</label>
                                <input type="text" class="form-control" placeholder="XXX-XXX-XXX" name="activation_code" id="activation_code">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Activate</button>
                            </div>
                            <div class="col-md-6 text-start">
                                <a href="<?=base_url('coordinator/login')?>" class="link-primary">Sign In</a>
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            <?php if(session()->getFlashdata('success')) : ?>
                swal({
                    title: "Success!",
                    text: "<?= session()->getFlashdata('success')?>",
                    icon: "success",
                    button: "Close",
                });
            <?php endif ?>
            <?php if(session()->getFlashdata('fail')) : ?>
                swal({
                    title: "Failed!",
                    text: "<?= session()->getFlashdata('fail')?>",
                    icon: "error",
                    button: "Close",
                });
            <?php endif ?>
        </script>
    </body>
</html>