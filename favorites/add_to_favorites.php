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

// Retrieve data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$link = $data['link'];
$price = $data['price'];
$image = $data['image'];

// Check if the product already exists
$stmt = $conn->prepare("SELECT * FROM product WHERE title = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Product already exists in favorites";
} else {
    // SQL to insert data using prepared statements
    $stmt = $conn->prepare("INSERT INTO product (title, source, pricing, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $link, $price, $image);
    if ($stmt->execute()) {
        echo "Product added to favorites successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>