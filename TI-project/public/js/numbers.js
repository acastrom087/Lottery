let btn1 = document.querySelector('#pz1');
let btn2 = document.querySelector('#pz2');
let btn3 = document.querySelector('#pz3');
let inp1 = document.querySelector('#st_number');
let inp2 = document.querySelector('#nd_number');
let inp3 = document.querySelector('#rd_number');

function generateRandomInteger() {
    return Math.floor(Math.random() * 99) + 1;
}

btn1.onclick = function(){
    inp1.value = generateRandomInteger();
}

btn2.onclick = function(){
    inp2.value = generateRandomInteger();
}

btn3.onclick = function(){
    inp3.value = generateRandomInteger();
}