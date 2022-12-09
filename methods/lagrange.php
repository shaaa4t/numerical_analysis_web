<?php

$errors = array('divideByZeroError' => '', 'x_array' => '', 'y_array' => '', 'xp' => '', 'n' => '', 'invalidInput' => '');
$x_array = array();
$y_array = array();
$n = 5;
$xp = (float) 0;
$isSubmitted = false;
$isSolved = false;
$result = '';

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
    if (empty($_POST['xp'])) {
        $errors['xp'] = 'interpolation point is required <br />';
    } else {
        $xp = $_POST['xp'];
    }


    if (!empty($_POST['n']) && !empty($_POST['xp'])) {

        for ($i = 0; $i < $n; $i++) {
            $x_array[$i] = $_POST['x' . $i];
            $y_array[$i] = $_POST['y' . $i];
        }
        try {
            $yp = 0;
            for ($i = 0; $i < $n; $i++) {
                $p = 1;
                for ($j = 0; $j < $n; $j++) {
                    if ($i != $j) {
                        $p = $p * ($xp - $x_array[$j]) / ($x_array[$i] - $x_array[$j]);
                    }
                }
                $yp = $yp + $p * $y_array[$i];
            }
            $result = $yp;
            $isSolved = true;
        } catch (\DivisionByZeroError $th) {
            $error['divideByZeroError'] = 'Please enter different values of numbers of x';
        }
    }

}

?>
<h4 class="text-primary">Lagrange Method</h4>

<form action="" method="POST">
    <div class="w-60 px-2 py-3 mx-auto">

        <div class="input-group mb-3 d-flex align-items-center ">
            <label class="mx-2" for="n">Enter Number</label>
            <label>
                <input type="number" name="n" class="form-control py-1"
                    value="<?php echo htmlspecialchars(empty($n) ? 0 : $n) ?>" max="500" min="2" aria-describedby="n">
            </label>
            <div style="color: red;">
                <?php echo $errors['n']; ?>
            </div>
        </div>
        <input class="btn btn-primary w-100 d-block" type="submit" value="Execute" name="submit">

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
                            <input name="<?php echo 'x' . $i ?>" type="number"
                                value="<?php echo htmlspecialchars($x_array[$i]) ?>">

                        </label>
                    </th>
                    <th scope="row">
                        <label>
                            <input name="<?php echo 'y' . $i ?>" type="number"
                                value="<?php echo htmlspecialchars($y_array[$i]) ?>">
                        </label>
                    </th>
                </tr>

                <?php endfor;
                ?>
            </tbody>
        </table>
        <label class="mx-2" for="n">interpolation point</label>

        <label>
            <input class="form-control py-1" type="text" name="xp" value="<?php echo htmlspecialchars($xp) ?>"
                aria-describedby="xp">
        </label>
        <div style="color: red;">
            <?php echo $errors['xp']; ?>
        </div>
        <label>
            <input class="btn btn-primary w-100 d-block" name="solve" type="submit" value="Solve">
        </label>
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
                    <?php echo $isSolved ? 'f(' . $xp . ') = ' . $result : ''; ?>
                </h3>
            </div>
        </center>

    </div>
</form>