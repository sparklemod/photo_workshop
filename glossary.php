<head>
	<meta charset="utf-8">
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<?php

$pages = array("index.php", "reviews.php", "contacts.php");
$all_words = array();

function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}

foreach ($pages as $page){
	$file = file_get_contents_utf8('./' .$page, FILE_USE_INCLUDE_PATH);
	
	$file = preg_replace("/<[^<>]+>/", " ", $file);
	

	preg_match_all("/[A-Za-zА-Яа-я]+[_\\-]*+[A-Za-zА-Яа-я]+/u", $file, $words);

	foreach ($words[0] as $word){
		$word = mb_strtolower($word);
		if (!isset($all_words[$word]))
			$all_words[$word] = array();
		if (!isset($all_words[$word][$page]))
			$all_words[$word][$page] = 0;
		$all_words[$word][$page]++;
	}
}

ksort($all_words);
?>

<nav class="navbar navbar-light bg-light" style="margin-bottom: 21px;">
  <a class="navbar-brand">Глоссарий</a>
   <form class="form-inline">
	<input id="search-input" class="form-control mr-sm-2"  type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" onclick="search();">Search</button>
    <script type="text/javascript">
    	window.onload = function() {
	        location.hash = "";
	    }
    	function search(){
    		let input = document.getElementById("search-input").value;
    		input = input.trim().toLowerCase();
    		if (input.length == 0) return;
    		let words = document.getElementsByClassName("word_entry");
    		for (let word of words){
    			if (word.getAttribute("name").indexOf(input) == 0){
    				location.hash = word.id;
    				return;
    			}
    		}
    		alert("Ничего не найдено");
    	}
    </script>
      </form>
</nav>

<div class="container">
<?php
$i = 1;
foreach($all_words as $word => $links){
	?>
		<div class="word_entry" id=<?php echo '"' . $i . '"'; ?> name=<?php echo '"' . $word . '"'; ?>>
			<h3 class="word"><?php echo $i . ". " . $word; ?></h3>
	<?php
	foreach ($links as $link => $count){
		?>
		
			<a href=<?php echo '"'.$link.'"'; ?> > <?php echo $link; ?> </a>
			<span> <?php echo $count." раз"; ?> </span>
			<br>
			
		<?php
	}
	?>
		</div>
	<?php
	$i++;
}
?>
</div>

<a style="position: fixed; bottom: 40px; right: 50;" href="#"> НАВЕРХ </a>