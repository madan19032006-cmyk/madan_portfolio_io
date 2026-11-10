<?php
require_once "db.php";
$search = trim($_GET["search"] ?? "");
if ($search !== "") {
    $stmt = mysqli_prepare($conn, "SELECT * FROM crops WHERE crop_name LIKE ? OR season LIKE ? ORDER BY id DESC");
    $like = "%".$search."%"; mysqli_stmt_bind_param($stmt, "ss", $like, $like); mysqli_stmt_execute($stmt); $result = mysqli_stmt_get_result($stmt);
} else { $result = mysqli_query($conn, "SELECT * FROM crops ORDER BY id DESC"); }
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Crops | AgriCare</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav><a href="index.php">Dashboard</a><a class="active" href="crops.php">Crops</a><a href="farmers.php">Farmers</a><a href="sales.php">Sales</a></nav></header>
<main class="container"><div class="page-heading"><div><p class="eyebrow">FARM RECORDS</p><h1>Crop Management</h1><p>Add, search and manage your crop details.</p></div><a class="btn" href="crop_add.php">+ Add Crop</a></div>
<form class="searchbar" method="get"><input name="search" placeholder="Search crop or season..." value="<?php echo htmlspecialchars($search); ?>"><button class="btn" type="submit">Search</button><a class="btn btn-light" href="crops.php">Clear</a></form>
<div class="panel table-wrap"><table><thead><tr><th>ID</th><th>Crop Name</th><th>Season</th><th>Quantity (kg)</th><th>Price (₹/kg)</th><th>Planting Date</th><th>Actions</th></tr></thead><tbody>
<?php if (mysqli_num_rows($result)) { while($r=mysqli_fetch_assoc($result)) { ?><tr><td><?php echo $r["id"]; ?></td><td><strong><?php echo htmlspecialchars($r["crop_name"]); ?></strong></td><td><?php echo htmlspecialchars($r["season"]); ?></td><td><?php echo number_format((float)$r["quantity_kg"],2); ?></td><td>₹<?php echo number_format((float)$r["price_per_kg"],2); ?></td><td><?php echo htmlspecialchars($r["planting_date"]); ?></td><td><a class="action danger" href="crop_delete.php?id=<?php echo $r["id"]; ?>" onclick="return confirm('Delete this crop?')">Delete</a></td></tr><?php }} else { ?><tr><td colspan="7">No crop records found.</td></tr><?php } ?>
</tbody></table></div></main><footer>© <?php echo date("Y"); ?> AgriCare</footer></body></html>