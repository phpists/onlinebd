<?php $this->load->view('header'); ?>

<!-- datetimepicker -->
<script src="<? echo base_url() ?>application/views/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<? echo base_url() ?>application/views/bootstrap-3.3.5/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/bootstrap-3.3.5/css/bootstrap-datetimepicker.css" />
<!-- datetimepicker end -->
<!-- jQuery Masked Input Plugin -->
<script src="<? echo base_url() ?>application/views/js/jquery.maskedinput.js"></script>

<!-- jQuery Autocomplete -->
<script src="<? echo base_url() ?>application/views/js/autocomplete/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<? echo base_url() ?>application/views/js/autocomplete/jquery-ui.min.css" />

<script type="text/javascript">

    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];



$(document).ready(function(){

	$("input[name=tel]").mask("(999) 999-99-99");

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		locale: 'ru'
	});

	var i=1;
	// $('#add_tmc').click(function(){
	// 	//$("#example1").find('tr:last').css('background-color', '#d9534f');
	// 	last_row = $("#example1").find('tr:last').find('input:first');
	// 	if(last_row.val()=='') {
	// 		last_row.css('border-color', '#d9534f');
	// 	} else {
	// 		i++;
	// 		//$("#example1 > tbody").append('<tr><td><center>'+i+'</center></td><td><input class="form-control" type="text" name="nazva[]"></td><td><input class="form-control" type="text" name="artikl[]"></td><td><select name="edinica_izm[]" class="form-control"><option value="упаковка">упаковка</option><option value="шт">шт</option><option value="ед">ед.</option><option value="коробка">коробка</option><option value="паллет">паллет</option></select></td><td><input class="form-control" type="number" min="1" value="1" name="kilk[]"></td><td><center><a href="#" class="del_item"><img src="<? echo base_url() ?>application/views/img/validno.png"></a></center></td></tr>');
	// 		$("#example1 > tbody").append('<tr><td><center>'+i+'</center></td><td><input class="form-control nazva_tmc" type="text" name="nazva[]"></td><td><input class="form-control" type="text" name="opus[]"></td><td><select name="edinica_izm[]" class="form-control"><option value="упаковка">упаковка</option><option value="шт">шт</option><option value="ед">ед.</option><option value="коробка">коробка</option><option value="паллет">паллет</option></select></td><td><input class="form-control" type="number" min="1" value="1" name="kilk[]"></td><td><center><a href="#" class="del_item"><img src="<? echo base_url() ?>application/views/img/validno.png"></a></center></td></tr>');
	// 	}
	// 	return false;
	// });

	$(document).on('click', '.del_item', function(event){
		$(this).parent().parent().parent().remove();
		return false;
	});

	$("#radios-0").click(function(event) {
		$("[name=progect_id]").show();
		$("[name=nazva_progect]").hide();
	});

	$("#radios-1").click(function(event) {
		$("[name=progect_id]").hide();
		$("[name=nazva_progect]").show();
	});


	$('#create').click(function(){
		if($("[name=progect_id]").val()!='' || $("[name=nazva_progect]").val()!='') {
			if($("[name=fio]").val()!='') {
				$.post("/ajax/create_zayavka_prihod", $("#form_add_zayavka").serialize()).done(function(data) {
					//alert(data);
					alert("Заявка добавлена!");
					window.location = "/main/zayavki";
				});
			} else {
				$("[name=fio]").css('border-color', '#d9534f');
			}
		} else {
			$('#mess_error').show("slow").delay(2000).fadeOut();
		}
	});

// спрацьовує перший раз
    // $( ".nazva_tmc" ).autocomplete({
    //   source: availableTags
    // });	



