<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="px-4 pb-4 shadow-sm light rounded" style="box-sizing: border-box;height:400px;overflow-y:auto;">
            <a href="<?=base_url('alscoordinator/add_teacher')?>" class="btn btn-success mt-3">
                <i class="bi bi-plus-lg"></i>
            </a>
                <table class="table table-responsive table-hover ">
                    <thead>
                        <style>
                            th{
                                position: sticky;
                            }
                        </style>
                        <tr>
                            <th class="py-3 align-middle border-bottom" style="background-color: #ffffff;"></th>
                            <th class="py-3 align-middle border-bottom" style="background-color: #ffffff;">User ID</th>
                            <th class="py-3 align-middle border-bottom" style="background-color: #ffffff;">Created By</th>
                            <th class="py-3 align-middle border-bottom" style="background-color: #ffffff;">Status</th>
                        </tr>
                        <tbody>
                            <!-- < ?php if( !empty($staffs) || is_array($staffs)):?>
                                < ?php foreach ($staffs as $staff): ?> -->
                                    <tr class="align-middle">
                                        <td></td>
                                        <td class="form-text"></td>
                                        <td class="form-text"></td>
                                        <td class="form-text"></td>
                                    </tr>
                                <!-- < ?php endforeach ?>
                            < ?php endif ?> -->
                        </tbody>
                    </thead>
                </table>
            </div>
    </div>
</div>