<?php
// Include necessary files and start session
include('../include/connection.php');

// Function to get the total number of items in the cart
function getCartItemCount()
{
    if (isset($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}

// Get the cart item count
$cartItemCount = getCartItemCount();
?>

<link rel="stylesheet" href="products-style.css">

<style>
    nav ul li a:hover {
        color: #E09453;
        font-weight: bolder;
    }
</style>
<header>
    <div class="logo">
        <a href="..\mainPages\home-page.php"> <img src="..\assets\Thameen-Logo\4.png" height="50" alt="Thameen Jewelry Logo"></a>
    </div>
    <nav>
        <ul>
            <li><a href="../mainPages/home-page.php">Home</a></li>
            <li><a href="../mainPages/home-page.php">About</a></li>
            <li><a href="../productsPages/products-page.php">Products</a></li>
            <li><a href="../mainPages/contact-us-page.php">Contact Us</a></li>
            <li><a href="../productsPages/PastPurchases.php">Past Purchases</a></li>
            <li><a href="../productsPages/cart-page.php"><img src="../assets/header-Icon/Cart.png" height="20" alt="cart" top="2"></a><span><?php echo $cartItemCount; ?></span></li>
            <li><a href="../mainPages/login-page.php"><img src="../assets/header-Icon/account.png" height="20" alt="Account" top="2"></a></li>
        </ul>
    </nav>
</header>
