<!-- Container fluid -->
<div class="container-fluid p-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 mb-4">              
                <h3 class="mb-0 fw-bold">General</h3>             
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Barangay Setting</h4>
                <p class="mb-0 fs-5 text-muted">Profile configuration settings </p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class=" mb-6">
                        <h4 class="mb-1">Set up Logo and Cover Photo</h4>
                    </div>
                    <div class="row align-items-center mb-8">
                        <div class="col-md-3 mb-3 mb-md-0">
                             <h5 class="mb-0">Logo</h5>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <?php if(empty($brgy_info['logo'] || !file_exists(FCPATH . 'public/uploads/assets/profiles/' . $brgy_info['user_id']))): ?>
                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle avatar avatar-xl" alt="">
                                    <?php else: ?>
                                        <img src="<?=base_url('public/uploads/assets/profiles') . "/" . $brgy_info['logo']?>" class="rounded-circle avatar avatar-xl" alt="">
                                    <?php endif ?>
                                </div>
                                <div>
                                    <form action="<?=base_url('alscoordinator/edit_logo') . "/" . $brgy_info['user_id']?>" method="post" enctype="multipart/form-data">
                                        <input type="file" name="logo" id="logo" accept="image/*" style="visibility: hidden;display:none;">
                                        <button type="button" id="select_logo" class="btn btn-warning me-1">Change</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="row mb-8">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <!-- heading -->
                            <h5 class="mb-0">Cover photo</h5>
                        </div>
                        <div class="col-md-9">
                            <div>
                                <?php if(empty($brgy_info['cover_photo'] || !file_exists(FCPATH . 'public/uploads/assets/profiles/' . $brgy_info['cover_photo']))): ?>
                                    <img src="<?=base_url('public/uploads/assets/profiles')?>/rb.png" class="img-fluid h-50 rounded mb-3" alt="">
                                <?php else: ?>
                                    <img src="<?=base_url('public/uploads/assets/profiles') . "/" . $brgy_info['cover_photo']?>" class="img-fluid h-50 rounded mb-3" alt="">
                                <?php endif ?>
                            </div>
                            <!-- dropzone input -->
                            <div>
                                <form action="<?=base_url('alscoordinator/edit_cover_photo') . "/" . $brgy_info['user_id']?>" class="mb-3" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input name="cover_photo" class="form-control" type="file" accept="image/*"/>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- border -->
                        <div class="mb-6">
                            <h4 class="mb-1">Barangay information</h4>
                        </div>

                        <form action="<?=base_url('alscoordinator/edit_barangay_info') . "/" . $brgy_info['user_id']?>" method="post" id="barangay_info_form">
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="barangay" class="col-sm-4 col-form-label form-label">Barangay</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" name="barangay" value="<?=$brgy_info['barangay']?>" id="barangay" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="about" class="col-sm-4 col-form-label form-label">About</label>
                                <div class="col-md-8 col-12">
                                    <textarea name="about" id="about" class="form-control" cols="30" rows="4" readonly>
                                        <?=$brgy_info['about']?>
                                    </textarea>
                                </div>
                            </div> 
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="contact_no" class="col-sm-4 col-form-label form-label">Phone</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" name="contact_no" class="form-control" placeholder="Phone" id="contact_no" value="<?=$brgy_info['contact_no']?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="brgy_email" class="col-sm-4 col-form-label form-label">Email</label>
                                <div class="col-md-8 col-12">
                                    <input type="email" name="brgy_email" class="form-control" placeholder="Email" id="brgy_email" readonly>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="fb-page" class="col-sm-4 col-form-label form-label">Facebook Page <span class="text-muted">(Optional)</span></label>
                                <div class="col-md-8 col-12">
                                    <input name="fb_page" type="text" class="form-control" placeholder="Facebook page" id="fb_page" value="<?=$brgy_info['facebook_page']?>" readonly>
                                </div>
                            </div>
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="official-web" class="col-sm-4 col-form-label form-label">Official Website <span class="text-muted">(Optional)</span></label>
                                <div class="col-md-8 col-12">
                                    <input type="text" class="form-control" name="official_web" value="<?=$brgy_info['official_web']?>" placeholder="https://www.sample.com" id="official_web" readonly>
                                </div>
                            </div>
                            
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="address" class="col-sm-4 col-form-label form-label">Address</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" class="form-control" name="address" value="<?=$brgy_info['address']?>" placeholder="Address" id="address" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div>
                                    <h4 class="mb-1">Working Hours</h4>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fullName" class="col-sm-4 col-form-label form-label">Operating hours</label>
                                <div class="col-sm-4 mb-3 mb-lg-0">
                                    <label for="start-time" class="form-label">Open</label>
                                    <input type="time" name="start_time" value="<?=$brgy_info['from']?>" class="form-control" id="start_time" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label for="start-time" class="form-label">Close</label>
                                    <input type="time" name="end_time" value="<?=$brgy_info['to']?>" class="form-control" id="end_time" readonly>
                                </div>
                            </div>
                                        <!-- row -->
                            <div class="row align-items-center">
                                <div class="offset-md-4 col-md-8 mt-4">
                                    <button type="button" class="btn btn-warning" id="edit_barangay_info_details" >Edit</button>
                                    <button type="submit" class="btn btn-primary" id="save_barangay_info_details" disabled>Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Account Setting</h4>
                <p class="mb-0 fs-5 text-muted">Coordinator Account information</p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <!-- card -->
            <div class="card" id="edit">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-6">
                        <h4 class="mb-1">Profile</h4>
                    </div>
                    <form action="<?=base_url('alscoordinator/edit_email') . "/" . $brgy_info['user_id']?>" method="post" id="email_form">
                        <div class="mb-6">
                            <h4 class="mb-1">Email</h4>
                        </div>
                        <div class="mb-3 row">
                            <!-- label -->
                            <label for="email" class="col-sm-4 col-form-label form-label">New email</label>
                            <div class="col-md-8 col-12">
                                <!-- input -->
                                <input type="email" name="coord_email" id="coord_email" value="<?=$coord_acc['email']?>" class="form-control" placeholder="Enter your email address" id="newEmailAddress" readonly>
                            </div>
                            <!-- button -->
                            <div class="offset-md-4 col-md-8 col-12 mt-3">
                                <button type="button" class="btn btn-warning" id="edit_email_form">Edit</button>
                                <button type="submit" class="btn btn-primary" id=save_email_form disabled>Save Changes</button>
                            </div>
                        </div>
                    </form>
                                        
                    <div class="mb-6 mt-6">
                        <h4 class="mb-1">Change your password</h4>
                    </div>
                    <form id="account_form" action="<?=base_url('alscoordinator/edit_coord_acc') . "/" . $brgy_info['user_id']?>" method="post" >
                        <input type="hidden" name="coord_email" value="<?=$coord_acc['email']?>" >    
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-4 col-form-label form-label">Username</label>
                            <div class="col-md-8 col-12">
                                
                                <input type="text" class="form-control" placeholder="username" id="username" name="username" value="<?=$coord_acc['username']?>" readonly>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="new_pass" class="col-sm-4 col-form-label form-label">New password</label>
                            <div class="col-md-8 col-12">
                                <input type="password" class="form-control" placeholder="Enter New password" name="new_pass" id="new_pass" readonly>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="row align-items-center">
                            <label for="conf_new_pass" class="col-sm-4 col-form-label form-label">Confirm new password</label>
                            <div class="col-md-8 col-12 mb-2 mb-lg-0">
                                <input type="password" class="form-control" placeholder="Confirm new password" name="conf_new_pass" id="conf_new_pass" readonly>
                            </div>
                            <!-- list -->
                            <div class="offset-md-4 col-md-8 col-12 mt-4">
                                <h6 class="mb-1">Password requirements:</h6>
                                <p>Ensure that these requirements are met:</p>
                                <ul>
                                    <li> Minimum 8 characters long the more, the better</li>
                                    <li>At least one lowercase character</li>
                                    <li>At least one uppercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                                
                                <button type="button" class="btn btn-warning" id="edit_account_details">Edit</button>
                                <button type="submit" class="btn btn-primary" id="save_account_details" disabled>Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3" id="data_migration">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Migration</h4>
                <p class="mb-0 fs-5 text-muted">Migrate old records to the system</p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <div class="card" id="preferences">
                <div class="card-body">
                    <div class="mb-6">
                        <h4 class="mb-1">Migrate Data</h4>
                    </div>
                    <div class="mb-4">
                        <!-- alert -->
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">Check the file if it matches the old format. You can download the old format <a href="#">here</a> 
                            <button type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                        </div>
                    </div>
                    <form action="<?=base_url('alscoordinator/migrate_data') . "/" . $brgy_info['user_id'] ?>" method="post" enctype="multipart/form-data">
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="staff" class="col-sm-4 col-form-label form-label">Staff</label>
                            <div class="col-md-8 col-12">
                            <select class="form-select" name="staff_id" id="staff_id">
                                <option selected>Select staff</option>
                                    <?php if(!empty($staffs) && is_array($staffs)):?>
                                        <?php foreach ($staffs as $staff ) : ?>
                                            <option value="<?=$staff['user_id']?>"><?=$staff['fullname']?></option>
                                        <?php endforeach ?>
                                    <?php else: ?>

                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="timeZone" class="col-sm-4 col-form-label form-label">Teacher</label>

                            <div class="col-md-8 col-12">
                                <select class="form-select" name="teacher_id" id="teacher_id">
                                    <option value="" selected>Select Teacher</option>
                                    <?php if(!empty($teachers) && is_array($teachers)):?>
                                        <?php foreach ($teachers as $teacher ) : ?>
                                            <option value="<?=$teacher['user_id']?>"><?=$teacher['fullname']?></option>
                                        <?php endforeach ?>
                                    <?php else: ?>

                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="facility" class="col-sm-4 col-form-label form-label">Facility</label>

                            <div class="col-md-8 col-12">
                                <select class="form-select" name="facility_id" id="facility_id">
                                    <option selected>Select Facility</option>
                                    <?php if(!empty($facilities) && is_array($facilities)):?>
                                        <?php foreach ($facilities as $facility ) : ?>
                                            <option value="<?=$facility['facility_id']?>"><?=$facility['name']?></option>
                                        <?php endforeach ?>
                                    <?php else: ?>

                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="barangay" value="<?=$brgy_info['barangay']?>">
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="facility" class="col-sm-4 col-form-label form-label">Upload here</label>

                            <div class="col-md-8 col-12">
                                <input type="file" name="migration_file" id="migration-file" class="form-control">
                            </div>
                        </div>
                        <!-- row -->
                        <div class="mb-3 row">
                            <label for="facility" class="col-sm-4 col-form-label form-label">Mapping Date</label>
                            <div class="col-md-8 col-12">
                                <input type="date" name="mapping_date" id="mapping_date" class="form-control">
                            </div>
                        </div>
                        
                        <!-- row -->
                        <div class="mb-3 row">
                            
                            <div class="offset-md-4 col-md-8 col-12 mt-2">
                                <button type="submit" class="btn btn-primary">Start Migration</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3" id="generate_reports">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Report</h4>
                <p class="mb-0 fs-5 text-muted">Generate OSY report for ALS Counselling or QCYDO Reference</p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-6">
                        <h4 class="mb-1">Generate Reports</h4>
                    </div>
                    <div class="mb-4">
                        <!-- alert -->
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">To start using Slack for personal notifications, you should first connect Slack.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                        </div>
                    </div>
                    
                    <hr class="my-6">
                    <form action="<?=base_url('alscoordinator/generate_report') . "/" . $brgy_info['user_id'] ?>" method="post"  >
                        <div class="row">
                            <div class="col-xl-6 col-md-12 mb-3">
                                <label for="purpose" class="form-label">Purpose</label>
                                <select class="form-select" id="purpose" name="purpose">
                                    <option selected>Choose purpose</option>
                                    <option value="QCYDO Reference">QCYDO Reference</option>
                                <option value="ALS Counselling">ALS Counselling</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-3">
                                <label for="date_from" class="form-label">From Date:</label>
                                <input type="date" name="date_from" id="date_from" class="form-control">
                            </div>
                            <div class="col-xl-3 col-md-6 mb-3">
                                <label for="date_to" class="form-label">To Date: </label>
                                <input type="date" name="date_to" id="date_to" class="form-control">
                            </div>
                            <div class="col-xl-3 col-md-12 ">
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <!-- Accordion flush -->
                                <div class="accordion " id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Reports
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row justify-content-end">
                                                            <div class="col-md-3 py-2">
                                                                <input type="search" name="search_bar" id="search_bar" class="form-control" placeholder="Search Filename" onkeyup="myFunction()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table text-nowrap mb-0" id="file_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Filename</th>
                                                                        <th>Purpose</th>
                                                                        <th>Date Created</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="">
                                                                    <?php if(isset($reporting) && is_array($reporting)):?>
                                                                        <?php foreach($reporting as $report): ?>
                                                                            <tr>
                                                                                <td class="align-middle">
                                                                                    <span class="fw-bold fs-5"><?=$report['filename']?></span>
                                                                                </td>
                                                                                <td class="align-middle"><?=$report['purpose']?></td>
                                                                                <td class="align-middle"><?=date('F j, Y - h:i a', strtotime($report['date_created']))?></td>
                                                                                <td class="align-middle text-end">
                                                                                    <a class="btn btn-success btn-sm" href="<?=base_url('public/uploads/reports')  . '/' . $report['file_loc']?>" target="_blank">
                                                                                        <span class="material-icons align-middle">cloud_download</span>
                                                                                        &nbsp;Download
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach ?>
                                                                    <?php else : ?>
                                                                        <tr>
                                                                            <td colspan="4" class="align-middle text-center">
                                                                                No Report Created
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">Files</h4>
                <p class="mb-0 fs-5 text-muted">View or Download files from this barangay</p>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
           
            <div class="card mb-6">
                
                <div class="card-body">
                    <div class="mb-6">
                        <h4 class="mb-1">File</h4>
                    </div>
                    <div>
                        
                        <p>Delete any and all content you have, such as articles, comments, your reading list or chat messages. Allow your username to become available to anyone.</p>
                        <a href="#" class="btn btn-danger">Delete Account</a>
                        <p class="small mb-0 mt-3">Feel free to contact with any <a href="#">dashui@example.com</a> questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    
    
            
    <?php if(session()->getFlashdata('success')) : ?>
        swal({
            title: "Success!",
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
    const select_logo = document.querySelector('#select_logo');
    const logo = document.querySelector('#logo');
    select_logo.addEventListener('click', ()=>{
        logo.click();
    })

    const email_form = document.querySelector('#email_form');
    const barangay_info_form = document.querySelector('#barangay_info_form');
    const account_form = document.querySelector('#account_form');
    if(email_form){
        const coord_email = document.querySelector('#coord_email');
        const edit_email_form = document.querySelector('#edit_email_form');
        const save_email_form = document.querySelector('#save_email_form');

        edit_email_form.addEventListener('click', ()=>{
            save_email_form.disabled = false;
            coord_email.readOnly = false;
        })
    }
    if(barangay_info_form){
        const barangay_details = [
            document.getElementById('barangay'),
            document.getElementById('about'),
            document.getElementById('contact_no'),
            document.getElementById('brgy_email'),
            document.getElementById('fb_page'),
            document.getElementById('official_web'),
            document.getElementById('address'),
            document.getElementById('start_time'),
            document.getElementById('end_time'),
        ];
        const edit_barangay_info_details = document.querySelector('#edit_barangay_info_details');
        const save_barangay_info_details = document.querySelector('#save_barangay_info_details');
        edit_barangay_info_details.addEventListener('click', () => {
            
            save_barangay_info_details.disabled = false;
            for (let i = 0; i < barangay_details.length; i++) {
                barangay_details[i].readOnly = false;
            }
            barangay_details[0].focus();
        });
    }
    if(account_form){
        const account_details = [
            document.getElementById('username'),
            document.getElementById('new_pass'),
            document.getElementById('conf_new_pass')
           
        ];
        const edit_account_details = document.querySelector('#edit_account_details');
        const save_account_details = document.querySelector('#save_account_details');
        edit_account_details.addEventListener('click', () => {
            
            save_account_details.disabled = false;
            for (let i = 0; i < account_details.length; i++) {
                account_details[i].readOnly = false;
            }
            account_details[0].focus();
        });
    }
</script>