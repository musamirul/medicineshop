<?php include("Interface/header.php") ?>
  <div class="container-fluid ps-5 pe-5 pt-4">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 
      </div>
      <form method="post">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
<footer class="text-center text-white fixed-bottom bg-dark mt-5">
    
	<!--<div class="container pt-4">
    	<section class="mb-4">
        	<a class="btn btn-outline-light rounded-circle m-1 me-3" href="#" role="button"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-outline-light rounded-circle m-1 me-3" href="#" role="button"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-outline-light rounded-circle m-1 me-3" href="#" role="button"><i class="fab fa-google"></i></a>
            <a class="btn btn-outline-light rounded-circle m-1 me-3" href="#" role="button"><i class="fab fa-instagram"></i></a> 
            <a class="btn btn-outline-light rounded-circle m-1 me-3" href="#" role="button"><i class="fab fa-linkedin"></i></a>  
            <a class="btn btn-outline-light rounded-circle m-1 me-3" href="#" role="button"><i class="fab fa-github"></i></a>           
        </section>
    </div>-->
    <div class="text-center p-3" style="background-color:rgba(0,0,0,0.2);">
    @ 2022 Copyright :
    <a class="text-white text-decoration-none" href="#">OnlineMedicineShopping.com</a>
    </div>
    <!-- 
    Active navbar button by
    1) get current file name (php)
    2) set if else on button class 
    3) if file name = product.php therefore button == active
    -->
</footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="Interface/style/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Interface/style/jQuery/jquery-3.6.0.min.js"></script>
    <script src="Interface/style/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="Interface/style/DataTables/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
  </body>
</html>