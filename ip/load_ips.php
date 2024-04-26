<?php
$mysqli = require ("../database.php");


$conn = new mysqli($host, $username, $password, $dbname);

$sql = "SELECT * FROM IPS";
$fetch = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($fetch)) {
  echo '<div class="row" >';
  echo '<div class="col-12" >';
  echo '<div class="shadow p-3 mb-5 bg-white rounded" style="width: 100%">';
  echo '<div class="row" >';
  echo '<div class="col-3" >';
  echo '<p style="font-size: 20px"><strong>IP:</strong>&nbsp;&nbsp;&nbsp; ' . $row['ip_address'] . '</p>';
  echo '</div>';
  echo '<div class="col-6" >';


  echo '<div class="input-group input-group-sm mb-3">';
  echo '<div class="input-group-prepend">';
  echo '<p style="font-size: 20px;display: inline"><strong>Description:</strong>&nbsp;&nbsp;&nbsp;</p>';

  echo '</div>';
  echo '<input id="description' . $row['id_ip'] . '" class="form-control" type="text" value="' . $row['ip_description'] . '">';
  echo '</div>';

  echo '</div>';
  echo '<div class="col-3" >';
  echo '<button id="e' . $row['id_ip'] . '" onclick="edit_ip(this.id)" type="button" class="btn btn-primary" style="float:right">EDIT</button>';
  echo '<button id="d' . $row['id_ip'] . '" onclick="delete_ip(this.id)" type="button" class="btn btn-danger" style="float:right;margin-right:10px ">DELETE</button>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}


?>