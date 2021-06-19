DROP DATABASE IF EXISTS school_system;
CREATE DATABASE IF NOT EXISTS school_system;
USE school_system;

SELECT 'CREATING DATABASE STRUCTURE' as 'INFO';

DROP TABLE IF EXISTS groups,
                     subjects,
                     teachers,
                     subjectnteacher, 
                     students, 
                     marks;


create table groups(
group_id int  not null,
name varchar(40) not null,
PRIMARY KEY(group_id)
);


create table subjects (
subject_id int not null,
title varchar(40) not null,
PRIMARY KEY(subject_id)
);

CREATE TABLE teachers(
    teacher_id	INT		NOT NULL,
    first_name	VARCHAR(16)	NOT NULL,
    last_name	VARCHAR(16)	NOT NULL,
    PRIMARY KEY(teacher_id)
);

CREATE TABLE students (
    student_id  INT             NOT NULL,
    first_name  VARCHAR(14)     NOT NULL,
    last_name   VARCHAR(16)     NOT NULL,
    group_id	INT		NOT NULL,
    FOREIGN KEY (group_id)  REFERENCES groups (group_id)    ON DELETE CASCADE,
    PRIMARY KEY (student_id)
);

CREATE TABLE marks(
    mark_id	INT		NOT NULL,
    student_id	INT		NOT NULL,
    subject_id	INT 		NOT NULL,
    date	DATE		NOT NULL,
    mark	INT		NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students (student_id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects (subject_id) ON DELETE CASCADE,	
    PRIMARY KEY(mark_id)
);

CREATE TABLE subjectnteacher(
    subject_id	INT		NOT NULL,
    teacher_id	INT		NOT NULL,
    group_id	INT		NOT NULL,
    FOREIGN KEY (subject_id) REFERENCES subjects (subject_id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers (teacher_id) ON DELETE CASCADE,
    FOREIGN KEY (group_id)   REFERENCES groups (group_id) ON DELETE CASCADE
);

show tables;