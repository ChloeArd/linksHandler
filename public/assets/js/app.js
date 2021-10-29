import "/node_modules/chart.js/dist/chart.js";

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Adidas', 'Nike', 'Hollister', 'Zara', 'Jennyfer', 'JD Sports'],
        datasets: [{
            label: 'Nombre de cliques',
            data: [0, 4, 0, 2, 1, 0],
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