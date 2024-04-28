<section id="login" class="width-wrapper">
    <h2>This is Login Page</h2>

    <div class="form-container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="form">
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

            <input type="submit" class="submit-btn" value="Login">
        </form>
    </div>
</section>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "./verify.php";
    if (verifyUser()) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //$_POST["email"];
        $password = $_POST["password"];

        if (!empty($email) && !empty($password)) {

            include("./connect_db.php");
            $sql = "SELECT `id`, `username`, `email`, `password` FROM users WHERE `email` = '{$email}'";

            try {
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    if($row["email_verified_at"] == null){
                        if (password_verify($password, $row["password"])) {
                            $_SESSION["isLogged"] = true;
                            $_SESSION["username"] = $row["username"];
                            $_SESSION["user_id"] = $row["id"];
    
                            header("Location: ./home");
                        } else {
                            echo "Wrong username or password";
                        }
                    } else {
                        header("Location: ./email-verification?email={$email}");
                    }

                    // mysqli_close($connection);
                } else {
                    echo "Wrong username or password";
                }
            } catch (mysqli_sql_exception) {
                echo "Wrong username or password";
                die("Oops something went wrong " . mysqli_connect_error());
            }

            mysqli_close($connection);
        } else {
            echo "Enter valid Email addres";
        }
    } else {
        echo "You are robot!";
    }
}

?>