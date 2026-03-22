<?php
$conn = new mysqli("localhost", "root", "", "student_db");

// Get filter & sort values
$dept = $_GET['dept'] ?? '';
$sort = $_GET['sort'] ?? '';

// Base query
$sql = "SELECT * FROM students WHERE 1";

// Filter
if ($dept != "") {
    $sql .= " AND department='$dept'";
}

// Sort
if ($sort == "name") {
    $sql .= " ORDER BY name ASC";
} elseif ($sort == "dob") {
    $sql .= " ORDER BY dob ASC";
}

$result = $conn->query($sql);

// Count query
$countQuery = "SELECT department, COUNT(*) as total FROM students GROUP BY department";
$countResult = $conn->query($countQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Student Dashboard</h2>

<!-- Filter + Sort -->
<form method="get">
    Department:
    <select name="dept">
        <option value="">All</option>
        <option value="CSE">CSE</option>
        <option value="IT">IT</option>
        <option value="ECE">ECE</option>
    </select>

    Sort:
    <select name="sort">
        <option value="">None</option>
        <option value="name">Name</option>
        <option value="dob">DOB</option>
    </select>

    <input type="submit" value="Apply">
</form>

<br>

<!-- Table -->
<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>DOB</th>
    <th>Department</th>
    <th>Phone</th>
</tr>

<?php
while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['dob']}</td>
        <td>{$row['department']}</td>
        <td>{$row['phone']}</td>
    </tr>";
}
?>

</table>

<br><br>

<!-- Count -->
<h3>Students per Department</h3>
<table border="1">
<tr>
    <th>Department</th>
    <th>Total</th>
</tr>

<?php
while($row = $countResult->fetch_assoc()) {
    echo "<tr>
        <td>{$row['department']}</td>
        <td>{$row['total']}</td>
    </tr>";
}
?>

</table>

</body>
</html>