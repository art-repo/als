    <br>
    <h3 class="fw-bold text-secondary"><?=$indexes['title']?></h3>
    <hr>
</div>

<div class="container-fluid p-3">
    <div class="row g-3">
        
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Online Staff</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-success text-success rounded-2">
                            <!-- <i class="icon-sm" data-feather="check-circle"></i> -->
                            <i class="material-icons-outlined text-success" style="font-size: 30px;">person</i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$active_user['active']?></h1>
                        <p class="mb-0">Number of Active Staff</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Offline Staff</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-danger text-danger rounded-2">
                            <!-- <i class="icon-sm" data-feather="check-circle"></i> -->
                            <i class="material-icons-outlined text-danger" style="font-size: 30px;">person</i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$inactive_user['inactive']?></h1>
                        <p class="mb-0">Number of offline staff</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">All Users</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
                            <!-- <i class="icon-sm" data-feather="check-circle"></i> -->
                            <i class="material-icons-outlined text-warning" style="font-size: 30px;">people_alt</i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$count_user['users']?></h1>
                        <p class="mb-0">All Users</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Tasks</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-info text-info rounded-2">
                            <!-- <i class="icon-sm" data-feather="check-circle"></i> -->
                            <i class="material-icons-outlined text-info" style="font-size: 30px;">task</i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?=$count_tasks['all_tasks']?></h1>
                        <p class="mb-0">All Tasks</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row gy-3">
                <div class="col-md-12">
                    <!-- card  -->
                    <div class="card shadow">
                        <!-- card header  -->
                        <div class="card-header bg-white">
                            <div class="row justify-content-between">
                                <div class="col-md-3">
                                    <h4 class="pt-2">Staffs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0" id="staff_table">
                                <thead class="table-light">
                                    <tr>
                                        <th >Profile</th>
                                        <th >Fullname</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users) && is_array($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="icon-shape icon-sm border rounded-circle">
                                                            <?php if(empty( $user['profile']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\', $user['profile']))): ?>
                                                                <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="avatar avatar-sm rounded-circle">
                                                            <?php else: ?>
                                                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $user['profile']?>" class="avatar avatar-sm rounded-circle">
                                                            <?php endif ?>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 lh-1">
                                                            <h5 class=" mb-1"> <a href="#" class="text-inherit"><?=$user['user_id'];?></a></h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle"><?=$user['fullname'];?></td>
                                                <td class="align-middle">
                                                    <div class="dropdown ms-2">
                                                        <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-xs" data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                                            <ul class="list-unstyled">
                                                                <li class="mb-1">
                                                                    <a class="dropdown-item" href="<?=base_url('coordinator/view_staff') . '/' . $user['user_id']?>">
                                                                        <i class="me-2 icon-sm dropdown-item-icon" data-feather="eye"></i>
                                                                        View
                                                                    </a>
                                                                </li>
                                                                <li class="mb-1">
                                                                    <a class="dropdown-item" href="<?=base_url('coordinator/view_staff') . '/' . $user['user_id']?>">
                                                                        <i class="me-2 icon-sm dropdown-item-icon" data-feather="bar-chart"></i>
                                                                        Reports
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- card footer  -->
                        <div class="card-footer bg-white text-center">
                            <a href="<?=base_url('coordinator/staff')?>" class="link-primary">View All Staff</a>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- card -->
                    <div class="card shadow">
                        <!-- card body -->
                        <div class="card-body">
                            <h4 class="card-title">Assigned Tasks</h4>
                            <?php if(!empty($assigned_tasks) && is_array($assigned_tasks)): ?>
                                <?php foreach($assigned_tasks as $assigned_task): ?>
                                    <div class="d-md-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <?php if(empty($assigned_task['facility_image']) || !file_exists(FCPATH . "uploads/assets/profiles/" . $assigned_task['facility_image'] )):?>
                                                <img class="avatar avatar-md rounded" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="">
                                            <?php else: ?>
                                                <img class="avatar avatar-md rounded" src="<?=base_url('public/uploads/assets/profiles') . "/" . $assigned_task['facility_image']?>" alt="">
                                            <?php endif ?>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <!-- text -->
                                            <div class="ms-3">
                                                <h5 class="mb-1"><a href="#" class="text-inherit"><?=$assigned_task['name']?></a></h5>
                                                <p class="mb-0 fs-5 text-muted"><?=$assigned_task['address']?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center ms-10 ms-md-0 mt-3">
                                            <!-- avatar group -->
                                            <div class="avatar-group me-2">
                                                <!-- img -->
                                                <span class="avatar avatar-sm">
                                                    <?php if(empty($assigned_task['teacher_image']) || !file_exists(FCPATH . "uploads/assets/profiles/" . $assigned_task['teacher_image'] )):?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="">
                                                    <?php else: ?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles') . "/" . $assigned_task['teacher_image']?>" class="rounded-circle">
                                                    <?php endif ?>
                                                </span>
                                                <!-- img -->
                                                <span class="avatar avatar-sm">
                                                    <?php if(empty($assigned_task['staff_image']) || !file_exists(FCPATH . "uploads/assets/profiles/" . $assigned_task['staff_image'] )):?>
                                                        <img class="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="">
                                                    <?php else: ?>
                                                        <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . "/" . $assigned_task['staff_image']?>" class="rounded-circle">
                                                    <?php endif ?>
                                                </span>
                                                
                                            </div>
                                            <div>
                                                <div class="dropdown dropstart">
                                                    <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" class="icon-xxs"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <a class="dropdown-item" href="<?=base_url('coordinator/view_teacher') . '/' . $assigned_task['teacher_id']  ?>">
                                                            <span class="material-icons-outlined align-middle">visibility</span>
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>

                            <?php endif ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white shadow ">
                <div class="card-body bg-white rounded">
                     <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

                    
         
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>
    const staff_table = document.querySelector('#staff_table');
    const search_bar = document.querySelector('#search_bar');
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = search_bar;
        filter = input.value.toUpperCase();
        table = staff_table;
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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            // initialDate: '2022-03-07',
            headerToolbar: {
            // left: 'prev,next',
            // //left: 'prev,next today',
            // center: 'title'
            right: 'prev,next'
            // right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                <?php foreach($activities as $activity): ?>
                    {
                        title: 'Community Mapping',
                        <?php if(!empty($activity['link'])): ?>
                            url: '<?=$activity['link']?>',
                        <?php endif ?>
                        start: '<?=$activity['sched_date'];?>T<?=$activity['start_time']?>',
                        end: '<?=$activity['sched_date'];?>T<?=$activity['end_time']?>'
                    },
                <?php endforeach ?>
            ]
            
        });

        calendar.render();
    });
    
</script>
<!-- <script>
    const BarChartConfig = {
            type: 'bar',
            data: {
                labels: ['Male','Female'],
                datasets: [{
                    label: 'Gender Chart',
                    data: [< ?=$maleCount?>, < ?=$femaleCount?>],
                    backgroundColor: [
                        'rgba(13, 109, 253, 0.2)',
                        'rgba(214, 51, 132, 0.2)'
                    ],
                    borderColor : [
                        'rgb(13, 110, 253)',
                        'rgb(214, 51, 132)'
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
        const genderBarChart = new Chart(
            document.getElementById('genderBarChart'),
            genderBarChartConfig
        );
</script> -->