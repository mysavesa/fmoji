<?php
include __DIR__.'/../config.php';
if(isset($_GET['delid'])){
    $delid=trim($_GET['delid']);
    $sqlcom="SELECT * FROM results WHERE id='".$delid."'";
    $sqlresult = mysqli_query($conn, $sqlcom);
    if(mysqli_num_rows($sqlresult) > 0){
        $row = mysqli_fetch_assoc($sqlresult);
        $delvar=trim($row['scanof']);
        $fera=trim($row['fera']);
        $dfa=trim($row['dfa']);
        $hca=trim($row['hca']);
        $count=0;
        $rdids=0;
        if($fera=="lol" or $fera=="nol"){
            $n=1;
        } else{
            $pid[$count]="fer";
            $count++;
            if($delvar=="fer"){
                $n=1;
            } elseif($rdids==0){
                $rdid=$fera;
                $rdids==1;
            }
        }
        if($dfa=="lol" or $dfa=="nol"){
            $n=1;
        } else{
            $pid[$count]="df";
            $count++;
            if($delvar=="df"){
                $n=1;
            } elseif($rdids==0){
                $rdid=$dfa;
                $rdids==1;
            }
        }
        if($hca=="lol" or $hca=="nol"){
            $n=1;
        } else{
            $pid[$count]="hc";
            $count++;
            if($delvar=="hc"){
                $n=1;
            } elseif($rdids==0){
                $rdid=$hca;
                $rdids==1;
            }
        }
        if(isset($pid)){
            if(count($pid)==1){
                echo $delid."<br>";
                $sqlcom="DELETE FROM results WHERE id='".$delid."'";
                $sqlresult = mysqli_query($conn, $sqlcom);
                unlink(__DIR__.'/../upload/'.$delid.'.png');
                unlink(__DIR__.'/../result/'.$delid.'.png');
                header("Location: ../?result=deleted&delid=".$delid);
            } else{
                $delvar;
                $sqlcom="DELETE FROM results WHERE id='".$delid."'";
                $sqlresult = mysqli_query($conn, $sqlcom);
                foreach($pid as $x => $key){
                    $did=$row[$key."a"];
                    echo $did."<br>";
                    if($key!=$delvar){
                        $sqlcom="UPDATE results SET ".$delvar."a='lol',".$delvar."n=0 WHERE id='".$did."'";
                        $sqlresult = mysqli_query($conn, $sqlcom);
                    }
                }
                unlink(__DIR__.'/../upload/'.$delid.'.png');
                unlink(__DIR__.'/../result/'.$delid.'.png');
                header("Location: ../out?id=".$rdid."&result=deleted&delid=".$delid);
            }
        }
    } else{
        echo "no image, maybe already deleted or else id not found";
    }
} else{
    echo "no id pass to delete";
}
?>