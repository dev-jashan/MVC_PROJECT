(function(){
    let allCards=[];
    
    function init(){

        console.log("this is main page")
        let statusBuy="buy";
        let statusSell="sell";
       
        // get data when but button is clicked
        document.querySelectorAll(".buyStk").forEach(function(item){
           
            item.addEventListener("click", function(e){
                //document.getElementById('formUsers').style.display='block';
               console.log('edit button is clicked');
               let data=[];
               
                let tds=e.target.parentNode.parentNode.children;
                console.log(tds);
                for (let td of tds) {
                    let dataDiv = td.firstChild;
                    let columnValue = dataDiv.innerText;
                    console.log(columnValue);
                    data.push(columnValue);
                    
                    //let columnValue = dataDiv.innerText;
                 
                }
                getData(data,statusBuy);
            })
            
        })

        // get data when sell data is clicked
        document.querySelectorAll(".sellStk").forEach(function(item){
           
            item.addEventListener("click", function(e){
                //document.getElementById('formUsers').style.display='block';
                let tds=e.target.parentNode.parentNode.children;
               console.log('sell button is clicked');
               let data=[];
                for (let td of tds) {
                    let dataDiv = td.firstChild;
                    let columnValue = dataDiv.innerText;
                    console.log(columnValue);
                    data.push(columnValue);
                }

                getSellData(data,statusSell);
            })
            
        })


    //     /* submitting the form */ 
     
	}



    function getSellData(data,status){
        
        let tableData=[data[0],data[1],data[2],status];
       
        let sellData = JSON.stringify(tableData);
        console.log(sellData);
      
        $.ajax({
            
            type: "POST",
            url: 'http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/trans/getSellData',
            data: {data : sellData},
            success: function(data){
                console.log(data);
            },
            error: function(xhr, status, error){
                console.error(xhr);
            }
        });

    }


    function getData(data,status){
        
        let tableData=[data[0],data[1],data[2],data[3],data[4],status];
        let jsonData = JSON.stringify(tableData);
        //console.log(jsonString);
      
        $.ajax({
            
            type: "POST",
            url: 'http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/trans/getBuyData',
            data: {data : jsonData},
            success: function(data){
                console.log(data);
            },
            error: function(xhr, status, error){
                console.error(xhr);
            }
        });

    }

    document.addEventListener("DOMContentLoaded", function (){

        let money=document.getElementById('money');
        let sellBtn=document.getElementById('sellBtn');
        let cartBtn=document.getElementById('cartBtn');
        let stockTable=document.getElementById('stockTable');
        let moneyContainer=document.getElementById('lostContainer');

        init();;

        // if money is 0 then show the losing text
         if(money.innerText==0){
            moneyContainer.style.display='block';
            sellBtn.style.display='none';
            cartBtn.style.display='none';
            stockTable.style.display='none';
        }else{
            moneyContainer.style.display='none';
            
        }
    });
})();
