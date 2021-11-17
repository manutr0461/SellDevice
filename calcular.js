const cal = document.getElementById("calcular");

cal.addEventListener("click", function(e){
    e.preventDefault();
    let precio = document.getElementById("precio").value;
    let cantidad = document.getElementById("cant").value;
    document.getElementById("subtotal").value=cantidad*precio;
})