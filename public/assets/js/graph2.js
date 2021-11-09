import "/node_modules/chart.js/dist/chart.js";

let link = document.getElementById("link");
let duplicate = document.getElementById("duplicate");


document.getElementById("graph2").addEventListener("click", function (){
    link.value;
    duplicate.value;
});

// I recover the data
let link1 = link.value;
let duplicate1 = duplicate.value;

// I get every word
const words = link1.split(', ');
const words2 = duplicate1.split(', ');

let arrayLink = [];
let arrayDuplicate = []

// I put each word in a table
for (let i = 0; i < words.length; i++) {
    arrayLink.push(words[i]);
    arrayDuplicate.push(words2[i]);
}

// A graph that shows all the links in common
const ctx = document.getElementById('myPie').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: arrayLink,
        datasets: [{
            label: 'Nombre de lien en commun',
            data: arrayDuplicate,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(56, 169, 47)'
            ],
            hoverOffset: 4
        }]
    }
});