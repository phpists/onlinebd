<?php $this->load->view('header'); ?>

<!-- datetimepicker -->
<script src="<? echo base_url() ?>application/views/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap-datetimepicker.css" />
<!-- datetimepicker end -->
<!-- jQuery Masked Input Plugin -->
<script src="<? echo base_url() ?>application/views/js/jquery.maskedinput.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("input[name=tel]").mask("(999) 999-99-99");

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		locale: 'ru'
	});

	$('[name=progect_id]').change(function(){
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_get_progect_products",
			data: {
				'id': $(this).val()
			},
			dataType: "html",
			success: function(msg){
				$("#example1 > tbody").empty();
				$("#example1 > tbody").append(msg);
			}
		});
	});

	$(document).on('click', 'input[type="checkbox"]', function(event){
		if (this.checked) {
			$(this).parent().parent().parent().css('background-color', '#d9534f');
		} else {
			$(this).parent().parent().parent().css('background-color', '#fff');
		}	
	});

	// $(document).on('click', '[type="number"]', function(event){
	// //$('[name=count]').bind('change click keyup', function(){
	// 	$(this).parent().parent().prev().css('background-color', '#d9534f');
	// 	var oststok = parseInt($(this).parent().parent().prev().children().text());
	// 	//alert(oststok);
	// 	if($(this).val() > oststok)	{
	// 		$(this).val(oststok);
	// 	}
	// });

	$('.check-all').click(function(){
		if($(this).is(':checked')) {
			$(".sel_ch").prop('checked', true);
			$("#example1 > tbody").css('background-color', '#d9534f');
		} else {
			$(".sel_ch").prop('checked', false); 
			$("#example1 > tbody").css('background-color', '#fff');
		}
	});


	$('#create').click(function(){
		if($("[name=progect_id]").val()!='') {
			var selected = [];
			$('.sel_ch').each(function(index, value) {
				if (this.checked) {
					selected.push($(this).attr('name'));
				}
			});
			if(selected.length > 0) {
				$.post("/ajax/create_zayavka_rashod", $("#form_add_zayavka").serialize()).done(function(data) {
					alert("Заявка добавлена!");
					window.location = "/main/zayavki";
				});
			} else {
				$('#mess_error').show("slow").delay(2000).fadeOut();
				return false;
			}
		}
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
	  <label class="col-md-4 control-label">Дата отгрузки/ время отгрузки:</label>  
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
	  <label class="col-md-4 control-label">Проект:</label>  
	  <div class="col-md-4">
		<select name="progect_id" class="form-control">
			<option value="">Выберите проект</option>
			<?php select_sel($progects); ?>
		</select>
	  </div>
	</div>


		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th><center>#</center></th>
					<th><center>Название</center></th>
					<th><center>Артикул</center></th>
					<th><center>Един. измер</center></th>
					<th><center>Остаток</center></th>
					<th><center>С заявок</center></th>
					<th><center>Количество</center></th>
					<th><center><input class="check-all" type="checkbox" /></center></th>
				</tr>
			</thead>
			<tbody>


			</tbody>
		</table>

</fieldset>
</form>	
	


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
			<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Выберете хотя б один товар!</div>
		</div>
	</div>

							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>