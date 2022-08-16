            <form id="form">
                <?=csrf_field();?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name = "username" class="form-control" id="username" placeholder="Enter Username" value="<?=set_value('username')?>">
                    <small class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '';?></small>
                </div>
                <div class="mb-3">
                    <label for="pasword" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" value="<?=set_value('password')?>">
                    <small class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '';?></small>
                    <br>
                    <button type="button" class="btn btn-warning btn-sm">
                        <i class="bi bi-key-fill" style="font-size: 1rem;"></i>
                    </button>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Create Account</button>
                </div>
            </form>

            <script>
                document.getElementById('form').addEventListener('submit', function(e){
                    e.preventDefault();
                    const staffForm = new FormData(this);
                    fetch("<?=base_url('coordinator/save')?>", {
                        method: "post",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: staffForm
                    }).then((Response) =>{
                        return Response.text();
                    }).then((text)=>{
                        document.getElementById('form').innerHTML = text;
                    })
                })
                
            </script>