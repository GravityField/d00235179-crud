<?php
require('database.php');

$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$records = $statement->fetch(PDO::FETCH_ASSOC);

$statement->closeCursor();

$query2 = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement2 = $db->prepare($query2);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1>
        <form action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="original_image" class="form-control"  value="<?php echo $records['image']; ?>" />
            <input type="hidden" name="record_id" class="form-control"
                   value="<?php echo $records['recordID']; ?>">

                   <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Name:</label>
            <input type="input" name="name" class="form-control"
                   value="<?php echo $records['name']; ?>" required>
            <br>

            <label>List Price:</label>
            <input type="input" name="price" class="form-control"
                   value="<?php echo $records['price']; ?>" required pattern="[0-9]{1-3}.[0-9]{0-2}">
            <br>

            <label>Manufacture Date:</label>
            <input type="date" name="manufacture_date" class="form-control" value="<?php echo $records['manufacture_date']; ?>" required>
            <br> 

            <label>Alcohol Content:</label>
            <input type="input" name="alcohol_content" class="form-control" value="<?php echo $records['alcohol_content']; ?>"
            required pattern="[0-9]{1-2}.[0-9]{0-2}">
            <br> 

            <label>Image:</label>
            <input type="file" name="image" class="form-control" accept="image/*" />
            <br>            
            <?php if ($records['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $records['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <br>
            <div class="button-container">
            <input type="submit" class="btn btn-primary" value="Save Changes">

            <p><a href="index.php" class="btn btn-danger">Cancel</a></p>
            </div>
            <br>
        </form>
        
    <?php
include('includes/footer.php');
?>