function getal(input) {
    document.getElementById("cijferOutput").innerHTML = input;
}


let cijfer = document.getElementById('cijfer').value;
window.addEventListener("load", getal(cijfer));