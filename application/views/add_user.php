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
	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		locale: 'uk'
	});
	$("input[name=tel], input[name=tel2], input[name=tel3]").mask("(999) 999-99-99");
});
</script>




<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Новый контрагент</div>
				<div class="panel-body" style="min-height:450px;">
	


<form action="<? echo site_url("main/add_user_true") ?>" method="POST" class="form-horizontal" id="form_add_client">
<fieldset>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

	<!-- Text input-->
	<div class="form-group" id="error_nazva">
	  <label class="col-md-6 control-label" for="nazva">Контрагент:</label>  
	  <div class="col-md-6">
	  <input id="nazva" name="nazva" class="form-control input-md" type="text" required="required">
	  </div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="nazpos">Статус:</label>
	  <div class="col-md-6">
		<select name="region" class="form-control">
			<option value="1">Юрид.</option>			
			<option value="2">Физ.</option>			
		</select>		
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="adress">Название:</label>  
	  <div class="col-md-6">
	  <input id="adress" name="adress" class="form-control input-md" type="text">
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="contact">ИНН:</label>  
	  <div class="col-md-6">
	  <input id="contact" name="contact" class="form-control input-md" type="text">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="email">КПП:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="email">ОГРН:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>

	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="prymitka">Примечание:</label>
	  <div class="col-md-6">                     
		<textarea rows="5" class="form-control" id="prymitka" name="prymitka"></textarea>
	  </div>
	</div>


</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class="form-group">
	  <label class="col-md-3 control-label" for="date_create">Дата:</label>  
	  <div class="col-md-6">
	  <input id="date_create" name="date_create" class="form-control input-md datepicker" type="text" value="<? echo date("Y-m-d") ?>">
	  <!--<span class="help-block">help</span> -->
	  </div>
	</div>


	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="email">Юридический адрес:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="email">Фактический адрес:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="email">№ договора:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="email">Контактное лицо:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>	

	<div class="form-group" id="error_tel">
	  <label class="col-md-3 control-label" for="tel">Телефон: <img src="<? echo base_url() ?>application/views/front/img/ajax-loader2.gif" id="load" style="display:none" /><span></span></label>  
		<div class="col-md-6">
			<div class="input-group">
				<input id="tel" name="tel" class="form-control input-md tel" type="text">
				<span class="input-group-addon send_sms">
					<a href="#"><span class="glyphicon glyphicon-phone"> </span></a>
				</span>
			</div>
			<!-- <a href="#" class="help-block" id="show_tel">Додаткові телефони</a> -->
		</div>
	</div>

	<div style="display:none" id="hid_tel">	
		<!-- Text input-->
		<div class="form-group" id="error_tel">
		  <label class="col-md-3 control-label" for="tel">Телефон 2: <img src="<? echo base_url() ?>application/views/front/img/ajax-loader2.gif" id="load" style="display:none" /><span></span></label>  
			<div class="col-md-6">
				<div class="input-group">
					<input id="tel2" name="tel2" class="form-control input-md tel" type="text">
					<span class="input-group-addon send_sms">
						<a href="#"><span class="glyphicon glyphicon-phone"> </span></a>
					</span>
				</div>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group" id="error_tel">
		  <label class="col-md-3 control-label" for="tel">Телефон 3: <img src="<? echo base_url() ?>application/views/front/img/ajax-loader2.gif" id="load" style="display:none" /><span></span></label>  
			<div class="col-md-6">
				<div class="input-group">
					<input id="tel3" name="tel3" class="form-control input-md tel" type="text">
					<span class="input-group-addon send_sms">
						<a href="#"><span class="glyphicon glyphicon-phone"> </span></a>
					</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="email">БИК:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="email">р/c:</label>  
	  <div class="col-md-6">
	  <input id="email" name="email" class="form-control input-md" type="text">
	  </div>
	</div>


	
</div>
</div>

	<div class="form-group" id="block_submit" style="text-align: center;">
		<input type="hidden" name="form_shin">
		<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok"></i> Сохранить</button>
		<a href="<? echo site_url("main/index") ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>
	</div>
</fieldset>
</form>	

			
							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>