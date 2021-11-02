import "/node_modules/chart.js/dist/chart.js";

let name = document.getElementById("name");
let click = document.getElementById("click");


document.getElementById("graph1").addEventListener("click", function (){
    name.value;
    click.value;
});

let name1 = name.value;
let click1 = click.value;

const words = name1.split(', ');
const words2 = click1.split(', ');

let arrayName = [];
let arrayClick = []

for (let i = 0; i < words.length; i++) {
    arrayName.push(words[i]);
    arrayClick.push(words2[i]);
}

console.log(arrayName);
console.log(arrayClick);

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