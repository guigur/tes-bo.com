<!DOCTYPE html>
<html>
    <head>
        <style>
            html {
                width:100%;
                height:100%;
                background:#ffffff center center no-repeat;
            }
            img {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 500px;
                height: 500px;
                margin-top: -250px; /* Half the height */
                margin-left: -250px; /* Half the width */
            }
            html, body, #wrapper {
                height:100%;
                width: 100%;
                margin: 0;
                padding: 0;
                border: 0;
            }
            #wrapper td {
                vertical-align: middle;
                text-align: center;
            }

            .snowflakes {
                top:0px;
                left:0px;
                position:absolute;
                z-index:200;
                width:10px;
                height:10px;
                background:white;
            }
            .dishes {
                top:0px;
                left:0px;
                position:absolute;
                z-index:200;
                width:200px;
                height:214px;
            }
        </style>
    </head>
    <body>
    <audio loop autoplay>
        <source src="music/Dishwasher-SoundBible.com-1917190099.mp3" type="audio/mpeg">

    </audio>

    <table id="wrapper">
            <div id="snowZone"></div>

            <tr>
                <td><a href="https://www.youtube.com/watch?v=bEBECtCoLTI"><img id="lili_dishwasher" src="dishes/lili_dishwasher.png" alt="" /></a></td>
            </tr>
        </table>


        <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="js/JQuerryRotate.js"></script>
        <script>
            var rotation = function (){
                $("#lili_dishwasher").rotate({
                    angle:0,
                    animateTo:360,
                    duration: 8000,
                    callback: rotation,
                    easing: function (x,t,b,c,d){        // t: current time, b: begInnIng value, c: change In value, d: duration
                        return c*(t/d)+b;
                    }
                });
            }
            rotation();
        </script>
    <script>
        // Snow Falling
        function fallingSnow() {

            var $snowflakes = $(), qt = 30;

            for (var i = 0; i < qt; ++i) {
                var theImages = new Array()


                theImages[0] = 'dishes/bol_bleu.png'
                theImages[1] = 'dishes/calgon.png'
                theImages[2] = 'dishes/plate.png'
                theImages[3] = 'dishes/plate_penche.png'
                theImages[4] = 'dishes/unbreakable_plate.png'
                theImages[5] = 'dishes/verre_a_pied.png'
                theImages[6] = 'dishes/verre_chalengeur.png'


                var whichImage = Math.round(Math.random()*(6));
                //alert(whichImage);

                var $snowflake = $('<div class="dishes" style="background: url('+theImages[whichImage]+')"></div>');
                $snowflake.css({
                    'left': (Math.random() * $('#wrapper').width()) + 'px',
                    'top': (- Math.random() * $('#wrapper').height()) + 'px'
                });
                $snowflakes = $snowflakes.add($snowflake);
            }
            $('#snowZone').prepend($snowflakes);

            $snowflakes.animate({
                top: "800px",
                opacity : "0",
            }, Math.random() + 7000, function(){
                $(this).remove();
                if (--qt < 1) {
                    fallingSnow();
                }
            });
        }
        fallingSnow();
    </script>
    </body>
</html>