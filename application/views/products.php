<?php $this->load->view('header'); ?>

<script type="text/javascript">
$(document).ready(function(){

	$('#add').click(function(){
		//if ($('input[name=name]').val() != '' & $('input[name=pass]').val() != '') {
			$('#form_add').trigger("submit");
		// } else {
		// 	$('#mes_error_add_user').show("slow");
		// 	setInterval(function(){
		// 		$("#mes_error_add_user").hide();
		// },4000); // 10sec (10000)
		//}
	});

	$('.edit').click(function(){
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_edit_product",
			data: { "id": $(this).attr('pr_id') },
			dataType: "html",
			success: function(msg){
				//alert(msg);
				var obj = jQuery.parseJSON(msg);
				$('input[name=id]').val(obj.id);
				$('#edit_nazva').val(obj.nazva);
				$('#edit_kilk').val(obj.kilk);
				//$('#edit_edinica_izm').val(obj.edinica_izm);
				$('#edit_edinica_izm option').filter(function() { 
					return ($(this).val() == obj.edinica_izm);
				}).prop('selected', true);
				$('#edit_artikl').val(obj.artikl);
				$('#edit_opus').val(obj.opus);
				$('#myModal2').modal('show');
			}
		});	
		$('tr').removeClass("info");
		$(this).parent().parent().parent().addClass("info");
		return false;		
	});	

	$('#update').click(function(){
		//if ($('#edit_name').val() != '' & $('#edit_login').val() != '' & $('#edit_pass').val() != '') {
			$('#form_edit').trigger("submit");
		// } else {
		// 	$('#mes_error_edit_user').show("slow");
		// 	setInterval(function(){
		// 		$("#mes_error_edit_user").hide();
		// 		},4000); // 10sec (10000)
		// }
	});

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
									<td><a href="#" class="edit" pr_id="'.$row->id.'">'.$row->nazva.'</a></td>
									<td><center>'.$row->kilk.'</center></td>
									<td><center>'.$row->edinica_izm.'</center></td>
									<td><center>'.$row->artikl.'</center></td>
									<td><center>
										<a href="#" class="edit" pr_id="'.$row->id.'"><img src="'.base_url().'application/views/img/pencil.png"></a>&nbsp;&nbsp;&nbsp;
										<a href="'.site_url("main/del_product/".$row->id).'" onclick="return confirm(\'Удалить ТМЦ?\')"><img src="'.base_url().'application/views/img/validno.png"></a>
									</center></td>
								</tr>';
	}
	?>

							</tbody>
						</table>

						<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Добавить товар</button>



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
						<h4 class="modal-title" id="myModalLabel2">Редактировать товар</h4>
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
						<button type="button" class="btn btn-primary" id="update">Сохранить</button>
					</div>
				</div>
			</div>
		</div>



<?php $this->load->view('footer'); ?>