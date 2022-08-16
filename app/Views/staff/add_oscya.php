            
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h2 class="text-primary">Online Community Literacy Mapping</h2>
                    <p class="form-label">
                        
                    </p>
                </div>
                <div class="card col-md-10 p-4 my-2">
                    <form id="oscya_form" method="post" action="<?=base_url('staff/save_oscya')?>">
                        <?= csrf_field()?>
                        <!-- < ?php if(isset($validation)):?>
                            < ?=$validation->listErrors();?>
                        < ?php endif ?> -->
                        <h4 class="text-primary mt-5">I. Personal Information</h4>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for = "lastname" style="font-size: 1rem;">Last Name </label><small class="text-danger fw-bold" style="font-size: 14px;"> * </small>
                                    <?php if(isset($validation) && $validation->hasError('lastname')): ?>
                                        <input type="text" class="form-control border-danger text-danger" id="lastname" name="lastname" placeholder = "Enter Lastname" value="<?=set_value('lastname')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('lastname') == false): ?>
                                        <input type="text" class="form-control border-success text-success" id="lastname" name="lastname" placeholder = "Enter Lastname" value="<?=set_value('lastname')?>">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder = "Enter Lastname" value="<?=set_value('lastname')?>">
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <!-- < ?= $validation->hasError('lastname') ? $validation->getError('lastname') : ''?> -->
                                        <?php if(isset($validation) && $validation->hasError('lastname')): ?> 
                                            <?=$validation->getError('lastname')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'lastname') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for = "firstname" style="font-size: 1rem;">First Name </label><small class="text-danger">*</small>
                                    <?php if(isset($validation) && $validation->hasError('firstname')): ?>
                                        <input type="text" class="form-control border-danger text-danger" id="firstname" name="firstname" placeholder = "Enter Firstname" value="<?=set_value('firstname')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('firstname') == false): ?>
                                        <input type="text" class="form-control border-success text-success" id="firstname" name="firstname" placeholder = "Enter Firstname" value="<?=set_value('firstname')?>">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder = "Enter Firstname" value="<?=set_value('firstname')?>">
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <!-- < ?= $validation->hasError('lastname') ? $validation->getError('lastname') : ''?> -->
                                        <?php if(isset($validation) && $validation->hasError('firstname')): ?> 
                                            <?=$validation->getError('firstname')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'firstname') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="middlename" style="font-size: 1rem;">Middle Name </label><small class="text-danger">*</small>
                                    <?php if(isset($validation) && $validation->hasError('middlename')): ?>
                                        <input type="text" class="form-control border-danger text-danger" id="middlename" name="middlename" placeholder = "Enter Middlename" value="<?=set_value('middlename')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('middlename') == false): ?>
                                        <input type="text" class="form-control border-success text-success" id="middlename" name="middlename" placeholder = "Enter Middlename" value="<?=set_value('middlename')?>">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder = "Enter Middlename" value="<?=set_value('middlename')?>">
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('middlename')): ?> 
                                            <?=$validation->getError('middlename')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'middlename') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label class="form-label" for="extension" style="font-size: 1rem;">Name Extension </label><small class="text-danger"></small>
                                    <select class="form-select" name="extension" id = "extension" value="<?=set_value('extension')?>">
                                        <option value="" selected>Suffix</option>
                                        <option value="Jr." <?=set_select('extension', "Jr.")?>>Jr.</option>
                                        <option value="Snr." <?=set_select('extension', "Snr.")?>>Snr.</option>
                                        <option value="I" <?=set_select('extension', "I")?>>I</option>
                                        <option value="II" <?=set_select('extension', "II")?>>II</option>
                                        <option value="III" <?=set_select('extension', "III")?>>III</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="birthdate" style="font-size: 1rem;">Date of Birth </label><small class="text-danger">*</small>
                                    <?php if(isset($validation) && $validation->hasError('birthdate')): ?> 
                                        <input type="date" name="birthdate" id="birthdate" class="form-control border-danger text-danger" value="<?=set_value('birthdate')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('birthdate') == false): ?>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control border-success text-success" value="<?=set_value('birthdate')?>">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?=set_value('birthdate')?>">
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('birthdate')): ?> 
                                            <?=$validation->getError('birthdate')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'birthdate') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label class="form-label" for="age" style="font-size: 1rem;">Age </label><small class="text-danger">*</small>
                                    <?php if(isset($validation) && $validation->hasError('age')): ?> 
                                        <input type="text" name="age" id="age" class="form-control border-danger text-danger" value="<?=set_value('age')?>" maxlength = "3" readonly>
                                    <?php elseif(isset($validation) && $validation->hasError('age') == false): ?> 
                                        <input type="text" name="age" id="age" class="form-control border-success text-success" value="<?=set_value('age')?>" maxlength = "3" readonly>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="age" id="age" class="form-control" value="<?=set_value('age')?>" maxlength = "3" readonly>
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('age')): ?> 
                                            <?=$validation->getError('age')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'age') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="gender" style="font-size: 1rem;">Gender </label><small class="text-danger">*</small>
                                    <?php if(isset($validation) && $validation->hasError('gender')): ?> 
                                        <select class="form-select border-danger text-danger" name="gender" id = "gender" value="<?=set_value('gender')?>">
                                            <option value="" selected>Gender</option>
                                            <option value="male" <?=set_select('gender', "male")?>>Male</option>
                                            <option value="female" <?=set_select('gender', "Female")?>>Female</option>
                                        </select>
                                    <?php elseif(isset($validation) && $validation->hasError('gender') == false): ?> 
                                        <select class="form-select border-success text-success" name="gender" id = "gender" value="<?=set_value('gender')?>">
                                            <option value="" selected>Gender</option>
                                            <option value="male" <?=set_select('gender', "male")?>>Male</option>
                                            <option value="female" <?=set_select('gender', "Female")?>>Female</option>
                                        </select>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?> 
                                        <select class="form-select" name="gender" id = "gender">
                                            <option value="" selected>Gender</option>
                                            <option value="male" <?=set_select('gender', "male")?>>Male</option>
                                            <option value="female" <?=set_select('gender', "Female")?>>Female</option>
                                        </select>
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('gender')): ?> 
                                            <?=$validation->getError('gender')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'gender') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="civil_status" style="font-size: 1rem;">Civil Status </label><small class="text-danger">*</small>
                                    <?php if(isset($validation) && $validation->hasError('civil_status')): ?> 
                                        <select class="form-select border-danger text-danger" name="civil_status" id = "civil_status" value="<?=set_value('civil_status')?>">
                                            <option value="" selected>Civil Status</option>
                                            <option value="Single" <?=set_select('civil_status', "Single")?>>Single</option>
                                            <option value="Married" <?=set_select('civil_status', "Married")?>>Married</option>
                                            <option value="Separated" <?=set_select('civil_status', "Separated")?>>Separated</option>
                                            <option value="Devorced" <?=set_select('civil_status', "Devorced")?>>Devorced</option>
                                            <option value="Widowed" <?=set_select('civil_status', "Widowed")?>>Widowed</option>
                                        </select>
                                    <?php elseif(isset($validation) && $validation->hasError('civil_status')==false): ?> 
                                        <select class="form-select border-success text-success" name="civil_status" id = "civil_status" value="<?=set_value('civil_status')?>">
                                            <option value="" selected>Civil Status</option>
                                            <option value="Single" <?=set_select('civil_status', "Single")?>>Single</option>
                                            <option value="Married" <?=set_select('civil_status', "Married")?>>Married</option>
                                            <option value="Separated" <?=set_select('civil_status', "Separated")?>>Separated</option>
                                            <option value="Devorced" <?=set_select('civil_status', "Devorced")?>>Devorced</option>
                                            <option value="Widowed" <?=set_select('civil_status', "Widowed")?>>Widowed</option>
                                        </select>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else:?>
                                        <select class="form-select" name="civil_status" id = "civil_status" value="<?=set_value('civil_status')?>">
                                            <option value="" selected>Civil Status</option>
                                            <option value="Single" <?=set_select('civil_status', "Single")?>>Single</option>
                                            <option value="Married" <?=set_select('civil_status', "Married")?>>Married</option>
                                            <option value="Separated" <?=set_select('civil_status', "Separated")?>>Separated</option>
                                            <option value="Devorced" <?=set_select('civil_status', "Devorced")?>>Devorced</option>
                                            <option value="Widowed" <?=set_select('civil_status', "Widowed")?>>Widowed</option>
                                        </select>
                                    <?php endif?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('civil_status')): ?> 
                                            <?=$validation->getError('civil_status')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'civil_status') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="religion" style="font-size: 1rem;">Religion </label><small class="text-danger">*</small>
                                    <input type="text" name="religion" class ="form-control" id="religion" value="<?=set_value('religion')?>" placeholder="Religion">
                                </div>
                            </div>
                        </div>
                        <h4 class="text-primary mt-5">II. Contact Information</h4>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="">
                                    <label class="form-label mb-0" for="email" style="font-size: 1rem;">Email </label>
                                    <small class="form-text text-primary fw-bold" style="font-size: 12px;">( Optional )</small>
                                    <input type="email" name="email" class ="form-control" id="email" placeholder="Enter Email" value="<?=set_value('name')?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="">
                                    <label class="form-label mb-0" for="facebook" style="font-size: 1rem;">Facebook </label>
                                    <small class="form-text text-primary fw-bold" style="font-size: 12px;">( Optional )</small>
                                    <input type="text" name="facebook" class ="form-control" id="facebook" placeholder="Enter Facebook" value="<?=set_value('facebook')?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="">
                                    <label class="form-label" for="contact" style="font-size: 1rem;">Personal Mobile</label>
                                    <small class="form-text text-primary fw-bold" style="font-size: 12px;">( Optional )</small>
                                    <input type="text" name="contact" class ="form-control" id="contact" placeholder="+63" value="<?=set_value('contact')?>" minlength="13" maxlength="13">
                                    <!-- <span class="text-danger">
                                        < ?php if(isset($validation) && $validation->hasError('contact')): ?> 
                                            < ?=$validation->getError('contact')?>
                                        < ?php endif ?>
                                    </span> -->
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'contact') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="">
                                    <label class="fs-5 fw-bold"><i class="bi bi-house" ></i> Present Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="street">No./Unit/Bldg./Street <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('street')): ?> 
                                        <input type="text" name="street" class ="form-control border-danger text-danger" id="street" placeholder="Street/Building" value="<?=set_value('street')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('street')==false): ?> 
                                        <input type="text" name="street" class ="form-control border-success text-success" id="street" placeholder="Street/Building" value="<?=set_value('street')?>">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="street" class ="form-control" id="street" placeholder="Street/Building" value="<?=set_value('street')?>">
                                    <?php endif?> 
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('street')): ?> 
                                            <?=$validation->getError('street')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'street') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label" for="barangay">Barangay <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('barangay')): ?> 
                                        <input type="text" name="barangay" class ="form-control border-danger text-danger" id="barangay" placeholder="Barangay" value="<?=$contact['barangay']?>" readonly>
                                    <?php elseif(isset($validation) && $validation->hasError('barangay') == false): ?> 
                                        <input type="text" name="barangay" class ="form-control border-success text-success" id="barangay" placeholder="Barangay" value="<?=$contact['barangay']?>" readonly>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="barangay" class ="form-control" id="barangay" placeholder="Barangay" value="<?=$contact['barangay']?>" readonly>
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('barangay')): ?> 
                                            <?=$validation->getError('barangay')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'barangay') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="district">District <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('district')): ?> 
                                        <input type="text" name="district" id="district" class="form-control border-danger text-danger" placeholder="District" value="<?=$contact['district']?>" readonly>
                                    <?php elseif(isset($validation) && $validation->hasError('district')==false): ?>
                                        <input type="text" name="district" id="district" class="form-control border-success text-success" placeholder="District" value="<?=$contact['district']?>" readonly>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="district" id="district" class="form-control" placeholder="District" value="<?=$contact['district']?>" readonly>
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('district')): ?> 
                                            <?=$validation->getError('district')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'district') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label" for="city">City <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('city')): ?> 
                                        <input type="text" name="city" class ="form-control border-danger text-danger" id="city" placeholder="City" value = "Quezon City" value="<?=set_value('city')?>" readonly>
                                    <?php elseif(isset($validation) && $validation->hasError('city')==false): ?> 
                                        <input type="text" name="city" class ="form-control border-success text-success" id="city" placeholder="City" value = "Quezon City" value="<?=set_value('city')?>" readonly>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="city" class ="form-control" id="city" placeholder="City" value = "Quezon City" value="<?=set_value('city')?>" readonly>
                                    <?php endif?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('city')): ?> 
                                            <?=$validation->getError('city')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'city') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label class="form-label" for="state">State <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('state')): ?> 
                                        <input type="text" name="state" class ="form-control border-danger text-danger" id="state" placeholder="State" value = "Philippines" value="<?=set_value('state')?>" readonly>
                                    <?php elseif(isset($validation) && $validation->hasError('state')==false): ?> 
                                        <input type="text" name="state" class ="form-control border-success text-success" id="state" placeholder="State" value = "Philippines" value="<?=set_value('state')?>" readonly>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="state" class ="form-control" id="state" placeholder="State" value = "Philippines" value="<?=set_value('state')?>" readonly>
                                    <?php endif ?>
                                    <span class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('state')): ?> 
                                            <?=$validation->getError('state')?>
                                        <?php endif ?>
                                    </span>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'state') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label class="form-label" for="zipcode">Zipcode <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('zipcode')): ?> 
                                        <input type="text" name="zipcode" class ="form-control border-danger text-danger" id="zipcode" placeholder="Zip code" value="<?=$contact['zip_code']?>" maxlength="4" readonly>
                                    <?php elseif(isset($validation) && $validation->hasError('zipcode') == false): ?> 
                                        <input type="text" name="zipcode" class ="form-control border-success text-success" id="zipcode" placeholder="Zip code" value="<?=$contact['zip_code']?>" maxlength="4" readonly>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="zipcode" class ="form-control" id="zipcode" placeholder="Zip code" value="<?=$contact['zip_code']?>" maxlength="4" readonly>
                                    <?php endif ?>
                                    <span class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('zipcode')): ?> 
                                            <?=$validation->getError('zipcode')?>
                                        <?php endif ?>
                                    </span>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'zipcode') : '';?></span> -->
                                </div>
                            </div>

                        </div>
                        
                        
                        <!-- <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="sameAddress">
                                <label class="form-check-label" for="sameAddress">
                                    Same as home address
                                </label>
                            </div>
                        </div> -->
                        <!-- <div class="mb-3">
                            <label class="><i class="bi bi-house"></i> Permanent Address</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-text" for="pstreet">No./Unit/Bldg./Street <small class="text-danger">*</small></label>
                            <input type="text" name="pstreet" class ="form-control" id="pstreet" placeholder="Street/Building" value="< ?=set_value('pstreet')?>">
                            <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'pstreet') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-text" for="pbarangay">Barangay <small class="text-danger">*</small></label>
                            <input type="text" name="pbarangay" class ="form-control" id="pbarangay" placeholder="Barangay" value="< ?=set_value('pbarangay')?>">
                            <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'pbarangay') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-text" for="pdistrict">District <small class="text-danger">*</small></label>
                            <input type="text" name="pdistrict" class ="form-control" id="pdistrict" placeholder="Permanent District" value="< ?=set_value('pdistrict')?>">
                            <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'pdistrict') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-text" for="pcity">City <small class="text-danger">*</small></label>
                            <input type="text" name="pcity" class ="form-control" id="pcity" placeholder="City" value="< ?=set_value('pcity')?>">
                            <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'pcity') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-text" for="pstate">State <small class="text-danger">*</small></label>
                            <input type="text" name="pstate" class ="form-control" id="pstate" placeholder="State" value="<?=set_value('pstate')?>">
                            <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'pstate') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-text" for="pzipcode">Zipcode <small class="text-danger">*</small></label>
                            <input type="number" name="pzipcode" class ="form-control" id="pzipcode" placeholder="Zip code" value="<?=set_value('pzipcode')?>">
                            <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'pzipcode') : '';?></span>
                        </div> -->
                        <h4 class="text-primary mt-5">III. Guardian's Information</h4>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="">
                                    <label class="form-label" for="gfullname">Fullname <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('gfullname')): ?> 
                                        <input type="text" name="gfullname" class ="form-control border-danger text-danger" id="gfullname" placeholder="Fullname" value="<?=set_value('gfullname')?>">
                                    <?php elseif(isset($validation) && $validation->hasError('gfullname')==false): ?> 
                                        <input type="text" name="gfullname" class ="form-control border-success text-success" id="gfullname" placeholder="Fullname" value="<?=set_value('gfullname')?>">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="gfullname" class ="form-control" id="gfullname" placeholder="Fullname" value="<?=set_value('gfullname')?>">

                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('gfullname')): ?> 
                                            <?=$validation->getError('gfullname')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'gfullname') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label" for="gcontact">Contact no. <small class="text-danger">*</small></label>
                                    <?php if(isset($validation) && $validation->hasError('gcontact')): ?> 
                                        <input type="text" name="gcontact" class ="form-control border-danger text-danger" id="gcontact" placeholder="Please input 11 digits" value="<?=set_value('gcontact')?>"  minlength="12" maxlength="12">
                                    <?php elseif(isset($validation) && $validation->hasError('gcontact')==false): ?>  
                                        <input type="text" name="gcontact" class ="form-control border-success text-success" id="gcontact" placeholder="Please input 11 digits" value="<?=set_value('gcontact')?>"  minlength="12" maxlength="12">
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <input type="text" name="gcontact" class ="form-control" id="gcontact" placeholder="Please input 11 digits" value="<?=set_value('gcontact')?>"  minlength="12" maxlength="12">
                                    <?php endif ?>

                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('gcontact')): ?> 
                                            <?=$validation->getError('gcontact')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'gcontact') : '';?></span> -->
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- <div class="mb-3">
                            <label class="form-text" for="gemail">Email <small class="text-danger">Leave Blank if not available</small></label>
                            <input type="email" name="gemail" class ="form-control" id="gemail" placeholder="Enter Email" value="< ?=set_value('gemail')?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-text" for="gfacebook">Facebook <small class="text-danger">Leave Blank if not available</small></label>
                            <input type="text" name="gfacebook" class ="form-control" id="gfacebook" placeholder="Enter Facebook" value="< ?=set_value('gfacebook')?>">
                        </div> -->
                        
                        <h4 class="text-primary mt-5">IV. Mapping/Self-Assessment</h4>
                        <hr>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label mb-0" for="educ_attainment">Educational Attainment. <small class="text-danger">*</small></label>
                                <div class="">
                                    <label class="form-text">(Highest educational attainment of OSCYA applicant)</label>
                                    <?php if(isset($validation) && $validation->hasError('educ_attainment')): ?> 
                                        <select class="form-select border-danger text-danger" name="educ_attainment" id = "educ_attainment" value="<?=set_value('educ_attainment')?>">
                                            <option value="" selected>Select</option>
                                            <option value="Kinder" <?=set_select('educ_attainment', "Kinder")?>>Kinder</option>
                                            <option value="1" <?=set_select('educ_attainment', "1")?>>Grade 1</option>
                                            <option value="2" <?=set_select('educ_attainment', "2")?>>Grade 2</option>
                                            <option value="3" <?=set_select('educ_attainment', "3")?>>Grade 3</option>
                                            <option value="4" <?=set_select('educ_attainment', "4")?>>Grade 4</option>
                                            <option value="5" <?=set_select('educ_attainment', "5")?>>Grade 5</option>
                                            <option value="6" <?=set_select('educ_attainment', "6")?>>Grade 6</option>
                                            <option value="7" <?=set_select('educ_attainment', "7")?>>Grade 7 / 1st Year</option>
                                            <option value="8" <?=set_select('educ_attainment', "8")?>>Grade 8 / 2nd Year</option>
                                            <option value="9" <?=set_select('educ_attainment', "9")?>>Grade 9 / 3rd Year</option>
                                            <option value="10" <?=set_select('educ_attainment', "10")?>>Grade 10 / 4th Year</option>
                                        </select>
                                    <?php elseif(isset($validation) && $validation->hasError('educ_attainment') == false): ?> 
                                        <select class="form-select border-success text-success" name="educ_attainment" id = "educ_attainment" value="<?=set_value('educ_attainment')?>">
                                            <option value="" selected>Select</option>
                                            <option value="Kinder" <?=set_select('educ_attainment', "Kinder")?>>Kinder</option>
                                            <option value="1" <?=set_select('educ_attainment', "1")?>>Grade 1</option>
                                            <option value="2" <?=set_select('educ_attainment', "2")?>>Grade 2</option>
                                            <option value="3" <?=set_select('educ_attainment', "3")?>>Grade 3</option>
                                            <option value="4" <?=set_select('educ_attainment', "4")?>>Grade 4</option>
                                            <option value="5" <?=set_select('educ_attainment', "5")?>>Grade 5</option>
                                            <option value="6" <?=set_select('educ_attainment', "6")?>>Grade 6</option>
                                            <option value="7" <?=set_select('educ_attainment', "7")?>>Grade 7 / 1st Year</option>
                                            <option value="8" <?=set_select('educ_attainment', "8")?>>Grade 8 / 2nd Year</option>
                                            <option value="9" <?=set_select('educ_attainment', "9")?>>Grade 9 / 3rd Year</option>
                                            <option value="10" <?=set_select('educ_attainment', "10")?>>Grade 10 / 4th Year</option>
                                        </select>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <select class="form-select" name="educ_attainment" id = "educ_attainment" value="<?=set_value('educ_attainment')?>">
                                            <option value="" selected>Select</option>
                                            <option value="Kinder" <?=set_select('educ_attainment', "Kinder")?>>Kinder</option>
                                            <option value="1" <?=set_select('educ_attainment', "1")?>>Grade 1</option>
                                            <option value="2" <?=set_select('educ_attainment', "2")?>>Grade 2</option>
                                            <option value="3" <?=set_select('educ_attainment', "3")?>>Grade 3</option>
                                            <option value="4" <?=set_select('educ_attainment', "4")?>>Grade 4</option>
                                            <option value="5" <?=set_select('educ_attainment', "5")?>>Grade 5</option>
                                            <option value="6" <?=set_select('educ_attainment', "6")?>>Grade 6</option>
                                            <option value="7" <?=set_select('educ_attainment', "7")?>>Grade 7 / 1st Year</option>
                                            <option value="8" <?=set_select('educ_attainment', "8")?>>Grade 8 / 2nd Year</option>
                                            <option value="9" <?=set_select('educ_attainment', "9")?>>Grade 9 / 3rd Year</option>
                                            <option value="10" <?=set_select('educ_attainment', "10")?>>Grade 10 / 4th Year</option>
                                        </select>
                                    <?php endif ?>
                                    <small class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('educ_attainment')): ?> 
                                            <?=$validation->getError('educ_attainment')?>
                                        <?php endif ?>
                                    </small>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'educ_attainment') : '';?></span> -->
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <label class="form-label mb-0" for="reason">Reason <span class="text-danger">*</span></label><br>
                                <div class="">
                                    <label class="form-text">(Reason for Dropping out/ Not Enrolling.)</label>
                                    <?php if(isset($validation) && $validation->hasError('reason')): ?>
                                        <select class="form-select border-danger text-danger" name="reason" id = "reason" value="<?=set_value('reason')?>">
                                            <option value="" selected>Select</option>
                                            <option value="Lack of Personal Interest" <?=set_select('reason', "Lack of Personal Interest")?>>Lack of Personal Interest</option>
                                            <option value="Family Related Concerns" <?=set_select('reason', "Lack of Personal Interest")?>>Family Related Concerns</option>
                                            <option value="Employment"<?=set_select('reason', "Employment")?>>Employment</option>
                                            <option value="Early Pregnancy" <?=set_select('reason', "Early Pregnancy")?>>Early Pregnancy</option>
                                            <option value="Disability" <?=set_select('reason', "Disability")?>>Disability</option>
                                            <option value="Disease" <?=set_select('reason', "Disease")?>>Disease</option>
                                            <option value="Distance of the School" <?=set_select('reason', "Distance of the School")?>>Distance of the School</option>
                                            <option value="Cannot Cope with School Works" <?=set_select('reason', "Cannot Cope with School Works")?>>Cannot Cope with School Works</option>
                                            <option value="Financial Problems" <?=set_select('reason', "Financial Problems")?>>Financial Problems</option>
                                            <option value="Others" <?=set_select('reason', "Others")?>>Other reason</option>
                                        </select>
                                    <?php elseif(isset($validation) && $validation->hasError('reason') == false): ?>
                                        <select class="form-select border-success text-success" name="reason" id = "reason" value="<?=set_value('reason')?>">
                                            <option value="" selected>Select</option>
                                            <option value="Lack of Personal Interest" <?=set_select('reason', "Lack of Personal Interest")?>>Lack of Personal Interest</option>
                                            <option value="Family Related Concerns" <?=set_select('reason', "Lack of Personal Interest")?>>Family Related Concerns</option>
                                            <option value="Employment"<?=set_select('reason', "Employment")?>>Employment</option>
                                            <option value="Early Pregnancy" <?=set_select('reason', "Early Pregnancy")?>>Early Pregnancy</option>
                                            <option value="Disability" <?=set_select('reason', "Disability")?>>Disability</option>
                                            <option value="Disease" <?=set_select('reason', "Disease")?>>Disease</option>
                                            <option value="Distance of the School" <?=set_select('reason', "Distance of the School")?>>Distance of the School</option>
                                            <option value="Cannot Cope with School Works" <?=set_select('reason', "Cannot Cope with School Works")?>>Cannot Cope with School Works</option>
                                            <option value="Financial Problems" <?=set_select('reason', "Financial Problems")?>>Financial Problems</option>
                                            <option value="Others" <?=set_select('reason', "Others")?>>Other reason</option>
                                        </select>
                                        <small class="text-success">Looks Good!</small>
                                    <?php else: ?>
                                        <select class="form-select" name="reason" id = "reason" value="<?=set_value('reason')?>">
                                            <option value="" selected>Select</option>
                                            <option value="Lack of Personal Interest" <?=set_select('reason', "Lack of Personal Interest")?>>Lack of Personal Interest</option>
                                            <option value="Family Related Concerns" <?=set_select('reason', "Lack of Personal Interest")?>>Family Related Concerns</option>
                                            <option value="Employment"<?=set_select('reason', "Employment")?>>Employment</option>
                                            <option value="Early Pregnancy" <?=set_select('reason', "Early Pregnancy")?>>Early Pregnancy</option>
                                            <option value="Disability" <?=set_select('reason', "Disability")?>>Disability</option>
                                            <option value="Disease" <?=set_select('reason', "Disease")?>>Disease</option>
                                            <option value="Distance of the School" <?=set_select('reason', "Distance of the School")?>>Distance of the School</option>
                                            <option value="Cannot Cope with School Works" <?=set_select('reason', "Cannot Cope with School Works")?>>Cannot Cope with School Works</option>
                                            <option value="Financial Problems" <?=set_select('reason', "Financial Problems")?>>Financial Problems</option>
                                            <option value="Others" <?=set_select('reason', "Others")?>>Other reason</option>
                                        </select>
                                    <?php endif ?>
                                    <span class="text-danger">
                                        <?php if(isset($validation) && $validation->hasError('reason')): ?> 
                                            <?=$validation->getError('reason')?>
                                        <?php endif ?>
                                    </span>
                                    <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'reason') : '';?></span> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                            <label class="form-label mb-0" for="reason">Other Reason <span class="text-danger">*</span></label><br>
                                <label class="form-text" for="other_reason">For other reason, please specify. <small class="text-danger">*</small></label>
                                <textarea name="other_reason" id="other_reason" class = "form-control" cols="3" rows="3" placeholder="Other Reason, please specify..." value="<?=set_value('other_reason')?>"></textarea>
                            </div>
                            <div class="col-md-12"></div>                
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label mb-0" for="is_pwd">PWD<span class="text-danger">*</span></label><br>
                                    
                                </div>
                                <label class="form-text" for="is_pwd">(<span class="">YES</span> if OSY belongs to PWD)</label>
                                <?php if(isset($validation) && $validation->hasError('is_pwd')): ?> 
                                    <select class="form-select border-danger text-danger" name="is_pwd" id = "is_pwd" value="<?=set_value('is_pwd')?>">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_pwd', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_pwd', "0")?>>No</option>
                                    </select>
                                <?php elseif(isset($validation) && $validation->hasError('is_pwd')==false): ?> 
                                    <select class="form-select border-success text-success" name="is_pwd" id = "is_pwd" value="<?=set_value('is_pwd')?>">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_pwd', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_pwd', "0")?>>No</option>
                                    </select>
                                    <small class="text-success">Looks Good!</small>
                                <?php else: ?>
                                    <select class="form-select" name="is_pwd" id = "is_pwd" value="<?=set_value('is_pwd')?>">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_pwd', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_pwd', "0")?>>No</option>
                                    </select>
                                <?php endif ?>
                                <span class="text-danger">
                                    <?php if(isset($validation) && $validation->hasError('is_pwd')): ?> 
                                        <?=$validation->getError('is_pwd')?>
                                    <?php endif ?>
                                </span>
                                <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'is_pwd') : '';?></span> -->
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label mb-0" for="has_pwd">PWD ID <small class="text-danger">*</small></label><br>
                                </div>
                            
                                <label class="form-text" for="has_pwd">(<span class="">YES</span> if OSY have PWD ID)</label>
                                <?php if(isset($validation) && $validation->hasError('has_pwd')): ?> 
                                    <select class="form-select border-danger text-danger" name="has_pwd" id = "has_pwd" value="<?=set_value('has_pwd')?>">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('has_pwd', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('has_pwd', "0")?>>No</option>
                                    </select>
                                <?php elseif(isset($validation) && $validation->hasError('has_pwd')==false): ?> 
                                    <select class="form-select border-success text-success" name="has_pwd" id = "has_pwd" value="<?=set_value('has_pwd')?>">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('has_pwd', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('has_pwd', "0")?>>No</option>
                                    </select>
                                    <small class="text-success">Looks Good!</small>
                                <?php else: ?> 
                                    <select class="form-select" name="has_pwd" id = "has_pwd" value="<?=set_value('has_pwd')?>">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('has_pwd', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('has_pwd', "0")?>>No</option>
                                    </select>
                                <?php endif ?>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->hasError('has_pwd')): ?> 
                                        <?=$validation->getError('has_pwd')?>
                                    <?php endif ?>
                                </small>
                                <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'has_pwd') : '';?></span> -->
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label class="form-label mb-0" for="disability">Disability</label><br>
                                    <label class="form-text" for="other_disability">Select type of disability</label>
                                </div>
                                <?php if(isset($validation) && $validation->hasError('disability')): ?> 
                                    <select class="form-select border-danger text-danger" name="disability" id = "disability" value="<?=set_value('disability')?>">
                                        <option value="None" selected>Select / None</option>
                                        <option value="Intellectual Disability" <?=set_select('disability', "Intellectual Disability")?>>Intellectual Disability</option>
                                        <option value="Learning Disability" <?=set_select('disability', "Learning Disability")?>>Learning Disability</option>
                                        <option value="Autism" <?=set_select('disability', "Autism")?>>Autism</option>
                                        <option value="Blind" <?=set_select('disability', "Blind")?>>Blind</option>
                                        <option value="Deaf" <?=set_select('disability', "Deaf")?>>Deaf</option>
                                        <option value="Hard of Hearin" <?=set_select('disability', "Hard of Hearin")?>>Hard of Hearin</option>
                                        <option value="Orthopedically Impaired" <?=set_select('disability', "Orthopedically Impaired")?>>Orthopedically Impaired</option>
                                        <option value="Others" <?=set_select('disability', "Others")?>>Others</option>
                                    </select>
                                <?php elseif(isset($validation) && $validation->hasError('disability')==false): ?>
                                    <select class="form-select border-success text-success" name="disability" id = "disability" value="<?=set_value('disability')?>">
                                        <option value="None" selected>Select / None</option>
                                        <option value="Intellectual Disability" <?=set_select('disability', "Intellectual Disability")?>>Intellectual Disability</option>
                                        <option value="Learning Disability" <?=set_select('disability', "Learning Disability")?>>Learning Disability</option>
                                        <option value="Autism" <?=set_select('disability', "Autism")?>>Autism</option>
                                        <option value="Blind" <?=set_select('disability', "Blind")?>>Blind</option>
                                        <option value="Deaf" <?=set_select('disability', "Deaf")?>>Deaf</option>
                                        <option value="Hard of Hearin" <?=set_select('disability', "Hard of Hearin")?>>Hard of Hearin</option>
                                        <option value="Orthopedically Impaired" <?=set_select('disability', "Orthopedically Impaired")?>>Orthopedically Impaired</option>
                                        <option value="Others" <?=set_select('disability', "Others")?>>Others</option>
                                    </select> 
                                    <small class="text-success">Looks Good!</small>
                                <?php else: ?>
                                    <select class="form-select" name="disability" id = "disability" value="<?=set_value('disability')?>">
                                        <option value="None" selected>Select / None</option>
                                        <option value="Intellectual Disability" <?=set_select('disability', "Intellectual Disability")?>>Intellectual Disability</option>
                                        <option value="Learning Disability" <?=set_select('disability', "Learning Disability")?>>Learning Disability</option>
                                        <option value="Autism" <?=set_select('disability', "Autism")?>>Autism</option>
                                        <option value="Blind" <?=set_select('disability', "Blind")?>>Blind</option>
                                        <option value="Deaf" <?=set_select('disability', "Deaf")?>>Deaf</option>
                                        <option value="Hard of Hearin" <?=set_select('disability', "Hard of Hearin")?>>Hard of Hearin</option>
                                        <option value="Orthopedically Impaired" <?=set_select('disability', "Orthopedically Impaired")?>>Orthopedically Impaired</option>
                                        <option value="Others" <?=set_select('disability', "Others")?>>Others</option>
                                    </select> 
                                <?php endif ?>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->hasError('disability')): ?> 
                                        <?=$validation->getError('disability')?>
                                    <?php endif ?>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-text" for="other_disability">For other types of Disability, please specify</label>
                                <textarea type="text" name="other_disability" id="other_disability" class="form-control" cols="3" rows="3" placeholder="Other Disability, please specify..." value="<?=set_value('other_disability')?>"></textarea>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label mb-0">Disease</label><br>
                                </div>
                                <label class="form-text" for="disease">For Disease, please specify</label>
                                <textarea type="text" name="disease" class ="form-control" id="disease" cols="3" rows="3" placeholder="Other Disability, please specify..." value="<?=set_value('disease')?>"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label mb-0" for="is_employed">Employment Status <span class="text-danger">*</span></label>
                                </div>
                                <label class="form-text" for="is_employed">If ALS applicant is employed</label>
                                <?php if(isset($validation) && $validation->hasError('is_employed')): ?> 
                                    <select class="form-select border-danger text-danger" name="is_employed" id = "is_employed">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_employed', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_employed', "0")?>>No</option>
                                    </select>
                                <?php elseif(isset($validation) && $validation->hasError('is_employed')==false): ?> 
                                    <select class="form-select border-success text-success" name="is_employed" id = "is_employed">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_employed', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_employed', "0")?>>No</option>
                                    </select>
                                    <small class="text-success">Looks Good!</small>
                                <?php else: ?>
                                    <select class="form-select" name="is_employed" id = "is_employed">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_employed', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_employed', "0")?>>No</option>
                                    </select>
                                <?php endif ?>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->hasError('is_employed')): ?> 
                                        <?=$validation->getError('is_employed')?>
                                    <?php endif ?>
                                </small>
                                <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'is_employed') : '';?></span> -->
                            </div>
                        
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label mb-0" for="is_fps_member">4P's Member <span class="text-danger">*</span></label>
                                </div>
                                <label class="form-text" for="is_fps_member">if applicant is 4ps Member</label>
                                <?php if(isset($validation) && $validation->hasError('is_fps_member')): ?> 
                                    <select class="form-select border-danger text-danger" name="is_fps_member" id = "is_fps_member">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_fps_member', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_fps_member', "0")?>>No</option>
                                    </select>
                                <?php elseif(isset($validation) && $validation->hasError('is_fps_member')): ?> 
                                    <select class="form-select border-success text-success" name="is_fps_member" id = "is_fps_member">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_fps_member', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_fps_member', "0")?>>No</option>
                                    </select>
                                    <small class="text-success">Looks Good!</small>
                                <?php else: ?>
                                    <select class="form-select" name="is_fps_member" id = "is_fps_member">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_fps_member', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_fps_member', "0")?>>No</option>
                                    </select>
                                <?php endif ?>
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->hasError('is_fps_member')): ?> 
                                        <?=$validation->getError('is_fps_member')?>
                                    <?php endif ?>
                                </small>
                                <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'is_fps_member') : '';?></span> -->
                            </div>
                        
                            <div class="col-md-6">
                                <div class="">
                                    <label class="form-label mb-0" for="is_interested">Interested<span class="text-danger">*</span></label>
                                </div>
                            
                                <label class="form-text" for="is_interested">if applicant is interested in Deped Programs</label>
                                <?php if(isset($validation) && $validation->hasError('is_interested')): ?> 
                                    <select class="form-select border-danger text-danger" name="is_interested" id = "is_interested">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_interested', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_interested', "0")?>>No</option>
                                    </select>
                                <?php elseif(isset($validation) && $validation->hasError('is_interested')==false): ?>
                                    <select class="form-select border-success text-success" name="is_interested" id = "is_interested">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_interested', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_interested', "0")?>>No</option>
                                    </select>
                                    <small class="text-success">Looks Good!</small>
                                <?php else: ?>
                                    <select class="form-select" name="is_interested" id = "is_interested">
                                        <option value="" selected>Select</option>
                                        <option value="1" <?=set_select('is_interested', "1")?>>Yes</option>
                                        <option value="0" <?=set_select('is_interested', "0")?>>No</option>
                                    </select>
                                <?php endif ?> 
                                <small class="text-danger">
                                    <?php if(isset($validation) && $validation->hasError('is_interested')): ?> 
                                        <?=$validation->getError('is_interested')?>
                                    <?php endif ?>
                                </small>
                                <!-- <span class="text-danger">< ?= isset($validation) ? display_error($validation, 'is_interested') : '';?></span> -->
                            </div>
                        </div>
                        <div class="my-3 text-end">
                            <button type="submit" class = "btn btn-success">Save Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            
           
                swal({
                    title: "Inserted!",
                    text: "Fill all the required fields",
                    icon: "info",
                    button: "Close",
                });
            
            let osy_form = document.getElementById('oscya_form');
            osy_form.addEventListener('load', ()=>{
                swal({
                    title: "Data Privacy",
                    text: "Data Privacy Consent The RA 10173 also known as Data Privacy Act 0f 2012, under section 11. By agreeing to this form, the participant consents to the collection and retention of personal information for academic purposes only.",
                    icon: "info",
                    button: "Close",
                });
            });
            <?php if(session()->getFlashdata('success')) : ?>
                swal({
                    title: "Inserted!",
                    text: "<?= session()->getFlashdata('success')?>",
                    icon: "success",
                    button: "Close",
                });
            <?php endif ?>
            //test

            const birthdate = document.querySelector('#birthdate');
            const age = document.querySelector('#age');
            const reason = document.querySelector('#reason');
            const otherReason = document.querySelector('#other_reason');
            const isPWD = document.querySelector('#is_pwd');
            const disability = document.querySelector('#disability');
            const otherDisability = document.querySelector('#other_disability');
            const disease = document.querySelector('#disease');

            /**
            *--------------------------------------------------------------------
            */
            //for checking number inputs

            const contact = document.querySelector('#contact');
            const gcontact = document.querySelector('#gcontact');
            const zipcode = document.querySelector('#zipcode');
            const pzipcode = document.querySelector('#pzipcode');

            /**
            *--------------------------------------------------------------------
            */
            //for address

            const street = document.querySelector('#street');
            const barangay = document.querySelector('#barangay');
            const district = document.querySelector('#district');
            const city = document.querySelector('#city');
            const state = document.querySelector('#state');

            const pstreet = document.querySelector('#pstreet');
            const pbarangay = document.querySelector('#pbarangay');
            const pdistrict = document.querySelector('#pdistrict');
            const pcity = document.querySelector('#pcity');
            const pstate = document.querySelector('#pstate');

            /**
            *--------------------------------------------------------------------
            */

            //sending response copy and checking valid email constraint
            const email = document.querySelector('#email');
            const emailCopy = document.querySelector('#emailCopy');

            //send email copy
            email.addEventListener('change', () => {
                if (email.value == '') {
                    emailCopy.disabled = true
                } else {
                    emailCopy.disabled = false
                }
            })

            //const sameAddress = document.querySelector('#sameAddress');

            // sameAddress.addEventListener('click', () => {
            //     pstreet.value = street.value;
            //     pbarangay.value = barangay.value;
            //     pdistrict.value = district.value;
            //     pcity.value = city.value;
            //     pstate.value = state.value;
            //     pzipcode.value = zipcode.value;
            // });

            /**
            *--------------------------------------------------------------------
            */

            //allowed inputs
            const allowedNumberInputs = /[0-9\/]+/
            //check age input
            age.addEventListener('keypress', (e) => {
                if (!allowedNumberInputs.test(e.key)) {
                    e.preventDefault()
                }
            })
            //oscya contact number
            contact.addEventListener('keypress', (e) => {
                if (!allowedNumberInputs.test(e.key)) {
                    e.preventDefault()
                }
            })
            //oscya guardian contact number
            gcontact.addEventListener('keypress', (e) => {
                if (!allowedNumberInputs.test(e.key)) {
                    e.preventDefault()
                }
            })
            //oscya zipcode
            zipcode.addEventListener('keypress', (e) => {
                if (!allowedNumberInputs.test(e.key)) {
                    e.preventDefault()
                }
            })
            //oscya permanent zipcode
            // pzipcode.addEventListener('keypress', (e) => {
            //     if (!allowedNumberInputs.test(e.key)) {
            //         e.preventDefault()
            //     }
            // })

            /**
            *--------------------------------------------------------------------
            */
            //calculate age
            
            birthdate.addEventListener('change', () => {
                calAge = (birthdate) =>
                    new Date(Date.now() - new Date(birthdate).getTime()).getFullYear() -
                    1970;
                age.value = calAge(birthdate.value);
            })

            
            /**
            *--------------------------------------------------------------------
            */

            //enable <#other_reason>
            // reason.addEventListener('change', () => {
            //     if(reason.value == 'Others'){
            //         otherReason.disabled = false;
            //     }else{
            //         otherReason.disabled = true;
            //     }
            // });
            // //enable <#is_pwd> and <#disability>
            // reason.addEventListener('change', ()=>{
            //     if(reason.value == 'Disability'){
            //         isPWD.disabled = false;
            //         isPWD.value = 1;
            //         disability.disabled = false;
            //     }else{
            //         isPWD.disabled = true;
            //         isPWD.value = 'Select';
            //         disability.disabled = true;
            //     }
            // });
            // //enable <#other_disability>
            // disability.addEventListener('change', ()=> {
            //     if(disability.value == 'Others'){
            //         otherDisability.disabled = false;
            //     }else{
            //         otherDisability.disabled = true;
            //     }
            // });
            // //enable <#disease>
            // reason.addEventListener('change', ()=>{
            //     if(reason.value == 'Disease'){
            //         disease.disabled = false;
            //     }else{
            //         disease.disabled = true;
            //     }
            // });

            // if(email.value == ""){
            //     emailCopy.disabled = true;
            // }else{
            //     let validEmailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            //     if(email.value.match(validEmailFormat)){
            //         emailCopy.disabled = false;
            //     }else{
            //         emailCopy.disabled = true;
            //     }
            // }
            //form submit

        </script>
