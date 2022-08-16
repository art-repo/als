<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            body{
              font-family: Arial;
              /* background-image: url("< ?=base_url('public/uploads/assets')?>/fely.jpg");
              opacity: 0.5; */
            }
            .header-data {
              border-collapse: collapse;
              width: 100%;
              
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
      <th class="logo-left">
        <img  style="width:70px; height=70px;" src="< ?=base_url('public/uploads/assets/profiles') . '/' . 'depedlogo.png'?>" alt="">
      </th>
      <td class="logo-center">
        <span>Republic of the Philippines</span><br>
        <span>Department of Education</span><br>
        <h4>ALTERNATIVE LEARNING SYSTEM</h5>
        <h3>ALS MAPPING FORM(AMF)</h4>
        <h4>Learner's Basic Profile</h6>
      </td>
      <th class="logo-right">
      <img  style="width:90px; height=70px;" src="< ?=base_url('public/uploads/assets/profiles') . '/' . 'alslogo.png'?>" alt="">
      </th>
    </tr>
  </table> -->
  <br>
  <table class="oscya-data">
    <tr>
      <td class="left">
        <b>Date: </b><u><?php $oscya_mapping['mapping_date']?></u>
      </td>
      <td class="right">
       <b>LRN</b><small>(if available)</small>:<u><?=$oscya_mapping['lrn']?></u>
      </td>
    </tr>
  </table>
  <!-- body -->
  <table class="oscya-data">
    <tr>
      <th class="center">I. Personal Information</th>
    </tr>
  </table>
 
  <table class="oscya-data">
    <tr>
      <td><b><u><?=$oscya_info['lastname'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>
      <td><b><u><?=$oscya_info['firstname'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>
      <td><b><u><?=$oscya_info['middlename'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>
      <td><b><u><?=$oscya_info['extension'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>
    </tr>
    <tr>
      <td><small>Lastname:</small></td>
      <td><small>Firstname:</small></td>
      <td><small>Middlename:</small></td>
      <td><small>Extension:</small></td>
    </tr>
  </table>

  <table class="oscya-data">
    <tr>
      <td><b><u><?=$oscya_info['birthdate'];?></u></b></td>
      <td><b><u><?=$oscya_info['age']?></u></b></td>
      <td><b><u><?=$oscya_info['gender']?></u></b></td>
      <td><b><u><?=$oscya_info['civil_status']?></u></b></td>
    </tr>
    <tr>
      <td><small>Birthdate:</small></td>
      <td><small>Age: </small></td>
      <td><small>Gender: </small></td>
      <td><small>Civil Status: </small></td>
    </tr>
    <tr>
      <td><b><u><?=$oscya_info['religion']?></u></b></td>
    </tr>
    <tr>
      <td><small>Religion: </small></td>
    </tr>
    <tr>
      <td><b><u><?=$oscya_contact['contact']?></u></b></td>
      
    </tr>
    <tr>
      <td><small>Contact:</small></td>
      
    </tr>
    <tr>
      <th>Address</th>
    </tr>
    <tr>
      <td><b><u><?=$oscya_contact['street']?></u></b></td>
      <td><b><u><?=$oscya_contact['brgy']?></u></b></td>
      <td><b><u><?=$oscya_contact['district']?></u></b></td>
      <td><b><u><?=$oscya_contact['city']?></u></b></td>
    </tr>
    <tr>
      <td><small>Street</small></td>
      <td><small>Barangay</small></td>
      <td><small>District</small></td>
      <td><small>City</small></td>
    </tr>
    <tr>
      <th class="center">Guardian's Details</th>
    </tr>
    <tr>
      <td><b><u><?=$oscya_guardian['fullname']?></u></b></td>
      <td><b><u><?=$oscya_guardian['contact']?></u></b></td>
    </tr>
    <tr>
      <td><small>Guardian's Fullname</small></td>
      <td><small>Guardian's Contact no.</small></td>
    </tr>
  </table>
  <br>
  <table class="oscya-data">
    <tr>
      <th class="center">II. Mapping Information</th>
    </tr>
  </table>
 
  <table class="oscya-data">
    <tr>
      <td><small><b>Last grade level attended</b></small></td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_mapping['educ_attainment']){ 
            case "Kinder" : ?>
              <small><u>Elementary Level:</u> </small>Kinder[✔]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 
            
            <?php case 1: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[✔]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 2: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[✔]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 3: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[✔]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 4: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[✔]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 5: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[✔]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 6: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[✔]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 7: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[✔]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 8: ?>
              <small><u>Elementary Level:</u> </small>Kinder[]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[✔]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 9: ?>
              <small><u>Elementary Level:</u> </small>Kinder[]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[✔]&nbsp;&nbsp; G10[ ]
            <?php break; ?> 

            <?php case 10: ?>
              <small><u>Elementary Level:</u> </small>Kinder[ ]</b>&nbsp;&nbsp; G1[ ]&nbsp;&nbsp; G2[ ]&nbsp;&nbsp; G3[ ]&nbsp;&nbsp; G4[ ]&nbsp;&nbsp; G5[ ]&nbsp;&nbsp; G6[ ]<br>
              <small><u>JHS:</u> </small>G7[ ]&nbsp;&nbsp; G8[ ]&nbsp;&nbsp; G9[ ]&nbsp;&nbsp; G10[✔]
            <?php break; ?> 
        <?php } ?>
      </td>
    </tr>
  </table>
  
  <table class="oscya-data">
    <tr>
      <td><small><b>Reason for Dropping Out/Not Enrolling</b></small></td>
    </tr>
    <tr>
      <td style="word-wrap:break-word;">
        <?php switch($oscya_mapping['reason']){ 
                case "Lack of Personal Interest" : ?>
                    Lack of Personal Interest[✔] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
          <?php break;  ?> 
          <?php case "Family Related Concerns" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[✔] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?>
         <?php case "Employment" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[✔] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?> 
         <?php case "Early Pregnancy" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[✔]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?> 
         <?php case "Disability" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[✔] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?> 
         <?php case "Disease" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[✔] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?> 
         <?php case "Distance of the School" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[] &nbsp;&nbsp; Distance of the School[✔] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?> 
         <?php case "Cannot Cope with School Works" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[✔]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?> 
         <?php case "Financial Problems" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[ ]: <u></u>
         <?php break;  ?>
         <?php case "Others" : ?>
                    Lack of Personal Interest[ ] &nbsp;&nbsp; Family Related Concerns[ ] &nbsp;&nbsp; Employment[ ] &nbsp;&nbsp; Early Pregnancy[ ]
                    &nbsp;&nbsp; Disability[ ] &nbsp;&nbsp; Disease[ ] &nbsp;&nbsp; Distance of the School[ ] &nbsp;&nbsp; Cannot Cope with School Works[ ]
                    &nbsp;&nbsp; Financial Problems[ ]  &nbsp;&nbsp; Others[✔]: <u><?=$oscya_mapping['other_reason']?></u>
         <?php break;  ?>
        <?php } ?>
      </td>
    </tr>
  </table>
  
  <table class="oscya-data">
    <tr>
      <td><small><b>Disability</b></small></td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_mapping['is_pwd']){ 
              case 1 : ?>
                  <small>PWD</small> YES: <b>[✔]</b><small> &nbsp;&nbsp; No: </small><b>[ ]</b>
        <?php break;?>
        <?php case 0 : ?>
                  <small>PWD</small> YES:<b>[ ]<small> &nbsp;&nbsp; No: </small><b>[✔]</b>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_mapping['has_pwd_id']){ 
              case 1 : ?>
                  <small>Has PWD ID</small> Yes: <b>[✔]</b><small> &nbsp;&nbsp; No: </small><b>[ ]</b>
        <?php break;?>
        <?php case 0 : ?>
                  <small>Has PWD ID</small> Yes:<b>[ ]<small> &nbsp;&nbsp; No: </small><b>[✔]</b>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
  </table>
  
  <table class="oscya-data">
    <tr>
      <td><small><b>Disability</b></small></td>
    </tr>
    
    <tr>
      <td>
      <?php switch($oscya_mapping['disability']){ 
              case "Intellectual Disability" : ?>
                  Intellectual Disability[✔] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[ ] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Learning Disability" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[✔] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[ ] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Autism" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[✔] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[ ] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Blind" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[✔] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[ ] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Deaf" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[✔] &nbsp;&nbsp; Hard of Hearin[ ] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Hard of Hearin" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[✔] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Orthopedically Impaired" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[✔] &nbsp;&nbsp; Orthopedically Impaired[✔] &nbsp;&nbsp; Others[ ]
        <?php break;?>
        <?php case "Others" : ?>
                  Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[✔] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[✔]: <u><?=$oscya_mapping['other_disability']?></u>
        <?php break;?>
        <? case "": ?>
                Intellectual Disability[ ] &nbsp;&nbsp; Learning Disability[ ] &nbsp;&nbsp; Autism[ ] &nbsp;&nbsp; Blind[ ] &nbsp;&nbsp; Deaf[ ] &nbsp;&nbsp; Hard of Hearin[✔] &nbsp;&nbsp; Orthopedically Impaired[ ] &nbsp;&nbsp; Others[ ]: <u><?=$oscya_mapping['other_disability']?></u>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td><small><b>Disease:</b></small><b><?=$oscya_mapping['disease']?></b></td>
    </tr>
  </table>

  <table class="oscya-data">
    <tr>
      <td><small><b>Employment Status</b></small></td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_mapping['is_employed']){ 
              case 1 : ?>
                  Employed <b>[✔]</b> &nbsp;&nbsp; Unemployed:<b>[ ]</b>
        <?php break;?>
        <?php case 0 : ?>
                  Employed <b>[ ]</b> &nbsp;&nbsp; Unemployed: <b>[✔]</b>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td><small><b>4ps Member</b></small></td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_mapping['is_fps_member']){ 
              case 1 : ?>
                  |Yes <b>[✔]</b> &nbsp;&nbsp; No:<b>[ ]</b>
        <?php break;?>
        <?php case 0 : ?>
                  Yes <b>[ ]</b> &nbsp;&nbsp; No:<b>[✔]</b>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td><small><b>Interested in DepEd Programs</b></small></td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_mapping['is_interested']){ 
              case 1 : ?>
                  |Yes <b>[✔]</b> &nbsp;&nbsp; No:<b>[ ]</b>
        <?php break;?>
        <?php case 0 : ?>
                  Yes <b>[ ]</b> &nbsp;&nbsp; No:<b>[✔]</b>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
  </table>
  <table class="oscya-data">
    <tr>
      <td><small><b>Education Type</b></small></td>
    </tr>
    <tr>
      <td>
        <?php if($oscya_counselling['formal'] == 1):?>
          Formal <b>[✔]</b> &nbsp;&nbsp; Informal:<b>[ ]</b>
        <?php else: ?>

        <?php endif ?>

        <?php if($oscya_counselling['informal'] == 1):?>
          Formal <b>[ ]</b> &nbsp;&nbsp; Informal:<b>[✔]</b>
        <?php else: ?>
          
        <?php endif ?>
      </td>
    </tr>
    <tr>
      <td><small><b>Interested In ALS program</b></small></td>
    </tr>
    <tr>
      <td>
        <?php switch($oscya_counselling['is_interested']){ 
              case 1 : ?>
                  |Yes <b>[✔]</b> &nbsp;&nbsp; No:<b>[ ]</b>
        <?php break;?>
        <?php case 0 : ?>
                  Yes <b>[ ]</b> &nbsp;&nbsp; No:<b>[✔]</b>
        <?php break;?>
        <?php } ?>
      </td>
    </tr>
    
  </table>
  <br>
  <table class="oscya-data">
    <tr>
      <td>
        <br>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;width: 50%;">
        <b><u><?=$teacher_info['lastname'] . ', ' . $teacher_info['firstname'] . ' ' . $teacher_info['middlename'] . ' ' . $teacher_info['ext']?></u></b>
      </td>
      <td style="text-align: center;width: 50%;">
        <b><u><?=$oscya_info['lastname'] .', ' . $oscya_info['firstname'] . ' '. $oscya_info['middlename'] . ' ' .$oscya_info['extension']?></u></b>
      </td>
    </tr>
    <tr>
      <td style="text-align: center;width: 50%;"><small>Signature over printed name(Teacher)</small></td>
      <td style="text-align: center;width: 50%;"><small>Signature over printed name(Student)</small></td>
    </tr>

  </table>
  <br>
</body>
</html>