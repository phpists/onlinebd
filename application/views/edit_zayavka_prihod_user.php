<?php $this->load->view('header'); ?>

<!-- datetimepicker -->
<script src="<? echo base_url() ?>application/views/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap-datetimepicker.css" />
<!-- datetimepicker end -->
<!-- jQuery Masked Input Plugin -->
<script src="<? echo base_url() ?>application/views/js/jquery.maskedinput.js"></script>
<!-- bootstrap-progressbar -->
<script type="text/javascript" src="<? echo base_url() ?>application/views/bootstrap-3.3.5/bootstrap-progressbar.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("input[name=tel]").mask("(999) 999-99-99");

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		locale: 'ru'
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
			$.get("/ajax/del_tmc_prihod/"+id);
			$(this).parent().parent().parent().fadeOut('slow');
		}
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
	  <input name="date_otgruzki" class="form-control input-md datepicker" type="text" value="<? echo $main->date_otgruzki ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">ФИО кто забирает:</label>  
	  <div class="col-md-4">
	  <input name="fio" class="form-control input-md" type="text" value="<? echo $main->fio ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Номер телефона:</label>  
	  <div class="col-md-4">
	  <input name="tel" class="form-control input-md" type="text" value="<? echo $main->tel ?>">
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
		<textarea rows="3" class="form-control" name="comment"><? echo $main->comment ?></textarea>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Проект:</label>  
	  <div class="col-md-4">
		 <input class="form-control input-md" type="text" value="<? echo $main->nazva_progect ?>" readonly>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Статус:</label>
	  <label class="col-md-4" style="margin-top:8px">
		<? if($main->status==1) echo "В обработке" ?>
		<? if($main->status==0) echo "Прийнято" ?>
	  </label>
	</div>


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
				<td><center>'.(($main->status==1)?'<a href="#" title="Удалить" class="del_tmc" data-id="'.$row->id.'"><img src="'.base_url().'application/views/img/validno.png"></a>':'').'</center></td>
			</tr>';
		}
	?>

			</tbody>
		</table>


<input type="hidden" name="id" value="<? echo $main->id ?>">
</fieldset>
</form>	
	


	<div class="row">
		<div class="col-md-12">
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="button1id"> </label>
			  <div class="col-md-5">
			<? if($main->status==0) { ?>	
				<a href="/main/zayavki" class="btn btn-danger">Вернутся к списку заявок</a>
				<a href="/php_excel/export.php?id=<? echo $main->id ?>&type=1" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Печать</a>
			<? } else { ?>
				<a href="#" class="btn btn-success" id="create"><i class="glyphicon glyphicon-ok"></i> Сохранить</a>
				<a href="/main/zayavki" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>		
				<a href="/php_excel/export.php?id=<? echo $main->id ?>&type=1" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Печать</a>
			<? } ?>
			  </div>
			</div>	
		</div>
	</div>



	<div class="col-md-12">
<? if($main->status!=0) { ?>
		<div class="row" style="padding-top:10px;">
			<div class="progress progress-striped">
				<div class="progress-bar progress-bar-success six-sec-ease-in-out" role="progressbar" data-transitiongoal="100"></div>
			</div>
		</div>

		<div class="row" style="display:none;" id="mess_error">
			<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>ТМЦ отгружен, заявка принята!</div>
		</div>
<? } if($main->status==0) { ?>
		<div class="row" style="padding-top:10px;">
			<div class="progress progress-striped">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" style="width: 100%;">100%</div>
			</div>
		</div>

		<div class="row">
			<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>ТМЦ отгружен, заявка принята!</div>
		</div>
<? } ?>
	</div>

							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>