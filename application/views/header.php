<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRM управление складом</title>
	<!-- Bootstrap -->
	<link href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/style.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
			<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
			<script src="<? echo base_url() ?>application/views/js/jquery.js"></script>
			<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap.min.js"></script>
			<!-- dataTables -->
			<link href="<? echo base_url() ?>application/views/DataTables-1.10.9/css/dataTables.bootstrap.min.css" rel="stylesheet">
			<script src="<? echo base_url() ?>application/views/DataTables-1.10.9/js/jquery.dataTables.min.js"></script>  
			<script src="<? echo base_url() ?>application/views/DataTables-1.10.9/js/dataTables.bootstrap.min.js"></script>
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<a class="navbar-brand" href="<? echo site_url() ?>">CRM управление складом</a>
					 	</div>
						 <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<? if($this->session->userdata('user_role')==1) { ?>
								<ul class="nav navbar-nav">
	 								<li <? if($this->uri->segment(2, '') == "companies") echo 'class="active"'; ?>><a href="<? echo site_url("main/companies") ?>">Компании</a></li>
	 								<li <? if($this->uri->segment(2, '') == '' or $this->uri->segment(2, '') == "index") echo 'class="active"'; ?>><a href="<? echo site_url("main/index") ?>">Проекты</a></li>
	 								<li <? if($this->uri->segment(2, '') == "users") echo 'class="active"'; ?>><a href="<? echo site_url("main/users") ?>">Пользователи</a></li>
	 								<li <? if($this->uri->segment(2, '') == "zayavki") echo 'class="active"'; ?>><a href="<? echo site_url("main/zayavki") ?>">Заявка на отгрузку / приход</a></li>
	 								<li <? if($this->uri->segment(2, '') == "uslugi") echo 'class="active"'; ?>><a href="<? echo site_url("main/uslugi") ?>">Услуги</a></li>
	 							</ul> 
<? } else { ?>
								<ul class="nav navbar-nav">
	 								<li <? if($this->uri->segment(2, '') == '' or $this->uri->segment(2, '') == "index") echo 'class="active"'; ?>><a href="<? echo site_url("main/index") ?>">Проекты</a></li>
	 								<li <? if($this->uri->segment(2, '') == "zayavki") echo 'class="active"'; ?>><a href="<? echo site_url("main/zayavki") ?>">Заявка на отгрузку / приход</a></li>
	 							</ul> 
<? } ?>
								<ul class="nav navbar-nav navbar-right">
									<li><a href="#">Привет <b><? echo $this->session->userdata('user_name') ?></b></a></li>
									<li><a href="<? echo site_url("main/exit") ?>">Выйти <span class="glyphicon glyphicon-log-out"></span></a></li>
								</ul>
							</div><!-- /.navbar-collapse -->
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</div>  	
				</div><!-- /.container-fluid -->
			</nav>

<script type="text/javascript">
$(document).ready(function(){
	$('#example').dataTable({
		//"bFilter": false,
		//"bPaginate": false,
		"bInfo": false,
		//"order": [[ 3, "desc" ]]
		"language": {
			"url": "<? echo base_url() ?>application/views/DataTables-1.10.9/dataTables.rus.lang"
		}
	});
});
</script>