<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class=" shadow-sm bg-white p-3 rounded-top">
                <ul class="nav justify-content-end">
                    <li class="nav-item px-1">
                        <a href="<?=base_url('alscoordinator/task') . '/' . $cid['coord_id']?>" class="btn btn-outline-green-2 " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign Task"><i class="bi bi-list-task"></i></a>
                    </li>
                    <li class="nav-item px-1">
                        <a href="<?=base_url('alscoordinator/report'). '/' . $cid['coord_id']?>" class="btn btn-outline-green-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Generate Report"><i class="bi bi-printer"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class=" shadow-sm bg-white" style="box-sizing: border-box;height:400px;overflow:auto;">
                
                <table class="table table-responsive table-hover ">
                    <thead>
                        <style>
                            th{
                                position: sticky;
                            }
                        </style>
                        <tr>
                            <th class="p-3 align-middle border-bottom" style="background-color: #ffffff;">ID</th>
                            <th class="p-3 align-middle border-bottom" style="background-color: #ffffff;">OSCYA ID</th>
                            <th class="p-3 align-middle border-bottom" style="background-color: #ffffff;">Fullname</th>
                            <th class="p-3 align-middle border-bottom" style="background-color: #ffffff;">Birthdate</th>
                            <th class="p-3 align-middle border-bottom" style="background-color: #ffffff;">Age</th>
                            <th class="p-3 align-middle border-bottom" style="background-color: #ffffff;">Gender</th>
                        </tr>
                        <tbody>
                            <?php if( !empty($oscya) || is_array($oscya)):?>
                                <?php foreach ($oscya as $indv): ?>
                                    <tr class="align-middle">
                                        <th class="p-3 form-text"><?=$indv['id']?></th>
                                        <td class="p-3 form-text"><?=$indv['oscya_id']?></td>
                                        <td class="p-3 form-text"><?=$indv['fullname']?></td>
                                        <td class="p-3 form-text"><?=date("F j, Y", strtotime($indv['birthdate']))?></td>
                                        <td class="p-3 form-text"><?=$indv['age']?></td>
                                        <td class="p-3 form-text"><?=$indv['gender']?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class=" shadow-sm light p-3 rounded-top">
                <ul class="nav justify-content-end">
                    <li class="nav-item px-1">
                        <label for="" class="form-text">Total Record: <span class="fw-bold"><?php echo $count['total'];?></span></label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>