<?php
require_once "db.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["crop_name"] ?? "");
    $season = trim($_POST["season"] ?? "");
    $quantity = (float)($_POST["quantity_kg"] ?? 0);
    $price = (float)($_POST["price_per_kg"] ?? 0);
    $date = $_POST["planting_date"] ?? "";
    $notes = trim($_POST["notes"] ?? "");
    if ($name === "" || $season === "" || $quantity < 0 || $price < 0) {
        $error = "Please enter a crop name, season, and valid non-negative amounts.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO crops (crop_name, season, quantity_kg, price_per_kg, planting_date, notes) VALUES (?, ?, ?, ?, NULLIF(?, ''), ?)");
        mysqli_stmt_bind_param($stmt, "ssddss", $name, $season, $quantity, $price, $date, $notes);
        if (mysqli_stmt_execute($stmt)) { header("Location: crops.php"); exit; }
        $error = "Could not save crop: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Add Crop | AgriCare</title><link rel="stylesheet" href="style.css"></head><body>
<header class="topbar"><div class="brand">🌱 AgriCare</div><nav><a href="index.php">Dashboard</a><a class="active" href="crops.php">Crops</a><a href="farmers.php">Farmers</a><a href="sales.php">Sales</a></nav></header>
<main class="container narrow"><div class="page-heading"><div><p class="eyebrow">FARM RECORDS</p><h1>Add New Crop</h1><p>Enter the crop information below.</p></div></div>
<?php if($error!=="") echo '<div class="alert">'.htmlspecialchars($error).'</div>'; ?>
<form class="panel form-grid" method="post"><label>Crop Name *<input name="crop_name" required placeholder="e.g. Rice"></label>
<label>Season *<select name="season" required><option value="">Select season</option><option>Kharif</option><option>Rabi</option><option>Zaid</option><option>All Season</option></select></label>
<label>Quantity (kg) *<input type="number" name="quantity_kg" min="0" step="0.01" required></label><label>Expected Price (₹/kg) *<input type="number" name="price_per_kg" min="0" step="0.01" required></label>
<label>Planting Date<input type="date" name="planting_date"></label><label class="full">Notes<textarea name="notes" rows="3" placeholder="Optional notes"></textarea></label>
<div class="form-actions full"><button class="btn" type="submit">Save Crop</button><a class="btn btn-light" href="crops.php">Cancel</a></div></form></main><footer>© <?php echo date("Y"); ?> AgriCare</footer></body></html>