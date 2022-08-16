    <div class="row align-items-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Bg -->
            <div class="pt-20 rounded-top" style="background: url(<?=base_url('public/uploads/assets/profiles')?>/rb.png) no-repeat; background-size: cover;"></div>
            <div class="bg-white rounded-bottom smooth-shadow-sm ">
                
                <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                    <div class="d-flex align-items-center">
                        <!-- avatar -->
                        <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end  align-items-end mt-n10">
                            <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar-xxl rounded-circle border border-4 border-white-color-40" alt="">
                            
                        </div>
                        <!-- text -->
                        <div class="lh-1">
                            <h2 class="mb-0"><?php echo $s_info['firstname'] . ' ' . $s_info['lastname']?> 
                            <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Beginner">

                            </a>
                            </h2>
                            <p class="mb-0 d-block"><?php echo $s_contact['email']?></p>
                        </div>
                        
                        <?php if(isset($is_tasked) && $is_tasked['assigned'] == true): ?>
                            <p><span class="badge bg-success">Assigned</span></p>
                        <?php else : ?>
                            <p><span class="badge bg-danger">Not Assigned</span></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- nav -->
                <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills_report" role="tab" aria-controls="pills_reports" aria-selected="false">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#pills_records" role="tab" aria-controls="pills_records" aria-selected="true">Records</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Assign To</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('alscoordinator/assign_task') . '/' . $user_id['staff_id']?>" method="post">
                    <?=csrf_field()?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="teacher_select" class="form-label">Teacher</label>
                            <select name="teacher_id" id="teacher_select" class="form-select">
                                <option selected>Select Teacher</option>
                                <?php if(isset($teachers) && !empty($teachers) && is_array($teachers)): ?>
                                    <?php foreach($teachers as $teacher): ?>
                                        <option value="<?=$teacher['user_id']?>"><?=$teacher['fullname']?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="schedule_date" class="form-label">Set Schedule</label>
                            <input type="date" name="schedule_date" id="schedule_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="schedule_date" class="form-label">Set Time</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_time" class="form-label">Start</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time" class="form-label">End</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <?php if(isset($is_tasked) && $is_tasked['assigned'] == true): ?>
                            <button type="submit" class="btn btn-primary" disabled>Save changes</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>

    <div class="container-fluid px-6 pt-5 tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active"id="pills_report" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row g-3">
                <?php if(!empty(session()->getFlashdata('fail'))):?>
                    <div class="col-md-12">
                        <div class="alert alert-danger" id='failed-message'>
                            <?=session()->getFlashdata('fail')?>
                        </div>
                    </div>
                <?php endif ?>
                <?php if(!empty(session()->getFlashdata('success'))):?>
                    <div class="col-md-12">
                        <div class="alert alert-success" id='success-message'>
                            <?=session()->getFlashdata('success')?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Total Records</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$total['total']?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Male</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-info text-info rounded-2">
                                    <i class="bi bi-gender-male fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$gender['male']?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">28</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-primary border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Female</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-danger text-danger rounded-2">
                                    <i class="bi bi-gender-female fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$gender['female']?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">28</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-primary border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Number of PWD</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
                                    <i class="bi bi-bandaid fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$status['is_pwd']?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">4ps Member</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-info text-info rounded-2">
                                    <i class="bi bi-gender-male fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$status['is_fps_member']?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">28</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-primary border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Interested </h4>
                                    <span class="text-secondary">Interested in Deped programs</span>
                                </div>
                                <div class="icon-shape icon-md bg-light-success text-success rounded-2">
                                    <i class="bi bi-check-all fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$status['is_interested']?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">28</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-primary border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                    <!-- $male and female count-->
                    <div class="card bg-white p-3" >
                        <h5>Age Distribution</h5>
                        <canvas id="agesBarChart" class="border rounded"></canvas>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                    <!-- $male and female count-->
                    <div class="card bg-white p-3">
                        <h5>Civil Status</h5>
                        <canvas id="civilStatusDoughnutChart" class="border rounded"></canvas>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                    <!-- $male and female count-->
                    <div class="card bg-white p-3">
                        <h5>Grade Level</h5>
                        <canvas id="gradeLevelBarChart" class="border rounded"></canvas>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                    <!-- $male and female count-->
                    <div class="card bg-white p-3">
                        <h5>Reason for Dropping out/not Enrolling</h5>
                        <canvas id="reasonPieChart" class="border rounded"></canvas>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="card h-100 tab-pane fade " id="pills_records" role="tabpanel" aria-labelledby="pills-home-tab">
            <!-- card header  --> 
            <div class="card-header bg-white py-4">
                <h4 class="mb-0">OSCYA </h4>
            </div>
            <!-- table  -->
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>OSY ID</th>
                            <th>Full name</th>
                            <th>Contacts</th>
                            <th>Mapping Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($staff_records) && is_array($staff_records)): ?>
                            <?php foreach($staff_records AS $osy): ?>
                                <tr>
                                    <td class="align-middle"><?=$osy['id']?></td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1"><?=$osy['oscya_id']?></h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><?=$osy['fullname']?></td>
                                    <td class="align-middle">
                                        <span class="mb-0"><?=$osy['email']?></span><br>
                                        <span class="mb-0"><?=$osy['contact']?></span>
                                    </td>
                                    <td class="align-middle">
                                        <?php 
                                            $phpdate = strtotime( $osy['mapping_date'] );
                                            $mysqldate = date( 'l, F t, Y', $phpdate );
                                            echo $mysqldate;
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <div class="dropdown dropstart">
                                            <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTeamOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-xs" data-feather="more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownTeamOne">
                                                <a class="dropdown-item" href="#">
                                                    View
                                                </a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="align-middle text-center">No Data</tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
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
            document.getElementById('agesBarChart'),
            agesBarChartConfig
        );
        const civilStatusConfig = {
            type: 'doughnut',
            data: {
                labels: ['Single', 'Married', 'Separated', 'Devorced', 'Widowed'],
                datasets: [{
                    label: 'Civil Status',
                    data: [ 
                        <?=$civil_status['single']?>, 
                        <?=$civil_status['married']?>,
                        <?=$civil_status['separated']?>, 
                        <?=$civil_status['devorced']?>,
                        <?=$civil_status['widowed']?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(255, 159, 64)',
                        'rgba(255, 205, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(54, 162, 235)'
                    ],
                    borderWidth: 1
                }]
            }
        };
        const civilStatusChart = new Chart(
            document.getElementById('civilStatusDoughnutChart'),
            civilStatusConfig
        );
        const gradeLevelConfig = {
            type: 'bar',
            data: {
                labels: ['Kinder', 'Grade 1', 'Grade 2', 'Grade3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'],
                datasets: [{
                    label: 'Educational Attainment',
                    data: [ 
                        <?=$educ['kinder']?>, 
                        <?=$educ['g1']?>,
                        <?=$educ['g2']?>, 
                        <?=$educ['g3']?>,
                        <?=$educ['g4']?>, 
                        <?=$educ['g5']?>, 
                        <?=$educ['g6']?>,
                        <?=$educ['g7']?>, 
                        <?=$educ['g8']?>,
                        <?=$educ['g9']?>, 
                        <?=$educ['g10']?>
                    ],
                    backgroundColor: [
                        'rgba(255, 205, 86)',
                        '#9e0142',
                        '#d53e4f',
                        '#f46d43',
                        '#fdae61',
                        '#fee08b',
                        '#e6f598',
                        '#abdda4',
                        '#66c2a5',
                        '#3288bd',
                        '#5e4fa2'
                    ],
                    borderWidth: 1
                }]
            }
        };
        const gradeLevelChart = new Chart(
            document.getElementById('gradeLevelBarChart'),
            gradeLevelConfig
        );
        const reasonDoughnutChartConfig = {
            type: 'doughnut',
            data: {
                labels: [
                    'Lack of Personal Interest',
                    'Family Related Concerns',
                    'Employment',
                    'Early Pregnancy',
                    'Disability',
                    'Disease',
                    'Distance of the School',
                    'Cannot Cope with School Works',
                    'Financial Problems',
                    'Others'
                ],
                datasets: [{
                    label: 'Reason',
                    data: [
                        <?=$reason['r1']?>,
                        <?=$reason['r2']?>,
                        <?=$reason['r3']?>,
                        <?=$reason['r4']?>,
                        <?=$reason['r5']?>,
                        <?=$reason['r6']?>,
                        <?=$reason['r7']?>,
                        <?=$reason['r8']?>,
                        <?=$reason['r9']?>,
                        <?=$reason['r10']?>
                        // 33,46,56,19,34, 45, 66, 69,25, 34
                    ],
                    backgroundColor: [
                        '#9e0142',
                        '#d53e4f',
                        '#f46d43',
                        '#fdae61',
                        '#fee08b',
                        '#e6f598',
                        '#abdda4',
                        '#66c2a5',
                        '#3288bd',
                        '#5e4fa2'

                        
                    ],
                    hoverOffset: 4
                }]
            }   
        };
        const reasonChart = new Chart(
            document.getElementById('reasonPieChart'),
            reasonDoughnutChartConfig
        );

        const success_message = document.querySelector('#success-message');

        const failed_message = document.querySelector('#failed-message');

        if(success_message)
        {
            setTimeout(function() {success_message.remove()}, 3000);
        }

        if(failed_message){
            setTimeout(function() {failed_message.remove()}, 3000);
        }
    </script>