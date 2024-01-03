<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /** source https://www.php.net/manual/en/function.base-convert.php */
    $rest1 = substr("ABCDEF", 0, 2); 
    $rest2 = substr("ABCDEF", 2, 2);
    $rest3 = substr("ABCDEF", 4, 6);
    echo $rest1;
    echo "<br>";
    echo $rest2;
    echo "<br>";
    echo $rest3;
    echo "<br>";
    $rest4 = base_convert($rest1, 16, 10);
    echo $rest4;
echo "<br>";
$rest5 = base_convert($rest2, 16, 10);
echo $rest5;
echo "<br>";
$rest6 =  base_convert($rest3, 16, 10);
echo $rest6;
echo "<br>";
$n = 0;
$rest4 = round($rest4/100 *50);
$rest5 = round($rest5/100 *50);
$rest6 = round($rest6/100 *50);
echo $rest4;
echo "<br>";
$rest7 = base_convert($rest4, 10, 16);
if(strlen($rest7) < 2 ){
$rest7 =   "0" .$rest7;

}
echo $rest7;
echo "<br>";
$rest8 = base_convert($rest5, 10, 16);
if(strlen($rest8) < 2 ){
    $rest8 =   "0" .$rest8;
    
    }
echo $rest8;
echo "<br>";
$rest9 = base_convert($rest6, 10, 16);
if(strlen($rest9) < 2 ){
    $rest9 =   "0" .$rest9;
    
    }
echo $rest9;
echo "<br>";
echo $rest7.$rest8.$rest9;
    ?>
    <script>

    </script>
</body>
</html>