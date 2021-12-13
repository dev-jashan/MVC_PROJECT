<h1>this is history</h1>
<div class="stockTable">
    <div class="stockStyle">
        <table class="table table-dark"  id="stockTable">
            <thead>
                <tr>
                    <th>Symbol</th><th>Price</th><th>Qty</th><th>Status</th><th>Date Of Purchase</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach ($this->history as $stock_history) { ?>
                    <tr>
                        <td id="symbol"><div><?= $stock_history['stock_name']; ?></div></td>
                        <td id="open"><div><?= $stock_history['price']; ?></div></td>
                        <td id="cls"><div><?= $stock_history['qty']; ?></div></td>
                        <td id="high" ><div><?= $stock_history['status']; ?></div></td>
                        <td id="low"><div><?= $stock_history['d_o_p']; ?></div></td>
                        <!-- <td id="trans"><div><?= $stock_history['transection']; ?></div></td> -->
                    </tr>        
                <?php } ?>                
            </tbody>
        </table>    
    </div>
</div>