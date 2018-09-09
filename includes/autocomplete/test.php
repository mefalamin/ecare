<!DOCTYPE html>
<html lang="en">
<head>





    <style>
        /* animations */

        @-webkit-keyframes checkmark {
            0% {
                stroke-dashoffset: 50px
            }

            100% {
                stroke-dashoffset: 0
            }
        }

        @-ms-keyframes checkmark {
            0% {
                stroke-dashoffset: 50px
            }

            100% {
                stroke-dashoffset: 0
            }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 50px
            }

            100% {
                stroke-dashoffset: 0
            }
        }

        @-webkit-keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 240px
            }

            100% {
                stroke-dashoffset: 480px
            }
        }

        @-ms-keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 240px
            }

            100% {
                stroke-dashoffset: 480px
            }
        }

        @keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 240px
            }

            100% {
                stroke-dashoffset: 480px
            }
        }

        /* other styles */
        /* .svg svg {
            display: none
        }
         */
        .inlinesvg .svg svg {
            display: inline
        }

        /* .svg img {
            display: none
        } */

        .icon--order-success svg path {
            -webkit-animation: checkmark 0.25s ease-in-out 0.7s backwards;
            animation: checkmark 0.25s ease-in-out 0.7s backwards
        }

        .icon--order-success svg circle {
            -webkit-animation: checkmark-circle 0.6s ease-in-out backwards;
            animation: checkmark-circle 0.6s ease-in-out backwards
        }



        }








        body {
            margin: 0px;
            width: 100%;
        }
        .wrap {
            margin: 0px auto;
            width: 486px;
        }

        .box {
            width: 160px;
            height: 120px;
            float: left;
            background: #347fc3;
            border: 1px solid #fff;
            overflow: hidden;
        }

        .text {
            text-align: center;
            margin-top: 56px;
            color: #fff;
            font-size: 1.0em;
            font-family: sans-serif;
            text-transform: uppercase;
        }

        .animated {
            animation-duration: 2.5s;
            animation-fill-mode: both;
            animation-iteration-count: infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-30px);}
            60% {transform: translateY(-15px);}
        }
        .bounce {
            animation-name: bounce;
        }

        @keyframes flash {
            0%, 50%, 100% {opacity: 1;}
            25%, 75% {opacity: 0;}
        }
        .flash {
            animation-name: flash;
        }

        @keyframes pulse {
            0% {transform: scale(1);}
            50% {transform: scale(1.1);}
            100% {transform: scale(1);}
        }
        .pulse {
            animation-name: pulse;
            animation-duration: 1s;
        }

        @keyframes rubberBand {
            0% {transform: scale(1);}
            30% {transform: scaleX(1.25) scaleY(0.75);}
            40% {transform: scaleX(0.75) scaleY(1.25);}
            60% {transform: scaleX(1.15) scaleY(0.85);}
            100% {transform: scale(1);}
        }
        .rubberBand {
            animation-name: rubberBand;
        }

        @keyframes shake {
            0%, 100% {transform: translateX(0);}
            10%, 30%, 50%, 70%, 90% {transform: translateX(-10px);}
            20%, 40%, 60%, 80% {transform: translateX(10px);}
        }
        .shake {
            animation-name: shake;
        }

        @keyframes swing {
            20% {transform: rotate(15deg);}
            40% {transform: rotate(-10deg);}
            60% {transform: rotate(5deg);}
            80% {transform: rotate(-5deg);}
            100% {transform: rotate(0deg);}
        }
        .swing {
            transform-origin: top center;
            animation-name: swing;
        }

        @keyframes wobble {
            0% {transform: translateX(0%);}
            15% {transform: translateX(-25%) rotate(-5deg);}
            30% {transform: translateX(20%) rotate(3deg);}
            45% {transform: translateX(-15%) rotate(-3deg);}
            60% {transform: translateX(10%) rotate(2deg);}
            75% {transform: translateX(-5%) rotate(-1deg);}
            100% {transform: translateX(0%);}
        }
        .wobble {
            animation-name: wobble;
        }

        @keyframes flip {

            40% {transform: perspective(400px) translateZ(150px) rotateY(170deg) scale(1);animation-timing-function: ease-out;}
            50% {transform: perspective(400px) translateZ(150px) rotateY(190deg) scale(1);animation-timing-function: ease-in;}
            80% {transform: perspective(400px) translateZ(0) rotateY(360deg) scale(.95);animation-timing-function: ease-in;}
            100% {transform: perspective(400px) translateZ(0) rotateY(360deg) scale(1);animation-timing-function: ease-in;}
        }
        .animated.flip {
            backface-visibility: visible;
            animation-name: flip;
        }

        @keyframes lightSpeedIn {
            0% {transform: translateX(100%) skewX(-30deg);opacity: 0;}
            60% {transform: translateX(-20%) skewX(30deg);opacity: 1;}
            80% {transform: translateX(0%) skewX(-15deg);opacity: 1;}
            100% {transform: translateX(0%) skewX(0deg);opacity: 1;}
        }
        .lightSpeedIn {
            animation-name: lightSpeedIn;
            animation-timing-function: ease-out;
        }

        @keyframes rollIn {
            0% {opacity: 0;transform: translateX(-100%) rotate(-120deg);}
            100% {opacity: 1;transform: translateX(0px) rotate(0deg);}
        }
        .rollIn {
            animation-name: rollIn;
        }

        @keyframes rotateIn {
            0% {transform-origin: center center;transform: rotate(-200deg);opacity: 0;}

        }
        .rotateIn {
            animation-name: rotateIn;
        }

        @keyframes hinge {

            20%, 60% {transform: rotate(80deg);transform-origin: top left;animation-timing-function: ease-in-out;}
            40% {transform: rotate(60deg);transform-origin: top left;animation-timing-function: ease-in-out;}
            80% {transform: rotate(60deg) translateY(0);transform-origin: top left;animation-timing-function: ease-in-out;}
            100% {transform: translateY(700px);}
        }
        .hinge {
            margin: 20px;
            animation-name: hinge;
        }

        @media all and (max-width: 680px) {
            .wrap {
                width: 100%;
            }
            .box {
                width: 100%;
                height: 55px;
                clear: both;
                margin: 0px auto;
            }
            .text {
                margin-top: 20px;
            }
            .hingebox, .flipbox {
                display: none;
            }
        }
    </style>


</head>
<body>

<div class="icon icon--order-success svg">
    <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
        <g fill="none" stroke="#8EC343" stroke-width="2">
            <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
            <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
        </g>
    </svg>

</div>


    <div class="text animated bounce" style="color: #000099">Bounce</div>


</body>
</html>

