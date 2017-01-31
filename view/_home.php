<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="assests/database.png">
<title>Home | Page</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="wrapper">

<div class=" CSSTableGenerator header">
<form  action="index.php?op=new" method="post">
<input class="button" name="" type="submit" value="Create">
</form>
</div>

<br/>

<div class="CSSTableGenerator">
<table>
  <tr>
    <td>Category</td>
    <td>Name</td>
    <td>Manufacturer</td>
    <td>Price</td>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <?php foreach ($products as $product): ?>
    <tr>
      <td><?php print htmlentities($product->category); ?></td>
      <td><?php print htmlentities($product->name); ?></td>
      <td><?php print htmlentities($product->manufacturer); ?></td>
      <td><?php print htmlentities($product->price); ?></td>
      <td><form action="index.php?op=delete&id=<?php print htmlentities($product->id); ?>&category=<?php print htmlentities($product->category); ?>" method="post">
      <input class=" button" name="" type="submit" value="Delete"></form></td>
      <td><form action="index.php?op=update&id=<?php print htmlentities($product->id); ?>&category=<?php print htmlentities($product->category); ?>" method="post">
      <input class=" button" name="" type="submit" value="Update"></form></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>

</div>

</body>

</html>
