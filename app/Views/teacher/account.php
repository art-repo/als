<div class="container-fluid" id="edit_profile">
    <div class="row gy-3">
        <div class="col-md-12">
            <div class="">
                <h4 class="fw-bold py-3">Account</h4>
                <hr>
            </div>
        </div>
        <div class="col-md-3">
            <div class="py-4">
                <h5 class="fw-bold">Account Setting</h5>
                <p class="text-secondary">Coordinator Profile Settings</p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card p-3 rounded shadow-sm">
                <h5 class="fw-bold">Profile Picture</h5>
                <div class="row">
                    <div class="col-md-3">
                        <label for=""class="form-label">Profile Picture</label>
                    </div>
                    <div class="col-md-4">
                        <?php if(empty($t_info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' .  $t_info['image'])): ?>
                                <img style="width: 100px;height:100px;" class="border border-light border-5 rounded-circle" src="<?=base_url('public/uploads/assets/profiles') . '/default.png' ?>" alt="">
                                
                                <form method="post" action="<?=base_url('teacher/edit_picture')?>" enctype="multipart/form-data" id="editPicForm">
                                    <input type="file" id="image" name="image" style="visibility: hidden;display:none;" accept="image/*">
                                    <button type="button" class="btn btn-warning mt-3" id="openFile">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                    </button>
                                    <button type="submit" class="btn btn-primary text-light mt-3" id="saveImage" >
                                        <i class="bi bi-save"></i> Save
                                    </button> 
                                </form>
                        <?php else: ?>
                                <img style="width: 100px;height:100px;" class="border border-light border-5 rounded-circle" src="<?=base_url('public/uploads/assets/profiles') . '/' . $t_info['image']?>" alt="">

                                <form method="post" action="<?=base_url('teacher/edit_picture')?>" enctype="multipart/form-data" id="editPicForm">
                                    <input type="file" id="image" name="image" style="visibility: hidden;display:none;" accept="image/*">
                                    <button type="button" class="btn btn-warning mt-3" id="openFile">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                    </button>
                                    <button type="submit" class="btn btn-primary mt-3" id="saveImage" >
                                        <i class="bi bi-save"></i> Save
                                    </button> 
                                </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <h5 class="fw-bold">Contact Information</h5>
            <p class="text-secondary">Coordinator Contact Settings</p>
            
        </div>
        <div class="col-md-9">
            <div class="card p-3 rounded shadow-sm overflow-auto" id="contactDetailPane">
                <h5 id="contactHeader" class="fw-bold">Contact Details</h5>
                    
                    <?php if (!empty($t_contact) && is_array($t_contact)): ?>
                        <form id = "teacherContactForm" >
                            <input type="hidden" name="teacher_id" value="<?=$t_contact['user_id']?>">
                            <div class="row gy-3">
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="email"  id="email" class="form-control" value="<?=$t_contact['email'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Facebook</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="facebook"  id="facebook" class="form-control" value="<?=$t_contact['facebook'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Contact</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="contact_no"  id="contact_no" class="form-control" value="<?=$t_contact['contact_no'];?>" readonly required>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <span class="material-icons align-middle">info</span>
                                    <span>Address or District where you work as ALS teacher</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Street</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="street"  id="street" class="form-control" value="<?=$t_contact['street'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Barangay</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="barangay"  id="barangay" class="form-control" value="<?=$t_contact['barangay'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">District</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="district"  id="district" class="form-control" value="<?=$t_contact['district'];?>" readonly min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Zipcode</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="zip_code"  id="zip_code" class="form-control" value="<?=$t_contact['zipcode'];?>" readonly required>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">City</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="city"  id="city" class="form-control" value="<?=$t_contact['city'];?>" readonly>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editContactDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary " id="saveContactDetails" disabled>
                                    <i class="bi bi-save"></i>
                                    Save
                                </button>
                            </div>

                        </form>
                    <?php else: ?>
                        <tr>No Data</tr>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Basic Information</h5>
            <p class="text-secondary">Coordinator Contact Settings</p>
        </div>
        <div class="col-md-9">
            <div class="card p-3 rounded shadow-sm overflow-auto" id="infoDetailPane">
                <h5 id="infoHeader" class="fw-bold">Personal Information</h5>
                <?php if (!empty($t_info) && is_array($t_info)): ?>
                    <form id = "teacherInfoForm" >
                        <input type="hidden" name="teacher_id" value="<?=$t_info['user_id']?>">
                        <div class="row gy-3">
                            <div class="col-md-3">
                                <label for="" class="form-label">Full name</label>
                            </div>
                            <div class="col-md-9">
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <label for="firstname" class="form-text">First name</label>
                                        <input type="text" name="firstname"  id="firstname" class="form-control" value="<?=$t_info['firstname']; ?>" readonly="true" placeholder="First name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="middlename" class="form-text">Middle name</label>
                                        <input type="text" name="middlename"  id="middlename" class="form-control" value="<?=$t_info['middlename'];?>" readonly="true" placeholder="Middle name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="middlename" class="form-text">Last name</label>
                                        <input type="text" name="lastname"  id="lastname" class="form-control" value="<?=$t_info['lastname'];?>" readonly="true" placeholder="Last name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="middlename" class="form-text">Name Extension</label>
                                        <input type="text" name="suffix"  id="suffix" class="form-control" value="<?=$t_info['ext'];?>" readonly="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Birth</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="birth"  id="birth" class="form-control" value="<?=$t_info['birthdate'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Age</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="age"  id="age" class="form-control" value="<?=$t_info['age'];?>" readonly="true" required >
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Gender</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="gender"  id="gender" class="form-control" value="<?=$t_info['gender'];?>" readonly="true">
                            </div>
                            
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editInfoDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary" id="saveInfoDetails" disabled>
                                    <i class="bi bi-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>

                <?php endif?>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Account Credentials</h5>
            <p class="text-secondary">Coordinator Account Settings</p>
        </div>
        <div class="col-md-9">
            <div class="card p-3 rounded shadow-sm overflow-auto" id="contactDetailPane">
                <div class="row gy-3">
                    <div class="col-md-3">
                        <h5>Valid ID</h5>
                        <p class="text-secondary">Scanned Copy of Valid ID</p>
                    </div>
                    <div class="col-md-7">
                        <?php if(empty($t_credential) || !file_exists(FCPATH . 'uploads/assets/profiles/' . $t_credential['id_loc'])): ?>
                            <img src="< ?=base_url('public/uploads/assets/profiles')?>/valid_id.jpg" alt="" class="img-fluid border border-2 border-secondary rounded">
                        <?php else : ?>
                            <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $t_credential['id_loc']?>" alt="" class="img-fluid border border-2 border-secondary rounded">
                        <?php endif ?>
                        <div class="modal fade gd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content p-5">
                                    <div class="modal-header border-bottom-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?=base_url('teacher/edit_credentials')?>" enctype="multipart/form-data" method="post">
                                        <input type="file" name="updateID" id="updateID" style="visibility: hidden;display:none;">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4><?=$t_info['lastname'] . ', ' . $t_info['firstname']?></h4>
                                                    <h5><?=$t_info['user_id']?></h5>
                                                    <p>District: <?=$t_contact['district']?></p>
                                                    <!-- <div class="mb-3">
                                                        <label for="allow" class="form-text">Allow Coordinator to view your credential</label>
                                                        <select name="allow" id="allow" class="form-select">
                                                            <option selected>Select</option>
                                                            <option value="1">Allow</option>
                                                            <option value="0">Do not Allow</option>
                                                        </select>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-8">
                                                    <?php if(empty($t_credential) || !file_exists(FCPATH . 'uploads/assets/profiles/' . $t_credential['id_loc'])): ?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/valid_id.jpg" alt="" class="img-fluid border border-2 border-secondary rounded">
                                                    <?php else : ?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $t_credential['id_loc']?>" alt="" class="img-fluid border border-2 border-secondary rounded">
                                                    <?php endif ?>
                                                    <button type="button" class="btn btn-danger mt-3" id="openFileManager"><i class="bi bi-pencil-square"></i> Change your ID</button>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            const updateID = document.querySelector('#updateID');
                                            const openFileManager = document.querySelector('#openFileManager');

                                            openFileManager.addEventListener('click', ()=>{
                                                updateID.click();
                                            })
                                        </script>
                                        <div class="modal-footer border-top-0 p-2">
                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        &nbsp;<span class="text-secondary">View your credential</span>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <button class="btn btn-warning"  data-bs-toggle="modal" data-bs-target=".gd-example-modal-lg"><i class="bi bi-pencil-square"></i> Edit</button>
                    </div>
                </div>
                
                
            </div>
        </div>
        <div class="col-md-3">
            
        </div>
        <div class="col-md-9">
            <div class="card p-3 rounded shadow-sm"  id="accountDetailPane">
                <h5 id="accountHeader" class="fw-bold">Credentials</h5>
                <?php if (!empty($t_account) && is_array($t_account)): ?>
                    <form id = "teacherAccountForm" >
                        <input type="hidden" name="coordinator_id" value="<?=$t_account['user_id']?>">
                            
                        <div class="row gy-3">
                            
                            <div class="col-md-3">
                                <label for="" class="form-label align-middle">Username: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="username"  id="username" class="form-control" value="<?=$t_account['username'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Current Password: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="old_password"  id="old_password" class="form-control" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">New Password: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="new_password"  id="new_password" class="form-control" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Confirm Password: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="confirm_password"  id="confirm_password" class="form-control" readonly="true">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <small class="text-secondary">Password requirements:</small>
                                <p>Ensure that these requirements are met:</p>
                                <ul>
                                    <li> Minimum 8 characters long the more, the better</li>
                                    <li>At least one lowercase character</li>
                                    <li>At least one uppercase character</li>
                                    <li>At least one number, symbol, or whitespace character
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">User Type:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="user_type"  id="user_type" class="form-control" value="<?=$t_account['user_type']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="status"  id="status" class="form-control" value="<?=$t_account['status'] == 0 ? 'Offline' : 'Online';?>" readonly="true">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editAccountDetails">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-primary" id="saveAccountDetails" disabled>
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
    <?php if(session()->getFlashdata('fail')) : ?>
        swal({
            title: "Failed!",
            text: "<?= session()->getFlashdata('fail')?>",
            icon: "error",
            button: "Close",
        });
    <?php endif ?>
    const editPicForm = document.querySelector('#editPicForm');
    const teacherAccountForm = document.querySelector('#teacherAccountForm');
    const teacherContactForm = document.querySelector('#teacherContactForm');
    const teacherInfoForm = document.querySelector('#teacherInfoForm');
    if(editPicForm){
        const openFile = document.querySelector('#openFile');
        const image = document.querySelector('#image');
        const saveImage = document.querySelector('#saveImage');

        openFile.addEventListener('click', ()=>{
            image.click();
        })
        
    }
    if(teacherAccountForm){
        const editAccountDetails = document.querySelector('#editAccountDetails');
        const saveAccountDetails = document.querySelector('#saveAccountDetails');
        editAccountDetails.addEventListener('click', ()=>{
            saveAccountDetails.disabled = false;
            document.querySelector('#username').readOnly = false;
            document.querySelector('#old_password').readOnly = false;
            document.querySelector('#new_password').readOnly =false;
            document.querySelector('#confirm_password').readOnly =false;
            document.querySelector('#username').focus();
        });
        teacherAccountForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const accountData = new FormData(teacherAccountForm);

            fetch('<?=base_url('teacher/update_password')?>', {
                method:'post',
                body:accountData
            })
            .then((response) => response.json())
            .then((data) => {
                if(data.class == 'alert-success'){
                    swal({
                        title: "Inserted!",
                        text: data.message,
                        icon: "success",
                        button: "Close",
                    });
                   
                }else{
                    swal({
                        title: "Failed!",
                        text: data.message,
                        icon: "error",
                        button: "Close",
                    });
                }
                // alert.id = 'accountMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // let accountDetailPane = document.getElementById('accountDetailPane');
                // let accountHeader = document.getElementById('accountHeader');
                // accountDetailPane.insertBefore(alert, accountHeader);
                // // alert(data.message);
                // setTimeout(()=>{
                //     document.querySelector('#accountMessage').remove();
                // },2000);
            })
        })
    }
    if(teacherContactForm){
        const contactDetails = [
            document.getElementById('email'),
            document.getElementById('contact_no'),
            document.getElementById('facebook'),
            document.getElementById('street'),
            document.getElementById('barangay'),
            document.getElementById('district'),
            document.getElementById('zip_code'),
            document.getElementById('city')
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
        teacherContactForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const contactData = new FormData(teacherContactForm);

            fetch('<?=base_url('teacher/edit_contact_details')?>', {
                method:'post',
                body:contactData
            })
            .then((response) => response.json())
            .then((data) => {
                alert.className = `alert ${data.class}`;
                if(data.class == 'alert-success'){
                    swal({
                        title: "Inserted!",
                        text: data.message,
                        icon: "success",
                        button: "Close",
                    });
                   
                }else{
                    swal({
                        title: "Failed!",
                        text: data.message,
                        icon: "error",
                        button: "Close",
                    });
                }
            })
        })
    }
    if(teacherInfoForm){
        const infoDetails = [
            document.getElementById('lastname'),
            document.getElementById('firstname'),
            document.getElementById('middlename'),
            
            document.getElementById('suffix'),
            document.getElementById('birth'),
            document.getElementById('age'),
            document.getElementById('gender'),
            document.getElementById('civil_status'),
            document.getElementById('religion')
        ];
        const editInfoDetails = document.querySelector('#editInfoDetails');
        const saveInfoDetails = document.querySelector('#saveInfoDetails');
        editInfoDetails.addEventListener('click', () => {
            
            saveInfoDetails.disabled = false;
            for (let i = 0; i < infoDetails.length; i++) {
                infoDetails[i].readOnly = false;
            }
            infoDetails[0].focus();
        });
        teacherInfoForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const infoData = new FormData(teacherInfoForm);

            fetch('<?=base_url('teacher/edit_info_details')?>', {
                method:'post',
                body:infoData
            })
            .then((response) => response.json())
            .then((data) => {
                alert.className = `alert ${data.class}`;
                if(data.class == 'alert-success'){
                    swal({
                        title: "Inserted!",
                        text: data.message,
                        icon: "success",
                        button: "Close",
                    });
                   
                }else{
                    swal({
                        title: "Failed!",
                        text: data.message,
                        icon: "error",
                        button: "Close",
                    });
                }
            })
        })
    }
</script>