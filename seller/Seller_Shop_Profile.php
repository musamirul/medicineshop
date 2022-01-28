<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-pencil-square"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Shop Profile</span> <br/>
                    <span style="font-size: 14px; color: grey;">View your shop status and update your shop profile</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="row mb-3">
                <span style="font-weight: bold; font-size: 14px;">Basic Information</span>
            </div>
            <div class="row position-relative">
                <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="tempProfile.png" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                <input type="image" data-bs-toggle="modal" data-bs-target="#editCover" src="temp.jpg" class="img-fluid" style="height: 200px;">
            </div>
        </div>
        <div class="row p-5">
            <div class="col">
                <div class="row mb-3">
                    <label class="form-label">Shop Name</label>
                    <input type="text" class="form-control" id="inputProduct" placeholder="Enter Product Name" name="name"/>
                </div>

                <div class="row">
                    <label class="form-label">Shop Description</label>
                    <textarea id="summernote_spec" class="form-control" rows="5" cols="50" name="description" placeholder="Enter Product Specification"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit <strong>Profile Image</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form method="post">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
              <label>Image Location :</label>
                  <input class="form-control" placeholder="Enter Name" name="nameEdit" value="" required autofocus="autofocus" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" value="" name="idEdit" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editProduct" class="btn btn-primary">Edit</button>
          </form>
          </div>   
      </div>
    </div>
  </div>

<!-- Edit Cover Modal -->
<div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit <strong>Cover Image</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form method="post">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
              <label>Image Location :</label>
                  <input class="form-control" placeholder="Enter Name" name="nameEdit" value="" required autofocus="autofocus" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" value="" name="idEdit" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editProduct" class="btn btn-primary">Edit</button>
          </form>
          </div>   
      </div>
    </div>
  </div>

<?php include("Interface/footer.php"); ?>