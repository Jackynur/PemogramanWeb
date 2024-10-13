function appendToDisplay(value) {
    const display = document.getElementById('display');
    display.value += value;
}

function clearDisplay() {
    const display = document.getElementById('display');
    display.value = '';
}

function calculate() {
    const display = document.getElementById('display');
    let expression = display.value;

    try {
        // Mengganti simbol ^ dengan Math.pow untuk operasi pangkat
        expression = expression.replace('^', '**');

        // Eksekusi ekspresi aritmatika
        const result = eval(expression);

        display.value = result;
    } catch (error) {
        display.value = 'Error';
    }
}
