<?php
include __DIR__.'/../config.php';
$crunuri=$_SERVER['REQUEST_URI']."<br>";
$crunurie=explode("?",$crunuri);
$crunuri=$crunurie[0];
echo $crunuri."<br>";
if(strpos($crunuri,'run/index.php')==true){
    $crunuri=substr($crunuri, 0, -13);
} elseif(strpos($crunuri,'run/')==true){
    $crunuri=substr($crunuri, 0, -4);
} elseif(strpos($crunuri,'run')==true){
    $crunuri=substr($crunuri, 0, -3);
}
$crunuriu = substr($crunuri, 1);
$pylink="http://127.0.0.1:5000/";
echo "<br>meow<br>";
$prn="f";
$prnee="f";
if(isset($_GET['type'])){
    if($_GET['type']=="fer" or $_GET['type']=="df" or $_GET['type']=="hc"){  
        $typesec=trim($_GET['type']);
    } else{
        $typesec="fer";
    }
} else{
    $typesec="fer";
}
herefun:
$upname = uniqid();
$sqlcom="SELECT * FROM results WHERE id='$upname'";
$sqlresult = mysqli_query($conn, $sqlcom);
if(mysqli_num_rows($sqlresult) > 0){
    goto herefun;
}
$feraa="lol";
$dfaa="lol";
$hcaa="lol";
if($typesec=="fer"){
    $feraa=$upname;
} elseif($typesec=="df"){
    $dfaa=$upname;
} elseif($typesec=="hc"){
    $hcaa=$upname;
}
$folderPath = __DIR__."/../upload/";
$fileName = $upname . '.png';
$file = $folderPath . $fileName;
echo $file."<br>";
print_r($fileName);
echo "<br>";
if(isset($_POST['image']) and $_POST['image'] != ''){
    $img = $_POST['image'];
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    file_put_contents($file, $image_base64);
} elseif(isset($_POST['imgurl']) and $_POST['imgurl'] != ''){
    $img = file_get_contents(trim($_POST['imgurl']));
    $fpt = fopen(__DIR__."/../upload/".$fileName, "w");
    fwrite($fpt, $img);
    fclose($fpt);
} elseif(isset($_GET['imgurl']) and $_GET['imgurl'] != ''){
    $img = file_get_contents(trim($_GET['imgurl']));
    $fpt = fopen(__DIR__."/../upload/".$fileName, "w");
    fwrite($fpt, $img);
    fclose($fpt);
} elseif(isset($_GET['prnid']) and $_GET['prnid'] != ''){
    if(isset($_GET['type'])){
        if($_GET['type']=="fer" or $_GET['type']=="df" or $_GET['type']=="hc"){  
            $prn="t";
        } else{
            die("Error: Not Correct Method.");
        }
    } else{
        die("Error: Need Method Compulsory.");
    }
    $sqlpnr="SELECT * FROM results WHERE id='".trim($_GET['prnid'])."'";
    $sqlpnrresult = mysqli_query($conn, $sqlpnr);
    if(mysqli_num_rows($sqlpnrresult) > 0){
        $pnrrow = mysqli_fetch_assoc($sqlpnrresult);
        if($pnrrow[$typesec.'a']!="lol"){
            if($pnrrow[$typesec.'a']!="nol"){
                header("Location: out?id=".$_GET['prnid']);
                die();
            }
        }
    } else{
        echo "No result found ID found as ".trim($_GET['prnid']);
        die("Check Again");
    }
    $oldmake=__DIR__."/../upload/".$pnrrow['id'].".png";
    $newmake=__DIR__."/../upload/".$upname.".png";
    if(copy($oldmake, $newmake)){
        echo "File copied";
    } else{
        die("Error During Access Image");
    }
}
if(isset($_POST['image']) or isset($_POST['imgurl']) or isset($_GET['imgurl'])or isset($_GET['prnid'])){
$urlstr="http://".$_SERVER['HTTP_HOST'].$crunuri."upload/".$fileName;
try{
    echo "<br>URL of img:".$urlstr."<br>Filename:".$fileName."<br>Upname:".$upname."<br>";
    $result=file_get_contents($pylink."/fmoji".$typesec."?url=".$urlstr."&imgname=".$fileName."&upname=".$upname);
} catch(Exception $e){
    echo "<br>May be python server not working<br>";
    echo "Error: ".$e.'<br>';
    die("Try again later");
}
echo $result;
$resultsep=explode("/",$result);
if($resultsep[0]!="Done"){
    echo "Error Occur <br>";
    echo "Deleting Photo <br>";
    $statusofdelete=unlink(__DIR__.'/../upload/'.$fileName); 
    echo "Just a second <br>";
    $delerr=$contentdel = file_get_contents($pylink."/del?sa=h&imgname=".$fileName);
    echo "Photo Deleted <br>";
    if($prn=="t"){
        $prnee="t";
        $prndie="Error: ".$resultsep[1];
        goto prnerrormaker;
    }
    die("Error: ".$resultsep[1]);
}
if(trim($resultsep[1])=="" or trim($resultsep[2])==""){
    echo "No Face or Emotion Found <br>";
    echo "Deleting Photo <br>";
    $statusofdelete=unlink(__DIR__.'/../upload/'.$fileName); 
    $contentdel = file_get_contents($pylink."/del?sa=f&imgname=".$fileName);
    if($prn=="t"){
        $prnee="t";
        $prndie="Error: No Face or Emotion Found, Try Again";
        goto prnerrormaker;
    }
    die("Error: No Face or Emotion Found, Try Again");
}
prnerrormaker:
if($prn=="t"){
    if($prnee=="t"){
        $addt=0;
        $typen=$typesec."n";
        $typea=$typesec."a";
        $totaln=(int)$pnrrow[$typen]+1;
        if(trim($pnrrow['fera'])!="lol"){
            if(trim($pnrrow['fera'])!="nol"){
                $upda[$addt]=$pnrrow['fera'];
                $addt++;
            }
        }
        if(trim($pnrrow['dfa'])!="lol"){
            if(trim($pnrrow['dfa'])!="nol"){
                $upda[$addt]=$pnrrow['dfa'];
                $addt++;
            }
        }
        if(trim($pnrrow['hca'])!="lol"){
            if(trim($pnrrow['hca'])!="nol"){
                $upda[$addt]=$pnrrow['hca'];
                $addt++;
            }
        }
        foreach($upda as $value){
            $sqlcom="SELECT * FROM results WHERE id='".trim($value)."'";
            $sqlresult = mysqli_query($conn, $sqlcom);
            if(mysqli_num_rows($sqlresult) > 0){
                $sqlcom="UPDATE results SET $typea='nol',$typen='$totaln' WHERE id='".trim($value)."'";
                $sqlresult = mysqli_query($conn, $sqlcom);
            }
        }
        die($prndie);
    }
}
$content = file_get_contents($pylink."/downloadimg?imgname=".$fileName);
$contentdel = file_get_contents($pylink."/del?sa=f&imgname=".$fileName);
echo "<br>".$result;
$fp = fopen(__DIR__."/../result/".$fileName, "w");
fwrite($fp, $content);
fclose($fp);
$emotion=trim($resultsep[1]);
$percenofemo=trim($resultsep[2]);
$sqlcom="INSERT INTO results (id,emotion,emopercentage,scanof,fera,dfa,hca,fern,dfn,hcn) VALUES ('$upname','$emotion','$percenofemo','$typesec','$feraa','$dfaa','$hcaa','0','0','0')";
$sqlresult = mysqli_query($conn, $sqlcom);
if($prn=="t"){
    $addt=0;
    if(trim($pnrrow['fera'])!="lol"){
        if(trim($pnrrow['fera'])!="nol"){
            $upda[$addt]=$pnrrow['fera'];
            $fernewd=$pnrrow['fera'];
            $addt++;
        } else{
            $fernewd="nol";
        }
    } else{
        $fernewd="lol";
    }
    if(trim($pnrrow['dfa'])!="lol"){
        if(trim($pnrrow['dfa'])!="nol"){
            $upda[$addt]=$pnrrow['dfa'];
            $dfnewd=$pnrrow['dfa'];
            $addt++;
        } else{
            $dfnewd="nol";
        }
    } else{
        $dfnewd="lol";
    }
    if(trim($pnrrow['hca'])!="lol"){
        if(trim($pnrrow['hca'])!="nol"){
            $upda[$addt]=$pnrrow['hca'];
            $hcnewd=$pnrrow['hca'];
            $addt++;
        } else{
            $hcnewd="nol";
        }
    } else{
        $hcnewd="lol";
    }
    if($typesec=="fer"){
        $fernewd=$upname;
    } elseif($typesec=="df"){
        $dfnewd=$upname;
    } elseif($typesec=="hc"){
        $hcnewd=$upname;
    }
    $upda[$addt]=$upname;
    echo "<br>".$fernewd."<br>".$dfnewd."<br>".$hcnewd."<br>";
    foreach($upda as $value){
        $sqlcom="SELECT * FROM results WHERE id='".trim($value)."'";
        $sqlresult = mysqli_query($conn, $sqlcom);
        if(mysqli_num_rows($sqlresult) > 0){
            $sqlcom="UPDATE results SET fera='$fernewd', dfa='$dfnewd', hca='$hcnewd' WHERE id='".trim($value)."'";
            $sqlresult = mysqli_query($conn, $sqlcom);
        }
    }
}
if(isset($_GET['json']) and $_GET['json']=="true"){ header("Location: ../out?json=true&id=".$upname); } else{ header("Location: ../out?id=".$upname); }
} else{
    echo "no image";
}
?> 



