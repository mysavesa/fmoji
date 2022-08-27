<?php
include __DIR__.'/../config.php';
$sqlcom="SELECT * FROM results";
$sqlresult = mysqli_query($conn, $sqlcom);
if(mysqli_num_rows($sqlresult) > 0){
    $count=0;
    $tableofemo='<center><table style="width:100%"><tr><th>Sr. No.</th><th>ID</th><th>Emotion Name</th><th>Emotion Value</th><th>Created At</th><th>Scan by:</th><th>Links</th></tr>';
    while($row = mysqli_fetch_assoc($sqlresult)){
        $count=$count+1;
        $id=$row['id'];
        $emotion=$row['emotion'];
        $emopercentage=$row['emopercentage'];
        $stof=$row['scanof'];
        $createtime=$row['created_at'];
        if($stof=="fer"){
            $scanof="FER 2013";
        } elseif($stof=="df"){
            $scanof="Deepface";
        } elseif($stof=="hc"){
            $scanof="Haarcascade";
        } elseif($scanof==""){
            $scanof="No scan found";
        }
        $tableofemo.='<tr><td>'.$count.'</td><td>'.$id.'</td><td>'.$emotion.'</td><td>'.$emopercentage.'</td><td>'.$createtime.'</td><td>'.$scanof.'</td><td><a href="../out?id='.$id.'">Web Page Result</a>  /  <a href="../out?json=true&id='.$id.'">Json Result</a>  /  <a href="../del?delid='.$id.'">Delete Result</a></td></tr>';
    }
    $tableofemo.='</table></center>';
} else{
    $tableofemo="No results found";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Result by F-Moji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
    <style type="text/css">
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body style="background-color: #ccccff;">
<center><header><h5><a href="../">Home</a>     /     <a href="../take">FER 2013 by Web Cam</a>     /     <a href="../take?type=df">Deep Face method by Web Cam</a>     /     <a href="../take?type=hc">Haascade method by Web Cam</a>     /     <a href="../take?sc=url">FER 2013 by Image URL</a>     /     <a href="../take?type=df&sc=url">Deep Face method by Image URL</a>     /     <a href="../take?type=hc&sc=url">Haascade method by Image URL</a>     /     <a href="../pdata">All Results</a>     /     <a href="../doc">Documentation</a>     /     <a href="../show">Emoji Table data</a>     /     <a href="../enter">Enter Emoji's</a></h5></header></center>
    <center><h1>All Results</h1></center>
    <?php
        if(isset($tableofemo)){
            echo $tableofemo;
        }
    ?>
</body>