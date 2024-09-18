-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 12:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educard`
--

-- --------------------------------------------------------

--
-- Table structure for table `english`
--

CREATE TABLE `english` (
  `id` int(100) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `lesson_number` varchar(50) NOT NULL,
  `term` varchar(1000) NOT NULL,
  `definition` varchar(1000) NOT NULL,
  `is_new` varchar(10) NOT NULL DEFAULT '',
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `english_quiz`
--

CREATE TABLE `english_quiz` (
  `quiz_number` int(55) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'English',
  `quiz_title` varchar(55) NOT NULL,
  `question` varchar(255) NOT NULL,
  `choice1` varchar(55) NOT NULL,
  `choice2` varchar(55) NOT NULL,
  `choice3` varchar(55) NOT NULL,
  `choice4` varchar(55) NOT NULL,
  `correct_answer` varchar(55) NOT NULL,
  `timer` int(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `english_teacher`
--

CREATE TABLE `english_teacher` (
  `id` int(55) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'English',
  `lesson_number` int(55) NOT NULL,
  `term` varchar(55) NOT NULL,
  `definition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filipino`
--

CREATE TABLE `filipino` (
  `id` int(100) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `lesson_number` varchar(50) NOT NULL,
  `term` varchar(1000) NOT NULL,
  `definition` varchar(1000) NOT NULL,
  `is_new` varchar(10) NOT NULL DEFAULT 'false',
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filipino_quiz`
--

