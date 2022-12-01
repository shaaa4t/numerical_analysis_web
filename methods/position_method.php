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
}
?>
          <h4 class="text-primary">False position </h4>
          <form action="" method="POST">
          <div class="w-60 px-2 py-3 mx-auto">
            <div class="input-group mb-3 d-flex align-items-center">
              <label class="mx-2" for="fx">f(x)</label>
              <input type="text" class="form-control py-1" name="fun" placeholder="Write the function f(x)" aria-label="Write the function f(x)" aria-describedby="fx">
            </div>

            <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
              <label class="mx-2" for="a">a</label>
              <input type="text" class="form-control py-1" placeholder="a" aria-label="a" aria-describedby="a">

              <label class="mx-2" for="b">b</label>
              <input type="text" class="form-control py-1" placeholder="b" aria-label="b" aria-describedby="b">
            </div>

            <div class="input-group mb-3 d-flex align-items-center ">
              <label class="mx-2" for="n">maximum repetition n</label>
                <label>
                    <input type="number" class="form-control py-1" value="6" max="50" min="3" aria-describedby="n">
                </label>
            </div>

<!--            <button class="btn btn-primary">Execute</button>-->
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
<!--                          <td>--><?php //echo $store_x_results[$i] ?><!--</td>-->
<!--                          <td>--><?php //echo $FA_results[$i] ?><!--</td>-->
                      </tr>
                  <?php endfor;
                  ?>
                  </tbody>
              </table>

          </div>

 </form>