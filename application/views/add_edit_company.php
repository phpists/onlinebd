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
		locale: 'ru'
	});
	$("input[name=tel], input[name=tel2], input[name=tel3]").mask("(999) 999-99-99");
});
</script>




<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><? echo $title ?></div>
				<div class="panel-body" style="min-height:450px;">
	

<form action="<? echo site_url("main/add_edit_company") ?>" method="POST" class="form-horizontal" id="form_add_client">
<fieldset>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

	<!-- Text input-->
	<div class="form-group" id="error_nazva">
	  <label class="col-md-6 control-label">Контрагент:</label>  
	  <div class="col-md-6">
	  	<input name="contragent" class="form-control input-md" type="text" value="<? echo @$main->contragent ?>">
	  </div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
	  <label class="col-md-6 control-label">Статус:</label>
	  <div class="col-md-6">
		<select name="status" class="form-control">
			<option value="Юрид.">Юрид.</option>			
			<option value="Физ.">Физ.</option>			
		</select>		
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label">Название (полное):</label>  
	  <div class="col-md-6">
	  <input name="nazva" class="form-control input-md" type="text" value="<? echo @$main->nazva ?>">
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label">ИНН:</label>  
	  <div class="col-md-6">
	  <input name="inn" class="form-control input-md" type="text" value="<? echo @$main->inn ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label">КПП:</label>  
	  <div class="col-md-6">
	  <input name="kpp" class="form-control input-md" type="text" value="<? echo @$main->kpp ?>">
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-6 control-label" for="email">ОГРН:</label>  
	  <div class="col-md-6">
	  <input name="ogrn" class="form-control input-md" type="text" value="<? echo @$main->ogrn ?>">
	  </div>
	</div>

	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-6 control-label">Примечание:</label>
	  <div class="col-md-6">
		<textarea rows="9" class="form-control" name="primechanie"><? echo @$main->primechanie ?></textarea>
	  </div>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class="form-group">
	  <label class="col-md-3 control-label">Дата:</label>  
	  <div class="col-md-6">
	  <input name="date_c" class="form-control input-md datepicker" type="text" value="<? echo @$main->date_c ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">Юридический адрес:</label>  
	  <div class="col-md-6">
	  <input name="ur_adress" class="form-control input-md" type="text" value="<? echo @$main->ur_adress ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">Фактический адрес:</label>  
	  <div class="col-md-6">
	  <input name="fac_adress" class="form-control input-md" type="text" value="<? echo @$main->ur_adress ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">№ договора:</label>  
	  <div class="col-md-6">
	  <input name="nomer_dogovora" class="form-control input-md" type="text" value="<? echo @$main->nomer_dogovora ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">Контактное лицо:</label>  
	  <div class="col-md-6">
	  <input name="contact_lico" class="form-control input-md" type="text" value="<? echo @$main->contact_lico ?>">
	  </div>
	</div>	

	<div class="form-group" id="error_tel">
	  <label class="col-md-3 control-label" for="tel">Телефон: <img src="<? echo base_url() ?>application/views/front/img/ajax-loader2.gif" id="load" style="display:none" /><span></span></label>  
		<div class="col-md-6">
			<div class="input-group">
				<input id="tel" name="tel" class="form-control input-md tel" type="text" value="<? echo @$main->tel ?>">
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
	  <label class="col-md-3 control-label">БИК:</label>  
	  <div class="col-md-6">
	  <input name="bic" class="form-control input-md" type="text" value="<? echo @$main->bic ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">р/c:</label>  
	  <div class="col-md-6">
	  <input name="rs" class="form-control input-md" type="text" value="<? echo @$main->rs ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">Банк:</label>  
	  <div class="col-md-6">
	  <input name="bank" class="form-control input-md" type="text" value="<? echo @$main->bank ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">к/c:</label>  
	  <div class="col-md-6">
	  <input name="ks" class="form-control input-md" type="text" value="<? echo @$main->ks ?>">
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label">Генеральный директор:</label>  
	  <div class="col-md-6">
	  <input name="gen_dir" class="form-control input-md" type="text" value="<? echo @$main->gen_dir ?>">
	  </div>
	</div>

	
</div>
</div>

	<div class="form-group" id="block_submit" style="text-align: center;">
		<input type="hidden" name="id" value="<? echo @$main->id ?>">
		<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok"></i> Сохранить</button>
		<a href="<? echo site_url("main/companies") ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>
	</div>
</fieldset>
</form>	

			
							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>