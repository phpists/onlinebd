<?php $this->load->view('header'); ?>


<div class="container-fluid my_container">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading">Заявки на отгрузку /приход</div>
				<div class="panel-body">
	
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tab_otgruzka" data-toggle="tab">Отгрузка</a></li>
						  <li><a href="#tab_prihod" data-toggle="tab">Приход</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active" id="tab_otgruzka">
							<br>
							<div class="btn-group pull-right data">
								<!--<button type="button" class="btn btn-primary show_company" filtr="active">Активные</button>
								<button type="button" class="btn btn-default show_company" filtr="all">Все</button>-->
								<a href="/main/add_zayavka" class="btn btn-success" title="Создать заявку"><i class="glyphicon glyphicon-plus"></i> Создать заявку</a>
							</div>
							<br><br>

								<table class="table table-bordered" id="example2">
									<thead>
										<tr>
											<th><center>#</center></th>
											<th><center>Проект</center></th>
											<th><center>Дата отгрузки</center></th>
											<th><center>ФИО кто забирает</center></th>
											<th><center>Телефон</center></th>
											<th><center>Статус</center></th>
											<th><center>#</center></th>
										</tr>
									</thead>
									<tbody>
							<?php 
							$a=1;
							foreach ($rashod->result() as $row) { 
								echo '
										<tr>
											<td><center>'.$a++.'</center></td>
											<td>'.anchor("main/zayavka/".$row->id, $row->nazva_progect).'</td>
											<td><center>'.$row->date_otgruzki.'</center></td>
											<td><center>'.$row->fio.'</center></td>
											<td><center>'.$row->tel.'</center></td>
											<td><center>';
											if($row->status==1) echo "В обработке";
											if($row->status==2) echo "В ожидании";
											if($row->status==0) echo "Отгружено";
										echo '</center></td>
											<td><center>
												<a href="/main/zayavka/'.$row->id.'" class="btn btn-warning btn-sm" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="/php_excel/export.php?id='.$row->id.'&type=0" class="btn btn-primary btn-sm" title="Печать"><span class="glyphicon glyphicon-print"></span></a>
												<a href="#" class="btn btn-danger btn-sm" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>
											</center></td>
										</tr>';
							}
							?>

									</tbody>
								</table>

	  					  </div>
			  			  <div class="tab-pane" id="tab_prihod">
							<br>
							<div class="btn-group pull-right data">
								<!--<button type="button" class="btn btn-primary show_company" filtr="active">Активные</button>
								<button type="button" class="btn btn-default show_company" filtr="all">Все</button>-->
								<a href="/main/add_zayavka_prihod" class="btn btn-success" title="Создать заявку"><i class="glyphicon glyphicon-plus"></i> Создать заявку</a>
							</div>
							<br><br>

								<table class="table table-bordered">
									<thead>
										<tr>
											<th><center>#</center></th>
											<th><center>Проект</center></th>
											<th><center>Дата отгрузки</center></th>
											<th><center>ФИО кто забирает</center></th>
											<th><center>Телефон</center></th>
											<th><center>Статус</center></th>
											<th><center>#</center></th>
										</tr>
									</thead>
									<tbody>
							<?php 
							$a=1;
							foreach ($prihod->result() as $row) { 
								echo '
										<tr>
											<td><center>'.$a++.'</center></td>
											<td>'.anchor("main/zayavka/".$row->id, $row->nazva_progect).'</td>
											<td><center>'.$row->date_otgruzki.'</center></td>
											<td><center>'.$row->fio.'</center></td>
											<td><center>'.$row->tel.'</center></td>
											<td><center>';
											if($row->status==1) echo "В обработке";
											if($row->status==2) echo "В ожидании";
											if($row->status==0) echo "Отгружено";
										echo '


<div class="btn-group responsible_vacancy open">
<button class="btn btn-link dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="true">Review</button>
<ul class="dropdown-menu">
<li>
<a class="change_status_v_to_c" data-title="Review" data-id="116" href="#">Review</a>
</li>
<li>
<li>
<li>
<li>
<li>
<li>
</ul>
</div>


										</center></td>
											<td><center>
												<a href="/main/zayavka/'.$row->id.'" class="btn btn-warning btn-sm" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="/php_excel/export.php?id='.$row->id.'&type=1" class="btn btn-primary btn-sm" title="Печать"><span class="glyphicon glyphicon-print"></span></a>
												<a href="#" class="btn btn-danger btn-sm" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>
											</center></td>
										</tr>';
							}
							?>

									</tbody>
								</table>		


						  </div>
						</div>

				</div>
			</div>
		</div>
	</div>








<?php $this->load->view('footer'); ?>