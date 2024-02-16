<?php 

    session_start();
    if (isset($_SESSION['ID']) && isset($_SESSION['username'])) {

        include 'D:/xampp/htdocs/iot/php/headers.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" integrity="sha256-0H3Nuz3aug3afVbUlsu12Puxva3CP4EhJtPExqs54Vg=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
    <title>uTOOLity</title>
    <style>
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed, 
        figure, figcaption, footer, header, hgroup, 
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure, 
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            background-color: rgb(23, 117, 154);
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        a {
            text-decoration: none;
            color: black;
        }

        *{
            font-family: Arial, Helvetica, sans-serif;
        }
/* 
        #ACUBreakerButton{background-color: green; color: white;}

        #LightBreakerButton{background-color: white; color: black;} */

        /* end of css reset */

        header a {
            color: white !important;
            font-size: 2em;
        }

        #headerL {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            font-size: 3em;
            text-align: center;
            background-color: rgb(5, 65, 111);
            color: white;
            padding: 1em 0 1em 0;
        }

        header{
            display: flex;
            justify-content: flex-end;
            top: 0;
            position: sticky;
            height: 0;
        }

        #headerL a {
            color: rgb(232, 201, 0);
        }

        #headerL button {
            background-color: rgb(232, 201, 0);
        }

        #header-container{
            left: 0;
            background-color: #074c8b;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 27em;
            height: 8em;
            padding: 2em;
            border-radius: .5em;
            /* box-shadow: -.1em .3em 1em rgba(0, 0, 0, 0.527); */
        }

        #header-container h2{
            font-size: 3em;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #F79420;
        }

        #header-container button{
            width: 3.5em;
            height: 2.5em;
            border-radius: .3em;
            background-color: #F79420;
        }

        #header-contain i {
            font-size: 1.5em;
        }
        #logout {
            width: 1.5em;
            height: 1.5em;
            font-size: 1em;
            border-radius: 5px;
        }
        
        main {
            margin: auto;
        }

        #container {
            display: flex;
            justify-content: flex-start;
        }

        #left {
            width: 40em;
            background-color: white;
        }

        #logs {
            height: 100%;
        }

        #logs h2 {
            padding: 1em 0;
            font-size: 2em;
            font-weight: bold;
            background-color: rgb(232, 201, 0);
            /* color: white; */
            text-align: center;
        }

        #data-logs {
            width: 100%;
            height: 50em;
            background-color: white;
        }

        #data-logs pre {
            color: white;
        }

        #screenTop {
            display: flex;
            justify-content: center;
            font-size: 5em;
            font-weight: bold;
            margin: 1.4em 0 0 0;
        }

        #screenBot {
            display: flex;
            justify-content: center;
            display: flex;
            justify-content: space-between;
            margin: 7em 5em;
        }

        #right {
            display: flex;
            flex-direction: column;
            width: 100%;
            background-color: rgb(23, 117, 154);
            color: white;
        }

        #right h1{
            color: #f39a16;
            /* -webkit-text-stroke: 1px white; */
        }

        #right p {
            font-size: 2.5em;
            margin: .1em 0 .5em 0;
            text-align: center;
            font-weight: bold;
        }

        #right button {
            border-radius: .3em;
            padding: 1.5em;
            font-size: 1em;
            font-weight: bold;
            margin: 0 .7em 0 .7em;
        }

        #line {
            background-color: white;
            width: .3em;
            height: 100%;
            margin: 0 1em;
        }

        #ac-breaker, #light-breaker {
            align-items: flex-start;
            text-align: center;
        }

        #ac-breaker button,
        #light-breaker button {
            width: 7em;
            height: 6em;
            font-size: 2em;
            background-color: white;
        }

        #ac-btn, #light-btn {
            display: flex;
            flex-direction: row;  
        }
    
        #top {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 2.5em 0 5em 0;
            height: 25em;
        }

        #top h1 {
            font-size: 2.5em;
            margin: 0 0 1em 0;
            font-weight: bold;
        }

        #top-container {
            display: flex;
            flex-direction: row;
        }

        #top p {
            text-align: center;
            margin: 1em 0 0 0;
        }

        #top button {
            width: 3em;
            height: 3em;
            padding: 0;
            font-size: 4.5em;
            margin: 0 0.35em 0 .35em;
            border-radius: .15em;
            text-align: center;
        }

        #bottom p {
            margin: 1em 0 1em 0;
            text-align: center;
        }

        #bottom {
            padding: 2em 0 7em 0;
            text-align: center;
            background-color: rgb(10, 99, 134);
            border-top: 1em solid #F79420;
        }

        /* #bottom p:first-child {
            color: #F79420;            
        } */

        #bottom button {
            width: 3em;
            height: 3em;
            padding: 0;
            font-size: 4.5em;
            margin: 0 0.35em 0 .35em;
            border-radius: .15em;
            text-align: center;
        }

        #bot-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            /* padding: 0 0 5em 0; */
        }

        #bot-container p {
            margin: 1em 0 1em 0;
        }

        #bot-col1 {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        #temp-row{
            display: flex;
            flex-direction: row;
            justify-content: center;
            color: white !important;
        }
        /* @media screen and (-webkit-min-device-pixel-ratio:0) and (min-resolution:.001dpcm) {
            selector{
                top button{
                width: 1em;
                height: 1em;
                font-size: .5em;
                }
            }
        } */

        @media only screen and (max-width:960px) {

            /* For mobile phones: */
            #container {
                flex-direction: column;
                justify-content: center;
                width: 100%;
            }

            #data-logs {
                width: 100%;
                height: 20em;
                background-color: white;
            }

            #right {
                padding: 0;
            }

            #left {
                width: 100%;
            }

            .button {
                width: 100%;
            }

            #line {
                display: none;
            }

            #top {
                /* flex-direction: column; */
                justify-content: center;
                margin: 0;
            }

            #top i {
                font-size: 1.5em !important;
            }

            #top button {
                width: 7em !important;
                height: 4em !important;
                font-size: 1.3em;
            }

            header{
                display: flex;
                justify-content: center;
                position: relative;
                height: auto;
                width: 100%;
            }

            #header-container{
                width: 100%;
                border-radius: 0;
            }
            
            #bottom button {
                width: 7em !important;
                height: 4em !important;
                font-size: 1.3em !important;
                padding: 1em !important;
            }

            #bot-container button {
                width: 6.5em !important;
                /* flex-direction: column; */
            }

            #bottom p {
                margin: 1em 0 1em 0;

            }
        }

        @media only screen and (max-width:768px) {
            #header-container {
                height: 5em;
            }
            #header-container h2{
                font-size: 2.5em;
            }

            #header-container button{
                width: 2.5em;
                height: 2em;
                padding: 0 !important;
            }

            #top {
                flex-direction: column;
                justify-content: center;
                margin: 0;
                height: 15em;
            }

            #top h1 {
                font-size: 2em;
                margin: 0 0 1.3em 0;
            }

            #right {
                padding: 0;
            }

            #ac-breaker p, #light-breaker p {
                margin: .5em 0 0 0;
                font-size: 1.5em;
            }

            button {
                width: 6em;
                height: 4em;
                font-size: 1em;
                padding: 1em;
                border-radius: 2em;
            }

            #bot-container {
                flex-direction: column;
            }

            #bottom {
                padding: 0 0 5em 0;
            }

            #bottom p {
                margin:  .3em 0 1.5em 0;
                font-size: 1.5em;
            }

            #bottom p:first-child {
                margin: 1em 0 1.3em 0;
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
        <header>
            <div id="header-container">
                <h2>uTOOLity</h2>
                <button onclick="downloadCSV()" id="LogOut"><i class="fa fa-floppy-o"></i></button>
                <form action="http://172.16.2.251/iot/logout.php" method="post">
                    <button id="userlogout" name="submit" value="Execute PHP File"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                                    
                </form>
            </div>
        </header>
    
        <main>
            <div id="container">
                <div id="right">   
                    <div id="top">
                        <h1>POWER</h1>
                        <div id="top-container">
                            <div id="ac-breaker">
                                <form action="http://172.16.2.251/iot/php/acu.php" method="post">
                                    <button id="ACUBreakerButton" name="submit" value="Execute PHP File"><i class="fa fa-bolt" aria-hidden="true"></i></button>
                                </form>
                                <p>ACU</p>
                            </div>

                            <div id="line"></div>

                            <div id="light-breaker">
                                <form action="http://172.16.2.251/iot/php/lights.php" method="post">
                                    <button id="LightBreakerButton" name="submit" value="Execute PHP File"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></button>
                                </form>
                                <p>Lights</p>
                            </div>
                        </div>
                    </div>
                    
                    <div id="bottom">
                        <p>AC Remote Controller</p>
                        <div id="bot-container">
                            <div id="bot-col1">
                                <div id="power-col">
                                    <form action="http://172.16.2.251/iot/php/remote.php" method="post">
                                        <button id="RemoteButton" name="submit" value="Execute PHP File"><i class="fa fa-power-off"></i></button>
                                    </form>
                                    <p>Power</p>
                                </div>
                                <div id="pair-col">
                                    <form action="http://172.16.2.251/iot/php/pairing.php" method="post">
                                        <button id="PairingButton" name="submit" type="submit"><i class='fa fa-rotate-right'></i></button>
                                    </form>
                                    <p id="pair">Pair</p>
                                </div>
                            </div>
                            <div id="bot-line"></div>
                            <div id="temp-col">
                                <form action="http://172.16.2.251/iot/php/tempInc.php" method="post">
                                    <button id="TempIncButton" name="submit" value="Execute PHP File"><i class="fa fa-plus"></i></button>
                                </form>
                                <form action="http://172.16.2.251/iot/php/tempDec.php" method="post">
                                    <button id="TempDecButton" name="submit" value="Execute PHP File"><i class="fa fa-minus"></i></button>
                                </form>  
                                <div id="temp-row">
                                    <p>Temperature:</p>
                                    <p id="temp"></p>
                                    <p>°</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <script src="assets/js/command.js"></script>
</body>
</html>

<?php 
}else{
    
    header("Location: login.php");
    exit();

}
?>