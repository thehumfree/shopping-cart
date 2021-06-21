<?php
include_once("../db/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../custom/shoppingcart.css">

</head>

<body>
    <div class="container-fluid">
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
                            <li><a href="./buyerProfile.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                            </li>
                            <li><a href=""><span class="glyphicon glyphicon-user"></span> View Profile</a></li>
                            <li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control"
                                    id="search"></li>
                            <li style="top:4px;left:10px;"><button id="search_btn">Search</button></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <p><br /> </p>
            </div>
            <div class="row">
                <p><br /> </p>
            </div>

            <!--Table Content-->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Cart Checkout</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-xs-3"><b>Product Image</b></div>
                                <div class="col-md-3 col-xs-3"><b>Product Name</b></div>
                                <div class="col-md-3 col-xs-3"><b>Quantity</b></div>
                                <div class="col-md-3 col-xs-3"><b>Product Price In Naira</b></div>
                            </div>
                            <div id="cart_checkout"></div>
                            <?php
                                if ($_SESSION["cart"]) {
                                    $pid = array_column($_SESSION["cart"], "pid");
                                    $query = "SELECT * FROM product";
                                    $sql = $conn->query($query);
                                    $total = 0;
                                    while ($row = $sql->fetch_assoc()) {
                                        foreach ($pid as $id) {
                                            if ($row["pid"] == $id) {
                                                echo "<div class='row'>
<form action='shoppingcart.php?remove=$row[pid] method='post'>
                                            <div class='col-md-3'><img
                                                 width='100px'   src='../images/$row[image]'>
                                            </div>
                                            <div class='col-md-3'>$row[product_name]
                        </div>
                        <div class='col-md-3'><input type='text' class='form-control w-25 d-inline' value='1'></div>
                        <div class='col-md-3'>N$row[price]
                        </div>
                        </form>
                    </div>";
                                                $total = $total + $row["price"];
                                            }
                                        }
                                    }
                                }
                    ?>

                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <b>Total N<?php echo $total; ?>
                                    </b>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>