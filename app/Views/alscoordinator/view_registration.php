<div class="container">
    <h2>Registration Details</h2>
    <div class="row g-3">
        <div class="col-md-12 col-12">
            <div class="bg-white p-4 rounded shadow">
            <?php if(!empty($coordinator) || is_array($coordinator)): ?>
                <h1><?=$coordinator['barangay']?></h1>
                <h1 class="fs-3 fw-bold text-primary"><?=$coordinator['firstname']?> <?=$coordinator['lastname']?></h1>
                <h4><?=$coordinator['user_id']?></h4>
                <span class="badge bg-warning text-dark">Not Evaluated</span><br>
                <small class="fs-4">District <?=$coordinator['district']?></small>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <form action="<?=base_url('alscoordinator/save_registration')?>" method="post">
                            <input type="hidden" name="cid" id="cid" value="<?=$coordinator['user_id']?>">
                            <input type="hidden" name="act_code" id="act_code" value="<?=$coordinator['activation_code']?>">
                            <div class="mb-2">
                                <label for="username" class="form-label fw-bold">Username</label>
                                <input type="text" id="username" class="form-control" value="<?=$coordinator['username']?>" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" id="email" name = "email"class="form-control" value="<?=$coordinator['email']?>" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="message" class="form-label fw-bold">Remarks</label>
                                <textarea name="message" id="message" class="form-control" placeholder="Say something..." id="" cols="15" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="resubmit" id="resubmit">
                                    <label class="form-check-label" for="resubmit">
                                        Resubmit ID
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 p-5">
                        <div class="p-0 border border-3 rounded">
                            <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $coordinator['brgy_id_loc']?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

            <?php else: ?>

            <?php endif ?>
            </div>
        </div>
    </div>
</div>