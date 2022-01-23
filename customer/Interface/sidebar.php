<div class="list-group list-group-flush mx-3 mt-4">
                <!-- Collapse 1 -->
                <a class="list-group-item list-group-item-action py-2" aria-current="true" data-bs-toggle="collapse" href="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
                  <i class="bi bi-person fa-fw me-3"></i><span>My Account</span>
                </a>
                <!-- Collapsed content -->
                <ul id="collapseAccount" class="collapse list-group list-group-flush">
                  <li class="list-group-item py-1 <?php if($current_file_name== "profile.php") echo "active"?>">
                    <a href="profile.php" class="text-reset text-decoration-none">Profile</a>
                  </li>
                  <li class="list-group-item py-1">
                    <a href="" class="text-reset text-decoration-none">Banks</a>
                  </li>
                  <li class="list-group-item py-1 <?php if($current_file_name== "address.php") echo "active"?>">
                    <a href="address.php" class="text-reset text-decoration-none">Addresses</a>
                  </li>
                  <li class="list-group-item py-1 <?php if($current_file_name== "cust_change-password.php") echo "active"?>">
                    <a href="cust_change-password.php" class="text-reset text-decoration-none">Change Password</a>
                  </li>
                </ul>
                <a class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "cust_purchase.php") echo "active"?>"  href="cust_purchase.php">
                    <i class="bi bi-journal-check fa-fw me-3"></i><span>My Purchase</span>
                </a>
                <a class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "medical_history.php") echo "active"?>"  href="medical_history.php">
                    <i class="bi bi-file-earmark-medical fa-fw me-3"></i><span>Medical History</span>
                </a>
                <a class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "cust_record-upload.php") echo "active"?>"  href="cust_record-upload.php">
                    <i class="bi bi-folder fa-fw me-3"></i><span>Record Upload</span>
                </a>
                <a class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "cust_declaration-upload.php") echo "active"?>"  href="cust_declaration-upload.php">
                    <i class="bi bi-folder fa-fw me-3"></i><span>Declaration Upload</span>
                </a>
                <a class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "cust_tracking.php") echo "active"?>"  href="cust_tracking.php">
                    <i class="bi bi-mailbox fa-fw me-3"></i><span>Parcel Tracking</span>
                </a>
            </div>