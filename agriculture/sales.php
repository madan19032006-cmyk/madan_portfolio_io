<?php
require_once "db.php";
$sql="SELECT s.*, c.crop_name FROM sales s LEFT JOIN crops c ON s.crop_id=c.id ORDER BY s.id DESC";
$result=mysqli_query($conn,$sql);
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Sales | AgriCare</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav><a href="index.php">Dashboard</a><a href="crops.php">Crops</a><a href="farmers.php">Farmers</a><a class="active" href="sales.php">Sales</a></nav></header>
<main class="container"><div class="page-heading"><div><p class="eyebrow">INCOME TRACKING</p><h1>Farm Sales</h1><p>Track crop sales and buyer information.</p></div><a class="btn" href="sale_add.php">+ Record Sale</a></div>
<div class="panel table-wrap"><table><thead><tr><th>ID</th><th>Crop</th><th>Buyer</th><th>Quantity (kg)</th><th>Amount (₹)</th><th>Sale Date</th></tr></thead><tbody><?php if(mysqli_num_rows($result)){while($r=mysqli_fetch_assoc($result)){?><tr><td><?php echo $r["id"]; ?></td><td><?php echo htmlspecialchars($r["crop_name"]??"Crop removed"); ?></td><td><?php echo htmlspecialchars($r["buyer_name"]); ?></td><td><?php echo number_format((float)$r["quantity_kg"],2); ?></td><td>₹<?php echo number_format((float)$r["amount"],2); ?></td><td><?php echo htmlspecialchars($r["sale_date"]); ?></td></tr><?php }}else{?><tr><td colspan="6">No sales recorded yet.</td></tr><?php } ?></tbody></table></div></main><footer>© <?php echo date("Y"); ?> AgriCare</footer></body></html>