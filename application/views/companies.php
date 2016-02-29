<?php $this->load->view('header'); ?>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Компании</div>
				<div class="panel-body">
	
	
						<table class="table table-bordered" id="example">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Контрагент</center></th>
									<th><center>Полное название</center></th>
									<th><center>№ договора</center></th>
									<th><center>Телефон</center></th>
									<th><center>Статус</center></th>
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
									<td><a href="'.site_url("main/edit_company/".$row->id).'">'.$row->contragent.'</a></td>
									<td><a href="'.site_url("main/edit_company/".$row->id).'">'.$row->nazva.'</a></td>
									<td><center>'.$row->nomer_dogovora.'</center></td>
									<td><center>'.$row->tel.'</center></td>
									<td><center>'.$row->status.'</center></td>
									<td><center>
										<a href="'.site_url("main/edit_company/".$row->id).'"><img src="'.base_url().'application/views/img/pencil.png"></a>&nbsp;&nbsp;&nbsp;
										<a href="'.site_url("main/edit_company/".$row->id).'"><img src="'.base_url().'application/views/img/validno.png"></a>
									</center></td>
								</tr>';
	}
	?>

							</tbody>
						</table>

						<a class="btn btn-success" href="/main/add_company"><i class="glyphicon glyphicon-plus"></i> Добавить компанию</a>


				</div>
			</div>
		</div>
	</div>






<!-- Modal4 -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Личные данные</h4>
			</div>
			<div class="modal-body" id="candidate_detail">
				<!-- result	-->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-warning" id="edit_user"><i class="glyphicon glyphicon-pencil"></i> Изменить</a>
				<a href="#" class="btn btn-primary" id="detail_user"><i class="glyphicon glyphicon-file"></i> Подробнее</a>
				<a href="#" class="btn btn-default" data-dismiss="modal">Закрыть</a>
			</div>
		</div>
	</div>
</div>
<!-- Modal4 -->





<?php $this->load->view('footer'); ?>