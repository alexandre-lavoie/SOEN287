document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll("input[id*='quantity']").forEach(element => {
        element.onchange = onChangeItemStack;
    });
}, false);

async function onChangeItemStack(event) {
    const itemID = event.target.id.replace("quantity-", '');
    const quantity = event.target.value;

    if(quantity > 0) {
        await updateItemStack(itemID, quantity);
    } else {
        await deleteItemStack(itemID);
    }
}

async function updateItemStack(id, value) {
    cart.itemstacks[id].quantity = value;

    await updateCart();
}

async function deleteItemStack(id) {
    delete cart.itemstacks[id];

    const card = document.querySelector(`#item-card-${id}`);
    
    card.parentNode.removeChild(card);

    await updateCart();
}

function updateCartCount() {
    const counter = document.querySelector("#cart-count");

    if(counter) {
        counter.innerText = Object.keys(cart.itemstacks).length || 0;
    }
}

async function updateCart() {
    await fetch("/api/cart", { method: "PUT", body: JSON.stringify(cart) });

    refreshReceipt();
}

async function refreshReceipt() {
    let json = await (await fetch("/api/cart/data")).json();

    if(!json.items || Object.keys(json.items).length === 0) document.location.replace('..');
    
    document.querySelector("#items").innerHTML = json.items.map(item => `<i>${item}</i>`).join('</br>');
    document.querySelector("#qst").innerHTML = Number(json.qst).toFixed(2);
    document.querySelector("#gst").innerHTML = Number(json.gst).toFixed(2);
    document.querySelector("#total").innerHTML = Number(json.total).toFixed(2);

    updateCartCount();
}