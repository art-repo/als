</div>
<div class="container-fluid">
    <div class="row">
        <?php if(isset($barangays) && !empty($barangays)):?>
            <?php foreach($barangays as $barangay): ?>
                <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
                    <!-- card -->
                    <div class="card">
                        <!-- Bg -->
                        <div class="pt-20 rounded-top" style="background:url(<?=base_url('public/uploads/assets/profiles') . '/' . 'default.png'?>) no-repeat; background-size: cover;">
                        
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                            <div class="d-flex align-items-center">
                                <!-- avatar-->
                                <?php if(empty($barangay['profile_img']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $barangay['profile_img']))): ?>
                                    <div class="avatar-xl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10 ">
                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xl rounded-circle" alt="">
                                    </div> 
                                <?php else: ?>
                                    <div class="avatar-xl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10 ">
                                        <img src="<?=base_url('public/uploads/assets/profiles') . '/'  . $barangay['profile_img']?>" class="avatar-xl rounded-circle" alt="">
                                    </div> 
                                <?php endif ?>
                                
                                
                            </div>
                                
                        </div>
                        <div class="card-footer bg-white px-3 pt-1">
                            <a class="link-primary m-0 fs-4" href="<?=base_url('alscoordinator/view_barangay') . '/' . $barangay['user_id']?>"><?= ucwords(strtolower($barangay['fullname']))?></a><br>
                            <small class="text-secondary m-0" >Barangay <?=ucwords(strtolower($barangay['barangay']))?> Coordinator</small>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card bg-light-primary">
                    
                </div>
            </div>
        <?php endif ?>
    </div>
</div>