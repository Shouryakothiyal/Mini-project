<html>
<head>
<title>Search by Name</title>
</head>
<body align="center">
<table   border="2px" style="width: 100%; height: 50px ; ">
<tr><td colspan="3"> <?php

                       include 'header.php';
                        ?> </td></tr>
</table>
<br />



<form align=center method="post">
<pre>


                                        Year:       <select align=center name="year" id="year" required="required" onchange="ajax()">
<option value="-1">---Select Year---</option>
<?php

require 'config.php';
$qry="select * from year";
$res=@mysql_query($qry) or die(mysql_error());
while($row=mysql_fetch_array($res))
{
    echo "<option value=$row[0]>$row[0]</option>";
}

?>
</select>

                                        Name:   <input type="text" name="name"  list="name" placeholder="Name"/>
      <datalist id="name"> </datalist>  
                                        Gender: <input type="radio" required="" name="gender" value="male" /> Male <input type="radio" value="female" name="gender"/> Female

                                        <input type="reset" value="Reset" />    <input type="submit" name="find" value="Find"/>

</pre>
</form>

<hr color=red />
<fieldset  >
<legend></legend>


<?php
if(isset($_POST['find']))
{
    
    require 'config.php';
    $year= $_POST['year'];
    $gender= $_POST['gender'];
    $name=$_POST['name'];
    if($year==-1)
    {
        echo "<script> alert('ohhh!!! Please select Year') </script>";
    }
    else
    {
    echo "<h2 style='text-align: center; color: brown;'>Your Name : $name &nbsp &nbsp &nbsp &nbsp Gender: $gender</h2>";
    echo "<h3 style='text-align: center; color: brown;'>Popularity of your name given by no of births </h3>";
    echo "<hr color=red />";
    
    $yeararr=array();
    $popularity=array();
    $rank=array();
     $i=0;
     
     //Array Created
     $temp=$year;
     for($year;$year<=2013;$year++)
    {
        $yeararr[$i]=$year;
        $table= $gender.'_'.$year;
    
    $qry="Select * from $table where Name='$name' ";
    $result=@mysql_query($qry) or die(mysql_error());
   
    if(mysql_num_rows($result)>0)
    {
        $row=mysql_fetch_array($result);
        $popularity[$i]=$row[1];
        $rank[$i]=$row[2];
    }
    else
    {        
        $rank[$i]=0;
        $popularity[$i]=0;
    }
    $i++;
    }
    //Graph Ploting
     session_start();
    $_SESSION['popularity']=$popularity;
    $_SESSION['year']=$yeararr;
    $_SESSION['name']=$name;


    echo "<img src='GRAPH.php' style='alignment-adjust: central; margin-left: 25%'/>";

     
     
    echo "<hr color=red />";
    echo "<h3 >Year &nbsp No. Of Birth &nbsp Rank</h3>";
    $year=$temp;
    for($year;$year<=2013;$year++)
    {
       // $yeararr[$i]=$year;
    $table= $gender.'_'.$year;
    //echo $table;
    
    $qry="Select * from $table where Name='$name' ";
    $result=@mysql_query($qry) or die(mysql_error());
    //echo "<h2 style='text-align: center; color: red;'> Top $topname $gender Name of Year $year</h2>";
    //echo "<br />"."Sr No."."&nbsp"."Name"."   "."Popularity"."   "."Rank";
    if(mysql_num_rows($result)>0)
    {
        $row=mysql_fetch_array($result);
       // $popularity[$i]=$row[1];
       // $rank[$i]=$row[2];
        echo "<br />&nbsp".$year."&nbsp &nbsp &nbsp &nbsp".$row[1]."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp".$row[2];
        
    }
    else
    {
        echo "<br /> &nbsp".$year."&nbsp &nbsp &nbsp &nbsp".'0'."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp".'0';
        //$rank[$i]=0;
        //$popularity[$i]=0;
    }
    $i++;
    }
    
    echo "<br /><br /><h3 style='text-align: left; color: red;'> * (=) means two or more name in the same rank. </h3>";
    echo "<hr color=red /><br /><br />";
    
    
    
   // print_r($popularity);
    
    //echo "<br />".$row[0][1]." ".$row[0][1]." ";
}
}

?>

</fieldset>

</body>
</html>
