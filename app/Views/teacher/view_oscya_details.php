<div class="container pt-3">
    <div class="row g-3">
        <div class="col-md-12">
            <h4 class="fw-bold ">OSCYA Mapping Data</h4>
            <p class="text-secondary">Out of school adult literacy mapping information.</p>
            <hr>
        </div>
        <div class="col-md-12 text-end">
            <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="<?=base_url('teacher/download_ae_pdf') .'/'.$page_info['oscya_id'] ?>" target="_blank">
                <span class="material-icons">download</span>
            </a>
            <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="<?=base_url('teacher/generate_ae_pdf') .'/'.$page_info['oscya_id'] ?>" target="_blank">
                <span class="material-icons">picture_as_pdf</span>
            </a>
            <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="#" role="button" id="dropdownNotification"data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Update all necessary OSY data before printing the form">
                <span class="material-icons">help</span>
            </a>

        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Counselling</h5>
            <p class="text-secondary">OSY Counselling Process</p>
        </div>
        <div class="col-md-9">
            <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="mb-0">Counseling</h5>
                </div>
                <!-- dropdown  -->
                <!-- <div class="dropdown dropstart">
                    <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-xxs" data-feather="more-vertical"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownTask">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div> -->
            </div>
                <form action="<?=base_url('teacher/osy_counselling')?>" method="post">
                    <div class="row g-3">
                        <?=csrf_field()?>
                        <input type="hidden" name="staff_id" id = "staff_id" value="<?=$page_info['staff_id']?>">
                        <input type="hidden" name="oscya_id" id = "oscya_id" value="<?=$oscya_info['oscya_id']?>">
                        
                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Learner's Reference Number</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="lrn" id="lrn" class="form-control" placeholder="LRN" value="<?=$oscya_mapping['lrn']?>">
                        </div>
                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Education Type</label>
                        </div>
                        <div class="col-md-9">
                            <select name="educ_type" id="educ_type" class="form-select">
                                <option selected>Select Education Type</option>
                                <option value="f_educ">Formal Education</option>
                                <option value="inf_educ">Informal Education</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="lastname" class="form-label">Interested in ALS Program</label>
                        </div>
                        <div class="col-md-9">
                            <select name="int_in_als" id="int_in_als" class="form-select">
                                <option selected>Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-3">
                            <label for="" class="form-label">Personal Information Sheet score</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="pis_score" id="pis_score" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Examination</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="exam_type">
                                <option selected>Exam type</option>
                                <option value="FLT">FLT(Functional Literacy Test)</option>
                                <option value="ABL">ABL(Assessment of Basic Literacy)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Learning Modalities</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select mb-3" aria-label="Default select example" name="learning_mode">
                                <option selected>Learning Modality</option>
                                <option value="Online Learning">Online</option>
                                <option value="Face to Face Learning">Face to Face</option>
                                <option value="Blended Learning">Blended Learning Mode(Modular/F2F)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Grade Level</label>
                        </div>
                        <div class="col-md-9">
                            <select name="educ_attainment" id = "educ_attainment" class="form-select">
                                <option selected>Select Grade Level</option>
                                <option value="Kinder">Kinder</option>
                                <option value="1" >Grade 1</option>
                                <option value="2" >Grade 2</option>
                                <option value="3" >Grade 3</option>
                                <option value="4" >Grade 4</option>
                                <option value="5" >Grade 5</option>
                                <option value="6" >Grade 6</option>
                                <option value="7" >Grade 7 / 1st Year</option>
                                <option value="8" >Grade 8 / 2nd Year</option>
                                <option value="9" >Grade 9 / 3rd Year</option>
                                <option value="10">Grade 10 / 4th Year</option>
                            </select> 
                        </div> -->
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Mapping Information</h5>
            <p class="text-secondary">View and edit OSCYA Mapping/Self-assessment details</p>
        </div>
        <div class="col-md-9">
            <div class="card p-4" id="mappingDetailPane">
                <h5 class="text-blue-3" id="mappingHeader">Mapping Details/Assessment</h5>
                <!-- Contact details -->
                <?php if (!empty($oscya_mapping) && is_array($oscya_mapping)): ?>
                    <form id = "mappingDetailsForm">
                        <input type="hidden" name="oscya_id" id = "oscya_id" value="<?=$oscya_mapping['oscya_id']?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="educ_attainment" class="form-label">Education</label><br>
                            </div>
                            <div class="col-md-9">
                                <small class="form-text">Highest educational attainment OSCYA applicant</small>
                                <select name="educ_attainment" id = "educ_attainment" class="form-select">
                                    <?php if($oscya_mapping['educ_attainment'] == 'Kinder'):?>
                                        <option value="Kinder">Kinder</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '1'):?>
                                        <option value="1" >Grade 1</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '2'):?>
                                        <option value="2" >Grade 2</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '3'):?>
                                        <option value="3" >Grade 3</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '4'):?>
                                        <option value="4" >Grade 4</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '5'):?>
                                        <option value="5" >Grade 5</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '6'):?>
                                        <option value="6" >Grade 6</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '7'):?>
                                        <option value="7" >Grade 7 / 1st Year</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '8'):?>
                                        <option value="8" >Grade 8 / 2nd Year</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '9'):?>
                                        <option value="9" >Grade 9 / 3rd Year</option>
                                    <?php endif?>
                                    <?php if($oscya_mapping['educ_attainment'] == '10'):?>
                                        <option value="10">Grade 10 / 4th Year</option>
                                    <?php endif?>
                                    <option value="Kinder">Kinder</option>
                                    <option value="1" >Grade 1</option>
                                    <option value="2" >Grade 2</option>
                                    <option value="3" >Grade 3</option>
                                    <option value="4" >Grade 4</option>
                                    <option value="5" >Grade 5</option>
                                    <option value="6" >Grade 6</option>
                                    <option value="7" >Grade 7 / 1st Year</option>
                                    <option value="8" >Grade 8 / 2nd Year</option>
                                    <option value="9" >Grade 9 / 3rd Year</option>
                                    <option value="10">Grade 10 / 4th Year</option>
                                </select> 
                            </div>
                            <div class="col-md-3">
                                <label for="reason" class="form-label">Reason</label><br>
                            </div>
                            <div class="col-md-9">
                                <small class="form-text">Reason for dropping out/not enrolling</small>
                                <select name="reason" id="reason" class="form-select">
                                    <?php if($oscya_mapping['reason'] == "Lack of Personal Interest"): ?>
                                        <option value="Lack of Personal Interest">Lack of Personal Interest</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Family Related Concerns"): ?>
                                        <option value="Family Related Concerns">Family Related Concerns</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Employment"): ?>
                                        <option value="Employment">Employment</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Early Pregnancy"): ?>
                                        <option value="Early Pregnancy">Early Pregnancy</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Disability"): ?>
                                        <option value="Disability">Disability</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Disease"): ?>
                                        <option value="Disease">Disease</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Distance of the School"): ?>
                                        <option value="Distance of the School">Distance of the School</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Cannot Cope with School Works"): ?>
                                        <option value="Cannot Cope with School Works">Cannot Cope with School Works</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Financial Problems"): ?>
                                        <option value="Financial Problems">Financial Problems</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['reason'] == "Others"): ?>
                                        <option value="Others">Other reason</option>
                                    <?php endif ?>
                                    <option value="Lack of Personal Interest">Lack of Personal Interest</option>
                                    <option value="Family Related Concerns">Family Related Concerns</option>
                                    <option value="Employment">Employment</option>
                                    <option value="Early Pregnancy">Early Pregnancy</option>
                                    <option value="Disability">Disability</option>
                                    <option value="Disease">Disease</option>
                                    <option value="Distance of the School">Distance of the School</option>
                                    <option value="Cannot Cope with School Works">Cannot Cope with School Works</option>
                                    <option value="Financial Problems">Financial Problems</option>
                                    <option value="Others">Other reason</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="other_reason" class="form-label">Other reason</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="other_reason"  id="other_reason" class="form-control" value="<?=$oscya_mapping['other_reason'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="is_pwd" class="form-label">PWD</label>
                            </div>
                            <div class="col-md-9">
                                <small class="form-text">if applicant belongs to PWD</small>
                                <select type="text" name="is_pwd"  id="is_pwd" class="form-select" readonly="true">
                                    <?php if($oscya_mapping['is_pwd'] == 1):?>
                                        <option value="1">YES</option>
                                    <?php else: ?>
                                        <option value="0">NO</option>
                                    <?php endif ?>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="has_pwd_id" class="form-label">PWD ID</label>
                            </div>
                            <div class="col-md-9">
                                <small class="form-text">if applicant has PWD ID</small>
                                <select type="text" name="has_pwd_id"  id="has_pwd_id" class="form-select" readonly="true">
                                    <?php if($oscya_mapping['has_pwd_id'] == 1):?>
                                        <option value="1">YES</option>
                                    <?php else: ?>
                                        <option value="0">NO</option>
                                    <?php endif ?>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="disability" class="form-label">Disability</label>
                            </div>
                            <div class="col-md-9">
                                <select name="disability" id = "disability" class="form-select" readonly>
                                    <option selected>Select</option>
                                    <?php if($oscya_mapping['disability'] == "Intellectual Disability"): ?>
                                        <option value="Intellectual Disability">Intellectual Disability</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Learning Disability"): ?>
                                        <option value="Learning Disability">Learning Disability</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Autism"): ?>
                                        <option value="Autism">Autism</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Blind"): ?>
                                        <option value="Blind">Blind</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Deaf"): ?>
                                        <option value="Deaf">Deaf</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Hard of Hearin"): ?>
                                        <option value="Hard of Hearin">Hard of Hearin</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Orthopedically Impaired"): ?>
                                        <option value="Orthopedically Impaired">Orthopedically Impaired</option>
                                    <?php endif ?>
                                    <?php if($oscya_mapping['disability'] == "Others"): ?>
                                        <option value="Others">Others</option>
                                    <?php endif ?>
                                    <option value="Intellectual Disability">Intellectual Disability</option>
                                    <option value="Learning Disability">Learning Disability</option>
                                    <option value="Autism">Autism</option>
                                    <option value="Blind">Blind</option>
                                    <option value="Deaf">Deaf</option>
                                    <option value="Hard of Hearin">Hard of Hearin</option>
                                    <option value="Orthopedically Impaired">Orthopedically Impaired</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="other_disability" class="form-label">Other Disability</label>
                            </div>
                            <div class="col-md-9">
                                <small class="form-text">If others, please specify</small>
                                <input type="text" id = "other_disability" name="other_disability" placeholder="Other disability" class="form-control" value="<?=$oscya_mapping['other_disability']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="disease" class="form-label">Disease</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id = "disease" name="disease" class="form-control" placeholder="Disease" value="<?=$oscya_mapping['disease']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="is_employed" class="form-label">Employment</label>
                            </div>
                            <div class="col-md-9">
                                <select type="text" name="is_employed"  id="is_employed" class="form-select" readonly="true">
                                    <?php if($oscya_mapping['is_employed'] == 1):?>
                                        <option value="1">YES</option>
                                    <?php else: ?>
                                        <option value="0">NO</option>
                                    <?php endif ?>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="is_fps_member">4Ps Member</label>
                            </div>
                            <div class="col-md-9">
                                <select type="text" name="is_fps_member"  id="is_fps_member" class="form-select" readonly="true">
                                    <?php if($oscya_mapping['is_fps_member'] == 1):?>
                                        <option value="1">YES</option>
                                    <?php else: ?>
                                        <option value="0">NO</option>
                                    <?php endif ?>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="is_interested">Interested</label>
                            </div>
                            <div class="col-md-9">
                                <select type="text" name="is_interested"  id="is_interested" class="form-select" readonly="true">
                                    <?php if($oscya_mapping['is_interested'] == 1):?>
                                        <option value="1">YES</option>
                                    <?php else: ?>
                                        <option value="0">NO</option>
                                    <?php endif ?>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editMappingDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary" id="saveMappingDetails" disabled>
                                    <i class="bi bi-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php else: ?>
                        <tr>No Data</tr>
                    <?php endif ?>
                </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Personal Information</h5>
            <p class="text-secondary">View and Edit OSCYA personal details</p>
        </div>
        <div class="col-md-9">
            <div class="card p-4" id = "personalDetailPane">
                <h5 class="text-blue-3 fw-bold" id="title">Personal Details</h5>
                <!-- Personal details -->
                    <?php if (!empty($oscya_info) && is_array($oscya_info)): ?>
                        <form id = "personalDetailsForm">
                            <input type="hidden" name="oscya_id" id = "oscya_id" value="<?=$oscya_info['oscya_id']?>">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="lastname" class="form-label">Last name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="lastname"  id="lastname" class="form-control" value="<?=$oscya_info['lastname']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="firstname" class="form-label">First name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="firstname" id="firstname" class="form-control" value="<?=$oscya_info['firstname']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="middlename" class="form-label">Middle name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="middlename" id="middlename" class="form-control" value="<?=$oscya_info['middlename']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="extension" class="form-label">Name extension</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="extension" id="extension" class="form-control" value="<?=$oscya_info['extension']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?=$oscya_info['birthdate']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="age" class="form-label">Age</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="age" id="age" class="form-control" value="<?=$oscya_info['age']?>" readonly></td>
                                </div>
                                <div class="col-md-3">
                                    <label for="gender" class="form-label">Gender</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="gender" id="gender" class="form-control" value="<?=$oscya_info['gender']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="civil_status" class="form-label">Civil status</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="civil_status" id="civil_status" class="form-control" value="<?=$oscya_info['civil_status']?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="religion" class="form-label">Religion</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="religion" id="religion" class="form-control" value="<?=$oscya_info['religion']?>" readonly>
                                </div>
                                <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                    <button type="button" class="btn btn-warning" id="editPersonalDetails">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </button>
                                    <button class="btn btn-primary" id="savePersonalDetails" disabled>
                                        <i class="bi bi-save"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <tr>No Data</tr>
                    <?php endif ?>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Contact Information</h5>
            <p class="text-secondary">View and edit OSCYA personal details</p>
        </div>
        <div class="col-md-9">
            <div class="card p-4" id = "contactDetailPane">
            <h5 class="text-blue-3 fw-bold" id="contactHeader">Contact Details</h5>
            <!-- Contact details -->
                <?php if (!empty($oscya_contact) && is_array($oscya_contact)): ?>
                    <form id = "contactDetailsForm">
                        <input type="hidden" name="oscya_id" id = "oscya_id" value="<?=$oscya_contact['oscya_id']?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email account</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="email"  id="email" class="form-control" value="<?=$oscya_contact['email']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="contact" class="form-label">Contact #</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="contact" id="contact" class="form-control" value="<?=$oscya_contact['contact']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="facebook" class="form-label">Facebook account</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="facebook" id="facebook" class="form-control" value="<?=$oscya_contact['facebook']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="street" class="form-label">No./Unit/Bldg./Street</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="street" id="street" class="form-control" value="<?=$oscya_contact['street']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="brgy" class="form-label">Barangay</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="brgy" id="brgy" class="form-control" value="<?=$oscya_contact['brgy']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="district" class="form-label">District</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="district" id="district" class="form-control" value="<?=$oscya_contact['district']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="form-label">City</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="city" id="city" class="form-control" value="<?=$oscya_contact['city']?>" readonly="true">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editContactDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button type="submit" class="btn btn-primary" id="saveContactDetails" disabled>
                                    <i class="bi bi-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <tr>No Data</tr>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Guardian Information</h5>
            <p class="text-secondary">View and edit OSCYA Guardian contact details</p>
        </div>
        <div class="col-md-9">
            <div class="card p-4" id = "guardianDetailPane">
                <h5 class="text-blue-3" id="guardianHeader">Guardian Details</h5>
                <!-- Contact details -->
                <?php if (!empty($oscya_guardian) && is_array($oscya_guardian)): ?>
                    <form id = "guardianDetailsForm" >
                        <input type="hidden" name="oscya_id" id = "oscya_id" value="<?=$oscya_guardian['oscya_id']?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="gfullname" class="form-label">Full name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="gfullname"  id="gfullname" class="form-control" value="<?=$oscya_guardian['fullname'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="gcontact" class="form-label">Contact #</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="gcontact"  id="gcontact" class="form-control" value="<?=$oscya_guardian['contact']?>" readonly="true">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editGuardianDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary" id="saveGuardianDetails" disabled>
                                    <i class="bi bi-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <tr>No Data</tr>
                <?php endif ?>
            </div>
        </div>
        
    </div>
</div>


                

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    <?php if(session()->getFlashdata('success')) : ?>
        swal({
            title: "Inserted!",
            text: "<?= session()->getFlashdata('success')?>",
            icon: "success",
            button: "Close",
        });
    <?php endif ?>
    const personalDetailsForm = document.querySelector('#personalDetailsForm');
    if (personalDetailsForm) {
        const details = [
            document.querySelector('#lastname'),
            document.querySelector('#firstname'),
            document.querySelector('#middlename'),
            document.querySelector('#extension'),
            document.querySelector('#birthdate'),
            document.querySelector('#age'),
            document.querySelector('#gender'),
            document.querySelector('#civil_status'),
            document.querySelector('#religion')
        ];
        const editPersonalDetails = document.querySelector('#editPersonalDetails');
        const savePersonalDetails = document.querySelector('#savePersonalDetails');
        editPersonalDetails.addEventListener('click', () => {
            savePersonalDetails.disabled = false;
            for (let i = 0; i < details.length; i++) {
                details[i].readOnly = false;
            }
            lastname.focus();
        });
        savePersonalDetails.addEventListener('click', (e) => {
            e.preventDefault();
            const formData = new FormData(personalDetailsForm);

            fetch("<?=base_url('teacher/save_personal_detail')?>", {
                method: "post",
                body:formData
            }).then((response) => {
                return response.json();
            }).then((data) => {

                if(data.class=="alert-success"){
                    swal({
                        title: "Updated!",
                        text: "Updated Successfully",
                        icon: "success",
                        button: "Close",
                    });
                }else{
                    swal({
                        title: "Failed!",
                        text: "Failed to update personal info",
                        icon: "error",
                        button: "Close",
                    });
                }
                // const alert = document.createElement('div');
                // alert.className = `alert ${data.class}`;
                // alert.id = 'message';
                // alert.appendChild(document.createTextNode(data.message));
                // const personalDetailPane = document.querySelector('#personalDetailPane');
                // const title = document.querySelector('#title');
                // personalDetailPane.insertBefore(alert, title);
                // setTimeout(()=>{
                //     document.querySelector('#message').remove();
                // },2000);
            });
        });
        
        
    }
    const contactDetailsForm = document.querySelector('#contactDetailsForm');
    if (contactDetailsForm) {
        const contactDetails = [
            document.querySelector('#email'),
            document.querySelector('#contact'),
            document.querySelector('#facebook'),
            document.querySelector('#street'),
            document.querySelector('#brgy'),
            document.querySelector('#district'),
            document.querySelector('#city'),
            document.querySelector('#state'),
            document.querySelector('#zip_code'),
            document.querySelector('#p_street'),
            document.querySelector('#p_barangay'),
            document.querySelector('#p_district'),
            document.querySelector('#p_city'),
            document.querySelector('#p_state'),
            document.querySelector('#p_zip_code')
        ];
        const editContactDetails = document.querySelector('#editContactDetails');
        const saveContactDetails = document.querySelector('#saveContactDetails');
        editContactDetails.addEventListener('click', () => {
            saveContactDetails.disabled = false;
            for (let i = 0; i < contactDetails.length; i++) {
                contactDetails[i].readOnly = false;
            }
            contactDetails[0].focus();
        });
        saveContactDetails.addEventListener('click', (e)=>{
            e.preventDefault();
            const contactData = new FormData(contactDetailsForm);

            fetch("<?=base_url('teacher/save_contact_detail')?>", {
                method: "post",
                body:contactData
            }).then((response) => {
                return response.json();
            }).then((data) => {
                if(data.class=="alert-success"){
                    swal({
                        title: "Updated!",
                        text: "Updated Successfully",
                        icon: "success",
                        button: "Close",
                    });
                }else{
                    swal({
                        title: "Failed!",
                        text: "Failed to update personal info",
                        icon: "error",
                        button: "Close",
                    });
                }
                // const alert = document.createElement('div');
                // alert.className = `alert ${data.class}`;
                // alert.id = 'contactMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // const contactDetailPane = document.querySelector('#contactDetailPane');
                // const contactHeader = document.querySelector('#contactHeader');
                // contactDetailPane.insertBefore(alert, contactHeader);
                // setTimeout(()=>{
                //     document.querySelector('#contactMessage').remove();
                // },2000);
            });
        });
    }
    const guardianDetailsForm = document.querySelector('#guardianDetailsForm');
    if (guardianDetailsForm) {
        const guardianDetails = [
            document.querySelector('#gfullname'),
            document.querySelector('#gcontact')
        ];
        const editGuardianDetails = document.querySelector('#editGuardianDetails');
        const saveGuardianDetails = document.querySelector('#saveGuardianDetails');
        editGuardianDetails.addEventListener('click', () => {
            saveGuardianDetails.disabled = false;
            for (let i = 0; i < guardianDetails.length; i++) {
                guardianDetails[i].readOnly = false;
            }
            guardianDetails[0].focus();
        });

        saveGuardianDetails.addEventListener('click', (e)=> {
            e.preventDefault();

            const guardianData = new FormData(guardianDetailsForm);

            fetch("<?=base_url('teacher/save_guardian_detail')?>", {
                method:'post',
                body:guardianData
            })
            .then(response => response.json())
            .then(data => {
                if(data.class=="alert-success"){
                    swal({
                        title: "Updated!",
                        text: "Updated Successfully",
                        icon: "success",
                        button: "Close",
                    });
                }else{
                    swal({
                        title: "Failed!",
                        text: "Failed to update personal info",
                        icon: "error",
                        button: "Close",
                    });
                }
                // const alert = document.createElement('div');
                // alert.className = `alert ${data.class}`;
                // alert.id = 'guardianMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // const guardianDetailPane = document.querySelector('#guardianDetailPane');
                // const guardianHeader = document.querySelector('#guardianHeader');
                // guardianDetailPane.insertBefore(alert, guardianHeader);
                // setTimeout(()=>{
                //     document.querySelector('#guardianMessage').remove();
                // },2000);
            });
        });
    }
    const mappingDetailsForm = document.querySelector('#mappingDetailsForm');
    if(mappingDetailsForm){
        const mappingDetails = [
            document.querySelector('#educ_attainment'),
            document.querySelector('#reason'),
            document.querySelector('#other_reason'),
            document.querySelector('#is_pwd'),
            document.querySelector('#has_pwd_id'),
            document.querySelector('#disability'),
            document.querySelector('#other_disability'),
            document.querySelector('#disease'),
            document.querySelector('#is_employed'),
            document.querySelector('#is_fps_member'),
            document.querySelector('#is_interested')
        ];

        const editMappingDetails = document.querySelector('#editMappingDetails');
        const saveMappingDetails = document.querySelector('#saveMappingDetails');
        editMappingDetails.addEventListener('click', ()=>{
            saveMappingDetails.disabled = false;
            for (let i = 0; i < mappingDetails.length; i++) {
                mappingDetails[i].readOnly = false;
            }
            mappingDetails[1].focus();
        });
        saveMappingDetails.addEventListener('click', (e) => {
            e.preventDefault();

            const mappingData = new FormData(mappingDetailsForm);

            fetch("<?=base_url('teacher/save_mapping_details')?>", {
                method: 'post',
                body:mappingData
            })
            .then((response) => response.json())
            .then((data) => {
                if(data.class=="alert-success"){
                    swal({
                        title: "Updated!",
                        text: "Updated Successfully",
                        icon: "success",
                        button: "Close",
                    });
                }else{
                    swal({
                        title: "Failed!",
                        text: "Failed to update personal info",
                        icon: "error",
                        button: "Close",
                    });
                }
                // const alert = document.createElement('div');
                // alert.className = `alert ${data.class}`;
                // alert.id = 'mappingMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // const mappingDetailPane = document.querySelector('#mappingDetailPane');
                // const mappingHeader = document.querySelector('#mappingHeader');
                // mappingDetailPane.insertBefore(alert, mappingHeader);
                // setTimeout(()=>{
                //     document.querySelector('#mappingMessage').remove();
                // },2000);
            })
        })
    }
</script>