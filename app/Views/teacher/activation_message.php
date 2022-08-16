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
                    <div class="light p-3 rounded shadow">
                        <h5 class="text-blue-3 fw-bold">Account Successfully Activated</h5>    
                        <a href="<?=base_url('teacher/login')?>" class="btn btn-primary">Sign In</a>
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