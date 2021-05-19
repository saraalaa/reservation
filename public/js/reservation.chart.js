window.chartColors = {
    blue: 'rgb(54, 162, 235)',
};

let reservationUrl = '/chart';
let reservationDay = [];
let reservation = [];

$.get(reservationUrl, function(response){
    response.forEach(function(data){
        reservationDay.push(data.date);
        reservation.push(data.reservation);
    });

    var config = {
        type: 'line',
        data: {
            labels: reservationDay,
            datasets: [{
                label: 'reservation per day',
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                fill: false,
                data: reservation,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: ''
            },
            scales: {
                xAxes: [{
                    display: true,
                }],
                yAxes: [{
                    display: true,
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
});
