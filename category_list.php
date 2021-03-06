<?php
    require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM categories
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
    <h1>Category List</h1>
<div class="products-table">
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><h3><?php echo $category['categoryName']; ?></h3></td>
            <td>
                <form action="delete_category.php" method="post"
                      id="delete_product_form">
                    <input type="hidden" name="category_id"
                           value="<?php echo $category['categoryID']; ?>">
                    <input type="submit" class="btn btn-outline-danger" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
        
    <br>
    </div>
    <h2>Add Category</h2>
    <form action="add_category.php" method="post"
          id="add_category_form">

        <h3>Name:</h3>
        <input type="input" name="name">
        <input id="add_category_button" type="submit" value="Add">
    </form>
    <br>
    <p><a href="index.php" class="btn btn-primary">Homepage</a></p>

    <?php
include('includes/footer.php');
?>