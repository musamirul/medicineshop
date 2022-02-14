<?php include("Interface/header.php"); ?>
<div class="container mb-5 pb-5">
    <div class="col">
        <div class="row mb-5">
            <div class="d-flex flex-column bd-highlight mb-3">
                <div style="font-size: 30px; font-weight: bold;" class="p-2 bd-highlight"><center>How can we assist you?</center></div>
                <div class="p-2 bd-highlight">
                    <center>You might lose your way while trying our service for the first time. Here are some tips on making your journey with us easier.</center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-5 p-3 shadow-sm">
                <?php
                    $query_countall = mysqli_query($con,"SELECT count(*) FROM help WHERE Help_Category = 'general'");
                    $result_countall = mysqli_fetch_array($query_countall);
                    $allcount = $result_countall[0];
                ?>
                <div class="row mb-3">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight"><span style="font-size: 17px;font-weight: 400;">General&nbsp;</span></div>
                        <div class="d-highlight"><span style="font-size: 12px; color: grey;"> (<?php echo $allcount; ?> Articles)</span></div>
                    </div>
                </div>
                <?php

                    $query_general = mysqli_query($con,"SELECT * FROM help WHERE Help_Category = 'general' LIMIT 4");
                    while($result_general = mysqli_fetch_array($query_general)){
                        $help_id = $result_general['Help_ID'];
                ?>
                <div class="row">
                    <div class="d-flex flex-row bd-highlight mb-2">
                        <div style="font-size: 14px;" class="pe-2 bd-highlight"><i class="bi bi-card-text"></i></div>
                        <div style="font-size: 14px;" class="bd-highlight"><a data-bs-toggle="modal" class="text-decoration-none text-reset" data-bs-target="#HelpView<?php echo $help_id ?>" href=""><?php echo $result_general['Help_Title'] ?></a></div>
                    </div>
                </div>
                    <!-- View Product list -->
                    <div class="modal fade" id="HelpView<?php echo $help_id ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel"> <?php echo $result_general['Help_Title']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo $result_general['Help_Desc']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                            </div>   
                        </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-6 mb-5 p-3 shadow-sm">
                <?php
                    $query_countall = mysqli_query($con,"SELECT count(*) FROM help WHERE Help_Category = 'online_consultation'");
                    $result_countall = mysqli_fetch_array($query_countall);
                    $allcount = $result_countall[0];
                ?>
                <div class="row mb-3">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight"><span style="font-size: 17px;font-weight: 400;">Online Consultation&nbsp;</span></div>
                        <div class="d-highlight"><span style="font-size: 12px; color: grey;"> (<?php echo $allcount; ?> Articles)</span></div>
                    </div>
                </div>
                <?php

                    $query_general = mysqli_query($con,"SELECT * FROM help WHERE Help_Category = 'online_consultation' LIMIT 4");
                    while($result_general = mysqli_fetch_array($query_general)){
                        $help_id = $result_general['Help_ID'];
                ?>
                <div class="row">
                    <div class="d-flex flex-row bd-highlight mb-2">
                        <div style="font-size: 14px;" class="pe-2 bd-highlight"><i class="bi bi-card-text"></i></div>
                        <div style="font-size: 14px;" class="bd-highlight"><a data-bs-toggle="modal" class="text-decoration-none text-reset" data-bs-target="#HelpView<?php echo $help_id ?>" href=""><?php echo $result_general['Help_Title'] ?></a></div>
                    </div>
                </div>
                    <!-- View Product list -->
                    <div class="modal fade" id="HelpView<?php echo $help_id ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel"> <?php echo $result_general['Help_Title']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo $result_general['Help_Desc']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                            </div>   
                        </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-6 mb-5 p-3 shadow-sm">
                <?php
                    $query_countall = mysqli_query($con,"SELECT count(*) FROM help WHERE Help_Category = 'online_medicine'");
                    $result_countall = mysqli_fetch_array($query_countall);
                    $allcount = $result_countall[0];
                ?>
                <div class="row mb-3">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight"><span style="font-size: 17px;font-weight: 400;">Online Medicine&nbsp;</span></div>
                        <div class="d-highlight"><span style="font-size: 12px; color: grey;"> (<?php echo $allcount; ?> Articles)</span></div>
                    </div>
                </div>
                <?php

                    $query_general = mysqli_query($con,"SELECT * FROM help WHERE Help_Category = 'online_medicine' LIMIT 4");
                    while($result_general = mysqli_fetch_array($query_general)){
                        $help_id = $result_general['Help_ID'];
                ?>
                <div class="row">
                    <div class="d-flex flex-row bd-highlight mb-2">
                        <div style="font-size: 14px;" class="pe-2 bd-highlight"><i class="bi bi-card-text"></i></div>
                        <div style="font-size: 14px;" class="bd-highlight"><a data-bs-toggle="modal" class="text-decoration-none text-reset" data-bs-target="#HelpView<?php echo $help_id ?>" href=""><?php echo $result_general['Help_Title'] ?></a></div>
                    </div>
                </div>
                    <!-- View Product list -->
                    <div class="modal fade" id="HelpView<?php echo $help_id ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel"> <?php echo $result_general['Help_Title']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo $result_general['Help_Desc']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                            </div>   
                        </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="col-6 mb-5 p-3 shadow-sm">
                <?php
                    $query_countall = mysqli_query($con,"SELECT count(*) FROM help WHERE Help_Category = 'corporate'");
                    $result_countall = mysqli_fetch_array($query_countall);
                    $allcount = $result_countall[0];
                ?>
                <div class="row mb-3">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight"><span style="font-size: 17px;font-weight: 400;">Corporate&nbsp;</span></div>
                        <div class="d-highlight"><span style="font-size: 12px; color: grey;"> (<?php echo $allcount; ?> Articles)</span></div>
                    </div>
                </div>
                <?php

                    $query_general = mysqli_query($con,"SELECT * FROM help WHERE Help_Category = 'corporate' LIMIT 4");
                    while($result_general = mysqli_fetch_array($query_general)){
                        $help_id = $result_general['Help_ID'];
                ?>
                <div class="row">
                    <div class="d-flex flex-row bd-highlight mb-2">
                        <div style="font-size: 14px;" class="pe-2 bd-highlight"><i class="bi bi-card-text"></i></div>
                        <div style="font-size: 14px;" class="bd-highlight"><a data-bs-toggle="modal" class="text-decoration-none text-reset" data-bs-target="#HelpView<?php echo $help_id ?>" href=""><?php echo $result_general['Help_Title'] ?></a></div>
                    </div>
                </div>
                    <!-- View Product list -->
                    <div class="modal fade" id="HelpView<?php echo $help_id ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel"> <?php echo $result_general['Help_Title']; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?php echo $result_general['Help_Desc']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                            </div>   
                        </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include("Interface/footer.php"); ?>