<div class="container pt-4">
    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="light shadow-sm rounded p-4">
                <h3><i class="bi bi-person-circle"></i>&nbsp;Create New Barangay Coordinator</h3>
                <hr>
                
                <form action="<?=base_url('alscoordinator/save_brgy_coord')?>" method="post">
                    <div class="mb-3">
                        <label for="district" class="form-text"><i class="bi bi-building"></i> Barangay</label>
                        <select class="form-select" id="district" name= "district">
                            <option value="1">District 1</option>
                            <option value="2">District 2</option>
                            <option value="3">District 3</option>
                            <option value="4">District 4</option>
                            <option value="5" selected>District 5</option>
                            <option value="6">District 6</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="barangay" class="form-text"><i class="bi bi-building"></i> Barangay</label>
                        <select class="form-select" id="barangay" name= "barangay">
                            <option selected>--Select Barangay--</option>
                            <option value="Bagbag">Bagbag</option>
                            <option value="Capri">Capri</option>
                            <option value="Fairview">Fairview</option>
                            <option value="Greater Lagro">Greater Lagro</option>
                            <option value="Gulod">Gulod</option>
                            <option value="Kaligayahan">Kaligayahan</option>
                            <option value="Nagkaisang Nayon">Nagkaisang Nayon</option>
                            <option value="North Fairview">North Fairview</option>
                            <option value="Novaliches">Novaliches</option>
                            <option value="Pasong Putik">Pasong Putik</option>
                            <option value="San Agustin">San Agustin</option>
                            <option value="San Bartolome">San Bartolome</option>
                            <option value="Sta. Lucia">Sta. Lucia</option>
                            <option value="Sta. Monica">Sta. Monica</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-text"><i class="bi bi-card-text"></i> Lastname: </label>
                        <input type="text" name="lastname" id="lastname" class="form-control" rows="3" value="">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-text"><i class="bi bi-card-text"></i> Firstname: </label>
                        <input type="text" name="firstname" id="firstname" class="form-control" rows="3" value="">
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-text"><i class="bi bi-card-text"></i> Middlename: </label>
                        <input type="text" name="middlename" id="middlename" class="form-control" rows="3" value="">
                    </div>
                     <div class="mb-3">
                        <label for="extension" class="form-text"><i class="bi bi-card-text"></i> Extension:</label>
                        <select class="form-select" id="extension" name= "extension">
                            <option selected>Choose</option>
                            <option value="jr">jr</option>
                            <option value="snr">snr</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                        </select>
                     </div>
                    <div class="mb-3">
                        <label for="username" class="form-text"><i class="bi bi-card-text"></i> Username: </label>
                        <input type="text" name="username" id="username" class="form-control" rows="3" value="">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-text"><i class="bi bi-card-text"></i> Password:</label>
                        <input type="password" name="password" id="password" class="form-control" value="">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-green-2 text-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>