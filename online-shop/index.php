<?php
require("includes/connect.php");

if (isset($_SESSION['email'])) {
    header('location: products.php');
}
?>

<!DOCTYPE html>
<!--

-->
<html>
    <head>
      
        
        <meta charset="UTF-8">
        <title> DeviceMaster Store</title>
         
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <link rel="stylesheet" href="css/style.css"/>
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.0.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
          

    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
        <div id="banner-image">
           <div class="container">
               <center>
               <div id="banner_content">
                   <h1><b>DeviceMaster Store</b></h1>
                   <p>All the tools you need to become a Master.</p>
                   <a href="userLogin.php" target="_blank"> <button class="btn btn-primary btn-lg active" id="home-btn"><b>Let's Shop</b> </button></a>
                   
               </div>
                </center>
           </div>
       
       </div><br><br>
        
        
        
         <div class="container">
             <div class="row text-center">               
                 <div class="col-md-4 col-sm-7"> 
                     <div class="thumbnail">
            <a href="#">
                <image src="img/laptopCategory.jpg"/>
             <div class="caption">
                 <h2>Laptops</h2>
                 <p>A special selection and reasonable prices of laptops.</p>
             </div>
            </a>
                         </div>
        </div>

        <div class="col-md-4 col-sm-7"> 
                     <div class="thumbnail">
            <a href="#">
             <image src="img/PcCategory.jpg"/>
             <div class="caption">
                 <h2>PCs</h2>
                 <p>New computers suitable for gamers, programmers and big projects.</p>
             </div>
            </a>
                     </div>
        </div>

        <div class="col-md-4 col-sm-7"> 
                     <div class="thumbnail">
            <a href="#">
             <image src="img/AccCategory.jpg"/>
             <div class="caption">
                 <h2>Accessories</h2>
                 <p>A set of accessories for the pc and laptop,including Mouse and Keyboard ,RAM,GPU ,CPU</p>
             </div>
            </a>
                     </div>
        </div>
 
             </div>
         </div><br><br><br><br>
         
      
                
        
       <footer class="fo">
           <div class="container">
               <center>
                   <p>Copyright <small>&copy;</small> DeviceMaster Store | All Rights Reserved</p>
               </center>
           </div>
           
           
       </footer>
        
        
    </body>
</html>
