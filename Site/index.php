<!doctype html>
<html lang="en" class="no-js">
<head>
	
  <meta charset="UTF-8" />
  <title>Главная Страница</title>

  <?
		$ID = 1;

		include_once 'PDO.php';

		
		$key = array_search($ID, array_column($ArrCatalog, 'ID'));

		$result1 = array_column($ArrCatalog, 'ID');
		$result2 = array_column($ArrCatalog, 'SRC_JSON');
		$result = array();

		foreach ($result1 as $key => $value) {

			$string = file_get_contents(''.$result2[$key]);
			$json_a = json_decode($string, true);

			$result[$key] = array(
				'ID'=> $value,
				'JSON'=> $json_a,
			);
		}
		// echo '<pre>';
		// var_dump($arImg);
		// echo '</pre>';
		// $string = file_get_contents($value['SRC_JSON']);
		// $json_a = json_decode($string, true);
	?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    

	
    <link rel="stylesheet" href="css/style.css" />
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <!-- remember, jQuery is completely optional -->
  <!-- <script type='text/javascript' src='js/jquery-1.11.1.min.js'></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
  <script type='text/javascript' src='js/jquery.particleground.min.js'></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/main_catalog_new.css">
  <link rel="stylesheet" type="text/css" href="fullpage/jquery.fullPage.css" />
  
  <script type="text/javascript" src="fullpage/jquery.fullPage.js"></script>
  <script type="text/javascript" src="js/scrolloverflow.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

  <!-- jQuery Modal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />


  <script type='text/javascript' src='js/demo.js'></script>

  <!-- brfv4 -->
	<script>
		var brfv4Example = { stats: {} };
		var brfv4BaseURL = "js/libs/brf_wasm/";

		 $('#right').css({"-webkit-transform":" rotateY( 90deg ) translateZ( 126px )  "});
		 $('#left').css({"-webkit-transform":" rotateY( 90deg ) translateZ( -126px )  "});
	</script>
	<script async src="js/utils/BRFv4Stats.js"></script>
	<script type="text/javascript">
		var myArray = <?php echo json_encode($result); ?>;
	</script>

</head>
<body onload="myFunction()" style="margin:0;">

<div id="loader"></div>

<!-- <div id="particles">
  <div id="intro">
    <h1>Glasses AR</h1>
    <p>A JavaScript AR plug-in for visualization of accessories</p>
    <a href="catalog.php" class="btn">Demo</a>
    <a href="editor.html" class="btn">Editor</a>
    <a href="https://github.com/" class="btn down">Download</a>
  </div>
</div> -->

<div id="fullpage" style="display:none;" class="animate-bottom">
	<script>
var myVar;

function myFunction() {
   var doFullpage = document.documentElement.clientWidth;
   console.log(doFullpage );

    	myVar = setTimeout(showPage, 1000);
}

