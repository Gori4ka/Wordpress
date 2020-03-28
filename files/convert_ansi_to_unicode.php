<?php 

$ansi = [];
$unicode = [];

function utf8_ord($ch) {
	$len = strlen($ch);
	if($len <= 0) return false;
	$h = ord($ch{0});
	if ($h <= 0x7F) return $h;
	if ($h < 0xC2) return false;
	if ($h <= 0xDF && $len>1) return ($h & 0x1F) <<  6 | (ord($ch{1}) & 0x3F);
	if ($h <= 0xEF && $len>2) return ($h & 0x0F) << 12 | (ord($ch{1}) & 0x3F) << 6 | (ord($ch{2}) & 0x3F);          
	if ($h <= 0xF4 && $len>3) return ($h & 0x0F) << 18 | (ord($ch{1}) & 0x3F) << 12 | (ord($ch{2}) & 0x3F) << 6 | (ord($ch{3}) & 0x3F);
	return false;
}

function utf8_charAt($str, $num) {
	return mb_substr($str, $num, 1, 'UTF-8');               //charAt  java
  }

function charCodeAt($str, $num) { 
	return utf8_ord(utf8_charAt($str, $num));               //charCodeAt  java
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////

function fontUnicode($ansi, $unicode, $code){                //fromCharCode java
	if(in_array($code, $ansi)){
		$key = array_search($code, $ansi);
		$value = $unicode[$key];
		return mb_convert_encoding($value, "UTF-8");
	}
		else {
			return $code;
		}
	
	
}



//////////////////*//////////////////////////////////////////////

function post($str, $ansi, $unicode){
    $st = "";
	for($i = 0; $i < strlen($str); $i++){
		$code = charCodeAt($str, $i);
		if(fontUnicode($ansi, $unicode, $code) != ''){

			if($code < 163){
				$st = $st.chr($code);
			}
			else{
				$st = $st.fontUnicode($ansi, $unicode, $code);
			}

			}
		}

	return $st;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

array_push($unicode, "Ա");  array_push($unicode, "ա");  array_push($unicode, "Բ");  array_push($unicode, "բ");
array_push($unicode, "Գ");  array_push($unicode, "գ");  array_push($unicode, "Դ");  array_push($unicode, "դ");
array_push($unicode, "Ե");  array_push($unicode, "ե");  array_push($unicode, "Զ");  array_push($unicode, "զ");
array_push($unicode, "Է");  array_push($unicode, "է");  array_push($unicode, "Ը");  array_push($unicode, "ը");
array_push($unicode, "Թ");  array_push($unicode, "թ");  array_push($unicode, "Ժ");  array_push($unicode, "ժ");
array_push($unicode, "Ի");  array_push($unicode, "ի");  array_push($unicode, "Լ");  array_push($unicode, "լ");
array_push($unicode, "Խ");  array_push($unicode, "խ");  array_push($unicode, "Ծ");  array_push($unicode, "ծ");
array_push($unicode, "Կ");  array_push($unicode, "կ");  array_push($unicode, "Հ");  array_push($unicode, "հ");
array_push($unicode, "Ձ");  array_push($unicode, "ձ");  array_push($unicode, "Ղ");  array_push($unicode, "ղ");
array_push($unicode, "Ճ");  array_push($unicode, "ճ");  array_push($unicode, "Մ");  array_push($unicode, "մ");
array_push($unicode, "Յ");  array_push($unicode, "յ");  array_push($unicode, "Ն");  array_push($unicode, "ն");
array_push($unicode, "Շ");  array_push($unicode, "շ");  array_push($unicode, "Ո");  array_push($unicode, "ո");
array_push($unicode, "Չ");  array_push($unicode, "չ");  array_push($unicode, "Պ");  array_push($unicode, "պ");
array_push($unicode, "Ջ");  array_push($unicode, "ջ");  array_push($unicode, "Ռ");  array_push($unicode, "ռ");
array_push($unicode, "Ս");  array_push($unicode, "ս");  array_push($unicode, "Վ");  array_push($unicode, "վ");
array_push($unicode, "Տ");  array_push($unicode, "տ");  array_push($unicode, "Ր");  array_push($unicode, "ր");
array_push($unicode, "Ց");  array_push($unicode, "ց");  array_push($unicode, "Ւ");  array_push($unicode, "ւ");
array_push($unicode, "Փ");  array_push($unicode, "փ");  array_push($unicode, "Ք");  array_push($unicode, "ք");
array_push($unicode, "Օ");  array_push($unicode, "օ");  array_push($unicode, "Ֆ");  array_push($unicode, "ֆ");


for($i = 178; $i <= 252; $i+=2){
	array_push($ansi, $i); // mecatar ansi
	array_push($ansi, $i+1); //poqratar ansi
}

	array_push($ansi, 168);   array_push($unicode, chr(45)); // gcik
	array_push($ansi, 39);    array_push($unicode, '՚'); //apostrov
	array_push($ansi, 176);   array_push($unicode, '՛'); //shesht
	array_push($ansi, 175);   array_push($unicode, '՜'); //bacakanchakan
	array_push($ansi, 170);   array_push($unicode, '՝'); //but
	array_push($ansi, 177);   array_push($unicode, '՞'); //harcakan
	array_push($ansi, 163);   array_push($unicode, '։'); //verjaket
	array_push($ansi, 173);   array_push($unicode, '֊'); //
	array_push($ansi, 167);   array_push($unicode, '«'); //bacvox chakert
	array_push($ansi, 166);   array_push($unicode, '»'); //pakvox chakert
	array_push($ansi, 171);   array_push($unicode, chr(44)); //storaket
	array_push($ansi, 169);   array_push($unicode, chr(46)); //mijaket
	array_push($ansi, 174);   array_push($unicode, '…'); //bazmaket
	array_push($ansi, 165);   array_push($unicode, chr(40)); //bacvox pakagic
	array_push($ansi, 164);   array_push($unicode, chr(41)); //pakvox pakagic

	/////////////////////////////////////  post title  ///////////////////////////////////////////////////////

function Title($file, $ansi, $unicode){
	if(file_exists($file)){
		$file = fopen($file, 'r');
		$title = "";
			while (!feof($file)) {
				$str = iconv("Windows-1252", "UTF-8", fgets($file));
				if(strpos($str, "cap") !==false ){
					$title = post(strip_tags($str), $ansi, $unicode);
					
				}
				
			}
			$title = preg_replace("/[\r\n]+/m"," ", $title);
			$title = preg_replace("/(april1)|(aravot\s\w+\s\w+)|(\w+\s\w+\saravot)|(\w+\sdaily)|(aravot)|(\d{1,2}\s[a-z]+\s\d{4})/i", "", $title);
			$title = str_replace("&nbsp;", "", $title);
			$title = str_replace("&#160;", "", $title);
			$title = str_replace("&nb;", "", $title);
			return $title;
		fclose($file);
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////

function read($file, $ansi, $unicode){
	if(file_exists($file)){
		$file = fopen($file, 'r');
		$text = "";
			while (!feof($file)) {
				$str = iconv("Windows-1252", "UTF-8", fgetss($file));
				//$text =  $text . post(str_replace("charset=x-user-defined", "charset=UTF-8", $str), $ansi, $unicode);
				$text =  $text . post($str, $ansi, $unicode);
			}

			$text = preg_replace("/(april1)|(aravot\s\w+\s\w+)|(\w+\s\w+\saravot)|(\w+\sdaily)|(aravot)|(\d{1,2}\s[a-z]+\s\d{4})/i", "", $text);
			$text = preg_replace("/[\r\n]+/m"," ", $text);
			$text = str_replace("&nbsp;", "", $text);
			$text = str_replace("&#160;", "", $text);
			return $text;
		fclose($file);
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////

function write($file, $fil, $ansi, $unicode) {
	if(file_exists($file)){
		$str = iconv("Windows-1252", "UTF-8", file_get_contents($file));
		$string = post(str_replace("charset=x-user-defined", "charset=UTF-8", $str), $ansi, $unicode);
		echo $string;
		file_put_contents($fil, $string);
	}
}



///////////////////////////////// number lines ///////////////////////////////////////////////////////////////

/*function linenum($file, $array){
	$n = 0;
	if(file_exists($file)){
		$file = fopen($file, "r");
			while(!feof($file)){
				$str = fgets($file);
				$n++;
				foreach ($array as $key => $value) {
					if(strpos($str, $value) !== false)
						break;
					
				}
			}

		fclose($file);
	}

	return $n;
}*/

 

//////////////////////////////// post text ///////////////////////////////////////////

/*function content($file, $ansi, $unicode, $linestart, $lineend){
	if(file_exists($file)){
		$arr = file($file);
		$text = "";
			for($i = $linestart - 1; $i < $lineend; $i++){
				$str = iconv("Windows-1252", "UTF-8", $arr[$i]);
				$text = $text . post(strip_tags($str), $ansi, $unicode);
			}
		return $text;
	}
}
*/
///////////////////////////////////////////////// post url /////////////////////////////////////

function url($file){
	$url = str_replace('D:\WEB\xndirner\aravot.am\WWW\\', 'http://archive.aravot.am/', $file);
	$url = str_replace('\\', '/', $url); //  archiv url
	return $url;
}

//////////////////////////////////////////////// image url  ////////////////////////////////////////////////////

function photourl($file){
	if(file_exists($file)){
		$subject = url($file);
		$file = fopen($file, 'r');
		$image = [];
		$array = [];
		$photourl = "";
		$imageurl = "";
			while (!feof($file)) {
				$str = iconv("Windows-1252", "UTF-8", fgets($file));

				if(strpos($str, "img") !== false || strpos($str, "IMG")){
					if(preg_match("/(imaj\/\w+\.[gif|jpg|png]+)/i", $str) == 1){
						preg_match_all("/(imaj\/\w+\.[gif|jpg|png]+)/i", $str, $img);
						//var_dump($img[0][0]);
						//echo "*************************************************";
						array_push($array, $img[0][0]);
					}
					else{
						preg_match_all("/(\w+\.[gif|jpg|png]+)/i", $str, $img);
						//var_dump($img[0][0]);
						//echo "---------------------------------";
						array_push($image, $img[0][0]);

					}
				}
			}
			//var_dump($image);
			//var_dump($array);

			if(count($image)>0){
					//echo(count($image));
						foreach ($image as $key => $value) {
							
							$imageurl = preg_replace("/(\w+.html)|(\w+.htm)/",$value, $subject) . "   " . $imageurl;
							
						}
					}
					elseif (count($image) == 1) {
						foreach ($image as $key => $value) {
							$imageurl = preg_replace("/(\w+.html)|(\w+.htm)/",$value, $subject);
						}
					}

			if(count($array) > 0){
					foreach ($array as $key => $value) {
						$photourl = preg_replace("/(aravot_arm\S+)/", "aravot_arm/" . $value, $subject) . "   " . $photourl;
					}
				}
				elseif (count($array) == 1) {
					foreach ($array as $key => $value) {
						$photourl = preg_replace("/(aravot_arm\S+)/", "aravot_arm/" . $value, $subject);
					}
				}

		fclose($file);
		return $photourl . "  " . $imageurl;
	}
	
}


////////////////////////////// file name  st.html chka  //////////////////////////////////////////////////////////////////

function filename($dir){
	$array = [];
	$file = [];
	$arr = scandir($dir);
	unset($arr[0]);
	unset($arr[1]);

	foreach ($arr as $key => $value) {
		$f1 = $dir."\\" .$value;
		if(is_dir($f1) !== false){
			$mon = scandir($f1);
			foreach ($mon as $key => $value) {
				if(strlen($value) > 2 && preg_match("/(\/[spu]\w+\.html)|(\/[spu]\w+\.htm)/i", "\/" . $value) == 1 ){
					$url = $f1 . "\\" . $value;
					if(filesize($url)>1024){
						array_push($file, $url);
					}
				}
			}
		}
	}
	return $file;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

function datepost($file){
	if(strpos($file, "aravot_arm") !== false){
		$file = str_replace('\aravot_arm\\', "/", $file);
		$file = str_replace('\\', "/", $file);
		preg_match_all("/(\d+\/\w+\/\w+)/", $file, $arr);       //////////////\w+ poxel
		return preg_replace("/(\/\w+\/)/i", "-05-", implode("", $arr[0]));////////////
	}
	/*else{
		$file = str_replace('\\', "/", $file);
		preg_match_all("/(\d+\/\w+\/\w+)/", $file, $arr);
		return preg_replace("/(\/\w+\/)/i", "-11-", implode("", $arr[0]));
	}*/
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////

$arr = array("May");
$n = 0;
foreach ($arr as $key => $value) {
	echo $value . "<br>";

$dir = 'D:\WEB\xndirner\aravot.am\WWW\2006\aravot_arm'.'\\'.$value;
$array = filename($dir);
//var_dump($array);
	foreach ($array as $key => $value) {
		$file = $value;

	//write($file, $fil, $ansi, $unicode);
	//echo read($file, $ansi, $unicode). "<br> ********************************";
	//echo Title($file, $ansi, $unicode). "<br>";
	//echo url($file) . "<br>";
	//echo content($file, $ansi, $unicode, $linestart, $lineend). "<br>";
	//echo datepost($file). "<br>";
	//echo photourl($file). "<br>";
	//echo "<br> //////////////////////////////////////////////////////////////////////////////////////////////////////////// <br> ";
$n++;

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		$host="localhost";
		$user="Artush";
		$pasword="artush1989";
		$db="test";
		$conn=mysqli_connect($host,$user,$pasword,$db);
	if (mysqli_connect_errno()) {
	    printf( mysqli_connect_error());
	    exit();
	}
	mysqli_query($conn, "SET NAMES utf8");

		$title = Title($file, $ansi, $unicode);
		$text = read($file, $ansi, $unicode);// content($file, $ansi, $unicode, $linestart, $lineend);
		$date = datepost($file);
		$url = url($file);
		$photourl = photourl($file);

	$query = mysqli_query($conn, "INSERT INTO `aravot`( 

		`text`, 
		`date`, 
		`url`, 
		`photo_url`
		) VALUES (

		'$text',
		'$date',
		'$url',
		'$photourl'
		)"); 


	$query = mysqli_query($conn, "INSERT INTO `table`( 
		`title`,
		`text`, 
		`date`, 
		`url`, 
		`photo_url`
		) VALUES (
		'$title',
		'$text',
		'$date',
		'$url',
		'$photourl'
		)"); 
	}
}
echo $n;

?>

