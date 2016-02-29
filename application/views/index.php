<?php $this->load->view('header'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$('.detail').click(function(){
		$('#edit_progect').attr('href', '/main/edit_progect/'+$(this).attr("progect_id"));
		$('#products').attr('href', '/main/products/'+$(this).attr("progect_id"));
		$.ajax({
			type: "POST",
			url: "/ajax/ajax_get_progect_detail",
			data: { 
				"id": $(this).attr("progect_id"),
			},
			dataType: "html",
			success: function(msg){
				$("#progect_detail").html(msg);
			}
		});
		$('#myModal4').modal('show');
		return false;
	});	




});
</script>



<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Проекты</div>
				<div class="panel-body">
	
	
						<table class="table table-bordered" id="example">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Название</center></th>
									<th><center>Компания</center></th>
									<th><center>ТМЦ</center></th>
									<th><center>Дата создания</center></th>
									<th><center>Сроки</center></th>
									<!-- <th><center>Статус</center></th> -->
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
									<td><a href="#" class="detail" progect_id="'.$row->id.'">'.$row->nazva.'</a></td>
									<td>'.$row->company.'</td>
									<td><center>('.anchor("main/products/".$row->id, $row->cnt).')</center></td>
									<td><center>'.$row->date_create.'</center></td>
									<td><center>'.$row->sroki.'</center></td>
									<!--<td><center></center></td>-->
									<td><center>
										<a href="'.site_url("main/edit_progect/".$row->id).'"><img src="'.base_url().'application/views/img/pencil.png"></a>&nbsp;&nbsp;&nbsp;
										<a href="'.site_url("main/edit_progect/".$row->id).'"><img src="'.base_url().'application/views/img/validno.png"></a>
									</center></td>
								</tr>';
	}
	?>

							</tbody>
						</table>

						<a class="btn btn-success" href="/main/add_progect"><i class="glyphicon glyphicon-plus"></i> Добавить проект</a>


				</div>
			</div>
		</div>
	</div>






<!-- Modal4 -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Детали проекта</h4>
			</div>
			<div class="modal-body" id="progect_detail">
				<!-- result	-->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-warning" id="edit_progect"><i class="glyphicon glyphicon-pencil"></i> Изменить</a>
				<a href="#" class="btn btn-primary" id="products"><i class="glyphicon glyphicon-file"></i> Товар</a>
				<a href="#" class="btn btn-default" data-dismiss="modal">Закрыть</a>
			</div>
		</div>
	</div>
</div>
<!-- Modal4 -->





<?php $this->load->view('footer'); ?>