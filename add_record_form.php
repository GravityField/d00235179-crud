<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Add Record</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">

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
            <input type="input" class="form-control" name="name" placeholder="e.g Smirnoff Ice" required>
            <br>

            <label>List Price:</label>
            <input type="input" class="form-control" name="price" placeholder="e.g 20.50" required pattern="[0-9]{1-3}.[0-9]{0-2}"   >
            <br>        
            
            <label>Manufacture Date:</label>
            <input type="date" class="form-control" name="manufacture_date" required >
            <br> 
            
            <label>Alcohol Content:</label>
            <input type="input" class="form-control" name="alcohol_content" placeholder="e.g 30.50" required pattern="[0-9]{1-2}.[0-9]{0-2}">
            
            <br> 

            <label>Image:</label>
            <input type="file" class="form-control" name="image" accept="image/*" />
            
            <label>&nbsp;</label>
            <br>
            <div class="button-container">
            <input type="submit" class="btn btn-primary" value="Add Record">
            
            <p><a href="index.php" class="btn btn-danger">Cancel</a></p>
            </div>
            <br>
        </form>
        
    <?php
include('includes/footer.php');
?>