</div>
<div class="container-fluid">
     <!-- javascript behaviour -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="new-tab" data-bs-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">New</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Approved</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active bg-white" id="new" role="tabpanel" aria-labelledby="new-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="bg-white">
                        <!-- card header  -->
                        <div class="card-header bg-white  py-4">
                            <h4 class="mb-0">Teacher Registration</h4>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>District</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($registration) && is_array($registration)):?>
                                        <?php foreach($registration as $teacher):?>
                                            <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3 lh-1">
                                                        <h5 class=" mb-1 fw-bold"><?=$teacher['user_id']?></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?=$teacher['username']?></td>
                                            <td class="align-middle"><span class="badge bg-warning text-dark">For Evaluation</span></td>
                                            <td class="align-middle"><?=$teacher['district']?></td>
                                            <td class="align-middle text-dark">
                                                <!-- Dropstart -->
                                                <div class="dropdown dropstart">
                                                    <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" class="icon-xxs"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <h6 class="dropdown-header">Action</h6>
                                                        <a class="dropdown-item" href="<?=base_url('alscoordinator/teacher_registration_info') . '/' . $teacher['user_id']?>">
                                                            <i data-feather="eye" class="icon-xxs"></i>    
                                                            View
                                                        </a>
                                                        <!-- <a class="dropdown-item" href="#">
                                                            <i data-feather="archive" class="icon-xxs"></i>
                                                            Archive
                                                        </a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php else: ?>

                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="bg-white">
                        <!-- card header  -->
                        <div class="card-header bg-white  py-4">
                            <h4 class="mb-0">Pending Registration</h4>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>District</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($pending) && is_array($pending)):?>
                                        <?php foreach($pending as $teacher):?>
                                            <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3 lh-1">
                                                        <h5 class=" mb-1 fw-bold"><?=$teacher['user_id']?></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?=$teacher['username']?></td>
                                            
                                            <td class="align-middle"><span class="badge bg-warning text-dark">For Evaluation</span></td>
                                            <td class="align-middle"><?=$teacher['district']?></td>
                                            <td class="align-middle text-dark">
                                                <!-- Dropstart -->
                                                <div class="dropdown dropstart">
                                                    <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" class="icon-xxs"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <h6 class="dropdown-header">Action</h6>
                                                        <a class="dropdown-item" href="<?=base_url('alscoordinator/teacher_registration_info') . '/' . $teacher['user_id']?>">
                                                            <i data-feather="eye" class="icon-xxs"></i>    
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php else: ?>

                                    <?php endif ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="bg-white">
                        <!-- card header  -->
                        <div class="card-header bg-white  py-4">
                            <h4 class="mb-0">Approved</h4>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>District</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($approved) && is_array($approved)):?>
                                        <?php foreach($approved as $teacher):?>
                                            <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3 lh-1">
                                                        <h5 class=" mb-1 fw-bold"><?=$teacher['user_id']?></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><?=$teacher['username']?></td>
                                            
                                            <td class="align-middle"><span class="badge bg-success">Approved</span></td>
                                            <td class="align-middle"><?=$teacher['district']?></td>
                                            <td class="align-middle text-dark">
                                                <!-- Dropstart -->
                                                <div class="dropdown dropstart">
                                                    <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" class="icon-xxs"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <h6 class="dropdown-header">Action</h6>
                                                        <a class="dropdown-item" href="<?=base_url('alscoordinator/teacher_registration_info') . '/' . $teacher['user_id']?>">
                                                            <i data-feather="eye" class="icon-xxs"></i>    
                                                            View
                                                        </a>
                                                        <!-- <a class="dropdown-item" href="#">
                                                            <i data-feather="archive" class="icon-xxs"></i>
                                                            Archive
                                                        </a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php else: ?>

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
            </script>