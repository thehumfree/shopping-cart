<?php
include_once("../db/db.php");
if(!$_SESSION["id"]){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Farmer Profile</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../custom/farmerProfile.css">

	</head>
<body>
	
	<div class="hero">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">	
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
						<span class="sr-only"> navigation toggle</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
			<!-- Navbar content -->
			<a href="./farmerProfile.php" class="navbar-brand">Adedoyin Farms</a>
				</div>       
	
				<div class="collapse navbar-collapse" id="collapse">
					<ul class="nav navbar-nav">
						<li><a href="./farmerProfile.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
						<li><a href="./addProduct.php"><span class="glyphicon glyphicon-tasks"></span> Add Product</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					</ul>
			  </div>       
		 </div>
		</div>
		<p><br/></p>
		<p><br/></p>
		<p><br/></p>
			<!-- Table content -->
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Product List</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 col-xs-3"><b>S/No</b></div>
							<div class="col-md-3 col-xs-3"><b>Product Image</b></div>
							<div class="col-md-3 col-xs-3"><b>Product Name</b></div>
							<div class="col-md-3 col-xs-3"><b>Product Price In Naira</b></div>
						</div>
						
                        <div id="cart_product"></div>
						<?php 
                        $seller = $_SESSION["id"];
                        $query ="SELECT * FROM product WHERE farmer_id = $seller";
                        $sql = $conn->query($query);
						$count = 1;
						while($row = $sql->fetch_assoc()){
                            $pname = $row["product_name"];
							$image = $row["image"];
                            $price = $row["price"];
                            echo "<div class='row'>";
                            echo "<div class='col-md-3'>$count</div>";
                            echo "<div class='col-md-3'><img src='../images/$image' width='50px' height='50px' /></div>";
                            echo "<div class='col-md-3'>$pname</div>";
                            echo "<div class='col-md-3'>$price</div>";
                            echo "</div>";
							 ?>
							<?php	$count++; } ?>
						 <!--<div class="row">
							<div class="col-md-3">S/No</div>
							<div class="col-md-3">Product Image</div>
							<div class="col-md-3">Product Name</div>
							<div class="col-md-3">Price in Naira.</div>
						</div>-->

						</div> 
					<div class="panel-footer">&copy; <?php echo date("Y"); ?></div>
				</div>
			</div>
        </div>
	</div>

</body>
</html>
















































