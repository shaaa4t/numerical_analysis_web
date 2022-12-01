<?php

$errors = array('fun' => '', 'a' => '', 'b' => '', 'n' => '', 'invalidFunction' => '', 'a_equal_b' => '');

$x0 = $x1 = $fun = $a = $b =  $p = '';
$n = 1;
$TOL = 0.0001;
$store_x_results = array();
$FP_results = array();
$isSubmitted = false;

if (isset($_POST['submit'])) {
  if (empty($_POST['a'])) {
    $errors['a'] = 'a is required <br />';
  } else {
    $a = $_POST['a'];
    $x0 = $a;
  }

  if (empty($_POST['b'])) {
    $errors['b'] = 'b is required <br />';
  } else {
    $b = $_POST['b'];
    $x1 = $b;
  }

  if (empty($_POST['n'])) {
    $errors['n'] = 'n is required <br />';
  } else {
    $n = $_POST['n'];
  }

  if (empty($_POST['fun'])) {
    $errors['fun'] = 'fun is required <br />';
  } else {
    $fun = $_POST['fun'];
  }

  if (!empty($a) && !empty($b) && !empty($n) && !empty($fun)) {
    $isSubmitted = true;
    try {
      $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.x]/', '', $fun);
      //echo $filteredExpression; // TODO: do valid for (tan, cos, sin) functions
      $actualFormula = str_replace('x', $a, $filteredExpression);
      $FA = eval('return ' . $actualFormula . ';');

      $i = 1;
      while ($i <= $n) { // 1 <= 50
        // p = a + (b - a)/2;
        $p = $a + ($b - $a) / 2;

        $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.x]/', '', $fun);
        $actualFormula = str_replace('x', $p, $filteredExpression);
        $FP = eval('return ' . $actualFormula . ';');
        //If FP = 0 or (b − a)/2 < TOL
        if ($FP == 0 || ($b - $a) / 2 < $TOL) {
          // echo $p;
          $errors['a_equal_b'] = 'a is equal to b';
          $isSubmitted = false;
          break;
        }

        //If FA · FP > 0 then set a = p;
        if ($FA * $FP > 0) {
          $a = $p;
          $FA = $FP;
        } else {
          $b = $p;
        }
        array_push($store_x_results, $p);
        array_push($FP_results, $FP);

        $i = $i + 1;
      }
    } catch (\Throwable $th) {
      $errors['invalidFunction'] = 'Invalid Function <br />';
      $isSubmitted = false;
    }

  }
}

?>

<h4 class="text-primary">Bisection</h4>

<form action="" method="POST">
  <div class="w-60 px-2 py-3 mx-auto">
    <div class="input-group mb-3 d-flex align-items-center">
      <label class="mx-2" for="fx">f(x)</label>
      <input type="text" name="fun" value="<?php echo htmlspecialchars($fun) ?>"  class="form-control py-1" placeholder="Write the function f(x)"
        aria-label="Write the function f(x)" aria-describedby="fx">
      <div style="color: red;">
        <?php echo $errors['fun']; ?>
      </div>
    </div>
    <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
      <label class="mx-2" for="a">a</label>
      <!--  value="<?php echo htmlspecialchars($a) ?>" -->
      <input type="number" name="a" value="<?php echo htmlspecialchars($x0) ?>" class="form-control py-1" placeholder="a" aria-label="a" aria-describedby="a">
      <div style="color: red;">
        <?php echo $errors['a']; ?>
      </div>
      <label class="mx-2" for="b">b</label>
      <input type="number" name="b"  value="<?php echo htmlspecialchars($x1) ?>"  class="form-control py-1" placeholder="b" aria-label="b" aria-describedby="b">
      <div style="color: red;">
        <?php echo $errors['b']; ?>
      </div>
    </div>

    <div class="input-group mb-3 d-flex align-items-center ">
      <label class="mx-2" for="n">maximum repetition n</label>
      <input type="number" name="n" class="form-control py-1" value="<?php echo htmlspecialchars($n) ?>"  max="500" min="1" aria-describedby="n">
      <div style="color: red;">
        <?php echo $errors['n']; ?>
      </div>
    </div>
    <!-- <div style="color: red;">
        <?php echo $errors['n']; ?>
      </div> -->
    <input class="btn btn-primary" type="submit" value="Execute" name="submit">
    <div style="color: red; text-align: center;">
      <h3 style="font-size: medium;">
        <?php echo $errors['a_equal_b']; ?>
      </h3>
    </div>

    <?php if ($isSubmitted == true): ?>

    <table class="table table-hover mt-5">
      <thead>
        <tr class="table-primary">
          <th scope="col">n</th>
          <th scope="col">x</th>
          <th scope="col">f(x)</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0; $i < $n; $i++):
        ?>
        <tr>
          <th scope="row">
            <?php echo $i + 1 ?>
          </th>
          <td>
            <?php echo $store_x_results[$i] ?>
          </td>
          <td>
            <?php echo $FP_results[$i] ?>
          </td>
        </tr>
        <?php endfor;
        ?>
      </tbody>
    </table>
    <?php endif; ?>

    <!-- if user enter invalid function as: xx -->
    <div style="color: red; text-align: center;">
      <h3 style="font-size: medium;">
        <?php echo $errors['invalidFunction']; ?>
      </h3>
    </div>
  </div>
</form>