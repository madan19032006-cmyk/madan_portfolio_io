<?php
require_once "db.php"; $error="";
$crops=mysqli_query($conn,"SELECT id,crop_name FROM crops ORDER BY crop_name");
if($_SERVER["REQUEST_METHOD"]==="POST"){
$crop=(int)($_POST["crop_id"]??0);$buyer=trim($_POST["buyer_name"]??"");$qty=(float)($_POST["quantity_kg"]??0);$amount=(float)($_POST["amount"]??0);$date=$_POST["sale_date"]??"";
if($crop<1||$buyer===""||$qty<=0||$amount<0||$date===""){$error="Complete all required fields with valid amounts.";}else{
$stmt=mysqli_prepare($conn,"INSERT INTO sales (crop_id,buyer_name,quantity_kg,amount,sale_date) VALUES (?,?,?,?,?)");
mysqli_stmt_bind_param($stmt,"isdds",$crop,$buyer,$qty,$amount,$date);
if(mysqli_stmt_execute($stmt)){header("Location: sales.php");exit;} $error="Could not save sale. Add a crop first if none exists.";
}}
$crops2=mysqli_query($conn,"SELECT id,crop_name FROM crops ORDER BY crop_name");
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Record Sale | AgriCare</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav><a href="index.php">Dashboard</a><a href="crops.php">Crops</a><a href="farmers.php">Farmers</a><a class="active" href="sales.php">Sales</a></nav></header>
<main class="container narrow"><div class="page-heading"><div><p class="eyebrow">INCOME TRACKING</p><h1>Record Crop Sale</h1></div></div><?php if($error!=="")echo '<div class="alert">'.htmlspecialchars($error).'</div>';?>
<form class="panel form-grid" method="post"><label class="full">Crop *<select name="crop_id" required><option value="">Select crop</option><?php while($c=mysqli_fetch_assoc($crops2)){?><option value="<?php echo $c["id"]; ?>"><?php echo htmlspecialchars($c["crop_name"]); ?></option><?php } ?></select></label><label class="full">Buyer Name *<input name="buyer_name" required></label><label>Quantity Sold (kg) *<input type="number" name="quantity_kg" min="0.01" step="0.01" required></label><label>Total Amount (₹) *<input type="number" name="amount" min="0" step="0.01" required></label><label class="full">Sale Date *<input type="date" name="sale_date" value="<?php echo date("Y-m-d"); ?>" required></label><div class="form-actions full"><button class="btn">Save Sale</button><a class="btn btn-light" href="sales.php">Cancel</a></div></form></main><footer>© <?php echo date("Y"); ?> AgriCare</footer></body></html>