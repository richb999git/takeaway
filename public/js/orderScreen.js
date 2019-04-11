function showDelivery(){
    document.getElementById('deliveryDetails').style.display = 'block';
  }

function hideDelivery(){
    document.getElementById('deliveryDetails').style.display = 'none';
}



document.addEventListener("DOMContentLoaded", function(event) {
//window.addEventListener("load", function(event) {    
    var collect = document.getElementById('collect').checked;
    if (collect == true ) {
        hideDelivery();
    } else {
        showDelivery();
    }
});