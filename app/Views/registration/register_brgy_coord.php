<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="< ?=base_url('public/bootstrap-litera.css');?>"> -->
        <link href="<?=base_url('public/sources/bootstrap-icons/font')?>/bootstrap-icons.css" rel="stylesheet">
        <link href="<?=base_url('public/sources/dropzone/dist')?>/dropzone.css"  rel="stylesheet">
        <link href="<?=base_url('public/sources/@mdi/font/css')?>/materialdesignicons.min.css" rel="stylesheet" />
        <link href="<?=base_url('public/sources/prismjs/themes')?>/prism-okaidia.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('public/sources')?>/assets/css/theme.css">
        <style>
            
            .file-tab{
                border: 2px dashed var(--bs-secondary);
                border-radius: 5px;
               
                box-sizing: border-box;
                width: 100%;
            }
        </style>
        <title>Coordinator Registration</title> 
    </head>
    <body class="bg-light-success">
        <div class="container-fluid">
            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <div class="card smooth-shadow-md p-5">
                        <div id="form_message">
                            <span id="in_mess"></span>
                        </div>
                        <form action="<?=base_url('registration/brgy_coordinator')?>" method="post" id="create_account" enctype="multipart/form-data">
                            <!-- < ?=csrf_field();?>
                            < ?php if (isset($error)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    < ?php echo $error; ?>
                                </div>
                            < ?php endif; ?> -->
                            <h4 class="text-success fw-bold fs-3">Registration</h4>
                            <span class="form-label">Register to create barangay coordinator account</span>
                            <br><br>
                            <div class="mb-3">
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <label for="lastname" class="form-label">Last name</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="lastname">
                                        <small id="lastnameErr"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="firstname" class="form-label">First name</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="firstname">
                                        <small id="firstnameErr"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">District</label>
                                <select name="district" id="district" class="form-select py-2">
                                    <option value="">Select District</option>
                                    <option value="1">District 1</option>
                                    <option value="2">District 2</option>
                                    <option value="3">District 3</option>
                                    <option value="4">District 4</option>
                                    <option value="5" selected>District 5</option>
                                    <option value="6">District 6</option>
                                </select>
                                <small id="districtErr"></small>
                            </div>
                            <div class="mb-3">
                                <label for="barangay" class="form-label">Barangay</label>
                                <select name="barangay" id="barangay" class="form-select py-2">
                                    <option selected>Select</option>
                                    <option value="Bagbag">Bagbag</option>
                                    <option value="Capri">Capri</option>
                                    <option value="Fairview">Fairview</option>
                                    <option value="Greater Lagro">Greater Lagro</option>
                                    <option value="Gulod">Gulod</option>
                                    <option value="Kaligayahan">Kaligayahan</option>
                                    <option value="Nagkaisang Nayon">Nagkaisang Nayon</option>
                                    <option value="North Fairview">North Fairview</option>
                                    <option value="Novaliches">Novaliches</option>
                                    <option value="Pasong Putik">Pasong Putik</option>
                                    <option value="San Agustin">San Agustin</option>
                                    <option value="San Bartolome">San Bartolome</option>
                                    <option value="Sta. Lucia">Sta. Lucia</option>
                                    <option value="Sta. Lucia">Sta. Monica</option>
                                </select>
                                <small id="barangayErr"></small>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="middlename" class="form-label">Middle name</label>
                                <input type="text" name="middlename" id="middlename" class="form-control" placeholder="middlename"  value="<?=set_value('middlename')?>">
                                <small class="text-danger">< ?= isset($validation) ? display_error($validation, 'middlename') : '';?></small>
                            </div>
                            <div class="mb-3">
                                <label for="suffix" class="form-label">Name Extension</label>
                                <input type="text" name="suffix" id="suffix" class="form-control" placeholder="suffix"  value="<?=set_value('suffix')?>">
                                <small class="text-danger">< ?= isset($validation) ? display_error($validation, 'suffix') : '';?></small>
                            </div> -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email">
                                <small id="emailErr"></small>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" name="username" id="username" class="form-control" placeholder="username">
                                <small id="usernameErr"></small>
                                
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••••">
                                <small id="passwordErr"></small>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="••••••••••">
                                <small id="pass_match"></small>
                                <small id="confirm_passwordErr"></small>
                            </div>
                            <div class="mb-3">
                                <small class="text-blue-3">Password requirements:</small>
                                <p class="text-dark">Ensure that these requirements are met:</p>
                                <ul class="form-text">
                                    <li><span class="text-success">✔</span> Minimum 8 characters long the more, the better</li>
                                    <li><span class="text-success">✔</span> At least one lowercase character</li>
                                    <li><span class="text-success">✔</span> At least one uppercase character</li>
                                    <li><span class="text-success">✔</span> At least one number, symbol, or whitespace character
                                    </li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Upload Valid ID</label><small class="form-text text-danger"> Required</small>
                                <div class="file-tab text-center py-4 text-wrap" id="file_tab">
                                    <input type="file" name="valid_id" id="valid_id" style="visibility: hidden;display:none;">
                                        <i class="icon-lg" data-feather="image"></i>
                                    <br>
                                    <span class="text-blue-3">Upload Image</span>
                                    <br>
                                    <small class="text-secondary" id="file_name"></small>
                                </div>
                                <small class="validIdErr"></small>
                            </div>
                            <div class="mb-3">
                                <small class="text-blue-3">Valid ID Types:</small>
                                <p class="text-dark">Scanned copy should be...</p>
                                <ul class="form-text">
                                    <li><span class="text-success">✔</span> National ID</li>
                                    <li><span class="text-success">✔</span> Local government issued ID</li>
                                    <li><span class="text-success">✔</span> Voter's ID</li>
                                    <li><span class="text-success">✔</span> Driver's license</li>
                                    <li><span class="text-success">✔</span> Postal ID</li>
                                    <li><span class="text-success">✔</span> Quezon City ID</li>
                                </ul>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" class="form-check-input" id="agreeCheck">
                                    <label class="form-check-label" for="agreeCheck">
                                        <small  >
                                            I agree to the <a href="#" class="link-blue-3">
                                            Terms of Service </a> and <a href="#" class="link-blue-3">Privacy Policy.</a>
                                        </small>
                                    </label>
                                </div>
                                <span id="mustAgree" class="form-label text-danger"></span>
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                <button id="submit" class="btn btn-success py-2 fw-bold" type="submit" disabled>Register</button>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-md-6">
                                    <a href="<?=base_url('coordinator/login')?>" class="link-primary" >Sign In</a></small>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="<?=base_url('coordinator/forgot_password')?>" class="link-primary">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center; padding-top: 100px;">
                    <small class="fw-bold text-light">Created By: Group IA, QCU</small>
                    <br>
                    <small class="fw-bold text-light">@2021</small>
                </div>
            </div>
        </div>
        <script src="<?=base_url('public/sources')?>/jquery/dist/jquery.min.js"></script>
        <script src="<?=base_url('public/sources')?>/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url('public/sources')?>/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url('public/sources')?>/feather-icons/dist/feather.min.js"></script>
        <script src="<?=base_url('public/sources')?>/prismjs/prism.js"></script>
        <script src="<?=base_url('public/sources')?>/apexcharts/dist/apexcharts.min.js"></script>
        <script src="<?=base_url('public/sources')?>/dropzone/dist/min/dropzone.min.js"></script>
        <script src="<?=base_url('public/sources')?>/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
        <script src="<?=base_url('public/sources')?>/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
        <!-- Theme JS -->
        <!-- build:js @@webRoot/assets/js/theme.min.js -->
        <script src="<?=base_url('public/sources')?>/assets/js/main.js"></script>
        <script src="<?=base_url('public/sources')?>/assets/js/feather.js"></script>
        <script src="<?=base_url('public/sources')?>/assets/js/sidebarMenu.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
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
                    icon: "error",
                    button: "Close",
                });
            <?php endif ?>
            const lastname = document.querySelector('#lastname'); 
            const firstname = document.querySelector('#firstname'); 
            const district = document.querySelector('#district');
            const barangay = document.querySelector('#barangay');
            const email = document.querySelector('#email'); 
            const username = document.querySelector('#username');
            const password = document.querySelector('#password'); 
            const confirm_password = document.querySelector('#confirm_password'); 
            const valid_id = document.querySelector('#valid_id');

            const lastnameErr = document.querySelector('#lastnameErr'); 
            const firstnameErr = document.querySelector('#firstnameErr'); 
            const districtErr = document.querySelector('#districtErr');
            const barangayErr = document.querySelector('#barangayErr');
            const emailErr = document.querySelector('#emailErr'); 
            const usernameErr = document.querySelector('#usernameErr');
            const passwordErr = document.querySelector('#passwordErr'); 
            const confirm_passwordErr = document.querySelector('#confirm_passwordErr'); 
            const validIdErr = document.querySelector('#validIdErr');
            
            const selectOption = document.querySelector('#selectOption');

            const file_tab = document.querySelector('#file_tab');
            
            const file_name = document.querySelector('#file_name');

            const pass = document.querySelector('#password');
            const conf_pass = document.querySelector('#confirm_password');
            const pass_match = document.querySelector('#pass_match');

            const agreeCheck = document.querySelector('#agreeCheck');
            const submit = document.querySelector('#submit');
            const mustAgree = document.querySelector('#mustAgree');

            const create_account = document.querySelector('#create_account');


            // const districts = [
            //     "Alicia"," Bagong Pagasa", "Bahay Toro", "Balingasa", "Bungad", "Damar", "Damayan", "Del Monte", "Katipunan", "Lourdes",
            //     "Maharlika", "Manresa", "Mariblo", "Masambong", "N.S. Amoranto", "Nayon Kanluran", "Paang Bundok", "Pag-ibig sa Nayon", "Paltok", "Paraiso", "Phil-am", "Project 6", "Ramon Magsaysay", 
            //     "Salvacion", "San Antonio", "San Isidro Labrador", "San Jose", "Sienna","St. Peter", "Sta. Cruz", "Sta. Teresita", "Sto. Cristo", "Sto. Domingo", "Talayan", "Vasra", "Veterans Village", "West Triangle", "Bagong Silangan", "Batasan Hills", "Commonwealth", "Payatas", "Holy Spirit",
            //     "Amihan", "Bagumbayan", "Bagumbuhay", "Bayanihan",  "Blue Ridge A", "Blue Ridge B", "Camp Aguinaldo", "Claro", "Dioquino Zobel", "Duyan-duyan", "E. Rodriquez", "East Kamias", "Escopa 1", "Escopa 2", "Escopa 3", "Escopa 4", "Libis", "Loyola Heights", "Manga", "Marilag", "Masagana", "Matandang Balara", "Milgrosa",
            //     "Pansol", "Quirino 2-A", "Quirino 2-B", "Quirino 2-C", "Quirino 3-A", "San Roque", "Silangan", "Socorro", "St. Ignatius", "Tagumpay", "Ugong Norte", "Villa Maria Clara", "West Kamias", "White Plains", "B.L. ng Crame", "Botocan", "Central", "Damayang Lagi", "Don Manuel", "Doña Aurora", "Doña Imelda", "Doña Josefa", "Horseshoe", "Immaculate Concepcion","Kalusugan", "Kamuning", "Kaunlaran",
            //     "Kristong Hari", "Krus na Ligas", "Laging Handa", "Malaya", "Mariana", "Obrero", "Old Capitol Site", "Paligsahan", "Pinagkaisahan", "Pinyahan", "Roxas", "Sacred Heart", "San Isidro Galas", "San Martin de Porres", "San Vicente",
            //     "Santo Niño", "Santol", "Sikatuna Village", "South Triangle", "Tatalon", "Teachers Village East", "Teachers Village West", "UP Campus", "UP Village", "Valencia", "Bagbag", "Capri", "Fairview", "Greater Lagro", "Gulod", "Kaligayahan", "Nagkaisang Nayon", "North Fairview", "Novaliches", "Pasong Putik", "San Agustin","San Bartolome", "Sta. Lucia", "Sta. Monica",
            //     "Aplonio Samson", "Baesa", "Balumbato", "Culiat", "New Era", "Pasong Tamo", "Sangandaan", "Sauyo", "Talipapa", "Tandang Sora", "Unang Sigaw"
            // ];

            // for (let i = 0; i < districts.length; i++) {
            //     const option = document.createElement('option');
            //     option.value=districts[i];
            //     option.appendChild(document.createTextNode(districts[i]));
            //     barangay.insertBefore(option, selectOption);
            // }

            conf_pass.addEventListener('keyup', ()=>{
                if(conf_pass.value != pass.value){
                    pass_match.innerHTML = "<span class='text-danger'>Password Doesn't Match</span>";
                    conf_pass.classList.toggle('border-danger');
                }else{
                    pass_match.innerHTML = "<span class='text-success'>Password Match</span>";
                    conf_pass.classList.remove('border-danger');
                    conf_pass.classList.add('border-success');
                }
            });

            file_tab.addEventListener('click', ()=>{
                valid_id.click();
            });

            valid_id.addEventListener('change', ()=>{
                file_name.innerHTML = valid_id.value;
            });
            
            agreeCheck.addEventListener('change', ()=>{
                if(agreeCheck.checked == 0){
                    mustAgree.innerHTML = "You must Agree with the terms and policy";
                    submit.disabled =true;
                }else{
                    mustAgree.innerHTML ='';
                    submit.disabled =false;
                }
            });

            // create_account.addEventListener('submit', (e) => {
            //     e.preventDefault();

            //     if (lastname.value == "" && firstname.value =="" && district.value == "" && barangay.value == "" && email.value == "" && username.value == "" && password.value == "" && confirm_password.value == ""){
            //         lastnameErr.innerHTML = '<span class="text-danger">Last name required</span>'; 
            //         firstnameErr.innerHTML = '<span class="text-danger">First name required</span>'; 
            //         districtErr.innerHTML = '<span class="text-danger">District required</span>';
            //         barangayErr.innerHTML = '<span class="text-danger">Barangay required</span>';
            //         emailErr.innerHTML = '<span class="text-danger">Email required</span>'; 
            //         usernameErr.innerHTML = '<span class="text-danger">Username required</span>';
            //         passwordErr.innerHTML = '<span class="text-danger">Password required</span>'; 
            //         confirm_passwordErr.innerHTML = '<span class="text-danger">Confirm password</span>'; 
            //     }
                    
            //         const accountData = new FormData(create_account);

            //         fetch('<?=base_url('registration/brgy_coordinator')?>', {
            //             method:'post',
            //             body:accountData
            //         })
            //         .then((response) => response.json())
            //         .then((data) => {
            //             const alert = document.createElement('div');
            //             alert.className = `alert ${data.class}`;
            //             alert.id = 'message_content';
            //             alert.appendChild(document.createTextNode(data.message));
            //             const form_message = document.querySelector('#form_message');
            //             const in_mess = document.querySelector('#in_mess');
            //             form_message.insertBefore(alert, in_mess);
            //             setTimeout(()=>{
            //                 document.querySelector('#message_content').remove();
            //             },2000);
            //         });
                
                
            // });
        </script>
    </body>
</html>

