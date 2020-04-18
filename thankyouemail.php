<?Php
session_start();
$search_query = '';
if(isset($_GET["query"])){
  $search_query = $_GET["query"];
}

$page_no = 1;
if(isset($_GET["pageno"])){
  $page_no = $_GET["pageno"];
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Pharmacy</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/index.css">
   </head>
   <body>
      <div class="site-wrap">
         <header class="site-navbar">
            <div class="site-navbar-top">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-6 col-md-4 order-2 order-md-1">
                        <form action="shop.php" class="site-block-top-search">
                           <input type="text" name="query" class="form-control border-0" placeholder="Search" value="<?php echo $search_query;?>">
                        </form>
                     </div>
                     <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                        <div class="site-logo">
                           <a href="index.php" class="js-logo-clone">DrugsDirect</a>
                        </div>
                        <nav class="site-navigation text-md-center" role="navigation">
                           <div class="container">
                              <ul class="site-menu">
                                 <li><a href="index.php">Home</a></li>
                                 <li><a href="about.php">About us</a></li>
                                 <li><a href="shop.php">Shop</a></li>
                              </ul>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
            <!--BOX section-->
            <div class="col-4 col-md-offset-4">
               <div class="p-5 border mb-3">
                  <div class="p-lg-5 border">
                     <div class="text-center">
                        <h1 class="h1 mb-1 text-black">Please verify your email address!!!</h1>
                     </div>
                     <div>
                        <h4>Please verify your email address!
                           Sign into your email account and click
                           on the verification link to verify your email address.
                        </h4>
                     </div>
                  </div>
               </div>
            </div>
          </header>   
      </div>
   </body>
</html>
    