 <?php
require_once 'vendor/autoload.php';

// Initialize the Google Client with provided credentials
$client = new Google_Client();
$client->setClientId = getenv("GOOGLE_CLIENT_ID");
$client->setClientSecret = getenv('GOOGLE_CLIENT_SECRET');
$client->setRedirectUri = getenv('GOOGLE_REDIRECT_URI');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        // Get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;

        // Check if user exists in database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // User doesn't exist, create new account
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, 'oauth_user', 0)");
            $stmt->bind_param("ss", $name, $email);
            $stmt->execute();
        }

        // Start session and redirect
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['oauth'] = true;
        
        header('Location: library.php');
        exit;
    } catch (Exception $e) {
        // Log error and redirect to login page
        error_log("Google OAuth error: " . $e->getMessage());
        header('Location: login.php?error=oauth');
        exit;
    }
} else {
    // If no authorization code, redirect to login
    header('Location: login.php');
    exit;
}
?>