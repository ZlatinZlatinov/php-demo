<section id="catalog">
    <h2>This is Catalog Page</h2>

    <div class="width-wrapper">
        <?php
        try {
            include("./connect_db.php");

            $sql = "SELECT * FROM books";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $imageData = $row["image"];
                    $id = $row["id"];
                    $title = $row["title"];
                    $author = $row["author"];

                    echo "
                        <div class='card'>
                            <a href='./details?id={$id}'>" .
                            '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Uploaded Image">'.
                            "<h3>{$title}</h3> 
                            <h4>{$author}</h4>
                        </a>
                    </div>
                        ";
                }
            } else {
                echo "<h3>No results were found</h3>";
            }
        
        } catch(mysqli_sql_exception) {
            echo "Oops something went wrong during selection from db";
        }
        
        ?>
    </div>
</section>