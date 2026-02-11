
<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Рулетка - Admin - <?php echo $ucp_settings['s_title']?></title>
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
                  <h4 class="card-title" id="basic-layout-tooltip">Настройка рулетки</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  
                </div>
                <div class="card-content">
                  <div class="card-body">
                    
                    <ul class="nav nav-tabs nav-underline no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab31" data-toggle="tab" aria-controls="item"
                        href="#item" aria-expanded="true">Работа с предметами</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab32" data-toggle="tab" aria-controls="tab32" href="#category"
                        aria-expanded="false">Работа с категориями рулетки</a>
                      </li>
                      
                    </ul>
                    <div class="tab-content pt-1">
                      <div role="tabpanel" class="tab-pane active" id="item" aria-expanded="true" aria-labelledby="base-tab31">
                        <button type="button" class="btn btn-success block btn-lg" data-toggle="modal"
                          data-target="#create_item">
                           Добавить элемент в рулетку
                          </button>
                          <br><br><br><br>

                          <div class="card-content collapse show ">
                <h4 class="card-title" id="basic-layout-tooltip">Список элементов рулетки</h4>
                <div class="table-responsive">
                  <table class="table table-basic mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Картинка</th>
                        <th>Действия</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
        
            


              $statement = $db->prepare("SELECT * FROM `ucp_category_roulette`");




              $statement->execute ();

              if($statement->rowCount())
              {

               while($category=$statement->fetch()) {


               // $category .= "<option value='{$category['id']}'>{$category['name']}</option>"
                $categorys .= "<option value='{$category['id']}'>{$category['name']}</option>"; 

              } }

              $statement = $db->prepare("SELECT * FROM `ucp_item_roulette`");




              $statement->execute ();

              if($statement->rowCount())
              {

               while($roulette=$statement->fetch()) { 



                  

                  echo "
                  <div class='modal fade text-left' id='edit-{$roulette['id']}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel1'
                          aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <form method='POST' action='/engine/obr/admin.php'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h4 class='modal-title' id='myModalLabel1'>Редактирование предмета: <b>{$roulette['i_name']}</b></h4>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body'>
                                  <div class='row'>
                                  <div class='col-md-12'>
                                    <div class='form-group'>
                                      <label for='projectinput1'>Название предмета</label>
                                      <input type='text' id='projectinput1' class='form-control' value='{$roulette['i_name']}'
                                      name='i_name'>
                                    </div>
                                  </div>
                                  <div class='col-md-12'>
                                    <div class='form-group'>
                                      <label for='projectinput2'>Картинка</label>
                                      <input type='text' id='projectinput2' class='form-control' value='{$roulette['i_images']}'
                                      name='i_images'>
                                    </div>
                                  </div>
                                  <div class='col-md-12'>
                                    <div class='form-group'>
                                      <label for='projectinput5'>Категория</label>
                                      <select id='projectinput5' name='i_category' class='form-control'>
                                        
                                        {$categorys}
                                        
                                     
                                      </select>
                                    </div>
                                  </div>
                                  <div class='col-md-12'>
                                    <div class='form-group'>
                                      <label for='projectinput2'>Вероятность</label>
                                      <input type='text' id='projectinput2' class='form-control' value='{$roulette['i_change']}'
                                      name='i_change'>
                                    </div><br>
                                    <p>Если вы добавляете определенный предмет, то в начало и в конец пишите одно и тоже чисто<br>
                                    Пример: Скины или авто (562), а если донат или деньги (1000, 100000)</p>
                                  </div>
                                  
                                  <div class='col-md-6'>
                                    <div class='form-group'>
                                      <label for='projectinput2'>Начала рандома</label>
                                      <input type='text' id='projectinput2' class='form-control' value='{$roulette['i_start_rand']}'
                                      name='i_start_rand'>
                                    </div>
                                  </div>
                                  <div class='col-md-6'>
                                    <div class='form-group'>
                                      <label for='projectinput2'>Конец рандома</label>
                                      <input type='text' id='projectinput2' class='form-control' value='{$roulette['i_end_rand']}'
                                      name='i_end_rand'>
                                    </div>
                                  </div>
                                </div>
                                </div>
                                <div class='modal-footer'>
                                  <input type='hidden' name='action' value='save_item_roulette'>
                                  <input type='hidden' name='id' value='{$roulette['id']}'>
                                  <button type='button' class='btn grey btn-outline-secondary' data-dismiss='modal'>Отмена</button>
                                  <button type='submit' class='btn btn-success'>Сохранить</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>

                  ";

                    $button_delete = '<button type="button" class="btn btn-danger" onclick="DeleteRouletteItem('.$roulette['id'].');">Удалить</button>';
                echo "<tr>
                        <th scope='row'>{$roulette['id']}</th>
                        <td>{$roulette['i_name']}</td>
                        <td><img class='media-object rounded-circle' width='40' src='{$roulette['i_images']}'></td>
                        <td><button type='button' class='btn btn-success ' data-toggle='modal'
                          data-target='#edit-{$roulette['id']}'>Редактировать</button>
                        {$button_delete}</td>
                      </tr>"; } }?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
                          <!-- Modal -->
                          <div class="modal fade text-left" id="create_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                          aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="POST" action="/engine/obr/admin.php">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel1">Создание предмета для рулетки</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="projectinput1">Название предмета</label>
                                      <input type="text" id="projectinput1" class="form-control" placeholder="Infernus"
                                      name="i_name">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="projectinput2">Картинка</label>
                                      <input type="text" id="projectinput2" class="form-control" placeholder="Ссылка на картинку"
                                      name="i_images">
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="projectinput5">Категория</label>
                                      <select id="projectinput5" name="i_category" class="form-control">
                                        <option value="0" selected="" disabled=""></option>
                                        <?php
        
              global $db;

              $statement = $db->prepare("SELECT * FROM `ucp_category_roulette`");




              $statement->execute ();

              if($statement->rowCount())
              {

               while($category=$statement->fetch()) {



                echo "<option value='{$category['id']}'>{$category['name']}</option>"; 

              } }?>
                                     
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="projectinput2">Вероятность</label>
                                      <input type="text" id="projectinput2" class="form-control" placeholder="От 0 до 100"
                                      name="i_change">
                                    </div><br>
                                    <p>Если вы добавляете определенный предмет, то в начало и в конец пишите одно и тоже чисто<br>
                                    Пример: Скины или авто (562), а если донат или деньги (1000, 100000)</p>
                                  </div>
                                  
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="projectinput2">Начала рандома</label>
                                      <input type="text" id="projectinput2" class="form-control" placeholder="С какого числа будет начинаться рандом"
                                      name="i_start_rand">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="projectinput2">Конец рандома</label>
                                      <input type="text" id="projectinput2" class="form-control" placeholder="До какого числа будет работать рандом"
                                      name="i_end_rand">
                                    </div>
                                  </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="action" value="create_item_roulette">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Отмена</button>
                                  <button type="submit" class="btn btn-success">Создать</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="category" aria-labelledby="base-tab32">
                        <button type="button" class="btn btn-success block btn-lg" data-toggle="modal"
                          data-target="#create_category">
                           Добавить категорию
                          </button>
                          <br><br><br><br>

                          <div class="card-content collapse show ">
                <h4 class="card-title" id="basic-layout-tooltip">Список категорий</h4>
                <div class="table-responsive">
                  <table class="table table-basic mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Категория</th>
                        
                        <th>Действия</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
        
            


              $statement = $db->prepare("SELECT * FROM `ucp_category_roulette`");




              $statement->execute ();

              if($statement->rowCount())
              {

               while($category=$statement->fetch()) { 



                  

                  echo "
                  <div class='modal fade text-left' id='editcategory-{$category['id']}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel1'
                          aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <form method='POST' action='/engine/obr/admin.php'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h4 class='modal-title' id='myModalLabel1'>Редактирование категории: <b>{$category['name']}</b></h4>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body'>
                                  <div class='row'>
                                  <div class='col-md-12'>
                                    <div class='form-group'>
                                      <label for='projectinput1'>Название категории</label>
                                      <input type='text' id='projectinput1' class='form-control' value='{$category['name']}'
                                      name='name'>
                                    </div>
                                  </div>
                                  
                                </div>
                                </div>
                                <div class='modal-footer'>
                                  <input type='hidden' name='action' value='save_category_roulette'>
                                  <input type='hidden' name='id' value='{$category['id']}'>
                                  <button type='button' class='btn grey btn-outline-secondary' data-dismiss='modal'>Отмена</button>
                                  <button type='submit' class='btn btn-success'>Сохранить</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>

                  ";

                    $button_delete = '<button type="button" class="btn btn-danger" onclick="DeleteRouletteCategory('.$category['id'].');">Удалить</button>';
                echo "<tr>
                        <th scope='row'>{$category['id']}</th>
                        <td>{$category['name']}</td>
                   
                        <td><button type='button' class='btn btn-success ' data-toggle='modal'
                          data-target='#editcategory-{$category['id']}'>Редактировать</button>
                        {$button_delete}</td>
                      </tr>"; } }?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
                          <!-- Modal -->
                          <div class='modal fade text-left' id='create_category' tabindex='-1' role='dialog' aria-labelledby='myModalLabel1'
                          aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <form method='POST' action='/engine/obr/admin.php'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h4 class='modal-title' id='myModalLabel1'>Создание категории</h4>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body'>
                                  <div class='row'>
                                  <div class='col-md-12'>
                                    <div class='form-group'>
                                      <label for='projectinput1'>Название категории</label>
                                      <input type='text' id='projectinput1' class='form-control' placeholder="Авто" 
                                      name='category_name'>
                                    </div>
                                  </div>
                                  
                                </div>
                                </div>
                                <div class='modal-footer'>
                                  <input type='hidden' name='action' value='create_category_roulette'>
                                  <button type='button' class='btn grey btn-outline-secondary' data-dismiss='modal'>Отмена</button>
                                  <button type='submit' class='btn btn-success'>Создать</button>
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