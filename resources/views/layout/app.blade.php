
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Anil z" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Shopwise is Powerful features and You Can Use The Perfect Build this Template For Any eCommerce Website. The template is built for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
<meta name="keywords" content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">

<!-- SITE TITLE -->
<title>@yield('title')</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset("frontend/assets/images/favicon.png") }}">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset("frontend/assets/css/animate.css") }}">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/all.min.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/themify-icons.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/linearicons.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/flaticon.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/simple-line-icons.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/magnific-popup.css">
<!-- Slick CSS -->
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/slick.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/slick-theme.css">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/style.css">
<link rel="stylesheet" href="{{ asset("/frontend") }}/assets/css/responsive.css">
<script src="{{asset('frontend/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/axios.min.js')}}"></script>
</head>

<body>

<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->

<!-- Home Popup Section -->
<div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
                <div class="row g-0">
                    <div class="col-sm-5">
                    	<div class="background_bg h-100" data-img-src="{{ asset('fronten
                        d') }}/assets/images/popup_img.jpg"></div>
                    </div>
                    <div class="col-sm-7">
                        <div class="popup_content">
                            <div class="popup-text">
                                <div class="heading_s1">
                                    <h4>Subscribe and Get 25% Discount!</h4>
                                </div>
                                <p>Subscribe to the newsletter to receive updates about new products.</p>
                            </div>
                            <form method="post">
                            	<div class="form-group mb-3">
                                	<input name="email" required type="email" class="form-control rounded-0" placeholder="Enter Your Email">
                                </div>
                                <div class="form-group mb-3">
                                	<button class="btn btn-fill-line btn-block text-uppercase rounded-0" title="Subscribe" type="submit">Subscribe</button>
                                </div>
                            </form>
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Don't show this popup again!</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
<!-- End Screen Load Popup Section --> 

@yield('content')










<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>
<script src="{{asset('frontend/assets/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/bootstrap/js/bootstrap.min.js')}}"></script>

<script>
    function carousel_slider() {
    $(".carousel_slider").each(function () {
        var $carousel = $(this);
        $carousel.owlCarousel({
            dots: $carousel.data("dots"),
            loop: $carousel.data("loop"),
            items: $carousel.data("items"),
            margin: $carousel.data("margin"),
            mouseDrag: $carousel.data("mouse-drag"),
            touchDrag: $carousel.data("touch-drag"),
            autoHeight: $carousel.data("autoheight"),
            center: $carousel.data("center"),
            nav: $carousel.data("nav"),
            rewind: $carousel.data("rewind"),
            navText: [
                '<i class="ion-ios-arrow-left"></i>',
                '<i class="ion-ios-arrow-right"></i>',
            ],
            autoplay: $carousel.data("autoplay"),
            animateIn: $carousel.data("animate-in"),
            animateOut: $carousel.data("animate-out"),
            autoplayTimeout: $carousel.data("autoplay-timeout"),
            smartSpeed: $carousel.data("smart-speed"),
            responsive: $carousel.data("responsive"),
        });
    });
    }

</script>

</body>
</html>