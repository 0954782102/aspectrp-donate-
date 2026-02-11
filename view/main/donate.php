<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Донат - <?php echo $ucp_settings['s_title']?></title>

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/login.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>
<body class="login-page">
	<?php include "view/common/topmenu.php"; ?>

	

    <div class="heading">
        <div>
            <h1>Донат</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
	<section>
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-lg-6">
					<div class="login-block">
						<div class="container-form">
						
							
							<div class="form-group row">
								<label for="text" class="col-sm-4 col-form-label">Никнейм:</label>
								<div class="col-sm-8">
									<input  type="text" class="form-control text" placeholder="Введите никнейм">
								</div>
							</div>

							<div class="form-group row">
								<label for="text" class="col-sm-4 col-form-label">Сумма:</label>
								<div class="col-sm-8">
									<input type="password" class="form-control text" placeholder="Введите сумму">
								</div>
							</div>

							

							
							<div class="row justify-content-md-center mt-1">
								<div class="col-md-auto">
									<div class="form-group">
										<button class="btn" type="button" > Купить</button>
									</div>
								</div>
							</div>
					
						</div>

					</div>
				</div>
				
			</div>					
		</div>
	</section>
	
	<footer class="fixed-footer">
        <?php include "view/common/footer.php"; ?>
    </footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
    <script src="/public/main/js/main.js" ></script>

</body>
</html>