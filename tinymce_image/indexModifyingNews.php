<!DOCTYPE html>
<html lang="fr">

  <head>
	<meta charset="utf-8">
    <title>TinyMCE</title>
	<script src='http://cloud.tinymce.com/5-testing/tinymce.min.js?apiKey=3kg42m0vwwyy95ho1bgth0602esuxa173uysvq6jxh824iy0'></script>
  </head>

  <body>
  
	<textarea name="textarea" id="textarea" cols="30" rows="10"><?php if (isset($newsToModify)) echo $newsToModify->content() ?></textarea>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="tinymce_image/tiny.js"></script>

  </body>

</html>

	
  