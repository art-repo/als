</div>


<div class="container-fluid p-4">
    <div class="row align-items-center mb-3">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 mb-4 ">
                <h3 class="mb-0 fw-bold">Teacher's Profile</h3>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Bg -->
            <div class="pt-20 rounded-top" style="background:url(<?=base_url('public/uploads/assets/profiles') . '/'. 'rb.png'?>) no-repeat; background-size: cover;">
            </div>
            <div class="bg-white rounded-bottom smooth-shadow-sm">
                <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                    <div class="d-flex align-items-center">
                        <!-- avatar -->
                        <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                            <?php if(empty($teacher_info['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $teacher_info['image']))){?>
                                <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xxl rounded-circle border border-4 border-white-color-40" alt="">
                            <?php }else{ ?>
                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' .  str_replace('/', '\\', $teacher_info['image'])?>" class="avatar-xxl rounded-circle border border-4 border-white-color-40">
                            <?php } ?>
                            
                            <!-- <a href="#!" class="position-absolute top-0 right-0 me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Verified">
                            <img src="../assets/images/svg/checked-mark.svg" alt="" height="30" width="30">
                            </a> -->
                        </div>
                        <!-- text -->
                        <div class="lh-1">
                            <h2 class="mb-0"><?=$teacher_info['firstname'] . ' ' . $teacher_info['lastname']?>
                                <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Beginner">
                                </a>
                            </h2>
                            
                            <p class="mb-0 d-block"><?=$teacher_info['user_id']?></p>
                            <p class="mb-0 d-block">District <?=$teacher_contact['district']?> </p>
                        </div>
                    </div>
                </div>
                <!-- nav -->
                <ul class="nav nav-lt-tab px-4" role="tablist" id="myTab">
                
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tasks</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row g-3 mb-3">
                <div class="col-xl-3 col-lg-3 col-md-3 col-3">
                    <h4>Basic Information</h4>
                    <p class="text-secondary">
                        View Staff Personal Information
                    </p>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-9" id="basic_info">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h4 class="text-blue-3">Personal Information</h4>
                        <?php if (!empty($teacher_info) && is_array($teacher_info)): ?>
                        
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Last name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="lastname"  id="lastname" class="form-control" value="<?=$teacher_info['lastname'];?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">First name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="firstname"  id="firstname" class="form-control" value="<?=$teacher_info['firstname']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Middle name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="middlename"  id="middlename" class="form-control" value="<?=$teacher_info['middlename']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Name Extension</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="suffix"  id="suffix" class="form-control" value="<?=$teacher_info['ext']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Birthdate</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="date" name="birth"  id="birth" class="form-control" value="<?=$teacher_info['birthdate']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Age</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number" name="age"  id="age" class="form-control" value="<?=$teacher_info['age']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Gender</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="gender"  id="gender" class="form-control" value="<?=$teacher_info['gender']?>" readonly="true">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label for="" class="form-label">Civil Status</label>
                                    </div>
                                <div class="col-md-9">
                                        <input type="text" name="civil_status"  id="civil_status" class="form-control" value="< ?=$teacher_info['civil_status']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Religion</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="religion"  id="religion" class="form-control" value="< ?=$teacher_info['religion']?>" readonly="true">
                                    </div> -->
                                </div>
                            
                        <?php else: ?>
                        
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row g-3 mb-3">
                <div class="col-xl-3 col-lg-3 col-md-3 col-3">
                    <h4>Contact Information</h4>
                    <p class="text-secondary">
                        View Staff Contact Information
                    </p>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-9" id="contact_info">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h4 class="text-blue-3">Contact Details</h4>
                        <?php if (! empty($teacher_contact) && is_array($teacher_contact)): ?>
                            <form id = "formInfo" >
                                <input type="hidden" name="staff_id" id = "staff_id" value="<?=$teacher_contact['user_id']?>">
                                <!-- <button type="button" class="btn btn-light float-end" id="editGuardianDetails">
                                    <i class="bi bi-pencil-square"></i>
                                </button> -->
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="email"  id="email" class="form-control" value="<?=$teacher_contact['email'];?>" readonly="true">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label for="" class="form-label">Facebook</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="facebook"  id="facebook" class="form-control" value="< ?=$teacher_contact['facebook']?>" readonly="true">
                                    </div> -->
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Contact</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="contact_no"  id="contact_no" class="form-control" value="<?=$teacher_contact['contact_no']?>" readonly="true">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label for="" class="form-label">Street</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="street"  id="street" class="form-control" value="< ?=$teacher_contact['street']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Barangay</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="barangay"  id="barangay" class="form-control" value="< ?=$teacher_contact['barangay']?>" readonly="true">
                                    </div>-->
                                    <div class="col-md-3"> 
                                        <label for="" class="form-label">District</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number" name="district"  id="district" class="form-control" value="<?=$teacher_contact['district']?>" readonly="true">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label for="" class="form-label">Zip code</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="zip_code"  id="zip_code" class="form-control" value="< ?=$teacher_contact['zipcode']?>" readonly="true">
                                    </div>
                                    <div class="col-md-3">  
                                        <label for="" class="form-label">City</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="city"  id="city" class="form-control" value="< ?=$teacher_contact['city']?>" readonly="true">
                                    </div> -->
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Valid ID</label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php if(empty($teacher_credential['id_loc']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $teacher_credential['id_loc']))){?>
                                            <label for="form-label">No Credential</label>
                                        <?php }else{ ?>
                                            <img src="<?=base_url('public/uploads/assets/profiles') . '/' .  str_replace('/', '\\', $teacher_credential['id_loc'])?>" class="img-fluid">
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php else: ?>
                            <tr>No Data</tr>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <!-- card  -->
                    <div class="card">
                        <!-- card header  -->
                        <div class="card-header bg-white py-4">
                            <div class="row justify-content-between" id="backtotop">
                                <div class="col-md-3">
                                    <span class="text-start fw-bold">
                                        All Records
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <input type="search" id="search_bar" placeholder="Search lastname" class="form-control" onkeyup="myFunction()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0" id="staff-table">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Full name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (! empty($staffs) && is_array($staffs)): ?>
                                        <?php foreach ($staffs as $staff): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="icon-shape icon-sm">
                                                                <?php if(empty($staff['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\', $staff['image']))): ?>
                                                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="avatar avatar-sm rounded-circle">
                                                                <?php else : ?>
                                                                        <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $staff['image']?>" class="avatar avatar-sm rounded-circle">
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 lh-1">
                                                            <h5 class=" mb-1"><?= $staff['user_id']?></h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle"><small class="text-secondary"><?=$staff['name']?></small></td>
                                                
                                                <td class="align-middle">
                                                    <?php if($staff['status'] == 1): ?>
                                                        <span class="badge bg-success">Online</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Offline</span>
                                                    <?php endif ?>

                                                </td>
                                                <td class="align-middle text-dark">
                                                    <!-- Dropstart -->
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" class="icon-xxs"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                            <h6 class="dropdown-header">Action</h6>
                                                            <a class="dropdown-item" href="<?=base_url('coordinator/view_staff') . '/' . strtolower($staff['user_id'])?>">
                                                                <i data-feather="eye" class="icon-xxs"></i>
                                                                View
                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>

                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- card footer  -->
                        <div class="card-footer bg-white text-center">
                            <br>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>
</div>