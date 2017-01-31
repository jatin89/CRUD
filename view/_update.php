<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="assests/communication.png">
<title>Update | Page</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class=" wrapper CSSTableGenerator">
<form method="post" name="form1" action="">
  <table>
  <tr>
	<td colspan="2" align="center">Update Products Information</td>
   </tr>
    <tr>
      <td>Id:</td>
      <td><?php echo $data->id; ?></td>
    </tr>
    <tr>
      <td>Category:</td>
      <td><?php echo htmlentities($data->category); ?></td>
    </tr>
    <tr>
      <td>Name:</td>
      <td><input class="css-input" type="text" name="name" value="<?php echo htmlentities($data->name); ?>" size="32"></td>
    </tr>
    <tr>
      <td>Manufacturer:</td>
      <td><input class="css-input" type="text" name="manufacturer" value="<?php echo htmlentities($data->manufacturer); ?>" size="32"></td>
    </tr>
    <tr>
      <td>Price:</td>
      <td><input class="css-input" type="text" name="price" value="<?php echo htmlentities($data->price); ?>" size="32"></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="hidden" name="form-submitted" value="1" />
      <input type="submit" class="button" value="Update record">
      <input name="" type="button" class="button" onClick="goBack()" value="Back">
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
