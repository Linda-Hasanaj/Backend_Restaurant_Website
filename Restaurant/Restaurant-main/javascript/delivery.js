        
        let cart = [];
        let total = 0;
        
        function sortMenu() {
            const sortBy = document.getElementById("sort-option").value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'delivery.php?ajax=1&sort=' + sortBy, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('menu-container').innerHTML = xhr.responseText;
                    attachEventListeners(); // Re-attach event listeners after AJAX update
                }
            };
            xhr.send();
        }
        
        function attachEventListeners() {
            document.querySelectorAll('.add-to-cart').forEach(function(button) {
                button.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const price = parseFloat(this.getAttribute('data-price'));
                    addToCart(name, price);
                });
            });
            document.getElementById('order-now').addEventListener('click', function() {
                placeOrder();
            });
            document.getElementById('clear').addEventListener('click', function() {
                clearCart();
            });
        }
        
        function addToCart(name, price) {
            const item = cart.find(item => item.name === name);
            if (item) {
                item.quantity++;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            total += price;
            updateCart();
        }
        
        function updateCart() {
            const cartContainer = document.getElementById('cart');
            cartContainer.innerHTML = '';
            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.textContent = `${item.name} - $${item.price} x ${item.quantity}`;
                cartContainer.appendChild(cartItem);
            });
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }
        
        function clearCart() {
            cart = [];
            total = 0;
            updateCart();
        }
        
        function placeOrder() {
            document.cookie = "cart=" + JSON.stringify(cart) + "; path=/";
            window.location.href = 'checkout.php';
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            attachEventListeners();
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        ////
        
        
        
        
        
//         let cart = [];
//         let total = 0;

//         function sortMenu() {
//             const sortBy = document.getElementById("sort-option").value;
//             const xhr = new XMLHttpRequest();
//             xhr.open('GET', 'delivery.php?ajax=1&sort=' + sortBy, true);
//             xhr.onreadystatechange = function() {
//                 if (xhr.readyState === 4 && xhr.status === 200) {
//                     document.getElementById('menu-container').innerHTML = xhr.responseText;
//                     attachEventListeners(); // Re-attach event listeners after AJAX update
//                 }
//             };
//             xhr.send();
//         }

//         function attachEventListeners() {
//             document.querySelectorAll('.add-to-cart').forEach(function(button) {
//                 button.addEventListener('click', function() {
//                     const name = this.getAttribute('data-name');
//                     const price = parseFloat(this.getAttribute('data-price'));
//                     addToCart(name, price);
//                 });
//             });
//             document.getElementById('order-now').addEventListener('click', function() {
//                 placeOrder();
//             });
//             document.getElementById('clear').addEventListener('click', function() {
//                 clearCart();
//             });
//         }

//         function addToCart(name, price) {
//     const item = cart.find(item => item.name === name);
//     if (item) {
//         item.quantity++;
//     } else {
//         cart.push({ name, price, quantity: 1 });
//     }
//     total += price;
//     updateCart();
// }

//         function updateCart() {
//             const cartContainer = document.getElementById('cart');
//             cartContainer.innerHTML = '';
//             cart.forEach(item => {
//                 const cartItem = document.createElement('div');
//                 cartItem.textContent = `${item.name} - $${item.price} x ${item.quantity}`;
//                 cartContainer.appendChild(cartItem);
//             });
//             document.getElementById('total').textContent = `$${total.toFixed(2)}`;
//         }

//         function clearCart() {
//             cart = [];
//             total = 0;
//             updateCart();
//         }

//         function placeOrder() {
//           const xhr = new XMLHttpRequest();
//           xhr.open('POST', 'delivery.php', true);
//           const formData = new FormData(); // Create FormData object
      
//           // Construct the order data
//           const order = cart.map(item => ({
//               name: item.name,
//               price: item.price,
//               quantity: item.quantity,
//               total: item.price * item.quantity
//           }));
      
//           formData.append('order', JSON.stringify(order)); // Append order data
      
//           xhr.onreadystatechange = function() {
//               if (xhr.readyState === 4 && xhr.status === 200) {
//                   const response = JSON.parse(xhr.responseText);
//                   if (response.status === 'success') {
//                       alert('Order placed successfully!');
//                       clearCart();
//                       window.location.href = 'checkout.php'; // Redirect to the checkout page
//                   } else {
//                       alert('Error placing order');
//                   }
//               }
//           };
      
//           xhr.send(formData); // Send FormData object instead of manually constructed string
//       }
      

//         document.addEventListener('DOMContentLoaded', function() {
//             attachEventListeners();
//         });


//         document.getElementById('order-now').addEventListener('click', function() {
//           const cartItems = [];
          
//           // Assuming cart items are being stored in a session storage or any similar method
//           const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
      
//           cart.forEach(item => {
//               cartItems.push({
//                   name: item.name,
//                   price: item.price,
//                   quantity: item.quantity,
//                   total: item.total
//               });
//           });
      
//           document.cookie = "cart=" + JSON.stringify(cartItems) + "; path=/";
//           window.location.href = 'checkout.php';
//       });
      