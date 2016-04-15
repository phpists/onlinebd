<?php $this->load->view('header'); ?>

<!-- datetimepicker -->
<script src="<? echo base_url() ?>application/views/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap-datetimepicker.css" />
<!-- datetimepicker end -->

<script type="text/javascript">
$(document).ready(function(){

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'ru'
	});

	$('.uslugi').click(function(){
		var zayavka_id = $(this).data("id");
		$('[name=zayavka_id]').val(zayavka_id);
		$('#myModal').modal('show');

		$.ajax({
			type: "POST",
			url: "/ajax/ajax_get_usluga_to_zayavka",
			data: { "zayavka_id": zayavka_id },
			dataType: "html",
			success: function(msg){
				$('#example1>tbody').html(msg);
			}
		});	
		return false;
	});

	$(document).on('click', '.checked_usluga', function(){
		if (this.checked) {
			$(this).parent().parent().parent().css('background-color', '#d9534f');
		} else {
			$(this).parent().parent().parent().css('background-color', '#fff');
		}	
	});

	$('#save').click(function() {
		$('#form_add').submit();
	});

	$('[name=company], [name=progect]').change(function() {
		$('#filtr').submit();
	});

	var str = 0;
	var summ = 0;
	$('.cena').each(function() {
		str = $(this).text();
		summ=parseFloat(str.replace(",", "."))+summ;
	});
	$('#result_summ').text(summ.toFixed(2));

  



});
</script>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Услуги</div>
				<div class="panel-body">
	

					<ul class="nav nav-tabs">
					  <li class="active"><a href="/main/uslugi">Услуги</a></li>
					  <li><a href="/main/uslugi_list">Наименование услуг</a></li>
					</ul>
					<div class="filters">
						<div class="row">
						<div class="col-xs-11">
							<form action="/main/uslugi" method="GET" id="filtr">	
							    <div class="col-xs-3 select">
							    <label for="inputPassword">Компания</label>
							      <select name="company" class="form-control">
							      		<option>Компания</option>
							      		<? select_sel($companies, $this->input->get('company')) ?>
								  </select>
							    </div>
							    <div class="col-xs-3 select">
							    <label for="inputPassword">Проект</label>
							      <select name="progect" class="form-control">
							      		<option value="">Проект</option>
							      		<? select_sel($progects, $this->input->get('progect')) ?>
								  </select>
							    </div>
							    <div class="col-xs-2 input">
							    <label for="inputPassword" class="">Дата</label>
							      <input type="text" class="form-control datepicker" name="date" value="<? echo $this->input->get('date') ?>">
							      <button class="btn btn-primary">ok</button>
							    </div>
						    </form>
						    <!-- <div class="col-xs-2 input">
						    <label for="inputPassword" class="">Дата</label>
						    						   	 <input type="text" class="form-control" placeholder="">
						    </div> -->
						</div>
						</div>
					</div>
					<br>

						<table class="table table-bordered" id="example">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Компания</center></th>
									<th><center>Проект</center></th>
									<th><center>Заявка</center></th>
									<th><center>Дата</center></th>
									<th><center>Стоимость</center></th>
									<th><center>#</center></th>
								</tr>
							</thead>
							<tbody>
	<?php 
	$a=1;
	foreach ($main->result() as $row) { 
		echo '
								<tr>
									<td><center>'.$a++.'</center></td>
									<td><center>'.$row->company_nazva.'</center></td>
									<td><center>'.$row->progect_nazva.'</center></td>
									<td><center>Заявка №'.$row->id.'</center></td>
									<td><center>'.$row->date_create.'</center></td>
									<td><center class="cena">'.$row->suma.'</center></td>
									<td><center><a href="#" class="btn btn-success btn-sm uslugi" title="Услуги" data-id="'.$row->id.'"><span class="glyphicon glyphicon-briefcase"></span></a></center></td>
								</tr>';
	}
	?>

							</tbody>
						</table>

					<div class="pull-right">Общая сумма: <span id="result_summ"></span></div>



				</div>
			</div>
		</div>
	</div>





		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Услуги</h4>
					</div>
					<div class="modal-body">


						<form action="<? echo site_url("ajax/add_usluga_to_zayavka") ?>" method="POST" class="form-horizontal" id="form_add">
							<table class="table table-bordered" id="example1">
								<thead>
									<tr>
										<th><center>Название</center></th>
										<th><center>Цена</center></th>
										<th><center>#</center></th>
									</tr>
								</thead>
								<tbody>
<!-- result ajax_get_usluga_to_zayavka -->
								</tbody>
							</table>

							<input type="hidden" name="zayavka_id">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<button type="button" class="btn btn-primary" id="save">Сохранить</button>
					</div>
				</div>
			</div>
		</div>




<?php $this->load->view('footer'); ?>