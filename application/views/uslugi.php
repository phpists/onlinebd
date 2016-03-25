<?php $this->load->view('header'); ?>

<script type="text/javascript">
$(document).ready(function(){

	$('#add').click(function(){
		if ($('#nazva_add').val() != '' & $('#cena_add').val() != '') {
			$('#form_add').trigger("submit");
		} else {
			$('#mes_error_add').show("slow").delay(2000).fadeOut();
		}
	});

	$('.edit').click(function(){
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_edit_usluga",
			data: { "id": $(this).attr('usluga_id') },
			dataType: "json",
			success: function(msg){
				$('input[name=usluga_id]').val(msg.id);
				$('#nazva_edit').val(msg.nazva);
				$('#cena_edit').val(msg.cena);
				$('#myModal2').modal('show');
			}
		});	
		return false;
	});

	$('#update').click(function(){
		if ($('#nazva_edit').val() != '' & $('#cena_edit').val() != '') {
			$('#form_edit').trigger("submit");
		} else {
			$('#mes_error_edit').show("slow").delay(2000).fadeOut();
		}
	});

});
</script>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Услуги</div>
				<div class="panel-body">
	
	
						<table class="table table-bordered" id="example">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Название</center></th>
									<th><center>Цена</center></th>
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
									<td><a href="#" class="edit" usluga_id="'.$row->id.'">'.$row->nazva.'</a></td>
									<td><center>'.$row->cena.'</center></td>
									<td><center>
										<a href="#" class="edit" usluga_id="'.$row->id.'"><img src="'.base_url().'application/views/img/pencil.png"></a>&nbsp;&nbsp;&nbsp;
										<a href="'.site_url("main/del_usluga/".$row->id).'" onclick="return confirm(\'Удалить эту услугу?\')" title="Удалить"><img src="'.base_url().'application/views/img/validno.png"></a>
									</center></td>
								</tr>';
	}
	?>

							</tbody>
						</table>

						<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Добавить услугу</button>




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
						<h4 class="modal-title" id="myModalLabel">Добавить услугу</h4>
					</div>
					<div class="modal-body">


						<form action="<? echo site_url("main/add_edit_usluga") ?>" method="POST" class="form-horizontal" id="form_add">
							<fieldset>

								<!-- Text input -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nazva_add">Название:</label>  
									<div class="col-md-4">
										<input id="nazva_add" name="nazva" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="cena_add">Цена:</label>  
									<div class="col-md-4">
										<input id="cena_add" name="cena" class="form-control input-md" type="text">
									</div>
								</div>	
								<div class="alert alert-danger" role="alert" style="display:none;" id="mes_error_add">Заполните название и цену !</div>
							</fieldset>
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<button type="button" class="btn btn-primary" id="add">Сохранить</button>
					</div>
				</div>
			</div>
		</div>




		<!-- Modal 2 -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel2">Редактировать пользователя</h4>
					</div>
					<div class="modal-body">


						<form action="<? echo site_url("main/add_edit_usluga") ?>" method="POST" class="form-horizontal" id="form_edit">
							<fieldset>

								<!-- Text input -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nazva_add">Название:</label>  
									<div class="col-md-4">
										<input id="nazva_edit" name="nazva" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="cena_add">Цена:</label>  
									<div class="col-md-4">
										<input id="cena_edit" name="cena" class="form-control input-md" type="text">
									</div>
								</div>	
								<input type="hidden" name="usluga_id">
								<div class="alert alert-danger" role="alert" style="display:none;" id="mes_error_edit">Заполните название и цену !</div>
							</fieldset>
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<button type="button" class="btn btn-primary" id="update">Сохранить</button>
					</div>
				</div>
			</div>
		</div>





<?php $this->load->view('footer'); ?>