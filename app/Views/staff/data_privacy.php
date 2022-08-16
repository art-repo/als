<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Data Privacy Act of 2012</h3>
            <p>Data Privacy Consent The RA 10173 also known as Data Privacy Act 0f 2012, under section 11. By agreeing to this form, the participant consents to the collection and retention of personal information for academic purposes only.</p>
            <form action="<?=base_url('staff/data_privacy')?>" method="post">
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="agree" id="agree" value="1">
                        <label class="form-check-label" for="agree">
                            Agree to collect your data
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" id="submit_btn" class="btn btn-success" disabled>Next</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let agree = document.getElementById('agree');
    let submit_btn = document.getElementById('submit_btn');
    agree.addEventListener('change', ()=>{
        if(agree.checked == true){
            submit_btn.disabled = false;
        }else{
            submit_btn.disabled = true;
        }
    })
</script>
