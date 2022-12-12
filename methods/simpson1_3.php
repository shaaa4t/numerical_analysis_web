<?php

$errors = array('fun' => '', 'invalidFunction' => '', 'a_equal_b' => '');
$conv = array('0.00000001' => 0, '90' => (pi() / 2), '180' => pi(), '270' => 3 * (pi() / 2), '360' => 2 * pi());

$x0 = $xn = $fun = '';
$n = 5;
$result = '';
$isSubmitted = false;

if (isset($_POST['submit'])) {

    $x0 = $_POST['x0'];
    $xn = $_POST['xn'];
    $n = $_POST['n'];


    if (empty($_POST['fun'])) {
        $errors['fun'] = 'fun is required <br />';
    } else {
        $fun = $_POST['fun'];
    }

    $isSubmitted = true;
    $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.xsincota]/', '**', $fun);

    try {
        if (preg_match("/(?:sin|cos|tan)+/", $fun)) {
            $actualFormula_fx0 = str_replace('x', $conv[$x0], $filteredExpression);
            $actualFormula_fxn = str_replace('x', $conv[$xn], $filteredExpression);
        } else {
            $actualFormula_fx0 = str_replace('x', $x0, $filteredExpression);
            $actualFormula_fxn = str_replace('x', $xn, $filteredExpression);
        }
        $FX0 = eval('return ' . $actualFormula_fx0 . ';');
        $FXN = eval('return ' . $actualFormula_fxn . ';');

        # calculating step size
        $h = ($xn - $x0) / $n;

        # Finding sum 
        $integration = $FX0 + $FXN;

        for ($i = 1; $i < $n; $i++) {
            $k = $x0 + $i * $h;

            if (preg_match("/(?:sin|cos|tan)+/", $fun)) {
                $actualFormula_fk = str_replace('x', $conv[$k], $filteredExpression);
            } else {
                $actualFormula_fk = str_replace('x', $k, $filteredExpression);
            }
            $FK = eval('return ' . $actualFormula_fk . ';');
            if($i%2==0){
                $integration = $integration + 2 * $FK;
            } else {
                $integration = $integration + 4 * $FK;

            }
        }

        # Finding final integration value
        $integration = $integration * $h / 3;
        $result = $integration;

    } catch (\Throwable $th) {
        $errors['invalidFunction'] = 'Invalid Function <br />';
        $isSubmitted = false;
    }

}

?>

<h4 class="text-primary">Simpson's 1/3</h4>

<form action="" method="POST">
    <div class="w-60 px-2 py-3 mx-auto">
        <div class="input-group mb-3 d-flex align-items-center">
            <label class="mx-2" for="fx">f(x)</label>
            <input type="text" name="fun" value="<?php echo htmlspecialchars($fun) ?>" class="form-control py-1"
                placeholder="Write the function f(x)" aria-label="Write the function f(x)" aria-describedby="fx"
                required>
        </div>
        <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
            <label class="mx-2" for="x0">x0</label>
            <input type="number" name="x0" value="<?php echo htmlspecialchars($x0) ?>" class="form-control py-1"
                placeholder="Lower limit of integration" aria-label="x0" aria-describedby="x0" required>
            <label class="mx-2" for="xn">xn</label>
            <input type="number" name="xn" value="<?php echo htmlspecialchars($xn) ?>" class="form-control py-1"
                placeholder="Upper limit of integration" aria-label="xn" aria-describedby="xn" required>
        </div>

        <div class="input-group mb-3 d-flex align-items-center ">
            <label class="mx-2" for="n">Sub intervals n</label>
            <input type="number" name="n" class="form-control py-1" value="<?php echo htmlspecialchars($n) ?>" max="500"
                min="5" aria-describedby="n" placeholder="Enter number of sub intervals" required>
        </div>
        <input class="btn btn-primary w-100 d-block" type="submit" value="Execute" name="submit" required>

        <?php if ($isSubmitted == true): ?>
        <br>
        <h3 style="font-size: large; color: green; text-align: center;">Integration result by Simpson's 1/3 method is <br>
            <?php echo $result ?>
        </h3>
        <?php endif; ?>

        <!-- if user enter invalid function as: xx -->
        <div style="color: red; text-align: center;">
            <h3 style="font-size: medium;">
                <?php echo $errors['invalidFunction']; ?>
            </h3>
        </div>
    </div>
</form>