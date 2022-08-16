</div>
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-12">
            <div class="card p-3">
                <h3 class="text-primary">Backups</h3>
                 <!-- javascript behaviour -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Configure</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Lists of Backups</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-3">
                                    <h4 class="text-primary">Configure Backups</h4>
                                    <form action="<?=base_url('coordinator/backup')?>" method="post">
                                        <div class="row gy-3">
                                            <div class="col-md-3">
                                                <label for="backup_type">Choose what to backup:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="backup_type" id="backup_type" class="form-select">
                                                    <option >Select</option>
                                                    <option <?=set_select('backup_type', "OSY Records")?>>OSY Records</option>
                                                </select>
                                                <?php if(isset($validation) && $validation->hasError('backup_type')): ?> 
                                                    <?='<span class="text-danger">' . $validation->getError('backup_type') . '</span>'?>
                                                <?php endif ?>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-3">
                                                <label for="backup_date">Date:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="date_from" class="form-label">From:</label>
                                                <input type="date" name="date_from" id="date_from" class="form-control" value="<?=set_value('date_from')?>">
                                                <?php if(isset($validation) && $validation->hasError('date_from')): ?> 
                                                    <?='<span class="text-danger">' . $validation->getError('date_from') . '</span>'?>
                                                <?php endif ?>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="date_to" class="form-label">To:</label>
                                                <input type="date" name="date_to" id="date_to" class="form-control" value="<?=set_value('date_to')?>">
                                                <?php if(isset($validation) && $validation->hasError('date_to')): ?> 
                                                    <?='<span class="text-danger">' . $validation->getError('date_to') . '</span>'?>
                                                <?php endif ?>
                                            </div>
                                            <div class="col-md-12"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" class="btn btn-success">Create Backup</button>
                                            </div>
                                            
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row justify-content-between py-2" id="backtotop">
                                    <div class="col-md-3">
                                        <h4 class="pt-2">List of back up files</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="search" id="search_bar" placeholder="Search lastname" class="form-control" onkeyup="myFunction()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-responsive" id="backup_table">
                                    <thead>
                                        <tr>
                                            <th>Back up File</th>
                                            <th>Type</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($backups) && is_array($backups)): ?>
                                            <?php foreach($backups as $backup): ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <span class="fw-bold fs-5"><?=$backup['filename'] .'.xlsx'?></span>
                                                    </td>
                                                    <td class="align-middle"><?=$backup['choose']?></td>
                                                    <td class="align-middle"><?=$backup['date_created']?></td>
                                                    <td class="align-middle text-end">
                                                        <a class="btn btn-success btn-sm" href="<?=base_url('public/uploads/backups')  . '/' . $backup['backup_loc']?>">
                                                            <span class="material-icons align-middle">cloud_download</span>
                                                            &nbsp;Download
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const backup_table = document.querySelector('#backup_table');
    const search_bar = document.querySelector('#search_bar');
                    
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = search_bar;
        filter = input.value.toUpperCase();
        table = backup_table;
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
            icon: "error",
            button: "Close",
        });
    <?php endif ?>
</script>