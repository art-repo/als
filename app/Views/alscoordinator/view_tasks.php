<div class="row mt-6">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card">
            <!-- card header  -->
            <div class="card-header bg-white  py-4">
                <h4 class="mb-0">Active Tasks</h4>
            </div>
            <!-- table  -->
            <div class="table-responsive">
                <table class="table table-hover text-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Staff</th>
                            <th>Barangay</th>
                            <th>Status</th>
                            <th>Schedule</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($tasks) && is_array($tasks)):?>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td class="align-middle">
                                        <span><?=$task['id']?></span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="icon-shape icon-md border p-4 rounded-1">
                                                    <?php if(empty($task['profile']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $task['profile']))): ?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="profilepic" class="avatar avatar-md">
                                                    <?php else: ?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/<?=$task['profile']?>" alt="profilepic" class="avatar avatar-md">
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1"><a href="<?=base_url('alscoordinator/view_staff_records') .'/'. $task['staff_id']?>" class="text-inherit"><?=$task['fullname']?></a></h5>
                                                <small class="m-0 fw-bold"><?=$task['staff_id']?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-bold"><?=$task['barangay']?></span>
                                    </td>
                                    <td class="align-middle">
                                        <?=$task['is_done'] == 0 ?'<span class="badge bg-warning text-dark">On going</span>' : '<span class="badge bg-warning text-dark">Done</span>'?>
                                    </td>
                                    <td class="align-middle">
                                        <small class="fw-bold"><?=date('F j, Y', strtotime($task['sched_date']))?></small>
                                    </td>
                                    <td class="align-middle">
                                        <small class="fw-bold"><?=date('h:i a', strtotime($task['start_time'])) . '-' . date('h:i a', strtotime($task['end_time']))?></small>
                                    </td>
                                    <td class="align-middle">
                                        <!-- Dropstart -->
                                        <div class="dropdown dropstart">
                                            <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical" class="icon-xxs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                <h6 class="dropdown-header">Action</h6>
                                                <a class="dropdown-item" href="<?=base_url('alscoordinator/view_staff_records') .'/'. $task['staff_id']?>">
                                                    <i data-feather="eye" class="icon-xs me-2"></i>
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>