<div class="container-fluid pt-15 pb-5 bg-info">
    <div class="row g-3">
        <div class="col-md-12">
            <h1 CLASS="text-light text-center"> VIEW BARANGAY IN QUEZON CITY WITH ALS PROGRAM </h1>
        </div>
        <?php if(isset($barangays) && is_array($barangays)):?>
            <?php foreach($barangays as $barangay): ?>
                <div class="col-md-3">
                    <div class="card">
                        <?php if(empty($barangay['cover_photo']) || !file_exists( FCPATH . 'uploads\\assets\\profiles\\' . str_replace('/', '\\' , $barangay['cover_photo']))) : ?>   
                            <img src="" class="card-img-top" alt=" ">
                        <?php else: ?>
                            <img src="<?=base_url('public/uploads/assets/profiles') . '/' . $barangay['cover_photo']?>" class="card-img-top" alt=" ">
                        <?php endif ?>
                        <div class="card-body">
                            <h4 class="card-title"><?=$barangay['barangay']?></h4>
                            <p class="card-text"><?=$barangay['address']?></p>
                            <a href="#" class="btn btn-outline-primary">See more</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="col-md-3">
                <div class="card align-middle text-center">
                    <h4>Education4All</h4>
                    <p class="text-secondary">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil, quisquam.
                    </p>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

