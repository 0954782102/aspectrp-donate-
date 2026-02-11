<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Новости - <?php echo $ucp_settings['s_title']?></title>

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
	<?php include "view/common/topmenu.php"; ?>

	

    <div class="heading">
            <div>
                <h1>Новости</h1>
                <div class="breaker"></div>
            </div>
            <img src="/public/main/img/dots.svg" alt="">
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

							$statement = $db->prepare("SELECT * FROM `ucp_news` ORDER BY n_id DESC LIMIT 30");




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
			
		</div>
	</section>
	
	<footer>
        <?php include "view/common/footer.php"; ?>
    </footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
    <script src="/public/main/js/main.js" ></script>

</body>
</html>