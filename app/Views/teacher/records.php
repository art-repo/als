</div>
<div class="container-fluid">
    <div class="row mt-6">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white  py-4">
                    <div class="row justify-content-end">
                        <div class="col-md-2 text-end p-0">
                            
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>teacher</th>
                                <th>lrn</th>
                                <th>fullname</th>
                                <th>Date Counseled</th>
                            </tr>
                        </thead>
                        <tbody id="task-table">
                            <?php if(isset($all_records) && !empty($all_records) && is_array($all_records)): ?>
                                <?php foreach($all_records as $data): ?>
                                    <tr>
                                        <td class="align-middle"><?=$data['id']?></td>
                                        <td class="align-middle"><?=$data['teacher_id']?></td>
                                        <td class="align-middle"><?=$data['lrn']?></td>
                                        <td class="align-middle"><?=$data['fullname']?></td>
                                        <td class="align-middle"><?=date('F j, Y - h:i a', strtotime($data['date_counseled']))?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center align-middle py-2">
                                        No Assign Tasks
                                    </td>
                                </tr>
                            <?php endif ?>
                            
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer bg-white text-center">
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>