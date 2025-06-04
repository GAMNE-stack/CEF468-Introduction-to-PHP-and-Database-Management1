 <?php
function auth_check() {
    session_start();
    
    // Check if user is logged in
    if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
        exit;
    }
    
    // Check session timeout (30 minutes)
    if (isset($_SESSION['last_activity']) {
        $inactive = 1800; // 30 minutes in seconds
        $session_life = time() - $_SESSION['last_activity'];
        if ($session_life > $inactive) {
            session_unset();
            session_destroy();
            header('Location: login.php?timeout=1');
            exit;
        }
    }
    $_SESSION['last_activity'] = time();
    
    // For non-OAuth users, verify session validity
    if (!isset($_SESSION['oauth'])) {
        require_once 'db_setup.php';
        
        $email = $_SESSION['user_email'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            session_unset();
            session_destroy();
            header('Location: login.php?invalid=1');
            exit;
        }
    }
}

// Function to check admin role
function admin_check() {
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
        header('Location: library.php?unauthorized=1');
        exit;
    }
}
?>