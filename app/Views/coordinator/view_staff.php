</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-success">
                <h4 class="modal-title text-success" id="exampleModalCenterTitle">
                    <span class="material-icons align-middle">task_alt</span>
                    Task
                </h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <?php if($isTask['res'] == true): ?>
                <div class="modal-body text-center bg-light-success">
                        <span class="material-icons align-middle text-success" style="font-size: 70px;">info</span>
                        <h3>Assigned</h3>
                        <p class="text-secondary">You Already Assigned this staff</p>
                    
                </div>
                <div class="modal-footer bg-light-success">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            <?php else: ?>
                <form action="<?=base_url('coordinator/assign_task')?>" method="post">
                    <div class="modal-body bg-light-success">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                Assign Task
                            </div>
                            <div class="col-md-3 text-end">
                                <a class="btn btn-icon rounded-circle indicator indicator-primary text-muted" 
                                    href="#" 
                                    role="button" 
                                    data-bs-toggle="tooltip" 
                                    data-placement="bottom" 
                                    title="Assign all records of this staff to one teacher">
                                    <span class="material-icons">help</span>
                                </a>
                            </div>
                        </div>
                        <input type="hidden" name="staff_id" value="<?=$staff['id']?>">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="teacher_id">Teacher</label>
                            <select name="teacher_id" id="teacher_id" class="form-select">
                                <option selected>Select Teacher</option>
                                <?php if(isset($teachers) && is_array($teachers)): ?>
                                    <?php foreach($teachers as $teacher): ?>
                                        <option value="<?=$teacher['user_id']?>"><?=$teacher['fullname']?></option>
                                    <?php endforeach ?>
                                <?php else: ?>

                                <?php endif ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="facility_id">Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select">
                                <option selected>Select Facility</option>
                                <?php if(isset($facilities) && is_array($facilities)): ?>
                                    <?php foreach($facilities as $facility): ?>
                                        <option value="<?=$facility['facility_id']?>"><?=$facility['name']?></option>
                                    <?php endforeach ?>
                                <?php else: ?>

                                <?php endif ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Date:</label>
                                    <input type="date" name="schedule_date" id="schedule_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_time">Start:</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time">To:</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light-success">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <div class="row align-items-center mb-3">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 mb-4 ">
                <h3 class="mb-0 fw-bold">Staff Account</h3>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Bg -->
            <div class="pt-20 rounded-top" style="background:url(<?=base_url('public/uploads/assets/profiles') . '/'. $brgy_profile['cover_photo']?>) no-repeat; background-size: cover;">
            </div>
            <div class="bg-white rounded-bottom smooth-shadow-sm">
                <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                    <div class="d-flex align-items-center">
                        <!-- avatar -->
                        <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                            <?php if(empty($info['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $info['image'] )):?>
                                <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xxl rounded-circle border border-4 border-white-color-40" alt="">
                            <?php else: ?>
                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' .  str_replace('/', '\\', $info['image'])?>" class="avatar-xxl rounded-circle border border-4 border-white-color-40">
                            <?php endif ?>
                            
                            <!-- <a href="#!" class="position-absolute top-0 right-0 me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Verified">
                            <img src="../assets/images/svg/checked-mark.svg" alt="" height="30" width="30">
                            </a> -->
                        </div>
                        <!-- text -->
                        <div class="lh-1">
                            <h2 class="mb-0"><?=$staff_info['firstname'] . ' ' . $staff_info['lastname']?>
                            <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Beginner">
                            </a>
                            </h2>
                            <p class="mb-1 d-block"><?=$isTask['res'] == true ? '<span class="badge rounded bg-success">Assigned</span>' : '<span class="badge rounded bg-danger">Not Assigned</span>'?></p>
                            <p class="mb-0 d-block"><?=$account['user_id']?></p>
                            <p class="mb-0 d-block"><?=$contact['barangay']?> Barangay Staff</p>
                        </div>
                    </div>
                </div>
                <!-- nav -->
                <ul class="nav nav-lt-tab px-4" role="tablist" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" href="#reports">Summary</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Account</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#basic_info">Basic Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact_info">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-xl-3 col-lg-3 col-md-3 col-3">
            <h4>Reports</h4>
            <p class="text-secondary">
                View record inserted
            </p>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-9" id="reports">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="text-blue-3">Summary</h4>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Total Record Inserted</label>
                    </div>
                    <div class="col-md-4 border rounded">
                        <canvas id='oscya_chart' width="200" height="200"></canvas>
                    </div>
                    <div class="col-md-5">
                        <ul>
                            <li class="form-text">
                                Out of <span class="text-danger fw-bold"><?=$all_oscya->population;?></span></span> total OSCYA <span class="text-danger fw-bold"><span class="align-middle material-icons">groups</span></span> records,  <span class="text-danger fw-bold"><?=$total_record->totalRecord;?><span class="align-middle material-icons">people</span></span> records inserted by this user
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Gender Distribution</label>
                    </div>
                    <div class="col-md-4 border rounded">
                        <canvas id='gender_chart' width="200" height="200"></canvas>
                    </div>
                    <div class="col-md-5">
                        <ul>
                            <li class="form-text">Total Male record <span class="text-danger fw-bold"><?=$male_count->Gender?></span>.</li>
                            <li class="form-text">Total Female <span class="text-danger fw-bold"><?=$female_count->Gender?></span>.</li>
                        </ul>

                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Age Distribution</label>
                    </div>
                    <div class="col-md-9 border rounded">
                        <canvas id='age_bar_chart' style="width: 100%;box-sizing:border-box;height:250px;"></canvas>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <ul>
                            <li class="form-text">Adolescence - <span class="text-danger fw-bold"><?=$ages['adolescence']?></span></li>
                            <li class="form-text">Early Adults - <span class="text-danger fw-bold"><?=$ages['earlyAdults']?></span></li>
                            <li class="form-text">Middle Adults - <span class="text-danger fw-bold"><?=$ages['middleAdults']?></span></li> 
                            <li class="form-text">Mature Adults - <span class="text-danger fw-bold"><?=$ages['matureAdults']?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-3 col-md-3 col-3">
            <h4>Basic Information</h4>
            <p class="text-secondary">
                View Staff Personal Information
            </p>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-9" id="contact_info">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="text-blue-3">Personal Information</h4>
                <?php if (!empty($info) && is_array($info)): ?>
                   
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="" class="form-label">Last name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="lastname"  id="lastname" class="form-control" value="<?=$info['lastname'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">First name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="firstname"  id="firstname" class="form-control" value="<?=$info['firstname']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Middle name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="middlename"  id="middlename" class="form-control" value="<?=$info['middlename']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Name Extension</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="suffix"  id="suffix" class="form-control" value="<?=$info['suffix']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Birthdate</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="birth"  id="birth" class="form-control" value="<?=$info['birth']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Age</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="age"  id="age" class="form-control" value="<?=$info['age']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Gender</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="gender"  id="gender" class="form-control" value="<?=$info['gender']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Civil Status</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="civil_status"  id="civil_status" class="form-control" value="<?=$info['civil_status']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Religion</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="religion"  id="religion" class="form-control" value="<?=$info['religion']?>" readonly="true">
                            </div>
                        </div>
                    
                 <?php else: ?>
                
                <?php endif ?>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-3">
            <h4>Contact Information</h4>
            <p class="text-secondary">
                View Staff Contact Information
            </p>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-9" id="basic_info">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="text-blue-3">Contact Details</h4>
                <?php if (! empty($contact) && is_array($contact)): ?>
                    <form id = "formInfo" >
                        <input type="hidden" name="staff_id" id = "staff_id" value="<?=$contact['user_id']?>">
                        <!-- <button type="button" class="btn btn-light float-end" id="editGuardianDetails">
                            <i class="bi bi-pencil-square"></i>
                        </button> -->
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="email"  id="email" class="form-control" value="<?=$contact['email'];?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Facebook</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="facebook"  id="facebook" class="form-control" value="<?=$contact['facebook']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Contact</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="contact_no"  id="contact_no" class="form-control" value="<?=$contact['contact_no']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Street</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="street"  id="street" class="form-control" value="<?=$contact['street']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Barangay</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="barangay"  id="barangay" class="form-control" value="<?=$contact['barangay']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">District</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" name="district"  id="district" class="form-control" value="<?=$contact['district']?>" readonly="true">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Zip code</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="zip_code"  id="zip_code" class="form-control" value="<?=$contact['zip_code']?>" readonly="true">
                            </div>
                            <div class="col-md-3">  
                                <label for="" class="form-label">City</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="city"  id="city" class="form-control" value="<?=$contact['city']?>" readonly="true">
                            </div>
                        </div>
                <?php else: ?>
                    <tr>No Data</tr>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

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
            icon: "fail",
            button: "Close",
        });
    <?php endif ?> 

    // const openFile = document.querySelector('#openFile');
    // const image = document.querySelector('#image');
    // const openFileManager = document.querySelector('#openFileManager');
    // const attachment = document.querySelector('#attachment');

    // const messageform = document.querySelector('#messageform');

    // messageform.addEventListener('submit', (e)=>{
    //     e.preventDefault();
    //     const formData = new FormData(messageform);
    //     // if(image != []){
    //     //     formData.append('image', image);
    //     // }else{

    //     // }
    //     // if(image != []){
    //     //     formData.append('attachment', attachment);
    //     // }else{
            
    //     // }
    //     fetch('< ?=base_url('coordinator/chat')?>', {
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => response.text())
    //     .then(data => {
    //         console.log(data)
    //     })
    //     .catch(error => {
    //         console.error(error)
    //     })
        
    // });

    // openFile.addEventListener('click', ()=>{
    //     image.click();
    // });

    // openFileManager.addEventListener('click', ()=>{
    //     attachment.click();
    // });
    const oscyaChartConf = {
        type: 'bar',
        data: {
            labels: ['All record','Staff inserted'],
            datasets: [{
                
                data: [<?=$total_record->totalRecord;?>, <?=$all_oscya->population;?>],
                backgroundColor: [
                    'rgba(13, 109, 253, 0.75)',
                    'rgba(214, 51, 132, 0.75)'
                ],
            }]
        }
    };
    
    const oscyaBarChart = new Chart(
        document.getElementById('oscya_chart').getContext('2d'),
        oscyaChartConf
    );

    const genderChartConf = {
        type: 'pie',
        label: 'Gender',
        data: {
            labels:['Male', 'Female'],
            datasets: [{
                data: [<?=$male_count->Gender?>, <?=$female_count->Gender?>],
                backgroundColor: [
                    'rgba(13, 109, 253, 0.75)',
                    'rgba(214, 51, 132, 0.75)'
                ],
            }]
        }
    };
    
    const genderBarChart = new Chart(
        document.getElementById('gender_chart').getContext('2d'),
        genderChartConf
    );

    const agesBarChartConfig = {
            type: 'bar',
            data : {
                labels:['12-20', '21-35', '36-50', '50-80'],

                datasets: [{
                    label: 'Age Chart',
                    data :[<?=$ages['adolescence']?>, <?=$ages['earlyAdults']?>, <?=$ages['middleAdults']?>, <?=$ages['matureAdults']?>],
                    backgroundColor : [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 99, 132)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
    };
    const agesBarChart = new Chart(
            document.getElementById('age_bar_chart'),
            agesBarChartConfig
    );
    
    // const accountForm = document.querySelector('#accountForm');
    // const editAccountDetails = document.querySelector('#editAccountDetails');
    // const save = document.querySelector('#save');
    // const username = document.querySelector('#username');
    // const password = document.querySelector('#password');
    // const new_password = document.querySelector('#new_password');
    // const confirm_password = document.querySelector('#confirm_password');
    
    // editAccountDetails.addEventListener('click', ()=>{
    //     username.readOnly = false;
    //     username.focus();
    //     password.readOnly = false;
    //     new_password.readOnly = false;
    //     confirm_password.readOnly = false;
    //     save.disabled = false;
    // });
    // save.addEventListener('click', (e)=>{
    //     e.preventDefault();
    //     fetch('< ?=base_url('coordinator/save_changes')?>', {
    //         method: "post",
    //         body: new FormData(accountForm)
    //     })
    //     .then(response=>response.json())
    //     .then((data)=>{
    //         if(data.class == "success"){
    //             swal({
    //                 title: "Inserted!",
    //                 text: data.message,
    //                 icon: "success",
    //                 button: "Close",
    //             });
    //         }else{
    //             swal({
    //                 title: "Inserted!",
    //                 text: data.message,
    //                 icon: "success",
    //                 button: "Close",
    //             });
    //         }
            
    //         // const message = document.querySelector('#message');
    //         // message.innerHTML = `<div class="alert ${data.class}">${data.message}</div>`;
    //         // setTimeout(()=>{
    //         //     message.innerHTML="";
    //         // }, 2000);
    //     })
    // })
    
</script>