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
	
	

<?php 
$a=1;
foreach ($zayavki->result() as $row) { ?>
							<br>
							<a class="filterGroupTitle collapsed" data-toggle="collapse" data-parent="#filters" href="#description<? echo $row->id ?>" aria-expanded="false">
								<div class="panel-heading posRel history_panel">
									<h3 class="panel-title"><span class="glyphicon glyphicon-chevron-down downAccordion"></span>
										Заявка № <? echo $row->id; echo ' - '.(($row->type==1)?'Приход':'Расход').' ('.date_convert($row->date_create).')'; ?> 
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