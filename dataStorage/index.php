<?php 
    
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'stock_market';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);  
    function console_log( $data ){
        $toDebug = json_encode($data);
        $toConsole = <<<EOD
        <script>
            console.log('$toDebug')
        </script>
    EOD;
        echo $toConsole;
    }
    

if ($conn->connect_error) {
 printf("not connected\n");      
 
}else{
    printf("connected to the database\n\n");      
}
$deleteStkData = $conn->prepare("DELETE FROM stockinfo;");
$deleteStkData->execute();
ini_set('max_execution_time', '1200');

 $symbols = ['AAPL', 'MSFT', 'TQQQ', 'TLT', 'DIA', 'SPY','GOOG','AMZN','FB','NVDA','HD','JNJ','WMT','BAC','ADBE','NFLX','NKE','ORCL','PEP','DHR','CVX','VZ','QCOM','ABBV','MRK','INTC' 
  ,'WFC','INTU','MCD','AMD','UPS','LOW','ARVL','SEED','SREA','RXRAW','RYAAY','RYH','QUBT','QUIK','QTJL','EZM','ENLV','BTU','GYRO','HAAC','HAIL','DOGZ','TMAC','PSA','PRVB','ONEY','TSLA','T','TSM','AA','NRC','LPL','LFUS','KMDA','JANX','IVOV','IVES','IT','HEQT','HDB','HCI'];
//$symbols = ['AAPL'];
$urls = array();
$stack = array();
foreach ($symbols as $symbol){
    array_push($urls, "https://www.alphavantage.co/query?interval=30min&function=TIME_SERIES_INTRADAY&symbol=".$symbol."&apikey=C70HZ4AUFXV9S6V8");
}

printf("fetching new stock data....\n"); 

foreach ($urls as $url){
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: alpha-vantage.p.rapidapi.com",
            "x-rapidapi-key: 196f9ac294mshf393d3728c24446p13eb0fjsne19c87d8a448"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        
        array_push($stack,$response);
       // console_log($stack);
    }
    sleep(12);
}
foreach($stack as $stock=>$value){
    $jsonData=json_decode($value, true);
    //console_log($jsonData[key($jsonData)]);
    $get_all_values=array_values($jsonData);
   // console_log($get_all_values);
    
    
    // get stock name and info
    $get_info=$get_all_values[0];
    $get_data=array_values($get_info);
    //get time of the current stock
    $get_recent_stock=$get_all_values[1];
    $get_time=array_values($get_recent_stock);

    // all the time and date we have to use
    $get_keys=array_keys($get_recent_stock);
   // console_log($get_keys);
    
    $get_time_info=array_values($get_time[0]);

    $get_open=$get_time_info[0];
    $get_high=$get_time_info[1];
    $get_low=$get_time_info[2];
    $get_close=$get_time_info[3];
    $get_vol=$get_time_info[4];

    $stmt = $conn->prepare("INSERT INTO stockinfo (symbol, open, close,high,low) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $get_data[1], $get_open, $get_close,$get_low,$get_high);
    $stmt->execute();
}
    printf("\ndata is fetched successfully!!"); 
    $stmt->close();
    $conn->close();

?>
