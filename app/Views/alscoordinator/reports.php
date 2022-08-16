
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            body{
              font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
              /* background-image: url("< ?=base_url('public/uploads/assets')?>/fely.jpg");
              opacity: 0.5; */
            }
            .header-data {
              border-collapse: collapse;
              width: 100%;

              
            }
            .body-data {
              border-collapse: collapse;
              width: 100%;
              border: 1px solid RGB(95, 197, 124);
            }
            .body-data th{
                border: 1px solid RGB(95, 197, 124);
                background-color: RGB(95, 197, 124);
                color: white;
            }
            .body-data td{
                border: 1px solid RGB(95, 197, 124);
            }
            .oscya-data{
                border: 1px solid grey;
                border-collapse: collapse;
                width: 100%;
              
            }
            .logo-left{
              text-align: left;
            }
            .logo-center{
              text-align: center;
            }
            .logo-right{
              text-align: right;
            }
            .left{
              text-align: left;
            }
            .center{
              text-align: center;
            }
            .right{
              text-align: right;
            }
            /* td{
              border: 1px solid black;
            } */
            
        </style>
    </head>
    <body>
        <!-- header -->
        <!-- <table class="header-data">
            <tr>
                <td class="logo-left">
                    < ?php if(!empty($brgy_profile) || file_exists(FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $brgy_profile['logo']) )):?>
                        <img  style="width:80px; height=80px;" src="< ?=base_url('public/uploads/assets/profiles') . '/' . $brgy_profile['logo']?>" alt="">
                    < ?php else: ?>
                        <img  style="width:70px; height=70px;" src="< ?=base_url('public/uploads/assets/profiles') . '/' . 'qclogo.png'?>" alt="">
                    < ?php endif ?>
                </td>
                <td class="center">
                    <h4>QUEZON CITY</h4>
                    <h3>LITERACY MAPPING REPORT</h3>
                    <h4>< ?=$purpose['for']?></h4>
                </td>
                <td class="logo-right">
                    < ?php if(file_exists(FCPATH . 'uploads\\assets\\profiles\\' . 'qcydologo.png')):?>
                        <img  style="width:70px; height=70px;" src="< ?=base_url('public/uploads/assets/profiles') . '/' . 'qcydologo.png'?>" alt="">
                    < ?php else: ?>
                        <img  style="width:70px; height=70px;" src="< ?=base_url('public/uploads/assets/profiles') . '/' . 'qclogo.png'?>" alt="">
                    < ?php endif ?>
                </td>
            </tr>
        </table> -->
        <table class="header-data" style="margin-top: 15px;">
            <tr>
                <td style="text-align: left;">Barangay: <b><?=$brgy_info->barangay?></b></td>
                <td style="text-align:right;">District: <b><?=$brgy_info->district?></b></td>
            </tr>
            
        </table>
        <table class="header-data" >
            <tr>
                <th class="center" style="padding-top:15px;">GENERAL YOUTH DATA</th>
            </tr>
            <tr>
                <td class="center" style="padding-top:15px; padding-bottom:15px;"><?=date("Y", strtotime($purpose['date_from']))?> Report</td>
            </tr>
        </table>
        <table class="body-data" style="margin-bottom: 15px;">
            <tr>
                <th colspan="2">NUMBER OF YOUTH(per gender)</th> 
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Male</td>
                <td style="width:33%; text-align:center;"><?=$gender['male']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Female</td>
                <td style="width:33%; text-align:center;"><?=$gender['female']?></td>
            </tr>
            <tr>
                <td style="width: 66%;font-weight:bolder; text-align:center;"> <i>(Both Male and Female)</i> TOTAL</td>
                <td style="width:33%;font-weight:bolder; text-align:center;"><b ><?=$generate_reports['oscya']?></b></td>
            </tr>
        </table>
        <table class="body-data" style="margin-bottom: 15px;">
            <tr>
                <th colspan="2">OSY MAPPING REPORT</th> 
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Employed</td>
                <td style="width:33%;text-align:center;"><?=$generate_reports['employed']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">4ps Member</td>
                <td style="width:33%;text-align:center;"><?=$generate_reports['fpsMember']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Interested in DEPED Programs</td>
                <td style="width:33%;text-align:center;"><b><?=$generate_reports['interested']?></b></td>
            </tr>
        </table>
        <table class="body-data" style="margin-bottom: 15px;">
            <tr>
                <th colspan="2">Educational Attainment</th> 
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Kinder</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['kinder']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 1</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g1']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 2</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g2']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 3</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g3']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 4</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g4']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 5</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g5']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 6</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g6']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 7</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g7']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 8</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g8']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 9</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g9']?></td>
            </tr>
            <tr>
                <td style="width: 66%; text-align:center;">Grade 10</td>
                <td style="width:33%; text-align:center;"><?=$educ_attainment['g10']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;"><b>Total</b></td>
                <td style="width:33%;text-align:center;"><b><?=$generate_reports['oscya']?></b></td>
            </tr>
        </table>
        <table class="body-data" style="margin-bottom: 15px;">
            <tr>
                <th colspan="2">OSY w Disablity</th> 
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Intellectual Disability</td>
                <td style="width:33%;text-align:center;"><?=$disability['d1']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Learning Disability</td>
                <td style="width:33%;text-align:center;"><?=$disability['d2']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Autism</td>
                <td style="width:33%;text-align:center;"><?=$disability['d3']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Blind</td>
                <td style="width:33%;text-align:center;"><?=$disability['d4']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Deaf</td>
                <td style="width:33%;text-align:center;"><?=$disability['d5']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Hard of Hearin</td>
                <td style="width:33%;text-align:center;"><?=$disability['d6']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Orthopedically Impaired</td>
                <td style="width:33%;text-align:center;"><?=$disability['d7']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Others</td>
                <td style="width:33%;text-align:center;"><?=$disability['d8']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;"><b>Total</b></td>
                <td style="width:33%;text-align:center;"><b><?=$pwd['pwd_count']?></b></td>
            </tr>
        </table>     
        <table class="body-data" style="margin-bottom: 15px;">
            <tr>
                <th colspan="2">Reason for Dropping out/Not Enrolling</th> 
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Lack of Personal Interest</td>
                <td style="width:33%;text-align:center;"><?=$reason['r1']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Family Related Concerns</td>
                <td style="width:33%;text-align:center;"><?=$reason['r2']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Employment</td>
                <td style="width:33%;text-align:center;"><?=$reason['r3']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Early Pregnancy</td>
                <td style="width:33%;text-align:center;"><?=$reason['r4']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Disability</td>
                <td style="width:33%;text-align:center;"><?=$reason['r5']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Disease</td>
                <td style="width:33%;text-align:center;"><?=$reason['r6']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Distance of the School</td>
                <td style="width:33%;text-align:center;"><?=$reason['r7']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Cannot Cope with School Works</td>
                <td style="width:33%;text-align:center;"><?=$reason['r8']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Financial Problems</td>
                <td style="width:33%;text-align:center;"><?=$reason['r9']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Others</td>
                <td style="width:33%;text-align:center;"><?=$reason['r10']?></td>
            </tr>
        </table>
        <table class="body-data" style="margin-bottom: 40px;">
            <tr>
                <th colspan="2">Civil Status</th> 
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Single</td>
                <td style="width:33%;text-align:center;"><?=$civil_status['single']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Married</td>
                <td style="width:33%;text-align:center;"><?=$civil_status['married']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Separated</td>
                <td style="width:33%;text-align:center;"><?=$civil_status['separated']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Devorced</td>
                <td style="width:33%;text-align:center;"><?=$civil_status['devorced']?></td>
            </tr>
            <tr>
                <td style="width: 66%;text-align:center;">Widowed</td>
                <td style="width:33%;text-align:center;"><?=$civil_status['widowed']?></td>
            </tr>
        </table>
        <table class="header-data">
            <tr>
                <td style="text-align:center;padding-top:10px;"><i style="font-size: 9px;">Method of Gathering or Data source: Community Literacy Mapping</i></td>
            </tr>
        </table>
        <table class="header-data" style="margin-bottom: 15px;">
            <tr>
                <td style="text-align: center;"> Prepared By: <b><?=$c_info['firstname'] . ' ' . $c_info['lastname']?></b></th>
                <th style="text-align: center;">Date of Filing: <?=date('M-d-Y')?></th>
            </tr>
            <tr>
                <th>Barangay Coordinator</th>
            </tr>
        </table>
    </body>
</html>
  