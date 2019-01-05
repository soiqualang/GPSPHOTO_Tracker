<?
@setcookie("enter","ture");
function style($style)
       {
       $fp=fopen("../counter/counter.dat",r);
       $num=fread($fp,6);
	   //echo $num;
       fclose($fp);
       if($enter<>ture)
       $num++;
       $fp=fopen("../counter/counter.dat",w);
       fwrite($fp,$num);
       fclose($fp);
       if($style==1)
       {$len=strlen($num);
	   //echo $len;
       for($i=0;$i<=$len-1;$i++)
            {  $gif[$i]=substr($num,$i,1);
               echo "<img src=../counter/images/".$gif[$i].".gif>";
            }}
       else
         echo $num;
       }
?>