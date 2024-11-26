<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yoga Classes Admin Page</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
        h1, h2 { color: #4CAF50; }
        .sidebar { position: fixed; left: 0; top: 0; width: 250px; height: 100%; background-color: #333; color: white; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 1.5em; }
        .sidebar a { color: white; display: block; padding: 10px; text-decoration: none; margin-bottom: 10px; border-radius: 5px; transition: background 0.3s; }
        .sidebar a:hover { background: #575757; }
        .main-content { margin-left: 260px; padding: 20px; }
        .card { background: white; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin-bottom: 20px; }
        .card h3 { margin-bottom: 15px; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background-color: #45a049; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        @media (max-width: 768px) { .sidebar { width: 100%; height: auto; position: relative; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h2>Yoga Admin Panel</h2>
        <a href="#dashboard">Dashboard</a>
        <a href="#manage-classes">Manage Classes</a>
        <a href="#manage-students">Manage Students</a>
        <a href="#registrations">Registrations</a>
        <a href="#deregistered-classes">Deregistered Classes</a>
    </div>

    
    <div class="main-content">
        <h1>Welcome, Admin!</h1>
        <div id="registrations" class="card">
            <h3>Active Registrations</h3>
            <table>
                <tr>
                    <th>Registration ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Class Type</th>
                    <th>Timing</th>
                    <th>Actions</th>
                </tr>
                <?php
                include('db.php');
                $sql = "SELECT id, name, email, class_type, timing FROM registrations WHERE deregistered = 0";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['class_type']}</td>
                                <td>{$row['timing']}</td>
                                <td><button class='btn'>Edit</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No registrations found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div id="deregistered-classes" class="card">
            <h3>Deregistered Classes</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Class Type</th>
                    <th>Timing</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT id, name, email, class_type, timing FROM registrations WHERE deregistered = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['class_type']}</td>
                                <td>{$row['timing']}</td>
                                <td>
                                    <form action='delete.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <button type='submit' class='btn'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No deregistered classes found.</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
