</div>

<div class="container-fluid">
    <div class="row justify-content-center"> 
        <div class="col-md-6">
            <div class="card p-5">
                <div class="alert alert-warning">
                    <span class="material-icons align-middle" style="font-size: 30px;">text_snippet</span>
                    <b>Note: </b>File should be in a proper format. <b>.xls, .xlsx, </b>and<b> .csv </b>file format.
                </div>
                <form action="<?=base_url('coordinator/migrate_data')?>" method="post" enctype="multipart/form-data">
                    <input type="file" accept=".xls,.xlsx,.csv"  name="migration_file" id="migration_file" style="visibility: visible;display:none;">
                    <div class="mb-3">
                        <label for="staff_id">Staff</label>
                        <select class="form-select" name="staff_id" id="staff_id">
                            <option>Select Staff</option>
                            <?php if(!empty($staffs) && is_array($staffs)):?>
                                <?php foreach($staffs as $staff): ?>
                                    <option value="<?=$staff['user_id']?>"><?=$staff['name']?></option>
                                <?php endforeach ?>
                            <?php else: ?>

                            <?php endif ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="staff_id">Teacher</label>
                        <select class="form-select" name="teacher_id" id="teacher_id">
                            <option>Select Teacher</option>
                            <?php if(!empty($teachers) && is_array($teachers)):?>
                                <?php foreach($teachers as $teacher): ?>
                                    <option value="<?=$teacher['user_id']?>"><?=$teacher['fullname']?></option>
                                <?php endforeach ?>
                            <?php else: ?>

                            <?php endif ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="staff_id">Facility</label>
                        <select class="form-select" name="facility_id" id="facility_id">
                            <option>Select Facilities</option>
                            <?php if(!empty($facilities) && is_array($facilities)):?>
                                <?php foreach($facilities as $facility): ?>
                                    <option value="<?=$facility['facility_id']?>"><?=$facility['name']?></option>
                                <?php endforeach ?>
                            <?php else: ?>

                            <?php endif ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="barangay">Barangay</label>
                        <!-- <input type="text" name="barangay" id="barangay" class="form-control" value="BAGBAG" readonly> -->
                        <input type="text" name="barangay" id="barangay" class="form-control" value="<?=$brgy_profile['barangay']?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mapping_date">Mapping Date:</label>
                        <input type="date" name="mapping_date" id="mapping_date" class="form-control">
                    </div>
                    <div class="p-5 rounded  text-center" style="border: 3px dashed lightgray;" id="open_file_mngr">
                        <span class="material-icons text-secondary" style="font-size:70px;">
                            file_upload
                        </span><br>
                        <span class="fw-bold">Upload file</span>
                        <p id="file_name"></p>
                    </div>
                    <br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">
                            <span class="material-icons align-middle">cloud_upload</span>
                            Migrate Data
                        </button>
                    </div>
                </form>
                
                
                <!-- <span class="text-success">
                    <i class="bi bi-file-earmark-excel-fill" style="font-size:100px"></i>
                    <i class="bi bi-arrow-right" style="font-size:70px"></i>
                    <i class="bi bi-table" style="font-size:100px"></i>
                </span>
                <h3 class="text-success navbar-heading">Import From Excel</h3> -->
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const open_file_mngr = document.querySelector('#open_file_mngr');
    const migration_file = document.querySelector('#migration_file');
    const file_name = document.querySelector('#file_name');

    open_file_mngr.addEventListener('click', ()=>{
        migration_file.click();
        
    });
    migration_file.addEventListener('change', ()=>{
        file_name.innerHTML = migration_file.value;
    })
    
    <?php if(session()->getFlashdata('success')) : ?>
        swal({
            title: "Inserted!",
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