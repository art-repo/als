<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="light rounded p-3 shadow-sm">
                <span class="fs-5 fw-bold">Generate OSCYA Report</span><br>
                <label for="" class="form-text fs-6">Total Record: <?=$oscya['total']?></label><br>
                <label for="" class="form-text fw-bold">Filter By:</label>
                <form action="#" method="post">
                    <div class="mb-3 p-3 rounded border">
                        <label for="" class="form-text fw-bold">Generate Record:</label><br>
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
                        <div class="my-2">
                            <button type="submit" class="btn btn-outline-green-2 rounded-pill"><i class="bi bi-file-arrow-down"></i> Download</button>
                        </div>
                    </div>
                    <div class="mb-3 p-3 rounded border">
                        <label for="teachers" class="form-text fw-bold">By Gender: </label>
                        <select name="teachers" id="teachers" class="form-select">
                            <option selected>Select</option>
                            <option value="">Male</option>
                            <option value="">Female</option>
                        </select>
                        <div class="my-2">
                            <button type="submit" class="btn btn-outline-green-2 rounded-pill"><i class="bi bi-file-arrow-down"></i> Download</button>
                        </div>
                    </div>
                    <div class="mb-3 p-3 rounded border">
                        <label for="brgy" class="form-text fw-bold">By Age:</label>
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
                        <div class="my-2">
                            <button type="submit" class="btn btn-outline-green-2 rounded-pill"><i class="bi bi-file-arrow-down"></i> Download</button>
                        </div>
                    </div>
                    <div class="mb-3 p-3 rounded border">
                        <label for="brgy" class="form-text fw-bold">By Educational Attainment:</label>
                        <select name="teachers" id="teachers" class="form-select">
                            <option selected>Select</option>
                            <option value="">Kinder</option>
                            <option value="">Grade 1</option>
                            <option value="">Grade 2</option>
                            <option value="">Grade 3</option>
                            <option value="">Grade 4</option>
                            <option value="">Grade 5</option>
                            <option value="">Grade 6</option>
                            <option value="">Grade 7</option>
                            <option value="">Grade 8</option>
                            <option value="">Grade 9</option>
                            <option value="">Grade 10</option>
                        </select>
                        <div class="my-2">
                            <button type="submit" class="btn btn-outline-green-2 rounded-pill"><i class="bi bi-file-arrow-down"></i> Download</button>
                        </div>
                    </div>
                    <div class="mb-3 p-3 rounded border">
                        <label for="brgy" class="form-text fw-bold">By Disability:</label>
                        <select name="teachers" id="teachers" class="form-select">
                            <option selected>Select</option>
                            <option value="">Intellectual Disability</option>
                            <option value="">Learning Disability</option>
                            <option value="">Autism</option>
                            <option value="">Blind</option>
                            <option value="">Deaf</option>
                            <option value="">Hard of Hearin</option>
                            <option value="">Orthopedically Impaired</option>
                            <option value="">Others</option>
                        </select>
                        <div class="my-2">
                            <button type="submit" class="btn btn-outline-green-2 rounded-pill"><i class="bi bi-file-arrow-down"></i> Download</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>