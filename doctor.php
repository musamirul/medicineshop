<?php include("Interface/header.php"); ?>
<div class="container">
    <div class="col">
        <div class="row">
            <div class="d-flex flex-column bd-highlight mb-3">
                <div style="font-size: 30px; font-weight: bold;" class="p-2 bd-highlight"><center>Our Doctor</center></div>
                <div class="p-2 bd-highlight">
                    <center>We have a reputable team of medical consultants who are not only well-qualifed, but also experienced in their respective fields.
                     They are supported by a team of dedicated medical professionals from various specialized disciplines. They have been carefully selected for their 
                     professional expertise and commitment to deliver personalized services.</center>
                </div>
                <div class="p-2 bd-highlight"><center>
                    <form method="post" action="doctor-list.php">
                        <div style="width: 500px;" class="input-group mb-3">
                            <input class="form-control" type="text" name="doctorSearch" placeholder="Specialty">
                            <button class="btn btn-primary" name="searchButton" type="submit">Search</button>
                        </div>
                    </form></center>
                </div>
            </div>
        </div>
        <?php
            $query_doctor = mysqli_query($con, "SELECT * FROM consultant_profile");
            while($result_doctor = mysqli_fetch_array($query_doctor)){

                $Cons_Admin_ID = $result_doctor['FK_Consult_Profile_Admin_ID'];
                $query_admin = mysqli_query($con,"SELECT * FROM administrator WHERE Admin_ID = '$Cons_Admin_ID'");
                $result_admin = mysqli_fetch_array($query_admin);
        ?>
        <div style="background-color: rgb(247, 251, 255);" class="row p-3 ms-5 me-5 mb-3 shadow">
            <div class="col-2">
                    <img style="height: 165px; width: 150px;" src="admin/img/<?php echo $result_doctor['Consult_Profile_Img']; ?>" class="img-fluid rounded">
            </div>
            <div class="col-6">
                <div class="d-flex flex-column bd-highlight mb-3">
                    <div style="font-size: 20px; font-weight: 700;" class=" pt-2 bd-highlight"><?php echo $result_admin['Admin_Name'] ?></div>
                    <div style="font-size: 14px;" class=" pt-2 bd-highlight"><i class="bi bi-check-circle pe-3"></i><?php echo $result_doctor['Consult_Profile_Speciality']; ?></div>
                    <div style="font-size: 14px; color: rgb(0, 119, 255);" class="bd-highlight"><?php echo $result_admin['Admin_Email']; ?></div>
                    <div style="font-size: 14px; color: rgb(0, 119, 255);" class="bd-highlight"><?php echo $result_doctor['Consult_Profile_Phone']; ?></div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-column bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="bd-highlight"><i class="bi bi-award-fill pe-3"></i></div>
                            <div class="bd-highlight"><?php echo $result_doctor['Consult_Profile_Education']; ?></div>
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-chat-square-text pe-3"></i><?php echo $result_doctor['Consult_Profile_Language']; ?>
                    </div>
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-hourglass-split pe-3"></i>
                        <?php
                            $experience = $result_doctor['Consult_Profile_Experience'];
                            $todayDate = date("Y-m-d");
                            $diff = abs(strtotime($todayDate) - strtotime($experience));
                            
                            echo $year = floor($diff/(365*60*60*24));
                        ?>
                        Years Experience
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include("Interface/footer.php"); ?>