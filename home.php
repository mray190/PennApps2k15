<?php
	session_start();
?>
<!DOCTYPE HTML>
<!--
	Astral by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Shop Buddy</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script language="javascript" type="text/javascript">
		  function resizeIframe(obj) {
		    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		  }
		</script>
	</head>
	<body>

		<!-- Wrapper-->
			<div id="wrapper">

				<!-- Nav -->
					<nav id="nav">
						<a href="#me" class="icon fa-home active"><span>Home</span></a>
						<!--<a target="_blank" href="scan.html" class="icon fa-camera"><span>Scan</span></a>-->
						<a href="#scan" class="icon fa-camera"><span>Scan</span></a>
						<a href="#calendar" class="icon fa-calendar-plus-o"><span>Calendar</span></a>
						<a href="#contact" class="icon fa-envelope"><span>Contact</span></a>

					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Me -->
							<article id="me" class="panel">
								<header>
									<h1>Shop Smarter</h1>
									<p>Let Shop Buddy predict your habits</p>
								</header>
								<a href="#scan" class="jumplink pic">
									<span class="arrow icon fa-chevron-right"><span>See my work</span></span>
									<img src="images/me.jpg" alt="" />
								</a>
							</article>

						<!-- Scan -->
							<article id="scan" class="panel">
								<header>
									<h2>Scan</h2>
									<p>Hold your product's barcode up to the camera.</p>
									<iframe src="scan.html" width="800" scrolling="no" onload='javascript:resizeIframe(this);' ></iframe>
								</header>



							</article>

						<!-- Calendar -->
							<article id="calendar" class="panel">
								<header>
									<h2>Calendar</h2>
									<p>Click on a product to reorder now.</P>
									<iframe src="calendar/public/index.php" width="800" scrolling="no" onload='javascript:resizeIframe(this);' ></iframe>
								</header>



							</article>

						<!-- Contact -->
							<article id="contact" class="panel">
								<header>
									<h2>Contact Us</h2>
									<p>We'd love to hear from you!</p>
								</header>
								<form action="#" method="post">
									<div>
										<div class="row">
											<div class="6u 12u$(mobile)">
												<input type="text" name="name" placeholder="Name" />
											</div>
											<div class="6u$ 12u$(mobile)">
												<input type="text" name="email" placeholder="Email" />
											</div>
											<div class="12u$">
												<input type="text" name="subject" placeholder="Subject" />
											</div>
											<div class="12u$">
												<textarea name="message" placeholder="Message" rows="8"></textarea>
											</div>
											<div class="12u$">
												<input type="submit" value="Send Message" />
											</div>
										</div>
									</div>
								</form>
							</article>

					</div>



			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
