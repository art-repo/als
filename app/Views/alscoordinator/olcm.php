<div class="container-fluid">
    <div class="row g-3">
        <?php if(isset($teachers) && is_array($teachers)): ?>
            <?php foreach($teachers as $teacher): ?>
                <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
                    <!-- card -->
                    <div class="card">
                        <!-- Bg -->
                        <div class="pt-20 rounded-top" style="background:url(<?=base_url('public/uploads/assets/profiles') . '/' . 'default.png'?>) no-repeat; background-size: cover;">
                        
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                            <div class="d-flex align-items-center">
                                <!-- avatar-->
                                <?php if(empty($teacher['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\', $teacher['image']))):?>
                                    <div class="avatar-xl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10 ">    
                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xl rounded-circle" alt="...">
                                    </div>
                                <?php else: ?>
                                    <div class="avatar-xl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10 ">    
                                        <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $teacher['image']?>" class="avatar-xl rounded-circle" alt="...">
                                    </div>
                                <?php endif ?>
                            </div>    
                        </div>
                        <div class="card-footer bg-white px-3 pt-1">
                            <a class="link-primary m-0 fs-4" href="<?=base_url('alscoordinator/view_tasks') . '/' . $teacher['user_id']?>"><?= ucwords(strtolower($teacher['fullname']))?></a><br>
                            <small class="text-secondary m-0" >Teacher</small>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>