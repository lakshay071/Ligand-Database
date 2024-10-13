<?php
header("Content-type:image/png");
$id=$_GET['id'];
$connect=mysqli_connect("localhost","root","","ligdb");
$sql="select structure_data from structures
where ligand_id=$id";
$query=mysqli_query($connect,$sql);
$row=mysqli_fetch_array($query);
$pic=$row['structure_data'];
echo "$pic";
?>
