<?php $this->load->view('header'); ?>

<!-- datetimepicker -->
<script src="<? echo base_url() ?>application/views/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap-datetimepicker.css" />
<!-- datetimepicker end -->
<!-- jQuery Masked Input Plugin -->
<script src="<? echo base_url() ?>application/views/js/jquery.maskedinput.js"></script>

<script type="text/javascript" src="<? echo base_url() ?>application/views/bootstrap-3.3.5/bootstrap-progressbar.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("input[name=tel]").mask("(999) 999-99-99");

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		locale: 'ru'
	});


	$(document).on('click', 'input[type="checkbox"]', function(event){
		if (this.checked) {
			$(this).parent().parent().parent().css('background-color', '#d9534f');
		} else {
			$(this).parent().parent().parent().css('background-color', '#fff');
		}	
	});

	$('#create').click(function(){
		$.post("/ajax/update_zayavka", $("#form_add_zayavka").serialize()).done(function(data) {
			alert("Сохранено");
			window.location = "/main/zayavki";
		});
	});

	$('.del_tmc').click(function() {
		if(confirm('Удалить этот ТМЦ?')) {
			id = $(this).data('id');
			//$.get("/ajax/del_tmc/"+id);
			$(this).parent().parent().parent().fadeOut('slow');
		}
		return false;
	});

	$('[name=count_product]').click(function(){
			alert("Сохранено");		

	});
	


	var i = 0;
	$('#otgruzit').click(function() {
    $('.progress .progress-bar').progressbar({display_text: 'fill'});







		/*var progress = setInterval(function () {
		var $bar = $('.progress-bar');

		    if ($bar.width() >= 400) {
		        clearInterval(progress);
		        $('.progress').removeClass('active');
		    } else {
		        $bar.width($bar.width() + 40);
		    }
		    $bar.text($bar.width() / 4 + "%");
		}, 800);*/



		/*i++;
		if(i == 1) {
			$(".progress-bar").css("width", "100%").text("100%");
			$(".progress-bar").css("transition", " width .6s ease");
			//$(".progress-bar").css("animation", "progress-bar-stripes 2s linear infinite");
		} else {
			$(".progress-bar").css("transition", "none");
			$(".progress-bar").css("animation", "none");
			$(".progress-bar").css("width", "0%").text("0%");	
			setTimeout (function(){
				$(".progress-bar").css("width", "100%").text("100%");
				$(".progress-bar").css("transition", " width .6s ease");
				//$(".progress-bar").css("animation", "progress-bar-stripes 2s linear infinite");
			}, 500);
		}*/
		/*setTimeout (function(){
			$.post("/ajax/ajax_search_master", $("#srch").serialize()).done(function(data) {
				$("#example > tbody").html(data);
			});
		}, 1000);*/
		return false;
	});



});
</script>

<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><? echo $title ?></div>
				<div class="panel-body">
	
<form class="form-horizontal" id="form_add_zayavka">
<fieldset>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Дата отгрузки / время отгрузки:</label>  
	  <div class="col-md-4">
	  <input name="date_otgruzki" class="form-control input-md datepicker" type="text" value="<? echo @$main->nazva ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">ФИО кто забирает:</label>  
	  <div class="col-md-4">
	  <input name="fio" class="form-control input-md" type="text" value="<? echo @$main->fio ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Номер телефона:</label>  
	  <div class="col-md-4">
	  <input name="tel" class="form-control input-md" type="text" value="<? echo @$main->tel ?>">
	  </div>
	</div>	

	<!-- Text input
	<div class="form-group">
	  <label class="col-md-4 control-label">Дата забора:</label>  
	  <div class="col-md-4">
	  <input name="sroki" class="form-control input-md" type="text" value="">
	  </div>
	</div>-->	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">№авто:</label>  
	  <div class="col-md-4">
	  <input name="nom_avto" class="form-control input-md" type="text" value="<? echo @$main->nom_avto ?>">
	  </div>
	</div>	

	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-4 control-label">Комментарий:</label>
	  <div class="col-md-4">
		<textarea rows="3" class="form-control" name="comment"><? echo @$main->comment ?></textarea>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Проект:</label>  
	  <div class="col-md-4">
		 <input class="form-control input-md" type="text" value="<? echo @$main->nazva_progect ?>" readonly>
	  </div>
	</div>