$(".nazva_tmc").autocomplete({
      	source: '/ajax/ajax_autocomplete_tmc',
        //minLength: 2,
        select: function(event, ui) {
        	$(this).val(ui.item.value);
        	$(this).parent().next().children('input').val(ui.item.id);
        

        //     var url = ui.item.id;
	       //  log( ui.item ?
	       //    "Selected: " + ui.item.label :
	       //    "Nothing selected, input was " + this.value);

	    },
 
        // html: true, // optional (jquery.ui.autocomplete.html.js required)
 
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
    });





});

var i=1;

function add_tmc(){
	//$("#example1").find('tr:last').css('background-color', '#d9534f');
	last_row = $("#example1").find('tr:last').find('input:first');
	if(last_row.val()=='') {
		last_row.css('border-color', '#d9534f');
	} else {
		i++;
		$("#example1 > tbody").append('<tr><td><center>'+i+'</center></td><td><input class="form-control nazva_tmc" type="text" name="nazva[]"></td><td><input class="form-control" type="text" name="opus[]"></td><td><select name="edinica_izm[]" class="form-control"><option value="упаковка">упаковка</option><option value="шт">шт</option><option value="ед">ед.</option><option value="коробка">коробка</option><option value="паллет">паллет</option></select></td><td><input class="form-control" type="number" min="1" value="1" name="kilk[]"></td><td><center><a href="#" class="del_item"><img src="<? echo base_url() ?>application/views/img/validno.png"></a></center></td></tr>');
	
		// $( ".nazva_tmc" ).autocomplete({
		// 	source: availableTags
		// });


// ajax_autocomplete_tmc



/*    $( ".nazva_tmc" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "http://gd.geobytes.com/AutoCompleteCity",
          dataType: "jsonp",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
            //alert(data);
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.label :
          "Nothing selected, input was " + this.value);
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });*/

/*
$(".nazva_tmc").autocomplete({
        source: '/ajax/ajax_autocomplete_tmc',
        select: function (b, a) {
        log( ui.item ?
          "Selected: " + ui.item.label :
          "Nothing selected, input was " + this.value);
        }
    }).focus().data('ui-autocomplete')._renderItem = function (b, a) {
        // append = "";
        // if (a.make != null) {
        //     append = " - " + a.make;
        // }
       // return $('<li>').append('<a>1212121212 ' + a.nazva +  '</a>').appendTo(b)
    }

*/

$(".nazva_tmc").autocomplete({
      	source: '/ajax/ajax_autocomplete_tmc',
        //minLength: 2,
        select: function(event, ui) {
        	$(this).val(ui.item.id);
        //     var url = ui.item.id;
	       //  log( ui.item ?
	       //    "Selected: " + ui.item.label :
	       //    "Nothing selected, input was " + this.value);

	    },
 
        // html: true, // optional (jquery.ui.autocomplete.html.js required)
 
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
    });




/*			$(".nazva_tmc").autocomplete({
				//delay: 500,
				//minLength: 3,
				source: function(request, response) {
					$.getJSON("http://api.rottentomatoes.com/api/public/v1.0/movies.json?callback=?", {
						// do not copy the api key; get your own at developer.rottentomatoes.com
						apikey: "6czx2pst57j3g47cvq9erte5",
						q: request.term,
						page_limit: 10
					}, function(data) {
						// data is an array of objects and must be transformed for autocomplete to use
						var array = data.error ? [] : $.map(data.movies, function(m) {
							return {
								label: m.title + " (" + m.year + ")",
								url: m.links.alternate
							};
						});
						response(array);
					});
				},
				focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
				},
				select: function(event, ui) {
					$(this).val(ui.item.url);
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// navigate to the selected item's url
					//window.open(ui.item.url);
				}
			});*/





	}
	return false;
}


</script>

<div class="container-fluid" style="margin-top: 55px;">
	<div class="row">
		<div class="col-md-12 col-sm-12">

			<div class="panel panel-default">
				<div class="panel-heading"><? echo $title ?></div>
				<div class="panel-body">
	
