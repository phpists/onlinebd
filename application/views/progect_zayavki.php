<?php $this->load->view('header'); ?>

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