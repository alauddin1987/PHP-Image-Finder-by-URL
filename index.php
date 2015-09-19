<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style type="text/css">
	.img-height{
		margin-top: 10px;
		width: 300px;
		height: 130px;
	}
	.wraper{
		margin-top: 30px;

	}

</style>
<div class="container  wraper">
	<form class="form-inline" method="post">
		<div class="form-group col-lg-8">

			<div class="input-group col-lg-12">
				<input type="url" class="form-control " required="required" name="search_key" placeholder="Please Input your URL">

			</div>
		</div>
		<button type="submit" name="btnSubmit" class="btn btn-primary">Search URL</button>
	</form>
	<?php 
	if(isset($_POST['btnSubmit']))
	{
		preg_match('@^(?:http://)?([^/]+)@i',
			$_POST['search_key'], $matches);

		$host = $matches[1];
		$url = 'http://'.$host;

		if (!filter_var($url, FILTER_VALIDATE_URL) === false) {

			$html = file_get_contents($url);
			$dom = new domDocument;
			@$dom->loadHTML($html);
			$dom->preserveWhiteSpace = false;
			$images = $dom->getElementsByTagName('img');
			foreach ($images as $image) {
				$img = $image->getAttribute('src');
				echo '<div class="col-lg-3"> <img src="'.$url.'/'.$img.'" class="img-thumbnail img-height"></div>';
			}
		}
		else{
			echo($_POST['search_key']." is not a valid URL");
		}

		
	}
	?>
</div>