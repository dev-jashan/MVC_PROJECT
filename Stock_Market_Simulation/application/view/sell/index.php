<div class="">
    <div class="">
        <table class="table table-dark"  id="">
            <thead>
                <tr>
                    <th>Symbol</th><th>Price</th><th>Qty</th><th>Sell</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach ($this->sold as $sell) { ?>
                    <tr>
                        <td id="symbol"><div><?= $sell['stock_name']; ?></div></td>
                        <td id="open"><div><?= $sell['stock_price']; ?></div></td>
                        <td id="open"><div><?= $sell['qty']; ?></div></td>
                        <td id="sell"><span class="sellStk">Sell</span></td>           
                    </tr>        
                <?php } ?>                
            </tbody>
        </table>    
    </div>
</div>