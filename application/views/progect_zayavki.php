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
	
	


							<br>
							<a class="filterGroupTitle collapsed" data-toggle="collapse" data-parent="#filters" href="#description" aria-expanded="false">
								<div class="panel-heading posRel history_panel">
									<h3 class="panel-title"><span class="glyphicon glyphicon-chevron-down downAccordion"></span>
										История <span class="badge"> 15</span>
									</h3>                             
								</div>
							</a>							
							<a class="filterGroupTitle collapsed" data-toggle="collapse" data-parent="#filters" href="#description" aria-expanded="false">
								<div class="panel-heading posRel history_panel">
									<h3 class="panel-title"><span class="glyphicon glyphicon-chevron-down downAccordion"></span>
										История <span class="badge"> 15</span>
									</h3>                             
								</div>
							</a>
							<div id="description" class="panel-collapse collapse" aria-expanded="true">
								<div class="history_candidate comentators_block">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Действие</th>
												<th>Время</th>
											</tr>
										</thead>
										<tbody>
										
											<tr>
												<td>1</td>
												<td>Пользователь Ярослав отредактировал кандидата Ivan Chernov</td>
												<td>2016-02-18 16:53:15</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Кандидат определен на вакансию - Mid to Sr.</td>
												<td>2016-02-18 21:23:15</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Кандидат определен на вакансию - Sr.</td>
												<td>2016-02-18 21:23:15</td>
											</tr>
											<tr>
												<td>4</td>
												<td>Кандидат определен на вакансию - Mid to Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Кандидат определен на вакансию - Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>6</td>
												<td>Кандидат определен на вакансию - Mid to Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>7</td>
												<td>Кандидат определен на вакансию - Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>8</td>
												<td>Кандидат определен на вакансию - Mid to Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>9</td>
												<td>Кандидат определен на вакансию - Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>10</td>
												<td>Кандидат определен на вакансию - Mid to Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>11</td>
												<td>Кандидат определен на вакансию - Sr.</td>
												<td>2016-02-18 21:23:24</td>
											</tr>
											<tr>
												<td>12</td>
												<td>Пользователь Ярослав отредактировал кандидата Ivan Chernov</td>
												<td>2016-02-19 13:28:26</td>
											</tr>
											<tr>
												<td>13</td>
												<td>Пользователь Ярослав отредактировал кандидата Ivan Chernov</td>
												<td>2016-02-19 13:28:45</td>
											</tr>
											<tr>
												<td>14</td>
												<td>Кандидат определен на вакансию - Sr.</td>
												<td>2016-02-19 13:43:16</td>
											</tr>
											<tr>
												<td>15</td>
												<td>Кандидат определен на вакансию - Mid to Sr.</td>
												<td>2016-02-25 13:53:47</td>
											</tr>										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>






				</div>
			</div>
		</div>
	</div>








<?php $this->load->view('footer'); ?>