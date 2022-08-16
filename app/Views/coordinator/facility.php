
    

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Facilities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('coordinator/save_facility')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body px-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">name:</label>
                        <input type="text" name="facility_name" id="facility_name" class="form-control" placeholder="Facility name">
                    </div>
                    <div class="mb-3">
                        <label for="facility_location" class="form-label">Location</label>
                        <input type="text" name="facility_location" id="facility_location" class="form-control" placeholder="Facility Location">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="3" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="facility_type" class="form-label">Type</label>
                        <select name="facility_type" id="facility_type" class="form-select">
                            <option selected>Select Type</option>
                            <option value="Covered Court">Covered Court</option>
                            <option value="Multi-purpose Hall">Multi-purpose Hall</option>
                            <option value="Learning Center">Learning Center</option>
                        </select>
                    </div>
                    <div class="mb-3 p-6 align-middle text-center border rounded">
                        <input type="file" name="facility_image" id="facility_image" accept="image/*" style="visibility: hidden;display:none;">
                        <button type="button" class="btn btn-outline-primary" id="openFile">
                            <i class="me-1 icon-sm" data-feather="image"></i>
                            Add Photo
                        </button>
                    </div>
                    <script>
                        const facility_image = document.querySelector('#facility_image');
                        const openFile = document.querySelector('#openFile');

                        openFile.addEventListener('click', ()=>{
                            facility_image.click();
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-outline-primary">View all facilities</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h3>Facilities</h3>
    <div class="row g-3">
        <?php if(isset($facilities) && !empty($facilities) && is_array($facilities)):?>
            <?php foreach($facilities as $facility):?>
                <div class="col-md-3">
                    <div class="card h-100">
                        <input type="hidden" id="<?=$facility['facility_id']?>">
                        <?php if(empty($facility['image']) || !file_exists( FCPATH . 'uploads/assets/profiles/' . $facility['image'])):?>
                            <img src="<?=base_url('public/uploads/assets/profiles/placeholder.svg')?>" class="card-img-top" alt="...">
                        <?php else: ?>
                            <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $facility['image']?>" class="card-img-top" alt="...">
                        <?php endif ?>
                        
                        <div class="card-body ">
                            <h5 class="card-title"></h5>
                            <div class="d-flex justify-content-between mb-5 align-items-center">
                                <!-- avatar -->
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <h5 class="mb-0 fw-bold"><?=$facility['name'];?></h5>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- <p class="card-text">< ?=$facility['description']?></p> -->
                            <a href="<?=base_url('coordinator/schedules') . '/' . $facility['facility_id']?>" class="btn btn-outline-primary">See Schedules</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else :?>
            <div class="col-md-3">
                <div class="card align-middle text-center p-10 bg-light-danger">
                    <span class="fs-1">
                        <a href="#" class="link-danger">
                            <i class="icon-lg" data-feather="slash"></i>
                        </a>
                    </span>
                    No facilities
                </div>
            </div>
        <?php endif ?>
        <div class="col-md-3">
            <div class="card align-middle text-center p-10 bg-light-primary">
                <span class="fs-1">
                    <a class="link-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                        <i class="icon-lg" data-feather="plus"></i>
                    </a>
                </span>
                Add facility
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

<script>

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
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '2022-02-07',
        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
        {
            title: 'All Day Event',
            url: '<?=base_url('coordinator/facility')?>',
            
            
        },
        {
            title: 'Long Event',
            start: '2022-02-07',
            end: '2022-02-10'
        },
        {
            groupId: '999',
            title: 'Repeating Event',
            start: '2022-02-09T16:00:00'
        },
        {
            groupId: '999',
            title: 'Repeating Event',
            start: '2022-02-16T16:00:00'
        },
        {
            title: 'Conference',
            start: '2022-02-11',
            end: '2022-02-13'
        },
        {
            title: 'Meeting',
            start: '2022-02-12T10:30:00',
            end: '2022-02-12T12:30:00'
        },
        {
            title: 'Lunch',
            start: '2022-02-12T12:00:00'
        },
        {
            title: 'Meeting',
            start: '2022-02-12T14:30:00'
        },
        {
            title: 'Birthday Party',
            start: '2022-02-13T07:00:00'
        },
        {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2022-02-28'
        }
        ]
    });

    calendar.render();
    });
</script>