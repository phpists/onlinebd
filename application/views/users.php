<?php $this->load->view('header'); ?>

<!-- jQuery Masked Input Plugin -->
<script src="<? echo base_url() ?>application/views/js/jquery.maskedinput.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("input[name=tel]").mask("(999) 999-99-99");

	$('#add').click(function(){
		if ($('#name').val() != '' & $('#pass').val() != '' & $('#email').val() != '') {
			$('#form_add').trigger("submit");
		} else {
			$('#mes_error_add').show("slow").delay(2000).fadeOut();
		}
	});

	$('.edit').click(function(){
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_edit_user",
			data: { "user_id": $(this).attr('user_id') },
			dataType: "json",
			success: function(obj){
				$('input[name=user_id]').val(obj.id);
				$('#edit_name').val(obj.name);
				$('#edit_pass').val(obj.pass);
				$('#edit_tel').val(obj.tel);
				$('#edit_email').val(obj.email);
				// активуємо потрібну запись
				$('[name=role] option').filter(function() { 
					return ($(this).val() == obj.role);
				}).prop('selected', true);
				$('[name=company_id]').hide();	
				if(obj.role == 2) {
					$('[name=company_id]').show();
					$('[name=company_id] option').filter(function() { 
						return ($(this).val() == obj.company_id);
					}).prop('selected', true);
				}
				$('#myModal2').modal('show');
			}
		});	
		$('tr').removeClass("info");
		$(this).parent().parent().parent().addClass("info");
		return false;		
	});	

	$('[name=role]').change(function(){
		if($(this).val() == 2) {
			$('[name=company_id]').show();
		} else {
			$('[name=company_id]').hide();
		}
	});

	$('#update').click(function(){
		if ($('#edit_name').val() != '' & $('#edit_pass').val() != '' & $('#edit_email').val() != '') {
			$('#form_edit').trigger("submit");
		} else {
			$('#mes_error_edit').show("slow").delay(2000).fadeOut();
			$('#mes_error_edit_user').show("slow");
		}
	});

});
</script>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Пользователи</div>
				<div class="panel-body">
	
					<? show_message() ?>

					<table class="table table-bordered table-hover" id="example">
						<thead>
							<tr>
								<th><center>#</center></th>
								<th><center>Имя</center></th>
								<th><center>Компания</center></th>
								<th><center>email</center></th>
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
								<td><a href="#" class="edit" user_id="'.$row->id.'">'.$row->name.'</a></td>
								<td><center>'.$row->nazva.'</center></td>
								<td><center>'.$row->email.'</center></td>
								<td><center>'.$row->tel.'</center></td>
								<td><center><a href="'.site_url("main/deactevate_user/".$row->id).'">'.(($row->active==1)?"Активен":"Деактивирован").'</a></center></td>
								<td><center>
									<a href="#" class="edit" user_id="'.$row->id.'"><img src="'.base_url().'application/views/img/pencil.png"></a>&nbsp;&nbsp;&nbsp;
									<a href="'.site_url("main/del_user/".$row->id).'" onclick="return confirm(\'Удалить этого пользователя?\')" title="Удалить"><img src="'.base_url().'application/views/img/validno.png"></a>
									<!--<a href="#" class="edit_user btn btn-warning btn-sm" user_id="'.$row->id.'" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="'.site_url("main/del_user/".$row->id).'" class="btn btn-danger btn-sm" onclick="return confirm(\'Удалить этого пользователя?\')" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>-->
								</center></td>
							</tr>';
}
?>

						</tbody>
					</table>

					<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Добавить пользователя</button>

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
						<h4 class="modal-title" id="myModalLabel">Добавить пользователя</h4>
					</div>
					<div class="modal-body">


						<form action="<? echo site_url("main/add_edit_user") ?>" method="POST" class="form-horizontal" id="form_add">
							<fieldset>

								<!-- Text input -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="name">Имя:</label>  
									<div class="col-md-4">
										<input id="name" name="name" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="pass">Пароль:</label>  
									<div class="col-md-4">
										<input id="pass" name="pass" class="form-control input-md" type="text">
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="tel">Телефон:</label>  
									<div class="col-md-4">
										<input id="tel" name="tel" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="email">email:</label>  
									<div class="col-md-4">
										<input id="email" name="email" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label">Роль:</label>
									<div class="col-md-4">
										<select id="add_role" class="form-control" name="role">
											<option value="1">Администратор</option>
											<option value="2">Пользователь</option>
										</select>
									</div>
								</div>

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="company">Компания:</label>
									<div class="col-md-4">
										<select id="add_company_id" class="form-control" name="company_id" style="display:none">
											<option value="">Выберете компанию</option>
											<?php
											foreach ($companies->result() as $row) {
												echo '<option value="'.$row->id.'">'.$row->nazva.'</option>';
											}
											?>
										</select>
									</div>
								</div>			
								<div class="alert alert-danger" role="alert" style="display:none;" id="mes_error_add">Заполните обязательные поля (имя, почта, пароль) !</div>
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


						<form action="<? echo site_url("main/add_edit_user") ?>" method="POST" class="form-horizontal" id="form_edit">
							<fieldset>

								<!-- Text input -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="edit_name">Имя:</label>  
									<div class="col-md-4">
										<input id="edit_name" name="name" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="edit_pass">Пароль:</label>  
									<div class="col-md-4">
										<input id="edit_pass" name="pass" class="form-control input-md" type="text">
									</div>
								</div>	

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="edit_tel">Телефон:</label>  
									<div class="col-md-4">
										<input id="edit_tel" name="tel" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="edit_email">email:</label>  
									<div class="col-md-4">
										<input id="edit_email" name="email" class="form-control input-md" type="text">
									</div>
								</div>

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label">Роль:</label>
									<div class="col-md-4">
										<select id="edit_role" class="form-control" name="role">
											<option value="1">Администратор</option>
											<option value="2">Пользователь</option>
										</select>
									</div>
								</div>

								<!-- Select Basic -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="company">Компания:</label>
									<div class="col-md-4">
										<select class="form-control" name="company_id" style="display:none">
										<?php
										foreach ($companies->result() as $row) {
											echo '<option value="'.$row->id.'">'.$row->nazva.'</option>';
										}
										?>
										</select>
									</div>
								</div>

								<input type="hidden" name="user_id">
								<div class="alert alert-danger" role="alert" style="display:none;" id="mes_error_edit">Заполните обязательные поля (имя, почта, пароль) !</div>
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