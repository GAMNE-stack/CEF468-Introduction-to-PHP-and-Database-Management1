 <?php
require_once 'vendor/autoload.php';

// Initialize the Google Client with provided credentials
$client = new Google_Client();
$client->setClientId('GOOGLE_CLIENT_ID');
$client->setClientSecret('GOOGLE_CLIENT_SECRET');
$client->setRedirectUri('GOOGLE_REDIRECT_URI');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    header('Location: google_auth.php');
    exit;
}

// Display login page with Google button
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login with Google</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .login-container { max-width: 400px; margin: 0 auto; text-align: center; }
        .google-btn { 
            background-color: #4285F4; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            font-size: 16px;
        }
        .google-btn:hover { background-color: #357ABD; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login with Google</h2>
        <a href="<?= $client->createAuthUrl() ?>" class="google-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" 
                 alt="Google logo" style="width: 20px; margin-right: 10px;">
            Sign in with Google
        </a>
        <p>Or <a href="login.php">login with email</a></p>
    </div>
</body>
</html>