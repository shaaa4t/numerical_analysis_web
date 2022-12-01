
          <h4 class="text-primary">position method</h4>
          <div class="w-60 px-2 py-3 mx-auto">
            <div class="input-group mb-3 d-flex align-items-center">
              <label class="mx-2" for="fx">f (x)</label>
              <input type="text" class="form-control py-1" placeholder="Username" aria-label="Username" aria-describedby="fx">
            </div>

            <div class="input-group mb-3 d-flex align-items-center justify-content-between ">
              <label class="mx-2" for="a">a</label>
              <input type="text" class="form-control py-1" placeholder="a" aria-label="a" aria-describedby="a">

              <label class="mx-2" for="b">b</label>
              <input type="text" class="form-control py-1" placeholder="b" aria-label="b" aria-describedby="b">
            </div>

            <div class="input-group mb-3 d-flex align-items-center ">
              <label class="mx-2" for="n">maximum repetition n</label>
              <input type="number" class="form-control py-1" value="6" max="10" min="3" aria-describedby="n">
            </div>

            <button class="btn btn-primary">Execute</button>

            <table class="table table-hover mt-5">
              <thead>
                <tr class="table-primary">
                  <th scope="col">n</th>
                  <th scope="col">x</th>
                  <th scope="col">accuracy x</th>
                  <th scope="col">f(x)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>1</td>
                  <td>5</td>
                  <td>4.71633781453677374</td>
                </tr>
                <tr>
                  <th scope="row">22</th>
                  <td>4</td>
                  <td>.5</td>
                  <td>4.71633781453677374</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td >5</td>
                  <td >0.50125</td>
                  <td>4.71633781453677374</td>
                </tr>
              </tbody>
            </table>
            
          </div>