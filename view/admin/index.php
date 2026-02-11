
<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Главная - Admin - <?php echo $ucp_settings['s_title']?></title>
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
                  <h4 class="card-title" id="basic-layout-tooltip">Настройки UCP</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    
                    <form class="form" method="POST" action="/engine/obr/admin.php">
                      <div class="form-body">
                        <div class="form-group">
                          <label for="issueinput1">Название проекта</label>
                          <input type="text" id="issueinput1" class="form-control" value="<?php echo $ucp_settings['s_title']?>"
                          name="s_title">
                        </div>
                        <div class="form-group">
                          <label for="issueinput2">URL Иконки сайта</label>
                          <input type="text" id="issueinput2" class="form-control" value="<?php echo $ucp_settings['s_favicon']?>"
                          name="s_favicon" >
                        </div>
                        <div class="form-group">
                          <label for="issueinput2">URL Логотипа сайта</label>
                          <input type="text" id="issueinput2" class="form-control" value="<?php echo $ucp_settings['s_logo']?>"
                          name="s_logo" >
                        </div>
                        <div class="form-group">
                          <label for="issueinput6">Шифрование пароля MD5</label>
                          <select id="issueinput6" name="s_md5" class="form-control">
                            <option value='<?php echo $ucp_settings['s_md5']?>'>Сейчас: <?php if($ucp_settings['s_md5']) echo "Включено"; else echo "Отключено";?></option>
                            <?php if($ucp_settings['s_md5']) echo "<option value='0'>Отключить</option>"; else echo "<option value='1'>Включить</option>";?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="issueinput2">Цена рулетки</label>
                          <input type="number" id="issueinput2" class="form-control" value="<?php echo $ucp_settings['s_donate_cost']?>"
                          name="s_donate_cost" >
                        </div>
                        <input type="hidden" name="action" value="save_settings_ucp">
                        
                       
                      </div>
                      <div class="form-actions">
                        
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-check-square-o"></i> Сохранить
                        </button>
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