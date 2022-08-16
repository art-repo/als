<div class="container-fluid mt-3" id="edit_profile">
    <div class="row align-items-center mb-10">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->
            <?php if(empty($brgy_profile['cover_photo']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $brgy_profile['cover_photo'])) : ?>
                <div class="pt-20 rounded-top" style="background: url(<?=base_url('public/uploads/assets/profiles')?>/rb.png) no-repeat; background-size: cover;">
            <?php else :?>
                <div class="pt-20 rounded-top" style="background: url(<?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['cover_photo']?>) no-repeat; background-size: cover;">
            <?php endif ?>
            
            </div>
            <div class="bg-white rounded-bottom smooth-shadow-sm ">
                <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                    <div class="d-flex align-items-center">
                        <!-- avatar -->
                        <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                            <?php if(empty($staff_info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $staff_info['image'])) : ?>
                                <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xxl rounded-circle border border-4 border-white-color-40" alt="">
                            <?php else :?>
                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $staff_info['image']?>" class="avatar-xxl rounded-circle border border-4 border-white-color-40" alt="">
                            <?php endif ?>
                            
                        </div>
                        <!-- text -->
                       
                        <div class="lh-1">
                            <h2 class="mb-0"><?=$staff_info['lastname']?> <?=$staff_info['firstname']?> 
                                <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Beginner">
                                </a>
                            </h2>
                            <p class="text-dark"><?=$staff_account['username'];?></p>
                            <p class="text-secondary"><?=$staff_contact['barangay'];?> Barangay Staff</p>
                        </div>
                    </div>
                <div> </div>
                </div>
                <!-- nav -->
                <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#accountDetailPane">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactDetailPane">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#infoDetailPane">Basic Info</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row gy-3">
        <div class="col-md-3">
            <div class="">
                <h5 class="fw-bold">Profile Setting</h5>
                <p class="text-secondary">Staff Profile Settings</p>
            </div>
        </div>
        <div class="col-md-9" id="profile">
            <div class="card p-3">
                <h5 class="fw-bold">Profile Picture</h5>
                <div class="row">
                    <div class="col-md-3">
                        <label for=""class="form-label">Profile Picture</label>
                    </div>
                    <div class="col-md-4">
                        <?php  if(empty($staff_info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $staff_info['image'])): ?>
                                <img style="width: 100px;height:100px;" class="border border-light border-5 rounded-circle" src="<?=base_url('public/uploads/assets/profiles') . '/default.png' ?>" alt="">
                                
                                <form method="post" action="<?=base_url('staff/edit_picture')?>" enctype="multipart/form-data" id="editPicForm">
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
                                <img style="width: 100px;height:100px;" class="border border-light border-5 rounded-circle" src="<?=base_url('public/uploads/assets/profiles') . '/' . $staff_info['image']?>" alt="">

                                <form method="post" action="<?=base_url('staff/edit_picture')?>" enctype="multipart/form-data" id="editPicForm">
                                    <input type="file" id="image" name="image" style="visibility: hidden;display:none;" accept="image/*">
                                    <button type="button" class="btn btn-warning mt-3" id="openFile">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                    </button>
                                    <button type="submit" class="btn btn-primary text-light mt-3" id="saveImage" >
                                        <i class="bi bi-save"></i> Save
                                    </button> 
                                </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Account Information</h5>
            <p class="text-secondary">View and update your account details</p>
        </div>
        <div class="col-md-9" id="accounts">
            <div class="card p-3 overflow-auto" id="accountDetailPane">
                <h3 id="accountHeader" class="fw-bold">Account Information</h3>
                <?php if (!empty($staff_account) && is_array($staff_account)): ?>
                    <form id = "staffAccountForm">
                        <input type="hidden" name="staff_id" value="<?=$staff_account['user_id']?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="username" class="form-label">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="username"  id="username" class="form-control" value="<?=$staff_account['username'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="password" class="form-label">Current password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="password"  id="password" class="form-control" placeholder="current password" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="new_password" class="form-label">New password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="new_password" name="new_password"  id="new_password" class="form-control" placeholder="new password" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="confirm_password" class="form-label">Confirm password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="confirm_password" name="confirm_password"  id="confirm_password" class="form-control" placeholder="confirm password" readonly="true">
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
                                <label for="user_type" class="form-label">User type</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="user_type"  id="user_type" class="form-control" value="<?=$staff_account['user_type']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="status"  id="status" class="form-control" value="<?=$staff_account['status'] == 0 ? 'Offline' : 'Online';?>" readonly="true">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editAccountDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary" id="saveAccountDetails" disabled>
                                    <i class="bi bi-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>

                <?php endif ?>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="fw-bold">Contact Information</h5>
            <p class="text-secondary">View and Edit your contact details</p>
        </div>
        <div class="col-md-9" id="contact_info">
            <div class="card p-3 overflow-auto" id="contactDetailPane">
                <h5 id="contactHeader" class="fw-bold">Contact Information</h5>
                <?php if (!empty($staff_contact) && is_array($staff_contact)): ?>
                    <form id = "staffContactForm" >
                        <input type="hidden" name="staff_id" value="<?=$staff_contact['user_id']?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="email"  id="email" class="form-control" value="<?=$staff_contact['email'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="facebook" class="form-label">Facebook</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="facebook"  id="facebook" class="form-control" value="<?=$staff_contact['facebook'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="contact_no" class="form-label">Personal Mobile no.</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="contact_no"  id="contact_no" class="form-control" value="<?=$staff_contact['contact_no'];?>" maxlength="11" readonly >
                            </div>
                            <div class="col-md-12">
                                <h5 class="fw-bold">Address</h5>
                                <div class="alert alert-warning">
                                    <span class="material-icons align-middle">help</span>&nbsp;
                                    <span class="fw-bold fs-5">Where you work as Barangay Staff</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="street" class="form-label">Street</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="street"  id="street" class="form-control" value="<?=$staff_contact['street'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="barangay" class="form-label">Barangay</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="barangay"  id="barangay" class="form-control" value="<?=$staff_contact['barangay'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="district" class="form-label">District</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="district"  id="district" class="form-control" value="<?=$staff_contact['district'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="zip_code" class="form-label">Zip code</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="zip_code"  id="zip_code" class="form-control" value="<?=$staff_contact['zip_code'];?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="form-label">City</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="city"  id="city" class="form-control" value="<?=$staff_contact['city'];?>" readonly>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-9">
                                <button type="button" class="btn btn-warning" id="editContactDetails">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                <button class="btn btn-primary" id="saveContactDetails" disabled>
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
            <p class="text-secondary">View and Edit your personal details</p>
        </div>
        <div class="col-md-9" id="basic_info">
            <div class="card p-3 overflow-auto" id="infoDetailPane">
                <h5 id="infoHeader" class="fw-bold">Personal Details</h3>
                <?php if (!empty($staff_info) && is_array($staff_info)): ?>
                    <form id = "staffInfoForm" >
                        <input type="hidden" name="staff_id" value="<?=$staff_info['user_id']?>">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="lastname" class="form-label">Last name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="lastname"  id="lastname" class="form-control" value="<?=$staff_info['lastname'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="firstname" class="form-label">First name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="firstname"  id="firstname" class="form-control" value="<?=$staff_info['firstname'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="middlename" class="form-label">Middle name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="middlename"  id="middlename" class="form-control" value="<?=$staff_info['middlename'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="suffix" class="form-label">Name extension</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="suffix"  id="suffix" class="form-control" value="<?=$staff_info['suffix'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="birth" class="form-label">Birthdate</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="birth"  id="birth" class="form-control" value="<?=$staff_info['birth'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="age" class="form-label">Age</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="age"  id="age" class="form-control" value="<?=$staff_info['age'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="gender" class="form-label">Gender</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="gender"  id="gender" class="form-control" value="<?=$staff_info['gender'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="civil_status" class="form-label">Civil status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="civil_status"  id="civil_status" class="form-control" value="<?=$staff_info['civil_status'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="religion" class="form-label">Religion</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="religion"  id="religion" class="form-control" value="<?=$staff_info['religion'];?>" readonly="true">
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
                    <tr>No Data</tr>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row g-3 justify-content-center" >
        
        <div class="col-md-12" >
                
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    let contact = document.querySelector('#contact_no');
    contact.addEventListener('keypress', (e) => {
        if (!allowedNumberInputs.test(e.key)) {
            e.preventDefault()
        }
    })
        swal({
            title: "Message!",
            text: "Set up all required account information",
            icon: "info",
            button: "Close",
        });

    <?php if(session()->getFlashdata('success')) : ?>
        swal({
            title: "Inserted!",
            text: "<?= session()->getFlashdata('success')?>",
            icon: "success",
            button: "Close",
        });
    <?php endif ?>
    const editPicForm = document.querySelector('#editPicForm');
    const staffAccountForm = document.querySelector('#staffAccountForm');
    const staffContactForm = document.querySelector('#staffContactForm');
    const staffInfoForm = document.querySelector('#staffInfoForm');

    if(editPicForm){
        const openFile = document.querySelector('#openFile');
        const image = document.querySelector('#image');
        const saveImage = document.querySelector('#saveImage');

        openFile.addEventListener('click', ()=>{
            image.click();
        })
    }
    if(staffAccountForm){
        const accountDetails = [
            document.querySelector('#username'),
            document.querySelector('#password'),
            document.querySelector('#new_password'),
            document.querySelector('#confirm_password')
        ];
        const editAccountDetails = document.querySelector('#editAccountDetails');
        const saveAccountDetails = document.querySelector('#saveAccountDetails');
        editAccountDetails.addEventListener('click', ()=>{
            saveAccountDetails.disabled = false;
            for (let i = 0; i < accountDetails.length; i++) {
                accountDetails[i].readOnly = false;
            }
            accountDetails[0].focus();
        });
        staffAccountForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const accountData = new FormData(staffAccountForm);

            fetch('<?=base_url('staff/edit_credentials')?>', {
                method:'post',
                body:accountData
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
                // alert.id = 'accountMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // const accountDetailPane = document.querySelector('#accountDetailPane');
                // const accountHeader = document.querySelector('#accountHeader');
                // accountDetailPane.insertBefore(alert, accountHeader);
                // setTimeout(()=>{
                //     document.querySelector('#accountMessage').remove();
                // },2000);
            })
        })
    }
    if(staffContactForm){
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
        staffContactForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const contactData = new FormData(staffContactForm);

            fetch('<?=base_url('staff/edit_contact_details')?>', {
                method:'post',
                body:contactData
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
                // alert.id = 'contactMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // const contactDetailPane = document.querySelector('#contactDetailPane');
                // const contactHeader = document.querySelector('#contactHeader');
                // contactDetailPane.insertBefore(alert, contactHeader);
                // setTimeout(()=>{
                //     document.querySelector('#contactMessage').remove();
                // },2000);
                
            })
        })
    }
    if(staffInfoForm){
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
        infoDetails[4].addEventListener('change', () => {
            calAge = (birthdate) =>
                new Date(Date.now() - new Date(birthdate).getTime()).getFullYear() -
                1970
            infoDetails[5].value = calAge(infoDetails[4].value);
        })
        staffInfoForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            const infoData = new FormData(staffInfoForm);

            fetch('<?=base_url('staff/edit_info_details')?>', {
                method:'post',
                body:infoData
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
                // alert.id = 'infoMessage';
                // alert.appendChild(document.createTextNode(data.message));
                // const infoDetailPane = document.querySelector('#infoDetailPane');
                // const infoHeader = document.querySelector('#infoHeader');
                // infoDetailPane.insertBefore(alert, infoHeader);
                // setTimeout(()=>{
                //     document.querySelector('#infoMessage').remove();
                // },2000);
            })
        })
    }

</script>