function showPage() {
	var doFullpage = document.documentElement.clientWidth;
	if (doFullpage > 768) {
		document.getElementById("fp-nav").style.display = "block";
	}
  	document.getElementById("loader").style.display = "none";
 	 document.getElementById("fullpage").style.display = "block";
   var intro = document.getElementById('intro');
    intro.style.marginTop = -intro.offsetHeight / 2 + 'px';
}
</script>
	<div class="section body">
		<div id="particles">
			  <ul class="header__meta">
			        <li>Demo version: <strong>0.0.1</strong></li>
			        <li></li>
			  </ul>
			  <div id="intro">
			    <h1>Glasses AR</h1>
			    <p>Программное AR расширение JavaScript для визуализации аксессуаров</p>
			    <a href="#secondPage" class="btn_my">Демо Каталог</a>
			    <a href="editor.html" class="btn_my">Редактор</a>
			    <a href="https://github.com/" class="btn_my down">Загрузить</a>
			  </div>
			  </div>
	</div>
	<div class="section container catalog_items">
			<div class="spb_content_element col-sm-12 spb_text_column">
				<div class="spb-asset-content" style="padding-top:5%;padding-bottom:5%;padding-left:0%;padding-right:0%;">
					<h2 style="text-align: center;">Пример работы</h2>
				</div>
			</div>
				
				<?foreach ($ArrCatalog as $key => $value): ?>
					<div class=" col-sm-6 col-lg-6">
						<div class="catalog__item">
							<div class="catalog__main">
								<figure>
									<div class="owl-carousel">

									<?foreach ($arImg[$value['ID']] as $key => $value1):?>
									
									  <div class="catalog__img js-img-background-target" style="background-image: url(<?=$value1?>);">
										  
									  </div>


									  <?endforeach;?>
									<!-- <a href=" item/?ID=<?=$value['ID']?>" > -->
									<!-- </a> -->
									
								</figure>
							<!--  -->
							<div class = "catalog_botom">
								<div class="left_btn">
									
									<figcaption class="catalog__title"><?=$value['NAME']?></figcaption>
									<div class="catalog__price rub">
										<span><?=$value['PRICE']?> <i class="fas fa-ruble-sign"></i></span>
										</div>	
								</div>
								
								<div class="right_btn">
									<span>
										<a href="#ex1" class="btn_example line layer" id ="<?=$value['ID']?>">
												<i class="fas fa-glasses"></i> Примерить
										</a>
									</span>
								</div>		
								<div class="clearfix"></div>
							</div>		

									
								</div>

							
							<!-- <div class="events">
									<a href="item/?ID=<?=$value['ID']?>" class="btn_events">
										Перейти
									</a>
									<a href="#" class="btn_events line">
										3D
									</a>
							</div> -->
						</div>
				</div>
				<?//break;?>
				<?endforeach;?>
				<script type="text/javascript">
					$(document).ready(function() {
				 
				  $(".owl-carousel").owlCarousel({
				 
				      slideSpeed : 300,
				      paginationSpeed : 400,
				 
				      items : 1, 
				      itemsDesktop : false,
				      itemsDesktopSmall : false,
				      itemsTablet: false,
				      itemsMobile : false
				 
				  });
				 
				});
				</script>
				<div id="ex1" class="modal">
	  <div id="glass_container">
			<video	id="_webcam" style="display: none;" playsinline></video>
			<canvas	id="_imageData"></canvas>

			<div	id="mask" style="position: absolute; top: 0; left: 0; transform-origin: 50% 50%">
				<img src="<?=$json_a['left']['src']?>" style="position: absolute; top: <?=$json_a['left']['top']?>; left: <?=$json_a['left']['left']?>;" id="left">
				<img src="<?=$json_a['right']['src']?>" style="position: absolute; top: <?=$json_a['left']['top']?>; left: <?=$json_a['left']['left']?>;" id="right">
				<img src="<?=$json_a['top']['src']?>" style="position: absolute; top: <?=$json_a['top']['top']?>; left: <?=$json_a['top']['left']?>;" id="top">
			</div>

			<div id="glass_panel">
				<h2>Glasses AR</h2>
				<hr>
				

				<span id="plus" class="button_glass"><i class="fas fa-plus"></i></span>
				<span id="minus" class="button_glass"><i class="fas fa-minus"></i></span>
				<br>
				<hr>
				<span id="reload" class="button_glass"><i class="fas fa-sync-alt"></i></span>
				<span id="stop" class="button_glass"><i class="fas fa-stop"></i></span>

			</div>
		</div>
	</div>
	<script type="text/javascript">
		var stop = false;
		$( ".layer" ).click(function() {

		  initMask($(this).attr('id'));
		  $("#ex1").modal({
			  fadeDuration: 500,
			  fadeDelay: 0.25 // Will fade in 750ms after the overlay finishes.
			});
		    stop = false;
		    
		  	initExample();
		});

    	$('#ex1').on($.modal.BEFORE_CLOSE, function(event, modal) {
		  	stop = true;
		});


		function initMask(id){

			for (var i in myArray) {
				if(myArray[i].ID == id){
					console.log(myArray[i]['JSON'].right.trX);

		 			$('#right').css({"-webkit-transform":" rotateY( 90deg ) translateZ( 126px )  translateX("+(myArray[i]['JSON'].right.trX*-1)+"px)"});
		    		$('#left').css({"-webkit-transform":" rotateY( 90deg ) translateZ( -126px )  translateX("+(myArray[i]['JSON'].left.trX*-1)+"px)"});

					$('#left').css('top', myArray[i]['JSON'].left.top);
					$('#left').css('left', myArray[i]['JSON'].left.left);
					$('#left').attr('src', myArray[i]['JSON'].left.src);

					$('#right').css('top', myArray[i]['JSON'].right.top);
					$('#right').css('left', myArray[i]['JSON'].right.left);
					$('#right').attr('src', myArray[i]['JSON'].right.src);

					$('#top').css('top', myArray[i]['JSON'].top.top);
					$('#top').css('left', myArray[i]['JSON'].top.left);
					$('#top').attr('src', myArray[i]['JSON'].top.src);



				
				}
			  
			}
		}
	</script>

	<script type="text/javascript" src = 'js/GlassesAr.js'></script>

<script type="text/javascript">
	
