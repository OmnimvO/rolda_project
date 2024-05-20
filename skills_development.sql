CREATE TABLE IF NOT EXISTS student (
  student_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  date_of_birth DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS category_type (
  category_id INT PRIMARY KEY AUTO_INCREMENT,
  category_type ENUM('High-Level Languages', 'Low-Level Languages', 'Scripting Languages','Scripting Languages', 'Database Query Languages') NOT NULL,
  course ENUM('Information Technology', 'Computer Science') NOT NULL,
  department_name VARCHAR(100),
  student_id INT,
  FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS skills (
  skill_id INT PRIMARY KEY AUTO_INCREMENT,
  skill_name ENUM('C++', 'Python', 'Javascript', 'C#', 'PHP', 'SQL'),
  proficiency_level ENUM('Beginner', 'Intermediate', 'Advanced'),
  category_id INT,
  student_id INT,
  FOREIGN KEY (category_id) REFERENCES category_type(category_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS progress (
  progress_id INT PRIMARY KEY AUTO_INCREMENT,
  student_id INT,
  skill_id INT,
  progress_percentage INT,
  completion_date DATE,
  FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (skill_id) REFERENCES skills(skill_id) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT fk_progress_student FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT fk_progress_skill FOREIGN KEY (skill_id) REFERENCES skills(skill_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;