<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Статус:</label>  
	  <div class="col-md-4">
		<select name="status" class="form-control">
<? if($main->type == 0) { ?>
			<option value="1" <? if($main->status==1) echo "selected" ?>>В обработке</option>
			<option value="2" <? if($main->status==2) echo "selected" ?>>В ожидании</option>
			<option value="0" <? if($main->status==0) echo "selected" ?>>Отгружено</option>
<? } if($main->type == 1) { ?>
			<option value="1" <? if($main->status==1) echo "selected" ?>>В обработке</option>
			<option value="0" <? if($main->status==0) echo "selected" ?>>Прийнято</option>
<? } ?>
		</select>
	  </div>
	</div>


<? if($main->type == 0) { ?>
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th><center>#</center></th>
					<th><center>Название</center></th>
					<th><center>Артикул</center></th>
					<th><center>Един. измер.</center></th>
					<th><center>Остаток</center></th>
					<th><center>Количество</center></th>
					<th><center>#</center></th>
				</tr>
			</thead>
			<tbody>
	<?php 
	$a=1;
		foreach ($products->result() as $row) { 
			echo '
			<tr>
				<td><center>'.$a++.'</center></td>
				<td>'.$row->nazva.'</td>
				<td><center>'.$row->artikl.'</center></td>
				<td><center>'.$row->edinica_izm.'</center></td>
				<td><center>'.$row->kilk.'</center></td>
				<td><center>
					<div class="input-group col-md-4"><input type="number" name="count_product" class="form-control" min="1" max="'.$row->kilk.'" value="'.$row->cnt.'">
					<span class="input-group-btn">
						<a class="btn btn-default"><span class="glyphicon glyphicon-floppy-saved"></span></a>
					</span></div>
				</center></td>
				<td><center><a href="#" title="Удалить" class="del_tmc" data-id="'.$row->id.'"><img src="'.base_url().'application/views/img/validno.png"></a></center></td>
			</tr>';
		}
	?>

			</tbody>
		</table>


<? } if($main->type == 1) { ?>
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th><center>#</center></th>
					<th><center>Название</center></th>
					<th><center>Артикул</center></th>
					<th><center>Един. измер.</center></th>
					<th><center>Количество</center></th>
					<th><center>#</center></th>
				</tr>
			</thead>
			<tbody>
	<?php 
	$a=1;
		foreach ($products->result() as $row) { 
			echo '
			<tr>
				<td><center>'.$a++.'</center></td>
				<td>'.$row->nazva.'</td>
				<td><center>'.$row->artikl.'</center></td>
				<td><center>'.$row->edinica_izm.'</center></td>
				<td><center>'.$row->kilk.'</center></td>
				<td><center><a href="#" title="Удалить" class="del_tmc" data-id="'.$row->id.'"><img src="'.base_url().'application/views/img/validno.png"></a></center></td>
			</tr>';
		}
	?>

			</tbody>
		</table>
<? } ?>


<input type="hidden" name="id" value="<? echo $main->id ?>">
</fieldset>
</form>	
	


	<div class="row">
		<div class="col-md-12">
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="button1id"> </label>
			  <div class="col-md-5">
				<a href="#" class="btn btn-success" id="create"><i class="glyphicon glyphicon-ok"></i> Сохранить</a>
				<a href="/main/zayavki" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>		
				<a href="/php_excel/export.php?id=<? echo $main->id ?>&type=<? echo $main->type ?>" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Печать</a>
				<a href="#" class="btn btn-warning" id="otgruzit"><i class="glyphicon glyphicon-refresh"></i> Отгрузить</a>	
			  </div>
			</div>	
		</div>
	</div>

	<div class="col-md-12">
		<div class="row" style="padding-top:10px; display:none;" id="mess_error">
			<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Выберете хотя б один товар!</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="row" style="padding-top:10px;">
			<!-- <div class="my_progress">
					<div class="progress progress-striped active">
					  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="myBar">
					    <span class="sr-only">0% Complete</span>
					  </div>
					</div>
				</div> -->	



    <!-- <div class="progress progress-striped active">
        <div class="progress-bar" style="width: 0%;"></div>
    </div> -->



	<div class="progress">
	    <div class="progress-bar progress-bar-danger six-sec-ease-in-out" role="progressbar" data-transitiongoal="100"></div>
	</div>




		</div>
	</div>

							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>