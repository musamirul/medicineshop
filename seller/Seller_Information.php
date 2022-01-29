<?php include("Interface/header.php"); ?>

<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-info-square"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">My Information</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update your information</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Company Name </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value=""/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Registration Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="regNo" placeholder="Please Enter your fullname" value=""/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Contact Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" placeholder="Please Enter your contact No" value=""/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Company Address</label>
                <div class="col-sm-10">
                    <textarea id="summernote_spec" class="form-control" rows="5" cols="50" name="description" placeholder="Enter Product Specification"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Bank Account</label>
                <div class="col-sm-10">
                    <select class="form-select" name="bankName" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Bank Account Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="bankNo" placeholder="Please Enter your account no" value=""/>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("Interface/footer.php"); ?>