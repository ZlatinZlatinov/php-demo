<section id="catalog">
    <h2>This is Catalog Page</h2>

    <div class="width-wrapper">
        <?php
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
                        <a href='./details'>" .
                        '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Uploaded Image">'.
                        "<h3>{$title}</h3> 
                        <h4>{$author}</h4>
                    </a>
                </div>
                    ";
            }
        } else {
            echo "No results we found";
        }
        ?>
    </div>
</section>