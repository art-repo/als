<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="light shadow p-5 rounded">
                &laquo; <a href="<?=base_url('coordinator/staff')?>" class="text-success">
                    Go back
                </a>
                <h2 class="text-dark">Create Staff Account</h2>
                <?php if (isset($message)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action = "<?=base_url('coordinator/save')?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field();?>
                    <div class="mb-3">
                        <label for="username" class="form-text">Username</label>
                        <input type="text" name = "username" class="form-control" id="username" placeholder="Enter Username" value="<?=set_value('username')?>">
                        <small class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '';?></small>
                    </div>
                    <div class="mb-3">
                        <label for="pasword" class="form-text">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" value="<?=set_value('password')?>">
                        <small class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '';?></small>

                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-text">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Staff Email" value="<?=set_value('email')?>">
                        <small class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '';?></small>

                    </div>
                    <div class="mb-3 p-2 light shadow-sm rounded text-wrap" style="text-align: center; ">
                        <div style="border:2px dashed lightgray;" class="p-2 rounded" id="openFile">
                            <input type="file" name="image" id="image" style="visibility: hidden;display:none;">
                            <h1 class="text-success"><i class="bi bi-image"></i></h1>
                            <text class="text-secondary" id="filename">Upload image</text>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Create Account</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('#openFile').addEventListener('click', () => {
        document.querySelector('#image').click();
        
    })
    document.querySelector('#openFile').addEventListener('change', ()=>{
        document.querySelector('#filename').innerHTML = document.querySelector('#image').value;
    })
</script>
