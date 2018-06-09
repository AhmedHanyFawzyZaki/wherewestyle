<?php 
    $this->beginContent('//layouts/sidebars_layout'); 
    $this->endContent(); 
?>

<footer class="container">
<div class="row-fluid payment">
<center>
  <img src="<?= Yii::app()->request->baseUrl ;?>/img/paypal-straight-32px.png">
  <img src="<?= Yii::app()->request->baseUrl ;?>/img/2checkout-straight-32px.png">
  <img src="<?= Yii::app()->request->baseUrl ;?>/img/american-express-straight-32px.png">
  <img src="<?= Yii::app()->request->baseUrl ;?>/img/cirrus-straight-32px.png"> 
  <img src="<?= Yii::app()->request->baseUrl ;?>/img/discover-straight-32px.png">
  <img src="<?= Yii::app()->request->baseUrl ;?>/img/maestro-straight-32px.png">
</center>
</div>
<div class="row-fluid social_links">

<div class="span10 flinks">
<ul>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(1) ;?>">About us</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(4);?>">How to use paypal to pay</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(5);?>">Buyer’s Help page</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(6);?>">Seller’s Manual</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(2);?>">Privacy Policy</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(3);?>">Terms & Conditions</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/<?= Helper::DrawPageLink2(7);?>">Billing Policy</a></li>
<li><a href="<?= Yii::app()->request->baseUrl ;?>/home/contact">Contact Us</a></li>
</ul>
</div>

<div class="span2 social">
  <a href="<?= Helper::yiiparam('facebook') ;?>"><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
  <a href="<?= Helper::yiiparam('twitter') ;?>"> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
  <a href="<?= Helper::yiiparam('google') ;?>"><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
  <a href="<?= Helper::yiiparam('youtube') ;?>"><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
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
  
    
    <script src="<?= Yii::app()->request->baseUrl ;?>/js/bootstrap.js"></script>
    <script src="<?= Yii::app()->request->baseUrl ;?>/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl ;?>/js/cloud-zoom.1.0.2.js"></script>
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
        $(document).ready(function(){
        $('#comment_btn').click(function(){			
			$('#comment_div').toggle('slow');
			});
        });
    </script>
   


  </body>
</html>
