<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Личный кабинет - <?php echo $ucp_settings['s_title']?></title>
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
   
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
     <link rel="stylesheet" type="text/css" href="/public/main/css/profile.css">
    <link rel="stylesheet" type="text/css" href="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    

</head>
<body class="login-page">
	<?php include "view/common/topmenu.php"; ?>

	

    <div class="heading">
        <div>
            <h1>Личный кабинет</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
	<?php 
	$data = GetUserData();

	?>
	<section class="profile">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 profile__container d-flex">
					<div class="profile__content">
						<div class="col-lg-4 col-sm-12">
							<div class="user__skin__content d-flex">
								<img src="/public/main/img/skins/<?php echo $data[$ucp_table_settings['skin']] ?>.png" class="user__skin__image">
								<div class="user__name__content">
									<!-- <h1>Reiner Ghost</h1> -->
									<div class="block"><?php FixName($data[$ucp_table_settings['name']]) ?></div>
									<div class="block">#<?php echo $data[$ucp_table_settings['id']] ?></div>
								</div>
							</div>
							<div class="user__navblock__list">
								<a class="active tablinks" onclick="openTabs(event, 'stats')" id="defaultOpen"><div class="user__navblock">Статистика</div></a>
								<a class="tablinks" onclick="openTabs(event, 'skill')"><div class="user__navblock">Навыки</div></a>
								<a class="tablinks" onclick="openTabs(event, 'settings')"><div class="user__navblock">Настройки</div></a>

								<a href="/profile/roulette"><div class="user__navblock">Рулетка</div></a>
								<a href="/profile/exit"><div class="user__navblock">Выйти</div></a>
								
							</div>
						</div>

						<div class="col-lg-8 col-sm-12">
							<div class="user__header__table">
								<table>
									<tbody>
										<tr>
											<th>Последний вход</th>
											<th>Последний IP</th>
											<th>Состояние</th>				
										</tr>
										<tr>
											<td><?php echo $data[$ucp_table_settings['last_date']] ?></td>
											<td><?php echo $data[$ucp_table_settings['last_ip']] ?></td>
											<td><?php if($data[$ucp_table_settings['online']]) echo "В игре"; else echo "Не в игре"; ?></td>				
										</tr>
									</tbody>
								</table>
							</div>


							
							<div class="user__stats tabcontent" id="stats">
								<!-- <div class="user__stats"> -->
									
									<ul class="left">
										<li>Имя<span><?php FixName($data[$ucp_table_settings['name']]) ?></span></li>
										<li>Уровень<span><?php echo $data[$ucp_table_settings['level']] ?></span></li>
										<li>Наличные деньги<span><?php echo $data[$ucp_table_settings['cash']] ?>$</span></li>
										<li>Номер телефона<span><?php echo $data[$ucp_table_settings['u_phone']] ?></span></li>
										<li>Донат счет<span><?php echo $data[$ucp_table_settings['donate']] ?> руб.</span></li>
										<li>Банковский счет<span><?php echo $data[$ucp_table_settings['bank']] ?>$</span></li>
									</ul>
									<ul class="right">
										<li>Пол<span><?php if($data[$ucp_table_settings['sex']]) echo "Женский"; else echo "Мужской"; ?></span></li>
										<li>Бизнес<span><?php if($data[$ucp_table_settings['biz']] != -1) echo "№". $data[$ucp_table_settings['biz']]; else echo "Отсутствует"; ?></span></li>
										<li>Дом<span><?php if($data[$ucp_table_settings['house']] != -1) echo "№". $data[$ucp_table_settings['house']]; else echo "Отсутствует"; ?></span></li>
										<li>Домашний транспорт<span>Отсутствует</span></li>
										<li>Подработка<span>Отсутствует</span></li>
										<li>Фракция<span>Отсутствует</span></li>

									</ul>
								<!-- </div> -->
							</div>
							
							<div class="tabcontent " id="skill">
								<div class="user__skill__gun">
									<div >
										<div class="icon"><img src="/public/main/img/m4.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_M4']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_M4']] ?>%</div>
									</div>
									<div >
										<div class="icon"><img src="/public/main/img/ak47.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_AK47']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_AK47']] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/pistol.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_Pistol']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_Pistol']] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/sdpistol.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_SDPistol']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_SDPistol']] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/deagle.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_Deagle']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_Deagle']] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/shotgun.png" alt=""></div>
										<div class="progress-gun"><i style="width: ?php echo $data[$ucp_table_settings['Skill_ShotGun']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_ShotGun']] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/mp5.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_MP5']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_MP5']] ?>%</div>
									</div>

	                
									<div >
										<div class="icon"><img src="/public/main/img/sniper.png" alt=""></div>
										<div class="progress-gun"><i style="width: <?php echo $data[$ucp_table_settings['Skill_Sniper']] ?>%"></i></div>
										<div class="size-gun"><?php echo $data[$ucp_table_settings['Skill_Sniper']] ?>%</div>
									</div>
								</div>
	                		</div>
	                		<div class="tabcontent user__settings" id="settings" style="display: none;">
								<div class="settings-block">
								<div class="container-form">
									<form method="POST" action="/engine/obr/profile.php">
										
										<div class="form-group row">
											<label for="text" class="col-sm-4 col-form-label">Новый пароль:</label>
											<div class="col-sm-8">
												<input name="new_password_1" type="text" class="form-control text" placeholder="Введите новый пароль">
											</div>
										</div>

										<div class="form-group row">
											<label for="text" class="col-sm-4 col-form-label">Повтор нового пароля:</label>
											<div class="col-sm-8">
												<input name="new_password_2" type="text" class="form-control text" placeholder="Повторите новый пароль">
											</div>
										</div>

										
										<input type="hidden" name="action" value="change_password">
										
										<div class="row justify-content-md-center mt-1">
											<div class="col-md-auto">
												<div class="form-group">
													<button class="btn btn-gradient" type="submit" > Сменить</button>
												</div>
											</div>
										</div>
								
									</div>
								</form>
							</div>
								
	                		</div>
		                	
						</div>
					</div>
				
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="/public/main/js/form.js" ></script>
	<script src="/public/main/js/knob.js" ></script>
    <script src="/public/main/js/main.js" ></script>
    <script src="/public/main/js/profile.js" ></script>

 
</body>
</html>