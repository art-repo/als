
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
                            <h2 class="mb-0"><?=$c_info['firstname'] . ' ' . $c_info['lastname']?>
                                <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Beginner"></a>
                            </h2>
                            <p class="mb-0 d-block"><?=$c_contact['email']?></p>
                        </div>
                    </div>
                </div>
                <!-- nav -->
                <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills_report" role="tab" aria-controls="pills_reports" aria-selected="false">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-records-tab" data-bs-toggle="pill" href="#pills_records" role="tab" aria-controls="pills_records" aria-selected="true">All Records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-staffs-tab" data-bs-toggle="pill" href="#pills_staffs" role="tab" aria-controls="pills_records" aria-selected="true">Staffs</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<br>
    <div class="container-fluid px-6 tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active"id="pills_report" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row g-3">
                <div class="col-md-12">
                    <!-- <h3>< ?=$c_contact['barangay']?></h3> -->
                    <!-- <a href="< ?=base_url('alscoordinator/record').'/'. $c_info['user_id']?>" class="link-primary me-3">
                        <i class="icon-sm" data-feather="list"></i>
                    </a> -->
                    <!-- <div class="bg-white shadow-sm rounded p-4">
                        <div class="row g-3">
                            < ?if(!empty($brgy_profile)):?>
                            <div class="col-md-3">
                                <img src="< ?=base_url('public/uploads/assets/profiles') . '/'. $brgy_profile['logo']?>" alt="" class="img-fluid rounded-circle" id="logo">
                            </div>
                            <div class="col-md-9">
                                <h1>Barangay < ?=$c_contact['barangay']?></h1>
                                <p class="text-success"><i class="bi bi-geo-alt"></i> < ?=$brgy_profile['address']?></p>
                                <p class="text-success"><i class="bi bi-envelope"></i> < ?=$brgy_profile['email']?></p>
                                <p class="text-success"><i class="bi bi-phone"></i> < ?=$brgy_profile['contact_no']?></p>
                            </div>
                            < ?else:?>

                            < ?endif?>
                        </div>
                        
                    </div> -->
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mt-6">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Total number of OSCYA</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-danger text-danger rounded-2 p-3">
                                    <i class="bi bi-people fs-3"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$reports['oscya'];?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mt-6">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Employed</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-info text-info rounded-2 p-3">
                                    <i class="bi bi-briefcase fs-3"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$reports['employed'];?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mt-6">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">4ps Member</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-success text-success rounded-2 p-3">
                                    <i class="bi bi-people fs-3"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$reports['fpsMember'];?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mt-6">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Interested In DEPED Programs</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2 p-3">
                                    <i class="bi bi-check-all fs-3"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$reports['interested'];?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mt-6">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Male</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                    <i class="bi bi-gender-male fs-3"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$gender['male'];?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-4 mt-6">
                    <!-- card -->
                    <div class="card ">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Female</h4>
                                </div>
                                <div class="icon-shape icon-md text-danger rounded-2" style="background-color: pink;">
                                    <i class="bi bi-gender-female fs-3"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?=$gender['female'];?></h1>
                                <!-- <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p> -->
                                <!-- <a href="#" class="btn btn-warning border-2">View</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="bg-white shadow-sm rounded p-4">
                        <canvas class="border rounded" id="educChart"></canvas>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="bg-white shadow-sm rounded p-4">
                        <canvas class="border rounded" id="reasonChart"></canvas>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-white shadow-sm rounded p-4">
                        <canvas class="border rounded" id="disabilityChart"></canvas>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="card h-100 tab-pane fade " id="pills_records" role="tabpanel" aria-labelledby="pills-records-tab">
            <!-- card header  --> 
            <div class="card-header bg-white py-4">
                <h4 class="mb-0">OSCYA </h4>
            </div>
            <!-- table  -->
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>OSY ID</th>
                            <th>Fullname</th>
                            <th>Contact</th>
                            <th>Mapping Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($osy) && is_array($osy)): ?>
                            <?php foreach($osy as $youth):?>
                                <tr>
                                    <td class="align-middle"><?=$youth['oscya_id']?></td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1"><?=$youth['name']?></h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><?=$youth['contact']?></td>
                                    <td class="align-middle"><?=$youth['mapping_date']?></td>
                                    
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
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card h-100 tab-pane fade " id="pills_staffs" role="tabpanel" aria-labelledby="pills-staffs-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                    <!-- card header  -->
                        <div class="card-header bg-white  py-4">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <div class="ms-lg-3 d-none d-md-none d-lg-block">
                                    <!-- Form -->
                                        <form class="d-flex align-items-end">
                                            <input type="search" class="form-control" placeholder="Search lastname" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>User ID</th>
                                        <th>Fullname</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if( !empty($staffs) || is_array($staffs)):?>
                                        <?php foreach ($staffs as $staff): ?>
                                            <tr>
                                                <td>
                                                    <?php if(empty($staff['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\', $staff['image']))) :?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="avatar-sm rounded-circle border border-3">
                                                    <?php else: ?>
                                                        <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $staff['image']?>" class="avatar-sm rounded-circle border border-3">
                                                    <?php endif ?>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3 lh-1 text-primary fw-bold">
                                                            <?=$staff['user_id']?><br>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <?=$staff['fullname']?>
                                                </td>
                                                <td class="align-middle"><?=$staff['creator_id']?></td>
                                                    
                                                <td class="align-middle">
                                                    <?php if($staff['status'] == 0) :?>
                                                        <span class="badge bg-danger">Offline</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success">Online</span>
                                                    <?php endif ?>
                                                    
                                                </td>  
                                                <td class="align-middle">
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" class="icon-xs"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                            <h6 class="dropdown-header">Action</h6>
                                                            <a class="dropdown-item" href="<?=base_url('alscoordinator/view_staff_report') . '/' . $staff['user_id']?>">
                                                                <i data-feather="eye" class="icon-sm me-3"></i>
                                                                Report
                                                            </a>
                                                            <a class="dropdown-item" href="<?=base_url('alscoordinator/view_staff_records') . '/' . $staff['user_id']?>">
                                                                <i data-feather="archive" class="icon-sm me-3"></i>
                                                                All Records
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
                        <!-- card footer  -->
                        <div class="card-footer bg-white text-center">
                            <br>
                            <!-- <a href="#" class="link-primary">View Registered Coordinator</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>

    const educChartConf = {
        type: 'line',
        data: {
            labels: [
                'Kinder',
                'Grade 1',
                'Grade 2',
                'Grade 3',
                'Grade 4',
                'Grade 5',
                'Grade 6',
                'Grade 7',
                'Grade 8',
                'Grade 9',
                'Grade 10',
            ],
            datasets: [{
                label: 'OSCYA Educational Attainment',
                data: [
                    <?=$educ_attainment['kinder']?>,
                    <?=$educ_attainment['g1']?>,
                    <?=$educ_attainment['g2']?>,
                    <?=$educ_attainment['g3']?>,
                    <?=$educ_attainment['g4']?>,
                    <?=$educ_attainment['g5']?>,
                    <?=$educ_attainment['g6']?>,
                    <?=$educ_attainment['g7']?>,
                    <?=$educ_attainment['g8']?>,
                    <?=$educ_attainment['g9']?>,
                    <?=$educ_attainment['g10']?>
                ],
                backgroundColor: [
                    
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(13, 110, 253, 0.30)',
                ],
                borderColor:[
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)',
                    'rgb(13, 110, 253)'
                ],
                borderWidth:2,
                hoverOffset: 4
            }]
        }
    }
    const educChart = new Chart(
        document.getElementById('educChart'),
        educChartConf
    );

    const reasonChartConf = {
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
                'Others',
                
            ],
            datasets: [{
                label: 'Reason for Dropping out/Not Enrollment',
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
                ],
                backgroundColor: [
                    
                    'rgb(13, 110, 253, 0.30)',
                    'rgb(102, 16, 242, 0.30)',
                    'rgb(111, 66, 193, 0.30)',
                    'rgb(214, 51, 132, 0.30)',
                    'rgb(220, 53, 69, 0.30)',
                    'rgb(253, 126, 20, 0.30)',
                    'rgb(255, 193, 7, 0.30)',
                    'rgb(25, 135, 84, 0.30)',
                    'rgb(32, 201, 151, 0.30)',
                    'rgb(13, 202, 240, 0.30)',
                    'rgb(255, 205, 86, 0.30)'
                ],
                borderColor:[
                    'rgb(13, 110, 253)',
                    'rgb(102, 16, 242)',
                    'rgb(111, 66, 193)',
                    'rgb(214, 51, 132)',
                    'rgb(220, 53, 69)',
                    'rgb(253, 126, 20)',
                    'rgb(255, 193, 7)',
                    'rgb(25, 135, 84)',
                    'rgb(32, 201, 151)',
                    'rgb(13, 202, 240)',
                    'rgb(255, 205, 86)'
                ],
                borderWidth:1,
                hoverOffset: 4
            }]
        }
    }
    const reasonChart = new Chart(
        document.getElementById('reasonChart'),
        reasonChartConf
    );



</script>