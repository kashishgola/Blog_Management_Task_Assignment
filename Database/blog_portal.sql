-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 23, 2026 at 01:11 PM
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
-- Database: `blog_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `ID` int(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `Slug` varchar(255) NOT NULL,
  `media_url` text NOT NULL,
  `Deleted_at` timestamp NULL DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`ID`, `Title`, `User_id`, `Description`, `Slug`, `media_url`, `Deleted_at`, `Created_at`, `Updated_at`) VALUES
(1, 'ERTYTFRGH124', 1, 'dfghjgfcvbnjkmljiuhygfrttttt', 'ertytfrgh124', 'https://pixabay.com/get/gaa9eabd4e785bd8fca2d581c787879dd07735caa62afabc093c02a878cf9bd0638ae57e14b8eff07c2ecf1290158f42da856c58562d9e437bd7e11ae030d5fe0_1280.jpg', NULL, '2026-02-23 08:40:21', '2026-02-23 08:40:21'),
(2, 'ERTYTFRGH', 1, 'dfghjgfcvbnjkmljiuhyg', 'ertytfrgh', 'https://pixabay.com/get/g9170283e9856f88f0e92bebc72db81f391756924ed6515751c194606703eecbc3f7172e250d415f36176eb83b3ba69e3_1280.jpg', NULL, '2026-02-23 08:41:55', '2026-02-23 08:41:55'),
(3, 'kljljlkj', 1, 'lkjlkj', 'kljljlkj', 'https://pixabay.com/get/gb1c00fe29add919d985926eb5c2a58194259998bb59e352c8d1dd784bdb51f8acc9404ce21295cbc05616de1dcaf89ea_1280.jpg', '2026-02-23 05:17:26', '2026-02-23 09:29:18', '2026-02-23 09:29:18'),
(4, 'user ', 1, 'fgiuyhgfhkljhgyui', 'user', 'https://pixabay.com/get/g577f7dde20c72e88ea86b8408a45c120282b4eddcac4e2b86d6ddf7e520adf2751c1c80a057a22612f7627595a6b9351adb516f919631ae1ad29354425d438ac_1280.jpg', '2026-02-23 05:13:55', '2026-02-23 09:33:36', '2026-02-23 09:33:36'),
(5, 'blog1', 1, 'fcghjuikoijhuygtfcvhbjk', 'blog1', 'https://pixabay.com/get/g09f7f2ba9719eba35ab481b6017169cb909b9c0691cfadd526c978a369288e5249d71be31ba11812f72ccb4d552044d037c251f93e607c5db446f5835ab00479_1280.jpg', NULL, '2026-02-23 10:08:36', '2026-02-23 10:08:36'),
(6, 'blog', 1, 'dfcgvhjuihuygtf', 'blog', 'https://pixabay.com/get/g09f7f2ba9719eba35ab481b6017169cb909b9c0691cfadd526c978a369288e5249d71be31ba11812f72ccb4d552044d037c251f93e607c5db446f5835ab00479_1280.jpg', '2026-02-23 07:06:36', '2026-02-23 10:10:31', '2026-02-23 10:10:31'),
(7, 'blog', 1, 'dfcgvhjuihuygtf', 'blog', 'https://pixabay.com/get/g09f7f2ba9719eba35ab481b6017169cb909b9c0691cfadd526c978a369288e5249d71be31ba11812f72ccb4d552044d037c251f93e607c5db446f5835ab00479_1280.jpg', NULL, '2026-02-23 10:13:46', '2026-02-23 10:13:46'),
(8, 'blog', 1, 'dfcgvhjuihuygtf', 'blog', 'https://pixabay.com/get/gb7b59895fdeef825fbeeedafbea4b1c86d21ec133657b1dde94c5d4b5f0f93b19c087b8af30b6037851cceeaf3eecf990114a5daebdb6ff35d2b6ce140b9f491_1280.jpg', '2026-02-23 07:06:30', '2026-02-23 10:14:01', '2026-02-23 10:14:01'),
(9, 'blog', 1, 'dfcgvhjuihuygtf', 'blog', 'https://pixabay.com/get/ge40acdee8166e77a9e20b07853b004af06480036ef04b5184ac5668ce7d3cf158c8a0f8462cbacea46cb5d40cf1a9d442d70b4407dc98043d850434050410ef8_1280.jpg', '2026-02-23 06:03:12', '2026-02-23 10:14:18', '2026-02-23 10:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `ID` int(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Description` longtext NOT NULL,
  `Slug` varchar(255) NOT NULL,
  `media_url` text NOT NULL,
  `Deleted_at` timestamp NULL DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID`, `Title`, `User_id`, `Description`, `Slug`, `media_url`, `Deleted_at`, `Created_at`, `Updated_at`) VALUES
(1, 'ERTYTFRGH124', 1, 'dfghjgfcvbnjkmljiuhygfrttttt', 'ertytfrgh124', 'https://pixabay.com/get/gaa9eabd4e785bd8fca2d581c787879dd07735caa62afabc093c02a878cf9bd0638ae57e14b8eff07c2ecf1290158f42da856c58562d9e437bd7e11ae030d5fe0_1280.jpg', '2026-02-23 06:50:06', '2026-02-23 08:40:21', '2026-02-23 08:40:21'),
(2, 'ERTYTFRGH', 1, 'dfghjgfcvbnjkmljiuhyg', 'ertytfrgh', 'https://pixabay.com/get/g9170283e9856f88f0e92bebc72db81f391756924ed6515751c194606703eecbc3f7172e250d415f36176eb83b3ba69e3_1280.jpg', '2026-02-23 06:50:10', '2026-02-23 08:41:55', '2026-02-23 08:41:55'),
(3, 'kljljlkj', 1, 'lkjlkj', 'kljljlkj', 'https://pixabay.com/get/gb1c00fe29add919d985926eb5c2a58194259998bb59e352c8d1dd784bdb51f8acc9404ce21295cbc05616de1dcaf89ea_1280.jpg', '2026-02-23 05:17:26', '2026-02-23 09:29:18', '2026-02-23 09:29:18'),
(4, 'user ', 1, 'fgiuyhgfhkljhgyui', 'user', 'https://pixabay.com/get/g577f7dde20c72e88ea86b8408a45c120282b4eddcac4e2b86d6ddf7e520adf2751c1c80a057a22612f7627595a6b9351adb516f919631ae1ad29354425d438ac_1280.jpg', '2026-02-23 05:13:55', '2026-02-23 09:33:36', '2026-02-23 09:33:36'),
(5, 'blog', 1, 'sdftgyhujikoijuhygvfbn', 'blog', 'https://pixabay.com/get/gbe3f3b52d6d7df78d7d24247c6350e7c43bf4bc36f05f5381e0c02f88d9506859c933bb40d875a296f4052c3ef2c0dfe617765f5217ae2ba5863048c83e98bcf_1280.jpg', '2026-02-23 05:38:07', '2026-02-23 10:03:53', '2026-02-23 10:03:53'),
(6, 'new post', 1, 'Create engaging,, high-quality post descriptions by focusing on authenticity, using short, punchy, or thoughtful, aesthetic captions. Incorporate strong, actionable calls to action (CTAs) to boost engagement, such as asking questions or driving traffic to a link in bio. Keep them intentional, value-driven, and on-brand, such as using bold, confident, or nature-focused themes', 'new-post', 'https://pixabay.com/get/g2612e75c637e989d8f0b6395a926feec7e108fc8e5cbe0d5d4327a30376d43e84ea107840364314ad851a9810db45a8f5793c6bc6fac5b87897f9ff9f781cbf1_1280.jpg', '2026-02-23 06:41:16', '2026-02-23 11:10:22', '2026-02-23 11:10:22'),
(7, '', 1, '', '', '', '2026-02-23 06:41:11', '2026-02-23 11:10:22', '2026-02-23 11:10:22'),
(8, '', 1, '', '', '', '2026-02-23 06:41:21', '2026-02-23 11:11:05', '2026-02-23 11:11:05'),
(9, '', 1, '', '', '', '2026-02-23 06:41:18', '2026-02-23 11:11:05', '2026-02-23 11:11:05'),
(10, 'Post', 1, 'Create engaging,, high-quality post descriptions by focusing on authenticity, using short, punchy, or thoughtful, aesthetic captions', 'post', 'https://pixabay.com/get/g2612e75c637e989d8f0b6395a926feec7e108fc8e5cbe0d5d4327a30376d43e84ea107840364314ad851a9810db45a8f5793c6bc6fac5b87897f9ff9f781cbf1_1280.jpg', '2026-02-23 06:43:55', '2026-02-23 11:13:05', '2026-02-23 11:13:05'),
(11, '', 1, '', '', '', '2026-02-23 06:43:51', '2026-02-23 11:13:05', '2026-02-23 11:13:05'),
(12, '', 1, '', '', '', '2026-02-23 06:43:59', '2026-02-23 11:13:38', '2026-02-23 11:13:38'),
(13, 'post 11', 1, 'Create engaging,, high-quality post descriptions by focusing on authenticity, using short, punchy, or thoughtful, aesthetic captions', 'post-11', '', NULL, '2026-02-23 11:13:38', '2026-02-23 11:13:38'),
(14, '', 1, '', '', '', '2026-02-23 06:44:44', '2026-02-23 11:14:34', '2026-02-23 11:14:34'),
(15, 'post 12', 1, 'Create engaging,, high-quality post descriptions by focusing on authenticity, using short, punchy, or thoughtful, aesthetic captions', 'post-12', 'https://pixabay.com/get/g7b4db2344dfe25ebd7da6634b612a346b70b13101ef2e6cc48f06fffcac3d6b8f894c4e1b16001a7579cc105703e636a35d210465abe422b8a1c1adddd3d303e_1280.jpg', NULL, '2026-02-23 11:14:34', '2026-02-23 11:14:34'),
(16, '', 1, '', '', '', '2026-02-23 06:50:13', '2026-02-23 11:16:33', '2026-02-23 11:16:33'),
(17, 'hiuy', 1, 'iuy', 'hiuy', 'https://pixabay.com/get/g0e64f865c4ec40b774f38a742de6b95ebd1c9d683e36e71e426cb0d48ab35ccf48285bda56cfd053dfa962d5707442b567abb0fd8190f3da9e0324cc93eaec4a_1280.jpg', '2026-02-23 06:50:16', '2026-02-23 11:16:33', '2026-02-23 11:16:33'),
(18, 'post 2', 1, 'jkljlkjkljljk', 'post-2', '', NULL, '2026-02-23 11:19:37', '2026-02-23 11:19:37'),
(19, 'post 10jhgjg', 1, 'dfghjn', 'post-10jhgjg', 'https://pixabay.com/get/g2612e75c637e989d8f0b6395a926feec7e108fc8e5cbe0d5d4327a30376d43e84ea107840364314ad851a9810db45a8f5793c6bc6fac5b87897f9ff9f781cbf1_1280.jpg', NULL, '2026-02-23 11:19:56', '2026-02-23 11:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('admin','user') NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `Password`, `Role`, `Created_at`, `Updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$ON/MAVzcsFqYybRapuntG.JcMuLuw1C4OZHoimJirMFvHpXc2dm3K', 'admin', '2026-02-22 19:46:13', '2026-02-22 19:46:13'),
(2, 'user1', 'user1@gmail.com', '$2y$10$zebX2XTP0xCy0jG2HhYDBODzTvlj5J6auuMYlJotFzchbg79Dw.Q2', 'user', '2026-02-22 19:46:13', '2026-02-22 19:46:13'),
(3, 'user2', 'user2@gmail.com', '$2y$10$Z86RIHM.wXkoiq4zqPUFFOVByB8KXW1gI1aZR.TGwEcSu7XMI2Wf6', 'user', '2026-02-22 19:46:13', '2026-02-22 19:46:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `post` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
