<!DOCTYPE HTML>
<html>
<head>
<title>HMVC Jagowebdev</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/vendors/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/themes/modern/css/site.css?r=<?=time()?>"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/themes/modern/css/fonts/poppins.css?r=<?=time()?>"/>
<script type="text/javascript" src="<?=base_url()?>/public/vendors/jquery/jquery.min.js"></script>
<style>

table th {
	text-align: center;
	padding: 2px;
}
table td {
	border: 1px solid #CCCCCC;
	padding: 2px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('.btn-mobile').click(function(){
		$('.nav-header').stop(true, true).slideToggle();
	});
})

</script>
</head>
<body>
<header>
	<div class="menu-wrapper wrapper">
		<div class="nav-left">
			<a href="<?=base_url()?>/" title="Jagowebdev">
				<img src="https://jagowebdev.com/members//public/images/logo.jpg" alt="Jagowebdev"/>
			</a>
		</div>
		<nav class="nav-right nav-header">			
			<ul>
				<li class="menu"><a href="<?=base_url()?>/produk">Produk</a></li>
				<li class="menu"><a href="https://jagowebdev.com/members/">Premium</a></li>
			</ul>
		</nav>
		<a href="javascript:void(0)" class="btn-mobile">☰</a>
	</div>
</header>
<div class="wrapper">