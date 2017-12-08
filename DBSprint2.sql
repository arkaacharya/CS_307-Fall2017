-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2017 at 12:56 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `ID` varchar(70) NOT NULL,
  `name` varchar(20) NOT NULL,
  `numMCQ` int(11) NOT NULL,
  `numEssay` int(11) NOT NULL,
  `timeLimit` int(11) NOT NULL,
  `owner` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
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
  `ansEssay1` varchar(300) DEFAULT NULL
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

