<?php $this->load->view('header'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$('#example1').dataTable({
		"bFilter": false,
		"bPaginate": false,
		"bInfo": false,
		//"order": [[ 3, "desc" ]]
		"language": {
			"url": "<? echo base_url() ?>application/views/DataTables-1.10.9/dataTables.rus.lang"
		}
	});

	$('.uslugi').click(function(){
		// alert();
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
			$(this).parent().parent().css('background-color', '#d9534f');
			//$(this).parent().prev().children('input').val('5467456');
			$(this).parent().prev().children('input').attr("disabled", 'disabled');
		} else {
			$(this).parent().parent().css('background-color', '#fff');
			$(this).parent().prev().children('input').removeAttr('disabled');
		}
		summ_uslug();	
	});

function summ_uslug() {
	var summ = 0;
	$('[type="number"]').each(function() {
		if($(this).attr("disabled")) {
			str = $(this).val();
			summ = parseFloat(str)+summ;
		}
	});
	$('#summa_uslug').text(summ);
}

summ_uslug();



	$('#save').click(function() {
		$('#form_add').submit();
	});

});
</script>



<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><? echo anchor('main/index', $progects->nazva);  ?>: заявки</div>
				<div class="panel-body">

				<div class="row">
					<div class="col-sm-3">
						<p><b>Всего услуг: </b> </p>
						<p><b>Всего заявок: </b> <? echo $zayavok ?></p>
					</div>
					<div class="col-sm-3">
						<p><b>Дата создания: </b> <? echo $progects->date_create ?></p>
						<p><b>Сроки проведения: </b> <? echo $progects->sroki ?></p> 
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
					  <table class="table table-bordered table-hover text-center zayavki_table" id="example1">
					    <thead>
					      <tr>
					        <th>Название</th>
					        <th>Цена</th>
					        <th>#</th>
					      </tr>
					    </thead>
					    <tbody>

<?
		foreach ($uslugi->result() as $row) { 
			// ($row->cena2)?$checkbox='checked':$checkbox='';
			// ($row->cena2)?$style=' style="background-color: #d9534f;"':$style='';
			echo '
				<tr>
					<td>'.$row->nazva.'<input type="hidden" name="nazva['.$row->id.']" value="'.$row->nazva.'" /></td>
					<td><input type="number" name="cena['.$row->id.']" class="form-control" min="1" value="'.$row->cena.'"></td>
					<td><input type="checkbox" name="availability['.$row->id.']" value="'.$row->id.'" class="form-control checked_usluga"></td>
				</tr>';
		}

?>

					    </tbody>
					  </table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<p><b>Общая сума по услугам: </b> <span id="summa_uslug"></span></p>
					</div>
				</div>




	
<?php 
$a=1;
foreach ($zayavki->result() as $row) { ?>
					<br>
					<a class="filterGroupTitle collapsed" data-toggle="collapse" data-parent="#filters" href="#description<? echo $row->id ?>" aria-expanded="false">
						<div class="panel-heading posRel history_panel">
							<h3 class="panel-title"><span class="glyphicon glyphicon-chevron-down downAccordion"></span>
								Заявка № <? echo $row->id; echo ' - '.(($row->type==1)?'Приход':'Расход').' ('.date_convert($row->date_create).') - <strong>'.(($row->status==1)?'В обработке':'Закрыта').'</strong>'; ?> 
							</h3>
						</div>
					</a>
					<div id="description<? echo $row->id ?>" class="panel-collapse collapse" aria-expanded="true">
						<div class="history_candidate comentators_block">
							<a href="/main/zayavka/<? echo $row->id ?>" class="btn btn-danger">Перейти</a>
	<? 
	if($row->type==1) {
		$this->Main_model->zayavki_prihod($row->id);
	}
	if($row->type==0) {
		$this->Main_model->zayavki_rashod($row->id);
	}
	?>
						</div>
					</div>
<? } ?>							



				</div>
			</div>
		</div>
	</div>


<?php $this->load->view('footer'); ?>