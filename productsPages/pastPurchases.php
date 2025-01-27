<?php 
include('../include/connection.php');
include('../include/header.php'); 

// Start the session
session_start();

// Check if the past purchases cookie is set
if(isset($_COOKIE['past_purchases'])) {
    // Retrieve past purchases from cookie
    $pastPurchasesSerialized = $_COOKIE['past_purchases'];
    $pastPurchases = unserialize($pastPurchasesSerialized);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THAMEEN- Past Purchases</title>
    <link rel="stylesheet" href="products-style.css">
    <?php include("../include/fonts.html"); ?>
</head>
<body>
    <div class="containerp">
        <h1>Past Purchases</h1>
        <br> 
        <table>
            <thead>
                <tr>
                    <th class="tobLeftRedius">Order Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pastPurchases as $purchase): ?>
                <tr>
                    <td><?php echo rand(100, 999); ?></td>
                    <td><?php echo date('Y-m-d'); ?></td>
                    <td><?php echo date('H:i:s'); ?></td>
                    <td><?php echo isset($purchase['product_name']) ? $purchase['product_name'] : ''; ?></td>
                    <td><?php echo isset($purchase['quantity']) ? $purchase['quantity'] : ''; ?></td>
                    <td>
                        <?php 
                        // Calculate total price
                        if(isset($purchase['quantity']) && isset($purchase['price'])) {
                            $totalPrice = $purchase['quantity'] * $purchase['price'];
                            echo $totalPrice;
                        } else {
                            echo '';
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php 
} else {
    // If there are no past purchases, display a message
    echo "<h1>No past purchases available.</h1>";
}
include('../include/footer.php'); 
?>
