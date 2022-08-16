</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ongoing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Counseled</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <!-- card  -->
                            <div class="">
                                <!-- card header  -->
                                <div class="bg-white p-3 border-start border-end">
                                    <div class="row justify-content-between">
                                        <div class="col-md-3">
                                            <h4 class="mt-2">Records</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="search" name="search_bar" id="all_task_search_bar" class="form-control" placeholder="search name" onkeyup="all_task()">
                                        </div>
                                    </div>
                                </div>
                                <!-- table  -->
                                <div class="table-responsive bg-white border-start border-end" id="all_task_table">
                                    <table class="table text-nowrap table-hover mb-0" id="all_task_table">
                                        <thead class="table-light"> 
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Cellphone No.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($osya_records) && !empty($osya_records) && is_array($osya_records)): ?>
                                                <?php foreach($osya_records as $osya_record): ?>
                                                    <tr>
                                                        <td class="align-middle"><?=$osya_record['id']?></td>
                                                        <td class="align-middle">
                                                            <h5 class=" mb-1"> <a href="<?=base_url('teacher/view_oscya_details') . '/' . $osya_record['oscya_id']?>" class="text-inherit"><?=$osya_record['oscya_id']?></a></h5>
                                                        </td>
                                                        <td class="align-middle"><?=$osya_record['fullname']?></td>
                                                        <td class="align-middle">
                                                            <?=$osya_record['contact']?>
                                                        </td>
                                                        
                                                        <td class="align-middle text-dark">
                                                            <div class="dropdown dropstart">
                                                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="icon-xxs" data-feather="more-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                                    <a class="dropdown-item" href="<?=base_url('teacher/view_oscya_details') . '/' . $osya_record['oscya_id']. '/' . $page_info['staff_id']?>">
                                                                        <i class="icon-sm" data-feather="eye"></i>
                                                                        View
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center align-middle bg-light-warning">
                                                        No Assign Tasks
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <!-- card  -->
                            <div class="">
                                <!-- card header  -->
                                <div class="bg-white p-3 border-start border-end">
                                    <div class="row justify-content-between">
                                        <div class="col-md-3">
                                            <h4 class="mt-2">Records</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="search" name="search_bar" id="ongoing_task_search_bar" class="form-control" placeholder="search name" onkeyup="ongoing_task()">
                                        </div>
                                    </div>
                                </div>
                                <!-- table  -->
                                <div class="table-responsive bg-white border-start border-end">
                                    <table class="table text-nowrap table-hover mb-0" id="ongoing_task_table">
                                        <thead class="table-light"> 
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Cellphone No.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($ongoing_osy) && !empty($ongoing_osy) && is_array($ongoing_osy)): ?>
                                                <?php foreach($ongoing_osy as $ongoing): ?>
                                                    <tr>
                                                        <td class="align-middle"><?=$ongoing['id']?></td>
                                                        <td class="align-middle">
                                                            <h5 class=" mb-1"> <a href="<?=base_url('teacher/view_oscya_details') . '/' . $ongoing['oscya_id']?>" class="text-inherit"><?=$ongoing['oscya_id']?></a></h5>
                                                        </td>
                                                        <td class="align-middle"><?=$ongoing['fullname']?></td>
                                                        <td class="align-middle">
                                                            <?=$ongoing['contact']?>
                                                        </td>
                                                        
                                                        <td class="align-middle text-dark">
                                                            <div class="dropdown dropstart">
                                                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="icon-xxs" data-feather="more-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                                    <a class="dropdown-item" href="<?=base_url('teacher/view_oscya_details') . '/' . $ongoing['oscya_id']. '/' . $page_info['staff_id']?>">
                                                                        <i class="icon-sm" data-feather="eye"></i>
                                                                        View
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center align-middle bg-light-warning">
                                                        No Assign Tasks
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
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <!-- card  -->
                            <div class="">
                                <!-- card header  -->
                                <div class="bg-white p-3 border-start border-end">
                                    <div class="row justify-content-between">
                                        <div class="col-md-3">
                                            <h4 class="mt-2">Records</h4>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="search" name="search_bar" id="search_bar" class="form-control" placeholder="search name" onkeyup="accomplished_task()">
                                        </div>
                                    </div>
                                </div>
                                <!-- table  -->
                                <div class="table-responsive bg-white border-start border-end">
                                    <table class="table text-nowrap mb-0" id="accomplished_task_table">
                                        <thead class="table-light"> 
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Cellphone No.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($counseled_osy) && !empty($counseled_osy) && is_array($counseled_osy)): ?>
                                                <?php foreach($counseled_osy as $counseled): ?>
                                                    <tr>
                                                        <td class="align-middle"><?=$counseled['id']?></td>
                                                        <td class="align-middle">
                                                            <h5 class=" mb-1"> <a href="<?=base_url('teacher/view_oscya_details') . '/' . $counseled['oscya_id']?>" class="text-inherit"><?=$counseled['oscya_id']?></a></h5>
                                                        </td>
                                                        <td class="align-middle"><?=$counseled['fullname']?></td>
                                                        <td class="align-middle">
                                                            <?=$counseled['contact']?>
                                                        </td>
                                                        
                                                        <td class="align-middle text-dark">
                                                            <div class="dropdown dropstart">
                                                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="icon-xxs" data-feather="more-vertical"></i>
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                                    <a class="dropdown-item" href="<?=base_url('teacher/view_oscya_details') . '/' . $counseled['oscya_id'] . '/' . $page_info['staff_id']?>">
                                                                        <i class="icon-sm" data-feather="eye"></i>
                                                                        View
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center align-middle bg-light-warning">
                                                        No Assign Tasks
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
        </div>
    </div>
</div>
<!-- row  -->
<div class="container-fluid">
    
</div>
<script>
    const all_task_table = document.querySelector('#all_task_table');
    const all_task_search_bar = document.querySelector('#all_task_search_bar');
    const ongoing_task_table = document.querySelector('#ongoing_task_table');
    const ongoing_task_search_bar = document.querySelector('#ongoing_task_search_bar');
    const accomplished_task_table = document.querySelector('#accomplished_task_table');
    const accomplished_task_search_bar = document.querySelector('#accomplished_task_search_bar');

    
    function all_task() {
        var input, filter, table, tr, td, i, txtValue;
        input = all_task_search_bar;
        filter = input.value.toUpperCase();
        table = all_task_table;
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
    function ongoing_task() {
        var input, filter, table, tr, td, i, txtValue;
        input = ongoing_task_search_bar;
        filter = input.value.toUpperCase();
        table = ongoing_task_table;
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
    function accomplished_task() {
        var input, filter, table, tr, td, i, txtValue;
        input = accomplished_task_search_bar;
        filter = input.value.toUpperCase();
        table = accomplished_task_table;
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
</script>