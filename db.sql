-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 03, 2022 lúc 04:06 PM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `trouvaille_course`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.jpg',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lever` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `description`, `password`, `token`, `lever`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'avatar.jpg', 'đây là tài khoản admin của e-learing - bất khả xâm phạm', '$2y$10$/1OiAqeLYry5GT61olv0jORZnF31To/4TD5HPZIVkeEFEyNPSvhlO', '59f3608d3f6577dc339384516df100f7', 2, '2022-05-17 00:29:31', '2022-10-03 01:07:16'),
(79, 'test1', 'test01@gmail.com', 'avatar.jpg', 'tai thoan demo', '$2y$10$rUXsxgbhdK8cVQ8BkPr3He4aMeQJKLvUabewq6ACkIfwThYShGkL.', '5f23c8d374294b9560737b9342bf4d25', 1, '2022-10-03 01:06:13', '2022-10-03 06:05:24'),
(80, 'tai khoan so 2', 'test02@gmail.com', 'avatar.jpg', 'tai khoan so 2 một trong những tài khoản vip nhất ở sever', '$2y$10$AfrTQGWj5Nn0E0q6Y9OSveu8PKuWMLRzOHFM/P7rvXokuwnQANaHi', '4a29f389381b4a4f8c75aa24fbec3460', 0, '2022-10-03 08:52:12', '2022-10-03 08:52:12'),
(81, 'tai khoan so 3', 'test03@gmail.com', 'avatar.jpg', 'Tai khoan so 3 day chi là 1 con tót', '$2y$10$CUQf0aBg2i/nd06sk1Q.2e8JP55.YJ4Gbb48MLEGggfbT1n6xMHb6', '792c12b8589496499e9219df37e5b14a', 0, '2022-10-03 08:52:44', '2022-10-03 08:52:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questions_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `check` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `id_admin`, `name`, `image`, `price`, `type`, `description`, `created_at`, `updated_at`) VALUES
(204, 79, 'Khóa học của trung tâm', '1664802445.png', 300000, 2, '<h2 id=\"ftoc-heading-1\" class=\"ftwp-heading\" style=\"box-sizing: border-box; color: #1c1d3e; width: 836px; margin-top: 0px; margin-bottom: 0.5em; text-rendering: optimizespeed; font-size: 1.6em; line-height: 1.3; font-family: Cabin, sans-serif; background-color: #ffffff;\">1. Tiếng Anh</h2>\r\n<p style=\"box-sizing: border-box; margin-bottom: 1.3em; margin-top: 0px; color: #5f5f5f; font-family: \'Varela Round\', sans-serif; background-color: #ffffff;\"><span style=\"box-sizing: border-box; font-weight: bolder;\">Tiếng Anh gần như là chứng chỉ bắt buộc để một người có thể bắt đầu làm việc tại một công ty tốt, hoặc ra nước ngoài sinh sống</span>. Hơn chục năm nay, rất nhiều bậc cha mẹ đã tìm đến các trung tâm ngoại ngữ, các lớp dạy thêm tiếng Anh để cho con mình rèn luyện thứ tiếng toàn cầu này.</p>\r\n<p style=\"box-sizing: border-box; margin-bottom: 1.3em; margin-top: 0px; color: #5f5f5f; font-family: \'Varela Round\', sans-serif; background-color: #ffffff;\">Tuy nhiên, học tiếng Anh trong các trung tâm ngoại ngữ rất tốn kém và mệt mỏi. Nhiều học sinh phải học 5 buổi/tuần mà thu được chất lượng chẳng hơn gì so với ở trường.</p>\r\n<p style=\"box-sizing: border-box; margin-bottom: 1.3em; margin-top: 0px; color: #5f5f5f; font-family: \'Varela Round\', sans-serif; background-color: #ffffff;\">Đối với những người đã đi làm, việc dành buổi tối quý báu bên gia đình cho việc học thêm tiếng Anh là điều rất đắn đo. Hơn nữa, mỗi người đều có sở thích, phương pháp học tập và khả năng tiếp thu riêng biệt.</p>\r\n<p style=\"box-sizing: border-box; margin-bottom: 1.3em; margin-top: 0px; color: #5f5f5f; font-family: \'Varela Round\', sans-serif; background-color: #ffffff;\">Chỉ có những lớp học tiếng Anh trực tuyến mới có thể dễ dàng đáp ứng được những điều kiện đó với cái giá phải chăng. Nó giúp tiết kiệm rất nhiều tiền của và công sức để đạt được năng lực và chứng chỉ tiếng Anh – thứ “thuế” qua cửa của mọi cơ quan, công ty trong xã hội hiện đại.</p>\r\n<p style=\"box-sizing: border-box; margin-bottom: 1.3em; margin-top: 0px; color: #5f5f5f; font-family: \'Varela Round\', sans-serif; background-color: #ffffff;\">Có thể thấy, <span style=\"box-sizing: border-box; font-weight: bolder;\">học tiếng Anh là nhu cầu cao nhất trong thị trường học online</span>.</p>', '2022-10-03 06:07:25', '2022-10-03 06:18:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courses_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lessons`
--

INSERT INTO `lessons` (`id`, `courses_id`, `name`, `link`, `description`, `created_at`, `updated_at`) VALUES
(3013, 204, 'Cảm Ơn Vì Ai Đó Đã Mang Đến Em Tiếng Cười... Cảm Ơn Vì Tất Cả | Nhạc Chill TikTok 2022', 'https://www.youtube.com/embed/uuqKlmPctF8', 'Cảm Ơn Vì Ai Đó Đã Mang Đến Em Tiếng Cười... Cảm Ơn Vì Tất Cả | Nhạc Chill TikTok 2022 hi hi a hihi', '2022-10-03 06:09:54', '2022-10-03 06:09:54'),
(3014, 204, 'Những Bản Lofi Việt Nhẹ Nhàng Cực Chill Nhạc Lofi Chill Buồn Nhất 2022 Lofi Gây Nghiện Hay Nhất', 'https://www.youtube.com/embed/ehcCLByM46o', 'Những Bản Lofi Việt Nhẹ Nhàng Cực Chill Nhạc Lofi Chill Buồn Nhất 2022 Lofi Gây Nghiện Hay Nhất', '2022-10-03 06:19:52', '2022-10-03 06:19:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_08_155920_create_admins_table', 1),
(3, '2022_04_19_032152_create_users_table', 1),
(4, '2022_04_19_033709_create_courses_table', 1),
(5, '2022_04_19_130657_create_lessons_table', 1),
(6, '2022_04_20_025344_create_orders_table', 1),
(7, '2022_04_20_035512_create_view_histories_table', 1),
(19, '2022_04_20_040242_create_questions_table', 2),
(20, '2022_04_20_040744_create_answers_table', 2),
(22, '2022_04_20_041011_create_results_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `courses_id` bigint(20) UNSIGNED NOT NULL,
  `price_buy` int(11) NOT NULL,
  `rate` double(8,2) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `courses_id`, `price_buy`, `rate`, `comment`, `created_at`, `updated_at`) VALUES
(2009, 1201, 204, 300000, 5.00, 'hay qua', '2022-10-03 06:22:09', '2022-10-03 06:22:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lessons_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questions_id` bigint(20) UNSIGNED NOT NULL,
  `number_true` int(11) NOT NULL DEFAULT '0',
  `number_false` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1201, 'Hung', 'test01@gmail.com', 'avatar.png', '$2y$10$nvxpEFY1nM/nJvzi9aidUuejJ7RSwUz5H9fg8MukVEUjEIPou78bi', 'c0c0e4af3f0948f128449f3ec12f6c85', '2022-10-03 06:21:44', '2022-10-03 06:21:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `view_histories`
--

CREATE TABLE `view_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `courses_id` bigint(20) UNSIGNED NOT NULL,
  `number_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `view_histories`
--

INSERT INTO `view_histories` (`id`, `users_id`, `courses_id`, `number_view`) VALUES
(2007, 1201, 204, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_questions_id_foreign` (`questions_id`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_id_admin_foreign` (`id_admin`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_courses_id_foreign` (`courses_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_users_id_foreign` (`users_id`),
  ADD KEY `orders_courses_id_foreign` (`courses_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_lessons_id_foreign` (`lessons_id`);

--
-- Chỉ mục cho bảng `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_questions_id_foreign` (`questions_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_token_unique` (`token`);

--
-- Chỉ mục cho bảng `view_histories`
--
ALTER TABLE `view_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_histories_users_id_foreign` (`users_id`),
  ADD KEY `view_histories_courses_id_foreign` (`courses_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20009;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3015;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2010;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5004;

--
-- AUTO_INCREMENT cho bảng `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5004;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1202;

--
-- AUTO_INCREMENT cho bảng `view_histories`
--
ALTER TABLE `view_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2008;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_questions_id_foreign` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`);

--
-- Các ràng buộc cho bảng `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`);

--
-- Các ràng buộc cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `orders_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_lessons_id_foreign` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`);

--
-- Các ràng buộc cho bảng `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_questions_id_foreign` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`);

--
-- Các ràng buộc cho bảng `view_histories`
--
ALTER TABLE `view_histories`
  ADD CONSTRAINT `view_histories_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `view_histories_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
