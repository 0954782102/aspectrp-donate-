<header>	
	<div class="burg">
		<nav id="desktop">
        	<div class="container">
	            <img src="<?php echo $ucp_settings['s_logo']?>" class="nav-brand">
	            <div class="nav-content">
	                <div class="nav-items">
	                    <a href='/'>Главная</a>
	                    <a href='/donate'>Донат</a>
	                    <a href='/news'>Новости</a>
	                    <a href='/profile/roulette'>Рулетка</a>
	                    <a href='#'>Форум</a>
	                </div>
	                
	                <div class="nav-lk">
	                    <img src="/public/main/img/person.svg" alt="">
	                    <?php if(isset($_SESSION['NickName'])):?>
	                    <a href="/profile/"><?php echo $_SESSION['NickName']?></a>
	                    <?php else: ?>
	                    <a href="/profile/">Личный кабинет</a>
	                	<?php endif; ?>

	                  
	                </div>
	                
	            </div>
            </div>
        </nav>
	</div>

	<div id="burg">
		<a href="#">
			<span class="bar" id="top"></span>
			<span class="bar" id="middle"></span>
			<span class="bar" id="bottom"></span>
		</a>
	</div>

	<div class="mobile-tab">
		<nav id="mobile">
			<ul class="menu-m">

				<li class="menu__item-m">
					<a href='/'>Главная</a>
				</li>
				<li class="menu__item-m">
					<a href='/donate'>Донат</a>
				</li>
				<li class="menu__item-m">
					<a href='/news'>Новости</a>
				</li>
				<li class="menu__item-m">
					<a href='/profile/roulette'>Рулетка</a>
				</li>
				<li class="menu__item-m">
					<a href='#'>Форум</a>
				</li>
				<li class="menu__item-m ">
					<?php if(isset($_SESSION['NickName'])):?>
                    <a href="/profile/"><?php echo $_SESSION['NickName']?></a>
                    <?php else: ?>
                    <a href="/profile/">Личный кабинет</a>
                	<?php endif; ?>
				</li>
			</ul>
		</nav>
	</div>   
</header>