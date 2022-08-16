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
                        <?php if(empty($c_info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' .  $c_info['image'])): ?>
                                <img style="width: 100px;height:100px;" class="border border-light border-5 rounded-circle" src="<?=base_url('public/uploads/assets/profiles') . '/default.png' ?>" alt="">
                                
                                <form method="post" action="<?=base_url('coordinator/edit_picture')?>" enctype="multipart/form-data" id="editPicForm">
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
                                <img style="width: 100px;height:100px;" class="border border-light border-5 rounded-circle" src="<?=base_url('public/uploads/assets/profiles') . '/' . str_replace('\\', '/' , $c_info['image'])?>" alt="">

                                <form method="post" action="<?=base_url('coordinator/edit_picture')?>" enctype="multipart/form-data" id="editPicForm">
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
                
                    <?php if (!empty($c_contact) && is_array($c_contact)): ?>
                        <form id = "coordinatorContactForm" >
                            <input type="hidden" name="coordinator_id" value="<?=$c_contact['user_id']?>">
                            <div class="row gy-3">
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="email"  id="email" class="form-control" value="<?=$c_contact['email'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Facebook</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="facebook"  id="facebook" class="form-control" value="<?=$c_contact['facebook'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Contact</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="contact_no"  id="contact_no" class="form-control" value="<?=$c_contact['contact_no'];?>" readonly required>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Street</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="street"  id="street" class="form-control" value="<?=$c_contact['street'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Barangay</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="barangay"  id="barangay" class="form-control" value="<?=$c_contact['barangay'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">District</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="district"  id="district" class="form-control" value="<?=$c_contact['district'];?>" readonly min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Zipcode</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="zip_code"  id="zip_code" class="form-control" value="<?=$c_contact['zip_code'];?>" readonly required>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">City</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="city"  id="city" class="form-control" value="<?=$c_contact['city'];?>" readonly>
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
                <?php if (!empty($c_info) && is_array($c_info)): ?>
                    <form id = "coordinatorInfoForm" >
                        <input type="hidden" name="staff_id" value="<?=$c_info['user_id']?>">
                        <div class="row gy-3">
                            <div class="col-md-3">
                                <label for="" class="form-label">Full name</label>
                            </div>
                            <div class="col-md-9">
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <label for="firstname" class="form-text">First name</label>
                                        <input type="text" name="firstname"  id="firstname" class="form-control" value="<?=$c_info['firstname']; ?>" readonly="true" placeholder="First name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="middlename" class="form-text">Middle name</label>
                                        <input type="text" name="middlename"  id="middlename" class="form-control" value="<?=$c_info['middlename'];?>" readonly="true" placeholder="Middle name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="middlename" class="form-text">Last name</label>
                                        <input type="text" name="lastname"  id="lastname" class="form-control" value="<?=$c_info['lastname'];?>" readonly="true" placeholder="Last name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="middlename" class="form-text">Name Extension</label>
                                        <input type="text" name="suffix"  id="suffix" class="form-control" value="<?=$c_info['suffix'];?>" readonly="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Birth</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="birth"  id="birth" class="form-control" value="<?=$c_info['birth'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Age</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="age"  id="age" class="form-control" value="<?=$c_info['age'];?>" readonly="true" required >
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Gender</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="gender"  id="gender" class="form-control" value="<?=$c_info['gender'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Civil Status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="civil_status"  id="civil_status" class="form-control" value="<?=$c_info['civil_status'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Religion</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="religion"  id="religion" class="form-control" value="<?=$c_info['religion'];?>" readonly="true">
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
            <div class="card p-3 rounded shadow-sm"  id="accountDetailPane">
                <h5 id="accountHeader" class="fw-bold">Credentials</h5>
                <?php if (!empty($c_account) && is_array($c_account)): ?>
                    <form id = "coordinatorAccountForm" >
                        <input type="hidden" name="coordinator_id" value="<?=$c_account['user_id']?>">
                            
                        <div class="row gy-3">
                            
                            <div class="col-md-3">
                                <label for="" class="form-label align-middle">Username: </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="username"  id="username" class="form-control" value="<?=$c_account['username'];?>" readonly="true">
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
                                <input type="text" name="user_type"  id="user_type" class="form-control" value="<?=$c_account['user_type']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="status"  id="status" class="form-control" value="<?=$c_account['status'] == 0 ? 'Offline' : 'Online';?>" readonly="true">
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
    const coordinatorAccountForm = document.querySelector('#coordinatorAccountForm');
    const coordinatorContactForm = document.querySelector('#coordinatorContactForm');
    const coordinatorInfoForm = document.querySelector('#coordinatorInfoForm');
    if(editPicForm){
        const openFile = document.querySelector('#openFile');
        const image = document.querySelector('#image');
        const saveImage = document.querySelector('#saveImage');

        openFile.addEventListener('click', ()=>{
            image.click();
        })
        
    }
    if(coordinatorAccountForm){
        
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
        coordinatorAccountForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const accountData = new FormData(coordinatorAccountForm);

            fetch('<?=base_url('coordinator/update_password')?>', {
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
    if(coordinatorContactForm){
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
        coordinatorContactForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const contactData = new FormData(coordinatorContactForm);

            fetch('<?=base_url('coordinator/edit_contact_details')?>', {
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
    if(coordinatorInfoForm){
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
        coordinatorInfoForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const infoData = new FormData(coordinatorInfoForm);

            fetch('<?=base_url('coordinator/edit_info_details')?>', {
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