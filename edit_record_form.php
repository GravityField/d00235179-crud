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

            <label>Category ID:</label>
            <input type="category_id" name="category_id" class="form-control"
                   value="<?php echo $records['categoryID']; ?>">
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
            <input type="submit" class="btn btn-success" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php" class="btn btn-danger">Cancel</a></p>
    <?php
include('includes/footer.php');
?>