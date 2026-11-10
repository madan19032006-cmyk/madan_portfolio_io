<?php
require_once "db.php";
$totalCrops = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM crops"))["total"];
$totalFarmers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM farmers"))["total"];
$totalSales = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM sales"))["total"];
$recent = mysqli_query($conn, "SELECT * FROM crops ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>AgriCare | Agriculture Management</title><link rel="stylesheet" href="style.css"></head>
<body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav>
<a class="active" href="index.php">Dashboard</a><a href="crops.php">Crops</a><a href="farmers.php">Farmers</a><a href="sales.php">Sales</a>
</nav></header>
<main class="container">
<section class="hero"><div><p class="eyebrow">SMART FARMING, SIMPLE MANAGEMENT</p><h1>Welcome to AgriCare</h1><p>Manage crops, farmers and farm sales from one simple dashboard.</p><a class="btn" href="crop_add.php">+ Add Crop</a></div><div class="hero-icon">🌾</div></section>
<section class="stats">
<div class="stat"><span>🌿</span><p>Total Crops</p><strong><?php echo $totalCrops; ?></strong></div>
<div class="stat"><span>👨‍🌾</span><p>Registered Farmers</p><strong><?php echo $totalFarmers; ?></strong></div>
<div class="stat"><span>🧺</span><p>Sales Records</p><strong><?php echo $totalSales; ?></strong></div>
</section>
<section class="panel"><div class="panel-heading"><div><h2>Recently Added Crops</h2><p>Your latest crop records</p></div><a href="crops.php">View all →</a></div>
<div class="table-wrap"><table><thead><tr><th>Crop</th><th>Season</th><th>Quantity (kg)</th><th>Expected Price (₹/kg)</th></tr></thead><tbody>
<?php if (mysqli_num_rows($recent) > 0) { while ($row = mysqli_fetch_assoc($recent)) { ?>
<tr><td><strong><?php echo htmlspecialchars($row["crop_name"]); ?></strong></td><td><?php echo htmlspecialchars($row["season"]); ?></td><td><?php echo number_format((float)$row["quantity_kg"], 2); ?></td><td>₹<?php echo number_format((float)$row["price_per_kg"], 2); ?></td></tr>
<?php }} else { ?><tr><td colspan="4">No crops added yet. <a href="crop_add.php">Add your first crop</a>.</td></tr><?php } ?>
</tbody></table></div></section>
<div class="quick-links"><a href="crop_add.php">＋ Add crop</a><a href="farmer_add.php">＋ Register farmer</a><a href="sale_add.php">＋ Record sale</a></div>
</main><footer>© <?php echo date("Y"); ?> AgriCare Agriculture Management System</footer></body></html>