</div>
<div class="container-fluid">
     <!-- javascript behaviour -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="new-tab" data-bs-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">New</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Approved</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active bg-white" id="new" role="tabpanel" aria-labelledby="new-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <!-- card  -->
                    <div class="bg-white">
                        <!-- card header  -->
                        <div class="card-header bg-white py-1">
                            <div class="row justify-content-between">
                                <div class="col-md-3 py-2">
                                    <h4 class="">Registration</h4>
                                </div>
                                <div class="col-md-3 py-1">
                                    <input type="search" name="search_bar" id="search_bar" class="form-control" placeholder="Search Name" onkeyup="myFunction()">
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Full name</th>
                                        <th>Contact #</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($register) || is_array($register)):?>
                                        <?php foreach($register as $staff): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold"><?=$staff['user_id']?></span>    
                                                </td>
                                                <td class="align-middle">
                                                    <span class="fw-bold text-primary"><?=$staff['username']?></span><br>
                                                    
                                                </td>
                                                <td class="align-middle"><?=$staff['fullname']?></td>
                                                <td class="align-middle"><?=$staff['contact_no']?></td>
                                                <td class="align-middle"><span class="badge bg-warning text-dark">For evaluation</span></td>
                                                <td class="align-middle text-dark">
                                                    <!-- Dropstart -->
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" class="icon-xs"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <h6 class="dropdown-header">Action</h6>
                                                            <a class="dropdown-item" href="<?=base_url('coordinator/view_registration') . '/' . $staff['user_id']?>">
                                                                <i data-feather="eye" class="icon-xxs"></i>
                                                                View
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No Registration</td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <!-- card  -->
                    <div class="bg-white">
                        <!-- card header  -->
                        <div class="row justify-content-between">
                            <div class="col-md-3 pt-2">
                                <h4 class="">Registration</h4>
                            </div>
                            <div class="col-md-3 py-1">
                                <input type="search" name="search_pending" id="search_pending" class="form-control" placeholder="Search Name" onkeyup="pendingFunction()">
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0" class="pending_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Full name</th>
                                        <th>Contact #</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($pending) || is_array($pending)):?>
                                        <?php foreach($pending as $staff): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold"><?=$staff['user_id']?></span>    
                                                </td>
                                                <td class="align-middle">
                                                    <span class="fw-bold text-primary"><?=$staff['username']?></span>
                                                </td>
                                                <td class="align-middle"><?=$staff['fullname']?></td>
                                                <td class="align-middle"><?=$staff['contact_no']?></td>
                                                <td class="align-middle"><span class="badge bg-warning text-dark">For resubmission</span></td>
                                                <td class="align-middle text-dark">
                                                    <!-- Dropstart -->
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" class="icon-xs"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <h6 class="dropdown-header">Action</h6>
                                                            <a class="dropdown-item" href="<?=base_url('coordinator/view_registration') . '/' . $staff['user_id']?>">
                                                                <i data-feather="eye" class="icon-xxs"></i>
                                                                View
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
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <!-- card  -->
                    <div class="bg-white">
                        <!-- card header  -->
                        <div class="card-header bg-white  py-4">
                            <div class="row justify-content-between">
                                <div class="col-md-3 pt-2">
                                    <h4 class="">Registration</h4>
                                </div>
                                <div class="col-md-3 py-1">
                                    <input type="search" name="search_pending" id="search_pending" class="form-control" placeholder="Search Name" onkeyup="approvedFunction()">
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Staff ID</th>
                                        <th>Username</th>
                                        <th>Full name</th>
                                        <th>Contact #</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($approved) || is_array($approved)):?>
                                        <?php foreach($approved as $staff): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold"><?=$staff['user_id']?></span>    
                                                </td>
                                                <td class="align-middle">
                                                    <span class="fw-bold text-primary"><?=$staff['username']?></span>
                                                </td>
                                                <td class="align-middle"><?=$staff['fullname']?></td>
                                                <td class="align-middle"><?=$staff['contact_no']?></td>
                                                <td class="align-middle"><span class="badge bg-success text-light">Approved</span></td>
                                                <td class="align-middle text-dark">
                                                    <!-- Dropstart -->
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" class="icon-xs"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                                                        <h6 class="dropdown-header">Action</h6>
                                                            <a class="dropdown-item" href="<?=base_url('coordinator/view_staff') . '/' . $staff['user_id']?>">
                                                                <i data-feather="eye" class="icon-xxs"></i>
                                                                View
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            
        
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    const staff_table = document.querySelector('#staff_table');
                    const search_bar = document.querySelector('#search_bar');
                    const pending_table = document.querySelector('#pending_table');
                    const search_pending = document.querySelector('#search_pending');
                    const approved_table = document.querySelector('#approved_table');
                    const search_approved = document.querySelector('#search_approved');

                    function myFunction() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = search_bar;
                        filter = input.value.toUpperCase();
                        table = staff_table;
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[2];
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
                    
                    function pendingFunction() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = search_pending;
                        filter = input.value.toUpperCase();
                        table = pending_table;
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[2];
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

                    function approvedFunction() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = search_approved;
                        filter = input.value.toUpperCase();
                        table = approved_table;
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[2];
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
                
                    <?php if(session()->getFlashdata('success')): ?>
                        swal({
                            title: "Evaluated!",
                            text: "<?=session()->getFlashdata('success') ?>",
                            icon: "success",
                            button: "Close"
                        });
                    <?php endif;?>
                    <?php if(session()->getFlashdata('info')): ?>
                        swal({
                            title: "Pending!",
                            text: "<?=session()->getFlashdata('info') ?>",
                            icon: "info",
                            button: "Close"
                        });
                    <?php endif;?>
                    <?php if(session()->getFlashdata('fail')): ?>
                        swal({
                            title: "Failed!",
                            text: "<?=session()->getFlashdata('fail') ?>",
                            icon: "error",
                            button: "Close"
                        });
                    <?php endif;?>
                </script>