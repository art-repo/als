</div>
<div class="container-fluid">
    <div class="row g-3 mt-6">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">All Users</h4>
                        </div>
                        <div class="icon-shape rounded-circle icon-md bg-light-primary text-primary rounded-2">
                            <i class="icon-sm" data-feather="users"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$coord_count + $staff + $teacher;?></h1>
                        <p class="mb-0"><span class="text-success me-2">5</span>Offline</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Teacher</h4>
                        </div>
                        <div class="icon-shape rounded-circle icon-md bg-light-success text-success rounded-2">
                            <i class="icon-sm" data-feather="users"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$teacher?></h1>
                        <p class="mb-0"><span class="text-success me-2">5</span>Offline</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Coordinator</h4>
                        </div>
                        <div class="icon-shape rounded-circle icon-md bg-light-warning text-warning rounded-2">
                            <i class="icon-sm" data-feather="users"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$coord_count?></h1>
                        <p class="mb-0"><span class="text-success me-2">5</span>Offline</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Active Staff</h4>
                        </div>
                        <div class="icon-shape rounded-circle icon-md bg-light-danger text-danger rounded-2">
                            <i class="icon-sm" data-feather="users"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$staff?></h1>
                        <p class="mb-0"><span class="text-success me-2">5</span>Offline</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <!-- card  -->
            <div class="card">
                <!-- card header  -->
                <div class="card-header bg-white  py-4">
                    <h4 class="mb-0">Barangay Coordinator</h4>
                </div>
                <!-- table  -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($coordinator) || is_array($coordinator)): ?>
                                <?php foreach ($coordinator as $user): ?>
                                    <tr>
                                        <td class="align-middle"> <?=$user['id']?></td>
                                        <td class="align-middle"><?=$user['user_id']?></td>
                                        
                                        <td class="align-middle"><?= $user['username'] ?></td>
                                        <td class="align-middle"><?= $user['user_type'] ?></td>
                                        <td class="align-middle">
                                           <?=$user['status'] == 0 ? '<span class="badge bg-danger">Offline</span>' : '<span class="badge bg-success">Online</span>'; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <!-- card footer  -->
                <div class="card-footer bg-white text-center">
                    <a href="<?=base_url('alscoordinator/barangay')?>" class="link-primary">View All Barangay</a>
                </div>
            </div>
        </div>
    </div>
</div>