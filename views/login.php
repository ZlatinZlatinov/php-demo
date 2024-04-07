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

            <input type="submit" class="submit-btn" value="Login">
        </form>
    </div>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //$_POST["email"];
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {

        include("./connect_db.php");
        $sql = "SELECT `username`, `email`, `password` FROM users WHERE `email` = '{$email}'";

        try {
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result); 

                if(password_verify($password, $row["password"])){
                    $_SESSION["isLogged"] = true;
                    $_SESSION["username"] = $row["username"];

                    header("Location: ./home");
                } else {
                    echo "Wrong username or password";
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
}

?>