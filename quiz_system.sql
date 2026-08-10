-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 04:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'SNOWMAN', 'manshow917@gmail.com', 'testing_contact_system', 'hello wolrd🍁', '2026-03-04 16:03:00'),
(2, 'SNOWMAN', 'manshow917@gmail.com', 'testing_contact_system', 'hello wolrd🍁', '2026-03-04 16:08:19'),
(3, 'SNOWMAN', 'manshow917@gmail.com', 'testing_contact_system', 'hello wolrd🍁', '2026-03-04 16:09:41'),
(4, 'Karan Singh negi', 'manshow917@gmail.com', 'testing_contact_system_no3', 'hello_world$', '2026-03-04 16:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_text` text NOT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `correct_option` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES
(1, 1, 'What is the output of: typeof null?', 'null', 'undefined', 'object', 'number', 3),
(2, 1, 'Which method adds element at end of array?', 'push()', 'pop()', 'shift()', 'unshift()', 1),
(3, 1, 'Which is a JavaScript framework?', 'Laravel', 'Django', 'React', 'Flask', 3),
(4, 1, 'Which keyword declares variable?', 'var', 'int', 'define', 'print', 1),
(5, 1, 'Which symbol for strict equality?', '==', '=', '===', '!=', 3),
(26, 4, 'What is JSX?', 'Java XML', 'JavaScript XML', 'JSON XML', 'None', 2),
(27, 4, 'React is a?', 'Library', 'Framework', 'Language', 'Database', 1),
(28, 4, 'Who created React?', 'Google', 'Facebook', 'Microsoft', 'Apple', 2),
(29, 4, 'React uses which DOM?', 'Virtual DOM', 'Shadow DOM', 'Real DOM', 'Smart DOM', 1),
(30, 4, 'React files usually have extension?', '.jsx', '.react', '.node', '.angular', 1),
(31, 5, 'Python is?', 'Compiled', 'Interpreted', 'Markup', 'Database', 2),
(32, 5, 'Which keyword defines function?', 'func', 'define', 'def', 'function', 3),
(33, 5, 'Which data type is immutable?', 'List', 'Dictionary', 'Tuple', 'Set', 3),
(34, 5, 'Python created by?', 'James Gosling', 'Guido van Rossum', 'Dennis Ritchie', 'Bjarne Stroustrup', 2),
(35, 5, 'Which symbol is comment?', '//', '#', '--', '/* */', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `time_limit` int(11) DEFAULT 600,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `time_limit`, `created_at`) VALUES
(1, 'JavaScript Fundamentals', 'Basic JS quiz', 600, '2026-03-03 07:28:37'),
(4, 'React Basics', 'Beginner React Quiz', 600, '2026-03-05 04:39:28'),
(5, 'Python Basics', 'Beginner Python Quiz', 600, '2026-03-05 04:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `quiz_id`, `score`, `total_questions`, `percentage`, `created_at`) VALUES
(1, 1, 1, 2, 5, 40, '2026-03-03 07:22:14'),
(2, 1, 1, 3, 5, 60, '2026-03-03 07:38:58'),
(3, 1, 1, 3, 5, 60, '2026-03-03 07:47:50'),
(4, 1, 1, 3, 5, 60, '2026-03-03 07:51:34'),
(5, 1, 1, 3, 5, 60, '2026-03-03 07:52:44'),
(6, 1, 1, 3, 5, 60, '2026-03-05 04:53:38'),
(7, 1, 1, 2, 5, 40, '2026-03-05 05:41:25'),
(8, 1, 1, 2, 5, 40, '2026-03-05 06:01:45'),
(9, 1, 1, 2, 5, 40, '2026-03-05 06:02:35'),
(10, 1, 1, 2, 5, 40, '2026-03-05 06:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `created_at`) VALUES
(1, 'Karansinghnegi123456', 'karansinghnegi955@gmail.com', '$2y$10$EL91E04r.vDJI1mEOmFB7eJfTqqvLMSptzzDcqEUJ.YIMlbvfqO6m', '2026-03-01 11:41:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
