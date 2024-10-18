
const display = document.getElementById("display");

function appendToDisplay(input){
    if(display.value === "0"){
        display.value = input;
    }else{
        display.value += input;
    }
}

function clearDisplay(){
    display.value = "";
}

function calculate(){
    try{
        let expression = display.value.replace('^', '**');
        display.value = eval(expression);
    }catch(error){
        display.value = "Error";
    }
}

