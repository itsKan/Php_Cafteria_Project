<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="../assets/js/getUserInfo.js"></script>
    <style >
        .well{
            background-color: black;
        }
        .col-sm-2{

            padding: 10px;
 }
        .shape{
            border: 1px solid Gainsboro  ;
  }
  table{

      


  }


.col-sm-4 {


     border: 1px solid Gainsboro;

}
tr , td{

  padding: 7px;


}

#size{


    border: 1px;
}


    </style>

    <title>Show Products</title>
</head>
<body  style="background-color:Snow ">
<nav class="navbar navbar-inverse ">
    <div class="container-fluid">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">ITI Cafertaria</a>

        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="orders.html">Home</a></li>
            <li class="active"><a href="Show_Products.php">Products</a></li>
            <li class="active"><a href="all-users.php">Users</a></li>
            <li class="active"><a href="AdminMainPage.html">Manual Orders</a></li>
            <li class="active"><a href="checks.html">Checks</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
            <li><img src="" width="50" height="50" id="userImg" /> </li>
            
            <li><a href="#" id="userName"></a></li>
            <li><a href="../controllers/logout.php">Logout</a></li>
        </ul>
            </div>
            </nav>
            <br>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12" align="center">
                <h1 style="color:Salmon ;font-style: oblique;">Edit Product</h1>
                </div>
                 <?php
                echo '<form role="form" action="../models/editProduct.php?id='.$_GET['id'].'" method="post" enctype="multipart/form-data">';
                   
                    echo "<div class='form-group'>";
                    
                       require_once "../controllers/DbConnection.php";
                       require_once "../controllers/Product.php";
                        require_once "../controllers/Category.php";
                       $pro = new Product(DbConnection::getConnection());
                       $result = $pro->Search_product($_GET['id']);
                        if ($result->num_rows == 1) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    // echo "<option value='".$row["ctg_id"]."'>".$row["ctg_name"]."</option>";
                                   echo "<label class='control-label' >Product</label>";
                      echo "<input class='form-control' id='product' value='".$row["p_name"]."'
                               type='text' name='p_name'>";
                    echo "</div>";
                    echo "<div class='form-group'>";
                       echo " <label class='control-label'>Price</label>";
                       echo "<input class='form-control' id='price' type='number' min='0'
                               value='".$row["u_price"]."' name='u_price'>";
                                }
                            } 
                       
                   echo "</div>";
                   
                   echo "<div class='form-group'>
                        <a href='../views/Add_Category.html' class='pull-right'>Add Category</a>
                        <label class='control-label' for='category'>Category</label>
                        <select name='ctg_id' class='form-control' id='category' >
                            <option value='' selected=''>Select Category</option>
                          ";
                           
                            $pro = new Category(DbConnection::getConnection());

                            $result = $pro->select_categories();
                           
                                    
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                   echo "<option value='".$row["ctg_id"]."'>".$row["ctg_name"]."</option>";
                                }
                            } else {
                                echo "0 results";
                            }
               
                     
                   
                  
                  
                   echo "</select>";


                   
                  echo" <div >";
                    echo"    <label class='control-label'>Select Image</label>";
                        echo"<input name='p_img' type='file' class='control-label' id='img'>";

                   echo "</div>";
                    echo"<br/>";
                   echo" <br/>";
                   echo" <button type='submit' class='active btn btn-default btn-lg'>Submit</button>";
               echo "</form>";
               ?>
            </div>
            </div>
        
        <div class="row">
            <div class="col-md-12"></div>
        </div>
        <div class="row">
            <div class="col-md-12"></div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row"></div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row"></div>
    </div>
</div>
<div class=" row  text-center" background="Black">
      <div class="well">Insititute of Information and Technology </div>
</div>


</body>

</html>
