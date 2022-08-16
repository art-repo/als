</div>
<?php if(isset($barangay_coord) && is_array($barangay_coord)): ?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <!-- Bg -->
                <div class="pt-20 rounded-top" style="background: url(<?=base_url('public/uploads/assets/profiles/rb.png')?>) no-repeat;background-size: cover;">
                </div>
                <div class="bg-white rounded-bottom smooth-shadow-sm ">
                    <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                        <div class="d-flex align-items-center">
                            <!-- avatar -->
                            <div class="avatar-xxl me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                                <?php if(empty($barangay_coord['logo']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $barangay_coord['logo']))):?>
                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xxl rounded-circle"/>
                                <?php else: ?>
                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $barangay_coord['logo']?>" class="avatar-xxl rounded-circle" />
                                <?php endif ?>
                            </div>
                            <!-- text -->
                            <div class="lh-1">
                                <h2 class="mb-0">Barangay <?=$barangay_coord['barangay']?></h2>
                                <p class="mb-0 d-block"><?=$barangay_coord['email']?></p>
                            </div>
                        </div>
                
                    </div>
                    <!-- nav -->
                    <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="task-tab" data-bs-toggle="tab" href="#task" role="tab" aria-controls="task" aria-selected="true">Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="schedule-tab" data-bs-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">Schedules</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="announcement-tab" data-bs-toggle="tab" href="#announcement" role="tab" aria-controls="announcement" aria-selected="false">Announcement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="records-tab" data-bs-toggle="tab" href="#records" role="tab" aria-controls="records" aria-selected="false">Records</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 ">
                
            </div>
        </div>
    </div>
