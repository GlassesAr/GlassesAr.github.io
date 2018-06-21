
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title></title>
	<?
		include_once 'PDO.php';
	?>

		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/main_catalog.css">
</head>
<body>
	
	<header>
		<div class="top_header">
			<div class="row">
				<div class="col-xs-6 col-lg-2 col-xs-offset-6  br">
					<a href="/" class="header__action-link"><i class="fas fa-table"></i> Главная страница</a>
				</div>
				<div class="col-xs-6 col-lg-2 br">
					<a href="" class="header__action-link"><i class="fas fa-book"></i> Документация </a>
				</div>
				<div class="col-xs-6 col-lg-2 col-force-width br">
					<a href="/personal/cart/wishlist/" title="" class="header__action-link"><i class="fas fa-address-book"></i> Контакты</a>
				</div>
			</div>

		</div>

		<div class="section_header">
			<div class="row">
				<div class="logo">
					<a href="/catalog.php">
						<img src="../images/logo.jpg">
					</a>
				</div>
			</div>
		</div>

		<div class="top_header right">
			<div class="row">
				<div class="col-xs-6 col-lg-2 col-force-width br">
					<a href="/catalog.php" title="" class="header__action-link"><i class="fab fa-connectdevelop"></i> Каталог</a>
				</div>
				<div class="col-xs-6 col-lg-2 col-force-width br">
					<a href="../editor.html" title="" class="header__action-link"><i class="fas fa-edit"></i> Редактор</a>
				</div>
			</div>

		</div>
	</header>

	<section class = "catalog_items">
		<div class="row">
				
				<?foreach ($ArrCatalog as $key => $value): ?>
					<div class=" col-sm-6 col-lg-3">
						<div class="catalog__item">
							<div class="catalog__main">
							<a href=" item/?ID=<?=$value['ID']?>" >
								<figure>
									<div class="catalog__img js-img-background-target" style="background-image: url(<?=$value['SRC_IMAGE']?>);">
										 
									</div>
									<figcaption class="catalog__title"><?=$value['NAME']?></figcaption>
								</figure>
							</a>
								<div class="catalog__price rub">
													6 990 <i class="fas fa-ruble-sign"></i>
								</div>

							
							</div>
							<div class="events">
									<a href="item/?ID=<?=$value['ID']?>" class="btn_events">
										Перейти
									</a>
									<a href="#" class="btn_events line">
										3D
									</a>
							</div>
						</div>
				</div>
				
				<?endforeach;?>


		</div>
	</section>
</body>
</html>