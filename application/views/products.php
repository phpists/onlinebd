<?php $this->load->view('header'); ?>

<script type="text/javascript">
$(document).ready(function(){

	/*$('#add').click(function(){
		$('#form_add').trigger("submit");
	});*/

	$('.edit').click(function(){
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_edit_product",
			data: { "id": $(this).attr('pr_id') },
			dataType: "json",
			success: function(data){
				$('input[name=id]').val(data.id);
				$('#edit_nazva').val(data.nazva);
				$('#edit_kilk').val(data.kilk);
				$('#edit_edinica_izm option').filter(function() { 
					return ($(this).val() == data.edinica_izm);
				}).prop('selected', true);
				$('#edit_artikl').val(data.artikl);
				$('#edit_opus').val(data.opus);
				$('#myModal2').modal('show');
			}
		});	
		$('tr').removeClass("info");
		$(this).parent().parent().parent().addClass("info");
		return false;		
	});	

/*	$('#update').click(function(){
		$('#form_edit').trigger("submit");
	});*/

});
</script>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><? echo anchor('main/index', $progects->nazva);  ?>: ТМЦ</div>
				<div class="panel-body">
	
	
						<table class="table table-bordered" id="example">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Название</center></th>
									<th><center>Количество</center></th>
									<th><center>Един. измер</center></th>
									<th><center>Артикул</center></th>
								</tr>
							</thead>
							<tbody>
	<?php 
	$a=1;
	foreach ($main->result() as $row) { 
		echo '
								<tr>
									<td><center>'.$a++.'</center></td>
									<td><a href="#" class="edit" pr_id="'.$row->id.'">'.$row->nazva.'</a></td>
									<td><center>'.$row->kilk.'</center></td>
									<td><center>'.$row->edinica_izm.'</center></td>
									<td><center>'.$row->artikl.'</center></td>
								</tr>';
	}
	?>

							</tbody>
						</table>
<? if($this->session->userdata('user_role')==1) { ?>
						<!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Добавить товар</button> -->
<? } ?>
						<a href="<? echo site_url("main/progect_zayavki/".$progects_id) ?>" class="btn btn-danger">Заявок <span class="badge"><? echo count($zayavok->result()) ?></span></a>



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
						<h4 class="modal-title" id="myModalLabel">Добавить товар</h4>
					</div>
					<div class="modal-body">


						<form action="<? echo site_url("main/add_product") ?>" method="POST" class="form-horizontal" id="form_add">
							<fieldset>

								<!-- Text input -->
								<div class="form-group">
									<label class="col-md-4 control-label">Название:</label>  
									<div class="col-md-4">
										<input id="add_nazva" name="nazva" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Количество:</label>  
									<div class="col-md-4">
										<input name="kilk" class="form-control input-md" type="text">
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Един. измер.:</label>  
									<div class="col-md-4">
										<!-- <input name="edinica_izm" class="form-control input-md" type="text"> -->
										<select name="edinica_izm" class="form-control">
											<option value="упаковка">упаковка</option>
											<option value="шт">шт</option>
											<option value="ед">ед.</option>
											<option value="коробка">коробка</option>
											<option value="паллет">паллет</option>
										</select>
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Артикул:</label>  
									<div class="col-md-4">
										<input name="artikl" class="form-control input-md" type="text">
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Описание:</label>  
									<div class="col-md-6">
										<textarea class="form-control" name="opus" id="opus_add" rows="3"></textarea>
										<input type="hidden" name="progect_id" value="<? echo $progects_id ?>">
									</div>
								</div>	

								<div class="alert alert-danger" role="alert" style="display:none;" id="mes_error_add">Заполните обязательные поля !</div>
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
						<h4 class="modal-title" id="myModalLabel2">Просмотр ТМЦ</h4>
					</div>
					<div class="modal-body">


						<form action="<? echo site_url("main/edit_product") ?>" method="POST" class="form-horizontal" id="form_edit">
							<fieldset>

								<!-- Text input -->
								<div class="form-group">
									<label class="col-md-4 control-label">Название:</label>  
									<div class="col-md-4">
										<input id="edit_nazva" name="nazva" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Количество:</label>  
									<div class="col-md-4">
										<input id="edit_kilk" name="kilk" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Един. измер.:</label>  
									<div class="col-md-4">
										<!-- <input id="edit_edinica_izm" name="edinica_izm" class="form-control input-md" type="text"> -->
										<select id="edit_edinica_izm" name="edinica_izm" class="form-control">
											<option value="упаковка">упаковка</option>
											<option value="шт">шт</option>
											<option value="ед">ед.</option>
											<option value="коробка">коробка</option>
											<option value="паллет">паллет</option>
										</select>
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Артикул:</label>  
									<div class="col-md-4">
										<input id="edit_artikl" name="artikl" class="form-control input-md" type="text">
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label">Описание:</label>  
									<div class="col-md-6">
										<textarea class="form-control" name="opus" id="edit_opus" rows="3"></textarea>
									</div>
								</div>
								<input type="hidden" name="progect_id" value="<? echo $progects_id ?>">
								<input type="hidden" name="id">
								<!-- <input type="hidden" name="user_id"> -->
								<div class="alert alert-danger" role="alert" style="display:none;" id="mes_error_edit_user">Заповніть обовязкові поля (ім'я, логін, пароль) !</div>
							</fieldset>
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<!-- <button type="button" class="btn btn-primary" id="update">Сохранить</button> -->
					</div>
				</div>
			</div>
		</div>



<?php $this->load->view('footer'); ?>