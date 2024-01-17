SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thumbnail_uri` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Generate content
INSERT INTO `posts` (`author_id`, `title`, `content`, `created_at`, `updated_at`, `deleted`)
VALUES 
  ('1', 'Debugging Techniques', 'Exploring advanced debugging techniques for efficient code troubleshooting.', '2022-01-20 14:45:00', NULL, '0'),
  ('1', 'Version Control Best Practices', 'Learn about version control best practices to streamline collaborative development.', '2022-02-02 09:30:00', NULL, '0'),
  ('1', 'Introduction to Docker', 'An in-depth guide on getting started with Docker and containerization.', '2022-02-10 12:00:00', NULL, '0'),
  ('1', 'Optimizing SQL Queries', 'Tips and tricks for optimizing SQL queries for better database performance.', '2022-02-18 15:20:00', NULL, '0'),
  ('1', 'Web Development Trends 2022', 'Explore the latest trends in web development and technologies shaping the industry.', '2022-03-05 11:10:00', NULL, '0'),
  ('1', 'Automated Testing Strategies', 'Implementing effective automated testing strategies to ensure code quality.', '2022-03-15 16:45:00', NULL, '0'),
  ('1', 'CI/CD Pipeline Setup', 'Step-by-step guide to setting up a continuous integration and continuous deployment pipeline.', '2022-04-02 08:30:00', NULL, '0'),
  ('1', 'JavaScript Frameworks Comparison', 'Comparing popular JavaScript frameworks for frontend development.', '2022-04-10 14:15:00', NULL, '0'),
  ('1', 'Secure Coding Practices', 'Essential secure coding practices to protect your applications from vulnerabilities.', '2022-04-20 10:00:00', NULL, '0'),
  ('1', 'Agile Development Methodology', 'An overview of the Agile development methodology and its benefits in software development.', '2022-05-05 13:50:00', NULL, '0');
