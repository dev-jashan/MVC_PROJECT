<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2 id="hey">Shopping Cart</h2>
            <p id="cartStatus"></p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Stock name</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Status</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a>remove</th>
                  </tr>
                </thead>
                <tbody id="cartBody" class="cartBody">
                <?php foreach ($this->stocks as $stock) { ?>  
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">     
                        <div class="media-body">
                          <p class="d-block text-dark"><?= $stock['stock_name']; ?></p>
                        </div>
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4"><?= $stock['stock_open']; ?></td>
                    <td class="align-middle p-4"><input oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/[^0-9]/g, '$1');" type="text" class="form-control text-center" value=<?= $stock['stock_qty']; ?>></td></td>
                    <td class="text-right font-weight-semibold align-middle p-4"></td>
                    <td class="text-right font-weight-semibold align-middle p-4"><?= $stock['stock_status']; ?></td>
                    <td class="text-center align-middle px-0"><span class="remove" id="remove">X</span></td>
                  </tr>
                <?php } ?>  

                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->
        
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              
                <div class="text-right mt-4">
                  <label class="text-muted font-weight-normal m-0">Total price</label>
                  <div class="text-large"><strong id="grandTtl">0</strong></div>
                </div>
              </div>
            </div>
        
            <div class="float-right">
              <button type="button" class="btn btn-lg btn-primary mt-2" id="checkout">Checkout</button>
            </div>
        
          </div>
      </div>
  </div>
</dvi>
<script>





</script>