<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog_db"; 

$blogTitle = $_POST["blogtitle"] ?? '';
$blogDate  = $_POST["blogdate"] ?? '';
$blogPara  = $_POST["blogpara"] ?? '';

$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error) die("Connection to database failed: " . $conn->connect_error);

$filename = "NONE";
if(isset($_FILES['uploadimage']) && $_FILES['uploadimage']['name'] !== ""){
    $filename = $_FILES['uploadimage']['name'];
    $tempname = $_FILES['uploadimage']['tmp_name'];
    move_uploaded_file($tempname, "images/" . $filename);
}

$sql = "INSERT INTO blog_table (topic_title, topic_date, image_filename, topic_para) 
        VALUES ('" . $conn->real_escape_string($blogTitle) . "', 
                '" . $conn->real_escape_string($blogDate) . "', 
                '" . $conn->real_escape_string($filename) . "', 
                '" . $conn->real_escape_string($blogPara) . "')";
                
if($conn->query($sql) !== TRUE){
    echo "Error Saving Post: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Post Saved</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
    background: radial-gradient(circle at top,#f5f5f7,#e5e5ea);
    color: #1d1d1f;
    display: flex;
    justify-content: center;
    padding: 40px 15px;
}
@media (prefers-color-scheme: dark) {
    body {
        background: radial-gradient(circle at top,#1c1c1f,#0b0b0d);
        color: #f5f5f7;
    }
}
.container {
    width: 50%;
    text-align: justify;
    background: rgba(255,255,255,0.55);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border-radius: 28px;
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    padding: 30px;
}
h1 {
    text-align: center;
    margin-bottom: 20px;
}
#homeBtn {
    display: inline-block;
    padding: 12px 25px;
    border-radius: 999px;
    background: #0071e3;
    color: white;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
#homeBtn:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(0,113,227,0.4);
}
#showImage {
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    max-width: 100%;
    height: auto;
}
</style>
</head>
<body>

<div class="container">
    <h1>Post Saved</h1>

    <!-- Active MacOS-style Home Button -->
    <center>
        <form action="index.php" method="get">
            <button type="submit" id="homeBtn">← Go to Home Page</button>
        </form>
    </center>

    <br><br>
    <span style="font-weight: bold;" id="showTitle"><?=htmlspecialchars($blogTitle)?></span><br>
    <span id="showDate"><?=htmlspecialchars($blogDate)?></span><br><br>

    <?php if($filename !== "NONE"): ?>
        <center>
            <img src="images/<?=htmlspecialchars($filename)?>" id="showImage">
        </center>
    <?php endif; ?>

    <br>
    <span id="showPara"><?=htmlspecialchars($blogPara)?></span>
    <br><br>
</div>

</body>
</html>
