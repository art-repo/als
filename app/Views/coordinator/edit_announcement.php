<div class="container">
    <div class="row justify-content-center g-3">
        <div class="col-xl-7 col-md-12 col-12 mb-3">
            <div class="card p-4 rounded">
                <form id="createAnnouncement">
                    <input type="hidden" name="user_id" value="<?=$coordinator_id;?>">
                    <div class="mb-3">
                        <h4 class="text-success fw-bold">Edit Announcement</h4>
                        <div class="d-flex justify-content-start mb-3">
                            <select name="audience" id="audience"  style="width:110px" class="form-select btn-sm bg-light-success border-0 bg-light fw-bold">
                                <option value="both">Audience</option>
                                <option value="all">All</option>
                                <option value="teacher">Teacher</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div id="editor"></div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="col-md-7">
            <div class="card p-4">
                <div class="mb-3">
                    <label for="" class="form-label">Change Audience</label>
                    <select name="audience" id="audience" class="form-select">
                        <option value="">Audience </option>
                        <option value="">Teacher</option>
                        <option value="">Staff</option>
                    </select>
                </div>
                <div class="mb-3 text-end">
                    <button class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </div> -->
        <div class="col-xl-7">
            <div class="card p-4 rounded">
                <form action="<?=base_url('coordinator/edit_announcement_image') . "/" . $id ?>" method="post" enctype="multipart/form-data">
                    <h4 class="fw-bold text-success">Change Image:</h4>
                    <div class="p-5 rounded  text-center mb-3" style="border: 3px dashed lightgray;" id="openFile">
                        <span class="material-icons text-secondary" style="font-size:70px;">
                            file_upload
                        </span><br>
                        <span class="fw-bold">Upload file</span>
                        <input type="file" accept="" name="image" id="image" style="visibility: hidden;display:none;">
                        <p id="file_name"></p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        e.preventDefault();
        const postData = new FormData();
        const title = document.querySelector('#title');
        const qlEditor = document.querySelector('.ql-editor');
        const audience = document.querySelector('#audience');
        
        postData.append('content', qlEditor.innerHTML);
        postData.append('audience', audience.value);
        fetch('<?=base_url('coordinator/edit_announcement_content') . "/" . $id ?>', {
            method : 'post',
            body: postData
        })
        .then(response => response.json())
        .then((data) => {
            if(data.class == 'alert-success'){
                swal({
                    title: "Updated!",
                    text: data.message,
                    icon: "success",
                    button: "Close",
                }).then(function() {
                    window.location = "<?=base_url('coordinator/announcement')?>";
                });
            }else{
                swal({
                    title: "Error!",
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