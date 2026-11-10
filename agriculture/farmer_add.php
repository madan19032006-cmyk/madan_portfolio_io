<?php
require_once "db.php"; $error="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
$name=trim($_POST["farmer_name"]??""); $phone=trim($_POST["phone"]??""); $location=trim($_POST["location"]??""); $land=(float)($_POST["land_acres"]??0);
if($name===""){$error="Farmer name is required.";}else{
$stmt=mysqli_prepare($conn,"INSERT INTO farmers (farmer_name, phone, location, land_acres) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt,"sssd",$name,$phone,$location,$land);
if(mysqli_stmt_execute($stmt)){header("Location: farmers.php");exit;} $error="Could not save farmer.";
}}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Add Farmer | AgriCare</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav><a href="index.php">Dashboard</a><a href="crops.php">Crops</a><a class="active" href="farmers.php">Farmers</a><a href="sales.php">Sales</a></nav></header>
<main class="container narrow"><div class="page-heading"><div><p class="eyebrow">PEOPLE</p><h1>Register Farmer</h1></div></div><?php if($error!=="") echo '<div class="alert">'.htmlspecialchars($error).'</div>';?>
<form class="panel form-grid" method="post"><label class="full">Farmer Name *<input name="farmer_name" required></label><label>Phone<input name="phone" maxlength="20"></label><label>Village / Location<input name="location"></label><label>Land Size (acres)<input type="number" name="land_acres" min="0" step="0.01" value="0"></label><div class="form-actions full"><button class="btn">Save Farmer</button><a class="btn btn-light" href="farmers.php">Cancel</a></div></form></main><footer>© <?php echo date("Y"); ?> AgriCare</footer></body></html>