<!DOCTYPE html>
<?php
$total = 0.0;
$ageItems = array();
$showModal = false;

// setup array for age dropdown
for ($i = 1; $i < 99; $i++) {
  if (($i == 13) || ($i == 65)) {
    array_push($ageItems, '<li role="separator" class="divider"></li>');
  }
  array_push($ageItems, '<li onclick="setAge(' . $i . ')"><a href="#">' . $i . '</a></li>');
}
// make sure price and age have been entered
if (isset($_POST['price']) && (isset($_POST['age']))) {
    // make sure price is only number with no leading 0
    if (preg_match('/^[1-9][0-9]*$/', $_POST['price'])) {
        $price = $_POST['price'];

        // set tax amount
        $tax = (isset($_POST['nscustomer']) ? 1.2 : 1.15);

        // discount starts at 0%
        $discount = 1.0;

        // caculate amount to discount
        $discount -= (($_POST['age'] > 64) ? 0.05 : (($_POST['age'] < 13) ? 0.1 : 0)) +
                     (isset($_POST['loyalty']) ? 0.02 : 0);

        // caculate total after discount and tax
        $total = ($price * $discount * $tax);

        // format output
        $result = number_format($total) . '</br>From IP: ' . $_SERVER['REMOTE_ADDR'];
    }
}

// toggle order modal
if ($total !== 0.0) {
  $showModal = true;
}
?>

<html>
  <head>
    <title>POS</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <!-- --------------------------------- MAIN PANEL -->
    <div id="mainPanel" class="row col-sm-12">
      <div class="col-sm-6 panel panel-primary" >
        <!------------------------------ PANEL HEADER -->
        <div class="panel-heading">
          <h3>Chris' Awesome Calculator</h3>
        </div>
        <!-------------------------------- PANEL BODY -->
        <div class="panel-body" style="background-color:#D3D3D3;">
          <div>
            <form id="main" method="post">
              <!-- original price -->
              <div class="input-group">
                <span class="input-group-addon" id="lblPrice" >$&nbsp;</span>
                <input type="text" id="txtPrice" class="form-control" name="price" placeholder="Original Price (to the nearest dollar)" aria-describedby="lblPrice" />
                <span class="input-group-addon">.00</span>
              </div>
              <!-- tax -->
              <div class="input-group">
                <span class="input-group-addon">
                  <input type="checkbox" name="nscustomer"  aria-label="...">
                </span>
                <input type="text" class="form-control" disabled="true" aria-label="..." value="Nova Scotia Customer" >
              </div>
              <!-- loyalty -->
              <div class="input-group">
                <span class="input-group-addon">
                  <input type="checkbox" name="loyalty"  aria-label="...">
                </span>
                <input type="text" class="form-control" disabled="true" aria-label="..." value="Loyalty Discount" >
              </div>
              <!-- age -->
              <div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Age <span class="caret"></span></button>
                  <ul class="dropdown-menu scrollable-menu">
                    <?php if($ageItems): ?>
                      <?php foreach($ageItems as $items): ?>
                        <?php echo $items; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </ul>
                </div>
                <input type="text" id="txtAge" name="age" class="form-control" placeholder="Enter or Select Age" aria-label="...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit">Go!</button>
                </span>
              </div>
              <!-- php script to check for modal toggle -->
              <?php if($showModal) { ?>
              <script type='text/javascript'>
                // Show modal
                $(document).ready(function(){
                  $('#confermModal').modal('show');
                  $('#modalLast').focus();
                });
              </script>
              <!-- button to open the last order -->
              <button type="button" id="modalLast" class="btn btn-info btn-sm" data-toggle="modal" data-target="#confermModal">Open Last Order</button>
              <?php } ?>
              <!------------------  CONFERMATION MODAL -->
              <div id="confermModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Order Confirmation:</h4>
                    </div>
                    <div class="modal-body">
                      <table>
                        <tr>
                          <td>Price: </td>
                          <td><?php echo '$' . number_format($price, 2); ?></td>
                        </tr>
                        <tr>
                          <td>Discount: </td>
                          <td><?php echo '$' . number_format(($price - ($price * $discount)), 2); ?></td>
                        </tr>
                        <tr>
                          <td>Price After Discount: </td>
                          <td><?php echo '$' . number_format(($price * $discount), 2); ?></td>
                        </tr>
                        <tr>
                          <td>Tax: </td>
                          <td><?php echo '$' . number_format(($price * ($tax - 1)), 2); ?></td>
                        </tr>
                        <tr>
                          <td>Total: </td>
                          <td><?php echo '$' . number_format($total); ?></td>
                        </tr>
                        <tr>
                          <td class="tdExclude">Ip:</td>
                          <td class="tdExclude"><?php echo $_SERVER['SERVER_ADDR']; ?></td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </body>
    <script src="TextboxValidator.js"></script>
    <script src="myjs.js"></script>
    <!-- text validation -->

</html>