<?php endif?>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="task-tab">
        <div class="container-fluid">
            <div class="row g-3 mb-3">
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0 fw-bold">Tasks</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-danger text-danger rounded-2">
                                    <span class="material-icons">task</span>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$count_tasks['all_task']?></h1>
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
                                    <h4 class="mb-0 fw-bold">OSY Population</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-success text-success rounded-2">
                                    <span class="material-icons">people_alt</span>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$count_osy['osy']?></h1>
                                <span class="text-secondary">Total OSY population</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="all-task-tab" data-bs-toggle="tab" href="#all-task" role="tab" aria-controls="all-task" aria-selected="true">All Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ongoing-task-tab" data-bs-toggle="tab" href="#ongoing-task" role="tab" aria-controls="ongoing-task" aria-selected="true">Ongoing Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="accomplished-task-tab" data-bs-toggle="tab" href="#accomplished-task" role="tab" aria-controls="accomplished-task" aria-selected="false">Accomplished Task</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white " id="myTabContent">
                        <div class="tab-pane fade show active" id="all-task" role="tabpanel" aria-labelledby="all-task-tab">
                            <div class="row justify-content-end">
                                <div class="col-md-3 py-2">
                                    <input type="search" name="search_bar" id="all_task_search_bar" class="form-control" onkeyup="all_task()" placeholder="Search Name">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 border-start border-end" id="all_task_table">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Facility</th>
                                            <th>Schedule</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($all_tasks) && is_array($all_tasks) && !empty($all_tasks)): ?>
                                            <?php foreach($all_tasks as $all_task):?>
                                                <tr>
                                                    <td class="align-middle"><?=$all_task['staff_id']?></td>
                                                    <td class="align-middle"><?=$all_task['fullname']?></td>
                                                    <td class="align-middle"><?=$all_task['is_done'] == 1 ? '<span class="badge bg-success">Done</span>' : '<span class="badge bg-warning text-dark">On going</span>'?></td>
                                                    <td class="align-middle"><?=$all_task['name']?></td>
                                                    <td class="align-middle text-dark">
                                                        <?=date('M d Y', strtotime($all_task['sched_date']));?><br>
                                                        <small class="text-secondary"><?=date('h:i A', strtotime($all_task['start_time'])) . ' - ' . date('h:i A', strtotime($all_task['end_time']));?> </small>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown dropstart">
                                                            <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="icon-xxs" data-feather="more-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                                <a class="dropdown-item" href="<?=base_url('teacher/staff_records') . '/' . $all_task['staff_id']?>">
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
                                                <td colspan="5" class="bg-light-warning text-center">
                                                    <span class="fw-bold-align-middle">You haven't accomplish any tasks</span>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="ongoing-task" role="tabpanel" aria-labelledby="ongoing-task-tab">
                            <div class="row justify-content-end">
                                <div class="col-md-3 py-2">
                                    <input type="search" name="search_bar" id="ongoing_task_search_bar" class="form-control" onkeyup="ongoing_task()" placeholder="Search Name">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0" id="ongoing_task_table">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Facility</th>
                                            <th>Schedule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($ongoing_tasks) && is_array($ongoing_tasks) && !empty($ongoing_tasks)): ?>
                                            <?php foreach($ongoing_tasks as $ongoing_task):?>
                                                <tr>
                                                    <td class="align-middle"><?=$ongoing_task['staff_id']?></td>
                                                    <td class="align-middle"><?=$ongoing_task['fullname']?></td>
                                                    <td class="align-middle"><span class="badge bg-warning text-dark">On going</span></td>
                                                    <td class="align-middle"><?=$ongoing_task['name']?></td>
                                                    <td class="align-middle text-dark">
                                                        <?=date('M d Y', strtotime($ongoing_task['sched_date']));?><br>
                                                        <small class="text-secondary"><?=date('h:i A', strtotime($ongoing_task['start_time'])) . ' - ' . date('h:i A', strtotime($ongoing_task['end_time']));?></small> 
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown dropstart">
                                                            <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="icon-xxs" data-feather="more-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                                <a class="dropdown-item" href="<?=base_url('teacher/staff_records') . '/' . $ongoing_task['staff_id']?>">
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
                                                <td colspan="5" class="bg-light-warning text-center">
                                                    <span class="fw-bold-align-middle">You haven't accomplish any tasks</span>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="accomplished-task" role="tabpanel" aria-labelledby="accomplished-task-tab">
                            <div class="row justify-content-end">
                                <div class="col-md-3 py-2">
                                    <input type="search" name="search_bar" id="accomplished_task_search_bar" class="form-control" onkeyup="accomplished_task()" placeholder="Search Name">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0">
                                    <thead class="bg-white">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Facility</th>
                                            <th>Schedule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($accomplished_tasks) && is_array($accomplished_tasks) && !empty($accomplished_tasks)): ?>
                                            <?php foreach($accomplished_tasks as $accomplished_task):?>
                                                <tr>
                                                    <td class="align-middle"><?=$accomplished_task['staff_id']?></td>
                                                    <td class="align-middle"><?=$accomplished_task['fullname']?></td>
                                                    <td class="align-middle"><span class="badge bg-success">Done</span></td>
                                                    <td class="align-middle"><?=$accomplished_task['name']?></td>
                                                    <td class="align-middle text-dark">
                                                        <?=date('M d Y', strtotime($accomplished_task['sched_date']));?><br>
                                                        <small class="text-secondary"><?=date('h:i A', strtotime($accomplished_task['start_time'])) . ' - ' . date('h:i A', strtotime($accomplished_task['end_time']));?></small>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="dropdown dropstart">
                                                            <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="icon-xxs" data-feather="more-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                                <a class="dropdown-item" href="<?=base_url('teacher/staff_records') . '/' . $accomplished_task['staff_id']?>">
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
                                                <td colspan="5" class="bg-light-warning text-center">
                                                    <span class="fw-bold-align-middle">You haven't accomplish any tasks</span>
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
    <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
        
    </div>
    <div class="tab-pane fade" id="announcement" role="tabpanel" aria-labelledby="announcement-tab">

    </div>
    <div class="tab-pane fade" id="records" role="tabpanel" aria-labelledby="records-tab">
        <div class="container-fluid mt-5">
        <div class="card rounded">
            <div class="card-header bg-white">
                <div class="row justify-content-end">
                    <div class="col-md-3 text-end">
                        <input type="search" name="search_bar" id="search_bar" class="form-control" onkeyup="myFunction()">
                    </div>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0" id="records_table">
                <thead class="bg-white">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Barangay</th>
                        <th>Schedule</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($counseled_records) && is_array($counseled_records) && !empty($counseled_records)): ?>
                        <?php foreach($counseled_records as $counseled_record):?>
                            <tr>
                                <td class="align-middle"><?=$counseled_record['oscya_id']?></td>
                                <td class="align-middle"><?=$counseled_record['fullname']?></td>
                                <td class="align-middle"><span class="badge bg-success">Done</span></td>
                                <td class="align-middle"><?=$counseled_record['brgy']?></td>
                                <td class="align-middle text-dark">
                                    <?=date('M d Y', strtotime($counseled_record['counsel_date']));?><br>
                                </td>
                                <td class="align-middle">
                                    <div class="dropdown dropstart">
                                        <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-xxs" data-feather="more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                            <a class="dropdown-item" href="<?=base_url('teacher/view_oscya_record') . '/' . $counseled_record['oscya_id']?>">
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
                            <td colspan="5" class="bg-light-warning text-center">
                                <span class="fw-bold-align-middle">You haven't accomplish any tasks</span>
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

<script>
    const records_table = document.querySelector('#records_table');
    const search_bar = document.querySelector('#search_bar');
    const all_task_table = document.querySelector('#all_task_table');
    const all_task_search_bar = document.querySelector('#all_task_search_bar');
    const ongoing_task_table = document.querySelector('#ongoing_task_table');
    const ongoing_task_search_bar = document.querySelector('#ongoing_task_search_bar');
    const accomplished_task_table = document.querySelector('#accomplished_task_table');
    const accomplished_task_search_bar = document.querySelector('#accomplished_task_search_bar');

    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = search_bar;
        filter = input.value.toUpperCase();
        table = records_table;
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
    function all_task() {
        var input, filter, table, tr, td, i, txtValue;
        input = all_task_search_bar;
        filter = input.value.toUpperCase();
        table = all_task_table;
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
    function ongoing_task() {
        var input, filter, table, tr, td, i, txtValue;
        input = ongoing_task_search_bar;
        filter = input.value.toUpperCase();
        table = ongoing_task_table;
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
    function accomplished_task() {
        var input, filter, table, tr, td, i, txtValue;
        input = accomplished_task_search_bar;
        filter = input.value.toUpperCase();
        table = accomplished_task_table;
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>