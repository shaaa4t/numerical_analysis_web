<?php
$errors = array('fun' => '', 'p0' => '', 'p1' => '', 'n' => '', 'invalidFunction' => '', 'p0_equal_p1' => '');
$conv = array('0' => 0, '90' => (pi() / 2), '180' => pi(), '270' => 3 * (pi() / 2), '360' => 2 * pi());

$x0 = $x1 = $fun = $p0 = $p1 = $p = '';
$n = 5;
$TOL = 0.0000001;
$store_x_results = array();
$Q_results = array();
$isSubmitted = false;

if (isset($_POST['submit'])) {

    $p0 = $_POST['p0'];
    $x0 = $p0;

    $p1 = $_POST['p1'];
    $x1 = $p1;


    $n = $_POST['n'];


    $fun = $_POST['fun'];


    // if (!empty($p0) && !empty($p1) && !empty($n) && !empty($fun)) {
    $isSubmitted = true;
    try {
        if (preg_match("/(?:sin|cos|tan)+/", $fun)) {
            $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.xsincota]/', '**', $fun);
            //echo $filteredExpression; // TODO: do valid for (tan, cos, sin) functions
            $actualFormula_p0 = str_replace('x', $conv[$p0], $filteredExpression);
            $actualFormula_p1 = str_replace('x', $conv[$p1], $filteredExpression);

        } else {

            $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.xsincota]/', '**', $fun);
            //echo $filteredExpression; // TODO: do valid for (tan, cos, sin) functions
            $actualFormula_p0 = str_replace('x', $p0, $filteredExpression);
            $actualFormula_p1 = str_replace('x', $p1, $filteredExpression);
        }

        $q0 = eval('return ' . $actualFormula_p0 . ';');
        $q1 = eval('return ' . $actualFormula_p1 . ';');


        $i = 2;
        while ($i <= $n) {
            $p = $p1 - ($q1 * ($p1 - $p0) / ($q1 - $q0));
            if (abs($p - $p1) < $TOL) {
                $errors['p0_equal_p1'] = 'p0 is equal to p1';
                $isSubmitted = false;
                break;
            }
            $i = $i + 1;
            $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.xsincota]/', '**', $fun);
            $actualFormula = str_replace('x', $p, $filteredExpression);
            $q = eval('return ' . $actualFormula . ';');

            if ($q * $q1 < 0) {
                $p0 = $p1;
                $q0 = $q1;
            }
            $p1 = $p;
            $q1 = $q;
            $store_x_results[] = $p;
            $Q_results[] = $q;

        }
    } catch (\Throwable $th) {
        $errors['invalidFunction'] = 'Invalid Function<br />';
        $isSubmitted = false;
    }
    // }
}
?>
<h4 class="text-primary">False position </h4>

<form action="" method="POST">
    <div class="w-60 px-2 py-3 mx-auto">
        <div class="input-group mb-3 d-flex align-items-center">
            <label class="mx-2" for="fx">f(x)</label>
            <input type="text" class="form-control py-1" name="fun" value="<?php echo htmlspecialchars($fun) ?>"
                required placeholder="Write the function f(x)" aria-label="Write the function f(x)"
                aria-describedby="fx">
            <!-- <span style="color: red;" class="error">
                <?php echo $errors['fun']; ?>
            </span> -->
        </div>

        <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
            <label class="mx-2" for="p0">p0</label>
            <!--  value="<?php echo htmlspecialchars($p0) ?>" -->
            <input type="number" name="p0" value="<?php echo htmlspecialchars($x0) ?>" class="form-control py-1"
                placeholder="p0" aria-label="p0" aria-describedby="p0" step="any" required>
            <!-- <span style="color: red;" class="error">
                <?php echo $errors['p0']; ?>
            </span> -->
            <label class="mx-2" for="p1">p1</label>
            <input type="number" name="p1" value="<?php echo htmlspecialchars($x1) ?>" class="form-control py-1"
                placeholder="p1" aria-label="p1" aria-describedby="p1" step="any" required>
            <!-- <span style="color: red;" class="error">
                <?php echo $errors['p1']; ?>
            </span> -->
        </div>

        <div class="input-group mb-3 d-flex align-items-center ">
            <label class="mx-2" for="n">maximum repetition n</label>
            <input type="number" name="n" class="form-control py-1" value="<?php echo htmlspecialchars($n) ?>" max="500"
                required min="5" aria-describedby="n">
            <!-- <span style="color: red;" class="error">
                <?php echo $errors['n']; ?>
            </span> -->
        </div>

        <input class="btn btn-primary w-100 d-block" type="submit" value="Execute" name="submit" required>
        <div style="color: red; text-align: center;">
            <!-- <h3 style="font-size: medium;">
                <?php echo $errors['p0_equal_p1']; ?>
            </h3> -->
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
                <?php for ($i = 1; $i < $n - 1; $i++): ?>
                <tr>
                    <th scope="row">
                        <?php echo $i + 1 ?>
                    </th>
                    <td>
                        <?php echo $store_x_results[$i] ?>
                    </td>
                    <td>
                        <?php echo $Q_results[$i] ?>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <?php endif; ?>
        <!---->
        <!-- if user enter invalid function as: xx -->
        <div style="color: red; text-align: center;">
            <!-- <h3 style=" font-size: medium;">
                <?php echo $errors['invalidFunction']; ?>
            </h3> -->
        </div>
    </div>
</form>