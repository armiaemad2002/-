<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php';

    $student_id = $_POST['student_id'];
    $lesson_id = $_POST['lesson_id'];
    $attendance = $_POST['attendance'];
    $psalm_14 = isset($_POST['psalm_14']) ? $_POST['psalm_14'] : 0;
    $psalm_2 = isset($_POST['psalm_2']) ? $_POST['psalm_2'] : 0;
    $psalm_103 = isset($_POST['psalm_103']) ? $_POST['psalm_103'] : 0;
    $new_person = isset($_POST['new_person']) ? $_POST['new_person'] : 0;
    $new_person_continued = isset($_POST['new_person_continued']) ? $_POST['new_person_continued'] : 0;
    $competition = $_POST['competition'];
    $verses_recited = $_POST['verses_recited'];
    $comments = $_POST['comments'];

    // حساب المجموع الكلي
    $total = $attendance + $psalm_14 + $psalm_2 + $psalm_103 + $new_person + $new_person_continued + $competition + $verses_recited;

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO grade_details (student_id, lesson_id, attendance, psalm_14, psalm_2, psalm_103, new_person, new_person_continued, competition, verses_recited, total, comments)
            VALUES ($student_id, $lesson_id, $attendance, $psalm_14, $psalm_2, $psalm_103, $new_person, $new_person_continued, $competition, $verses_recited, $total, '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo "تمت إضافة الدرجات بنجاح، المجموع الكلي: $total / 1000";
    } else {
        echo "خطأ: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة درجة</title>
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
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            max-width: 100%;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="number"],
        input[type="checkbox"],
        textarea,
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>إضافة درجة للطفل</h2>
        <form method="POST" action="add_grade.php">
            <label for="student_id">رقم الطفل:</label>
            <input type="number" id="student_id" name="student_id" required>

            <label for="lesson_id">رقم الدرس:</label>
            <input type="number" id="lesson_id" name="lesson_id" required>

            <label for="attendance">الحضور (50 لكل أسبوع):</label>
            <input type="number" id="attendance" name="attendance" min="0" max="200" required>

            <label for="psalm_14">مزمور 14 (100):</label>
            <input type="checkbox" id="psalm_14" name="psalm_14" value="100">

            <label for="psalm_2">مزمور 2 (100):</label>
            <input type="checkbox" id="psalm_2" name="psalm_2" value="100">

            <label for="psalm_103">مزمور 103 (200):</label>
            <input type="checkbox" id="psalm_103" name="psalm_103" value="200">

            <label for="new_person">جلب شخص جديد (50):</label>
            <input type="checkbox" id="new_person" name="new_person" value="50">

            <label for="new_person_continued">استمرار الشخص الجديد لأربع أسابيع (50):</label>
            <input type="checkbox" id="new_person_continued" name="new_person_continued" value="50">

            <label for="competition">مسابقة على الأربع دروس (200):</label>
            <input type="number" id="competition" name="competition" min="0" max="200">

            <label for="verses_recited">حفظ آية لكل درس (25 لكل درس، إجمالي 100):</label>
            <input type="number" id="verses_recited" name="verses_recited" min="0" max="100">

            <label for="comments">التعليقات:</label>
            <textarea id="comments" name="comments" rows="4"></textarea>

            <input type="submit" value="إضافة">
        </form>
    </div>
</body>
</html>
