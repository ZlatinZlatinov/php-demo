<section id="verify-email" class="width-wrapper">
    <h2>This is email verification page</h2>
    
    <div class="form-container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <p>We sent you an email with verification code.</p> 
        <div>
            <input type="hidden" name="email" value="<?php echo $_GET['email']?>">
        </div> 

        <div>
            <label for="verification_code">Enter Your Verification Code</label>
            <input type="text" name="verification_code" id="verification_code">
        </div>

        <input type="submit" value="Verify">
        </form>
    </div>
</section> 

<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"]; 
        $verification_code = $_POST["verification_code"]; 

        include './connect_db.php'; 

        $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '{$email}' AND verification_code = '{$verification_code}'"; 
        $result = mysqli_query($connection, $sql); 

        if(mysqli_affected_rows($connection) == 0) {
            die('Verification failed');
        } 

        header("Location: ./login");
    }
?>