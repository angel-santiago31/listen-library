document.getElementById("itemIdField").hidden = true;
$("#refers_to").change(function(){
    var ddValue = $('#refers_to').val();

    if(ddValue >= 1) {
        document.getElementById("itemIdField").hidden = false;
    } else {
        document.getElementById("itemIdField").hidden = true;
    }
    return false;
 });
