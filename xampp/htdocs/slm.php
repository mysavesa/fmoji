<?php
include __DIR__.'/config.php';
$sql = "SELECT * FROM emojistore";
$p="";
$t=0;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
        $t=$t+1;
        if($row["emotion"]=="nu"){
            $emot="neutral";
        } elseif($row["emotion"]=="sa"){
            $emot="sad";
        } elseif($row["emotion"]=="ha"){
            $emot="happy";
        } elseif($row["emotion"]=="su"){
            $emot="surprise";
        } elseif($row["emotion"]=="an"){
            $emot="anger";
        } elseif($row["emotion"]=="fe"){
            $emot="fear";
        } elseif($row["emotion"]=="di"){
            $emot="disgust";
        }
        $p.="('".$row["unichar"]."', '".$row["emotion"]."', ".$row["perdown"].", ".$row["perup"]."),<br>";
    }
}
$p=substr($p, 0, -5);
$p.=chr(59);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
        <?php
            echo $p;
        ?>
</body>
</html>