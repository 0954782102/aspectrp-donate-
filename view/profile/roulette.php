<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Рулетка - <?php echo $ucp_settings['s_title']?></title>
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
   
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/roulette.css">
    
	
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>
<body class="roulette-page">
	<?php include "view/common/topmenu.php"; 

	 
	$data = GetUserData();

	?>

	

    <div class="heading">
        <div>
            <h1>Рулетка</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
	<div class="container-fluid">
   
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
				
				<div class="balance">Баланс: <b id="balance"><?php echo $data[$ucp_table_settings['donate']] ?></b> руб.</div><br>
				    <div class="roulette" >
				        <div class="roulette-container" >

				        </div>
				        <div class="pointer-roulette" ></div>


				    </div>
				    <br>
    <div style="text-align: center;">
 	<?php if($data[$ucp_table_settings['donate']] < $ucp_settings['s_donate_cost']):?>
 	<a href="/donate"><button class="button-roullet" >Пополнить баланс</button></a>
 	<?php else:?>
    <button class="button-roullet" id="go-roullet">Крутить за <b><?php echo $ucp_settings['s_donate_cost'] ?></b> руб.</button>
<?php endif;?>
 
    
    <p class="logs"></p></div>
</div></div></div>
    

    
				
		
	
	
	<footer >
        <?php include "view/common/footer.php"; ?>
    </footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/public/main/js/main.js" ></script>
    <script src="/public/main/js/roulette.js" ></script>
  

</body>
</html>