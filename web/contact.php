<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html>
	<head>
		<title>Home-land Bootstarp Website Template | Home :: w3layouts</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
		<!-- web-font -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!-- web-font -->
		<!-- js -->
		<script src="./js/jquery.min.js"></script>
		<script src="./js/modernizr.custom.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- js -->
		<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="./js/move-top.js"></script>
		<script type="text/javascript" src="./js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
        
		<!-- start-smoth-scrolling -->
	</head>
	<body>
		<!-- header -->
	<div id="home" class="header-top">
			<!-- container -->
			<div class="container">
				<div class="head-left">
					<a href="#"><img src="./images/logo.png" alt="" /></a>
				</div>
				<div class="head-right">
                <div class="location">
                <p>
							www.AllSeasonHomeImprovement.com</span>
						</p>
                </div>
					<!--
                    <div class="phone">
						<p>Phone:
							<span>+1 234 567 9871</span>
						</p>
					</div>
					<div class="location">
						<p>Location:
							<span>756 CD-Road</span>
							Brezil,M07 435.
						</p>
					</div>
                    -->
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- //container -->
		</div>
		<div class="header-bottom">
			<!-- container -->
			<div class="container">
				<div class="top-nav">
					<span class="menu">Menu</span>
					<ul class="nav1">
						<li><a href="index.html">HOME</a></li>
						
						<li><a href="services.html">SERVICES</a></li>
						<li><a href="galary.html" >GALLERY</a></li>
						<li><a href="sale.html" >SALE</a></li>
                        <li><a href="about.html">ABOUT</a></li>
						<li><a href="contact.html" >CONTACT US</a></li>
                        
					</ul>
					<!-- script-for-menu -->
							 <script>
							   $( "span.menu" ).click(function() {
								 $( "ul.nav1" ).slideToggle( 300, function() {
								 // Animation complete.
								  });
								 });
							</script>
						<!-- /script-for-menu -->
				</div>
			</div>
			<!-- //container -->
		</div>
		<!-- //header -->
	
			
		
		
		
		<!-- contact -->
		<div id="contact" class="contact">
			<!-- container -->
			<div class="container">
				<div class="contact-info">
					<h3>contact</h3>
				</div>
			</div>
			<!-- container -->

			<!-- container -->
			<div class="container">
				<div class="contact-grids">
					<div class="col-md-5">
						<div class="contact-grid-info">
							<div class="contact-grid-left">
								<h6>Contact info</h6>
								<p>In pharetra dui vitae odio maximus vulputate. Nul
									am finibus dui more neque dui vitae odio maximu.
									In pharetra dui vitae odio maximus vulputate. Null
									finibus dui more neque.odio maximus vulputate. 
									Nulla odio maximus vulputate. Nulla odio maxi.
								</p>
								<h6>The Company Name agi.
									<span>756 gt globel Place,</span>
									CD-Road,M 07 435.
								</h6>
								<p>Telephone: +1 234 567 9871
									<span>FAX: +1 234 567 9871</span>
									E-mail: <a href="mailto:info@example.com">mail@user.com</a>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="contact-grid-info">
							<div class="contact-grid-right">
								<h6>Contact info</h6>
								<form action="send.php" method="post">
									<input type="text" placeholder="Name:"  name="name" required>
									<input type="text" placeholder="E-mail:" name="email" required>
									<input type="text" placeholder="Phone:" name="phone" required>

									<textarea placeholder="Message:" name="message" required></textarea>
									<input type="submit"  value="SEND">
								</form>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<!-- //container -->
		</div>
        <div class="map">
				<iframe src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=City+of+Westminster,+United+Kingdom&amp;aq=0&amp;oq=westmi&amp;sll=51.50917,-0.245132&amp;sspn=0.311545,0.837021&amp;ie=UTF8&amp;hq=&amp;hnear=City+of+Westminster,+Greater+London,+United+Kingdom&amp;ll=51.483521,-0.082054&amp;spn=0.155803,0.41851&amp;t=m&amp;z=12&amp;output=embed"></iframe>
			</div>
		<!-- //contact -->
		<!-- footer -->
		<div class="footer">
			<!-- container -->
			<div class="container">
            <div class="col-md-8" style="float:left">
            <h4>Our Corporate!</h4>
				<p>All season home improvement is xxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxx xxx xxxx.</p>
                </div>
                
                    <div class="col-md-4" style="float:left">
            <h4>Contact With Us</h4>
				<p>All season home.</p>
                </div>
			</div>
			<!-- //container -->
		</div>
		<!-- //footer -->
		<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
									<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- content-Get-in-touch -->
	</body>
</html>