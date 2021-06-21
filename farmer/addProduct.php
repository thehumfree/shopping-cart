<?php
include_once("../db/db.php");
if (!$_SESSION["id"]) {
    header("Location: ../index.php");
}
if (isset($_POST["addprod"])) {
    $prodname = $_POST["pname"];
    $category = $_POST["category"];
    $location =$_POST["location"];
    $description = $_POST["description"];
    $phone = $_POST["phone"];
    $price = $_POST["price"];
    $sellerid = $_SESSION["id"];
    $date = date("d-m-y");
    $image = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    //to upload image in location
    move_uploaded_file($image_tmp, "../images/$image");
    $query = "INSERT INTO product(product_name, image, category, location, price, description, phone, date, farmer_id)";
    $query.= " VALUES ('$prodname', '$image', '$category', '$location', '$price', '$description', '$phone', now(), '$sellerid')";
    $sql = $conn->query($query);
    if (!$sql) {
        die("Product not added!!!".$conn->error);
    } else {
        echo "<script>alert('Product has been added successfully')</script>";
        echo "<script> window.location='addProduct.php' </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../custom/addProduct.css">
</head>

<body>
    <div class="container-fluid">
        <div class="col">
            <div class="page_nav">
                <ul>
                    <li><a href="farmerProfile.php">View Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="hero">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse"
                        aria-expanded="false">
                        <span class="sr-only"> navigation toggle</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Navbar content -->
                    <a href="farmerProfile.php" class="navbar-brand">Adedoyin Farms</a>
                </div>

                <div class="collapse navbar-collapse" id="collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="farmerProfile.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                        </li>
                        <li><a href="farmerProfile.php"><span class=" glyphicon
                    glyphicon-user"></span> View Profile</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../logout.php"><span class="glyphicon
                    glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form content -->
        <div class="form-box">
            <form id="addproduct" class="input-group" method="POST" enctype="multipart/form-data">
                <h3 align="center" style="color: #777; font-size: medium;">ADD PRODUCT</h3>
                <input type="text" class="input-field" placeholder="Product Name" name="pname" required><br>
                <select class="select-form" name="category" class="form-control">
                    <option selected>--Select Food Category--</option>
                    <?php
                    $query = "SELECT * FROM category" ;
                    $sql = $conn->query($query);
                    while ($row = $sql->fetch_assoc()) {
                        $cid = $row["cid"];
                        $catname= $row["category_name"];
                        echo "<option value='$cid'> ". $catname ."</option>"; ?>
                    <?php
                    };
                    
                ?>
                </select>

                <input type="tel" class="input-field" placeholder="Phone number" name="phone" required><br />
                <select class="select-form" name="location" id="location" required>
                    <option selected>--Select Location--</option>
                    <?php
            $query = "SELECT * FROM location" ;
            $sql = $conn->query($query);
            while ($row = $sql->fetch_assoc()) {
                $lid = $row["lid"];
                $location= $row["location"];
                echo "<option value='$lid'> ". $location ."</option>"; ?>
                    <?php
            };
            
        ?>
                </select><br />
                <input type="text" class="input-field" placeholder="Enter Price Of Product" name="price" required><br>
                <textarea id="description" class="input-field" name="description" placeholder="Product Description..."
                    rows="4" cols="50"></textarea><br>

                <label>Upload Picture</label><br />
                <input type="file" name="image" id="imageToUpload"><br />
                <button type="submit" name="addprod" class="submit-btn">Upload</button>


        </div>

    </div>

</body>

</html>