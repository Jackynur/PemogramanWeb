const tampilan = document.getElementById("tampilan");

function tambahTampilan(input){
    tampilan.value += input;
}

function bersihkanTampilan(){
    tampilan.value = "";
}

function hitung(){
    tampilan.value = eval(tampilan.value);
}