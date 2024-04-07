<header>
    <nav class="width-wrapper">
        <ul>
            <li><a href="./">Home</a></li>
            <li><a href="./about">About</a></li>
            <li><a href="./catalog">Catalog</a></li>
            <?php
            if (isset($_SESSION["isLogged"])) {
                echo '<li><a href="./create">Create</a></li>';
                echo '<li><a href="./logout">Logout</a></li>';
            } else {
                echo '<li><a href="./login">Login</a></li>';
                echo '<li><a href="./register">Register</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>