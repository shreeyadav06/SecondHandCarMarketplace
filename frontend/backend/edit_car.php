<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $car_condition = $_POST['car_condition'];
    $status = $_POST['status'];

    $sql = "UPDATE cars SET Brand=?, Model=?, Year=?, Price=?, CarCondition=?, Status=? WHERE CarID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $brand, $model, $year, $price, $car_condition, $status, $car_id);

    if ($stmt->execute()) {
        header("Location: ../admin_dashboard.html?success=car_updated");
        exit();
    } else {
        echo "Error updating car.";
    }
    $stmt->close();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $car_id = $_GET['car_id'];

    $sql = "SELECT * FROM cars WHERE CarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <style>
        body { background: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .edit-form { max-width: 400px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); padding: 2rem; }
        h2 { color: #2980b9; text-align: center; }
        label { display: block; margin-top: 1rem; }
        input, select { width: 100%; padding: 0.6rem; margin-top: 0.3rem; border: 1px solid #ccc; border-radius: 6px; }
        button { margin-top: 1.5rem; background: #2980b9; color: #fff; border: none; padding: 0.7rem 2rem; border-radius: 8px; font-size: 1.1rem; cursor: pointer; }
        button:hover { background: #2574a9; }
    </style>
</head>
<body>
    <form class="edit-form" action="edit_car.php" method="POST">
        <h2>Edit Car</h2>
        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['CarID']); ?>">
        <label>Brand:
            <input type="text" name="brand" value="<?php echo htmlspecialchars($car['Brand']); ?>" required>
        </label>
        <label>Model:
            <input type="text" name="model" value="<?php echo htmlspecialchars($car['Model']); ?>" required>
        </label>
        <label>Year:
            <input type="number" name="year" value="<?php echo htmlspecialchars($car['Year']); ?>" required>
        </label>
        <label>Price:
            <input type="number" name="price" value="<?php echo htmlspecialchars($car['Price']); ?>" required>
        </label>
        <label>Condition:
            <select name="car_condition" required>
                <option value="New" <?php if($car['CarCondition']=='New') echo 'selected'; ?>>New</option>
                <option value="Used" <?php if($car['CarCondition']=='Used') echo 'selected'; ?>>Used</option>
            </select>
        </label>
        <label>Status:
            <select name="status" required>
                <option value="Available" <?php if($car['Status']=='Available') echo 'selected'; ?>>Available</option>
                <option value="Sold" <?php if($car['Status']=='Sold') echo 'selected'; ?>>Sold</option>
                <option value="Reserved" <?php if($car['Status']=='Reserved') echo 'selected'; ?>>Reserved</option>
            </select>
        </label>
        <button type="submit">Update Car</button>
    </form>
</body>
</html>
