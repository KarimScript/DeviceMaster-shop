

 
    <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                
                    
                    <a href="index.php" class="navbar-brand" style="font-size:35px;font-weight:700;color:#ffff">DM</a>
               
               
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if(isset($_SESSION['email'])) {
                            ?>
                        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span><b> Cart</b></a></li>
                        <li><a href="settings.php"><span class="glyphicon glyphicon-user"></span><b> Profile</b></a></li>
                        <li><a href="logout_script.php"><span class="glyphicon glyphicon-log-in"></span><b> Logout</b></a></li>                       
                        
                        <?php
                        }else {
                            ?>
                        <li><a href="signup.php" target="_blank"><span class="glyphicon glyphicon-user"></span><b> Sign Up</b></a></li>
                        <li><a href="userLogin.php" target="_blank"><span class="glyphicon glyphicon-log-in"></span><b> Login</b></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                
             
       
        </nav>

   