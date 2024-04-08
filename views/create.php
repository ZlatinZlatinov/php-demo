<section id="create" class="width-wrapper">
    <h2>This is Create page</h2>

    <div class="form-container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="form" enctype="multipart/form-data">
            <div>
                <label for="title">Book Title</label>
                <input type="text" name="title" id="title">
            </div>

            <div>
                <label for="author">Book Author</label>
                <input type="text" name="author" id="author">
            </div>

            <div>
                <label for="pages">Pages</label>
                <input type="number" name="pages" id="pages">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>

            <div>
                <label for="image">Choose Book Image</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>

            <input type="submit" class="submit-btn" value="Create">
        </form>
    </div>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
    $pages = filter_input(INPUT_POST, "pages", FILTER_SANITIZE_NUMBER_INT);
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
    $owner_id = $_SESSION["user_id"];

    if (isset($title)  && isset($author) && isset($description) && $_FILES["image"]["error"] == 0) {
        $img = $_FILES["image"]["tmp_name"];
        $imgContent = file_get_contents($img);

        include("./connect_db.php");
        $sql = "INSERT INTO books(title, author, pages, description, image, owner_id) VALUES('{$title}', '{$author}', '{$pages}', '{$description}', ? , '{$owner_id}')";

        try {
            $statement = $connection->prepare($sql);
            $statement->bind_param('s', $imgContent);
            $current_id = $statement->execute() or die("<b>Error </b>" . mysqli_connect_error());

            header("Location: ./catalog");
        } catch (mysqli_sql_exception) {
            die("Oops something went wrong " . mysqli_connect_error());
        }

        mysqli_close($connection);
    } else {
        echo "Pleased enter valid fields!";
    }
}
?>