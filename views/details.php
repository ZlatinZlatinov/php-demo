<section id="details">
    <h2>This is Details Page</h2>

    <?php 
         try {
            include("./connect_db.php"); 
            
            $id = $_GET["id"];
            $sql = "SELECT * FROM books WHERE id = {$id}"; 
            $result = mysqli_query($connection, $sql); 

            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result); 
                $title = $row["title"]; 
                $imageData = $row["image"];

                echo "<h3>$title</h3>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Uploaded Image">';
                echo "<a href='./edit?id={$id}'>Edit</a>";
            } else {
                header("Location: ./404");
            }

        }catch(mysqli_sql_exception){
            http_response_code(404);
            header("Location: ./404");
            // die("Connection failed: " . $connection->connect_error);
        }
    ?>
</section> 