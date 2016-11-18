
<html>
<body>

	<form action="" method="post">
		Data <input type="text" name="url"> 
		Size <select name="size">			
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>			
			<option value="10">10</option>			
		</select>	
		<input type="submit" name="send">
	</form>

<?php 

include('phpqrcode/qrlib.php');


   if (isset($_POST['send'])) 
   {
      
      	$codeContents = $_POST['url'];
      	$size = $_POST['size'];
      
		QRcode::png($codeContents, 'level_L.png', QR_ECLEVEL_L , $size); 
		QRcode::png($codeContents, 'level_M.png', QR_ECLEVEL_M , $size); 
		QRcode::png($codeContents, 'level_Q.png', QR_ECLEVEL_Q , $size); 
		QRcode::png($codeContents, 'level_H.png', QR_ECLEVEL_H , $size); 
		 
		echo '<img src="level_L.png" title="Nível L: conta com 7% de poder de correção" />'; 
		echo '<img src="level_M.png" title="Nível M: conta com 15% de poder de correção" />'; 
		echo '<img src="level_Q.png" title="Nível Q: conta com 25% de poder de correção" />'; 
		echo '<img src="level_H.png" title="Nível H: conta com 30% de poder de correção" />';

		$path = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'level_H.png';
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		echo $base64;

		echo '<a href="' . $path . '" download><img src="' . $base64 . '"/></a>';
   }

?>

</body>
</html>