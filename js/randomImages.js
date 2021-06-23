$(document).ready(function () {
$.ajax({
type: "GET",
        url: "getRandomImages.php",
        cache: false,
        dataType: "JSON",
        success: function (response) {
        var message = "";
                console.log(response);
               
            response.forEach(i => {
                 message += "<div class='col-md-6 col-lg-3'>"
                + `<a class='lightbox' href="./css/img/homepageImg/${i}">`
                + `<img src="./css/img/homepageImg/${i}" alt='randomImage'>`
                + "</a></div>";
            });
                $("#images").html(message);
        },
        error: function (obj, textStatus, errorThrown) {
        console.log("Error " + textStatus + " : " + errorThrown);
        }
});
        });
        /*
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/capillary.jpg">
         <img src="./css/img/homepageImg/capillary.jpg" alt="capillary">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/cardiacmuscle.jpg">
         <img src="./css/img/homepageImg/cardiacmuscle.jpg" alt="cardiacmuscle">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/collagenfibers.jpg">
         <img src="./css/img/homepageImg/collagenfibers.jpg" alt="collagenfibers">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/gallbladder.jpg">
         <img src="./css/img/homepageImg/gallbladder.jpg" alt="gallbladder">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/hepatocytes.jpg">
         <img src="./css/img/homepageImg/hepatocytes.jpg" alt="hepatocytes">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/interlobularduct.jpg">
         <img src="./css/img/homepageImg/interlobularduct.jpg" alt="interlobularduct">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/kupffercell.jpg">
         <img src="./css/img/homepageImg/kupffercell.jpg" alt="kupffercell">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/neuromuscularjunction.jpg">
         <img src="./css/img/homepageImg/neuromuscularjunction.jpg" alt="neuromuscularjunction">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/peripheralnerve.jpg">
         <img src="./css/img/homepageImg/peripheralnerve.jpg" alt="peripheralnerve">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/kupffercell.jpg">
         <img src="./css/img/homepageImg/kupffercell.jpg" alt="kupffercell">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/neuromuscularjunction.jpg">
         <img src="./css/img/homepageImg/neuromuscularjunction.jpg" alt="neuromuscularjunction">
         </a>
         </div>
         <div class="col-md-6 col-lg-3">
         <a class="lightbox" href="./css/img/homepageImg/neuromuscularjunction.jpg">
         <img src="./css/img/homepageImg/neuromuscularjunction.jpg" alt="neuromuscularjunction">
         </a>
         </div>        
         
         */