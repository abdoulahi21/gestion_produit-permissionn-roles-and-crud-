@extends('layouts.app')
@section('content')
<section class="home1">
    <div class="max-width">
        <div class="slide">
            <div class="slideshow-container">

                <div class="mySlides fade">

                    <img src="" style="width:100%">

                </div>

                <div class="mySlides fade">

                    <img src="sliderKalpé_0.png" style="width:100%">

                </div>

            </div>
            <br>
            <div style="text-align:center">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

            <script>
                var slideIndex = 0;
                showSlides();

                function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 4000); // Change image every 3 seconds
                }
            </script>

        </div>
    </div>
</section>

<section class="home10">

</section>
@endsection
<style>
    .home1 .max-width .slide img{
        height:500px;
        width:1200px;
        width:100%;
        object-fit: cover;

    }


</style>
