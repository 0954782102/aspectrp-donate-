<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Главная - <?php echo $ucp_settings['s_title']?></title>

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 
</head>
<body >
	<?php include "view/common/topmenu.php"; ?>

	<section class="slider">
		
        <div class="slider-text">
            <h1><b><?php echo $ucp_settings['s_title']?></b> <span class='no-weight'>— Проект твоего будущего.</span></h1>
            <div class="start-slider">Начать играть<img src="/public/main/img/arrow-right.svg" alt=''></div>
        </div>
        <div class="slider-image"><img src='/public/main/img/slider-image.png' alt=''></div>
        <img src="/public/main/img/vertical-slider.png" id='vertical-slider'>
      
	</section>
	<div class="heading">
            <div>
                <h1>Наши сервера</h1>
                <div class="breaker"></div>
            </div>
        </div>

	<?php 
	$mysqli = mysqli_connect('localhost', 'mysql', 'mysql', 'public');
	$sql = "SELECT * FROM `accounts` WHERE `online` != 0";
	$result = $mysqli->query($sql);
	$rows = $result->fetch_row();
	$online = $rows[0] +0;
	?>

	<section class="monitoring">
		<div class="container">
			
			<div class="row">	
				<i class="monitoring-man"><img src="/public/main/img/mont-man.png" width="600"alt=""></i>
				<div class="col-lg-12">
					<div class="servers">
						<div class="col-lg-5">
							<div class="server-size">
								<p><strong><?php echo $online ?></strong></p>
								<p>/ 1000</p>
								<img src="/public/main/img/countPlayerMonitoring.png" alt="">
							</div>
							<p><?php echo $ucp_settings['s_title']?></p>
							<p><strong>Test</strong></p>
							<p class="ip" style="">pawno-info.ru:7777</p>
							
						</div>
		       							
		       		</div>
				</div>
					
			</div>
		</div>

    	
	</section>

	<div class="horisontal-slider">
        <img src='/public/main/img/horisontal-slider.png'>
    </div>

    <div class="heading">
        <div>
            <h1>Новости</h1>
            <div class="breaker"></div>
        </div>
    </div>
	<section>
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-sm-12">

					<div class="full-news d-flex" >
						
							
						<div class="col-lg-6" style="margin-top: 100px">
						
						<div class="content-news">
							<h2 class="title-news">Новостной блок</h2>

							<div class="breaker"></div>

							<div class="text-news">Здесь показаны последнии новости проекта. Вы можете ознакомиться со всеми обновлениями, ситуациями и тому подобное</div>

						</div>	
						</div>
						
						<div class="col-lg-6 postImageFull"  ></div>

							
						
						
						
					</div>
				</div>
				<?php
				
							global $db;

							$statement = $db->prepare("SELECT * FROM `ucp_news` ORDER BY n_id DESC LIMIT 4");




							$statement->execute ();

							if($statement->rowCount()) 
							{
								while($news=$statement->fetch())
								{

											
											
											 echo '
				<div class="col-lg-4 col-sm-6">
					<div class="default-news">
						<img src="'.$news['n_images'].'" class="dPostImage">
						<div class="content-news">
							<h2 class="title-news">'.$news['n_title'].'</h2>

							<div class="breaker"></div>

							<div class="text-news">'.$news['n_text'].'</div>

							<div class="more-news">
                        		<div class="date-news">
                        			<img src="/public/main/img/calendar.svg" alt="">
                        			'.$news['n_data'].'
                        		</div>
                        		<a href="'.$news['n_url'].'"><img src="/public/main/img/3dots.svg" alt="" id="dots-more"></a>
                    		</div>

						</div>
						
					</div>
				</div>'; } } ?>
				
				


			</div>
			<div class="row justify-content-md-center">
				
	
					<div class="col-md-auto">

					<a href="/news" style="text-decoration: none"><div class="showall">ПОКАЗАТЬ ВСЕ<img src="/public/main/img/3dots.svg" alt=""></div></a>
				</div>
				

			</div> 
		</div>
	</section>
	
	<footer>
        <?php include "view/common/footer.php"; ?>
    </footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
    <script src="/public/main/js/main.js" ></script>

</body>
</html>