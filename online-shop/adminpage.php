<?php 
session_start();
if(isset($_SESSION['admin'])){
    include 'includes/connect.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin area</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
         <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.0.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
   <nav class="navbar navbar-inverse navbar-fixed-top">
                
   <a href="settings.php" class="navbar-brand"><span class="glyphicon glyphicon-user"></span> Admin</a>
   
               
                 <div class="container">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li><a href="adminpage.php?page=products"></span><b> Products</b></a></li>
                        <li><a href="adminpage.php?page=users"></span><b> Users</b></a></li>
                        <li><a href="adminpage.php?page=Manage"><b> Orders</b></a></li>
                        <li><a href="logout_script.php"><span class="glyphicon glyphicon-log-in"></span><b> Logout</b></a></li>                       
                        
                       
                    </ul>
                    
                    </div>
       
    </nav>
   <br><br><br>
   <br>
    <?php 
$page= isset($_GET['page'])? $_GET['page'] : 'Manage';
if($page=='Manage'){
  echo   '<center><h2><span class="label label-primary">Orders</span></center></h2>';
                        $sum = 0;
                        $query = "SELECT user_id , items.price AS Price, items.id, items.name AS Name FROM users_items JOIN items ON users_items.item_id = items.id WHERE status='In Progress'";
                        $result = mysqli_query($con, $query)or die($mysqli_error($con));
                        if (mysqli_num_rows($result) >= 1) {
                            ?>
                           
                            <table class="table">
                                <thead>
                                    <td>User #id</td>
                                    <td>Item #id</td>
                                    <td>Item Name</td>
                                    <td> Price</td>
                                    <td>Action</td>

                                </thead>


    ...
 
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    $sum+= $row["Price"];
                                    $id="";
                                    $id .= $row["id"] . ",";
                                    $userid=$row["user_id"];
                                    echo "<tr>
                                              <td>" . "#" . $row["user_id"] . "</td>
                                              <td>" . "#" . $row["id"] . "</td>
                                              <td>" . $row["Name"] . "</td>
                                              <td>$ " . $row["Price"] . "</td>
                                              <td><a href='?page=deleteOrder&itemid={$row['id']}&userid={$row['user_id']}' class='btn btn-danger'> Remove </a>
                                              </td>
                                             
                         
                                          </tr>";
                                }
                                $id = rtrim($id, ",");
                                echo "<tr>
                                          <td></td>
                                          <td></td>
                                          <td>Total</td>
                                          <td>$ " . $sum . "</td>
                                          <td><a href='adminpage.php?page=confirm&itemid=".$id."&userid=".$userid."'class='btn btn-primary'>Confirm Orders</a></td>
                                          </tr>";
                                ?>
                            </tbody>
                            <?php
                        } else {
                            echo "<center><div class='alert alert-info' role='alert'><h2><br>No Orders now !</h2></div>";
                        ?>
                        <?php
                        ?>
                    </table>
                    
         
<?php }
}
elseif($page=='confirm'){
    $itemid= $_GET['itemid'];
    $Uid= $_GET['userid'];
    $sql="UPDATE users_items SET status='done' WHERE user_id=" . $Uid . " and status='In Progress'";
    $res=mysqli_query($con, $sql)or die($mysqli_error($con));
    if($res){
        echo "<center><div class='alert alert-info' role='alert'><h2><br>Orders confirmed!</h2></div>";
    }
}
elseif ($page=='products') {
    $sql="SELECT * FROM items";
    $res=mysqli_query($con, $sql)or die($mysqli_error($con)); ?>
    <center><a href='?page=Addproduct' class='btn btn-success'> + Add Product </a></center></h2>
    
    <table class="table">
    
                                <thead>
                                    <td>#id</td>
                                    <td>Name</td>
                                    <td>Price</td>
                                    <td>description</td>
                                    <td>Action</td>

                                </thead>

   <?php while ($row = mysqli_fetch_array($res)) {
        
        $id = $row['id'];
        
        echo "<tr>
                  <td>" . "#" . $row['id'] . "</td>
                  <td>" . "#" . $row['name'] . "</td>
                  <td>$" . $row['price'] . "</td>
                  <td>" . $row['description'] . "</td>
                  <td><a href='adminpage.php?page=RemoveItem&id={$row['id']}' class='btn btn-danger'> Remove </a>
                  <td><a href='adminpage.php?page=Edit&id={$row['id']}&name={$row['name']}&price={$row['price']}&desc={$row['description']}' class='btn btn-primary'> Edit </a>
                  </td>
                 

              </tr>";
   }
    ?>



</table>
<?php }
elseif($page=='Addproduct'){
?>
    <div class="container">
            
				<div class="row">
                <div class="col-sm-8 ">
                    <h1> Add Product </h1>
                    <form action="?page=InsertProduct" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text"  class="form-control" placeholder="Name" name="name"  required>
                        </div>
                        <div class="form-group">
                            <input type="number"  class="form-control" placeholder="Price" name="price"  required>
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" placeholder="description" name="desc"  required>
                        </div>
                        <div class="form-group">
                            <input type="file"  class="form-control" placeholder="add image" name="image" required>
                        </div>
                        <div class="form-group">
                            <input type="number"  class="form-control" placeholder="1 for laptop,2 for pc,3 for accessories" name="category" required>
                        </div>
                        <button class="btn btn-primary" name="add">Add</button>
                    </form>
                </div></div>
            </div>
    
<?php }
elseif($page=='InsertProduct'){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['add'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $desc = $_POST['desc'];
            $category = $_POST['category'];
            $sql="INSERT INTO `items`(`id`, `name`, `price`, `description`, `cat_id`) VALUES ('','$name','$price','$desc','$category')";
            $res=mysqli_query($con, $sql)or die($mysqli_error($con)); 
            $id = mysqli_insert_id($con);
            $temp_name=$_FILES['image']['tmp_name'];
             
            if ($res){
              
              
                   
                   $newName = 'img-'.$id;
                   $newfilename=$newName .".jpg";
   
                   $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/onlineShop-csci425/online-shop/img/';
                   $uploadfile = $uploaddir . $newfilename;
   
                   if(move_uploaded_file($temp_name, $uploadfile)){
                    echo "<center><div class='alert alert-info' role='alert'><h2><br>product Added successfully!</h2></div>";
                   }
                      
                   
               }
           
       }
      }
}

