<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Document</title>

    <link rel="stylesheet" href="<? echo base_url() ?>application/views/print_templates/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<? echo base_url() ?>application/views/print_templates/css/style.css"/>

</head>
<body>

<div class="container">
 <div style="min-height: 800px">

<h4 class="text-center"> TMЦ ПРОЕКТA "<? echo $progect->nazva  ?>" <br></h4>
<h6 class="text-center">Акт составлен о том, что приняты на хранение</h6>
<div class="before_table">
<div class="row">
 <div class="col-xs-5 text-center">
   <div class="border_bottom"> &nbsp;</div>
   <p class="title">наименование, номер места хранения</p>
   <p>следующие  товарно - материальные  ценности:</p>
 </div>
 <div class="col-xs-3 text-center">
   <div class="border_bottom">Без срока <span class="pull-right">дней</span></div>
   <p class="title">срок хранения</p>
  
 </div>
 </div>
</div>
<div style="padding: 0 20px">
    <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>№ <br>п/п</th>
        <th>Название</th>
        <th>Количество</th>
        <th>Единица измерения</th>
        <th>Артикул</th>
      </tr>
    </thead>
    <tbody>
  <?php 
  $a=1;
  foreach ($main->result() as $row) { 
    echo '
                <tr>
                  <td><center>'.$a++.'</center></td>
                  <td>'.$row->nazva.'</td>
                  <td><center>'.$row->kilk.'</center></td>
                  <td><center>'.$row->edinica_izm.'</center></td>
                  <td><center>'.$row->artikl.'</center></td>
                </tr>';
  }
  ?>
    </tbody>
  </table>
</div>

  </div>
</div>
<br><br>



</body>
</html>