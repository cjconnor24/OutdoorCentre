<?php include('includes/header.php'); ?>

        <h1>Admin Dashboard</h1>
        <p>Welcome to the Lomond Outdoor Administration below</p>

        <h2>Visulisations</h2>
<p>Below is the latest information from the system.</p>

<div class="row">
        <div class="col-6">
                <div class="panel">
                        <div class="panel-heading">Enquiries By Category</div>
                <canvas id="enquiry-by-category" width="400" height="400"></canvas>
                </div>
        </div>

        <div class="col-6">
                <div class="panel">
                        <div class="panel-heading">Newsletter Signups This Month</div>
                        <canvas id="myChart" width="400" height="400"></canvas>
                </div>
        </div>

</div>

<script>

        $(document).ready(function(){

            // BUILD A CHART
            buildChart('#enquiry-by-category',1,'pie','Enquiries By Category');
            buildChart('#myChart',3,'bar','A New One','Signups Per Day');

            function buildChart(canvasid,chartnumber,charttype,charttitle,datalabel = false) {

                $.getJSON('/admin/chart-api.php?id='+chartnumber, function (resp) {

                    // SETUP THE DATA
                    var chartdata = resp.data;
                    var chartlabels = resp.labels;

                    var line = (charttype=='bar' ? true : false);

                    var ctx = $(canvasid);
                    var myChart = new Chart(ctx, {
                        type: charttype,
                        data: {
                            labels: chartlabels,
                            datasets: [{

                                label: datalabel ? datalabel : false,
                                data: chartdata,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)'
                                ]
                            }],
                        },
                        options: {
//                            scales: (line ? {yAxes: [{ticks: {beginAtZero:false}}]} : false),
                            title: {
                                display: true,
                                text: charttitle
                            }
                        }
                    })

                    if(charttype=='bar') {
                        console.log('this ran');
//                        myChart.options.scales.yAxes[0].ticks.min = 0;
                        myChart.options.scales.yAxes[0].ticks.beginAtZero = true;
                    }

                })

            }

        });



</script>

<?php include('includes/footer.php'); ?>

