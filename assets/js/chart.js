doughnutChart = document.getElementById('doughnutChart').getContext('2d'),
barChart = document.getElementById('barChart').getContext('2d');

$.ajax({
    type: "POST",
    url: SITE_URL+"dashboard/getloans",
    dataType: "json",
    success: function(response) {
        console.log(response);
        new Chart(doughnutChart, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [response.total, response.active, response.paid],
                    backgroundColor: ['#1972E8','#6861CE','#31CE36']
                }],
        
                labels: [
                'Total Loans',
                'Active Loans',
                'Paid Loans'
                ]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false,
                legend : {
                    position: 'bottom'
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });
    }
});

$.ajax({
    type: "POST",
    url: SITE_URL+"dashboard/getRevenue",
    dataType: "json",
    success: function(response) {
        console.log(response);

        new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets : [{
                    label: "Revenue",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: [
                        response.jan.total_amount, 
                        response.feb.total_amount, 
                        response.mar.total_amount, 
                        response.apr.total_amount, 
                        response.may.total_amount, 
                        response.jun.total_amount, 
                        response.jul.total_amount, 
                        response.aug.total_amount, 
                        response.sep.total_amount, 
                        response.oct.total_amount, 
                        response.nov.total_amount, 
                        response.dec.total_amount
                    ],
                }],
            },
            options: {
                responsive: true, 
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
            }
        });
    }
});

