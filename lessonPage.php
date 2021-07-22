<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signinpage.php");
    exit();
}//end of user validation
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="icon.png">
        <title>Lesson</title>
        <meta name="author" content="name">
        <meta name="description" content="description here">
        <meta name="keywords" content="keywords,here">
        <link rel="stylesheet" href="css/all.css">-->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/dte4shr.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>-->

        <!--        lesson.js
                <script src="js/lesson.js" type="text/javascript"></script>-->

        <!--swiper-->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    </head>

    <body class="bg-pink-500">
        <?php
        session_start();
        include("navbar.php");
        ?>

        <div class="container max-w-5xl pt-16 mx-auto mt20 pb-8">

            <div class="mx-0 sm:mx-6">

                <div class="bg-white rounded-2xl shadow-lg w-full p-8 leading-normal" style="font-family:Europa,sans-serif;">

                    <p class="text-center md:text-4xl font-bold mb-5" id="title"></p>

                    <!--                    <div id="slider" class="swiper-wrapper swiper-container w-full">
                                            <div class="swiper-wrapper" id="swiper-wrapper">
                    
                                            </div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                    
                                        <div class="flex justify-evenly pt-8">
                                            <button class="text-white w-1/2 md:w-full mr-1 bg-pink-500 border-0 py-2 px-6 focus:outline-none hover:bg-pink-600 rounded-lg text-lg" id="nextLesson">Next Lesson</button>
                                            <button class="text-white w-1/2 md:w-full ml-1 bg-pink-500 border-0 py-2 px-6 focus:outline-none hover:bg-pink-600 rounded-lg text-lg" id="quiz">Take Quiz</button>
                                        </div>-->

                    <div id="slider" class="swiper-container swiper-container w-full swiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                        <div class="swiper-wrapper" id="swiper-wrapper-10fc5411034466b78e" aria-live="polite" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                            <!--                            <div class="swiper-slide" role="group">
                                                            <div class="swiper-zoom-container" style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px);">
                                                                <img src="./css/img/lessonImage/Lung/slide1.png" style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px) scale(1);">
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide" role="group">
                                                            <div class="swiper-zoom-container" style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px);">
                                                                <img src="./css/img/lessonImage/Lung/slide2.png" style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px) scale(1);">
                                                            </div>
                                                        </div>-->
                        </div>
                        <div class="swiper-button-next swiper-button-disabled" tabindex="-1" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-10fc5411034466b78e" aria-disabled="true"></div>
                        <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-10fc5411034466b78e" aria-disabled="false"></div>
                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
                    </div>
                    <div class="flex justify-evenly pt-8">
                        <button class="text-white w-1/2 md:w-full mr-1 bg-pink-500 border-0 py-2 px-6 focus:outline-none hover:bg-pink-600 rounded-lg text-lg" id="nextLesson">Next Lesson</button>
                        <button class="text-white w-1/2 md:w-full ml-1 bg-pink-500 border-0 py-2 px-6 focus:outline-none hover:bg-pink-600 rounded-lg text-lg" id="quiz">Take Quiz</button>
                    </div>
                </div>
            </div>
<!--            <script>
                var swiper = new Swiper('.swiper-container', {
                    direction: 'horizontal',
                    zoom: true,
                    loop: false,

                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },

                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                })
            </script>-->
            <!--lesson.js-->
            <script src="js/lesson.js" type="text/javascript"></script>
    </body>
</html>
