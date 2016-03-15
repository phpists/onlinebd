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
  <div class="center-block top_info">
    <div class="text-right">
    <div>
      <h2 class="pull-left">Логотип</h2>
    </div>
      <span>Унифицированная форма № МХ-3 Утверждена<br> постановлением Госкомстата <br>России от 09.08.99 № 66</span>
    </div>
      
    <br>
    <div class="big_left_block">
      <div class="bottom_line_2">ООО "Трилон М"</div>
      <div class="text-center small">
          организация-хранитель, адрес, телефон, факс
      </div>
      <div class="bottom_line_2">&nbsp; </div>
      <div class="text-center small">
          структурное  подразделение
      </div>
      <div class="bottom_line_2"><? echo $header->nazva ?> </div>
      <div class="text-center small">
          поклажедатель  (наименование, адрес, телефон, факс,
      </div>
      <div class="bottom_line_2"><? echo $header->fio ?></div>
      <div class="text-center small">
         фамилия, имя, отчество
      </div>
    </div>
    <div class="text-center block_2">
      <table >
        <tr>
          <td></td>
          <td class="border" width="110px">Код</td>
        </tr>
        <tr>
          <td width="110px">Форма по ОКУД</td>
          <td class="border">0335003</td>
        </tr>
        <tr>
          <td>по  ОКПО</td>
          <td class="border">54364253</td>
        </tr>
        <tr>
          <td></td>
          <td class="border"> <br><br> </td>
        </tr>
        <tr>
          <td>Вид деятельности по ОКДП</td>
          <td class="border"></td>
        </tr>
        <tr>
          <td></td>
          <td class="border">54364253</td>
        </tr>
        <tr>
          <td></td>
          <td class="border"> <br><br> </td>
        </tr>
        <tr>
          <td  class="border">номер</td>
          <td class="border"> <? echo $header->nomer_dogovora ?> </td>
        </tr>
         <tr>
          <td class="border">дата</td>
          <td class="border"> <? echo $header->date_c ?> </td>
        </tr>
         <tr>
          <td>Вид операции</td>
          <td class="border">  </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-offset-5 col-xs-5"> 
      <table class="table table-bordered small_table">
        <tr>
          <td><center>Номер документа</center></td>
          <td><center>Дата составления</center></td>
        </tr>
         <tr>
          <td><center>1</center></td>
          <td><center><? echo substr($header->date_otgruzki, 0, 10) ?></center></td>
        </tr>
      </table>
    </div>
  </div>

<h4 class="text-center"> АКТ <br>О ПРИЕМЕ - ПЕРЕДАЧЕ  ТОВАРНО - МАТЕРИАЛЬНЫХ <br> ЦЕННОСТЕЙНА <br> ХРАНЕНИЕ</h4>
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
    <table class="table table-bordered">
    <thead>
      <tr>
        <th rowspan="2">№ <br>п/п</th>
        <th colspan="2">Товарно - материальны е ценности</th>
        <th rowspan="2">Хар<br>актери<br>стика</th>
        <th colspan="2">Единица измерения</th>
        <th rowspan="2">Количе<br>ство (масса)</th>
        
        <th colspan="2">Оценка</th>
      </tr>
      <tr>
        <th>наименование, вид упаковки</th>
        <th>артикул</th>
        <th>наименование</th>
        <th>код по ОКЕИ</th>
        <th>Цена, руб. коп</th>
        <th>Стоимость, руб. коп</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><center>1</center></td>
        <td><center>2</center></td>
        <td><center>3</center></td>
        <td><center>4</center></td>
        <td><center>5</center></td>
        <td><center>6</center></td>
        <td><center>7</center></td>
        <td><center>8</center></td>
        <td><center>9</center></td>
      </tr>
<?
$a=1;
foreach ($main->result() as $row) {
    echo '
      <tr>
        <td>'.$a++.'</td>
        <td>'.$row->nazva.'</td>
        <td>'.$row->artikl.'</td>
        <td>'.$row->edinica_izm.'</td>
        <td></td>
        <td></td>
        <td>'.$row->kilk.'</td>
        <td></td>
        <td></td>
      </tr>';
}
?>
      <tr>
        <td colspan="4" class="border_none" ></td>
        <td colspan="2">Всего по акту</td>
        <td></td>
        <td>x</td>
        <td></td>
        
      </tr>
    </tbody>
  </table>
</div>
<div class="col-xs-12">
  <p>Условия хранения</p>

  <div class="border_bottom"><? echo $header->comment ?><br></div>
  <div class="border_bottom"><br></div>
  <div class="border_bottom"><br></div>
</div>
<div class="col-xs-12">
<br>
  <p>Особые отметки</p>
  <div class="border_bottom"><br></div>
  <div class="border_bottom"><br></div>
  <div class="border_bottom"><br></div>
</div>
<br>
<p class="text-center">Расписка  в  получении  товарно - материальных ценностей</p>
  <div class="row">
    <div class="col-xs-3 text-center">
      Получил
    </div>
    <div class="col-xs-3 text-center">
      <div class="border_bottom"><br></div>
      <p class="title">должность</p>
    </div>
    <div class="col-xs-3 text-center">
      <div class="border_bottom"><br></div>
      <p class="title">подпись</p>
    </div>
    <div class="col-xs-3 text-center">
      <div class="border_bottom"><br></div>
      <p class="title">расшифровка подписи</p>
    </div>

  </div>
    <div class="row">
    <div class="col-xs-3 text-center">
      Сдал
    </div>
    <div class="col-xs-3 text-center">
      <div class="border_bottom"><br></div>
      <p class="title">должность</p>
    </div>
    <div class="col-xs-3 text-center">
      <div class="border_bottom"><br></div>
      <p class="title">подпись</p>
    </div>
    <div class="col-xs-3 text-center">
      <div class="border_bottom"><br></div>
      <p class="title">расшифровка подписи</p>
    </div>

  </div>
</div>
<br><br>



</body>
</html>