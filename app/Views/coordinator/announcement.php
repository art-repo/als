<div class="container">
    <div class="row justify-content-center g-3">
        <div class="col-xl-7 col-md-12 col-12 mb-6">
            <div class="card  p-5 rounded">
                
                <form id="createAnnouncement" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?=$coordinator_id;?>">
                    <div class="mb-3">
                        <h3 class="text-blue-3 fw-bold">Create Announcement</h3>
                        <div class="d-flex justify-content-start mb-3">
                            <select id="audience"  style="width:110px" class="form-select btn-sm bg-light-success border-0 bg-light fw-bold">
                                <option value="both">Audience</option>
                                <option value="all">All</option>
                                <option value="teacher">Teacher</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div id="editor" class="mb-3"></div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex flex-row justify-content-start">
                            <div class="border-1 rounded">
                                <a type="button" class="btn btn-light" id="openFile">
                                    <i data-feather="image"></i>
                                    <span class="align-middle fw-bold">Add Photo</span>
                                </a>
                                <label class="text-secondary" id="filename"></label>
                                <input type="file" name="image" id="image" style="visibility: hidden;display:none;">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        
                        <button type="submit" class="btn btn-success">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php foreach ($annnouncement as $post): ?>
            <div class="col-xl-7 col-md-12 col-12 mb-3  h-70">
                <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2 align-items-center">
                            <!-- avatar -->
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" alt="" class="avatar avatar-md rounded-circle">
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Barangay <?=$brgy_profile['barangay']?></h5>
                                    <!-- <p class="mb-0">< ?=date ("h:i A", strtotime($post['date_created']))?></p> -->
                                    <small class="mb-0">
                                        <span class="material-icons align-middle">people</span>
                                        <b><?php
                                            $post['audience'] == 'both' ? 'Both' : 'Audience' ;
                                            switch ($post['audience']) {
                                                case 'all':
                                                    echo 'All';
                                                    break;
                                                case 'both':
                                                    echo 'Both';
                                                    break;
                                                case 'teacher':
                                                    echo 'Teacher';
                                                    break;
                                                case 'staff':
                                                    echo 'Staff';
                                                    break;
                                                
                                                default:
                                                    echo 'Both';
                                                    break;
                                            }
                                        ?></b>&nbsp;
                                        <?=date ("M d, Y h:i A", strtotime($post['date_created']))?>
                                    </small>
                                </div>
                            </div>
                            <div>
                                <!-- dropdown -->
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted text-primary-hover" id="dropdownprojectFive" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical" class="icon-xxs"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownprojectFive">
                                        <a class="dropdown-item" href="<?=base_url('coordinator/edit_announcement') . "/" . $post['id']?>">Edit</a>
                                        <a class="dropdown-item" href="!#">Delete</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <!-- text -->
                            <?=$post['content']?>
                            <?php if(empty($post['image']) || !file_exists(FCPATH . "public/uploads/assets/profiles/" . $post['image'])):?>
                                <img src="<?=base_url('public/uploads/assets/profiles') . "/" . $post['image']?>" class="img-fluid w-100" alt="" srcset="">
                            <?php else: ?>

                            <?php endif ?>
                        </div>
                        <!-- icons -->
                    
                        <div class="border-bottom border-top py-2 d-flex align-items-center">
                            <!-- avatar group -->
                            
                            <div class="avatar-group">
                                <span class="avatar avatar-sm">
                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle">
                                </span>
                                <span class="avatar avatar-sm">
                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle">
                                </span>
                                <span class="avatar avatar-sm">
                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle">
                                </span>
                                <span class="avatar avatar-sm avatar-primary">
                                    <span class="avatar-initials rounded-circle fs-6">+5</span>
                                </span>
                                 Post Reached 10 people.
                            </div>
                            
                        </div>
                        <!-- row -->
                        <!-- <div class="row">
                            <div class="col-xl-1 col-lg-2 col-md-2 col-12 mb-3 mb-lg-0">
                                
                                <img src="< ?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-md rounded-circle" alt="">
                            </div>
                            
                            <div class="col-xl-11 col-lg-10 col-md-9 col-12 ">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-2 col-xxl-1">
                                        <label for="name" class="col-form-label ">Name</label>
                                    </div>
                                    <div class="col-md-8 col-xxl-9  mt-0 mt-md-3">
                                        <input type="password" id="name" class="form-control" aria-describedby="name">
                                    </div>
                                    <div class="col-md-2 col-xxl-2">
                                        <button type="submit" class="btn btn-primary">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>    
        <?php endforeach ?>
    </div>
    
</div>
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

<script>
    
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        // ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    // text direction

        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'align': [] }],

        
    ];

    var quill = new Quill('#editor', {
    modules: {
        toolbar: toolbarOptions
    },
    theme: 'snow'
    });

    document.querySelector('#openFile').addEventListener('click', () => {
        document.querySelector('#image').click();
        
    })
    document.querySelector('#openFile').addEventListener('change', ()=>{
        document.querySelector('#filename').textContent = document.querySelector('#image').value;
    })

    document.querySelector('#createAnnouncement').addEventListener('submit', (e)=> {
        
        
        const postData = new FormData();

        const title = document.querySelector('#title');
        const image = document.querySelector('#image');
        const audience = document.querySelector('#audience');

        const qlEditor = document.querySelector('.ql-editor');
        
        postData.append('image', image.files[0]);
        postData.append('content', qlEditor.innerHTML);
        postData.append('audience', audience.value);
        

        fetch('<?=base_url('coordinator/create_announcement')?>', {
            method : 'post',
            body: postData
        })
        .then(response => response.json())
        .then((data) => {
            if(data.class == 'alert-success'){
                swal({
                    title: "Inserted!",
                    text: data.message,
                    icon: "success",
                    button: "Close",
                }).then(function() {
                    window.location = "<?=base_url('coordinator/announcement')?>";
                });
            }else{
                swal({
                    title: "Failed!",
                    text: data.message,
                    icon: "error",
                    button: "Close",
                }).then(function() {
                    window.location = "<?=base_url('coordinator/announcement')?>";
                });
            }
        })
    })
    
</script>