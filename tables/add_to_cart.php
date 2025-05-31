<?php 



// INPUT (usually comes from frontend via POST)
$table_id = $table_number;
$product_id = $_GET['prdct-id'];
$quantity = "1";
$customer_name =$_SESSION['customer_name'] ?? null;
$customer_mobile =  $_SESSION['customer_mobile_number'] ?? null;

// Step 1: Check if cart session exists for table
$sql = "SELECT id FROM cart_sessions WHERE table_id = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$table_id]);
$cart_session = $stmt->fetch();

if ($cart_session) {
    $cart_session_id = $cart_session['id'];
} else {
    // Step 2: Create new cart session
    $insert = "INSERT INTO cart_sessions (table_id, customer_name, customer_mobile) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($insert);
    $stmt->execute([$table_id, $customer_name, $customer_mobile]);
    $cart_session_id = $pdo->lastInsertId();
}

// Step 3: Check if product already in cart
$sql = "SELECT id FROM cart_items WHERE cart_session_id = ? AND product_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cart_session_id, $product_id]);

if ($stmt->rowCount() > 0) {
    // Update quantity
    $update = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_session_id = ? AND product_id = ?";
    $stmt = $pdo->prepare($update);
    $stmt->execute([$quantity, $cart_session_id, $product_id]);
} else {
    // Insert new item
    $insert = "INSERT INTO cart_items (cart_session_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($insert);
    $stmt->execute([$cart_session_id, $product_id, $quantity]);
}

?>