<?php
include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT lesson_id, lesson_name, lesson_date, topic FROM lessons";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الدروس</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>عرض الدروس</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>اسم الدرس</th>
                    <th>تاريخ الدرس</th>
                    <th>الموضوع</th>
                    <th>تحديث</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['lesson_id']}</td>
                            <td>{$row['lesson_name']}</td>
                            <td>{$row['lesson_date']}</td>
                            <td>{$row['topic']}</td>
                            <td><a href='update_lesson.php?id={$row['lesson_id']}' class='button'>تحديث</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>لا توجد بيانات لعرضها</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