<form class="form-horizontal" id="form_add_zayavka" method="POST" action="/main/test">
<fieldset>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Дата отгрузки/ время отгрузки:</label>  
	  <div class="col-md-4">
	  <input name="date_otgruzki" class="form-control input-md datepicker" type="text" value="<? echo @$main->nazva ?>">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">ФИО кто привезет:</label>  
	  <div class="col-md-4">
	  <input name="fio" class="form-control input-md" type="text">
	  </div>
	</div>	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">Номер телефона:</label>  
		<div class="col-md-4">
			<div class="input-group">
				<input name="tel" class="form-control input-md" type="text" value="<? echo @$main->tel ?>">
				<span class="input-group-addon"><span class="glyphicon glyphicon-phone"> </span></span>
			</div>
		</div>
	</div>	

	<!-- Text input
	<div class="form-group">
	  <label class="col-md-4 control-label">Дата забора:</label>  
	  <div class="col-md-4">
	  <input name="sroki" class="form-control input-md" type="text" value="">
	  </div>
	</div>-->	

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label">№авто:</label>  
	  <div class="col-md-4">
	  <input name="nom_avto" class="form-control input-md" type="text" value="<? echo @$main->nom_avto ?>">
	  </div>
	</div>	

	<!-- Textarea -->
	<div class="form-group">
	  <label class="col-md-4 control-label">Комментарий:</label>
	  <div class="col-md-4">
		<textarea rows="3" class="form-control" name="comment"><? echo @$main->comment ?></textarea>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <div class="col-md-4 control-label">
		<label for="radios-0"><input name="radios" id="radios-0" value="1" checked="checked" type="radio"> Существующий проект</label>&nbsp;&nbsp;&nbsp;
		<label for="radios-1"><input name="radios" id="radios-1" value="2" type="radio"> Новый проект</label>
	  </div>  
	  <div class="col-md-4">
		<select name="progect_id" class="form-control">
			<option value="">Выберите проект</option>
			<?php select_sel($progects); ?>
		</select>
		 <input name="nazva_progect" class="form-control input-md" type="text" style="display:none" placeholder="Название">
	  </div>
	</div>

	<table class="table table-bordered" id="example1">
		<thead>
			<tr>
				<th><center>#</center></th>
				<th><center>Название</center></th>
				<th><center>Описание</center></th>
				<th><center>Един. измер</center></th>
				<th><center>Количество</center></th>
				<th><center>#</center></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><center>1</center></td>
				<td><input class="form-control nazva_tmc" type="text" name="nazva[]"></td>
				<td><input class="form-control" type="text" name="opus[]"></td>
				<td>
					<select name="edinica_izm[]" class="form-control">
						<option value="упаковка">упаковка</option>
						<option value="шт">шт</option>
						<option value="ед">ед.</option>
						<option value="коробка">коробка</option>
						<option value="паллет">паллет</option>
					</select>
				</td>
				<td><input class="form-control" type="number" name="kilk[]" min="1" value="1"></td>
				<td><center><a href="#" class="del_item"><img src="<? echo base_url() ?>application/views/img/validno.png"></a></center></td>
			</tr>
		</tbody>
	</table>
<!-- <input type="submit" value="ok"> -->
</fieldset>
</form>	
	
	<a class="btn btn-success" href="#" id="add_tmc" onclick="add_tmc()"><i class="glyphicon glyphicon-plus"></i> Добавить ТМЦ</a>


	<div class="row">
		<div class="col-md-12">
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="button1id"> </label>
			  <div class="col-md-4">
				<a href="#" class="btn btn-success" id="create"><i class="glyphicon glyphicon-ok"></i> Создать</a>
				<a href="/main/zayavki" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Отмена</a>		
			  </div>
			</div>	
		</div>
	</div>

	<div class="col-md-12">
		<div class="row" style="padding-top:10px; display:none;" id="mess_error">
			<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Выберете проект или введите название!</div>
		</div>
	</div>

							

				</div>
			</div>

		</div>
	</div>




<?php $this->load->view('footer'); ?>