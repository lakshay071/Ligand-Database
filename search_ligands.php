<?php
$searchterm= $_POST['keywords'];

echo "Search term : $searchterm";

//Step1: Connection to backend database
$conn=mysqli_connect("localhost","root","","ligand_structure_db");

//Step2: Write the SQL queries to fetch 
//the data based on the search term from the HTML page
$sql = "Select * from Ligands,structures where ligands.ligand_id= structures.ligand_id 
and  ligands.description like '%$searchterm%'";
$query=mysqli_query($conn,$sql);
echo "<table border=1>
<tr><td>ligand_id</td><td>Ligand_Name</td><td>Formula</td>
<td>molecular_weight</td><td>Description</td><td>Structure ID</td>
<td>Structure Data</td></tr>";

while ($row=mysqli_fetch_array($query))
{
	$lid=$row['Ligand_id'];
	$ln=$row['Ligand_name'];
	$mf=$row['formula'];
	$mw=$row['molecular_weight'];
	$de=$row['description'];
	$sid=$row['Structure_id'];
	

	echo "<tr><td>$lid</td><td>$ln</td><td>$mf</td><td>$de</td><td>$mw</td>
	<td>$sid</td><td><img src=ligandstructure.php?id=$lid width=30%></td></tr>";
}
echo "</table";
//Step3: Display the Match the results 
//in a well formatted HTML Table  



?>