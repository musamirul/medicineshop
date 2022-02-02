<?php include("Interface/header.php")?>


<div class="row mb-5 mt-5">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <div class="row pt-2 pb-2">
                <span class="text-center fs-4"><b>Payment Successfull</b></span>
            </div>
            <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <div class="row pt-1">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="row mb-5">
                    <?php 
                        echo $_SESSION['message']; 
                        //unset($_SESSION['message']);
                    ?>
                    </div>
                    <div class="row">
                        <form method="post" action="../product-list.php">
                            <div class="d-grid gap-2">
                            <button name="ok" type="submit" class="btn btn-primary">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>


<?php include("Interface/footer.php")?>