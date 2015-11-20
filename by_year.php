<html>
<head>
<title>Search by year</title>
</head>
<body align="center">
<table   border="2px" style="width: 100%; height: 50px ; ">
<tr><td colspan="3"> <?php

                       include 'header.php';
                        ?> </td></tr>
</table>
<br />

<form method="post" align=center>
 <pre>    
                        Year:   <select name="year" id="year" >
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

                        Gender: <input type="radio" name="gender" value="male" required="" /> Male <input type="radio" required="" value="female" name="gender"/> Female
  
                        Top Names: <input type="radio" required="" name="topname" value="20" /> 20 <input type="radio" name="topname" value="40" />40 <input type="radio" name="topname" value="80" /> 80 <input type="radio" required="" name="topname" value="100" /> 100

                        <input type="reset" value="Reset" />                <input type="submit" name="find" value="Find"/>
</pre>
</form>

<hr color=red />
</table>

<?php
if(isset($_POST['find']))
{
    require 'config.php';
    $year= $_POST['year'];
    $gender= $_POST['gender'];
    $topname=$_POST['topname'];
    $table= $gender.'_'.$year;
    //echo $table;
    $qry="Select * from $table limit $topname ";
    $result=@mysql_query($qry) or die(mysql_error());
    echo "<h2 style='text-align: center; color: red;'> Top $topname $gender Name of Year $year</h2>";
    
    //echo "<br />"."Sr No."."&nbsp &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Name"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Popularity"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Rank";
    echo "<table align=center><tr><td>Sr No.</td><td>&nbsp &nbsp NAME</td><td>&nbsp&nbspPopularity</td><td>&nbsp&nbspRank</td></tr>";
    for($i=0;$i<$topname;$i++)
    {
        mysql_data_seek($result,$i);
        $row=mysql_fetch_array($result);
        $srno=$i+1;
        //echo "<br />".$srno."  &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$row[0]." &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  ".$row[1]." &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   ".$row[2];
        echo "<tr><td>$srno</td><td> &nbsp&nbsp $row[0]</td><td>&nbsp &nbsp $row[1]</td><td>&nbsp &nbsp $row[2]</td></tr>";
    }
    //echo "<br />".$row[0][1]." ".$row[0][1]." ";
    echo "</table> <hr color=red />";
}

?>

</fieldset>

<table  border="2px" align=center style="width: 100%; height: 50px; ">
 <tr><td colspan="3" style="padding:0,10px;"> <?php
 
                                                    //include 'footer.php';

                                                    ?>  </td></tr>
</table>
</body>
</html>
