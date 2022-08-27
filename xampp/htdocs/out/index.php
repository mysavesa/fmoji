<?php
include __DIR__.'/../config.php';
if(isset($_GET['id'])){
    $sqlcom="SELECT * FROM results WHERE id='".$_GET['id']."'";
    $sqlresult = mysqli_query($conn, $sqlcom);
    if(mysqli_num_rows($sqlresult) > 0){
        $row = mysqli_fetch_assoc($sqlresult);
        $emoofdata=trim($row['emotion']);
        $newop="";
        $perofdata=trim($row['emopercentage']);
        $premo="";
        $expemo=explode(",",$emoofdata);
        for($i=0;$i<count($expemo);$i++){
            $premoo=trim($expemo[$i]).",";
            $premo=$premo.ucfirst($premoo)." ";
        }
        $premo=substr($premo, 0, -2);
        $prper="";
        $expper=explode(",",$perofdata);
        for($i=0;$i<count($expper);$i++){
            $prpero=trim($expper[$i])."%,";
            $prper=$prper.ucfirst($prpero)." ";
        }
        $prper=substr($prper, 0, -2);
        $idofdata=trim($row['id']);
        $stofdata=trim($row['scanof']);
        $createtime=trim($row['created_at']);
        if($stofdata=="fer"){
            $scanofdata="FER 2013";
            $totaldelcom="Delete Results: <a href='../del?delid=".$row["fera"]."' class='btn btn-primary'>Delete FER Result</a>";
            $feropdfn=""; $feropdfo=""; $ferophcn=""; $ferophco=""; $trn=""; $tro="";
            if(trim($row['dfa'])=="lol"){
                $feropdfn="<a href='../run?type=df&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with DF Method</a>";
            } elseif(trim($row['dfa'])=="nol"){
                $feropdfn="<a href='../run?type=df&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with DF Method, Failed try: ".$row['dfn']."</a>";
            } else{
                $feropdfo="<a href='../out?id=".$row["dfa"]."' class='btn btn-primary'>See DF Result</a>";
                $totaldelcom.="<a href='../del?delid=".$row["dfa"]."' class='btn btn-primary'>Delete DF Result</a>";
            }
            if(trim($row['hca'])=="lol"){
                $ferophcn="<a href='../run?type=hc&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with HC Method</a>";
            } elseif(trim($row['hca'])=="nol"){
                $ferophcn="<a href='../run?type=hc&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with HC Method, Failed try: ".$row['hcn']."</a>";
            } else{
                $ferophco="<a href='../out?id=".$row["hca"]."' class='btn btn-primary'>See HC Result</a>";
                $totaldelcom.="<a href='../del?delid=".$row["hca"]."' class='btn btn-primary'>Delete HC Result</a>";
            }
            if($feropdfn!="" or $ferophcn!=""){
                $trn="<br>Make New Result: ".$feropdfn." ".$ferophcn;
            }
            if($feropdfo!="" or $ferophco!=""){
                $tro="<br>See Old Result: ".$feropdfo." ".$ferophco;
            }
            $newop=$trn.$tro."<br>".$totaldelcom;
        } elseif($stofdata=="df"){
            $scanofdata="Deepface";
            $totaldelcom="Delete Results: <a href='../del?delid=".$row["dfa"]."' class='btn btn-primary'>Delete DF Result</a>";
            $feropfern=""; $feropfero=""; $ferophcn=""; $ferophco=""; $trn=""; $tro="";
            if(trim($row['fera'])=="lol"){
                $feropfern="<a href='../run?type=fer&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with FER Method</a>";
            } elseif(trim($row['fera'])=="nol"){
                $feropfern="<a href='../run?type=fer&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with FER Method, Failed try: ".$row['fern']."</a>";
            } else{
                $feropfero="<a href='../out?id=".$row["fera"]."' class='btn btn-primary'>See FER Result</a>";
                $totaldelcom.="<a href='../del?delid=".$row["fera"]."' class='btn btn-primary'>Delete FER Result</a>";
            }
            if(trim($row['hca'])=="lol"){
                $ferophcn="<a href='../run?type=hc&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with HC Method</a>";
            } elseif(trim($row['hca'])=="nol"){
                $ferophcn="<a href='../run?type=hc&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with HC Method, Failed try: ".$row['hcn']."</a>";
            } else{
                $ferophco="<a href='../out?id=".$row["hca"]."' class='btn btn-primary'>See HC Result</a>";
                $totaldelcom.="<a href='../del?delid=".$row["hca"]."' class='btn btn-primary'>Delete HC Result</a>";
            }
            if($feropfern!="" or $ferophcn!=""){
                $trn="<br>Make New Result: ".$feropfern." ".$ferophcn;
            }
            if($feropfero!="" or $ferophco!=""){
                $tro="<br>See Old Result: ".$feropfero." ".$ferophco;
            }
            $newop=$trn.$tro."<br>".$totaldelcom;
        } elseif($stofdata=="hc"){
            $scanofdata="Haarcascade";
            $totaldelcom="Delete Results: <a href='../del?delid=".$row["hca"]."' class='btn btn-primary'>Delete HC Result</a>";
            $feropfern=""; $feropfero=""; $feropdfn=""; $feropdfo=""; $trn=""; $tro="";
            if(trim($row['fera'])=="lol"){
                $feropfern="<a href='../run?type=fer&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with FER Method</a>";
            } elseif(trim($row['fera'])=="nol"){
                $feropfern="<a href='../run?type=fer&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with FER Method, Failed try: ".$row['fern']."</a>";
            } else{
                $feropfero="<a href='../out?id=".$row["fera"]."' class='btn btn-primary'>See FER Result</a>";
                $totaldelcom.="<a href='../del?delid=".$row["fera"]."' class='btn btn-primary'>Delete FER Result</a>";
            }
            if(trim($row['dfa'])=="lol"){
                $feropdfn="<a href='../run?type=df&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with DF Method</a>";
            } elseif(trim($row['dfa'])=="nol"){
                $feropdfn="<a href='../run?type=df&prnid=".trim($row['id'])."' class='btn btn-primary'>Check with DF Method, Failed try: ".$row['dfn']."</a>";
            } else{
                $feropdfo="<a href='../out?id=".$row["dfa"]."' class='btn btn-primary'>See DF Result</a>";
                $totaldelcom.="<a href='../del?delid=".$row["dfa"]."' class='btn btn-primary'>Delete DF Result</a>";
            }
            if($feropfern!="" or $feropdfn!=""){
                $trn="<br>Make New Result: ".$feropfern." ".$feropdfn;
            }
            if($feropfero!="" or $feropdfo!=""){
                $tro="<br>See Old Result: ".$feropfero." ".$feropdfo;
            }
            $newop=$trn.$tro."<br>".$totaldelcom;
        } elseif($scanofdata==""){
            $scanofdata="No scan found";
        }
        $meow=$row;
        if(strpos($emoofdata, ',') !== false){
            $allemo=explode(",", strtolower($emoofdata));
        } else{
            $allemo[0]=strtolower($emoofdata);
        }
        if(strpos($perofdata, ',') !== false){
            $allper=explode(",", strtolower($perofdata));   
        } else{
            $allper[0]=strtolower($perofdata);
        }
        if(count($allemo)!=count($allper)){
            die("Error: ".count($allemo)." emotions and ".count($allper)." percentages found. Not equal.");
        } else{
            $numpass=count($allemo);
        }
        $count=0;
        $tableofemo='<center><table style="width:100%"><tr><th>Sr. No.</th><th>Emoji</th><th>Emotion Name</th><th>Unicode</th><th>Per Down</th><th>Per Given</th><th>Per Up</th><th>Copy Emoji</th><th>Copy HashCode</th></tr>';
        for($i=0;$i<$numpass;$i++){
            $emocomeofdata=$allemo[$i];
            $perofdata=$allper[$i];
            if($emocomeofdata=="happy"){
                $emocomeofdatacap="ha";
            } elseif($emocomeofdata=="sad"){
                $emocomeofdatacap="sa";
            } elseif($emocomeofdata=="angry"){
                $emocomeofdatacap="an";
            } elseif($emocomeofdata=="surprise"){
                $emocomeofdatacap="su";
            } elseif($emocomeofdata=="neutral"){
                $emocomeofdatacap="nu";
            } elseif($emocomeofdata=="fear"){
                $emocomeofdatacap="fe";
            } elseif($emocomeofdata=="disgust"){
                $emocomeofdatacap="di";
            }
            $sqlcom="SELECT * FROM emojistore WHERE emotion ='$emocomeofdatacap' AND perdown < ".$perofdata." AND perup >= ".$perofdata;
            $sqlresult = mysqli_query($conn, $sqlcom);
            if(mysqli_num_rows($sqlresult) > 0){
                while($row = mysqli_fetch_assoc($sqlresult)) {
                    $count++;
                    $pewuc="uc".$count;
                    $pewpd="pd".$count;
                    $pewpu="pu".$count;
                    $meow[$pewuc]=$row['unichar'];
                    $meow[$pewpd]=$row['perdown'];
                    $meow[$pewpu]=$row['perup'];
                    $tableofemo.='<tr><td>'.$count.'</td><td>'."&#x".$row["unichar"].'</td><td>'.$emocomeofdata.'</td><td>'.$row["unichar"].'</td><td>'.$row["perdown"].'%</td><td>'.$perofdata.'%</td><td>'.$row["perup"].'%</td><td><input type="hidden" id="emocire'.$count.'" value="'."&#x".$row["unichar"].'"><button class="btn btn-success" onclick="myFunction('."'e".$count."'".')" onmouseout="outFunc('."'e".$count."'".')">Copy Emoji</button></td><td><input type="hidden" id="emocirc'.$count.'" value="'.$row["unichar"].'"><button class="btn btn-success" onclick="myFunction('."'c".$count."'".')" onmouseout="outFunc('."'c".$count."'".')">Copy HashCode</button></div></td></tr>';
                }
                $meow["count"]=$count;
            }
        }
        if($count==0){
            $tableofemo='No emoji found';
        } else{
            $tableofemo.="</table></center>";
        }
        if(isset($_GET['json']) and $_GET['json']=="true"){
            $jsonofdata=json_encode($meow);
            echo $jsonofdata;
        } else{
            $bodyhtml='<div class="container"><h1 class="text-center">Result of ID: '.$_GET['id'].'</h1><div class="row"><div class="col-md-6"><h3>Entered Image: </h3><img src="../upload/'.$idofdata.'.png" alt="Upload Imafe of ID: '.$idofdata.'" width="450" height="350"></div><div class="col-md-6"><h3>Result Image: </h3><img src="../result/'.$idofdata.'.png" alt="Result Imafe of ID: '.$idofdata.'" width="450" height="350"></div></div></div><center style="font-size:20px">Emotion: '.$premo.'<br>Emotion Value: '.$prper.'<br>Created at: '.$createtime.'<br>Scan by: '.$scanofdata.' method'.$newop.'<br>Suggested Emoji Table: <br>'.$tableofemo.'</center>';
        }
    } else{
        echo "No Data Found for given ID: ".$_GET['id'];
    }
} else{
    echo "No ID Parameter Found";
}
?>
<?php if(!isset($_GET['json']) or $_GET['json']!="true"){?>
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
    <?php
        if(isset($bodyhtml)){
            echo $bodyhtml;
        }
    ?>
    <script>
        function myFunction(v){
            if(v[0]="e"){
                var copyText = document.getElementById("emocir"+v).value;
            } else if(v[0]="c"){
                var copyText = document.getElementById("emocir"+v).value;
                copyText="&#x"+copyText
            }
            console.log(copyText);
            navigator.clipboard.writeText(copyText);
        }
        function outFunc(v){
            
        }
</script>
</body>
<?php }?>