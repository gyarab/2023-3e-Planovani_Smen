<?php
/**Some testing code */
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php
  $mysqli2 = require __DIR__ . "/database.php";
  $sql2 = " SELECT * FROM list_of_tables ORDER BY id_tables ASC";
  //$result2 = $mysqli2->query($sql2);
  $result3 = $mysqli2->query($sql2);
  $mysqli2->close();
  while ($rows1 = mysqli_fetch_array($result3)) {
    ?>

    <input id="boxq" type="radio" name="boxq" value="<?php echo $rows1['table_name']; ?>">
    <label for="boxq">
      <?php echo $rows1['real_table_name']; ?>
    </label>

    <br>
    <?php
  }
  hallo(10);
  $ress = mysqli_fetch_all($result3, MYSQLI_ASSOC);
  mysqli_free_result($result3);
  bat($ress);
  ?>
  <p>fsahfsjakhkhjsfahjfshjk</p>
  <?php
  function hallo($T)
  {

    ?>
    <input id="box" type="radio" name="box" value="<?php /*echo $rows1['table_name'];*/ ?>">
    <label for="box">
      <?php /*echo $rows1['real_table_name'];*/ ?>
      saf
    </label>

    <br>
    <?php
  }
  ?>

  <?php
  function bat($db)
  {
    echo "<br>";
    echo $db;
    echo "<br>";
    $mysqli2 = require __DIR__ . "/database.php";
    $sql2 = " SELECT * FROM list_of_tables ORDER BY id_tables ASC";
    //$result2 = $mysqli2->query($sql2);
    $result3 = $mysqli2->query($sql2);
    $mysqli2->close();
    while ($rows1 = $result3->fetch_assoc()) {
      ?>
      <input id="box" type="radio" name="box" value="<?php echo $rows1['table_name']; ?>">
      <label for="box">
        <?php echo $rows1['real_table_name']; ?>
      </label>

      <br>
      <?php
    }
  }
  ?>
  <table>
    <tr>
      <th style="width: 140px;height: 120px">
        <div style="margin: 5px">
          <div class="row">
            <div class="col-6">
              <label style="float: left;font: 20px">From</label>
            </div>
            <div class="col-6">
              <input type="time" style="float:right" title="Time selector">
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <label style="float: left">To</label>
            </div>
            <div class="col-6">
              <input type="time" style="float:right" title="Time selector">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="text-center">
                <input type="button"
                  style="width: 130px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:15px"
                  value="132113213213211312" title="Employee selector">
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-12">
         
            <textarea class="form-control" id="exampleFormControlTextarea1" style="height: 40px;font-size:12px;margin-top:3px;" title="Comment" rows="1">51645335465564</textarea>
          </div>
          </div>
          <div class="row">
            <div class="col-4">
            <button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" title="Delete" onClick="canceled(this.id)" id="x"><i class="bi bi-trash"></i></button>
            </div>
            <div class="col-8">
            <button class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right" title="Paste">P</button>
            <button class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right" title="Copy">C</button>
            </div>
          </div>
        </div>
      </th>
      <th style="width: 50px;height: 50px">
      <textarea class="form-control" id="exampleFormControlTextarea1" style="height: 40px;font-size:12px;margin-top:3px;" title="Comment" rows="1">51665564</textarea>
    </th>
      <th style="width: 50px;height: 50px">Country</th>
    </tr>
    <tr>
      <td style="width: 50px;height: 50px">Alfreds Futterkiste</td>
      <td style="width: 50px;height: 50px">Maria Anders</td>
      <td style="width: 50px;height: 50px">Germany</td>
    </tr>
    <tr>
      <td style="width: 50px;height: 50px">        132123<br>
      <button class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2;margin-right:2px;width: 25px;height: 25px;padding:0px;float:left" title="Paste">C</button>
            <button class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:left" title="Copy">P</button>
          </td>
      <td style="width: 50px;height: 50px">Francisco Chang</td>
      <td style="width: 50px;height: 50px">
      <div style="margin: 5px">
          <div class="row">
            <div class="col-6">
              <label style="float: left;font: 20px">From</label>
            </div>
            <div class="col-6">
              <input type="time" style="float:right" title="Time selector">
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <label style="float: left">To</label>
            </div>
            <div class="col-6">
              <input type="time" style="float:right" title="Time selector">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="text-center">
                <input type="button"
                  style="width: 130px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;font-size:15px"
                  value="132113213213211312" title="Employee selector">
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-12">
         
            <textarea class="form-control" id="exampleFormControlTextarea1" style="height: 40px;font-size:12px;margin-top:3px;" rows="1">

            </textarea>
          </div>
          </div>
          <div class="row">
            <div class="col-4">
            <button class="btn btn-danger" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px" onClick="canceled(this.id)" id="x"><i class="bi bi-trash"></i></button>
            </div>
            <div class="col-8">
            <button class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2;margin-left:2px;width: 25px;height: 25px;padding:0px;float:right">P</button>
            <button class="btn btn-primary" style="position:relative;border: 1px solid black;font-size:15px;margin-top:2px;width: 25px;height: 25px;padding:0px;float:right">C</button>
            </div>
          </div>
        </div>
    </td>
    </tr>
  </table>
  <p>
    <?php
    $datestring = '2020-01-01'; 
  
    // Converting string to date 
    $date = strtotime($datestring); 
       
    // Last date of current month. 
    $lastdate = strtotime(date("Y-m-d", $date-86400 )); 
    
    // Day of the last date  
    $day = date("Y-m-d", $lastdate); 
      
    echo $day; 
    ?>
  </p>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>