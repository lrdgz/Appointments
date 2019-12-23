const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Meidicos mas activos'
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Citas atendidas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    series: []
});

const fechData = function(){
    fetch('/charts/doctors/column/data/')
        .then((response) => {
            return response.json()
        })
        .then((data) => {
            // console.log(data);
            chart.xAxis[0].setCategories(data.categories);
            chart.addSeries(data.series[0]); //Atendidas
            chart.addSeries(data.series[1]); //Canceladas
        });
};


$(() => {
    fechData();
});
