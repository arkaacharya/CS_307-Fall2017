-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2017 at 08:18 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `course1`
--

CREATE TABLE IF NOT EXISTS `course1` (
  `quesNum` int(10) unsigned NOT NULL,
  `question` varchar(300) DEFAULT NULL,
  `isMCQ` tinyint(1) DEFAULT NULL,
  `isEssay` tinyint(1) DEFAULT NULL,
  `opta` varchar(300) DEFAULT NULL,
  `optb` varchar(300) DEFAULT NULL,
  `optc` varchar(300) DEFAULT NULL,
  `optd` varchar(300) DEFAULT NULL,
  `corrAns` varchar(1) DEFAULT NULL,
  `ansEssay` varchar(700) DEFAULT NULL,
  PRIMARY KEY (`quesNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course1`
--

INSERT INTO `course1` (`quesNum`, `question`, `isMCQ`, `isEssay`, `opta`, `optb`, `optc`, `optd`, `corrAns`, `ansEssay`) VALUES
(1, 'Select a.						', 1, 0, 'a', 'b', 'c', 'd', 'a', NULL),
(2, 'Select b.						', 1, 0, 'a', 'b', 'c', 'd', 'b', NULL),
(3, 'Type a.', 0, 1, NULL, NULL, NULL, NULL, NULL, 'a'),
(4, 'Type b.', 0, 1, NULL, NULL, NULL, NULL, NULL, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `ID` varchar(70) NOT NULL,
  `name` varchar(20) NOT NULL,
  `numMCQ` int(11) NOT NULL,
  `numEssay` int(11) NOT NULL,
  `ExamMCQ` int(11) NOT NULL,
  `ExamEssay` int(11) NOT NULL,
  `timeLimit` int(11) NOT NULL,
  `owner` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `name`, `numMCQ`, `numEssay`, `ExamMCQ`, `ExamEssay`, `timeLimit`, `owner`) VALUES
('Course1teacher1', 'Course1', 2, 2, 2, 2, 2, 'teacher1');

-- --------------------------------------------------------

--
-- Table structure for table `student1`
--

CREATE TABLE IF NOT EXISTS `student1` (
  `course` varchar(60) NOT NULL,
  `teacher` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student1`
--

INSERT INTO `student1` (`course`, `teacher`) VALUES
('Course1', 'teacher1');

-- --------------------------------------------------------

--
-- Table structure for table `student2`
--

CREATE TABLE IF NOT EXISTS `student2` (
  `course` varchar(60) NOT NULL,
  `teacher` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student2`
--


-- --------------------------------------------------------

--
-- Table structure for table `studentanswers`
--

CREATE TABLE IF NOT EXISTS `studentanswers` (
  `studentName` varchar(30) NOT NULL,
  `course` varchar(20) NOT NULL,
  `totalCorrect` int(11) NOT NULL,
  `totalEssayGrade` int(11) NOT NULL,
  `achievedEssayGrade` int(11) NOT NULL,
  `finalPercentage` int(11) NOT NULL,
  `testTaken` tinyint(1) NOT NULL,
  `essayGraded` tinyint(1) NOT NULL,
  `ans1` varchar(1) NOT NULL DEFAULT '',
  `ansEssay1` varchar(300) DEFAULT NULL,
  `ansEssay2` varchar(300) DEFAULT NULL,
  `ansEssay3` varchar(300) DEFAULT NULL,
  `ans2` varchar(1) DEFAULT NULL,
  `ans3` varchar(1) DEFAULT NULL,
  `essay1Feedback` varchar(100) DEFAULT NULL,
  `essay2Feedback` varchar(100) DEFAULT NULL,
  `essay3Feedback` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentanswers`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `bio` varchar(600) NOT NULL,
  `loggedIn` tinyint(1) NOT NULL,
  `email` varchar(70) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `password`, `name`, `bio`, `loggedIn`, `email`) VALUES
('student2', 'student2', 'Student 2', 'No Data Available', 1, 'student2@test.com'),
('student1', 'student1', 'Student 1', 'No Data Available', 0, 'student1@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `teacher1`
--

CREATE TABLE IF NOT EXISTS `teacher1` (
  `course` varchar(60) NOT NULL,
  PRIMARY KEY (`course`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher1`
--

INSERT INTO `teacher1` (`course`) VALUES
('Course1');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `bio` varchar(600) NOT NULL,
  `loggedIn` tinyint(1) NOT NULL,
  `email` varchar(70) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`username`, `password`, `name`, `bio`, `loggedIn`, `email`) VALUES
('teacher1', 'teacher1', 'Teacher 1', 'No Data Available', 1, 'teacher1@test.com');
