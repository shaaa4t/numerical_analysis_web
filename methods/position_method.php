<?php
$errors = array('fun' => '', 'p0' => '', 'p1' => '', 'n' => '', 'invalidFunction' => '', 'p0_equal_p1' => '');

$x0 = $x1 = $fun = $p0 = $p1 = $n = $p = '';
$TOL = 0.0001;
$store_x_result = array();
//$FP_results = array();
$isSubmitted = false;

if (isset($_POST['submit'])) {
    /**  $isSubmitted = true;
     *   $fun = $_POST['fun'];
     *   $p0 = $_POST['a'];
     *   $p1 = $_POST['b'];
     *   $n = $_POST['n'];*/
    if (!empty($_POST['p0'])) {
        $p0 = $_POST['p0'];
        $x0 = $p0;
    } else {
        $errors['p0'] = '<br> p0 is required <br/>';

    }
    if (!empty($_POST['p1'])) {
        $p1 = $_POST['p1'];
        $x1 = $p1;
    } else {
        $errors['p1'] = '<br> p1 is required <br/>';

    }
    if (!empty($_POST['n'])) {
        $n = $_POST['n'];

    } else {
        $errors['n'] = '<br>n is required <br />';

    }
    if (!empty($_POST['fun'])) {
        $fun = $_POST['fun'];

    } else {
        $errors['fun'] = '<br>fun is required <br />';

    }
    if (!empty($p0) && !empty($p1) && !empty($n) && !empty($fun)) {
        $isSubmitted = true;
        try {
            $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.x]/', '', $fun);
            //echo $filteredExpression; // TODO: do valid for (tan, cos, sin) functions
            $actualFormula_p0 = str_replace('x', $p0, $filteredExpression);
            $actualFormula_p1 = str_replace('x', $p1, $filteredExpression);
            $q0 = eval('return ' . $actualFormula_p0 . ';');
            $q1 = eval('return ' . $actualFormula_p1 . ';');

            $i = 2;
            while ($i <= $n) { // 1 <= 50
                // p = a + (b - a)/2;
                $p = $p1 - $q1 ($p1 - $p0) / ($q1 - $q0);
                if (abs($p0 - $p1) < $TOL) {
                    echo $p;
                    break;

                } else {
                    $errors['p0_equal_p1'] = 'p0 is equal to p';
                    $isSubmitted = false;
                }
                $i = $i + 1;
                $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.x]/', '', $fun);
                $actualFormula = str_replace('x', $p, $filteredExpression);
                $q = eval('return ' . $actualFormula . ';');

                if ($q * $q1 < 0) {
                    $p0 = $p1;
                    $q0 = $q1;
                }
                $p1 = $p;
                $q1 = $q;
                $store_x_result[] = $p;
            }
        } catch (\Throwable $th) {
            $errors['invalidFunction'] = '<br>Invalid Function <br >';
            $isSubmitted = false;
        }
    }
}
?>
<h4 class="text-primary">False position </h4>

<form action="" method="POST">
    <div class="w-60 px-2 py-3 mx-auto">
        <div class="input-group mb-3 d-flex align-items-center">
            <label class="mx-2" for="fx">f(x)</label>
            <input type="text" class="form-control py-1" name="fun" value="<?php echo htmlspecialchars($fun) ?>"
                   placeholder="Write the function f(x)" aria-label="Write the function f(x)" aria-describedby="fx">
            <div style="color: red;">
                <?php echo $errors['fun']; ?>
            </div>
        </div>

        <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
            <label class="mx-2" for="p0">p0</label>
            <input type="text" class="form-control py-1" value="<?php echo htmlspecialchars($x0) ?>" placeholder="p0"
                   aria-label="p0" aria-describedby="p0">
            <div style="color: red;">
                <?php echo $errors['p0']; ?>
            </div>
            <label class="mx-2" for="p1">p1</label>
            <input type="text" class="form-control py-1" value=" <?php echo htmlspecialchars($x1) ?>" placeholder="p1"
                   aria-label="p1" aria-describedby="p1">
            <div style="color: red;">
                <?php echo $errors['p1']; ?>
            </div>
        </div>

        <div class="input-group mb-3 d-flex align-items-center ">
            <label class="mx-2" for="n">maximum repetition n</label>
            <label>
                <input type="number" class="form-control py-1" value="<?php echo htmlspecialchars($n) ?>" max="500"
                       min="1" aria-describedby="n">

            </label>
            <div style="color: red;">
                <?php echo $errors['n']; ?>
            </div>
        </div>

        <!--            <button class="btn btn-primary">Execute</button>-->
        <input class="btn btn-primary" type="submit" value="Execute" name="submit">
        <div style="color: red; text-align: center;">
            <h3 style="font-size: medium;">
                <?php echo $errors['a_equal_b']; ?>
            </h3>
        </div>
        <?php if ($isSubmitted): ?>

            <table class="table table-hover mt-5">
                <thead>
                <tr class="table-primary">
                    <th scope="col">n</th>
                    <th scope="col">x</th>
                    <th scope="col">f(x)</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < $n; $i++): ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td><?php echo $store_x_result[$i] ?></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        <?php endif; ?>
<!---->
        <!-- if user enter invalid function as: xx -->
        <div style="color: red; text-align: center;">
            <h3 style="font-size: medium;">
                <?php echo $errors['invalidFunction']; ?>
            </h3>
        </div>
    </div>
</form>