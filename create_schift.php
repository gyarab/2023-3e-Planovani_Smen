<!DOCTYPE html>
<!--not finnished -->
<!--code that generates new schifts -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Create new schift</h3>
<br>
<label for="start">Where schift starts:</label>
<input type="date" id="start" name="start">
<br>
<label for="repeat">After what time they should repeat:</label>
<input type="text" id="repeat" name="repeat">
<br>
<label>Pick certain days</label>
<br>
<input type="checkbox" id="monday" name="monday">
<label for="monday"> Monday</label><br>
<input type="checkbox" id="tuesday" name="tuesday">
<label for="tuesday"> Tuesday</label><br>
<input type="checkbox" id="wednesday" name="wednesday">
<label for="wednesday"> Wednesday</label><br>
<input type="checkbox" id="thursday" name="thursday">
<label for="thursday"> Thursday</label><br>
<input type="checkbox" id="friday" name="friday">
<label for="Friday"> Friday</label><br>
<input type="checkbox" id="saturday" name="saturday">
<label for="saturday"> Saturday</label><br>
<input type="checkbox" id="sunday" name="sunday">
<label for="sunday"> Sunday</label><br>
<script>
  document.getElementById('start').valueAsDate = new Date();
</script>
</body>
</html>