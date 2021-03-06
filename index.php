<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>


<aside>
<!-- display a list of categories -->
<h2>Categories</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a class="btn btn-outline-light" href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
<p><a href="category_list.php" class="btn btn-info">Manage Categories</a></p>

</nav>          
</aside>
<section>
<!-- display a table of records -->
<h2><?php echo $category_name; ?></h2>
<div class="products-table">
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Manufacture Date</th>
<th>Alcohol Content</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><img  src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $record['name']; ?></td>
<td class="right"><?php echo $record['price']; ?></td>
<td><?php echo $record['manufacture_date']; ?></td>
<td><?php echo $record['alcohol_content']; ?></td>

<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" class="btn btn-outline-danger" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" class="btn btn-outline-success" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
</div>
<p><a href="add_record_form.php" class="btn btn-primary">Add Record</a></p>
</section>
<?php
include('includes/footer.php');
?>