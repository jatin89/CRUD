<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="assests/technology.png">
<title>Insert | Page</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="wrapper CSSTableGenerator">

<?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<l1>'.htmlentities($error).'</l1><br>';
            }
            print '</ul>';
        }
        ?>
        
<form action="" method="post" name="form">
<table >
<tr>
	<td colspan="2" align="center">Enter New Products</td>
   </tr>
  <tr>
    <td>Category</td>
    <td><select class=" option3" name="category">
     <?php foreach ($list as $category): ?>
      <option value="<?php print htmlentities($category->name); ?>"><?php print htmlentities($category->name); ?></option>
      <?php endforeach; ?>
    </select></td>
  </tr>
  <tr>
    <td>Name</td>
    <td><input class="css-input" name="name" value="<?php print htmlentities($name) ?>" type="text"></td>
  </tr>
  <tr>
    <td>Manufacturer</td>
    <td><input class="css-input" name="manufacturer" value="<?php print htmlentities($manufacturer) ?>" type="text"></td>
  </tr>
  <tr>
    <td>Price</td>
    <td><input class="css-input" name="price" value="<?php print htmlentities($price) ?>" type="text"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
   		 <input type="hidden" name="form-submitted" value="1">
    	<input name="" type="submit" class="button" value="Submit">
        <input name="" type="reset" class="button" value="Reset">
        <input name="" type="button"  class="button" onClick="goBack()" value="Back">
        <script>
			function goBack() {
			window.history.back();
			}
		</script>
    </td>
    </tr>
</table>

</form>
</div>
</body>
</html>

