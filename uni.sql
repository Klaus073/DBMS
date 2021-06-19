DROP DATABASE IF EXISTS university;
CREATE DATABASE IF NOT EXISTS university;
USE university;

CREATE TABLE `student` (
  `roll_no` varchar(10) NOT NULL,
  `st_name` varchar(30) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` varchar(16) NOT NULL,
  `address` varchar(250) NOT NULL,
  PRIMARY KEY (roll_no)
);

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`roll_no`, `st_name`, `f_name`, `gender`, `contact`, `address`) VALUES
('P19-6015', 'Ali Abbas Khan', 'Niaz Khan', 'Male', '03349174958', 'asdjflasdjfl'),
('P20-6005', 'abc', 'def', 'Male', '75675', 'hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--


CREATE TABLE avail_courses(
    
    `course_code` varchar(10) not null,
    `course_name` varchar(30) not null,
    `course_credits` varchar(30) not null
   
   
    
);  

CREATE TABLE `registered_courses`(
    `roll_no` varchar(10) NOT NULL,
    `course_code` varchar(10) not null,
    `course_name` varchar(30) not null,
    `course_credits` varchar(30) not null,
    
    FOREIGN KEY (`roll_no`) REFERENCES student(`roll_no`)
    
);
alter table avail_courses(
add PRIMARY KEY(`course_code`)
);

create table register(
`roll_no` varchar(10) NOT NULL,
`course_code` varchar(10) NOT NULL,
FOREIGN KEY (`roll_no`) REFERENCES student(`roll_no`),
FOREIGN KEY (`course_code`) REFERENCES avail_courses(`course_code`));


