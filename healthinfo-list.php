<?php include("Interface/header.php"); ?>

<div class="container bg-white shadow bg-body rounded">
    
    <div class="col ps-5 pe-5">
        <div class="row pt-5">
            <div class="col-8"></div>
            <div class="col-4">
                <form method="post" action="healthinfo-list.php">
                    <div class="input-group mb-3">
                    <input class="form-control" type="text" name="articleSearch" placeholder="Search for an article">
                    <button class="btn btn-primary" name="searchButton" type="submit">Search Article</button>
                    </div>
                </form>
            </div>
        </div>
        <?php 
            if(isset($_POST['searchButton'])){
            
            $articleSearch = $_POST['articleSearch'];

            $query_healthinfo = mysqli_query($con,"SELECT * FROM healthinfo WHERE HealthInfo_Tags LIKE '%$articleSearch%' OR HealthInfo_Title LIKE '%$articleSearch%'");
            while($result_healthinfo = mysqli_fetch_array($query_healthinfo)){
                $str = $result_healthinfo['HealthInfo_Tags'];
                $arrStr = explode(" ",$str);
        ?>
        <div class="ps-5 pe-5 pt-2 pb-5">
            <div class="row"><span style="font-size: 45px; font-weight: 600;"><?php echo $result_healthinfo['HealthInfo_Title']; ?></span></div>
            <div class="row">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="p-2 bd-highlight"><span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">written by </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $result_healthinfo['HealthInfo_Author']; ?></span></div>
                    <div class="p-2 bd-highlight">|</div>
                    <div class="p-2 bd-highlight">
                        <div class="d-flex flex-row">
                            <?php 
                                for($x =0; $x<sizeof($arrStr); $x++)
                                {
                            ?>
                            <div class="">
                                <span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;">
                                    <form method="post" action="healthinfo-list.php">
                                        <input type="hidden" value="<?php echo $arrStr[$x] ?>" name="articleSearch">
                                        <button class="btn btn-link text-decoration-none text-reset p-0" name="searchButton" type="submit"><?php echo $arrStr[$x] ?></button>
                                    </form>
                                </span>
                            </div>
                            <?php
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <div class="row"><?php echo $result_healthinfo['HealthInfo_Desc']; ?></div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <?php
            }
        }elseif(!isset($_POST['searchButton'])){

            $query_healthinfo = mysqli_query($con,"SELECT * FROM healthinfo");
            while($result_healthinfo = mysqli_fetch_array($query_healthinfo)){
                $str = $result_healthinfo['HealthInfo_Tags'];
                $arrStr = explode(" ",$str);
        ?>
        <div class="ps-5 pe-5 pt-2 pb-5">
            <div class="row"><span style="font-size: 45px; font-weight: 600;"><?php echo $result_healthinfo['HealthInfo_Title']; ?></span></div>
            <div class="row">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div class="p-2 bd-highlight"><span style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 12px;">written by </span><span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;"><?php echo $result_healthinfo['HealthInfo_Author']; ?></span></div>
                    <div class="p-2 bd-highlight">|</div>
                    <div class="p-2 bd-highlight">
                        <div class="d-flex flex-row">
                            <?php 
                                for($x =0; $x<sizeof($arrStr); $x++)
                                {
                            ?>
                            <div class="">
                                <span style="color: rgb(80, 80, 80); font-weight: 500; font-size: 14px;">
                                <form method="post" action="healthinfo-list.php">
                                    <input type="hidden" value="<?php echo $arrStr[$x] ?>" name="articleSearch">
                                    <button class="btn btn-link text-decoration-none text-reset p-0" name="searchButton" type="submit"><?php echo $arrStr[$x] ?></button>
                                </form>
                                </span>
                            </div>
                            <?php
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <div class="row"><?php echo $result_healthinfo['HealthInfo_Desc']; ?></div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php include("Interface/footer.php"); ?>