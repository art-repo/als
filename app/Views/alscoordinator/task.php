<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="light rounded p-3 shadow-sm">
                <span class="fs-5 fw-bold">Assign Record</span><br>
                <label for="" class="fs-6 fw-bold">Total Record: <span class="text-danger"><?=$oscya['total']?></span></label>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="teachers" class="form-text">Teachers: </label>
                        <select name="teachers" id="teachers" class="form-select">
                            <option selected>Select Teacher</option>
                            <option value="">[Name]</option>
                            <option value="">[Name]</option>
                            <option value="">[Name]</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brgy" class="form-text">Barangay:</label>
                        <input type="text" name="brgy" id="brgy" class="form-control" value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="batch" class="form-text">Batch: </label>
                        <select name="batch" id="batch" class="form-select">
                            <option selected>Select Batch</option>
                            <option value="">[Batch 1]</option>
                            <option value="">[Batch 2]</option>
                            <option value="">[Batch 3]</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="fs-6 fw-bold">Record to assess:</label><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="from" class="form-text">From:</label>
                                <input type="text" name="from" id="from" placeholder="" class="form-control">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="to" class="form-text">To:</label>
                                <input type="text" name="to" id="to" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="fs-6 fw-bold">Set Screening Schedule:</span>
                    </div>
                    <div class="mb-3">
                        <label for="facility" class="form-text">Facility: </label>
                        <select name="facility" id="facility" class="form-select">
                            <option selected>Select Facility</option>
                            <option value="">[Facility 1]</option>
                            <option value="">[Facility 2]</option>
                            <option value="">[Facility 3]</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-text">Screening date:</label>
                        <input type="date" name="a_date" id="a_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-text">Screening time:</label>
                        <input type="time" name="a_time" id="a_time" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-green-2 text-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
