<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title></title>

    <link rel="shortcut icon" href="/favicon.ico">
    <!--    ADDING JQUERY LOCALLY FOR OFFLINE DEV-->
    <script src="/js/jquery-3.2.1.min.js"></script>

</head>
<body>

<div id="box"></div>
<script type="text/javascript">
    $(function(){

        // SETUP SOME VARS - DONT NEED TO BUT ITS CLEANER
        var apikey = 'putyourkeyhere';
        var apiurl = "http://api.openweathermap.org/data/2.5/forecast?id=524901&appid="+apikey;

        // GET THE API DATA
        $.getJSON(apiurl,function(response){

            // AGAIN SETUP SOME LOCAL VARS FOR CLEANNESS
            var weatherdata = response;
            var weatherfiveday = weatherdata.list;

            // LOOP THROUGH EACH LIST ITEM
            $(weatherfiveday).each(function(key,hourly){

                // GET THE DATA YOU WANT AND EXTRACT IT
                var datetime = hourly.dt_txt;
                var temperature = hourly.main.temp;
                var description = hourly.weather[0].description;

                // NOW WRITE IT OUT TO THAT BOX OR WHATEVER WAY YOU WANT TO
                $("<h1>").text(datetime).appendTo('#box');
                $("<p>").text('The temp is '+temperature+" and the weather is described as "+description).appendTo('#box');

            })

        });

    })
</script>

</body>
</html>