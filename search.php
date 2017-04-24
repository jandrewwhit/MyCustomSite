<!DOCTYPE HTML>  
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">

		<!-- Bootstrap core CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">
	
		<!-- Custom styles for this template -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="test.css" rel="stylesheet">
		
<style>
.error {color: #FF0000;}

/*Testing Screen Sizes
body {
  background: white;    
}

@media screen and (min-width: 980px) / Desktop / {
  body {
    background: red;
  }
}

@media screen  and (max-width: 979px) / Tablet / {
  body {
    background: blue;
  }
}

@media screen and (max-width: 500px) / Mobile / {
  body {
    background: green;
  }
}*/
</style>
</head>
<body>
<?php

$search = "";
$searchErr = "";

if (isset($_GET['s'])) {
	
	$search = $_GET['s'];
	
}


if (isset($_GET['page'])) {
	$page= $_GET['page'];
} else {
	$page=1;
}
/*
if (isset($_GET['result'])) {
	$result= floatval($_GET['result']);
} else {
	$result=0;
}*/

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["search"])) {
		$searchErr = "a search is required";
	} else {
		$search = test_input($_POST["search"]);
		// check if name only contains letters and whitespace
		/*if (!preg_match("/^[a-zA-Z ]*$/",$search)) {
		  $searchErr = "Only letters and white space allowed"; 
		}*
	}
}*/


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container">
	<div class="starter-template" style="border: 1px solid">
		<h2>The Movie DB Search</h2>	
		<form method="get" action="">
		Search by Title <input type="text" name="s" value="">
		<span class="error">* <?php echo $searchErr;?></span>
		<br><br>
		<button type="submit">Search</button>
		</form>
	</div>
</div>
<?php
// source of tutorial is http://www.phponwebsites.com/2015/03/get-app-details-from-apple-itunes-using-php.html



if (!empty($search)) {
		
	$api_key="e99efc8521a307bc10bc0a8f4b6c859d";
	$session_id="6c20f392dd31c8ab1a5d6741265198a5b42e07eb";
	$request_token="";
	
	$s = urlencode($search);
	 $content=file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=".$api_key."&language=en-US&query=".$s.'&page='.$page);
			$json = json_decode($content, true);
	
	$genre_list=file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=".$api_key."&language=en-US");
	$genre_list_json = json_decode($genre_list, true);
	
	$base_url="http://image.tmdb.org/t/p/";
	$backdrop_w300="w300";
	$backdrop_w780="w780";
	$backdrop_w1280="w1280";
	$backdrop_original="original";
	
	$poster_size_w92="w92";
	$poster_size_w154="w154";
	$poster_size_w185="w185";
	$poster_size_w342="w342";
	$poster_size_w500="w500";
	$poster_size_w780="w780";
	$poster_size_original="original";
	
	$result=count($json['results']);
	$totalPages=$json['total_pages'];
	echo '<h3>&nbsp;&nbsp;&nbsp;Your Search Results: ('.$result.' items)('.$totalPages.' pages)<br><br></h3>';
	
	echo '<div id="results-container" class="container"><br>';// style="border: 1px solid">';

			
			
			for($i=0;$i<$result;$i++){
				// Variables pulled from json return
				// Needs to be in a loop
				
				$title=$json['results'][$i]['title'];
				//$year=$json['Search'][$i]['Year'];
				$poster=$json['results'][$i]['poster_path'];
				//$poster="NoImg.jpg";
				$id=$json['results'][$i]['id'];
				//$type=$json['results'][$i]['media_type'];
				
				
				
				
				
				//echo '<div class="row" style="border: 1px solid">';
				//echo '<div class="col-lg-4" style="border: 1px solid">';
				echo '<div class="col-md-6 col-lg-4" style="height: 480px">';// style="border: 1px solid">';
					echo '<div class="col-lg-12">';// style="border: 1px solid">';
						echo 'Title: '.$title.'<br>';
						//echo 'Year: '.$year.'<br>';
						//echo 'Type: '.$type.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						echo 'ID: '.$id.'<br>';
					echo '</div>';
					echo '<div class="col-lg-12" style="height: 410px">';// style="border: 1px solid">';
						if (!empty($poster)) {
							echo '<a href="title?i='.$id.'"><img src="'.$base_url.$poster_size_w342.$poster.'" style="max-height: 400px"/></a><br><br>';
						} else {
							$poster = "NoImg.jpg";
							echo '<a href="title?i='.$id.'"><img src="'.$poster.'" style="max-height: 400px"/></a><br><br>';
						}
						
					echo '</div>';
				//echo '</div>';
				echo '</div>';				
			}
				echo '<div class="col-lg-12" style="border: 1px solid">';
						//echo $totalPages.'<br>';
						/*if ($page == 1) {
							$previousPage = 0;
						} else {
							$previousPage = $page - 1;
						}
						
						if ($page < $totalPages) {
							$nextPage = $page +1;
						} else {
							$nextPage = 0;
						}*/
						
						echo '<center><h4>';
						
							// Previous Page
							if ($page == 1) {
								//$previousPage = 0;
								//echo '[left arrow] ';
							} else {
								$previousPage = $page - 1;
								echo '<a href="?s='.$s.'&page='.$previousPage.'&result='.$result.'">[left]</a> ';

								if (($page >= ($totalPages))) {
									//two pages before
									$fourPageBefore = $page - 4;
									echo '<a href="?s='.$s.'&page='.$fourPageBefore.'&result='.$result.'">'.$fourPageBefore.'</a> ';
								}
								
								if (($page >= ($totalPages-1))) {
									//one pages before
									$threePageBefore = $page - 3;
									echo '<a href="?s='.$s.'&page='.$threePageBefore.'&result='.$result.'">'.$threePageBefore.'</a> ';
								}						
								
								if ($page > 2) {
									//two pages before
									$twoPageBefore = $page - 2;
									echo '<a href="?s='.$s.'&page='.$twoPageBefore.'&result='.$result.'">'.$twoPageBefore.'</a> ';
								}
								
								if ($page > 1) {
									//one pages before
									$onePageBefore = $page - 1;
									echo '<a href="?s='.$s.'&page='.$onePageBefore.'&result='.$result.'">'.$onePageBefore.'</a> ';
								}
							}
							
						
						
						/*$tempLimit = 1;
						for ($i=2;$i>$tempLimit;$i--) {
							if ($page>$tempLimit) {
								$temp = $page - 1;
								$pageBefore = $page - $temp;
								echo ' <a href="search2.php?s='.$s.'&page='.$pageBefore.'&result='.$passResult.'">'.$pageBefore.'</a> ';
							}
						}*/
						
					/// current page ///
						echo '<b><u><a href="?s='.$s.'&page='.$page.'&result='.$result.'">'.$page.'</a></u></b> ';
						
						if ($page < ($totalPages) ) {
							//one page after
							$onePageAfter = $page + 1;
							echo '<a href="?s='.$s.'&page='.$onePageAfter.'&result='.$result.'">'.$onePageAfter.'</a> ';
						}
						
						if ($page < ($totalPages-1)) {
							//two pages after
							$twoPageAfter = $page + 2;
							echo '<a href="?s='.$s.'&page='.$twoPageAfter.'&result='.$result.'">'.$twoPageAfter.'</a> ';
						}
						
						if (($page < ($totalPages-2)) and ($page < 3)) {
							//three pages after
							$threePageAfter = $page + 3;
							echo '<a href="?s='.$s.'&page='.$threePageAfter.'&result='.$result.'">'.$threePageAfter.'</a> ';
						}
						
						if (($page < ($totalPages-3)) and ($page < 2)) {
							//three pages after
							$fourPageAfter = $page + 4;
							echo '<a href="?s='.$s.'&page='.$fourPageAfter.'&result='.$result.'">'.$fourPageAfter.'</a> ';
						}					
						
						
						/*if ($page < ($totalPages-2)) {
							//three pages after
							$threePageAfter = $page + 3;
							echo '<a href="search2.php?s='.$s.'&page='.$threePageAfter.'&result='.$passResult.'">'.$threePageAfter.'</a> ';
						}
						
						if ($page < ($totalPages-3)) {
							//three pages after
							$fourPageAfter = $page + 4;
							echo '<a href="search2.php?s='.$s.'&page='.$fourPageAfter.'&result='.$passResult.'">'.$fourPageAfter.'</a> ';
						}*/
						
						/*$tempLimit = 2;
						for ($i=0;$i<$tempLimit;$i++) {
							if ($page<($totalPages-$i)) {
								$temp = $i + 1;
								$pageAfter = $page + $temp;
								echo ' <a href="search2.php?s='.$s.'&page='.$pageAfter.'&result='.$passResult.'">'.$pageAfter.'</a> ';
							}
						}*/
						
						
						// Next Page
							if ($page < $totalPages) {
								$nextPage = $page +1;
								echo '<a href="?s='.$s.'&page='.$nextPage.'&result='.$result.'">[right]</a>';
							} else {
								//echo '[right arrow]';
							}
							
						echo '</h4></center>';
				echo '</div>';
				//should be search.php/search query&page=# all within the url
		
	
	echo '</div>'; //End id="results-container"
	
}
?>

</body>
</html>
