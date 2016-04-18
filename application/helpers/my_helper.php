<?php


function get_image($src){
	return base_url().'images/'.$src;
}

function get_image_menu($img){
	return base_url().'images/menu/'.$img;
}


function date_convert($date){
	return date('d.m.Y', strtotime($date));
}

// побудова списка select з вибраним елементом (по id)
function select_sel($a, $b=''){
	if($b) {
		foreach ($a->result() as $row) {
			if($row->id == $b) {
				echo '<option value="'.$row->id.'" selected="selected">'.$row->nazva.'</option>';
			} else {
				echo '<option value="'.$row->id.'">'.$row->nazva.'</option>';
			}
		}
	} else {
		foreach ($a->result() as $row) {
			echo '<option value="'.$row->id.'">'.$row->nazva.'</option>';
		}
	}
}

function select_sel_one($a, $b=''){
	if($b) {
		foreach ($a->result() as $row) {
			if($row->id == $b) {
				echo '<option value="'.$row->id.'" selected="selected">'.$row->nazva.'</option>';
			}
		}
	} 
}


// побудова списка select з вибраним елементом (по значенню)
function select_sel_val($a, $b=''){
	if($b) {
		foreach ($a->result() as $row) {
			if($row->nazva == $b) {
				echo '<option value="'.$row->id.'" selected="selected">'.$row->nazva.'</option>';
			} else {
				echo '<option value="'.$row->id.'">'.$row->nazva.'</option>';
			}
		}
	} else {
		foreach ($a->result() as $row) {
			echo '<option value="'.$row->id.'">'.$row->nazva.'</option>';
		}
	}
}

function show_message() {
	$CI =& get_instance();
	if($CI->session->flashdata('save')) {
		echo '
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>'.$CI->session->flashdata('save').'</strong>
			</div>';
	}
}

