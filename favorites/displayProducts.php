<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Display</title>
  <style>
    .product {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 10px;
      max-width: 200px;
    }
    .product img {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <h1>Product Display</h1>
  <div id="product-list">
    <?php
   $servername = "localhost";  
   $username = "uhgzzx2ryg6tv";       
   $password = "1Lcc4%24b.N$";      
   $dbname = "dbdckcz3xmjl3w"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to fetch data
    $sql = "SELECT title, source, pricing, image FROM product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<p>Name: ' . htmlspecialchars($row["title"]) . '</p>';
            echo '<p>Price: ' . htmlspecialchars($row["pricing"]) . '</p>';
            echo '<p>URL: <a href="' . htmlspecialchars($row["source"]) . '" target="_blank">Product Link</a></p>';
            echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
    ?>
  </div>
</body>
</html>
