<?php $this->load->view('header'); ?>

<!-- datetimepicker -->
<script src="<? echo base_url() ?>application/views/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap-datetimepicker.css" />
<!-- datetimepicker end -->
<!-- jQuery Masked Input Plugin -->
<script src="<? echo base_url() ?>application/views/js/jquery.maskedinput.js"></script>

<!-- jQuery Autocomplete -->
<script src="<? echo base_url() ?>application/views/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/js/autocomplete/jquery-ui.min.css" />

<script type="text/javascript">

$(document).ready(function(){

	$("input[name=tel]").mask("(999) 999-99-99");

	$('.datepicker').datetimepicker({
		minDate:"<? echo date("Y-m-d") ?>",
		format: 'YYYY-MM-DD HH:mm:ss',
		locale: 'ru'
	});

	$(document).on('click', '.del_item', function(event){
		$(this).parent().parent().parent().remove();
		return false;
	});

	$("#radios-0").click(function(event) {
		$("[name=progect_id]").show();
		$("[name=nazva_progect]").hide();
	});

	$("#radios-1").click(function(event) {
		$("[name=progect_id]").hide();
		$("[name=nazva_progect]").show();
	});


	$('#create').click(function(){
		if($("[name=progect_id]").val()!='' || $("[name=nazva_progect]").val()!='') {
			if($("[name=fio]").val()!='') {
				$.post("/ajax/create_zayavka_prihod", $("#form_add_zayavka").serialize()).done(function(data) {
					//alert(data);
					alert("Заявка добавлена!");
					window.location = "/main/zayavki";
				});
			} else {
				$("[name=fio]").css('border-color', '#d9534f');
			}
		} else {
			$('#mess_error').show("slow").delay(2000).fadeOut();
		}
	});


// спрацьовує перший раз
	$(".nazva_tmc").autocomplete({
		source: '/ajax/ajax_autocomplete_tmc',
		//minLength: 2,
		select: function(event, ui) {
			$(this).val(ui.item.value).attr('readonly', 'true');
			$(this).next().val(ui.item.id);
			$(this).parent().next().children('input').attr('readonly', 'true');
		},
		open: function(event, ui) {
			$(".ui-autocomplete").css("z-index", 1000);
		}
	});



});

var i=1;

function add_tmc(){
	last_row = $("#example1").find('tr:last').find('input:first');
	if(last_row.val()=='') {
		last_row.css('border-color', '#d9534f');
	} else {
		i++;
		$("#example1 > tbody").append('<tr><td><center>'+i+'</center></td><td><input class="form-control nazva_tmc" type="text" name="nazva[]"><input type="hidden" name="id_tmc[]"></td><td><input class="form-control" type="text" name="opus[]"></td><td><select name="edinica_izm[]" class="form-control"><option value="упаковка">упаковка</option><option value="шт">шт</option><option value="ед">ед.</option><option value="коробка">коробка</option><option value="паллет">паллет</option></select></td><td><input class="form-control" type="number" min="1" value="1" name="kilk[]"></td><td><center><a href="#" class="del_item"><img src="<? echo base_url() ?>application/views/img/validno.png"></a></center></td></tr>');
	
		$(".nazva_tmc").autocomplete({
			source: '/ajax/ajax_autocomplete_tmc',
			select: function(event, ui) {
				$(this).val(ui.item.value).attr('readonly', 'true');
				$(this).next().val(ui.item.id);
				$(this).parent().next().children('input').attr('readonly', 'true');
			},
			open: function(event, ui) {
				$(".ui-autocomplete").css("z-index", 1000);
			}
		});

	}
	return false;
}


</script>

<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><? echo $title ?></div>
				<div class="panel-body">
	
<form class="form-horizontal" id="form_add_zayavka" method="POST" action="/main/test">
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
	  <label class="col-md-4 control-label">ФИО кто привезет:</label>  
	  <div class="col-md-4">
	  <input name="fio" class="form-control input-md" type="text">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Номер телефона:</label>  
		<div class="col-md-4">
			<div class="input-group">
				<input name="tel" class="form-control input-md" type="text" value="<? echo @$main->tel ?>">
				<span class="input-group-addon"><span class="glyphicon glyphicon-phone"> </span></span>
			</div>
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
	  <div class="col-md-4 control-label">
		<label for="radios-0"><input name="radios" id="radios-0" value="1" checked="checked" type="radio"> Существующий проект</label>&nbsp;&nbsp;&nbsp;
		<label for="radios-1"><input name="radios" id="radios-1" value="2" type="radio"> Новый проект</label>
	  </div>  
	  <div class="col-md-4">
		<select name="progect_id" class="form-control">
			<option value="">Выберите проект</option>
			<?php select_sel($progects); ?>
		</select>
		 <input name="nazva_progect" class="form-control input-md" type="text" style="display:none" placeholder="Название">
	  </div>
	</div>

	<table class="table table-bordered" id="example1">
		<thead>
			<tr>
				<th><center>#</center></th>
				<th><center>Название</center></th>
				<th><center>Описание</center></th>
				<th><center>Един. измер</center></th>
				<th><center>Количество</center></th>
				<th><center>#</center></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><center>1</center></td>
				<td><input class="form-control nazva_tmc" type="text" name="nazva[]"><input type="hidden" name="id_tmc[]"></td>
				<td><input class="form-control" type="text" name="opus[]"></td>
				<td>
					<select name="edinica_izm[]" class="form-control">
						<option value="упаковка">упаковка</option>
						<option value="шт">шт</option>
						<option value="ед">ед.</option>
						<option value="коробка">коробка</option>
						<option value="паллет">паллет</option>
					</select>
				</td>
				<td><input class="form-control" type="number" name="kilk[]" min="1" value="1"></td>
				<td><center><a href="#" class="del_item"><img src="<? echo base_url() ?>application/views/img/validno.png"></a></center></td>
			</tr>
		</tbody>
	</table>
<!-- <input type="submit" value="ok"> -->
</fieldset>
</form>	
	
	<a class="btn btn-success" href="#" id="add_tmc" onclick="add_tmc()"><i class="glyphicon glyphicon-plus"></i> Добавить ТМЦ</a>


	<div class="row">
		<div class="col-md-12">
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="button1id"> </label>
			  <div class="col-md-4">
				<a href="#" class="btn btn-success" id="create"><i class="glyphicon glyphicon-ok"></i> Создать</a>
				<a href="/main/zayavki" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>		
			  </div>
			</div>	
		</div>
	</div>

	<div class="col-md-12">
		<div class="row" style="padding-top:10px; display:none;" id="mess_error">
			<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Выберете проект или введите название!</div>
		</div>
	</div>

							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>