function mb_ucfirst($text) {
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

function cut_words($text, $start, $finish){
	if(strlen($text) > $finish)
		return mb_substr($text, $start, $finish) . "...";
	return $text;
}



function getConversion($leads, $transits, $isTrue = true){
	if(($transits < 100) && $isTrue)
		return "<span class='text-warning'>new</span>";
	if($leads == 0 || $transits == 0)
		return "0.00";
	$result = ($leads / $transits) * 100;
	return round($result, 2) . "%";
}

function getEPC($profit, $transits, $isTrue = true){
	if($transits < 100 && $isTrue)
		return "<span class='text-warning'>new</span>";
	if($profit == 0 || $transits == 0)
		return "0.00";
	return round( ($profit/$transits), 2 );
}

//Вовзращает строку денег в виде 8'000'000 (8 миллионов)
function getNormalMoney($money = 0, $with = true){
	if(!$money)
		return 0;
	if($with)
		return number_format($money, 2, '.', ", ");
	else
		return number_format($money);
}

//Процент подтверждения заявок
function getProcentRequests($trueRequests = 0, $falseRequests = 0){
	if(!$trueRequests)
		return 0;
	return round( ($trueRequests * 100) / ($falseRequests + $trueRequests), 2 );
	
}









function normal_time($time){
	
	$month_name = 
	    array( 1 => 'января',
		   2 => 'февраля',
		   3 => 'марта',
		   4 => 'апреля',
		   5 => 'мая',
		   6 => 'июня',
		   7 => 'июля',
		   8 => 'августа',
		   9 => 'сентября',
		   10 => 'октября',
		   11 => 'ноября',
		   12 => 'декабря'
	);

	$month = $month_name[ date( 'n',$time ) ];

	$day   = date( 'j',$time );
	$year  = date( 'Y',$time );
	$hour  = date( 'G',$time );
	$min   = date( 'i',$time );

	$date = $day . ' ' . $month . ' ' . $year . ' г. в ' . $hour . ':' . $min;

	$dif = time()- $time;

	if($dif<59){
	    return $dif." сек. назад";
	}elseif($dif/60>1 and $dif/60<59){
	    return round($dif/60)." мин. назад";
	}elseif($dif/3600>1 and $dif/3600<23){
	    return round($dif/3600)." час. назад";
	}else{
	    return $date;
	}
}

function date_helper($date, $type = 1) {
	
	if($date != null) {
		if($type == 1) {
			return date('d.m.Y H:i', strtotime($date));
		}
		elseif($type == 2) {
			switch(date('m', strtotime($date))) {
				case "01": $m = "января"; break;
				case "02": $m = "февраля"; break;
				case "03": $m = "марта"; break;
				case "04": $m = "апреля"; break;
				case "05": $m = "мая"; break;
				case "06": $m = "июня"; break;
				case "07": $m = "июля"; break;
				case "08": $m = "августа"; break;
				case "09": $m = "сентября"; break;
				case "10": $m = "октября"; break;
				case "11": $m = "ноября"; break;
				case "12": $m = "декабря"; break;
				default: $m = "";
			}
			
			if(date('Y', strtotime($date)) == date('Y')) {
				if(date('d', strtotime($date)) == date('d')) {
					return date('сегодня в H:i', strtotime($date));
				}				
				else {
					return date('d '.$m.' в H:i', strtotime($date));
				}
			}
			else {
				return date('d '.$m.' y года', strtotime($date));
			}
		}
		elseif($type == 3) {
			return date('d.m.Y', strtotime($date));
		}
	}
	else {
		return "неизвестно";
	}
}


// генерация списка дат наперед
function gen_cal() {
	for($i=1;$i<=14;$i++){
		echo date('D, M d Y', time()+$i*24*60*60);
	}
}






# Число прописью
function num_propis($num){ // $num - цело число

# Все варианты написания чисел прописью от 0 до 999 скомпануем в один небольшой массив
 $m=array(
  array('ноль'),
  array('-','один','два','три','четыре','пять','шесть','семь','восемь','девять'),
  array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'),
  array('-','-','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'),
  array('-','сто','двести','триста','четыреста','пятьсот','шестьсот','семьсот','восемьсот','девятьсот'),
  array('-','одна','две')
 );

# Все варианты написания разрядов прописью скомпануем в один небольшой массив
 $r=array(
  array('...ллион','','а','ов'), // используется для всех неизвестно больших разрядов 
  array('тысяч','а','и',''),
  array('миллион','','а','ов'),
  array('миллиард','','а','ов'),
  array('триллион','','а','ов'),
  array('квадриллион','','а','ов'),
  array('квинтиллион','','а','ов')
  // ,array(... список можно продолжить
 );

 if($num==0)return$m[0][0]; # Если число ноль, сразу сообщить об этом и выйти
 $o=array(); # Сюда записываем все получаемые результаты преобразования

# Разложим исходное число на несколько трехзначных чисел и каждое полученное такое число обработаем отдельно
 foreach(array_reverse(str_split(str_pad($num,ceil(strlen($num)/3)*3,'0',STR_PAD_LEFT),3))as$k=>$p){
  $o[$k]=array();

# Алгоритм, преобразующий трехзначное число в строку прописью
  foreach($n=str_split($p)as$kk=>$pp)
  if(!$pp)continue;else
   switch($kk){
    case 0:$o[$k][]=$m[4][$pp];break;
    case 1:if($pp==1){$o[$k][]=$m[2][$n[2]];break 2;}else$o[$k][]=$m[3][$pp];break;
    case 2:if(($k==1)&&($pp<=2))$o[$k][]=$m[5][$pp];else$o[$k][]=$m[1][$pp];break;
   }$p*=1;if(!$r[$k])$r[$k]=reset($r);

# Алгоритм, добавляющий разряд, учитывающий окончание руского языка
  if($p&&$k)switch(true){
   case preg_match("/^[1]$|^\\d*[0,2-9][1]$/",$p):$o[$k][]=$r[$k][0].$r[$k][1];break;
   case preg_match("/^[2-4]$|\\d*[0,2-9][2-4]$/",$p):$o[$k][]=$r[$k][0].$r[$k][2];break;
   default:$o[$k][]=$r[$k][0].$r[$k][3];break;
  }$o[$k]=implode(' ',$o[$k]);
 }
 
 return implode(' ',array_reverse($o));
}




function json_encode_cyr($str) {
	$arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
	'\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
	'\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
	'\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
	'\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
	'\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
	'\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
	'\u042d','\u044d','\u042e','\u044e','\u042f','\u044f');
	$arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
	'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
	'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
	'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я');
	$str1 = json_encode($str);
	$str2 = str_replace($arr_replace_utf,$arr_replace_cyr,$str1);
	return $str2;
}


// Удаляет из массива все элементы значения которых равны искомому, 
// и так же не обладает проблемой с удалением первых элементов массива.
/*
	while (checkArraySearch($value_for_search, $array)) {
		unset($array[array_search($value_for_search, $array)]);
	}
*/
function checkArraySearch($value_for_search, $array)
{
    if (array_search($value_for_search, $array) !== FALSE) {
        return true;
    } else {
        return false;
    }
}




function any_in_array($needle, $haystack)
{
        $needle = is_array($needle) ? $needle : array($needle);

        foreach ($needle as $item)
        {
                if (in_array($item, $haystack))
                {
                        return TRUE;
                }
        }

        return FALSE;
}





