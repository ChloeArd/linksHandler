import "/node_modules/chart.js/dist/chart.js";

let name = document.getElementById("name");
let click = document.getElementById("click");


document.getElementById("graph1").addEventListener("click", function (){
    name.value;
    click.value;
});

// I recover the data
let name1 = name.value;
let click1 = click.value;

// I get every word
const words = name1.split(', ');
const words2 = click1.split(', ');

let arrayName = [];
let arrayClick = []

// I put each word in a table
for (let i = 0; i < words.length; i++) {
    arrayName.push(words[i]);
    arrayClick.push(words2[i]);
}

// A graph that shows all the links created and the number of clicks that were made
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: arrayName,
        datasets: [{
            label: 'Nombre de visites',
            data: arrayClick,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});