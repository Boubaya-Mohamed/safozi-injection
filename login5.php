<?php 
    require "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="xss Injection safozi">
    <meta name="author" content="Mohamed boubaya ">

    <title>SQL Injection safozi</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     <link href="login5.css" rel="stylesheet">
  </head>

  <body>
 
    <div class="container">
      <div class="header hidden-xs">
        <ul class="nav nav-pills pull-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">SQL-Standard Login<b class="caret"></b></a>
            <ul class="nav dropdown-menu">
              <li><a href="login1.php">Vulnerable</a></li>
              <li><a href="login2.php">Secure</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">SQL-Search<b class="caret"></b></a>
            <ul class="nav dropdown-menu">
               <li><a href="books1.php">Vulnerable</a></li>
              <li><a href="books2.php">Secure</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Xss-Stored<b class="caret"></b></a>
            <ul class="nav dropdown-menu">
              <li><a href="login3.php">Vulnerable</a></li>
              <li><a href="login4.php">Secure</a></li>
            </ul>
          </li>
           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">LFI-injection<b class="caret"></b></a>
            <ul class="nav dropdown-menu">
              <li><a href="login5.php">Vulnerable</a></li>
              <li><a href="login6.php">Secure</a></li>
            </ul>
          </li>
        </ul>
        <h3 class="text-muted"><a href="index.php">Safozi Injection</a></h3>
      </div>
      <?php include("mobile-navbar.php"); ?>
      
      <h3 class="text-center"><span class="label label-danger">
Vulnerable LFI-injection </span></h3><br>
      


       <form method="get">
        <div class="row">
         <div class="col-sm-5">
         <p style =" margin-top: 10px;">
          please chose one of safozi  service :
          </p>
            </div>
<div class="col-sm-4">
            <select style="    width: 142px;
    height: 38px;" class="selectpicker" data-style="btn-primary" name ='safozi'>
                    <option value="safozi-box">safozi box</option>
                    <option value="safozi-cluster">safozi cluste</option>  
                    <option value="safozi-cdn">safozi cdn</option>
                    <option value="safozi-diy">safozi diy</option>
                    </select>
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-success">Search</button>
              </div>
              </div>
</form>
      
      <br>
      <br>
  
      <?php
    if (isset( $_GET['safozi'] ) ){
        include( $_GET['safozi'] . '.php' );
    }
?>    
     
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h4>PHP Code:</h4>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12">
          <div class="highlight">
            <pre>




  if (isset( $_GET['safozi'] ) ){
        include( $_GET['safozi'] . '.php' );
    }



            </pre>
          </div>
        </div>
      </div>
      
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h4>Vulnerability:</h4>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12">
          <div class="highlight">
            <pre>
just pass this in the URL       
<strong>
 <strong>http://localhost/safozi-injection/login5.php?safozi=php://filter/convert.base64-encode/resource=index</strong>
</strong>
to get base64 of the index 
</pre>
</div>
</div>
</div>

      <?php include("footer.php"); ?>

    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="login5.js"></script>
  </body>
</htm