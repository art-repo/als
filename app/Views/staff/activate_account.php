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
        <title>Activate Account</title>
    </head>
    <body class="bg-light">
        <div class="container-fluid">
            <div class="row justify-content-center mt-15">
                <div class="col-md-5">
                    <div class="card smooth-shadow-md py-8 px-5">
                        <form action="<?=base_url('staff/activation')?>" method="post">
                            <h3 class="text-danger fw-bold mb-3">Account Activation</h3>
                            <input type="hidden" name="staff_id" value="<?=$staff_id?>">
                            <input type="hidden" name="coordinator_id" value="<?=$coordinator_id?>">
                            <label class="form-label ">Activate your Barangay Staff Account</label>
                            <div class="mb-3">
                                <label for="activation_code" class="form-label fw-bold">Activation Code: </label>
                                <input type="text" class="form-control form-control-lg text-center" placeholder="xxx-xxx-xxx" name="activation_code" id="activation_code">
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-danger">
                                    Activate Your Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center; padding-top: 100px;">
                    <small class="fw-bold text-danger">Created By: Group IA, QCU</small>
                    <br>
                    <small class="fw-bold text-danger">@2021</small>
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
            <?php if(session()->getFlashdata('success')) : ?>
                swal({
                    title: "Activation Success!",
                    text: "<?= session()->getFlashdata('success')?>",
                    icon: "success",
                    button: "Close",
                });
            <?php endif ?>
            <?php if(session()->getFlashdata('fail')) : ?>
                swal({
                    title: "Activation Failed!",
                    text: "<?= session()->getFlashdata('fail')?>",
                    icon: "error",
                    button: "Close",
                });
            <?php endif ?>
        </script>
    </body>
</html>