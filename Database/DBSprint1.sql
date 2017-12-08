-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2017 at 10:05 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `examination`
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
  `loggedIn` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `password`, `name`, `bio`, `loggedIn`) VALUES
('student1', 'student1', 'student 1', 'No Data Available.', 0),
('student2', 'student2', 'student 2', 'No Data Available.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `bio` varchar(600) NOT NULL,
  `loggedIn` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`username`, `password`, `name`, `bio`, `loggedIn`) VALUES
('teacher1', 'teacher1', 'teacher 1', 'No Data Available.', 0),
('teacher2', 'teacher2', 'teacher 2', 'No Data Available.', 0);