</script>
		
			
	</div>
	<div class="section integration">
		<div class="container">
		<div class="col-lg-4">
			<h2>Ну что начнем?</h2>
			<div class = "pr">
				<h4 class="r">1. Подключение библиотеки JQuery</h4>
				<p class="r mb8 f gray">Убедитесь что вы подключили JQuery</p>
			</div>
			<div class = "pr">
				<h4 class="r">2. Подключение библиотеки BRFv4</h4>
				<p class="r mb8 f gray">Библиотека которая сможет найти ваше лицо :)</p>
			</div>
			<div class = "pr">
				<h4 class="r">3. Создать модель в <a href="editor.html">Редакторе</a></h4>
				<p class="r mb8 f gray">Простой редкатор в котором вы сможете создать свою json модель оправы, всего из 2 фотографий</p>
			</div>
			<div class = "pr">
				<h4 class="r">4. Подключить glassesar.js</h4>
				<p class="r mb8 f gray">Инициализруйте glassesar.js</p>
			</div>

		</div>
		<div class="col-lg-8">
			
			<div class="desktop">
				<div class="scrn mono f x1"> 
					<span style="color:#999">&lt;!doctype html&gt;</span>
					<br> &lt;html&gt;<br> 
					<div> &lt;head&gt; 
						<div> 
							<span style="color:#999">
							&lt;!-- custom css --&gt;
							</span>
							<br> 
							<span style="background-color:#c4e89d">
								&lt;link href="maskglasses.css" rel="stylesheet" type="text/css" /&gt;
							</span>
							<br> 
							<span style="color:#999">
								&lt;!-- jQuery lib --&gt;
							</span>
							<br> 
								&lt;script src="jquery.min.js"&gt;&lt;/script&gt;
							<br> 
							<span style="color:#999">
							&lt;!-- BRFv4 lib --&gt;
							</span>
							<br> 
							<span style="background-color:#c4e89d">
							&lt;script src="js/utils/BRFv4Stats.js"&gt;&lt;/script&gt;
							</span> 
						</div> 
							&lt;/head&gt;<br> &lt;body&gt; 
						<div> 
							<span style="color:#999">
								&lt;!-- element Mask --&gt;
							</span>
							<br> 
							<span style="">
							
								&lt;div id="glass_container"&gt;
								<br>
								<div style="">&lt;video	id="_webcam" style="display: none;" playsinline&gt;&lt;/video&gt;</div>
								<div style="">&lt;canvas id="_imageData"&gt;&lt;/canvas&gt;</div>
								<br>
								&lt;div	id="mask" style="position: absolute; top: 0; left: 0; transform-origin: 50% 50%"&gt;
								<br>
									&lt;img src="" style="position: absolute; top: "top" left: "left" id="left"&gt;
									<br>
									&lt;img src="" style="position: absolute; top: "top" left: "left"" id="right"&gt;
									<br>
									&lt;img src="" style="position: absolute; top: "top" left: "left" id="top"&gt;
									<br>
								&lt;/div&gt;
								<br>
								&lt;div id="glass_panel"&gt;
								<br>
									&lt;span id="reload"&gt;Перезапустить&lt;/span>&gt;
									<br>
									&lt;span id="stop"&gt;Остановить&lt;/span&gt;
									<br>
								&lt;/div&gt;
								<br>
								&lt;/div&gt;
								
							
							</span>
							<br> 
							<span style="color:#999">
							&lt;!-- init GlassesAr.js --&gt;
						</span>
						<br> 
						 
							<span style="background-color:#c4e89d">
							&lt;script src="js/GlassesAr.js"&gt;&lt;/script&gt;
							</span> 
							
						</div> &lt;/body&gt;  
					</div> &lt;/html&gt;
				</div>
			</div>
			</div>
		</div>
	</div>

<!-- <div class="section">Some section</div> -->
</div>
	
</div>


<!-- INCLUDE MASK -->
















<style type="text/css">
	#fp-nav ul li a span, .fp-slidesNav ul li a span {
		background: #fff !important;
	}
</style>
<script type="text/javascript">
		$(document).ready(function() {
			
			var doFullpage = document.documentElement.clientWidth;
                if (doFullpage > 768) {

                    $('#fullpage').fullpage({
						'verticalCentered': false,
						'css3': true,
						'sectionsColor': ['#F0F2F4', '#fff', '#fff', '#fff'],
						'navigation': true,
						'navigationPosition': 'right',
						 anchors: ['firstPage', 'secondPage', '3rdPage'],
						'navigationTooltips': ['Главная', 'Пример', 'Интеграция'],
						'normalScrollElements': '.desktop',
						'scrollOverflow': true
						
					});
                }
                else{
                	$('.body').css('height','100vh');
                }
		});

	</script>




</body>
</html>


