
    let cart = [];

    let total = 0;

    function addToCart(item, price) {
      cart.push(item);
      total += parseInt(price);
    
      let itemElement = document.createElement("p");
      itemElement.innerHTML = `<p>${item}</p>  <p>$${price}</p>`;
    
      document.getElementById("cart").appendChild(itemElement);
    
      document.getElementById("total").innerText = " $" + total;
    }
    
    document.getElementById("add-item-1").addEventListener("click", function() {
      let item = document.getElementById("item-1").innerText;
      let price = document.getElementById("price-1").innerText;
      addToCart(item,price);
    });
    
    document.getElementById("add-item-2").addEventListener("click", function() {
      let item = document.getElementById("item-2").innerText;
      let price = document.getElementById("price-2").innerText;
      addToCart(item,price);
    });
    
    document.getElementById("add-item-3").addEventListener("click", function() {
      let item = document.getElementById("item-3").innerText;
      let price = document.getElementById("price-3").innerText;
      addToCart(item,price);
    });
    
    document.getElementById("add-item-4").addEventListener("click", function() {
      let item = document.getElementById("item-4").innerText;
      let price = document.getElementById("price-4").innerText;
      addToCart(item,price);
    });
    
    document.getElementById("add-item-5").addEventListener("click", function() {
      let item = document.getElementById("item-5").innerText;
      let price = document.getElementById("price-5").innerText;
      addToCart(item,price);
    });
    
    document.getElementById("add-item-6").addEventListener("click", function() {
        let item = document.getElementById("item-6").innerText;
        let price = document.getElementById("price-6").innerText;
        addToCart(item, price);
      });

      document.getElementById("add-item-7").addEventListener("click", function() {
        let item = document.getElementById("item-7").innerText;
        let price = document.getElementById("price-7").innerText;
        addToCart(item, price);
      });

      document.getElementById("add-item-8").addEventListener("click", function() {
        let item = document.getElementById("item-8").innerText;
        let price = document.getElementById("price-8").innerText;
        addToCart(item, price);
      });

    document.getElementById("clear").addEventListener("click", function(){
        document.getElementById("total").innerHTML = "$0";
        total = 0;
        document.getElementById("cart").innerHTML = "";
        cart = [];
    });
    

    document.getElementById("order-now").addEventListener("click", function(){
       
        if( cart.length > 0 ){
            window.location.href = "checkout.php";
        } else {
            
        }
        
    });