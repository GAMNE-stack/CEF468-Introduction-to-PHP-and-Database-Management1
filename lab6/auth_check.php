 <?php

// Start session if not already started
if (!isset($_SESSION)) {
    session_start();
}

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Store the requested URL for redirect after login
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login page
    header('Location: login.php');
    exit();
}

// Optional: Check for session expiration (30 minutes)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header('Location: login.php?expired=1');
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();

// Optional: Database connection check (make sure db_setup.php is included first)
if (isset($conn)) {
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        session_unset();
        session_destroy();
        header('Location: login.php?invalid=1');
        exit();
    }
    $stmt->close();
}
?>