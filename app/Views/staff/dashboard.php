    </div>
    <div class="container-fluid">
        <div class="row m-1 g-3">
            <div class="col-md-12">
                <h3 class="fw-bold text-secondary">DASHBOARD</h3>
            </div>
            <div class="col-md-12">
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="fw-bold text-primary">Gender Distribution</h3>
                                    <canvas id="genderPieChart"></canvas>
                                </div>
                                <div class="col-md-4">
                                    <p class="fs-4 fw-bold">Percentage: </p>
                                    
                                    <span>Total population of Male:</span><br>
                                    <span class="fw-bold fs-2" style="color:rgb(13, 110, 253);"><?=$maleCount?> &nbsp;</span><span class="fs-3 fw-bold text-dark">
                                        <?php
                                            try {
                                                echo round(($maleCount/$record)*100);
                                            } catch (DivisionByZeroError $th) {
                                                echo 0;
                                            }
                                            
                                        ?>%</span>
                                    </span>
                                    <br><br>
                                    <span>Total population of Female:</span><br>
                                    <span class="fw-bold fs-2" style="color:rgb(214, 51, 132);"><?=$femaleCount?> &nbsp;</span><span class="fs-3 fw-bold text-dark">
                                        <?php 
                                            try {
                                                echo round(($femaleCount/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="fw-bold text-success">Age Distribution</h3>
                                    <canvas id="agesBarChart"></canvas>
                                    
                                </div>
                                <div class="col-md-4">
                                    <span class="badge" style="background-color: RGB(147, 192, 101);">Ages: 12-20</span><br>
                                    <span>Adolescence: </span><span class="fw-bold" style="color: RGB(147, 192, 101);"><?=$ages['adolescence']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($ages['adolescence']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%</span>
                                    <br>
                                    <span class="badge" style="background-color:RGB(101, 195, 111);">Ages: 21-35</span><br>
                                    <span>Early Adulthood: </span><span class="fw-bold" style="color: RGB(101, 195, 111);"><?=$ages['earlyAdults']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php 
                                            try {
                                                echo round(($ages['earlyAdults']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%</span>
                                    <br>
                                    <span class="badge" style="background-color:RGB(229, 142, 65);">Ages: 36-50</span><br>
                                    <span>Middle Adulthood: </span><span class="fw-bold" style="color: RGB(229, 142, 65);"><?=$ages['middleAdults']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($ages['middleAdults']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                            
                                        ?>%</span>
                                    <br>
                                    <span class="badge" style="background-color:RGB(215, 115, 59);">Ages: 50-80</span><br>
                                    <span>Mature Adulthood: </span><span class="fw-bold" style="color: RGB(215, 115, 59);"><?=$ages['matureAdults']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($ages['matureAdults']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                            
                                        ?>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-3">
                            <span class="fw-bold fs-3 text-success">By Marital Status</span>
                            <div class="row">
                                <div class="col-md-8">
                                    <canvas id="civilStatusPieChart"></canvas>
                                </div>
                                <div class="col-md-4">
                                    <span class="badge" style="background-color:  RGB(147, 192, 101);">Single</span><br>
                                    <span>Single: </span><span class="fw-bold" style="color: RGB(147, 192, 101);"><?=$count_civil_status['single']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($count_civil_status['single']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%
                                    </span>
                                    <br>
                                    <span class="badge" style="background-color: RGB(94, 188, 232);">Married</span><br>
                                    <span>Married: </span><span class="fw-bold" style="color: RGB(94, 188, 232);"><?=$count_civil_status['married']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($count_civil_status['married']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%
                                    <br>
                                    <span class="badge" style="background-color: RGB(98, 201, 157);">Separated</span><br>
                                    <span>Separated: </span><span class="fw-bold" style="color: RGB(98, 201, 157);"><?=$count_civil_status['separated']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($count_civil_status['separated']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%
                                    </span>
                                    <br>
                                    <span class="badge" style="background-color: RGB(102, 207, 187);">Divorced</span><br>
                                    <span>Divorced: </span><span class="fw-bold" style="color: RGB(102, 207, 187);"><?=$count_civil_status['devorced']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($count_civil_status['divorced']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%</span>
                                    <br>
                                    <span class="badge" style="background-color: RGB(105, 211, 219);">Widowed</span><br>
                                    <span>Widowed: </span><span class="fw-bold" style="color: RGB(105, 211, 219);"><?=$count_civil_status['widowed']?></span><br>
                                    <span class="fs-4 fw-bold">
                                        <?php
                                            try {
                                                echo round(($count_civil_status['widowed']/$record)*100);
                                            } catch (\Throwable $th) {
                                                echo 0;
                                            }
                                        ?>%
                                    </span>
                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-3">
                            <span class="fw-bold fs-3 text-success">Educational Attainment</span>
                            <canvas id="educBarChart"></canvas>
                            <span class="fw-bold text-success">Grade Levels:</span>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li><div class="badge text-dark" style="background-color: RGB(198, 190, 89);">Kinder: <?=$educ_attainment['kinder']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(147, 192, 101);">Grade 1: <?=$educ_attainment['g1']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(101, 195, 111);">Grade 2: <?=$educ_attainment['g2']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(95, 197, 124);">Grade 3: <?=$educ_attainment['g3']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(98, 201, 157);">Grade 4: <?=$educ_attainment['g4']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(102, 207, 187);">Grade 5: <?=$educ_attainment['g5']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(105, 211, 219);">Grade 6: <?=$educ_attainment['g6']?></div></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li><div class="badge text-dark" style="background-color: RGB(110, 218, 252);">Grade 7: <?=$educ_attainment['g7']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(104, 208, 247);">Grade 8: <?=$educ_attainment['g8']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(100, 199, 241);">Grade 9: <?=$educ_attainment['g9']?></div></li>
                                        <li><div class="badge text-dark" style="background-color: RGB(94, 188, 232);">Grade 10: <?=$educ_attainment['g10']?></div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="fw-bold fs-3 text-success">Reason for Dropping out/Not Enrolling:</span>
                                </div>
                                
                                <div class="col-md-8">
                                    <canvas id="reasonBarChart"></canvas>
                                </div>
                                <div class="col-md-4">
                                    <ul class="fw-bold">
                                        <li><div class="badge " style="background-color: RGB(198, 190, 89);">R1</div> Lack of Personal Interest</li>
                                        <li><div class="badge" style="background-color: RGB(147, 192, 101);">R2</div> Family Related Concerns</li>
                                        <li><div class="badge" style="background-color: RGB(101, 195, 111);">R3</div> Employment</li>
                                        <li><div class="badge" style="background-color: RGB(95, 197, 124);">R4</div> Early Pregnancy</li>
                                        <li><div class="badge" style="background-color: RGB(98, 201, 157);">R5</div> Disability</li>
                                        <li><div class="badge" style="background-color: RGB(102, 207, 187);">R6</div> Disease</li>
                                        <li><div class="badge" style="background-color: RGB(105, 211, 219);">R7</div> Distance of the School</li>
                                        <li><div class="badge" style="background-color: RGB(110, 218, 252);">R8</div> Cannot Cope with School Works</li>
                                        <li><div class="badge" style="background-color: RGB(104, 208, 247);">R9</div> Financial Problems</li>
                                        <li><div class="badge" style="background-color: RGB(100, 199, 241);">R10</div> Others</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>

        //gender
        // const genderBarChartConfig = {
        //     type: 'bar',
        //     data: {
        //         labels: ['Male','Female'],
        //         datasets: [{
        //             label: 'Gender Chart',
        //             data: [< ?=$maleCount?>, < ?=$femaleCount?>],
        //             backgroundColor: [
        //                 'rgb(13, 110, 253)',
        //                 'rgb(214, 51, 132)'
        //             ]
        //         }]
        //     },
        //     options: {
        //         indexAxis: 'y',
        //         elements: {
        //             bar: {
        //                 borderWidth: 0,
        //             }
        //         },
        //     }
        // };
        // const genderBarChart = new Chart(
        //     document.getElementById('genderBarChart'),
        //     genderBarChartConfig
        // );

        const genderpiechart = document.getElementById('genderPieChart');
        const genderPieChartConfig = {
            type:'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets : [{
                    label: 'Gender Chart',
                    data: [<?=$maleCount?>, <?=$femaleCount?>],
                    backgroundColor: [
                        'rgb(13, 110, 253)',
                        'rgb(214, 51, 132)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            }
        }
        const genderPieChart = new Chart(
            genderpiechart,
            genderPieChartConfig
        );
        

        //ages
        const agesBarChartConfig = {
            type: 'doughnut',
            data : {
                labels:['Ages 12-20', 'Ages 21-35', 'Ages 36-50', 'Ages 50-80'],

                datasets: [{
                    label: 'Age Chart',
                    data :[<?=$ages['adolescence']?>, <?=$ages['earlyAdults']?>, <?=$ages['middleAdults']?>, <?=$ages['matureAdults']?>],
                    backgroundColor : [
                        'RGB(147, 192, 101)',
                        'RGB(101, 195, 111)',
                        'RGB(229, 142, 65)',
                        'RGB(215, 115, 59)'
                    ]
                }]
            }
        };
        const agesBarChart = new Chart(
            document.getElementById('agesBarChart'),
            agesBarChartConfig
        );

        // const agesPieChartConfig = {
        //     type: 'pie',
        //     data : {
        //         labels:['Adolescence', 'Early Adulthood', 'Midlife', 'Mature Adulthood'],

        //         datasets: [{
        //             label: 'Age Chart',
        //             data :[< ?=$ages['adolescence']?>, < ?=$ages['earlyAdults']?>, < ?=$ages['middleAdults']?>, < ?=$ages['matureAdults']?>],
        //             backgroundColor : [
        //                 'RGB(147, 192, 101)',
        //                 'RGB(101, 195, 111)',
        //                 'RGB(229, 142, 65)',
        //                 'RGB(215, 115, 59)'
        //             ],
        //             borderWidth: 2,
        //             hoverOffset:4
        //         }],
        //         hoverOffset: 4
        //     },
            
        // };
        // const agesPieChart = new Chart(
        //     document.getElementById('agesPieChart'),
        //     agesPieChartConfig
        // );

        //civil status
        // const civilStatusBarChartConfig = {
        //     type: 'bar',
        //     data: {
        //         labels: ['Single','Married', 'Separated', 'devorced', 'widowed'],
        //         datasets: [{
        //             label: 'Gender Chart',
        //             data: [
        //                 < ?=$count_civil_status['single']?>, 
        //                 < ?=$count_civil_status['married']?>,
        //                 < ?=$count_civil_status['separated']?>, 
        //                 < ?=$count_civil_status['devorced']?>,
        //                 < ?=$count_civil_status['widowed']?>,
        //             ],
        //             backgroundColor: [
        //                 "RGB(101, 195, 111)",
        //                 "RGB(95, 197, 124)",
        //                 "RGB(98, 201, 157)",
        //                 "RGB(102, 207, 187)",
        //                 "RGB(105, 211, 219)"
        //             ]
        //         }]
        //     },
        //     options: {
        //         indexAxis: 'x',
        //         elements: {
        //             bar: {
        //                 borderWidth: 0,
        //             }
        //         },
        //     }
        // };
        // const civilStatusBarChart = new Chart(
        //     document.getElementById('civilStatusBarChart'),
        //     civilStatusBarChartConfig
        // );
    
        const civilStatusPieChartConfig = {
            type: 'doughnut',
            data: {
                labels: ['Single','Married', 'Separated', 'devorced', 'widowed'],
                datasets: [{
                    label: 'Marital Status Chart',
                    data: [
                        <?=$count_civil_status['single']?>, 
                        <?=$count_civil_status['married']?>,
                        <?=$count_civil_status['separated']?>, 
                        <?=$count_civil_status['devorced']?>,
                        <?=$count_civil_status['widowed']?>,
                    ],
                    backgroundColor: [
                        "RGB(101, 195, 111)",
                        "RGB(94, 188, 232)",
                        "RGB(98, 201, 157)",
                        "RGB(102, 207, 187)",
                        "RGB(105, 211, 219)"
                    ],
                    
                    borderWidth: 2,
                    hoverOffset:4
                }],
                hoverOffset: 4
            }
        };
        const civilStatusPieChart = new Chart(
            document.getElementById('civilStatusPieChart'),
            civilStatusPieChartConfig
        );

        //educational attainment
        const educBarChartConfig = {
            type: 'bar',
            data: {
                labels: ['Kinder','G1','G2','G3','G4','G5','G6','G7','G8','G9','G10'],
                datasets: [{
                    label: 'Education Chart',
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
                        <?=$educ_attainment['g10']?>, 
                    ],
                    backgroundColor: [
                        "RGB(198, 190, 89)",
                        "RGB(147, 192, 101)",
                        "RGB(101, 195, 111)",
                        "RGB(95, 197, 124)",
                        "RGB(98, 201, 157)",
                        "RGB(102, 207, 187)",
                        "RGB(105, 211, 219)",
                        "RGB(110, 218, 252)",
                        "RGB(104, 208, 247)",
                        "RGB(100, 199, 241)",
                        "RGB(94, 188, 232)"
                        
                    ],
                }]

            }
        };
        const educBarChart = new Chart(
            document.getElementById('educBarChart'),
            educBarChartConfig
        );
    
        // const educPieChartConfig = {
        //     type: 'doughnut',
        //     data: {
        //         labels: ['Kinder','G1','G2','G3','G4','G5','G6','G7','G8','G9','G10'],
        //         datasets: [{
        //             label: 'Marital Status Chart',
        //             data: [
        //                 < ?=$educ_attainment['kinder']?>, 
        //                 < ?=$educ_attainment['g1']?>,
        //                 < ?=$educ_attainment['g2']?>, 
        //                 < ?=$educ_attainment['g3']?>,
        //                 < ?=$educ_attainment['g4']?>,
        //                 < ?=$educ_attainment['g5']?>, 
        //                 < ?=$educ_attainment['g6']?>,
        //                 < ?=$educ_attainment['g7']?>, 
        //                 < ?=$educ_attainment['g8']?>,
        //                 < ?=$educ_attainment['g9']?>,
        //                 < ?=$educ_attainment['g10']?>, 
        //             ],
        //             backgroundColor: [
        //                 "RGB(198, 190, 89)",
        //                 "RGB(147, 192, 101)",
        //                 "RGB(101, 195, 111)",
        //                 "RGB(95, 197, 124)",
        //                 "RGB(98, 201, 157)",
        //                 "RGB(102, 207, 187)",
        //                 "RGB(105, 211, 219)",
        //                 "RGB(110, 218, 252)",
        //                 "RGB(104, 208, 247)",
        //                 "RGB(100, 199, 241)",
        //                 "RGB(94, 188, 232)"
                        
        //             ],
                    
        //             borderWidth: 2,
        //             hoverOffset:4
        //         }],
        //         hoverOffset: 4
        //     }
        // };
        // const educPieChart = new Chart(
        //     document.getElementById('educPieChart'),
        //     educPieChartConfig
        // );

        //reason
        const reasonBarChartConfig = {
            type: 'bar',
            data: {
                labels: ['R1','R2','R3','R4','R5','R6','R7','R8','R9','R10'],
                datasets: [{
                    label: 'OSY Reason Chart',
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
                        <?=$reason['r10']?>, 
                    ],
                    backgroundColor: [
                        "RGB(198, 190, 89)",
                        "RGB(147, 192, 101)",
                        "RGB(101, 195, 111)",
                        "RGB(95, 197, 124)",
                        "RGB(98, 201, 157)",
                        "RGB(102, 207, 187)",
                        "RGB(105, 211, 219)",
                        "RGB(110, 218, 252)",
                        "RGB(104, 208, 247)",
                        "RGB(100, 199, 241)",
                        "RGB(94, 188, 232)"
                        
                    ],
                }]

            }
        };
        const reasonBarChart = new Chart(
            document.getElementById('reasonBarChart'),
            reasonBarChartConfig
        );
    
        
        


    </script>