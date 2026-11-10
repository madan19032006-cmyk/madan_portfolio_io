<?php
require_once "db.php";
$result = mysqli_query($conn, "SELECT * FROM farmers ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Farmers | AgriCare</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav><a href="index.php">Dashboard</a><a href="crops.php">Crops</a><a class="active" href="farmers.php">Farmers</a><a href="sales.php">Sales</a></nav></header>
<main class="container"><div class="page-heading"><div><p class="eyebrow">PEOPLE</p><h1>Farmer Management</h1><p>Register farmers and keep their contact details.</p></div><a class="btn" href="farmer_add.php">+ Add Farmer</a></div>
<div class="panel table-wrap"><table><thead><tr><th>ID</th><th>Farmer Name</th><th>Phone</th><th>Village / Location</th><th>Land (acres)</th></tr></thead><tbody>
<?php if(mysqli_num_rows($result)){while($r=mysqli_fetch_assoc($result)){?><tr><td><?php echo $r["id"]; ?></td><td><strong><?php echo htmlspecialchars($r["farmer_name"]); ?></strong></td><td><?php echo htmlspecialchars($r["phone"]); ?></td><td><?php echo htmlspecialchars($r["location"]); ?></td><td><?php echo number_format((float)$r["land_acres"],2); ?></td></tr><?php }}else{?><tr><td colspan="5">No farmers registered yet.</td></tr><?php } ?>
</tbody></table></div></main><footer>© <?php echo date("Y"); ?> AgriCare</footer></body></html>