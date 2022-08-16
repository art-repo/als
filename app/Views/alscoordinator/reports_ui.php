</div>
<div class="container-fluid pt-4">
    <!-- javascript behaviour -->
    
    
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row g-3 mb-5">
                <div class="col-md-12">
                    <h3 class="fw-bold ">Reports</h3>
                    
                </div>
                <div class="col-md-12 text-end">
                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="<?=base_url('alscoordinator/barangay_settings') . "/" . $brgy_info['user_id']?>#generate_reports" data-bs-toggle="tooltip" data-placement="bottom" title="Generate Reports">
                        <span class="material-icons-outlined">analytics</span>
                    </a>
                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="<?=base_url('alscoordinator/barangay_settings') . "/" . $brgy_info['user_id']?>#data_migration" role="button"  data-bs-toggle="tooltip" data-placement="bottom" title="Migrate Data">
                        <span class="material-icons-outlined">cloud_upload</span>
                    </a>
                    <a class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" href="<?=base_url('alscoordinator/barangay_settings') . "/" . $brgy_info['user_id']?>" data-bs-toggle="tooltip" data-placement="bottom" title="Go to settings">
                        <span class="material-icons-outlined">settings</span>
                    </a>
                </div>
                <!-- Employed Chart -->
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                    <div class="card p-3">
                        <canvas id="employedOsy"></canvas>
                        <div class="text-center">
                            <h3 class="fw-bold"><?=round(($reports['employed']/$reports['oscya']) * 100)?>%</h3>
                            <span class="text-secondary">Employed OSY: <b><?=$reports['employed']?></b></span>
                        </div>
                    </div>
                </div>
                <!-- 4P's Chart -->
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                    <div class="card p-3">
                        <canvas id="fourPsOsy"></canvas>
                        <div class="text-center">
                            <h3 class="fw-bold"><?=round(($reports['fpsMember']/$reports['oscya']) * 100)?>%</h3>
                            <span class="text-secondary">4P's Members: <b><?=$reports['fpsMember']?></b></span>
                        </div>
                    </div>
                </div>
                <!-- Interested In DepEd Programs -->
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                    <div class="card p-3">
                        <canvas id="interestedOsy"></canvas>
                        <div class="text-center">
                            <h3 class="fw-bold"><?=round(($reports['interested']/$reports['oscya']) * 100)?>%</h3>
                            <span class="text-secondary">Interested: <b><?=$reports['interested']?></b></span>
                        </div>
                    </div>
                </div>
                <!-- Gender Chart -->
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                    <div class="card p-3">
                        <canvas id="osyGender"></canvas>
                        <div class="text-center">
                            <h3 class="fw-bold">    
                                <span class="material-icons align-middle" style="font-size: 30px;color:#283593;">male</span>: 
                                <?=round(($gender['male']/$reports['oscya']) * 100)?>%
                                <span class="material-icons align-middle" style="font-size: 30px;color:#AD1457">female</span>: 
                                <?=round(($gender['female']/$reports['oscya']) * 100)?>%
                                
                            </h3>
                            <span style="color:#283593;">Male: <b><?=$gender['male']?></b></span>
                            <span style="color:#AD1457">Female: <b><?=$gender['female']?></b></span>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-12">
                    <div class="card p-4 shadow">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-blue-3 fw-bold">Out of School Youth</h5>
                                <p class="text-secondary">Highest Educational Attainment</p>
                            </div>
                            <div class="col-md-4">
                                <!-- basic table -->
                                <table class="table table-responsive table-bordered table-sm">
                                    <thead style="background-color: #26A69A;">
                                        <tr>
                                            <th scope="col" class="text-light">Grade Level</th>
                                            <th scope="col" class="text-light">Total</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr>
                                            <th style="color:#26A69A">Kinder</th>
                                            <td><?=$educ_attainment['kinder']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 1</th>
                                            <td><?=$educ_attainment['g1']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 2</th>
                                            <td><?=$educ_attainment['g2']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 3</th>
                                            <td><?=$educ_attainment['g3']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 4</th>
                                            <td><?=$educ_attainment['g4']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 5</th>
                                            <td><?=$educ_attainment['g5']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 6</th>
                                            <td><?=$educ_attainment['g6']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 7</th>
                                            <td><?=$educ_attainment['g7']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 8</th>
                                            <td><?=$educ_attainment['g8']?></td>
                                        </tr>
                                        <tr>
                                            <th style="color:#26A69A">Grade 9</th>
                                            <td><?=$educ_attainment['g9']?></td>
                                        </tr>
                                        <tr>
                                            <th style ="color:#26A69A">Grade 10</th>
                                            <td><?=$educ_attainment['g10']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <!-- basic table -->
                            </div>
                            <div class="col-md-8">
                                <div class="bg-white">
                                    
                                    <canvas class="border rounded" id="educChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card p-4 shadow">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-blue-3 fw-bold">Reason</h5>
                                <p class="text-secondary">Reason for Dropping out/Not Enrolling</p>
                            </div>
                            <div class="col-md-8">
                                <canvas class="border rounded" id="reasonBarChart"></canvas>
                            </div>
                            <div class="col-md-4">
                                
                                <p class="mb-0">Reasons</p>
                                <ul>
                                    <li><div class="badge" style="background-color: #26A69A;">R1</div> = Lack of Personal Interest</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R2</div> = Family Related Concerns</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R3</div> = Employment</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R4</div> = Early Pregnancy</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R5</div> = Disability</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R6</div> = Disease</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R7</div> = Distance of the School</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R8</div> = Cannot Cope with School Works</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R9</div> = Financial Problems</li>
                                    <li><div class="badge" style="background-color: #26A69A;">R10</div> = Others</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card p-4 shadow">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-blue-3 fw-bold">Disability</h5>
                                <p class="text-secondary">Types of Disabilities</p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-0">Disabilities</p>
                                <ul>
                                    <li><div class="badge" style="background-color: #26A69A;">D1</div> = Intellectual Disability</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D2</div> = Learning Disability</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D3</div> = Autism</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D4</div> = Blind</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D5</div> = Deaf</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D6</div> = Hard of Hearin</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D7</div> = Orthopedically Impaired</li>
                                    <li><div class="badge" style="background-color: #26A69A;">D8</div> = Others</li>
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <canvas class="border rounded" id="disabilityBarChart"></canvas>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="tab-pane fade p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card p-3">
                <form action="<?=base_url('coordinator/generate_report')?>" method="post">
                    <h3>Generate Reports</h3>
                    <div class="row g-2">
                        <div class="col-md-2">
                            <label for="purpose" class="form-label pt-2">Purpose: </label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" aria-label="Default select example" name="purpose" id="purpose">
                                <option selected>Select purpose</option>
                                <option value="QCYDO Reference">QCYDO Reference</option>
                                <option value="ALS Counselling">ALS Counselling</option>
                            </select>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-2">
                            <label for="date_from" class="form-label pt-2">From Date: </label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="date_from" id="date_from" class="form-control">
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-2">
                            <label for="date_to" class="form-label pt-2">To Date: </label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="date_to" id="date_to" class="form-control">
                        </div>
                        <div class="col-md-12"></div>
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Generate Report</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card p-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row justify-content-end">
                            <div class="col-md-3 py-2">
                                <input type="search" name="search_bar" id="search_bar" class="form-control" placeholder="Search Filename" onkeyup="myFunction()">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0" id="file_table">
                                <thead>
                                    <tr>
                                        <th>Filename</th>
                                        <th>Purpose</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <?php if(isset($reporting) && is_array($reporting)):?>
                                        <?php foreach($reporting as $report): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold fs-5"><?=$report['filename']?></span>
                                                </td>
                                                <td class="align-middle"><?=$report['purpose']?></td>
                                                <td class="align-middle"><?=date('F j, Y - h:i a', strtotime($report['date_created']))?></td>
                                                <td class="align-middle text-end">
                                                    <a class="btn btn-success btn-sm" href="<?=base_url('public/uploads/reports')  . '/' . $report['file_loc']?>" target="_blank">
                                                        <span class="material-icons align-middle">cloud_download</span>
                                                        &nbsp;Download
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4" class="align-middle text-center">
                                                No Report Created
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
<div class="container-fluid mt-10">
    <div class="row">
        <div class="col-md-12 text-center">
            <h5 class="fw-bold">&copy;Copyright 2021</h5>
            <span>ALS Group</span>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    const file_table = document.querySelector('#file_table');
    const search_bar = document.querySelector('#search_bar');
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = search_bar;
        filter = input.value.toUpperCase();
        table = file_table;
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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

    const employedOsyChartConf = {
        type: 'doughnut',
        data: {
            labels: ['Employed', 'OSY'],
            datasets: [{
                label: 'OSCYA Educational Attainment',
                data: [
                    <?=$reports['employed']?>,
                    <?=$reports['oscya']?>
                ],
                backgroundColor: [
                    '#66BB6A',
                    '#263238'
                ]
                
            }],
            
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Employment Chart'
                }
            }
        },
    };

    const employedOsyChart = new Chart(
        document.getElementById('employedOsy'),
        employedOsyChartConf
    );

    const fourPsOsyChartConf = {
        type: 'doughnut',
        data: {
            labels: ["4P's Member", "OSY"],
            datasets: [{
                label: "4P's Members",
                data: [
                    <?=$reports['fpsMember']?>,
                    <?=$reports['oscya']?>
                ],
                backgroundColor: [
                    '#EF5350',
                    '#263238'
                ]
                
            }],
            
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: "4P's Member"
                }
            }
        },
    };

    const fourPsOsyChart = new Chart(
        document.getElementById('fourPsOsy'),
        fourPsOsyChartConf
    );

    const interestedOsyChartConf = {
        type: 'doughnut',
        data: {
            labels: ["Interested", "OSY"],
            datasets: [{
                label: "Interested in DepEd Programs",
                data: [
                    <?=$reports['interested']?>,
                    <?=$reports['oscya']?>
                ],
                backgroundColor: [
                    '#26A69A',
                    '#263238'
                ]
                
            }],
            
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: "Interested in DepEd Programs"
                }
            }
        },
    };

    const interestedOsyChart = new Chart(
        document.getElementById('interestedOsy'),
        interestedOsyChartConf
    );

    const genderChartConf = {
        type: 'doughnut',
        data: {
            labels: ["Male", "Female"],
            datasets: [{
                label: "Interested in DepEd Programs",
                data: [
                    '<?=$gender['male']?>',
                    '<?=$gender['female']?>'
                ],
                backgroundColor: [
                    '#283593',
                    '#AD1457'
                ]
                
            }],
            
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: "Gender"
                }
            }
        },
    };

    const genderChart = new Chart(
        document.getElementById('osyGender'),
        genderChartConf
    );

    

    const educChartConf = {
        type: 'bar',
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
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                ]
                // backgroundColor: [
                //     "RGB(198, 190, 89)",
                //     "RGB(147, 192, 101)",
                //     "RGB(101, 195, 111)",
                //     "RGB(95, 197, 124)",
                //     "RGB(98, 201, 157)",
                //     "RGB(102, 207, 187)",
                //     "RGB(105, 211, 219)",
                //     "RGB(110, 218, 252)",
                //     "RGB(104, 208, 247)",
                //     "RGB(100, 199, 241)",
                //     "RGB(94, 188, 232)"
                // ]
            }]
        }
    }
    const educChart = new Chart(
        document.getElementById('educChart'),
        educChartConf
    );

    const reasonBarChartConf = {
        type: 'bar',
        data: {
            labels: [
                'R1',
                'R2',
                'R3',
                'R4',
                'R5',
                'R6',
                'R7',
                'R8',
                'R9',
                'R10',
                
            ],
            datasets: [{
                label: 'Reason for Dropping out/Not Enrolling',
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
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                ],
                // backgroundColor: [
                //     "RGB(198, 190, 89)",
                //     "RGB(147, 192, 101)",
                //     "RGB(101, 195, 111)",
                //     "RGB(95, 197, 124)",
                //     "RGB(98, 201, 157)",
                //     "RGB(102, 207, 187)",
                //     "RGB(105, 211, 219)",
                //     "RGB(110, 218, 252)",
                //     "RGB(104, 208, 247)",
                //     "RGB(100, 199, 241)",
                //     "RGB(94, 188, 232)"
                // ],
                borderWidth:1,
                hoverOffset: 4
            }]
        }
    }
    const reasonChart = new Chart(
        document.getElementById('reasonBarChart'),
        reasonBarChartConf
    );

    const disabilityBarChartConf = {
        type: 'bar',
        data: {
            labels: [
                'D1',
                'D2',
                'D3',
                'D4',
                'D5',
                'D6',
                'D7',
                'D8',
            ],
            datasets: [{
                label: 'Disability Distribution Chart',
                data: [
                    <?=$count_disability['d1']?>,
                    <?=$count_disability['d2']?>,
                    <?=$count_disability['d3']?>,
                    <?=$count_disability['d4']?>,
                    <?=$count_disability['d5']?>,
                    <?=$count_disability['d6']?>,
                    <?=$count_disability['d7']?>,
                    <?=$count_disability['d8']?>,
                    
                ],
                // backgroundColor: [
                //     "RGB(198, 190, 89)",
                //     "RGB(147, 192, 101)",
                //     "RGB(101, 195, 111)",
                //     "RGB(95, 197, 124)",
                //     "RGB(98, 201, 157)",
                //     "RGB(102, 207, 187)",
                //     "RGB(105, 211, 219)",
                //     "RGB(110, 218, 252)",
                //     "RGB(104, 208, 247)",
                // ],
                backgroundColor: [
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                    "#26A69A",
                ],
                borderWidth:1,
                hoverOffset: 4
            }]
        }
    }
    const  disabilityChart = new Chart(
        document.getElementById('disabilityBarChart'),
        disabilityBarChartConf
    );

    const disabilityPieChartConf = {
        type: 'doughnut',
            data: {
                labels: ['Not PWD','PWD', 'w disease'],
                datasets: [{
                    label: 'Marital Status Chart',
                    data: [
                        <?=$reports['oscya'] - $pwd['pwd_count'] - $reason['r6'];?>, 
                        <?=$pwd['pwd_count']?>,
                        <?=$reason['r6']?>
                    ],
                    backgroundColor: [
                        "#2196F3",
                        "#FFEB3B",
                        "#FF7043"
                    ],
                    
                    borderWidth: 2,
                    hoverOffset:4
                }],
                hoverOffset: 4
            }
        
    };

    const disabilityPieChart = new Chart(
        document.getElementById('disabilityPieChart'),
        disabilityPieChartConf
    );

    


</script>