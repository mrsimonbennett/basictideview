<!DOCTYPE html>
<html>
<body>
<title>ColdHam Hall Tide Clock</title>

<canvas id="canvas" width="600" height="600"
        style="background-color:#333">
</canvas>

<script>
    Math.radians = function(degrees) {
        return degrees * Math.PI / 180;
    };
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
        drawFace(ctx, radius);
        drawNumbers(ctx, radius);
        drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
        var grad;
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, 2*Math.PI);
        ctx.fillStyle = 'white';
        ctx.fill();
        grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
        grad.addColorStop(0, '#333');
        grad.addColorStop(0.5, 'white');
        grad.addColorStop(1, '#333');
        ctx.strokeStyle = grad;
        ctx.lineWidth = radius*0.1;
        ctx.stroke();
        ctx.beginPath();
        ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
        ctx.fillStyle = '#333';
        ctx.fill();
    }

    function drawNumbers(ctx, radius) {
        var ang;
        var num;
        ctx.font = radius*0.15 + "px arial";
        ctx.textBaseline="middle";
        ctx.textAlign="center";

        var labels = ['High',5,4,3,2,1,'low',5,4,3,2,1];

        for (i = 0; i < labels.length; i++) {
            ang = i * Math.PI / 6;
            ctx.rotate(ang);
            ctx.translate(0, -radius*0.85);
            ctx.rotate(-ang);
            ctx.fillText(labels[i].toString(), 0, 0);
            ctx.rotate(ang);
            ctx.translate(0, radius*0.85);
            ctx.rotate(-ang);
        }
    }

    function drawTime(ctx, radius){
        //var lastHighTide = new Date(2016,04,24,8,59);
        var lastHighTide = new Date(2016,3,26,04,01);
        var tideCycleSeconds = (12*60*60)+(25*60) + 14;
        var secondsSinceLastSynchronised=((new Date().getTime()/1000) - (lastHighTide.getTime()/1000));

        var $seconds_since_last_high_tide;

        if (secondsSinceLastSynchronised > tideCycleSeconds) {
            $seconds_since_last_high_tide = secondsSinceLastSynchronised % tideCycleSeconds;
        }
        else
        {
            $seconds_since_last_high_tide = secondsSinceLastSynchronised;
        }
        $required_rotation_from_12oclock_position=($seconds_since_last_high_tide/tideCycleSeconds)*360;
        var $vml_degrees=$required_rotation_from_12oclock_position;
        if ($vml_degrees<0) {$vml_degrees=$vml_degrees+360;}
        drawHand(ctx, Math.radians($vml_degrees), radius*0.7, radius*0.07);

        $required_rotation_from_12oclock_position=($seconds_since_last_high_tide/tideCycleSeconds)*60*60;
        var $vml_degrees=$required_rotation_from_12oclock_position;
        if ($vml_degrees<0) {$vml_degrees=$vml_degrees+360;}


    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
</script>

</body>
</html>
