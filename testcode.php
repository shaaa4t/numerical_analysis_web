
<?php
$fun = "x*sin(x)+cos(x)";
$p0= 90;
$p1 = 90 ;
//$pi=3.141592654;
$conv= array('90' => (pi()/2) , '180' => pi(), '270' =>3* (pi()/2), '360' => 2*pi());

$s = rad2deg(pi()/2);
$filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.xsincota]/', '**', $fun);
 // TODO: do valid for (tan, cos, sin) functions
$actualFormula_p0 = str_replace('x', $conv[$p0] ,$filteredExpression);
$actualFormula_p1 = str_replace('x', $conv[$p1], $filteredExpression);

$q0 = eval('return ' . $actualFormula_p0 . ';');
$q1 = eval('return ' . $actualFormula_p1 . ';');

//echo $filteredExpression;
echo "<br>";
//echo $q0;
//echo $q1;
echo "<br>";
echo $filteredExpression;
echo "<br>";

echo $q1;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>

</head>
<body>
<br>
<br>
<?php echo $actualFormula_p0 . "<br>";?>

</body>

</html>