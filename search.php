<?php
//Prerequisite: First get the search term from the
//HTML form using $_GET or $_POST variables
$searchterm= $_POST['ligandkeyword'];
echo "Search term : $searchterm <br>";
//Step1: Connection to backend database
$connect=mysqli_connect("localhost","root","","ligdb");
echo "Database exists";
//Step2: Write the SQL queries to fetch
//the data based on the search term from the HTML page
$sql="Select * from ligands where description like
'%$searchterm%'";
$query=mysqli_query($connect,$sql) or die(mysqli_error());
echo "<table border=1>
<tr><td>Ligand ID</td><td>Ligand Name</td><td>Formula</td>
<td>Description</td><td>Molecular Weight</td><td>Structure
ID</td>
<td>Structure Data</td></tr>";
$id=array();
while ($row=mysqli_fetch_array($query))
{
$lid=$row['ligand_id'];
array_push($id,$lid);
}
//Step3: Display the Match the results
//in a well formatted HTML Table
for ($i=0;$i<count($id);$i++)
{
$q="select * from ligands where ligand_id='$id[$i]'";
$x=mysqli_query($connect,$q) or die(mysqli_error());
$r=mysqli_fetch_array($x);
$lname=$r['ligand_name'];
$for=$r['formula'];
$mol=$r['molecular_weight'];
$des=$r['description'];
$k="select * from structures where ligand_id='$id[$i]'";
$y=mysqli_query($connect,$k) or die(mysqli_error());
$z=mysqli_fetch_array($y);
$sid=$z['structure_id'];
$std=$z['structure_data'];
echo "<tr><td>$id[$i]</td><td>$lname</td><td>$for</td>
<td>$des</td><td>$mol</td><td>$sid</td>
<td><img src=ligandstructure.php?id=$id[$i]
width=70%></td></tr>";
}
?>