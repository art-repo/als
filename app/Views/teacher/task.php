</div>

<!-- row  -->
<div class="container-fluid">
    <div class="row mt-6">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row justify-content-end">
                        <div class="col-md-3 text-end">
                            <input type="search" name="search_bar" id="search_bar" class="form-control" onkeyup="myFunction()">
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Barangay</th>
                                <th>Schedule</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="task-table">
                            <?php if(isset($tasks) && !empty($tasks) && is_array($tasks)): ?>
                                <?php foreach($tasks as $task): ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <?php if(empty($task['image']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $task['image']))):?>
                                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar avatar-md rounded-circle" />
                                                <?php else: ?>
                                                    <img alt="avatar" src="<?=base_url('public/uploads/assets/profiles') . '/' . $task['image']?>" class="avatar avatar-md rounded-circle" />
                                                <?php endif ?>
                                                <div class="ms-3 lh-1">
                                                    <h5 class=" mb-1"> <a href="<?=base_url('teacher/staff_records') . '/' . $task['staff_id']?>" class="text-inherit"><?=$task['staff_id']?></a></h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle"><?=$task['name']?></td>
                                        <td class="align-middle"><?=$task['barangay']?></td>
                                        <td class="align-middle"><?=$task['sched_date']?></td>
                                        <td class="align-middle">
                                            <div class="dropdown dropstart">
                                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTask" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-xxs" data-feather="more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownTask">
                                                    <a class="dropdown-item" href="<?=base_url('teacher/staff_records') . '/' . $task['staff_id']?>">
                                                        <i class="icon-sm" data-feather="eye"></i>
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
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
                
            </div>
        </div>
    </div>
</div>

<!-- <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-dark">All Tasks</h4>
        </div>
        <div class="col-md-12">
            
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="fw-bold">Barangay Bagbag</span>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td class="bg-light-warning border border-1 border-warning text-center">No Available Tasks</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <span class="fw-bold">Capri</span>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            <span class="fw-bold">Fairview</span>  
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the third item's
                            accordion body. Nothing more exciting happening here
                            in terms of content, but just filling up the space to make it look, at least at
                            first glance, a bit more representative of how this would look in a real-world
                            application.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            <span class="fw-bold">Greater Lagro</span>  
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the third item's
                            accordion body. Nothing more exciting happening here
                            in terms of content, but just filling up the space to make it look, at least at
                            first glance, a bit more representative of how this would look in a real-world
                            application.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                            <span class="fw-bold">Gulod</span>  
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                           
                            <div class="card" style="width: 20rem;">
                                <img src="< ?=base_url('public/sources/assets/images/placeholder')?>/placeholder-4by3.svg" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                            <span class="fw-bold">Kaligayahan</span>
                        </button>
                    </h2>
                    <div id="flush-collapseSix" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                            <span class="fw-bold">Nagkaisang Nayon</span>
                        </button>
                    </h2>
                    <div id="flush-collapseSeven" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                            <span class="fw-bold">North Fairview</span>
                        </button>
                    </h2>
                    <div id="flush-collapseEight" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                            <span class="fw-bold">Novaliches</span>
                        </button>
                    </h2>
                    <div id="flush-collapseNine" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                            <span class="fw-bold">Pasong putik</span>
                        </button>
                    </h2>
                    <div id="flush-collapseTen" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingEleven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                            <span class="fw-bold">San Agustin</span>
                        </button>
                    </h2>
                    <div id="flush-collapseEleven" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingEleven" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwelve">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwelve" aria-expanded="false" aria-controls="flush-collapseTwelve">
                            <span class="fw-bold">San Bartolome</span>
                        </button>
                    </h2>
                    <div id="flush-collapseTwelve" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingTwelve" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThirteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThirteen" aria-expanded="false" aria-controls="flush-collapseThirteen">
                            <span class="fw-bold">Sta. Lucia</span>
                        </button>
                    </h2>
                    <div id="flush-collapseThirteen" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThirteen" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFourteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFourteen" aria-expanded="false" aria-controls="flush-collapseFourteen">
                            <span class="fw-bold">Sta. Monica</span>
                        </button>
                    </h2>
                    <div id="flush-collapseFourteen" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingFourteen" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended
                            to demonstrate the <code>.accordion-flush</code> class. This is the second item's
                            accordion body. Let's imagine this being filled with
                            some actual content.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = search_bar;
        filter = input.value.toUpperCase();
        table = oscya_table;
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