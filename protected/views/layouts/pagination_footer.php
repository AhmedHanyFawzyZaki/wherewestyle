<?php
$this->beginContent('//layouts/sidebars_layout');
$this->endContent();
?>

<!--<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="log-form">
             <form class="form-horizontal">
                 <div class="control-group">
                 <label class="control-label" for="inputEmail">Email</label>
                 <div class="controls">
                 <input type="text" id="inputEmail" placeholder="Email">
                 </div>
                 </div>
                 <div class="control-group">
                 <label class="control-label" for="inputPassword">Password</label>
                 <div class="controls">
                 <input type="password" id="inputPassword" placeholder="Password">
                 </div>
                 </div>
                 <div class="control-group">
                 <div class="controls">
                         <label class="checkbox">
                             <input type="checkbox"> Remember me
                         </label>
                         <button type="submit" class="btn">Sign in</button>
                 </div>
                 </div>
         </form>
     </div>
 </div>         -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<script src="<?= Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/bootstrap-popover.js"></script>
<script type="text/javascript">
    $("#show").click(function() {
        $(".feedform").slideToggle("slow");
    });
</script>
<script>
    $('.carousel1').carousel({});
</script>
<script type="text/javascript">
    $(function() {
        $('#feed').popover();
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

        $(".sh_arr").hover(function(){
            $(this).children('.f1_im').hide();
            $(this).children('.f2_im').show();
        },function(){
            $(this).children('.f2_im').hide();
            $(this).children('.f1_im').show();
        });
        $("body").on("mouseenter", ".span3", function() {
            if ($(this).children(".item-fav").attr("chk") == "true") {
                $(this).children(".item-fav").css({top: 0});
            }
        });
        $("body").on("mouseleave", ".span3", function() {
            $(this).children(".item-fav").css({top: -55});
        });

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
</body>
</html>
