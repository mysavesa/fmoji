<?php
include __DIR__.'/../config.php';
$ext="";
if(isset($_GET['type'])){
    if($_GET['type']=="fer" or $_GET['type']=="df" or $_GET['type']=="hc"){  
        $typesec=trim($_GET['type']);
    } else{
        $typesec="fer";
    }
} else{
    $typesec="fer";
}
if(isset($_GET["sc"]) and $_GET['sc']=="url"){
    $pagerun="u";
    $cbt="Change to Web Cam";
} elseif(isset($_GET["sc"]) and $_GET['sc']=="pic"){
    $pagerun="p";
    $cbt="Change to Image URL";
} else{
    $pagerun="p";
    $cbt="Change to Image URL";
}
$stofdata=$typesec;
if($stofdata=="fer"){
    $scanofdata="FER 2013";
    $scanofdec="Higherst Accuracy<br>Have 7 emotion type (happy, sad, angry, surprise, neutral, fear, disgust)";
} elseif($stofdata=="df"){
    $scanofdata="Deepface";
    $scanofdec="Good Accuracy<br>Have 7 emotion type (happy, sad, angry, surprise, neutral, fear, disgust)";
} elseif($stofdata=="hc"){
    $scanofdata="Haarcascade";
    $scanofdec="Low Accuracy<br>Have 5 emotions type (happy, sad, angry, surprise, neutral)";
} elseif($scanofdata==""){
    $scanofdata="No scan found";
    $scanofdec="Just Sleep and Sleep";
}
if(isset($_GET['json'] ) and $_GET['json']=="true"){
    $ext.="&json=true";
}
if(isset($_GET['imgurl'] ) and $_GET['imgurl']!=""){
    header("location: /result.php?imgurl=".$_GET['imgurl']."&type=".$typesec.$ext);
}
if(isset($_POST['imgurl'] ) and $_POST['imgurl']!=""){
    header("location: /result.php?imgurl=".$_POST['imgurl']."&type=".$typesec.$ext);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>F-Moji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<body style="background-color: #ccccff;">
<center><header><h5><a href="../">Home</a>     /     <a href="../take">FER 2013 by Web Cam</a>     /     <a href="../take?type=df">Deep Face method by Web Cam</a>     /     <a href="../take?type=hc">Haascade method by Web Cam</a>     /     <a href="../take?sc=url">FER 2013 by Image URL</a>     /     <a href="../take?type=df&sc=url">Deep Face method by Image URL</a>     /     <a href="../take?type=hc&sc=url">Haascade method by Image URL</a>     /     <a href="../pdata">All Results</a>     /     <a href="../doc">Documentation</a>     /     <a href="../show">Emoji Table data</a>     /     <a href="../enter">Enter Emoji's</a></h5></header></center>
<div class="container">
    <h1 class="text-center">F-Moji</h1>
    <center>
        <h3><?php echo $scanofdata." Method"; ?></h3>
        <h5><?php echo $scanofdec; ?></h5>
        <input type="button" value="<?php echo $cbt; ?>" onClick="changetype()" id="cbttn"><input type="hidden" value="<?php echo $pagerun; ?>" id="co">
    </center><br>
    <form method="post" action="../run/index.php?type=<?php echo $typesec.$ext;?>">
        <div id="take"></div>
    </form>
</div>
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
    changetype();
    function changetype(){
        cs=document.getElementById("co").value;
        if(cs=="p"){
            document.getElementById("co").value="u";
        } else if(cs=="u"){
            document.getElementById("co").value="p";
        } else{
            document.getElementById("co").value="p";
        }
        if(cs=="p"){
            document.getElementById("take").innerHTML='<div class="row"><div class="col-md-6"><div id="my_camera"></div><br/><input type=button value="Take Snapshot" onClick="take_snapshot()"><input type="hidden" name="image" class="image-tag"></div><div class="col-md-6"><div id="results">Your captured image will appear here...</div></div><div class="col-md-12 text-center"><br/><button class="btn btn-success">Submit</button></div></div>';
            document.getElementById("cbttn").value="Change to Image URL";
            Webcam.set({
                width: 490,
                height: 390,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach( '#my_camera' );
        } else if(cs=="u"){
            document.getElementById("take").innerHTML='<center><div><input placeholder="Enter URL" type="url" name="imgurl"></div><div class="col-md-12 text-center"><br/><button class="btn btn-success">Submit</button></div></center>';
            document.getElementById("cbttn").value="Change to Web Cam";
        }
    }
</script>
</body>
</html>
