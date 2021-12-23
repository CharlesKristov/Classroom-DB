-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2021 at 05:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `course_detail_id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `type_id`, `teacher_id`, `classroom_id`, `course_detail_id`, `time`) VALUES
(1, 1, 1, 1, 1, '2021-12-01 12:00:00'),
(2, 1, 1, 2, 1, '2021-12-22 16:30:34'),
(3, 1, 4, 4, 6, '2021-12-10 15:00:00'),
(4, 2, 6, 11, 10, '2021-11-13 23:00:00'),
(5, 2, 10, 1, 5, '2021-12-04 07:00:00'),
(6, 2, 6, 11, 2, '2021-12-05 14:00:00'),
(7, 2, 5, 5, 10, '2021-12-22 16:30:34'),
(8, 2, 9, 2, 7, '2021-12-01 00:00:00'),
(9, 2, 8, 1, 2, '2021-11-04 10:00:00'),
(10, 1, 1, 11, 5, '2021-12-11 22:32:16'),
(11, 2, 8, 3, 8, '2021-11-05 20:00:00'),
(12, 1, 7, 11, 1, '2021-11-12 13:00:00'),
(13, 1, 10, 4, 9, '2021-12-25 15:32:38'),
(14, 2, 10, 2, 10, '2021-12-04 07:32:16'),
(15, 2, 1, 5, 3, '2021-12-22 16:30:34'),
(16, 2, 4, 5, 1, '2021-11-25 13:23:34'),
(17, 1, 6, 11, 3, '2021-11-20 06:39:34'),
(18, 2, 9, 8, 4, '2021-12-31 04:17:34'),
(19, 1, 3, 3, 9, '2021-12-05 06:18:05'),
(20, 2, 1, 6, 10, '2021-12-13 10:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `capacity`, `type_id`) VALUES
(1, 65, 1),
(2, 62, 1),
(3, 60, 1),
(4, 64, 1),
(5, 66, 1),
(6, 63, 1),
(7, 62, 1),
(8, 65, 1),
(9, 33, 2),
(10, 30, 2),
(11, 35, 2);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_detail`
--

CREATE TABLE `classroom_detail` (
  `classroom_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom_detail`
--

INSERT INTO `classroom_detail` (`classroom_id`, `student_id`) VALUES
(1, 1),
(1, 9),
(2, 2),
(2, 10),
(3, 3),
(3, 11),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 1),
(9, 4),
(9, 7),
(9, 10),
(10, 2),
(10, 5),
(10, 8),
(10, 11),
(11, 3),
(11, 6),
(11, 9);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_type`
--

CREATE TABLE `classroom_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom_type`
--

INSERT INTO `classroom_type` (`id`, `name`) VALUES
(1, 'Lecturer'),
(2, 'Laboratorium');

-- --------------------------------------------------------

--
-- Table structure for table `class_type`
--

CREATE TABLE `class_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_type`
--

INSERT INTO `class_type` (`id`, `name`) VALUES
(1, 'Guided Self Learning Class'),
(2, 'Video Conference');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `credit`) VALUES
(1, 'Character Building: Pancasila', 2),
(2, 'Algorithm and Programming', 6),
(3, 'Program Design Methods', 4),
(4, 'English for Business Presentation', 2),
(5, 'Discrete Mathematics', 4),
(6, 'Linear Algebra', 2),
(7, 'Character Building: Kewarganegaraan', 2),
(8, 'Data Structures', 6),
(9, 'Human and Computer Interaction', 4),
(10, 'English for Written Business Communication', 2),
(11, 'Entrepreneurship: Ideation', 2),
(12, 'Calculus', 4),
(13, 'Database System', 6);

-- --------------------------------------------------------

--
-- Table structure for table `course_detail`
--

CREATE TABLE `course_detail` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_detail`
--

