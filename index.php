<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');
use Carbon\Carbon;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 3 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"
          media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
    <style>
        .image-container {
            position: relative;
            width: 1240px;
            height: 700px;
        }

        .image-container .after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            color: #FFF;
        }

        #currentTideImage {
            opacity: 0.5;
            filter: alpha(opacity=50);
        <?php if(Carbon::now()->hour < 10){?> margin-left: 341px;
        <?php }else{?> margin-left: 62px;
        <?php }?> margin-top: -21px;
            width: 617px;
            height: 727px;
        }

    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <a href="/clock.php">Clock</a>
        </div>
    </div>
    
    <div class="row">
        <div class="image-container col-lg-10">
            <img src="http://www.ntslf.org/files/surgeforecast/ntslf_lowestoft.1.1.png?time=<?php echo time(); ?>"
                 alt="" width="1240px">
            <div class="after">
                <img src="http://www.ntslf.org/files/ntslf_php/pltdata_tgi.php?port=Lowestoft&span=1" alt=""
                     id="currentTideImage"/></div>
        </div>
        <div class="col-lg-2">
            <img src="" alt="" id="weatherImage" width="400px" style="margin-top: 100px">

        </div>


    </div>

    <div class="" style='    margin-left: 67px;     z-index: 100; width: 100% '>
        <?php
        $start = -1;
        if (Carbon::now()->hour < 10) {
            $start = -2;
        }

        for ($i = -2; $i < 3; $i++) {

            $hour = 0;

            for ($j = 1; $j < 4; $j++) {
                ?><img src="http://chart-1.msw.ms/gfs/<?php echo (new Carbon())->addDay(($i < 0 ? $i : 0))
                                                                               ->format('Ymd') ?>00/750/1-<?php echo (new Carbon())->addDay($i)
                                                                                                                                   ->hour($hour * 4)
                                                                                                                                   ->minute(0)

                                                                                                                                   ->second(0)->timestamp ?>-4.gif"
                       alt="" width='92px' class="weather"/>
                <?php
                $hour += 3;
            }
        }

        ?>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $('.weather').hover(function () {
            $('#weatherImage').attr('src', ($(this).attr('src')))
        })
    })
</script>
</body>
</html>

