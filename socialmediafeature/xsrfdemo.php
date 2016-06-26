<?php
	session_start();
	require_once 'Classes/Token.php';

?>

<!DOCTYPE html>
<html>
<body>
	<form action="post">
		<div class="product">
			<strong>A Product</strong>
			<div class="field">
				Quantity: <Input type="text" name="quantity">
			</div>
			<input type="submit" value="Order">
			<input type="hidden" name="product" value="1">
			<input type="hidden" name="token" value="">			
		</div>
	</form>
</body>
</html>
