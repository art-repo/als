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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>ALS </title>
        <style>
           
            /* .card:hover{
                transform: scale(1.1);
            }
            .card{
                transition:transform.5s;
            } */
        </style>
    </head>
    <body class="bg-light active m-0" >
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom position-fixed w-100 mb-10 " style="z-index: 2;">
            <div class="container-fluid ">
                <a class="navbar-brand" href=""><img src="<?=base_url('public/sources/assets/images')?>/als-logo.png" alt="" class="avatar avatar-md "></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <a class="navbar-brand fw-bold align-middle" href="" >Literacy Mapping</a>
                    <div class="ms-auto d-flex">
                        <div class="dropdown ms-2">
                            <a href="#" class="btn btn-primary d-flex align-items-center " href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white" ><path d="M0 0h24v24H0z" fill="none"/><path d="M21 3.01H3c-1.1 0-2 .9-2 2V9h2V4.99h18v14.03H3V15H1v4.01c0 1.1.9 1.98 2 1.98h18c1.1 0 2-.88 2-1.98v-14c0-1.11-.9-2-2-2zM11 16l4-4-4-4v3H1v2h10v3z"/></svg>
                                &nbsp;Sign In As
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownUser">
                                <div class="px-2 pb-0 pt-2">
                                    <ul class="list-unstyled fs-3">
                                        <li class="mb-1">
                                            <a class="dropdown-item" href="<?=base_url('staff/login')?>">
                                                <span class="material-icons align-middle">person</span>
                                                Staff
                                            </a>
                                        </li>
                                        <li class="mb-1">
                                            <a class="dropdown-item" href="<?=base_url('coordinator/login')?>">
                                                <span class="material-icons align-middle">account_circle</span>
                                                Coordinator
                                            </a>
                                        </li>

                                        <li class="mb-1">
                                            <a class="dropdown-item" href="<?=base_url('teacher/login')?>">
                                                <span class="material-icons align-middle">school</span>
                                                Teacher
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>  
                </div>
            </div>
        </nav> 
          