INSERT INTO `course_detail` (`id`, `course_id`, `material_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 5, 4),
(5, 5, 5),
(6, 5, 6),
(7, 5, 7),
(8, 5, 8),
(9, 5, 9),
(10, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `title`, `video_link`, `attachment`, `session`) VALUES
(1, 'Algorithm & Programming', 'https://www.youtube.com/watch?v=Zq4upTEaQyM', '/attachments/2/1/flow-diagrams', 1),
(2, 'Algorithm & Programming', 'https://www.youtube.com/watch?v=Zq4upTEaQyM', '/attachments/2/2/pseudocode-example', 2),
(3, 'Introduction to C Programming I', 'http://binusianorg.sharepoint.com/sites/arc-digitalcontent/_layouts/15/guestaccess.aspx?guestaccesstoken=ARuAe6a%2B4QgSp7KedA1V%2Br8ctMxfzYxIM0j0V%2FS4pko%3D&docid=2_0709fed3b1ae248758d4bd56a3d9a6561&rev=1&e=Yl6efH', '/attachments/2/3/first-c-program', 3),
(4, 'Logic', 'https://www.youtube.com/watch?v=GN6SW80AP1I', '/attachments/5/1/propotional-logic', 1),
(5, 'Logic', 'https://www.youtube.com/watch?v=GN6SW80AP1I', '/attachments/5/2/logic-gates', 2),
(6, 'Quantifiers', 'https://www.youtube.com/watch?v=Jth7m3j8uGA', '/attachments/5/3/quantifiers', 3),
(7, 'Method of Proof', 'https://www.youtube.com/watch?v=Zu59aRg3pjY', '/attachments/5/4/indirect-proof', 4),
(8, 'Number Theory', 'https://www.youtube.com/watch?v=w0ZQvZLx2KA', '/attachments/5/5/introduction-to-number-theory', 5),
(9, 'Relation', 'https://www.youtube.com/watch?v=Crsyv7upe9g&t=2s', '/attachments/5/6/relation', 6),
(10, 'Graph', 'https://www.youtube.com/watch?v=LFKZLXVO-Dg', '/attachments/5/7/graph-theory-applications', 7);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `short_name`) VALUES
(1, 'Himpunan Mahasiswa Teknik Informatika', 'HIMTI'),
(2, 'Himpunan Mahasiswa Sistem Informasi', 'HIMSISFO'),
(3, 'Himpunan Mahasiswa Matematika', 'HIMMAT'),
(4, 'Himpunan Mahasiswa Desain Komunikasi Visual', 'HIMDKV'),
(5, 'Himpunan Mahasiswa Arsitek', 'HIMARS'),
(6, 'Bina Nusantara Computer Club', 'BNCC'),
(7, 'Bina Nusantara English Club', 'BNEC'),
(8, 'Binus Game Developer Club', 'BGDC'),
(9, 'B-VOICE Radio', 'B-VOICE'),
(10, 'Teach For Indonesia Student Community', 'TFI-SC');

-- --------------------------------------------------------

--
-- Table structure for table `organization_detail`
--

CREATE TABLE `organization_detail` (
  `organization_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization_detail`
--

INSERT INTO `organization_detail` (`organization_id`, `student_id`) VALUES
(1, 1),
(1, 3),
(2, 5),
(3, 8),
(4, 7),
(4, 10),
(5, 4),
(5, 6),
(5, 9),
(6, 1),
(6, 2),
(6, 7),
(6, 8),
(7, 6),
(8, 2),
(8, 3),
(8, 11),
(9, 4),
(9, 9),
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `dob`) VALUES
(1, 'Charles', 'Christopher', '2002-09-20'),
(2, 'Oliver', 'Chico', '2002-12-14'),
(3, 'Made', 'Agustha', '1997-08-01'),
(4, 'Rio', 'Nathaniel', '1996-10-23'),
(5, 'Vinsen', 'Nawir', '2001-11-01'),
(6, 'Jason', 'Harlim', '1997-08-06'),
(7, 'Edwin', 'Ario', '1999-09-18'),
(8, 'Rico', 'Susanto', '1999-11-11'),
(9, 'Gregorrius', 'Emmanuel', '2000-09-09'),
(10, 'Kevin', 'Nathaniel', '2002-02-01'),
(11, 'Venicia', 'Setiani', '2002-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `first_name`, `last_name`, `dob`) VALUES
(1, 'Erich', 'Reeves', '1969-06-08'),
(2, 'Gannon', 'Stein', '1979-01-04'),
(3, 'Maxwell', 'Pitts', '1972-11-09'),
(4, 'Cleo', 'Goodwin', '1973-06-07'),
(5, 'Cara', 'Pacheco', '1988-05-17'),
(6, 'Regan', 'Branch', '1977-12-17'),
(7, 'Natalie', 'Roy', '1972-08-11'),
(8, 'Hayley', 'Vega', '1970-04-15'),
(9, 'Melinda', 'Wilkerson', '1975-05-10'),
(10, 'Gary', 'Carney', '1978-07-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_type_id_fk` (`type_id`),
  ADD KEY `class_course_detail_id_fk` (`course_detail_id`),
  ADD KEY `class_teacher_id_fk` (`teacher_id`),
  ADD KEY `class_classroom_id_fk` (`classroom_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `classroom_detail`
--
ALTER TABLE `classroom_detail`
  ADD PRIMARY KEY (`classroom_id`,`student_id`),
  ADD KEY `clasroom_detail_student_id_fk` (`student_id`);

--
-- Indexes for table `classroom_type`
--
ALTER TABLE `classroom_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_type`
--
ALTER TABLE `class_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_detail`
--
ALTER TABLE `course_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_detail_course_id_fk` (`course_id`),
  ADD KEY `course_detail_material_id_fk` (`material_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_detail`
--
ALTER TABLE `organization_detail`
  ADD PRIMARY KEY (`organization_id`,`student_id`),
  ADD KEY `organization_detail_student_id_fk` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `classroom_type`
--
ALTER TABLE `classroom_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_type`
--
ALTER TABLE `class_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_detail`
--
ALTER TABLE `course_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_classroom_id_fk` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_course_detail_id_fk` FOREIGN KEY (`course_detail_id`) REFERENCES `course_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_teacher_id_fk` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_type_id_fk` FOREIGN KEY (`type_id`) REFERENCES `class_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_type_id_fk` FOREIGN KEY (`type_id`) REFERENCES `classroom_type` (`id`);

--
-- Constraints for table `classroom_detail`
--
ALTER TABLE `classroom_detail`
  ADD CONSTRAINT `clasroom_detail_clasroom_id_fk` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clasroom_detail_student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_detail`
--
ALTER TABLE `course_detail`
  ADD CONSTRAINT `course_detail_course_id_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_detail_material_id_fk` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization_detail`
--
ALTER TABLE `organization_detail`
  ADD CONSTRAINT `organization_detail_organization_id_fk` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organization_detail_student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
