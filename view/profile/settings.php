<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Настройки</title>
	<meta name="description" content="Grandin is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Grandin Admin, Grandinadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Data table CSS -->
	<link href="/public/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- Toast CSS -->
	<link href="/public/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	<link href="/vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Custom CSS -->
	<link href="/public/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper theme-6-active pimary-color-pink">
		<?php include "view/common/topmenu.php"?>
	
		<?php include "view/common/leftmenu.php"?>
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				<!-- Row -->
				<div class="row">

						
							<div class="col-md-6">
								<div class="panel panel-default card-view">
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark">Смена пароля</h6>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-sm-12 col-xs-12">
													<div class="form-wrap">
														<form class="form-horizontal" method="POST" action="/engine/obr/profile.php">
															
															<div class="form-group">
																<label for="exampleInputpwd_32" class="col-sm-3 control-label">Введите новый пароль</label>
																<div class="col-sm-9">
																	<div class="input-group">
																		<div class="input-group-addon"><i class="icon-lock"></i></div>
																		<input type="password" class="form-control" name="new_password_1" id="exampleInputpwd_32" placeholder="Введите новый пароль">
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label for="exampleInputpwd_32" class="col-sm-3 control-label">Повторите новый пароль</label>
																<div class="col-sm-9">
																	<div class="input-group">
																		<div class="input-group-addon"><i class="icon-lock"></i></div>
																		<input type="password" class="form-control" name="new_password_2" id="exampleInputpwd_32" placeholder="Повторите новый пароль">
																	</div>
																</div>
															</div>
															
															<input type="hidden" name="action" value="change_pass"/>

															<div class="form-group mb-0">
																<div class="col-sm-offset-3 col-sm-9">
																	<button type="submit" class="btn btn-success ">Принять</button>
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
					
						<div class="col-md-6">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Подать заявку в White List</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
											<?php if(checkIsRequest("settings") != '<div class="alert alert-warning alert-dismissable alert-style-1">
					<i class="zmdi zmdi-alert-circle-o"></i>
					Подайте заявку в White List чтобы создавать персонажей! </div>' ):?>
												<?php echo checkIsRequest("settings"); ?>
											<?php else:?>
												<?php echo checkIsRequest("settings"); ?>
											<form  method="POST" action="/engine/obr/profile.php">
												
												<div class="form-group mb-10">
															<label class="control-label mb-10 text-left">Поле 1</label>
															<textarea class="form-control" name="box1" rows="5"></textarea>
														</div>
														<div class="form-group mb-10">
															<label class="control-label mb-10 text-left">Поле 2</label>
															<textarea class="form-control" name="box2" rows="5"></textarea>
														</div>
														<div class="form-group mb-10">
															<label class="control-label mb-10 text-left">Поле 3</label>
															<textarea class="form-control" name="box3" rows="5"></textarea>
														</div>
														<input type="hidden" name="action" value="create_request"/>
														<div class="form-group mb-0">
															<div class=" col-sm-12">
																<button type="submit" class="btn btn-block  btn-success">Принять</button>
															</div>
														</div>
												
											</form>
										<?php endif;?>
										</div>
									</div>
								</div>
							</div>
						</div>
	
				</div>
				
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2019 &copy; Amulet RP. Design by Reiner Ghost</p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="/public/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="/public/dist/js/jquery.slimscroll.js"></script>
	
	<!-- simpleWeather JavaScript -->

	
	<!-- Progressbar Animation JavaScript -->
	<script src="/public/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="/public/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="/public/dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="/public/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="/public/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Toast JavaScript -->
	<script src="/public/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

	
	<!-- Switchery JavaScript -->
	<script src="/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
	<script src="/public/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="/public/form.js"></script>
	<script src="/public/dist/js/init.js"></script>

</body>

</html>
