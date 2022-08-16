<h3 class="ms-3 fw-bold text-primary">RECORDS</h3>

<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <!-- <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Records</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Inserted</a>
        </li>
        
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    
                    <div class="border-start border-bottom border-end">
                       
                        <div class="bg-white p-2">
                            <div class="row justify-content-between" id="backtotop">
                                <div class="col-md-3 ">
                                    <span class="text-start">
                                        
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <input type="search" id="all_search_bar" placeholder="Search lastname" class="form-control" onkeyup="search_to_all_records()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table text-nowrap  bg-white table-hover mb-0" id="all_oscya_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Full name</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <tr id="empty_tr"></tr>
                                    <?php if (!empty($all_oscya) && is_array($all_oscya)): ?>
                                        <?php foreach ($all_oscya as $oscya): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold"><?=$oscya['id']?></span>    
                                                </td>
                                                <td class="align-middle">
                                                    <span class="fw-bold text-primary"><?=$oscya['oscya_id']?></span><br>
                                                </td>
                                                <td class="align-middle"><?=$oscya['fullname']?></td>
                                                <td class="align-middle"><?= $oscya['is_counseled'] == 1 ? "<span class='badge bg-success text-light'>Done</span>" : "<span class='badge bg-warning text-light'>For evaluation</span>"?></td>
                                                <td class="align-middle text-dark">
                                                    <div class="dropdown dropstart">
                                                        <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-xxs" data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                            <a class="dropdown-item" href="<?=base_url('staff/oscya_detail') . '/' . strtolower($oscya['oscya_id'])?>">
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
                       
                        <div class="bg-white text-center">
                            <div class="row justify-content-end">
                                <div class="col-md-3 text-end">
                                    
                                    <div class="col-md-12 align-middle text-end p-3">
                                        Records: <span class="text-danger fw-bold me-3"><?=$count_all_records->totalRecord?></span>
                                        <a href="#backtotop" role="button" class="link-primary" id="gototop">
                                            <i class="icon-xs" data-feather="arrow-up"></i>    
                                            Back to top
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                
                <div class="col-md-12 col-12">
                    <!-- card  -->
                    <div class="border-start border-bottom border-end">
                        <!-- card header  -->
                        <div class="bg-white p-2">
                            <div class="row justify-content-between" id="backtotop">
                                <div class="col-md-3 ">
                                    <span class="text-start">
                                        
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <input type="search" id="inserted_search_bar" placeholder="Search lastname" class="form-control" onkeyup="search_to_inserted_records()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive" style="height: 380px;">
                            <table class="table text-nowrap table-hover bg-white mb-0" id="inserted_oscya_table">
                                <thead class="table-light">
                                    <tr class="bg-light" style="top: 0; position:sticky;">
                                        <th>#</th>
                                        
                                        <th>Full name</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <tr id="empty_tr"></tr>
                                    <?php if (!empty($oscya_list) && is_array($oscya_list)): ?>
                                        <?php foreach ($oscya_list as $oscya): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold"><?=$oscya['id']?></span>    
                                                </td>
                                                
                                                <td class="align-middle"><?=$oscya['fullname']?></td>
                                                <td class="align-middle"><?= $oscya['is_counseled'] == 1 ? "<span class='badge bg-success text-light'>Done</span>" : "<span class='badge bg-warning text-dark'>For evaluation</span>"?></td>
                                                <td class="align-middle">
                                                    <div class="dropdown dropstart">
                                                        <a  class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-xxs" data-feather="more-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                            <a class="dropdown-item" href="<?=base_url('staff/oscya_detail') . '/' . strtolower($oscya['oscya_id'])?>">
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
                        <!-- card footer  -->
                        <div class="bg-white text-center">
                            <div class="row justify-content-end">
                                <div class="col-md-4 text-end">
                                    <!-- Total Records: <span class="text-danger fw-bold">< ?=$count_records->totalRecord?></span> -->
                                    <div class="col-md-12 align-middle text-end p-3">
                                        Records: <span class="text-danger fw-bold me-3"><?=$count_records->totalRecord?></span>
                                        <a href="#backtotop" role="button" class="link-primary" id="gototop">
                                            <i class="icon-xs" data-feather="arrow-up"></i>    
                                            Back to top
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
                
                <script>
                    let all_search_bar = document.querySelector('#all_search_bar');
                    let inserted_search_bar = document.querySelector('#inserted_search_bar');
                    let search_btn = document.querySelector('#search_btn');
                    let search_form = document.querySelector('#search_form');
                    
                    let all_oscya_table = document.querySelector('#all_oscya_table');
                    let inserted_oscya_table = document.querySelector('#inserted_oscya_table');
                    function search_bar_val(){
                        if(search_bar.value == ''){
                            return 'a';
                        }else{
                            return search_bar.value;
                        }
                    }
                    function search_to_all_records() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = all_search_bar;
                        filter = input.value.toUpperCase();
                        table = all_oscya_table;
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[1];
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
                    function search_to_inserted_records() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = inserted_search_bar;
                        filter = input.value.toUpperCase();
                        table = inserted_oscya_table;
                        tr = table.getElementsByTagName("tr");
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[1];
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
                    // search_bar.addEventListener('keyup', (e) => {
                    //     e.preventDefault();
                    //     if(!search_bar==""){
                    //         fetch('< ?=base_url('staff/search_oscya')?>/' + search_bar_val())
                    //         .then((res) => res.json())
                    //         .then((data) => {
                    //             if('message' in data){
                    //                 table_body.innerHTML=`
                    //                 <tr >
                    //                     <td colspan="5" class="align-middle text-center ">${data.message}</td>
                    //                 </tr>
                    //             `;
                    //             }
                                
                    //             // for(i = 0; i < data.length; i++){
                                    
                    //             //     const table_body = document.querySelector('#table-body');
                    //             //     const empty_tr = document.querySelector('#empty_tr');
                    //             //     const tbl_tr = document.createElement('tr');
                                    
                    //             //     // table id
                    //             //     const id = document.createElement('td');
                    //             //     id.appendChild(document.createTextNode(data[i].id));
                    //             //     // table oscya_id
                    //             //     const oscya_id = document.createElement('td');
                    //             //     oscya_id.classList ="fw-bold text-primary";
                    //             //     oscya_id.appendChild(document.createTextNode(data[i].oscya_id));
                    //             //     // table fullname
                    //             //     const fullname = document.createElement('td');
                    //             //     fullname.appendChild(document.createTextNode(data[i].fullname));
                    //             //     // status
                    //             //     const status = document.createElement('td');
                    //             //     const badge = document.createElement('span');
                    //             //     badge.classList = "badge bg-warning text-dark";
                    //             //     badge.appendChild(document.createTextNode('For Evaluation'));
                    //             //     status.appendChild(badge);
                    //             //     // link
                    //             //     const action = document.createElement('td');
                    //             //     const action_link = document.createElement('a');
                    //             //     action_link.href ="< ?=base_url('staff/oscya_detail')?>/" + data[i].oscya_id;
                    //             //     action_link.appendChild(document.createTextNode('View'));
                    //             //     action.appendChild(action_link);

                    //             //     tbl_tr.appendChild(id);
                    //             //     tbl_tr.appendChild(oscya_id);
                    //             //     tbl_tr.appendChild(fullname);
                    //             //     tbl_tr.appendChild(status);
                    //             //     tbl_tr.appendChild(action)
                                    

                    //             //     table_body.innerHTML = "";
                    //             //     table_body.insertBefore(tbl_tr, empty_tr);
                    //             // }

                    //             // if('message' in data){
                    //             //     table_body.innerHTML=`
                    //             //     <tr >
                    //             //         <td colspan="5" class="align-middle text-center ">${data.message}</td>
                    //             //     </tr>
                    //             // `;
                    //             // }
                    //             // for(i = 0; i < data.length; i++){
                    //             //     table_body.innerHTML = `
                    //             //         <tr>
                    //             //             <td class="align-middle">
                    //             //                 <span class="fw-bold">${data[i].id}</span>    
                    //             //             </td>
                    //             //             <td class="align-middle">
                    //             //                 <span class="fw-bold text-primary">${data[i].oscya_id}</span><br>
                    //             //             </td>
                    //             //             <td class="align-middle">${data[i].fullname}</td>
                    //             //             <td class="align-middle"><span class="badge bg-warning text-dark">For evaluation</span></td>
                    //             //             <td class="align-middle text-dark">
                    //             //                 <!-- Dropstart -->
                    //             //                 <div class="dropdown dropstart">
                    //             //                     <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    //             //                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    //             //                     </a>
                    //             //                     <div class="dropdown-menu" aria-labelledby="dropdownprojectOne">
                    //             //                         <h6 class="dropdown-header">Action</h6>
                    //             //                         <a class="dropdown-item" href="<?=base_url('staff/oscya_detail')?>/${data[i].oscya_id}">
                    //             //                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    //             //                             View
                    //             //                         </a>
                    //             //                     </div>
                    //             //                 </div>
                    //             //             </td>
                    //             //         </tr>
                    //             //     `; 
                    //             // } 
                    //         })
                    //         .catch((e)=>{
                    //             table_body.innerHTML=`
                    //                 <tr >
                    //                     <td colspan="5" class="align-middle text-center ">Something went wrong while retrieving osy</td>
                    //                 </tr>
                    //             `;
                    //         })
                    //     }else{
                            
                    //     }
                    // });
                    
                </script>