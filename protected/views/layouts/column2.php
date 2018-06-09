<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Where We Style</title>
   
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?= Yii::app()->request->baseUrl ;?>/css/bootstrap.css" rel="stylesheet">
  
    <link href="<?= Yii::app()->request->baseUrl ;?>/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ;?>/css/flexslider.css" type="text/css" media="screen" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->

  <link rel="shortcut icon" href="">

  </head>

  <body>
    <?php echo $content; ?>
<script src="<?= Yii::app()->request->baseUrl ;?>/js/jquery.js"></script>
    <script src="<?= Yii::app()->request->baseUrl ;?>/js/bootstrap.js"></script>
    <script src="<?= Yii::app()->request->baseUrl ;?>/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="js/cloud-zoom.1.0.2.js"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-254857-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
   <script>
$(function () {
$('#myTab a:last').tab('show');
})
</script>
  <script>
      $('.carousel1').carousel({});
  </script>
    <script type="text/javascript">
   $("#show").click(function(){
   $(".feedform").slideToggle("slow");
});
    </script>
 <!-- FlexSlider -->
  <script defer src="<?= Yii::app()->request->baseUrl ;?>/js/jquery.flexslider.js"></script>
  
  <script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 190,
        itemMargin: 2,
    directionNav: true,  
    controlNav: false,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  

  </script>

 <script type="text/javascript">
    $(document).ready(function(){
 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
 
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });


</script>


  </body>
</html>