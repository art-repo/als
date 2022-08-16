    <h3 class="fw-bold text-dark">BARANGAYS</h3>
</div>
<div class="container-fluid">
    <div class="row g-3">
        <?php if(isset($barangays) && is_array($barangays)): ?>
            <?php foreach($barangays as $barangay): ?>
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                    <!-- card -->
                    <div class="card">
                        
                        <!-- Bg -->
                        <?php if(empty($barangay['profile_img']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . '/' . $barangay['profile_img'])):?>
                            <div class="pt-20 rounded-top" style="background:url(<?=base_url('public/uploads/assets/profiles') . '/' . 'default.png'?>) no-repeat; background-size: cover;">
                                
                            </div>
                        <?php else: ?>
                            <div class="pt-20 rounded-top" style="background:url(<?=base_url('public/uploads/assets/profiles') . '/' . $barangay['cover_photo']?>) no-repeat; background-size: cover;"></div>
                        <?php endif ?>
                        
                        <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                            <div class="d-flex align-items-center">
                                <!-- avatar-->
                                <?php if(empty($barangay['profile_img']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . '/' . $barangay['profile_img'])):?>
                                    <div class="avatar-xl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10 ">    
                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xl rounded-circle" alt="...">
                                    </div>
                                <?php else: ?>
                                    <div class="avatar-xl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10 ">    
                                        <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $barangay['profile_img']?>" class="avatar-xl rounded-circle" alt="...">
                                    </div>
                                <?php endif ?>
                            </div>    
                        </div>
                        <div class="card-footer bg-white px-3 pt-1">
                            <!-- <a class="link-primary m-0 fs-4" href="< ?=base_url('alscoordinator/view_tasks') . '/' . $barangay['user_id']?>"><?= ucwords(strtolower($barangay['fullname']))?></a><br> -->
                           
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="pt-0">
                                    <a class="link-primary m-0 fs-4" href="#"><?= ucwords(strtolower($barangay['fullname']))?></a><br>
                                    <small class="text-secondary m-0" ><?=$barangay['barangay']?></small>
                                </div>
                                <div class="mt-n20">
                                    <!-- dropdown -->
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted text-primary-hover" id="dropdownprojectFive" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="more-vertical" class="icon-xs"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownprojectFive">
                                            <a class="dropdown-item" href="<?=base_url('alscoordinator/reports') . '/' . $barangay['user_id']?>">Reports</a>
                                            <a class="dropdown-item" href="<?=base_url('alscoordinator/barangay_settings') . '/' . $barangay['user_id']?>">Settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

    