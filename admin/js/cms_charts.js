var CMS = CMS || {};
CMS.charts = {
    init: function(title, xaxis, yaxis){
        var canvas = document.getElementById('myChart');
        var data = {
            labels: xaxis,
            datasets: [
                {
                    label: title,
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(255,99,132,0.4)",
                    hoverBorderColor: "rgba(255,99,132,1)",
                    data: yaxis,
                }
            ]
        };
        var option = {
            scales: {
            yAxes:[{
                    stacked:true,
                gridLines: {
                    display:true,
                  color:"rgba(255,99,132,0.2)"
                }
            }],
            xAxes:[{
                    gridLines: {
                    display:false
                }
            }]
          }
        };

        var myBarChart = Chart.Bar(canvas,{
            data:data,
          options:option
        });
    }
};