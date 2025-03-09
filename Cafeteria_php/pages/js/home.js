let cart = {};

function addToCart(id, price, name) {
    if (!cart[id]){ 
        cart[id] = { quantity: 1, price: price, name: name };
        alert(`${name} has been added to the cart!`);
    
}
    else cart[id].quantity++;
    
    updateCart();
}

function removeFromCart(id) {
    if (cart[id] && cart[id].quantity > 1) cart[id].quantity--;
    else delete cart[id];
    updateCart();
}

function updateCart() {
    let total = 0, list = '';
    for (let id in cart) {
        let item = cart[id];
        total += item.quantity * item.price;
        list += `<p>${item.name}: 
                    <button class="update-prod-btn" onclick='removeFromCart(${id})'>-</button> 
                    ${item.quantity} 
                    <button class="update-prod-btn" onclick='addToCart(${id}, ${item.price}, "${item.name}")'>+</button>  
                    × ${item.price} $</p>`;
    }
    document.getElementById('cart').innerHTML = list;
    document.getElementById('total').innerText = total;
    document.getElementById('total_price_input').value = total;
}