CREATE TABLE `filipino_quiz` (
  `quiz_number` int(100) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Filipino',
  `quiz_title` varchar(55) NOT NULL,
  `question` varchar(255) NOT NULL,
  `choice1` varchar(55) NOT NULL,
  `choice2` varchar(55) NOT NULL,
  `choice3` varchar(55) NOT NULL,
  `choice4` varchar(55) NOT NULL,
  `correct_answer` varchar(55) NOT NULL,
  `timer` int(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filipino_teacher`
--

CREATE TABLE `filipino_teacher` (
  `id` int(55) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Filipino',
  `lesson_number` int(100) NOT NULL,
  `term` varchar(55) NOT NULL,
  `definition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `math`
--

CREATE TABLE `math` (
  `id` int(100) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `lesson_number` varchar(100) NOT NULL,
  `term` varchar(1000) NOT NULL,
  `definition` varchar(1000) NOT NULL,
  `is_new` varchar(10) NOT NULL DEFAULT 'false',
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `math_quiz`
--

CREATE TABLE `math_quiz` (
  `quiz_number` varchar(100) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Math',
  `quiz_title` varchar(55) NOT NULL,
  `question` varchar(255) NOT NULL,
  `choice1` varchar(55) NOT NULL,
  `choice2` varchar(3055) NOT NULL,
  `choice3` varchar(55) NOT NULL,
  `choice4` varchar(55) NOT NULL,
  `correct_answer` varchar(55) NOT NULL,
  `timer` int(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `math_teacher`
--

CREATE TABLE `math_teacher` (
  `id` int(11) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Math',
  `lesson_number` int(55) NOT NULL,
  `term` varchar(55) NOT NULL,
  `definition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correct_answer` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `score` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `science`
--

CREATE TABLE `science` (
  `id` int(250) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Science',
  `lesson_number` varchar(50) NOT NULL,
  `term` varchar(100) NOT NULL,
  `definition` varchar(1000) NOT NULL,
  `is_new` varchar(6) DEFAULT 'false',
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `science_quiz`
--

CREATE TABLE `science_quiz` (
  `quiz_number` int(100) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Science',
  `quiz_title` varchar(55) NOT NULL,
  `question` varchar(255) NOT NULL,
  `choice1` varchar(30) NOT NULL,
  `choice2` varchar(30) NOT NULL,
  `choice3` varchar(30) NOT NULL,
  `choice4` varchar(30) NOT NULL,
  `correct_answer` varchar(30) NOT NULL,
  `timer` int(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `science_teacher`
--

CREATE TABLE `science_teacher` (
  `id` int(255) NOT NULL,
  `subject` varchar(55) NOT NULL DEFAULT 'Science',
  `lesson_number` int(100) NOT NULL,
  `term` varchar(55) NOT NULL,
  `definition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(55) NOT NULL,
  `full_name` varchar(55) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `quiz_number` int(55) NOT NULL,
  `score` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`score_id`, `full_name`, `subject`, `quiz_number`, `score`, `date`) VALUES
(97, 'St. John Student', 'Math', 30, 10, '2024-06-15 01:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `student_acc`
--

CREATE TABLE `student_acc` (
  `id` int(11) NOT NULL,
  `student_id` int(55) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `id_card_no` int(50) NOT NULL,
  `grade_section` varchar(55) NOT NULL,
  `birthday` varchar(155) NOT NULL,
  `pic` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_acc`
--

INSERT INTO `student_acc` (`id`, `student_id`, `full_name`, `email`, `username`, `password`, `id_card_no`, `grade_section`, `birthday`, `pic`) VALUES
(1, 12, 'sfsdffsdfsd', 's@mail.com', 'dsfsfsdfsdfsd', '123', 123, '', '', ''),
(2, 14, 'Robert Louise M. Alcozer', 'robyalcozer@gmail.com', 'robywe', 'wews', 696969, 'BSIT 4-1', '', 'https://i.imgur.com/AX0fU3R.jpg'),
(3, 15, 'Roby Alcozer', 'roby69@gmail.com', 'robywew', 'roby03', 391293, '', 'May 03, 2001', 'https://i.imgur.com/AX0fU3R.jpg'),
(4, 16, 'Roby lang to guys', 'robystudent@gmail.com', 'robystudent', 'robystudent', 39129323, '', '', ''),
(5, 17, 'St. John Student', '', 'sjastudent', 'sjastudent', 123456789, '', '', 'uploads/defaultdp.jpg'),
(6, 0, 'Robert Louise Alcozer', 'robertalcozerr@gmail.com', 'roby03', 'robytest', 2147483647, '', '', 'uploads/defaultdp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(100) NOT NULL,
  `subject_name` varchar(20) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `image`) VALUES
(1, 'English', 'https://i.imgur.com/jslJXAP.png'),
(2, 'Filipino', 'https://i.imgur.com/69OCIwu.png');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_acc`
--

CREATE TABLE `teacher_acc` (
  `teacher_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` varchar(55) NOT NULL,
  `pic` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_acc`
--

INSERT INTO `teacher_acc` (`teacher_id`, `full_name`, `email`, `username`, `password`, `birthday`, `pic`) VALUES
(60, 'St. John Academy Teacher', '', 'sjateacher', 'sjateacher', '', 'uploads/defaultdp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `qid` int(100) NOT NULL,
  `title` varchar(55) NOT NULL,
  `quiz_number` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`qid`, `title`, `quiz_number`, `date`) VALUES
(2, 'Peke', 20, '2023-12-30 05:19:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `english`
--
ALTER TABLE `english`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english_quiz`
--
ALTER TABLE `english_quiz`
  ADD PRIMARY KEY (`question`);

--
-- Indexes for table `english_teacher`
--
ALTER TABLE `english_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filipino`
--
ALTER TABLE `filipino`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filipino_quiz`
--
ALTER TABLE `filipino_quiz`
  ADD PRIMARY KEY (`question`);

--
-- Indexes for table `filipino_teacher`
--
ALTER TABLE `filipino_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `math`
--
ALTER TABLE `math`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `math_quiz`
--
ALTER TABLE `math_quiz`
  ADD PRIMARY KEY (`question`);

--
-- Indexes for table `math_teacher`
--
ALTER TABLE `math_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `science`
--
ALTER TABLE `science`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `science_quiz`
--
ALTER TABLE `science_quiz`
  ADD PRIMARY KEY (`question`);

--
-- Indexes for table `science_teacher`
--
ALTER TABLE `science_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `student_acc`
--
ALTER TABLE `student_acc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`,`id_card_no`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_acc`
--
ALTER TABLE `teacher_acc`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`qid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `english`
--
ALTER TABLE `english`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `english_teacher`
--
ALTER TABLE `english_teacher`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filipino`
--
ALTER TABLE `filipino`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `filipino_teacher`
--
ALTER TABLE `filipino_teacher`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `math`
--
ALTER TABLE `math`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `math_teacher`
--
ALTER TABLE `math_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `science`
--
ALTER TABLE `science`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `science_teacher`
--
ALTER TABLE `science_teacher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `student_acc`
--
ALTER TABLE `student_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_acc`
--
ALTER TABLE `teacher_acc`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `qid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
