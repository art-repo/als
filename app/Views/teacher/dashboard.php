    <h3 class="text-secondary fw-bold">DASHBOARD</h3>
</div>
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">All Tasks</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
                            <i class="icon-sm" data-feather="list"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$count_all_tasks['all_task']?></h1>
                        <span class="text-secondary">Number of Task Assigned</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Completed</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-success text-success rounded-2">
                        <i class="bi bi-check-circle" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$count_completed_tasks['completed_task']?></h1>
                        <span class="text-secondary">Accomplished Tasks</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">On going</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-danger text-danger rounded-2">
                            <i class="bi bi-hourglass-split" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$count_all_tasks['all_task'] - $count_completed_tasks['completed_task']?></h1>
                        <span class="text-secondary">Number of Ongoing Task</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">On going</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-danger text-danger rounded-2">
                            <i class="bi bi-hourglass-split" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$count_all_tasks['all_task'] - $count_completed_tasks['completed_task']?></h1>
                        <span class="text-secondary">Number of Ongoing Task</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-5">
                <canvas id="mychart"></canvas>
                <span class="fw-bold fs-3 text-center text-dark">
                    Tasks
                </span>
                <div class="d-flex align-items-center justify-content-around">
                    <div class="text-center">
                        <i class="icon-sm text-success" data-feather="trending-up"></i>
                        <h1 class="mt-3  mb-1 fw-bold"><?=$count_completed_tasks['completed_task']?></h1>
                        <p>Completed</p>
                    </div>
                    <div class="text-center">
                        <i class="icon-sm text-danger" data-feather="trending-down"></i>
                        <h1 class="mt-3  mb-1 fw-bold"><?=$count_all_tasks['all_task'] - $count_completed_tasks['completed_task']?></h1>
                        <p>On going</p>
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-md-8">
            <div class="card">
                <!-- card header  -->
                    <div class="card-header bg-white py-4">
                        <h4 class="mb-0">Your Tasks</h4>
                    </div>
                    <!-- table  -->
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Staff</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Barangay</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($t_tasks) && is_array($t_tasks)): ?>
                                    <?php foreach ($t_tasks as $task): ?>
                                        <tr>
                                            <td class="align-middle"><?=$task['id']?></td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <?php if(empty($task['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $task['image']))):?>
                                                        <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-sm rounded"/>
                                                    <?php else: ?>
                                                        <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $task['image']?>" class="avatar avatar-sm rounded-circle" />
                                                    <?php endif ?>
                                                    <div class="ms-3 lh-1">
                                                        <h5 class=" mb-1"> <a href="#" class="text-inherit"><?=$task['name']?></a></h5>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="align-middle"><?=$task['sched_date']?></td>
                                            <td class="align-middle"><?=$task['is_done'] == 1 ? '<span class="badge bg-success">Completed</span>' : '<span class="badge bg-warning text-dark">On going</span>' ?></td>
                                            <td class="align-middle text-dark"><?=$task['barangay']?></td>
                                            <td class="align-middle">
                                                <div class="dropdown dropstart">
                                                    <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="icon-xxs" data-feather="more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                        <a class="dropdown-item" href="<?=base_url('teacher/staff_records') . '/' . $task['staff_id']?>">
                                                            <i class="icon-sm" data-feather="eye"></i>
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">
                                            No Assign Task
                                        </td>
                                    </tr>
                                <?php endif ?> 
                            </tbody>
                        </table>
                    </div>
                    <!-- card footer  -->
                    <div class="card-footer bg-white text-center">
                        <a href="#" class="link-primary">View All Task</a>
                    </div>
                </div>
        </div>
        <div class="col-md-4">
            <div class="card p-5">

            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const config = {
        type: 'doughnut',
        data: {
            labels: [
                'Done',
                'On going',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?=$count_completed_tasks['completed_task']?>, <?=$count_all_tasks['all_task'] - $count_completed_tasks['completed_task']?>],
                backgroundColor: [
                    '#198754',
                    '#ffc107',
                ],
                hoverOffset: 4
            }]
        },
    };
    
    const myChart = new Chart(
        document.getElementById('mychart'), 
        config    
    );
</script>