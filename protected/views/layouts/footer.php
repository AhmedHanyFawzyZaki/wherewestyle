<?php
$this->beginContent('//layouts/sidebars_layout');
$this->endContent();
?>

<footer class="container">
    <div class="row-fluid payment">
        <center>
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/paypal-straight-32px.png">
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/2checkout-straight-32px.png">
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/american-express-straight-32px.png">
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/cirrus-straight-32px.png"> 
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/discover-straight-32px.png">
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/maestro-straight-32px.png">
        </center>
    </div>
    <div class="row-fluid social_links">

        <div class="span10 flinks">
            <ul>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(1); ?>">About us</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(4); ?>">How to use paypal to pay</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(5); ?>">Buyer’s Help page</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(6); ?>">Seller’s Manual</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(2); ?>">Privacy Policy</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(3); ?>">Terms & Conditions</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(7); ?>">Billing Policy</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/faq">FAQ</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/contact">Contact Us</a></li>
            </ul>
        </div>

        <div class="span2 social">
            <a href="<?= Helper::yiiparam('facebook'); ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
            <a href="<?= Helper::yiiparam('twitter'); ?>"> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
            <a href="<?= Helper::yiiparam('google'); ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
            <a href="<?= Helper::yiiparam('youtube'); ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
        </div>

    </div>
    <div class="row-fluid copyrights">
        <center>
            <p>&copy; 2013 Where We Style. All Copyrights reserved.</p>
        </center>
    </div>
</footer>               
<!-- Le javascript
================================================= -->
<!-- Placed at the end of the document so the pages load faster -->


<script src="<?= Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/cloud-zoom.1.0.2.js"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-254857-6']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>
<script>
    $(function() {
        $('#myTab a:last').tab('show');
        $(".sh_arr").hover(function(){
            $(this).children('.f1_im').hide();
            $(this).children('.f2_im').show();
        },function(){
            $(this).children('.f2_im').hide();
            $(this).children('.f1_im').show();
        });
    })
</script>
<script>
    $('.carousel1').carousel({});
</script>
<script type="text/javascript">
    $("#show").click(function() {
        $(".feedform").slideToggle("slow");
    });
</script>
<!-- FlexSlider -->
<script defer src="<?= Yii::app()->request->baseUrl; ?>/js/jquery.flexslider.js"></script>

<script type="text/javascript">
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: true,
            itemWidth: 190,
            itemMargin: 2,
            directionNav: true,
            controlNav: false,
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });


</script>

<script type="text/javascript">
    $(document).ready(function() {

        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function() {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });

    });


</script>




<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/jquery.simplyscroll.js"></script> 
<link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/css/jquery.simplyscroll.css" media="all" type="text/css">
<script type="text/javascript">

    /*	$(document).ready(function(){
         
         
     $("#pause").click(function(){
     $("#scroller").simplyScroll({pauseOnHover: true});
     });
         
         
     }); */
</script>
<script>
    $(document).ready(function() {
        $("body").on("mouseenter", ".span3", function() {
            if ($(this).children(".item-fav").attr("chk") == "true") {
                $(this).children(".item-fav").css({top: 0});
            }
        });
        $("body").on("mouseleave", ".span3", function() {
            $(this).children(".item-fav").css({top: -55});
        });
        
        $('#comment_btn').click(function() {
            $('#comment_div').toggle('slow');
        });
    });
</script>

</body>
</html>
