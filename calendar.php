<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dynamic Calendar JavaScript | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!--<link rel="stylesheet" href="css/calendar.css">-->
    <script src="js/calendar.js" defer></script>
    <style>
          table,
  th,
  td {
    border: 1px solid black;
  }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <header>
        <p class="current-date"></p>
        <div class="icons">
          <span id="prev" class="material-symbols-rounded">chevron_left</span>
          <span id="next" class="material-symbols-rounded">chevron_right</span>
        </div>
      </header>
      <div class="calendar">
      <tr>
          <th>Day</th>
        </tr>
        <!--<ul class="weeks">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>-->
        <table class="days">
        <tr>
          <th>Day</th>
        </tr>
        </table>
        <ul class="days"></ul>
      </div>
    </div>
    
  </body>
</html>