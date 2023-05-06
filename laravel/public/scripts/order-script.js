function check(order_value, price) {
    newPrice = order_value + price
    document.getElementById("total").textContent = "Celková suma :" + newPrice + "€";
}
