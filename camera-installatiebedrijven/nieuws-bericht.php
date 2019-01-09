
<html>
<head>
  <?php
    include'header.php';
  ?>
</head>
<body>
  <div class="container-fluid text-center">
    <div class="row content">
      <?php
        include'left_sidebar.php';
      ?>
        <div class="col-sm-7 text-center"> 
          <?php
            nieuwsdetail();
          ?>
        </div>
      <?php
        include'right_sidebar.php';
      ?>
    </div>
  </div>
</div>
<br>
<?php
  include'footer.php';
?>
</body>
</html>

