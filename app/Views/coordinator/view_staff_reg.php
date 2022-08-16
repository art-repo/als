<div class="row mt-6">
    <div class="col-md-12 col-12 p-4">
        <div class="card bg-white p-4" >
            <h1 class="text-primary"><?=$c_contact['barangay']?></h1>
            <h3><?=$staff['fullname']?></h3>
            <h4><?=$staff['user_id']?></h4>
            <hr>
            <div class="row">
                <div class="col-md-6 p-4">
                    <form action="<?=base_url('coordinator/save_evaluation')?>" method="post">
                    
                        <input type="hidden" name="act_code" value="<?=$staff['activation_code']?>">
                        <input type="hidden" name="staff_id" value="<?=$staff['user_id']?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username: </label>
                            <input type="text" name="username" id="username" class="form-control" value="<?=$staff['username']?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="email" name="email" id="email" class="form-control" value="<?=$staff['email']?>" readonly>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="resubmit" id="resubmit">
                                <label class="form-check-label" for="resubmit">
                                    Resubmit ID
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="15" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 p-4">
                    <?php if(!empty($staff['brgy_id_loc']) || file_exists( FCPATH . '\\uploads\\assets\\profiles\\' . str_replace('/', '\\',  $staff['brgy_id_loc']))):?>
                        <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $staff['brgy_id_loc']?>" class="img-fluid rounded border border-4 border-white-color-40">
                    <?php else: ?>
                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="img-fluid rounded border border-4 border-white-color-40" alt="">
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>