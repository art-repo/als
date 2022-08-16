</div>

<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-12 text-end">
            <a href="#" class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted"  data-bs-toggle="modal" data-bs-target="#edit_facility"  data-bs-placement="bottom" title="Edit Facility">
                <span class="material-icons-outlined align-middle">settings</span>
            </a>
            
                <div class="modal fade text-start" id="edit_facility" tabindex="-1" role="dialog" aria-labelledby="facilityname" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?=$facility_info['name']?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <!-- <span aria-hidden="true">&times;</span> -->
                                </button>
                            </div>
                            <form action="<?=base_url('coordinator/edit_facility')?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body px-8">
                                    <?=csrf_field()?>
                                    <input type="hidden" name="facility_id" value="<?=$facility['id']?>">
                                    <div class="mb-3">
                                        <label for="facility_name" class="form-label">Facility Name: </label>
                                        <input type="text" class="form-control" name="name" value="<?=$facility_info['name']?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select name="type" id="type" class="form-select">
                                            <option selected>Select Type</option>
                                            <option value="Covered Court">Covered Court</option>
                                            <option value="Multi-purpose Hall">Multi-purpose Hall</option>
                                            <option value="Learning Center">Learning Center</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="facility_description" class="form-label">Description: </label>
                                        <textarea type="text" class="form-control" name="description" value="<?=$facility_info['description']?>"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="facility_address" class="form-label">Address: </label>
                                        <input type="text" class="form-control" name="address" value="<?=$facility_info['address']?>">
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-center">
                                            <div class="rounded">
                                                <input type="file" name="picture" id="picture" style="visibility: hidden;display:none;">
                                                <span class="material-icons-outlined" style="font-size: 70px;">image</span><br>
                                                <span class="edit_pic_label">Change Picture</span><br>
                                                <button id="openFileManager" class="btn btn-outline-primary btn-sm" type="button">
                                                    <span class="material-icons-outlined align-middle">file_upload</span>
                                                    Upload
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                            <script>
                                const picture = document.querySelector('#picture');
                                const openFileManager = document.querySelector('#openFileManager');

                                openFileManager.addEventListener('click', ()=>{
                                    picture.click();
                                });
                            </script>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="border-bottom bg-white rounded-top p-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Schedules</p>
                    <!-- <a href="#" class="btn btn-icon rounded-circle indicator indicator-primary text-muted">
                        <span>
                            <i class="icon-xs" data-feather="settings"></i>
                        </span>
                    </a> -->
                </div>
                <div class="card-body bg-white" style="overflow-x: scroll;">
                    <div id="calendar"></div>
                </div>
                <div class="card-footer bg-white">
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                
                <div class="border-bottom bg-white rounded-top px-3 py-2 d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Schedules</p>
                    <a href="#" class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted"  data-bs-toggle="modal" data-bs-target="#exampleModalCenter"  data-bs-placement="bottom" title="Add Schedules">
                        <span>
                            <i class="icon-xs" data-feather="plus"></i>
                        </span>
                    </a>
                    
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Activity</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?=base_url('coordinator/save_activity');?>" method="post">
                                <?=csrf_field()?>
                                <div class="modal-body">
                                    <input type="hidden" name="facility_id" value="<?=$facility['id']?>">
                                    <div class="mb-3">
                                        <label for="title" class="title">Title:</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Activity Title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="title">Description:</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sched_date" class="title">Date:</label>
                                        <input type="date" class="form-control" id="sched_date" name="sched_date" placeholder="Activity Title">
                                    </div>
                                    <div class="row mb-6">
                                        <div class="col-md-6">
                                            <label for="start" class="title">Start time:</label>
                                            <input type="time" class="form-control" id="start" name="start">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end" class="title">End time:</label>
                                            <input type="time" class="form-control" id="end" name="end">
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <div class="col-md-8">
                                            <label for="end" class="title">Video link:</label>
                                            <input type="link" class="form-control" id="link" name="link" placeholder="https://">
                                        </div>
                                        <div class="col-md-4 pt-5">
                                            <a href="<?=base_url()?>" target="_blank" class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video SDK">
                                                <span class="material-icons">videocam</span>
                                            </a>
                                            <a href="https://meet.google.com/" target="_blank" class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Google meet">
                                                <span class="material-icons">video_call</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- List group -->
                <ul class="list-group list-group-flush notification-list-scroll">
                    <?php if(isset($activities) && !empty($activities) && is_array($activities)):?>
                        <?php foreach($activities as $activity) : ?>
                            <li class="list-group-item">
                            <a href="#" class="text-muted" data-bs-toggle="modal" data-bs-target="#<?=$activity['activity_id']?>">
                                <h5 class=" mb-1"><?=$activity['title']?></h5>
                                <small class="text-muted" style="font-size: 12px;">Date created: <?=$activity['date_created']?></small>
                                <p class="mb-0"><?=$activity['description']?></p>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="<?=$activity['activity_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-white rounded-top p-3 d-flex justify-content-between align-items-center">
                                            <p class="mb-0 text-dark fw-medium fs-4"><i class="icon-sm me-2" data-feather="edit"></i> <?=$activity['title']?></p>
                                            <div class="dropdown dropstart">
                                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTeamThree" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-xs" data-feather="more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownTeamThree">
                                                    <form action="<?=base_url('coordinator/delete_schedules')?>" method="post">
                                                        <input type="hidden" name="facility_id" value="<?=$facility['id']?>">
                                                        <input type="hidden" name="activity_id" value="<?=$activity['activity_id']?>">
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="icon-xs me-2" data-feather="trash-2"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <form action="<?=base_url('coordinator/edit_schedules') . '/' . $activity['activity_id']?>" method="post">
                                            <?=csrf_field()?>
                                            <div class="modal-body">
                                                <input type="hidden" name="facility_id" value="<?=$facility['id']?>">
                                                <div class="mb-3">
                                                    <label for="title" class="title">Title:</label>
                                                    <input type="text" class="form-control" id="edit-title" name="title" placeholder="Activity Title" value="<?=$activity['title']?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="title">Description:</label>
                                                    <textarea class="form-control" id="edit-description" name="description"><?=$activity['description']?></textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="sched_date" class="title">Date:</label>
                                                    <input type="date" class="form-control" id="edit-sched-date" name="sched_date" value="<?=$activity['activity_date']?>">
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-md-6">
                                                        <label for="start" class="title">Start time:</label>
                                                        <input type="time" class="form-control" id="edit-start" name="start" value="<?=$activity['start_time']?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="end" class="title">End time:</label>
                                                        <input type="time" class="form-control" id="edit-end" name="end" value="<?=$activity['end_time']?>" >
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-md-8">
                                                        <label for="end" class="title">Video link:</label>
                                                        <input type="link" class="form-control" id="edit-link" name="link" placeholder="https://" value="<?=$activity['link']?>">
                                                    </div>
                                                    <div class="col-md-4 pt-5">
                                                        <a href="<?=base_url()?>" target="_blank" class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video SDK">
                                                            <span class="material-icons">videocam</span>
                                                        </a>
                                                        <a href="https://meet.google.com/" target="_blank" class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Google meet">
                                                            <span class="material-icons">video_call</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="saveSched" class="btn btn-outline-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li class="list-group-item pt-15">
                            <a href="#" class="text-muted text-center align-middle">
                                <h5 class=" mb-1">No Activity for this month</h5>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, sequi necessitatibus odio</p>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
                <!-- <div class="border-top px-3 py-2 text-center">
                    <a href="#" class="text-inherit fw-semi-bold">
                        View all Schedules
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    <?php if(session()->getFlashdata('success')) : ?>
        swal({
            title: "Inserted!",
            text: "<?= session()->getFlashdata('success')?>",
            icon: "success",
            button: "Close",
        });
    <?php endif; ?>
    <?php if(session()->getFlashdata('fail')) : ?>
        swal({
            title: "Failed!",
            text: "<?= session()->getFlashdata('fail')?>",
            icon: "error",
            button: "Close",
        });
    <?php endif ?>

    // const editForm = document.querySelector('#editForm');
    // if(editForm){
    //     const schedDetails = [
    //         document.querySelector('#edit-title'),
    //         document.querySelector('#description'),
    //         document.querySelector('#edit-sched-date'),
    //         document.querySelector('#edit-start'),
    //         document.querySelector('#edit-end'),
    //         document.querySelector('#edit-link')
    //     ];
    //     const enableEdit = document.querySelector('#enableEdit');
    //     const saveSched = document.querySelector('#saveSched');
    //     enableEdit.addEventListener('click', ()=>{
    //         saveAccountDetails.disabled = false;
    //         for (let i = 0; i < accountDetails.length; i++) {
    //             accountDetails[i].readOnly = false;
    //         }
    //         schedDetails[0].focus();
    //     });
    // }
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            // initialDate: '2022-03-07',
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                <?php foreach($activities as $activity): ?>
                    {
                        title: '<?=$activity['title'];?>',
                        <?php if(!empty($activity['link'])): ?>
                            url: '<?=$activity['link']?>',
                        <?php endif ?>
                        start: '<?=$activity['activity_date'];?>T<?=$activity['start_time']?>',
                        end: '<?=$activity['activity_date'];?>T<?=$activity['end_time']?>',
                    },
                <?php endforeach ?>
            ]
        });

        calendar.render();
    });
</script>