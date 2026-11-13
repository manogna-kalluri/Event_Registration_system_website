CREATE DATABASE college_events_db;
USE college_events_db;


CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15),
    department VARCHAR(50),
    year VARCHAR(20),
    password VARCHAR(255) NOT NULL
);


CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    event_date DATE,
    venue VARCHAR(100),
    description TEXT,
    max_participants INT
);


CREATE TABLE registrations (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    event_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(30) DEFAULT 'Registered',
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (event_id) REFERENCES events(event_id),
    UNIQUE (student_id, event_id)
);

INSERT INTO events
(event_name, category, event_date, venue, description, max_participants)
VALUES
('Web Development Workshop', 'Technical', '2026-12-15',
 'Computer Lab', 'Learn the basics of web development.', 50),

('Code Challenge', 'Technical', '2026-12-18',
 'Seminar Hall', 'Test your programming skills.', 40),

('Dance Competition', 'Cultural', '2026-12-20',
 'College Auditorium', 'Show your dancing talent.', 30),

('Singing Competition', 'Cultural', '2026-12-22',
 'College Auditorium', 'Show your singing talent.', 30),

('Cricket Tournament', 'Sports', '2026-12-25',
 'College Ground', 'Participate in the cricket tournament.', 60),

('Quiz Competition', 'Academic', '2026-12-28',
 'Seminar Hall', 'Test your general knowledge.', 40);
 select*from events;
 select*from students;
 show tables;
 select*from students;
 select*from registrations;

INSERT INTO admins (username, password)
VALUES ('admin', 'admin123');
 
