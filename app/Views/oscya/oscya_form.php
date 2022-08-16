        <div class="container mt--5 pt-5">
            <div class="row justify-content-center g-3">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h3 class="text-info">Online Community Literacy Mapping</h3>
                        <p class="text-dark">
                             Online community Literacy mapping for OSCYA to assess their academic needs and offer DepEd Academic Programs.
                        </p>
                    </div>
                    <form id="oscya_form" method="post" action="<?=base_url('oscya/save')?>">
                        <?= csrf_field()?>
                        <div class="alert alert-secondary">
                            <h4 class="text-dark">I. Personal Information</h4>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Last Name </span><small class="text-danger">*Required</small>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder = "Enter Lastname" value="<?=set_value('lastname')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'lastname') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">First Name </span><small class="text-danger">*Required</small>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder = "Enter Firstname" value="<?=set_value('firstname')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'firstname') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Middle Name </span><small class="text-danger">*Required</small>
                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder = "Enter Middlename" value="<?=set_value('middlename')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'middlename') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Extension </span><small class="text-danger">*Leave blank if not available</small>
                            <select class="form-select" name="extension" id = "extension" value="<?=set_value('extension')?>">
                                <option value="" selected>Enter Name Extension</option>
                                <option value="Jr." <?=set_select('extension', "Jr.")?>>Jr.</option>
                                <option value="Snr." <?=set_select('extension', "Snr.")?>>Snr.</option>
                                <option value="I" <?=set_select('extension', "I")?>>I</option>
                                <option value="II" <?=set_select('extension', "II")?>>II</option>
                                <option value="III" <?=set_select('extension', "III")?>>III</option>
                            </select>
                            
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Birthdate </span><small class="text-danger">*Required</small>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?=set_value('birthdate')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'birthdate') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Age </span><small class="text-danger">*Required</small>
                            <input type="number" name="age" id="age" class="form-control" value="<?=set_value('age')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'age') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Gender </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="gender" id = "gender" value="<?=set_value('gender')?>">
                                <option value="" selected>Gender</option>
                                <option value="male" <?=set_select('gender', "male")?>>Male</option>
                                <option value="female" <?=set_select('gender', "Female")?>>Female</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'gender') : '';?></span>
                        </div> 
                        <div class="mb-3">
                            <span class="text-dark">Civil Status </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="civil_status" id = "civil_status" value="<?=set_value('civil_status')?>">
                                <option value="" selected>Civil Status</option>
                                <option value="Single" <?=set_select('civil_status', "Single")?>>Single</option>
                                <option value="Married" <?=set_select('civil_status', "Married")?>>Married</option>
                                <option value="Separated" <?=set_select('civil_status', "Separated")?>>Separated</option>
                                <option value="Devorced" <?=set_select('civil_status', "Devorced")?>>Devorced</option>
                                <option value="Widowed" <?=set_select('civil_status', "Widowed")?>>Widowed</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'civil_status') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Religion </span><small class="text-danger">*Optional</small>
                            <textarea name="religion" class ="form-control" id="religion" cols="3" rows="3" value="<?=set_value('religion')?>"></textarea>
                        </div>
                        <div class="alert alert-secondary">
                            <h4 class="text-dark">II. Contact Information</h4>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Email </span><small class="text-danger">*Leave blank if not available</small>
                            <input type="email" name="email" class ="form-control" id="email" placeholder="Enter Email" value="<?=set_value('name')?>">
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Facebook Account </span><small class="text-danger">*Leave blank if not available</small>
                            <input type="text" name="facebook" class ="form-control" id="facebook" placeholder="Enter Facebook" value="<?=set_value('facebook')?>">
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Contact number </span><small class="text-danger">*Required</small>
                            <input type="number" name="contact" class ="form-control" id="contact" placeholder="+63" value="<?=set_value('contact')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'contact') : '';?></span>

                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Street/Building </span><small class="text-danger">*Required</small>
                            <input type="text" name="street" class ="form-control" id="street" placeholder="Street/Building" value="<?=set_value('street')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'street') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Barangay </span><small class="text-danger">*Required</small>
                            <input type="text" name="barangay" class ="form-control" id="barangay" placeholder="Barangay" value="<?=set_value('barangay')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'barangay') : '';?></span>

                        </div>
                        <div class="mb-3">
                            <span class="text-dark">District </span><small class="text-danger">*Required</small>
                            <input type="text" name="district" class ="form-control" id="district" placeholder="District" value="<?=set_value('district')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'district') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">City </span><small class="text-danger">*Required</small>
                            <input type="text" name="city" class ="form-control" id="city" placeholder="City" value = "Quezon City" value="<?=set_value('city')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'city') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">State </span><small class="text-danger">*Required</small>
                            <input type="text" name="state" class ="form-control" id="state" placeholder="State" value = "Philippines" value="<?=set_value('state')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'state') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Zip code </span><small class="text-danger">*Required</small>
                            <input type="number" name="zipcode" class ="form-control" id="zipcode" placeholder="Zip code" value="<?=set_value('zipcode')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'zipcode') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="sameAddress">
                                <label class="form-check-label" for="sameAddress">
                                    Same as home address
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Permanent Street/Building </span><small class="text-danger">*Required</small>
                            <input type="text" name="pstreet" class ="form-control" id="pstreet" placeholder="Street/Building" value="<?=set_value('pstreet')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'pstreet') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Permanent Barangay </span><small class="text-danger">*Required</small>
                            <input type="text" name="pbarangay" class ="form-control" id="pbarangay" placeholder="Barangay" value="<?=set_value('pbarangay')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'pbarangay') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Permanent District </span><small class="text-danger">*Required</small>
                            <input type="text" name="pdistrict" class ="form-control" id="pdistrict" placeholder="Permanent District" value="<?=set_value('pdistrict')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'pdistrict') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Permanent City </span><small class="text-danger">*Required</small>
                            <input type="text" name="pcity" class ="form-control" id="pcity" placeholder="City" value="<?=set_value('pcity')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'pcity') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Permanent State </span><small class="text-danger">*Required</small>
                            <input type="text" name="pstate" class ="form-control" id="pstate" placeholder="State" value="<?=set_value('pstate')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'pstate') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Permanent Zip code </span><small class="text-danger">*Required</small>
                            <input type="number" name="pzipcode" class ="form-control" id="pzipcode" placeholder="Zip code" value="<?=set_value('pzipcode')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'pzipcode') : '';?></span>
                        </div>
                        
                        <div class="alert alert-secondary">
                            <h4 class="text-dark">III. Guardian Information</h4>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Guardian's Fullname </span><small class="text-danger">*Required</small>
                            <input type="text" name="gfullname" class ="form-control" id="gfullname" placeholder="Fullname" value="<?=set_value('gfullname')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'gfullname') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Guardian's Email </span><small class="text-danger">*Leave blank if not available</small>
                            <input type="email" name="gemail" class ="form-control" id="gemail" placeholder="Enter Email" value="<?=set_value('gemail')?>">
                        </div>
                        
                        <div class="mb-3">
                            <span class="text-dark">Guardian's Facebook Account </span><small class="text-danger">*Leave blank if not available</small>
                            <input type="text" name="gfacebook" class ="form-control" id="gfacebook" placeholder="Enter Facebook" value="<?=set_value('gfacebook')?>">
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Guardian's Contact number </span><small class="text-danger">*Required</small>
                            <input type="number" name="gcontact" class ="form-control" id="gcontact" placeholder="+63" value="<?=set_value('gcontact')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'gcontact') : '';?></span>
                        </div>
                        <div class="alert alert-secondary">
                            <h4 class="text-dark">IV. Mapping/Self-Assessment</h4>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Highest Educational Attainment </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="educ_attainment" id = "educ_attainment" value="<?=set_value('educ_attainment')?>">
                                <option value = "" selected>Select</option>
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
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'educ_attainment') : '';?></span>
                        </div>
                        <div class="mb-3 border p-2 rounded">
                            <h4>Reason</h4>
                            <span class="text-dark">Reason for Dropping Out/Not Enrolling </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="reason" id = "reason" value="<?=set_value('reason')?>">
                                <option value = "" selected>Select</option>
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
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'reason') : '';?></span>
                            <span class = "text-dark">For other Reason, Please Specify </span><small class = "text-danger">*Leave it blank if not available</small>
                            <textarea name="other_reason" id="other_reason" class = "form-control" cols="3" rows="3" placeholder="Other Reason, please specify..." value="<?=set_value('other_reason')?>"></textarea>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Are you a PWD?</span>
                            <select class="form-select" name="is_pwd" id = "is_pwd" value="<?=set_value('is_pwd')?>">
                                <option value="" selected>Select</option>
                                <option value="1" <?=set_select('is_pwd', "1")?>>Yes</option>
                                <option value="0" <?=set_select('is_pwd', "0")?>>No</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_pwd') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Do you have PWD ID?</span>
                            <select class="form-select" name="has_pwd" id = "has_pwd" value="<?=set_value('has_pwd')?>">
                                <option value="" selected>Select</option>
                                <option value="1" <?=set_select('has_pwd', "1")?>>Yes</option>
                                <option value="0" <?=set_select('has_pwd', "0")?>>No</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'has_pwd') : '';?></span>
                        </div>
                        <div class="mb-3 border p-2 rounded">
                            <h4>Disability</h4>
                            <span class="text-dark">If yes to disability, please Specify </span>
                            <select class="form-select" name="disability" id = "disability" value="<?=set_value('disability')?>">
                                <option value ="" selected>Select</option>
                                <option value="Intellectual Disability" <?=set_select('disability', "Intellectual Disability")?>>Intellectual Disability</option>
                                <option value="Learning Disability" <?=set_select('disability', "Learning Disability")?>>Learning Disability</option>
                                <option value="Autism" <?=set_select('disability', "Autism")?>>Autism</option>
                                <option value="Blind" <?=set_select('disability', "Blind")?>>Blind</option>
                                <option value="Deaf" <?=set_select('disability', "Deaf")?>>Deaf</option>
                                <option value="Hard of Hearin" <?=set_select('disability', "Hard of Hearin")?>>Hard of Hearin</option>
                                <option value="Orthopedically Impaired" <?=set_select('disability', "Orthopedically Impaired")?>>Orthopedically Impaired</option>
                                <option value="Others" <?=set_select('disability', "Others")?>>Others</option>
                            </select>
                            <span class="text-dark">For other type of disability, please Specify </span><small class = "text-danger">*Leave it blank if not available</small>
                            <textarea type="text" name="other_disability" id="other_disability" class="form-control" cols="3" rows="3" placeholder="Other Disability, please specify..." value="<?=set_value('other_disability')?>"></textarea>
                        </div>
                        <div class="mb-3 border p-2 rounded">
                            <h4>Disease</h4>
                            <span class="text-dark">For disease please specify </span><small class = "text-danger">*Leave it blank if not available</small>
                            <textarea type="text" name="disease" class ="form-control" id="disease" cols="3" rows="3" placeholder="Other Disability, please specify..." value="<?=set_value('disease')?>"></textarea>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Are you Employed? </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="is_employed" id = "is_employed">
                                <option value="" selected>Select</option>
                                <option value="1" <?=set_select('is_employed', "1")?>>Yes</option>
                                <option value="0" <?=set_select('is_employed', "0")?>>No</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_employed') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-dark">Are you a 4ps Member? </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="is_fps_member" id = "is_fps_member">
                                <option value="" selected>Select</option>
                                <option value="1" <?=set_select('is_fps_member', "1")?>>Yes</option>
                                <option value="0" <?=set_select('is_fps_member', "0")?>>No</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_fps_member') : '';?></span>
                        </div>
                        <div class="mb-3">
                        <span class="text-dark">Are you interested in DEPED Programs? </span><small class="text-danger">*Required</small>
                            <select class="form-select" name="is_interested" id = "is_interested">
                                <option value="" selected>Select</option>
                                <option value="1" <?=set_select('is_interested', "1")?>>Yes</option>
                                <option value="0" <?=set_select('is_interested', "0")?>>No</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_interested') : '';?></span>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class = "btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?=base_url('public/form.js')?>"></script>
        