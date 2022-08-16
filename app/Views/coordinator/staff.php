</div>
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12 col-12">
            <!-- card  -->
            <div class="card">
                <!-- card header  -->
                <div class="card-header bg-white py-4">
                    <div class="row justify-content-between" id="backtotop">
                        <div class="col-md-3">
                            <span class="text-start fw-bold">
                                All Records
                            </span>
                        </div>
                        <div class="col-md-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="search" id="search_bar" placeholder="Search lastname" class="form-control" onkeyup="myFunction()">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table  -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0" id="staff-table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (! empty($staffs) && is_array($staffs)): ?>
                                <?php foreach ($staffs as $staff): ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="icon-shape icon-sm">
                                                        <?php if(empty($staff['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\', $staff['image']))): ?>
                                                                <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="blank image" class="avatar avatar-sm rounded-circle">
                                                        <?php else : ?>
                                                                <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $staff['image']?>" class="avatar avatar-sm rounded-circle">
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="ms-3 lh-1">
                                                    <h5 class=" mb-1"><?= $staff['user_id']?></h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle"><small class="text-secondary"><?=$staff['name']?></small></td>
                                        
                                        <td class="align-middle">
                                            <?php if($staff['status'] == 1): ?>
                                                <span class="badge bg-success">Online</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Offline</span>
                                            <?php endif ?>

                                        </td>
                                        <td class="align-middle text-dark">
                                            <!-- Dropstart -->
                                            <div class="dropdown dropstart">
                                                <a href="#" class="text-muted text-primary-hover" id="dropdownprojectOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" class="icon-xxs"></i>
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
                            <?php else : ?>

                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <!-- card footer  -->
                <div class="card-footer bg-white text-center">
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const staff_table = document.querySelector('#staff-table');
    const search_bar = document.querySelector('#search_bar');
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = search_bar;
        filter = input.value.toUpperCase();
        table = staff_table;
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
</script>
