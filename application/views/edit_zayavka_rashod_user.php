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
			$.get("/ajax/del_tmc_rashod/"+id);
			$(this).parent().parent().parent().fadeOut('slow');
		}
		return false;
	});

	$('.upd_cnt').click(function() {
		id = $(this).data('id');
		new_cnt = $(this).parent().parent().children().val();
		$.post( "/ajax/upd_cnt_rashod/", { 'id': id, 'cnt': new_cnt } );
		$(this).css('background-color', '#5cb85c');
	});


	$('[name=count_product]').bind('change click keyup', function(){
		var oststok = parseInt($(this).parent().parent().parent().prev().text());
		if($(this).val() > oststok)	{
			$(this).val(oststok);
		}
	});
	
});
</script>

<?
if($main->status == 0 or $main->status == 2) {
	$status_input = 'readonly';
} else {
	$status_input = '';
}
?>

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
	  <input name="date_otgruzki" class="form-control input-md datepicker" type="text" value="<? echo @$main->date_otgruzki ?>" <? echo $status_input ?>>
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">ФИО кто забирает:</label>  
	  <div class="col-md-4">
	  <input name="fio" class="form-control input-md" type="text" value="<? echo @$main->fio ?>" <? echo $status_input ?>>
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Номер телефона:</label>  
	  <div class="col-md-4">
	  <input name="tel" class="form-control input-md" type="text" value="<? echo @$main->tel ?>" <? echo $status_input ?>>
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
	  <input name="nom_avto" class="form-control input-md" type="text" value="<? echo @$main->nom_avto ?>" <? echo $status_input ?>>
	  </div>
	</div>	

	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-4 control-label">Комментарий:</label>
	  <div class="col-md-4">
		<textarea rows="3" class="form-control" name="comment" <? echo $status_input ?>><? echo @$main->comment ?></textarea>
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
	  <label class="col-md-4" style="margin-top:8px">
		<? if($main->status==1) echo "В обработке" ?>
		<? if($main->status==2) echo "В ожидании" ?>
		<? if($main->status==0) echo "Отгружено" ?>
	  </label>
	</div>


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
if($main->status == 1) { // 1 - В обработке 
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
						<a class="btn btn-default upd_cnt" data-id="'.$row->id.'"><span class="glyphicon glyphicon-floppy-saved"></span></a>
					</span></div>
				</center></td>
				<td><center><a href="#" title="Удалить" class="del_tmc" data-id="'.$row->id.'"><img src="'.base_url().'application/views/img/validno.png"></a></center></td>
			</tr>';
		}
}
if($main->status == 0 or $main->status == 2) { // 2 - В ожидании, 0 - Отгружено
		foreach ($products->result() as $row) { 
			echo '
			<tr>
				<td><center>'.$a++.'</center></td>
				<td>'.$row->nazva.'</td>
				<td><center>'.$row->artikl.'</center></td>
				<td><center>'.$row->edinica_izm.'</center></td>
				<td><center>'.$row->kilk.'</center></td>
				<td><center>'.$row->cnt.'</center></td>
				<td><center><img src="'.base_url().'application/views/img/validyes.png"></center></td>
			</tr>';
		}
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
			<? if($main->status == 0 or $main->status == 2) { ?>
				<a href="/main/zayavki" class="btn btn-danger">Вернутся к списку заявок</a>
				<a href="/php_excel/export.php?id=<? echo $main->id ?>&type=0" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Печать</a>
			<? } else { ?>
				<a href="#" class="btn btn-success" id="create"><i class="glyphicon glyphicon-ok"></i> Сохранить</a>
				<a href="/main/zayavki" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>		
				<a href="/php_excel/export.php?id=<? echo $main->id ?>&type=0" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Печать</a>
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