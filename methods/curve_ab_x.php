<?php

$errors = array('divideByZeroError' => '', 'x_array' => '', 'y_array' => '', 'n' => '', 'invalidInput' => '');
$x_array = array();
$y_array = array();
$n = 5;

$isSubmitted = false;
$isSolved = false;

$sumX = $sumX2 = $sumY = $sumXY = 0;

$a_result = '';
$b_result = '';


if (isset($_POST['submit'])) {

    if (empty($_POST['n'])) {
        $errors['n'] = 'n is required <br />';
    } else {
        $n = $_POST['n'];
        $isSubmitted = true;
    }
}


if (isset($_POST['solve'])) {
    $isSubmitted = true;
    if (empty($_POST['n'])) {
        $errors['n'] = 'number is required <br />';
    } else {
        $n = $_POST['n'];
    }

    if (!empty($_POST['n'])) {

        for ($i = 0; $i < $n; $i++) {
            $x_array[$i] = $_POST['x' . $i];
            $y_array[$i] = $_POST['y' . $i];
        }

        try {
            for ($i = 0; $i < $n; $i++) {
                $sumX = $sumX + $x_array[$i];
                $sumX2 = $sumX2 + $x_array[$i] * $x_array[$i];
                $sumY = $sumY + log($y_array[$i]);
                $sumXY = $sumXY + $x_array[$i] * log($y_array[$i]);
            }

            # Finding coefficients A and B
            $B = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
            $A = ($sumY - $B * $sumX) / $n;

            # Obtaining a and b
            $a = exp($A);
            $b = exp($B);

            # Displaying coefficients a, b & equation
            $a_result = $a;
            $b_result = $b;

            $isSolved = true;
        } catch (\DivisionByZeroError $th) {
            $error['divideByZeroError'] = 'Please enter different values of numbers of x';
        }
    }

}

?>
<h4 class="text-primary">Curve Fitting <br> y = ab<sup>x</sup></h4>


<form action="" method="POST">
    <div class="w-60 px-2 py-3 mx-auto">

        <div class="input-group mb-3 d-flex align-items-center ">
            <label class="mx-2" for="n">Enter Number</label>
            <label>
                <input type="number" name="n" class="form-control py-1"value="<?php echo htmlspecialchars(empty($n) ? 0 : $n) ?>"
                    max="500" min="2" aria-describedby="n" required>
                    <!--  -->
            </label>
            <div style="color: red;">
                <?php echo $errors['n']; ?>
            </div>
        </div>
        <input class="btn btn-primary w-100 d-block" type="submit" value="Execute" name="submit" >

        <?php if ($isSubmitted): ?>

        <table class="table table-hover mt-5">
            <thead>
                <tr class="table-primary">
                    <th scope="col">n</th>
                    <th scope="col">x</th>
                    <th scope="col">y</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < $n; $i++):
                ?>
                <tr>
                    <th scope="row">
                        <?php echo $i + 1 ?>
                    </th>
                    <th scope="row">
                        <label>
                            <input class="form-control py-1" name="<?php echo 'x' . $i ?>" type="number" step="any" required
                                value="<?php echo htmlspecialchars($x_array[$i]) ?>">

                        </label>
                    </th>
                    <th scope="row">
                        <label>
                            <input class="form-control py-1" name="<?php echo 'y' . $i ?>" type="number" step="any" required
                                value="<?php echo htmlspecialchars($y_array[$i]) ?>">
                        </label>
                    </th>
                </tr>

                <?php endfor;
                ?>
            </tbody>
        </table>
            <input class="btn btn-primary w-100 d-block mt-4" name="solve" type="submit" value="Solve">
        <?php endif; ?>
        <center>
            <div style="color: red; text-align: center;">
                <h3 style="font-size: medium;">
                    <?php echo $errors['divideByZeroError']; ?>
                </h3>
            </div>
            <div style="color: red; text-align: center;">
                <h3 style="font-size: medium;">
                    <?php echo $errors['invalidInput']; ?>
                </h3>
            </div>
            <div>
                <h3 style="font-size: x-large; color: green;">
                <p>
                    <?php echo $isSolved ? 'Coefficients are' : ''; ?>
                    <?php
                    if ($isSolved):
                    ?>
                </p>
                    <table class="table table-hover mt-5">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">a</th>
                                <th scope="col">b</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $a_result ?>
                                </td>
                                <td>
                                    <?php echo $b_result ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php endif; ?>

                </h3>
            </div>
        </center>

    </div>
</form>