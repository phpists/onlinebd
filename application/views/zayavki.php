<?php $this->load->view('header'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$('#example1').dataTable({
		//"bFilter": false,
		"bPaginate": false,
		"bInfo": false,
		//"order": [[ 3, "desc" ]]
		"language": {
			"url": "<? echo base_url() ?>application/views/DataTables-1.10.9/dataTables.rus.lang"
		}
	});

// зміна статусу
	$(document).on('click', '.change_status_rashod', function(event){
		data_id = $(event.target).data("id"); 
		data_title = $(event.target).data("title"); 
		data_status = $(event.target).data("status"); 
		$(this).parent().parent().prev().text(data_title);
		$.post("/ajax/change_status_rashod", { 'id':data_id, 'status':data_status } );
		//return false;
	});

	/*$(document).on('click', '.change_status_prihod', function(event){
		data_id = $(event.target).data("id"); 
		data_title = $(event.target).data("title"); 
		data_status = $(event.target).data("status"); 
		$(this).parent().parent().prev().text(data_title);
		//$.post("/ajax/change_status_prihod", { 'id':data_id, 'status':data_status } );
		//return false;
	});*/

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

	 $('[data-toggle="tooltip"]').tooltip();

});
</script>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Заявки на отгрузку / приход</div>
				<div class="panel-body">
	
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tab_otgruzka" data-toggle="tab">Отгрузка</a></li>
						  <li><a href="#tab_prihod" data-toggle="tab">Приход</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active" id="tab_otgruzka">
							<br>
							<div class="btn-group pull-right data">
								<!--<button type="button" class="btn btn-primary show_company" filtr="active">Активные</button>
								<button type="button" class="btn btn-default show_company" filtr="all">Все</button>-->
								<a href="/main/add_zayavka" class="btn btn-success" title="Создать заявку"><i class="glyphicon glyphicon-plus"></i> Создать заявку</a>
							</div>
							<br><br>
	<!-- отгрузка -->
								<table class="table table-bordered table-hover" id="example2">
									<thead>
										<tr>
											<th><center>#</center></th>
											<th><center>Проект</center></th>
											<th><center>Дата отгрузки</center></th>
											<th><center>ФИО кто забирает</center></th>
											<th><center>Телефон</center></th>
											<th><center>Статус</center></th>
											<th><center>#</center></th>
										</tr>
									</thead>
									<tbody>
							<?php 
							$a=1;
							foreach ($rashod->result() as $row) {
								if($row->status==1) $status = "В ожидании";
								if($row->status==2) $status = "В обработке";
								if($row->status==0) $status = "Отгружено";
								echo '
										<tr>
											<td><center>'.anchor("main/zayavka/".$row->id, 'Заявка №'.$row->id).'</center></td>
											<td>'.anchor("main/zayavka/".$row->id, $row->nazva_progect).'</td>
											<td><center>'.$row->date_otgruzki.'</center></td>
											<td><center>'.$row->fio.'</center></td>
											<td><center>'.$row->tel.'</center></td>
											<td><center>
												<div class="btn-group responsible_vacancy">
													<button class="btn btn-link dropdown-toggle" data-toggle="dropdown" type="button">'.$status.'</button>
													<ul class="dropdown-menu">
														<li><a class="change_status_rashod" data-status="1" data-title="В ожидании" data-id="'.$row->id.'" href="#">В ожидании</a></li>
														<li><a class="change_status_rashod" data-status="2" data-title="В обработке" data-id="'.$row->id.'" href="#">В обработке</a></li>
														<li><a class="change_status_rashod1" data-status="0" data-title="Отгружено" data-id="'.$row->id.'" href="#">Отгружено</a></li>
													</ul>
												</div>
											</center></td>
											<td><center>
												'.(($row->comment)?'<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="'.$row->comment.'"><span class="glyphicon glyphicon-info-sign"></span></button>':'').'
												<a href="/main/zayavka/'.$row->id.'" class="btn btn-warning btn-sm" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
												
												<a href="#" class="btn btn-success btn-sm uslugi" title="Услуги" data-id="'.$row->id.'"><span class="glyphicon glyphicon-briefcase"></span></a>
												
												<div class="btn-group responsible_vacancy">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button"><span class="glyphicon glyphicon-print"></span></button>
													<ul class="dropdown-menu">
														<li><a href="/php_excel/export.php?id='.$row->id.'&type=0">Печать в файл</a></li>
														<li><a href="'.site_url("main/print_rashod/".$row->id).'">Печать в браузере</a></li>
													</ul>
												</div>

												<a href="#" class="btn btn-danger btn-sm" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>
											</center></td>
										</tr>';
							}
							?>

									</tbody>
								</table>

	  					  </div>
			  			  <div class="tab-pane" id="tab_prihod">
							<br>
							<div class="btn-group pull-right data">
								<!--<button type="button" class="btn btn-primary show_company" filtr="active">Активные</button>
								<button type="button" class="btn btn-default show_company" filtr="all">Все</button>-->
								<a href="/main/add_zayavka_prihod" class="btn btn-success" title="Создать заявку"><i class="glyphicon glyphicon-plus"></i> Создать заявку</a>
							</div>
							<br><br>
	<!-- приход -->
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th><center>#</center></th>
											<th><center>Проект</center></th>
											<th><center>Дата отгрузки</center></th>
											<th><center>ФИО кто забирает</center></th>
											<th><center>Телефон</center></th>
											<th><center>Статус</center></th>
											<th><center>#</center></th>
										</tr>
									</thead>
									<tbody>
							<?php 
							$a=1;
							foreach ($prihod->result() as $row) {
								if($row->status==1) $status = "В ожидании";
								//if($row->status==2) $status = "В обработке";
								if($row->status==0) $status = "Принято"; //"Отгружено";
								echo '
										<tr>
											<td><center>'.anchor("main/zayavka/".$row->id, 'Заявка №'.$row->id).'</center></td>
											<td>'.anchor("main/zayavka/".$row->id, $row->nazva_progect).'</td>
											<td><center>'.$row->date_otgruzki.'</center></td>
											<td><center>'.$row->fio.'</center></td>
											<td><center>'.$row->tel.'</center></td>
											<td><center>
												<div class="btn-group responsible_vacancy">
													<button class="btn btn-link dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="true">'.$status.'</button>
													<ul class="dropdown-menu">
														<li><a class="change_status_prihod" data-status="1" data-title="В ожидании" data-id="'.$row->id.'" href="#">В ожидании</a></li>
														<li><a class="change_status_prihod" data-status="0" data-title="Принято" data-id="'.$row->id.'" href="#">Принято</a></li>
													</ul>
												</div>
											</center></td>
											<td><center>
												'.(($row->comment)?'<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="'.$row->comment.'"><span class="glyphicon glyphicon-info-sign"></span></button>':'').'
											
												<a href="/main/zayavka/'.$row->id.'" class="btn btn-warning btn-sm" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
								
												<a href="#" class="btn btn-success btn-sm uslugi" title="Услуги" data-id="'.$row->id.'"><span class="glyphicon glyphicon-briefcase"></span></a>

												<div class="btn-group responsible_vacancy">
													<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" type="button"><span class="glyphicon glyphicon-print"></span></button>
													<ul class="dropdown-menu">
														<li><a href="/php_excel/export.php?id='.$row->id.'&type=0">Печать в файл</a></li>
														<li><a href="'.site_url("main/print_prihod/".$row->id).'">Печать в браузере</a></li>
													</ul>
												</div>

												<a href="#" class="btn btn-danger btn-sm" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>
											</center></td>
										</tr>';
							}
							?>

									</tbody>
								</table>		


						  </div>
						</div>

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