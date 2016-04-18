<?php $this->load->view('header'); ?>

<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Новый проект</div>
				<div class="panel-body">
	
					<form action="<? echo site_url("main/add_edit_progect") ?>" method="POST" class="form-horizontal">
					<fieldset>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label">Компания:</label>  
						  <div class="col-md-4">
							<? 
							if($this->session->userdata('user_role')==1) {
								echo '<select name="company_id" class="form-control" required><option value=""></option>';
								select_sel($companies, @$main->company_id); 
							}
							if($this->session->userdata('user_role')==2) {
								echo '<select name="company_id" class="form-control" disabled>';
								select_sel_one($companies, $this->session->userdata('user_company_id')); 
							}
							?>
							</select>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label">Название:</label>  
						  <div class="col-md-4">
						  <input name="nazva" class="form-control input-md" type="text" value="<? echo @$main->nazva ?>" required>
						  </div>
						</div>	

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label">Описание:</label>  
						  <div class="col-md-4">
						  	<textarea class="form-control" name="opus" cols="30" rows="8"><? echo @$main->opus ?></textarea>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label">Сроки проведения:</label>  
						  <div class="col-md-4">
						  <input name="sroki" class="form-control input-md" type="text" value="<? echo @$main->sroki ?>">
						  </div>
						</div>	

						<!-- Button (Double) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"> </label>
						  <div class="col-md-4">
						  	<input type="hidden" name="id" value="<? echo @$main->id ?>">
							<button type="submit" class="btn btn-success">Сохранить</button>
							<a href="<? echo site_url("main/index") ?>" class="btn btn-danger">Отмена</a>
						  </div>
						</div>	

					</fieldset>
					</form>	


				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>