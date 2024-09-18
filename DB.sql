CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    age INT,
    class VARCHAR(20),
    contact_info VARCHAR(255)
);
CREATE TABLE lessons (
    lesson_id INT AUTO_INCREMENT PRIMARY KEY,
    lesson_name VARCHAR(100),
    lesson_date DATE,
    topic VARCHAR(255)
);
CREATE TABLE grades (
    grade_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    lesson_id INT,
    grade VARCHAR(10),
    comments TEXT,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id)
);

CREATE TABLE grade_details (
    grade_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    lesson_id INT,
    attendance INT DEFAULT 0,
    psalm_14 INT DEFAULT 0,
    psalm_2 INT DEFAULT 0,
    psalm_103 INT DEFAULT 0,
    new_person INT DEFAULT 0,
    new_person_continued INT DEFAULT 0,
    competition INT DEFAULT 0,
    verses_recited INT DEFAULT 0,
    total INT DEFAULT 0,
    comments TEXT,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id)
);

ALTER TABLE grades ADD (
    attendance INT DEFAULT 0,
    psalm_14 INT DEFAULT 0,
    psalm_2 INT DEFAULT 0,
    psalm_103 INT DEFAULT 0,
    new_person INT DEFAULT 0,
    new_person_continued INT DEFAULT 0,
    competition INT DEFAULT 0,
    verses_recited INT DEFAULT 0,
    total INT DEFAULT 0
);

ALTER TABLE grades
DROP FOREIGN KEY grades_ibfk_1;

ALTER TABLE grades
ADD CONSTRAINT grades_ibfk_1
FOREIGN KEY (student_id)
REFERENCES students(student_id)
ON DELETE CASCADE;
