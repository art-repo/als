
<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="fw-bold text-primary">District <?=$tch_reg['district']?></h2>
                    <h4 class="fw-bold">QUEZON CITY</h4>
                </div>
                <div class="col-md-6 p-3">
                    <form action="<?=base_url('alscoordinator/teacher_evaluated')?>" method="post">
                        <input type="hidden" name="user_id" value="<?=$tch_reg['user_id']?>">
                        <input type="hidden" name="act_code" value="<?=$tch_reg['activation_code']?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
                            <input type="text" id="username" name ="username" class="form-control" value="<?=$tch_reg['username']?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id='email' name='email' class="form-control" value="<?=$tch_reg['email']?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea type="email" id='remarks' name='remarks' class="form-control"></textarea>
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
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 p-5">
                    <img src="<?=base_url('public/uploads/assets/profiles') . '/'. $tch_reg['id_loc']?>" alt="" class="img-fluid" id="logo">
                </div>
            </div>
        </div>
    </div>
</div>