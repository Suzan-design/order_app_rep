var add_order_form = document.getElementById('add_order');
var add_order_item = document.getElementById('add_order_item');
var add_supervisor_form = document.getElementById('add_supervisor');
var add_supervisor_item = document.getElementById('add_supervisor_item');

window.onload = function() {
    add_order_form.style.display = 'none';
}

add_order_item.onclick = function () {
    add_order_form.style.display = 'block';
}

add_supervisor_item.onclick = function () {
    add_supervisor_form.style.display = 'block';
}
