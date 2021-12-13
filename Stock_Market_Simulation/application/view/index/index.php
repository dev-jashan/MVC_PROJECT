<h1>hi this is index</h1>
<div class="stockTable">
    <div class="stockStyle">
        <table class="table table-dark"  id="stockTable">
            <thead>
                <tr>
                    <th>Symbol</th><th>Open</th><th>close</th><th>High</th><th>Low</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach ($this->stocks as $stock) { ?>
                    <tr>
                        <td id="symbol"><?= $stock['symbol']; ?></td>
                        <td id="open"><?= $stock['open']; ?></td>
                        <td id="cls"><?= $stock['close']; ?></td>
                        <td id="high" ><?= $stock['high']; ?></td>
                        <td id="low"><?= $stock['low']; ?></td>
                    </tr>        
                <?php } ?>               
            </tbody>
        </table>    
    </div>
</div>
