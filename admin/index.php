<?php include('includes/header.php'); ?>

        <h1>Admin Dashboard</h1>
        <p>Welcome to the Lomond Outdoor Administration below</p>

        <h2>Visulisations</h2>
<p>Below is the latest information from the system.</p>

<div class="row">
        <div class="col-6">
                <div class="panel">
                        <div class="panel-heading">Enquiries By Category</div>
                <canvas id="myChart" width="400" height="400"></canvas>
                </div>
        </div>
</div>

<script>

        $(document).ready(function(){

            $.getJSON('/admin/chart-api.php',function(resp){

                var chartdata = resp.data;
                var chartlabels = ['asdsa','32424','iuiyuiyu','poipip'];

                console.log(chartdata);
                console.log(chartlabels);

                var ctx = $("#myChart");
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: resp.labels,
                        datasets: [{
                            data: resp.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                                ]
                        }],
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Enquiries By Activity'
                        }
                    }
                })

            })

        });



</script>

<?php include('includes/footer.php'); ?>

