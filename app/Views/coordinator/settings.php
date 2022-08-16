<style>
    .file_tab{
        width:100%;
        box-sizing: border-box;
        text-align: center;
        outline: 3px dashed lightgray;   
    }
    .file_tab:hover{
        outline: 3px dashed var(--bs-success);   
    }
</style>

<div class="container-fluid pt-4">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="">
                <h4 class="fw-bold py-3">General</h4>
                <ul class="nav nav-pills">
                    <li class="nav-item mx-1">
                        <a class="nav-link active" href="#logo_pane">
                            Edit Logo
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link active" href="#cover_photo_pane">
                            Edit Cover Photo
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link active" href="#edit_brgy_info">
                            Edit Barangay Info
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="col-md-3" id="">
            <div class="py-4">
                <h5 class="fw-bold fs-4">General Setting</h5>
                <p class="text-secondary">Barangay Profile Configuration Settings</p>
            </div>
        </div>
        <div class="col-md-9" id="logo_pane">
            <div class="card bg-white shadow rounded p-4">
                <h5 class="text-primary fs-4 fw-bold">Barangay Logo</h5>
                <form action="<?=base_url('coordinator/edit_logo')?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="row gy-3">
                            <div class="col-md-3 align-items-center">
                                <label for="" class="form-label">Logo</label>
                            </div>
                            <div class="col-md-2">
                                <div class="py-3">
                                    <?php if(empty($brgy_profile['logo']) || !file_exists( FCPATH . 'uploads/assets/profiles/' .  $brgy_profile['logo'])) : ?>
                                            <span class="text-green-3">No Photo</span>
                                    <?php else: ?>
                                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo']?>" alt="" class="img-fluid rounded-circle">
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-md-7"></div>
                            <div class="col-md-3">
                                <label for="insert_logo" class="form-label mb-1"><i class="bi bi-file-arrow-up"></i> Update Logo</label>
                            </div>
                            <div class="col-md-9">
                                <div class="rounded border p-2 mb-3">
                                    <div class="file_tab p-3 rounded" id = "insert_logo">
                                        <input type="file" name="logo" id="logo" accept="image/png, image/jpeg" style="visibility: hidden;display:none;">
                                        <span class="form-text fs-5"><i class="bi bi-cloud-upload"></i> Insert Logo</span><br>
                                        <span class="form-text" id="logo_loc"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-9" id="cover_photo_pane">
            <div class=" card bg-white shadow rounded p-4">
                <h5 class="text-primary fs-4 fw-bold">Barangay Cover Photo</h5>
                <form action="<?=base_url('coordinator/edit_cover_photo')?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="row gy-3">
                            <div class="col-md-3">
                                <label for="insert_cover_photo" class="form-label mb-1"><i class="bi bi-file-arrow-up"></i> Cover Photo</label>
                            </div>
                            <div class="col-md-9">
                                <?php if($brgy_profile['cover_photo'] == ""): ?>
                                            <span class="text-green-3">No Photo</span>
                                <?php else: ?>
                                            <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['cover_photo']?>" alt="" class="img-fluid rounded">
                                <?php endif ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="insert_cover_photo" class="form-label mb-1"><i class="bi bi-file-arrow-up"></i>Update Cover Photo</label>
                            </div>
                            <div class="col-md-9">
                                <div class="rounded border p-2 mb-3">
                                    <div class="file_tab p-3 rounded" id = "insert_cover_photo">
                                        <input type="file" name="cover_photo" id="cover_photo" accept="image/png, image/jpeg" style="visibility: hidden;display:none;">
                                        <span class="form-text fs-5"><i class="bi bi-cloud-upload"></i> Insert Cover Photo</span><br>
                                        <span class="form-text" id="cover_photo_loc"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-9" id="edit_brgy_info">
            <div class="card bg-white shadow rounded p-4">
                <h5 class="text-primary fs-4 fw-bold">Barangay Information</h5>
                <form action="<?=base_url('coordinator/edit_settings')?>" method="post" enctype="multipart/form-data">
                    <div class="row gy-3">
                        <div class="col-md-3 text-middle">
                            <label for="barangay" class="form-label"><i class="bi bi-building"></i> Barangay</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="barangay" id="barangay" class="form-control" 
                            value = "<?=$brgy_profile['barangay'];?>" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="about" class="form-label"><i class="bi bi-card-text"></i> About</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="about" id="about" class="form-control" rows="3">
                            <?=empty($brgy_profile['about']) ? '' : $brgy_profile['about'];?>
                            </textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="address" class="form-label"><i class="bi bi-card-text"></i> Address</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="address" id="address" class="form-control" rows="3" value="<?=empty($brgy_profile['address']) ? '' : $brgy_profile['address'];?>">
                        </div>
                        <div class="col-md-3">
                            <label for="contact_no" class="form-label"><i class="bi bi-telephone"></i> Tel no. or Cell no.</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="contact_no" id="contact_no" class="form-control" value="<?=empty($brgy_profile['contact_no']) ? '' : $brgy_profile['contact_no'];?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="bi bi-clock"></i> Working Hours</label>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="from" class="form-label">From: </label>
                                    <input type="text" class="form-control" name="from" id="from" placeholder="8am" value="<?=empty($brgy_profile['from']) ? '' : $brgy_profile['from'];?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="to" class="form-label">To:</label>
                                    <input type="text" class="form-control" name="to" id="to" placeholder="7pm" value="<?=empty($brgy_profile['to']) ? '' : $brgy_profile['to'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email</label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" name="email" id="email" class="form-control" placeholder="e.g. example@mail.com" value="<?=empty($brgy_profile['email']) ? '' : $brgy_profile['email'];?>">
                        </div>
                        <div class="col-md-3">
                            <label for="facebook_page" class="form-label"><i class="bi bi-facebook"></i> Facebook</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="facebook_page" id="facebook_page" class="form-control" placeholder="e.g. https://www.facebook.com/brgy.hills" value="<?=empty($brgy_profile['facebook_page']) ? '' : $brgy_profile['facebook_page'];?>">
                        </div>
                        <div class="col-md-3">
                            <label for="official_web" class="form-label"><i class="bi bi-globe"></i> Official Website</label>
                        </div>
                        <div class="col-md-9">
                            <input type="url" name="official_web" id="official_web" class="form-control" placeholder="e.g. www.brgy.com" value="<?=empty($brgy_profile['official_web']) ? '' : $brgy_profile['official_web'];?>">
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const insert_logo = document.querySelector('#insert_logo');
    const logo = document.querySelector('#logo');
    const logo_loc = document.querySelector('#logo_loc');

    const insert_cover_photo = document.querySelector('#insert_cover_photo');
    const cover_photo = document.querySelector('#cover_photo');
    const cover_photo_loc = document.querySelector('#cover_photo_loc');

    insert_logo.addEventListener('click', ()=>{
        logo.click();
        
    })
    logo.addEventListener('change', ()=>{
        logo_loc.innerHTML = logo.value;
    })
    insert_cover_photo.addEventListener('click', ()=>{
        cover_photo.click();
        
    })
    cover_photo.addEventListener('change', ()=>{
        cover_photo_loc.innerHTML = cover_photo.value;
    })
</script>