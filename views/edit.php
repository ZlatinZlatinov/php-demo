<section id="edit" class="width-wrapper">
    <h2>This is Edit page</h2>
    <?php
    include("./connect_db.php");
    $id = $_GET["id"];
    $sql = "SELECT * FROM books WHERE id = {$id}";
    $result = mysqli_query($connection, $sql);

    $row = mysqli_fetch_assoc($result);
    $title = $row["title"];
    $author = $row["author"];
    $pages = $row["pages"];
    $description = $row["description"];

    echo '<div class="form-container">
        <form action="./edit?id='.$id.'" method="post" id="form" enctype="multipart/form-data">
            <div>
                <label for="title">Book Title</label>
                <input type="text" name="title" id="title" value="'.$title.'">
            </div>

            <div>
                <label for="author">Book Author</label>
                <input type="text" name="author" id="author" value="'.$author.'">
            </div>

            <div>
                <label for="pages">Pages</label>
                <input type="number" name="pages" id="pages" value="'.$pages.'">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10">'.$description.'</textarea>
            </div>

            <input type="submit" class="submit-btn" value="Edit">
        </form>
    </div>';

    ?>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
    $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
    $pages = filter_input(INPUT_POST, "pages", FILTER_SANITIZE_NUMBER_INT);
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($title)  && isset($author) && isset($description)) {
        // $img = $_FILES["image"]["tmp_name"];
        // $imgContent = file_get_contents($img);
        echo $request = parse_url($_SERVER['REQUEST_URI'])["id"];
        include("./connect_db.php");
        $sql = "UPDATE books SET `title` = `{$title}`, `author` = `{$author}`, `description` = `{$description}` WHERE `id`= `{$id}`";

        try {
            // $statement = $connection->prepare($sql);
            // $statement->bind_param('s', $imgContent);
            // $current_id = $statement->execute() or die("<b>Error </b>" . mysqli_connect_error());
            mysqli_query($connection, $sql);

            header("Location: ./details?id={$id}");
        } catch (mysqli_sql_exception) {
            echo $connection->connect_error;
            die("Oops something went wrong " . mysqli_connect_error());
        }

        mysqli_close($connection);
    } else {
        echo "Pleased enter valid fields!";
    }
}
?>