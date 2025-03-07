document.addEventListener("DOMContentLoaded", function() {
    const radios = document.querySelectorAll("input[name='size']");
    const priceInput = document.getElementById("priceInput");
    const quantityInput = document.getElementById("quantityInput");

    radios.forEach(radio => {
        if (radio.checked) {
            const price = parseFloat(prices[radio.value].price); 
            const quantity = parseInt(prices[radio.value].quantity); 
            if (!isNaN(price)) {
                priceInput.value = price.toFixed(2); 
            } else {
                console.error("Invalid price:", price);
            }
            if (!isNaN(quantity)) { 
                quantityInput.value = quantity;
            } else {
                console.error("Invalid quantity:", quantity);
            }
        }
    });

    
    radios.forEach(radio => {
        radio.addEventListener("change", function() {
            const price = parseFloat(prices[this.value].price); 
            const quantity = parseInt(prices[this.value].quantity); 
            if (!isNaN(price)) { 
                priceInput.value = price.toFixed(2); 
            } else {
                console.error("Invalid price:", price);
            }
            if (!isNaN(quantity)) {
                quantityInput.value = quantity;
            } else {
                console.error("Invalid quantity:", quantity);
            }
        });
    });

 
});
