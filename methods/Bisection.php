
<?php

$fun = $a = $b = $n = $p = '';
$TOL = 0.0001;
$store_x_results = array();
$FA_results = array();
$isSubmitted = false;

if (isset($_POST['submit'])) {
  $isSubmitted = true;
  $a = $_POST['a'];
  $b = $_POST['b'];
  $n = $_POST['n'];
  $fun = $_POST['fun'];

  // $store = str_split($fun, 1);
  // echo $store[2];
  // echo '<br>';
  // str_replace("^","*","$fun");

  $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.x]/', '', $fun);
  echo $filteredExpression; // TODO: do valid for (tan, cos, sin) functions
  $actualFormula = str_replace('x', $a, $filteredExpression);
  $FA = eval('return ' . $actualFormula . ';');
  echo '<br>';
  echo tan($a);

  // echo $result;

  $i = 1;
  while ($i <= $n) { // 1 <= 50
    // p = a + (b - a)/2;
    $p = $a + ($b - $a) / 2;

    $filteredExpression = preg_replace('/[^\(\)\+\-\.\*\/\d+\.x]/', '', $fun);
    $actualFormula = str_replace('x', $p, $filteredExpression);
    $FP = eval('return ' . $actualFormula . ';');
    //If FP = 0 or (b − a)/2 < TOL
    if ($FP == 0 || ($b - $a) / 2 < $TOL) {
      echo $p; // TODO: Validation it !!!!!
      echo 'error';
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
    array_push($FA_results, $FA);


    $i = $i + 1;
    // echo '<br>';
    // echo $p;
    // echo '<br>';
  }

}

?>

<h4 class="text-primary">Bisection </h4>

<form action="" method="POST">
  <div class="w-60 px-2 py-3 mx-auto">
    <div class="input-group mb-3 d-flex align-items-center">
      <label class="mx-2" for="fx">f(x)</label>
      <input type="text" name="fun" class="form-control py-1" placeholder="Write the function f(x)"
        aria-label="Write the function f(x)" aria-describedby="fx">
    </div>
    <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
      <label class="mx-2" for="a">a</label>
      <!--  value="<?php echo htmlspecialchars($a) ?>" -->
      <input type="number" name="a" class="form-control py-1" placeholder="a" aria-label="a" aria-describedby="a">

      <label class="mx-2" for="b">b</label>
      <input type="number" name="b" class="form-control py-1" placeholder="b" aria-label="b" aria-describedby="b">
    </div>

    <div class="input-group mb-3 d-flex align-items-center ">
      <label class="mx-2" for="n">maximum repetition n</label>
      <input type="number" name="n" class="form-control py-1" value="5" max="500" min="1" aria-describedby="n">
    </div>
    <input class="btn btn-primary" type="submit" value="Execute" name="submit">

    <table class="table table-hover mt-5">
      <thead>
        <tr class="table-primary">
          <th scope="col">n</th>
          <th scope="col">x</th>
          <th scope="col">f(x)</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0; $i<$n; $i++):
        ?>
        <tr>
          <th scope="row"><?php echo $i+1 ?></th>
          <td><?php echo $store_x_results[$i] ?></td>
          <td><?php echo $FA_results[$i] ?></td>
        </tr>
        <?php endfor;
        ?>
      </tbody>
    </table>

  </div>
</form>

