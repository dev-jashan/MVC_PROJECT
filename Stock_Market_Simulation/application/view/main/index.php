<div id="moneyContainer"><p id='userMoney'>YOUR ACCOUNT : $<span id="money"> <?= $_SESSION['userMoney']; ?> </span></p>
    <div id="lostContainer">
        <p id="lost">YOU LOST 👎</p>
        <p id="lost">CREATE A NEW ACCOUNT</p>
        <p id="lost">AND PLAY AGAIN!! 👍</p>
    </div>
</div>
<div class="stockTable" id="stockTable">
    <div class="stockStyle">
        <table class="table table-dark"  id="stockTable">
            <thead>
                <tr>
                    <th>Symbol</th><th>Open</th><th>close</th><th>High</th><th>Low</th><th>Buy</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach ($this->stocks as $stock) { ?>
                    <tr>
                        <td id="symbol"><div><?= $stock['symbol']; ?></div></td>
                        <td id="open"><div><?= $stock['open']; ?></div></td>
                        <td id="cls"><div><?= $stock['close']; ?></div></td>
                        <td id="high" ><div><?= $stock['high']; ?></div></td>
                        <td id="low"><div><?= $stock['low']; ?></div></td>
                        <td id="buy"><span class="buyStk">BUY</span></td>           
                    </tr>        
                <?php } ?>                
            </tbody>
        </table>    
    </div>
</div>