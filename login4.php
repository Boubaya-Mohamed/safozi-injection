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
      <h3 class="text-center"><span class="label label-success">
  
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
function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}

            $Name = xss_clean($_POST['Name']);
            $Author = xss_clean($_POST['Author']);    
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
          <a href="login4.php?all=1"><button type="button" class="btn btn-info">All books</button></a>
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


 function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}

            $Name = xss_clean($_POST['Name']);
            $Author = xss_clean($_POST['Author']);    
            $query = sprintf("INSERT INTO books (title, author)
VALUES ('".$Name."', '".$Author."')");
           mysqli_query($connection, $query);
        
            </pre>
          </div>
        </div>
      </div>
      
      <hr>
            
      <br>

      <?php include("footer.php"); ?>

    </div> <!-- /container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

