<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Health Care</title>

	<?php include('inc/head.php'); ?>
</head>

<body>
	<main>

		<?php include('inc/nav.php'); ?>

		<section class="header-bg g l2 m2 s1 xs1  align-fc">

			<div class=" g ggap-5 align-fc">
				<h2>We Aspire to Cure <br> Try to Heal</h2>
				<a href="#" class="btn btn-outline white">View our Centers</a>
			</div>

		</section>

		<section class="g l3 m2 s1 xs1 ggap-5 container pad-t-8 pad-b-8 ">

			<div class="hc-card "  onclick="window.location.href='signup.php'">
				<div class="hc-card-text ">
					<span class="mdi mdi-chart-line-variant tsize-20"></span>
					<h5>Grow with us</h5>
				</div>
				<div class="hc-card-btm">investors</div>
			</div>

			<div class="hc-card " onclick="window.location.href='partner.php'">
				<div class="hc-card-text ">
					<span class="mdi mdi-check-circle-outline tsize-20"></span>
					<h5>Get Recognised</h5>
				</div>
				<div class="hc-card-btm">Medical Practitioners</div>
			</div>

			<div class="hc-card " >
				<div class="hc-card-text ">
					<span class="mdi mdi-map-marker-outline tsize-20"></span>
					<h5>Medical Centers</h5>
				</div>
				<div class="hc-card-btm">Patients</div>
			</div>

		</section>

		<section class="grey lighten-4  pad-5 pad-t-8 pad-b-8 greysection">
			<div class="container g ggap-10">
				
			<div class="mv-card  g la1 ma1 s1 xs1 white shadow">
				<img class="mv-img" src="assets/img/mv-1.png" alt="">
				<div class="pad-4  g g1 ggap-2 white">
					<h5>Mission</h5>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate modi rem illum perferendis
						iure minima tenetur harum atque voluptatum ut quibusdam pariatur facilis dignissimos quod optio,
						dicta, consectetur commodi fugiat.</p>
					<a href="#" class="readmore">Read more <i class="mdi mdi-arrow-right"></i> </a>
				</div>
			</div>

			<div class="mv-card g la1 ma1 s1 xs1  white shadow">
				<img class="mv-img" src="assets/img/mv-2.png" alt="">
				<div class="pad-4 g g1 ggap-2 white">
					<h5>Visions</h5>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate modi rem illum perferendis
						iure minima tenetur harum atque voluptatum ut quibusdam pariatur facilis dignissimos quod optio,
						dicta, consectetur commodi fugiat.</p>
					<a href="#" class="readmore">Read more <span class="mdi mdi-arrow-right"></span> </a>
				</div>
			</div>

			</div>
		</section>

		<section class="covd white-text">
			<div class="g l1a m1a s1a xs1a ggap-2 container align-fc">
			<h4 class="talign-l">Taking action on COVID-19</h4>
			<a href="#" class="tsize-1 mdi mdi-arrow-right tsize-15"></a>
			</div>
		</section>



	</main>

	<?php include('inc/footer.php'); ?>

	<?php include('inc/bottomjs.php'); ?>




</body>

</html>