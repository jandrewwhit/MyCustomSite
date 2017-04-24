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

if (isset($_GET['i'])) {
	
	$i = $_GET['i'];
	
}

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
<!--
<div class="container">
	<div class="starter-template" style="border: 1px solid">
		<h2>OMDB API Movie Search</h2>	
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?i="'.$search.'"';?>">
		Search by ID <input type="text" name="search" value="<?php echo $search;?>">
		<span class="error">* <?php echo $searchErr;?></span>
		<br><br>
		<input type="submit" name="submit" value="Submit">
		</form>
	</div>
</div>-->
<div class="container">
	<div class="starter-template" style="border: 1px solid">
		<h2>The Movie DB Search</h2>	
		<form method="get" action="../">
		Search by Title <input type="text" name="s" value="">
		<span class="error">* <?php echo $searchErr;?></span>
		<br><br>
		<button type="submit">Search</button>
		</form>
	</div>
</div>
<?php
// source of tutorial is http://www.phponwebsites.com/2015/03/get-app-details-from-apple-itunes-using-php.html



if (!empty($i)) {
	
	 //$content=file_get_contents("http://www.omdbapi.com/?i=".urlencode($search)."&plot=full&r=json");
			//$json = json_decode($content, true);
	
	//$response=$json['Response'];
	
	$api_key="e99efc8521a307bc10bc0a8f4b6c859d";
	$session_id="6c20f392dd31c8ab1a5d6741265198a5b42e07eb";
	$request_token="";
	
	$baseURL="https://api.themoviedb.org/3/movie/";
	$content=file_get_contents($baseURL.$i."?api_key=".$api_key."&language=en-US&append_to_response=undefined");
	$json = json_decode($content, true);
	
	$genre_list=file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=".$api_key."&language=en-US");
	$genre_list_json = json_decode($genre_list, true);
	
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
	
	//Variables pulled out of the arrary/json return
	$title = $json['title'];
	$poster = $json['poster_path'];
	$release_date = strtotime($json['release_date']);
	
	//Variables pulled out of the arrary/json return
	$adult = $json['adult'];
	$backdrop_path = $json['backdrop_path'];
	$belongs_to_collection = $json['belongs_to_collection'];
	////////////////////Arrary
		$collectionID = $belongs_to_collection['id'];
		$collectionName = $belongs_to_collection['name'];
		$collectionPoster_path = $belongs_to_collection['poster_path'];
		$collectionBackdrop_path = $belongs_to_collection['backdrop_path'];
	$budget = $json['budget'];
	$genres = $json['genres'];////////////////////////////////////////////Arrary
	$homepage = $json['homepage'];
	$id = $json['id'];
	$imdb_id = $json['imdb_id'];
	$original_language = $json['original_language'];
	$original_title = $json['original_title'];
	$overview = $json['overview'];
	$popularity = $json['popularity'];
	//$poster_path = $json['poster_path'];
	$production_companies = $json['production_companies'];///////////////Arrary
	$production_countries = $json['production_countries'];///////////////Arrary
	//$release_date = $json['release_date'];
	$revenue = $json['revenue'];
	$runtime = $json['runtime'];
	$spoken_languages = $json['spoken_languages'];///////////////////////Arrary
	$status = $json['status'];
	$tagline = $json['tagline'];
	//$title = $json['title'];
	$video = $json['video'];
	$vote_average = $json['vote_average'];
	$vote_count = $json['vote_count'];
	
	//My variables
	$year = date('Y',$release_date);
	$release_date_formated = date('m-d-Y',$release_date);
	
	$posterBaseURL = "http://image.tmdb.org/t/p/";
	
	
	echo '<div id="results-container" class="container">';// style="border: 1px solid">';
			
			//echo $content;
			
			echo '<br>';
			
			// Master-Row
			echo '<div id="master-row" class="row">';// style="border: 1px solid">';
				//echo $title;
				// Poster
				echo '<div id="poster-border" class="col-sm-6 col-md-4 col-lg-4">';// style="border: 1px solid">';
					//echo '<center><img src="'.$poster.'"></center>';
					if (!empty($poster)) {
						echo '<img src="'.$posterBaseURL.$poster_size_w342.$poster.'" style="max-height: 400px"/></a><br><br>';
					} else {
						$poster = "NoImg.jpg";
						echo '<img src="'.$poster.'" style="max-height: 400px"/></a><br><br>';
					}
				echo '</div>'; // End id="poster-border" 
				
				// Partner
				echo '<div id="partner" class="col-sm-6 col-md-8 col-lg-8">';// style="border: 1px solid">';
					echo '<div id="text-row" class="row">';
						
						//Title
						echo '<div id="title" class="col-lg-12">';
							echo '<h2>Title: '.$title.' ('.$year.')</h2>';
							echo '<br>';
							echo '<b>Adult:</b> '.$adult;
							echo '<br>';
							echo '<b>Backdrop path:</b> '.$backdrop_path;
							echo '<br>';
							////$belongs_to_collection = $json['belongs_to_collection'];////////////////////Arrary
							
							echo '<b>Belongs to Collection:</b><br>';
								echo '<ul><li><b>collectionID:</b> '.$collectionID.'</li>';
								echo '<li><b>collectionName:</b> '.$collectionName.'</li>';
								echo '<li><b>collectionPoster_path:</b> '.$collectionPoster_path.'</li>';
								echo '<li><b>collectionBackdrop_path:</b> '.$collectionBackdrop_path.'</li></ul>';			
							
							echo '<b>Budget:</b> $'.number_format($budget);
							echo '<br>';
							//$genres////////////////////////////////////////////Arrary
							$genreCount=count($genres);
							echo '<b>Genres:</b> ';
							for ($i=0;$i<$genreCount;$i++) {
								if ($i>0) {
									echo ", ";
								}
								//$title=$json['results'][$i]['title'];
								$genreID = $genres[$i]['id'];
								$genreName = $genres[$i]['name'];
								echo $genreName;
							}
							echo '<br>';
							//echo 'Genres: '.$genreCount;
							//echo '<br>';
							echo '<b>Homepage:</b> '.$homepage;
							echo '<br>';
							echo '<b>The Movie DB ID:</b> '.$id;
							echo '<br>';
							echo '<b>IMDB ID:</b> '.$imdb_id;
							echo '<br>';
							echo '<b>Original Language:</b> '.$original_language;
							echo '<br>';
							echo '<b>Original Title:</b> '.$original_title;
							echo '<br>';
							echo '<b>Overview:</b> '.$overview;
							echo '<br>';
							echo '<b>Popularity:</b> '.$popularity;
							echo '<br>';
							//$poster_path = $json['poster_path'];
							////$production_companies = $json['production_companies'];///////////////Arrary
							////$production_countries = $json['production_countries'];///////////////Arrary
							//$release_date = $json['release_date'];
							echo '<b>Revenue:</b> '.$revenue;
							echo '<br>';
							echo '<b>Runtime:</b> '.$runtime;
							echo '<br>';
							//echo $spoken_languages = $json['spoken_languages'];///////////////////////Arrary
							echo '<b>Status:</b> '.$status;
							echo '<br>';
							echo '<b>Tagline:</b> '.$tagline;
							echo '<br>';
							//$title = $json['title'];
							echo '<b>Video:</b> '.$video;
							echo '<br>';
							echo '<b>Vote Average:</b> '.$vote_average;
							echo '<br>';
							echo '<b>Vote Count:</b> '.$vote_count;
							echo '<br>';
							
						echo '</div>'; // End id="title" 
						/*
						//Everything Below Title
						echo '<div id="rest" class="col-lg-12" style="border: 1px solid">';
							//Second Row
							echo '<div id="second-row" class="row" style="border: 1px solid">';
								echo '<div id="type" class=" col-xs-6 col-lg-3">';// style="border: 1px solid">';
									echo '<b>Type:</b> '.$type;
								echo '</div>';// End id="type"
								echo '<div id="series-ID" class="col-xs-6 col-lg-3">';// style="border: 1px solid">';
									if (!empty($seriesID)) {
										echo '<b>Series ID:</b> '.$seriesID;
									}
								echo '</div>';// End id="series-ID"
								echo '<div id="season" class="col-xs-6 col-lg-3">';// style="border: 1px solid">';
									if (!empty($season)) {
										echo '<b>Season:</b> '.$season;
									}		
								echo '</div>';// End id="season"
								echo '<div id="episode" class="col-xs-6 col-lg-3">';// style="border: 1px solid">';
									if (!empty($episode)) {
										echo '<b>Episode:</b> '.$episode;
									}
								echo '</div>';// End id="episode"
							echo '</div>'; //End id="second-row" 
							
							//Third Row
							echo '<div id="third-row" class="row" style="border: 1px solid">';
								echo '<div id="imdb-id" class="col-xs-6 col-md-3 col-lg-3">';// style="border: 1px solid">';
									echo '<b>IMDB ID:</b> '.$imdbID;
								echo '</div>'; //End id="imdb-id"
								echo '<div id="metascore" class="col-xs-6 col-md-3 col-lg-3">';// style="border: 1px solid">';
									echo '<b>Metascore:</b> '.$metascore;
								echo '</div>'; //End id="metascore"
								echo '<div id="imdb-rating" class="col-xs-6 col-md-3 col-lg-3">';// style="border: 1px solid">';
									echo '<b>IMDB Rating:</b> '.$imdbRating;
								echo '</div>'; //End id="imdb-rating"
								echo '<div id="imdb-votes" class="col-xs-6 col-md-3 col-lg-3">';// style="border: 1px solid">';
									echo '<b>IMDB Votes:</b> '.$imdbVotes;
								echo '</div>'; //End id="imdb-votes"
							echo '</div>'; //End id="third-row" 
							
							//Fourth
							echo '<div id="fourth-row" class="row" style="border: 1px solid">';
								echo '<div id="info" class="col-lg-6">';// style="border: 1px solid">';
									echo '<b>Rated:</b> '.$rated;
									echo '<br>';
									echo '<b>Released:</b> '.$released;
									echo '<br>';
									echo '<b>Runtime:</b> '.$runtime;
									echo '<br>';
									echo '<b>Genre:</b> '.$genre;
									echo '<br>';
								echo '</div>'; //End id="info" 
									
								echo '<div id="director-writer" class="col-lg-6">';// style="border: 1px solid">';
									echo '<b>Director:</b> '.$director;
									echo '<br>';
									echo '<b>Writer:</b> '.$writer;
									echo '<br>';
								echo '</div>'; //End id="director-writer" 								
							echo '</div>'; //End id="fourth-row"
							
							//Fifth
							echo '<div id="fifth-row" class="row" style="border: 1px solid">';
								echo '<div id="actors" class="col-lg-12">';// style="border: 1px solid">';
									echo '<b>Actors:</b> '.$actors;
									echo '<br>';
								echo '</div>'; //End id="actors"
							echo '</div>'; //End id="fifth-row"
							
							//Sixth Row
							echo '<div id="sixth-row" class="row" style="border: 1px solid">';
								echo '<div id="language" class="col-lg-3">';// style="border: 1px solid">';
									echo '<b>Language:</b> '.$language;
								echo '</div>'; //End id="language"
								echo '<div id="country" class="col-lg-3">';// style="border: 1px solid">';
									echo '<b>Country:</b> '.$country;
								echo '</div>'; //End id="country"
								echo '<div id="awards" class="col-lg-6">';// style="border: 1px solid">';
									echo '<b>Awards:</b> '.$awards;
								echo '</div>'; //End id="awards"								
							echo '</div>'; //End id="sixth-row"
							
							//Seventh Row
							echo '<div id="seventh-row" class="row" style="border: 1px solid">';
								echo '<div id="plot" class="col-lg-12">';// style="border: 1px solid">';
									echo '<b>Plot:</b> '.$plot;
								echo '</div>'; //End id="plot"
							echo '</div>'; //End id="seventh-row"
							
						echo '</div>'; //End id="rest" */
					echo '</div>'; //End id="text-row" 
				echo '</div>'; //End id="partner" 
			echo '</div>'; //End id="master-row" 
		
	
	echo '</div>'; //End id="results-container"
	
}
?>

</body>
</html>
