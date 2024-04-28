<section id="register" class="width-wrapper">
    <h2>This is Register Page</h2>

    <div class="form-container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="form">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div>
                <div class="g-recaptcha" data-sitekey="6LfTOKMpAAAAAD4LXNpAWSlyz5xFFvcy2kqS3d2M"></div>
            </div>

            <input type="submit" class="submit-btn" value="Register">
        </form>
    </div>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "./verify.php";
    if(verifyUser()){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS); //$_POST["username"];
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //$_POST["email"];
        $password = $_POST["password"];
    
        if (!empty($username) || !empty($email) || !empty($age)) {
    
            include("./connect_db.php");
    
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
    
            $sql = "INSERT INTO users(username, email, password) VALUES('{$username}', '{$email}', '{$hashed_pass}')";
    
            try {
                mysqli_query($connection, $sql);
    
                $_SESSION["isLogged"] = true;
                $_SESSION["username"] = $username;
    
                header("Location: ./home");
            } catch (mysqli_sql_exception) {
                die("Oops something went wrong " . mysqli_connect_error($connection));
            }
    
    
            mysqli_close($connection);
        } else {
            echo "<div class='result'><h2>Wrong Input</h2></div>";
        }
    } else {
        echo "You are robot!";
    }
}
?>