elseif($page=='RemoveItem'){
    $id = $_GET['id'];
    $sql="DELETE FROM items WHERE id='$id'";
    $res=mysqli_query($con, $sql)or die($mysqli_error($con));
    if($res){
        echo "<center><div class='alert alert-info' role='alert'><h2><br>product Removed!</h2></div>";
    }

}
elseif($page=='Edit'){
    $id = $_GET['id'];
    $oldname= $_GET['name'];
    $oldprice= $_GET['price'];
    $olddesc= $_GET['desc'];
   
    ?>
    <div class="container">

            
				<div class="row">
                <div class="col-sm-8  ">
                    <h1> Edit Product </h1>
                    <form action="?page=save&id=<?php echo $id ?>" method="POST">
                       
                        <div class="form-group">
                            <input type="text"  value="<?php echo $oldname?>" class="form-control" placeholder="Name" name="name"  required>
							
                        </div>
                        <div class="form-group">
                            <input type="number" value="<?php echo $oldprice?>"  class="form-control" placeholder="Price" name="price" required>
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?php echo $olddesc?>"  class="form-control" placeholder="description" name="description" required>
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>
                </div></div>
            </div>
        
<?php 
}
elseif($page=='save'){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=$_GET['id'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $desc=$_POST['description'];
        $query="UPDATE items SET name='$name',price='$price',description='$desc' WHERE id='$id'";
        $res=mysqli_query($con, $query)or die($mysqli_error($con));
        if($res){
            echo "<center><div class='alert alert-info' role='alert'><h2><br>product Updated successfully!</h2></div>";
        }
    }

}
elseif($page=='users'){

    $sql="SELECT * FROM users";
    $res=mysqli_query($con, $sql)or die($mysqli_error($con)); ?>
    <center><h2><span class="label label-primary">Users</span></center></h2>
    <table class="table">
        
                                <thead>
                                    <td>#id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Contact</td>
                                    <td>Address</td>

                                </thead>

   <?php while ($row = mysqli_fetch_array($res)) {
        
        $id = $row['id'];
        
        echo "<tr>
                  <td>" . "#" . $row['id'] . "</td>
                  <td>"  . $row['name'] . "</td>
                  <td>" . $row['email'] . "</td>
                  <td>" . $row['contact'] . "</td>
                  <td>" . $row['address'] . "</td>
                  <td><a href='?page=Removeuser&id={$row['id']}' class='btn btn-danger'> Remove </a></td>
                  
                 

              </tr>";


}
}
elseif($page=='Removeuser'){
    $id=$_GET['id'];
    $sql="DELETE FROM users WHERE id='$id'";
    $res=mysqli_query($con, $sql) ;
    if($res){
        echo "<center><div class='alert alert-info' role='alert'><h2><br>User Removed!</h2></div>";
    }
    else{
        echo "<center><div class='alert alert-info' role='alert'><h2><br>ERROR!</h2></div>";
    }

}elseif($page='deleteOrder'){
    $itemid=$_GET['itemid'];
    $userid=$_GET['userid'];
    $sql="UPDATE users_items SET status='Removed' WHERE user_id='$userid'  and status='In Progress' and item_id='$itemid'";
    $res=mysqli_query($con, $sql) ;
    if($res){
        echo "<center><div class='alert alert-info' role='alert'><h2><br>Order Removed!</h2></div>";
    }

}

    
?>






      
    
</body>
</html>

