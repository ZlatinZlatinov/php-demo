<section>
    <h2>This is Home Page</h2>

    <?php
    if (isset($_SESSION["isLogged"])) {
        $username = $_SESSION["username"];
        echo "<h3>Welcome {$username}";
    }
    ?>
</section>