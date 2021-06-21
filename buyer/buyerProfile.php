<<?php
    include_once("../db/db.php");
    if (isset($_POST["add"])) {
        if (isset($_SESSION["cart"])) {
            $item_array_id = array_column($_SESSION["cart"], "pid");
            if (in_array($_POST["pid"], $item_array_id)) {
                echo "<script>alert('Product has been added to cart!!')</script>";
                echo "<script>window.location = 'buyerProfile.php'</script>";
            } else {
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    "pid" => $_POST["pid"],
                    "pname"
                );
                $_SESSION["cart"][$count] = $item_array;
            }
        } else {
            $item_array = array(
                "pid" => $_POST["pid"]
            );
            $_SESSION["cart"][0] = $item_array;
            print_r($_SESSION["cart"]);
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buyer Profile</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../custom/buyerProfile.css">


    </head>

    <body>
        <div class="hero">
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#collapse" aria-expanded="false">
                            <span class="sr-only"> navigation toggle</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Navbar content -->
                        <a href="./buyerProfile.php" class="navbar-brand">Adedoyin Farms</a>
                    </div>

                    <div class="collapse navbar-collapse" id="collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="./buyerProfile.php"><span class="glyphicon
                        glyphicon-home"></span> Home</a></li>
                            <li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control"
                                    id="search"></li>
                            <li style="top:4px;left:10px;"><button id="search_btn">Search</button></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="./shoppingcart.php" id="cart_container"><span
                                        class="glyphicon glyphicon-shopping-cart"></span>
                                    View Shopping Cart <?php
                                    if (isset($_SESSION["cart"])) {
                                        $count = count($_SESSION["cart"]);
                                        echo "<span class='text-warning bg-light'> $count </span>";
                                    } ?>
                                </a>
                            </li>
                            <li><a href="../logout.php"><span class="glyphicon
                        glyphicon-log-out"></span> Logout</a></li>


                        </ul>
                    </div>
                </div>
            </div>
            <p><br /></p>
            <p><br /></p>
            <p><br /></p>
            <!--Table Content-->
            <div class="container">
                <div class="panel panel-info" id="scroll">
                    <div class="panel-heading">Products</div>
                    <div class="panel-body">

                        <?php
                ////////////View Product///////////
                $query = "SELECT * FROM product";
                $sql = $conn->query($query);
                while ($row = $sql->fetch_assoc()) {
                    $pid = $row["pid"];
                    $pname = $row["product_name"];
                    $image = $row["image"];
                    $category = $row["category"];
                    $location = $row["location"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $phone = $row["phone"];
                    $date = $row["date"];
                    $farmer = $row["farmer_id"]; ?>

                        <div class="row">
                            <form action="" method="POST">
                                <div class="col-md-2 col-xs-2"> <?php echo $pname; ?>

                                </div>
                                <div class="col-md-2 col-xs-2">
                                    <img src="../images/<?php echo $image; ?>"
                                        width="100px" />
                                </div>
                                <div class="col-md-1 col-xs-1">
                                    ₦<?php echo $price; ?><input
                                        type="hidden" name="pid"
                                        value="<?php echo $pid; ?>" />
                                    <button style="float:right;" class="btn btn-danger
                                    btn-xs" type="submit" name="add">Add To Cart</button>

                                </div>
                                <div class=" col-md-2 col-xs-2">
                                    <div>Product Description</div>
                                    <div><?php echo $description; ?>
                                    </div>
                                </div>
                                <div class=" col-md-2 col-xs-2">
                                    <div>Location</div>

                                    <div><?php
                                        $loc_query="SELECT * FROM location WHERE lid = '$location'";
                    $loc_sql = $conn->query($loc_query);
                    $row = $loc_sql->fetch_assoc();
                    echo $loc = $row["location"]; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div>Phone Number</div>
                                    <div><?php echo $phone; ?>
                                    </div>
                                </div>
                            </form>
                        </div><br /><br /><?php
                } ?>
                    </div>
                </div>

            </div>
            <!--end of row -->

            <div class="panel-footer">&copy;
                <?php echo date("Y"); ?>
            </div>

        </div>


        </div>
    </body>

    </html>