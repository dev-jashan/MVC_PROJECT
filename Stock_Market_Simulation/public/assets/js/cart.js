(function(){
    let allQty=[];
    let allTtl=[];
    let storeQty=[];
    let qtyArray=[];
    let nameArray=[];
    let storeName=[];
    let checkoutStocks=[];
    /* get id of all the elements */
    function setEventListeners(){
        cartQty();
        sendCart();
        removeStock();
       
	}

    //get quantity of stocks
    function cartQty(){
        document.querySelectorAll(".remove").forEach(function(item){
        
            let getAllQty=item.parentElement.parentElement.children[2].children[0].value; 
            let getName=item.parentElement.parentElement.children[0].children[0].children[0].children[0].innerHTML;
            let getStkPrice=item.parentElement.parentElement.children[1].innerHTML;
            let status=item.parentElement.parentElement.children[4].innerHTML;
            console.log(g)
            if(status=='sell'){
                item.parentElement.parentElement.children[2].children[0].readOnly = true;
                
            }
            item.parentElement.parentElement.children[3].innerHTML=parseFloat(getStkPrice)*parseInt(getAllQty);

            Array.from(document.getElementsByTagName("input")).forEach(form_input =>{
                form_input.addEventListener('focusout', function(){
                    console.log('focusout is working');

                    let getQty=item.parentElement.parentElement.children[2].children[0].value;
                    getName=item.parentElement.parentElement.children[0].children[0].children[0].children[0].innerHTML;

                    getStkPrice=item.parentElement.parentElement.children[1].innerHTML;
                     sell=item.parentElement.parentElement.children[4].innerHTML;
                     if(sell=='sell'){
                        console.log(getQty);
                        checkSellQty(getAllQty,getQty);
                    }
                    //console.log(getQty);
                    // console.log(typeof(getQty));
                    item.parentElement.parentElement.children[3].innerHTML=parseFloat(getStkPrice)*parseInt(getQty);

                    allQty.unshift(parseFloat(item.parentElement.parentElement.children[3].innerHTML));
                    allTtl.unshift(allQty);                  

                    qtyArray.unshift(getQty);
                    storeQty.unshift(qtyArray);

                    nameArray.unshift(getName);
                    storeName.unshift(nameArray);

                    cartTtl(allTtl,storeQty,storeName);
                });
                
            });

            
        })
    }

    // get cart total
    function cartTtl(total,qty,name){
       
        let i=0;
        let sum = 0;
        let grandTtl=[];
        let stockQty=[];
        let stockName=[];
        let date=[];
        let day =  new Date();

        document.querySelectorAll(".remove").forEach(function(item){
           
           
            stockName.push(name[0][i]);
            stockQty.push(qty[0][i]);
            grandTtl.push(total[0][i]);
            date.push(day.toLocaleDateString())
            i++;
        })
       
        
        for (let i = 0; i < grandTtl.length; i++) {
            sum += grandTtl[i];
        }

        document.getElementById("grandTtl").innerHTML=sum;
       
        
    }

    //send stocks to cart
    function sendCart(){
        let day =  new Date();
        let checkout=document.getElementById("checkout");
        checkout.addEventListener("click", function() {
            
            
            document.querySelectorAll(".remove").forEach(function(item){
                let all=[];
            
                let getQty=item.parentElement.parentElement.children[2].children[0].value;
                let getName=item.parentElement.parentElement.children[0].children[0].children[0].children[0].innerHTML;
                let getStkPrice=item.parentElement.parentElement.children[1].innerHTML;
                let status=item.parentElement.parentElement.children[4].innerHTML;
                let stockPrice=parseFloat(getStkPrice).toFixed(2)*parseInt(getQty);
                all.push(getName,getQty,stockPrice.toString(),status,day.toLocaleDateString());
                checkoutStocks.push(all)
                

            })
            cartAjax(checkoutStocks);
        }, {once : true});

    }

    //get the sell qty
    function checkSellQty(data,data2){
        let checkoutBtn = document.getElementById("checkout");
        
        if(data2>data){
            checkoutBtn.style.display='none';
        }else{
            checkoutBtn.style.display='block';
        }
        
    }
    //send cart to AJAX
    function cartAjax(data){
            
        
        
        let ajaxData = JSON.stringify(checkoutStocks);
        
       
        $.ajax({
            
            type: "POST",
            url: 'http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/trans/checkoutData',
            data: {data : ajaxData},
            success: function(data){
            
                let cartStatus=document.getElementById('cartStatus');
                console.log(data);
                if(data){

                    let msg='Transaction Complete';
                    cartStatus.style.backgroundColor='green';
                    cartStatus.innerText=msg;
                    setTimeout(function(){
                        window.location.replace('http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/main/index');
                        
                    }, 2000);
                }
                
            },
            error: function(xhr, status, error){
                console.error(xhr);
            }
        });
    }

    // remove stocks if clicked to remove button
    function removeStock(){
        let getTotal=document.getElementById("grandTtl");
        Array.from(document.querySelectorAll(".remove")).forEach(remove =>{

            remove.addEventListener("click", function(){
                console.log('remove was clicked');
                let deleteStk=remove.parentElement.parentElement;
                //updateTotal=remove.parentElement.parentElement.children[3].innerHTML;
                let getName=remove.parentElement.parentElement.children[0].children[0].children[0].children[0].innerHTML;
                
               
                console.log(getName);
                //console.log(updateTotal);

                $.ajax({
            
                    type: "POST",
                    url: 'http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/trans/removeStock',
                    data: {data : getName},
                    success: function(data){
                        let cartStatus=document.getElementById('cartStatus');
                        if(data){

                            let msg='Removing From Cart';
                            cartStatus.style.backgroundColor='red';
                            cartStatus.innerText=msg;
                            setTimeout(function(){
                                deleteStk.remove();
                                location.reload()
                            }, 2000);
                        }
                        
                    },
                    error: function(xhr, status, error){
                        console.error(xhr);
                    }
                });
                
            });

        });
        
    }

    function init(){
        setEventListeners()
    }

    document.addEventListener("DOMContentLoaded", function (){
        init();
    });
})();
