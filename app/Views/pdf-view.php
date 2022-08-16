<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body{
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .oscya-data{
      font-family: Arial, Helvetica, sans-serif;
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
    td{
      font-size: 11px;
    }
  </style>
</head>
<body>
  <table class="oscya-data">
    <tr>
      <th class="logo-left">
        <img  style="width:70px; height=70px;" src="<?=base_url('public/uploads/assets/profiles') . '/' . 'depedlogo.png'?>" alt="">
      </th>
      <td class="logo-center">
        <span>Republic of the Philippines</span><br>
        <span>Department of Education</span><br>
        <h4>ALTERNATIVE LEARNING SYSTEM</h5>
        <h3>ALS ENROLLMENT FORM(AF)</h4>
        <h4>Learner's Basic Profile</h6>
      </td>
      <th class="logo-right">
      <img  style="width:90px; height=70px;" src="<?=base_url('public/uploads/assets/profiles') . '/' . 'alslogo.png'?>" alt="">
      </th>
    </tr>
  </table>
  <br>
  <table class="oscya-data">
  <tr>
      <td class="left">
        Date: <u>[DATE OF ENROLLMENT]</u>
      </td>
      <td class="right">
        LRN(if available): <u>[XXXXXXXXXXXX]</u>
      </td>
    </tr>
  </table>
  <br>
  <table class="oscya-data">
    <tr>
      <th class="center">Personal Information</th>
    </tr>
  </table>
  <table class="oscya-data">
    
    <tr>
    <td>Lastname: <u>[Dela Cruz]</u></td>
    <td>Firstname: <u>[Juan]</u></td>
    <td>Middlename: <u>[Tamad]</u></td>
    <td>Extension: <u>[jr]</u></td>
    </tr>
  </table>
</body>
</html>