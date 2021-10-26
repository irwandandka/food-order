// var Turbolinks = require("turbolinks")

const { data } = require("jquery");

// Turbolinks.start()
function copyNumber(){
    let dataNumber = document.querySelector(".dataNumber");
    dataNumber.select();
    dataNumber.setSelectionRange(0, 99999); /* For mobile devices */
    /* Copy the text inside the text field */
    navigator.clipboard.writeText(dataNumber.value);
    /* Alert the copied text */
    alert("Tersalin");
}