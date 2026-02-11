
<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Новости - Admin - <?php echo $ucp_settings['s_title']?></title>
  <link rel="apple-touch-icon" href="<?php echo $ucp_settings['s_favicon']?>">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $ucp_settings['s_favicon']?>">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/vendors/css/forms/icheck/custom.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/vendors/css/extensions/unslider.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/vendors/css/weather-icons/climacons.min.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/core/colors/palette-climacon.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/fonts/simple-line-icons/style.min.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/fonts/meteocons/style.min.css">
  <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/pages/users.css">
    <link rel="stylesheet" type="text/css" href="/public/admin/app-assets/css/pages/chat-application.css">   

  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="/public/admin/assets/css/style.css">
  <!-- END Custom CSS-->
 
</head>

<?php include "common/leftmenu.php" ?>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      	
      </div>
      <div class="content-body">

        

       
        <div class="row match-height">
          
          <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-tooltip">Работа с новостями</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  
                </div>
                <div class="card-content">
                  <div class="card-body">
                    
                 
                          <button type="button" class="btn btn-outline-primary block btn-lg" data-toggle="modal"
                          data-target="#default">
                            Создать новость
                          </button>
                          <br><hr>
                          <table class="table">
                    <thead class="bg-primary">
                      <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Дата</th>
                        <th>Действия</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php
				
							global $db;

							$statement = $db->prepare("SELECT * FROM `ucp_news` ORDER BY n_id DESC LIMIT 30");




							$statement->execute ();

							if($statement->rowCount()) 
							{
								while($news=$statement->fetch())
								{

											echo '<div class="modal fade text-left" id="edit-'.$news['n_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                          aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel1">Редактирование новости - '.$news['n_title'].'</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form method="POST" action="/engine/obr/admin.php">
                               	<div class="modal-body">
                                  <div class="row">
                                  	
			                          <div class="col-lg-12">
			                            <div class="form-group">
			                              <label for="projectinput1">Название новости</label>
			                              <input type="text" id="projectinput1" class="form-control" value="'.$news['n_title'].'"
			                              name="n_title">
			                            </div>
			                          </div>
			                          <div class="col-lg-12">
			                            <div class="form-group">
			                              <label for="projectinput2">Ссылка на картинку</label>
			                              <input type="text" id="projectinput2" class="form-control" value="'.$news['n_images'].'"
			                              name="n_images">
			                            </div>
			                          </div>
			                          <div class="col-lg-12">
			                            <div class="form-group">
			                              <label for="projectinput2">Ссылка на новость</label>
			                              <input type="text" id="projectinput2" class="form-control" value="'.$news['n_url'].'"
			                              name="n_url">
			                            </div>
			                          </div>
			                          <div class="col-lg-12">
			                          	<div class="form-group">
				                          <label for="projectinput8">Небольшое описание</label>
				                          <textarea id="projectinput8" rows="5" class="form-control" name="n_text" >'.$news['n_text'].'</textarea>
				                        </div>
			                          </div>
			                        
			                       	</div>
                                </div>
                                <div class="modal-footer">
                                	<input type="hidden" name="n_id" value="'.$news['n_id'].'">	
                                  <input type="hidden" name="action" value="update_news">	
                                  <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>';
											$button_delete = '<button type="button" class="btn btn-danger" onclick="DeleteNews('.$news['n_id'].');">Удалить</button>';
											 echo "
				<tr>
                        <th scope='row'>{$news['n_id']}</th>
                        <td>{$news['n_title']}</td>
                        <td>{$news['n_data']}</td>
                        <td><button type='button' class='btn btn-primary ' data-toggle='modal'
                          data-target='#edit-{$news['n_id']}'>Редактировать</button>
							{$button_delete}
                          </td>
                      </tr>"; } } ?>
				
                      
                    </tbody>
                  </table>
                          <!-- Modal -->
                          <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                          aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel1">Создание новости</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form method="POST" action="/engine/obr/admin.php">
                               	<div class="modal-body">
                                  <div class="row">
                                  	
			                          <div class="col-lg-12">
			                            <div class="form-group">
			                              <label for="projectinput1">Название новости</label>
			                              <input type="text" id="projectinput1" class="form-control" placeholder="Обновление на сервере"
			                              name="n_title">
			                            </div>
			                          </div>
			                          <div class="col-lg-12">
			                            <div class="form-group">
			                              <label for="projectinput2">Ссылка на картинку</label>
			                              <input type="text" id="projectinput2" class="form-control" placeholder="google.com/img.png"
			                              name="n_images">
			                            </div>
			                          </div>
			                          <div class="col-lg-12">
			                            <div class="form-group">
			                              <label for="projectinput2">Ссылка на новость</label>
			                              <input type="text" id="projectinput2" class="form-control" placeholder="vk.com/post_id"
			                              name="n_url">
			                            </div>
			                          </div>
			                          <div class="col-lg-12">
			                          	<div class="form-group">
				                          <label for="projectinput8">Небольшое описание</label>
				                          <textarea id="projectinput8" rows="5" class="form-control" name="n_text" placeholder="Добавили работу..."></textarea>
				                        </div>
			                          </div>
			                        
			                       	</div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="action" value="create_news">	
                                  <button type="submit" class="btn btn-outline-primary">Создать</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    
                  </div>
                </div>
                
                </div>
              </div>
            </div>
          
          
        </div>

      </div>
    </div>
  </div>
  
  <footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <?php echo $ucp_settings['s_title']?>, All rights reserved. </span>
      
    </p>
  </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="/public/main/js/form.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

  

  <script src="/public/admin/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/vendors/js/extensions/jquery.knob.min.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="/public/admin/app-assets/vendors/js/charts/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/vendors/js/charts/echarts/echarts.js" type="text/javascript"></script>

  <script src="/public/admin/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/js/scripts/customizer.js" type="text/javascript"></script>

  <script src="/public/admin/app-assets/js/scripts/pages/chat-application.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/js/scripts/pages/dashboard-fitness.js" type="text/javascript"></script>
  <script src="/public/admin/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
</body>
</html> 