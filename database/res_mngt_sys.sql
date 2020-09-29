-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2020 at 12:38 AM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `res_mngt_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `erp_user`
--

CREATE TABLE `erp_user` (
  `rest_id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userimg` varchar(255) NOT NULL,
  `role` int(10) NOT NULL,
  `user_qrcode` varchar(255) NOT NULL,
  `email_verification_code` varchar(255) NOT NULL,
  `varified` int(10) NOT NULL,
  `online_pay_status` varchar(255) NOT NULL DEFAULT 'off',
  `delete_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-active,1-inactive',
  `date_crt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user`
--

INSERT INTO `erp_user` (`rest_id`, `name`, `email`, `password`, `phone`, `address`, `userimg`, `role`, `user_qrcode`, `email_verification_code`, `varified`, `online_pay_status`, `delete_status`, `date_crt`) VALUES
(13, 'guru', 'gc.abhi@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 'assets/uploads/profile/13/24477.jpg', 1, '13.png', '13nRGi7UDv4CkE7JHP1o', 1, 'off', 0, '2020-06-06 07:09:03'),
(16, 'sfdsdfsd', 'gcs.abhi@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 0, '', '8338802ef6c45dfb4da1fd46af2d7ae7', 0, 'off', 1, '2020-06-06 10:32:51'),
(17, 'Nimrod\'s Kitchen', 'test001@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 'assets/uploads/profile/17/Untitled-1.png', 0, '', '2d30025cc3b82e2ff411747c0cb02f4b', 0, 'on', 0, '2020-06-06 12:49:52'),
(18, 'Nombre', 'qwe@qe.fgf', '7815696ecbf1c96e6894b779456d330e', '', '', '', 0, '', '7f9b97fdeb11e9a603874ff0ea2b08c3', 0, 'off', 0, '2020-06-07 12:11:32'),
(19, 'Test Restaurant13', 'test@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 'assets/uploads/profile/19/top-logo-svenskasaker-300px.png', 0, '19.png', 'ad335e99d00d4fdedad2c482b913ea8d', 0, 'on', 0, '2020-06-07 16:02:03'),
(20, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', 0, '', '1c212eae844865c25ca473baa29017e5', 0, 'off', 1, '2020-06-07 16:33:35'),
(21, 'Taj', 'tanujamwal001@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 'assets/uploads/profile/21/125859954-indian-hindu-veg-thali-food-platter-selective-focus.jpg', 0, '', 'eed3e7668545020d4b7319e3e853fbd3', 0, 'off', 1, '2020-06-13 16:46:49'),
(22, 'gcs_test', 'gcs.test@gmail.com', 'ceb6c970658f31504a901b89dcd3e461', '', '', 'assets/uploads/profile/22/testimonials_bg.jpg', 0, '', 'f734de8af615c555305556b5f12ddb2b', 0, 'on', 0, '2020-07-18 05:34:50'),
(23, 'STREETREAT', 'amandeep.kr1010@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 'assets/uploads/profile/23/streety-treat-logo.png', 0, '', '8a9b6bcbb604ce7983b18c798cb7d3c3', 0, 'off', 0, '2020-08-25 15:04:00'),
(24, 'Jashn Bar and Restaurant', 'raw@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 'assets/uploads/profile/24/34641760-vertical-background-texture-of-white-wooden-wall.jpg', 0, '', '0f035f43ee379007a19e1483c7f2e0de', 0, 'off', 0, '2020-09-07 16:44:52'),
(25, 'Vegaan Prashant Vihar', 'vegaan.prashantvihar@iemenu.in', '032494ce535440f1ed407721f692084e', '', '', '', 0, '', '8ac8cce905d01d5deddfe10e05ec8537', 0, 'off', 0, '2020-09-22 07:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `menu_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `is_publish` enum('Yes','No') DEFAULT 'No',
  `is_availaible` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menu_id`, `rest_id`, `title`, `description`, `note`, `image`, `is_publish`, `is_availaible`, `created_at`) VALUES
(1, 13, 'menu2', 'demo menu 1', NULL, '', 'No', 'Yes', NULL),
(2, 13, 'menu1', 'demo', NULL, '', 'No', 'Yes', NULL),
(3, 13, 'Test Menu', 'Test Menu', NULL, '', 'No', 'Yes', '2020-06-14 09:41:27'),
(4, 0, 'Test', 'Xbdbebdbd', NULL, '', 'No', 'Yes', '2020-06-14 09:41:54'),
(5, 13, 'Test Menu', 'Test Menu', NULL, '', 'No', 'Yes', '2020-06-14 09:42:48'),
(6, 21, 'Veg', 'xyz', '', 'assets/uploads/menu/vegan-desserts.jpg', 'Yes', 'Yes', '2020-06-28 03:16:02'),
(9, 21, 'Starter', 'tt', '', 'assets/uploads/menu/chicken_seekh.jpg', 'Yes', 'Yes', '2020-06-21 12:23:20'),
(10, 21, 'Non-Veg', 'dasdasd', '', 'assets/uploads/menu/Curry_chicken.jpg', 'Yes', 'Yes', '2020-06-21 12:27:12'),
(11, 19, 'Starters', 'Give your taste buds a treat', '', 'assets/uploads/menu/1.jpg', 'Yes', 'Yes', '2020-06-26 09:05:23'),
(12, 19, 'Appetizers', 'Best range of appetizers', '', 'assets/uploads/menu/11.jpg', 'Yes', 'Yes', '2020-06-26 09:07:26'),
(13, 19, 'Sandwiches', 'You can find many varieties', '', 'assets/uploads/menu/12.jpg', 'Yes', 'Yes', '2020-07-27 10:07:55'),
(14, 19, 'Mains', 'Burgers. Casseroles. Chicken Main Dishes. Goulash. Lasagna. Macaroni and Cheese.', '', 'assets/uploads/menu/mains.jpg', 'Yes', 'Yes', '2020-06-26 09:11:39'),
(15, 19, 'Desserts', 'Give yourself joy of variety of desserts', '', 'assets/uploads/menu/13.jpg', 'Yes', 'Yes', '2020-06-26 09:13:26'),
(16, 17, 'Fresh Fruit Juice', 'Seasonal', '', 'assets/uploads/menu/Healthy-Juice-Cleanse-Recipes-1.jpg', 'Yes', 'Yes', '2020-08-04 15:47:58'),
(17, 17, 'Milk Shakes', '250ml', '', 'assets/uploads/menu/BBB71-Homemade-Ice-Cream-Milkshakes-Thumbnail-v_1.jpg', 'Yes', 'Yes', '2020-08-04 15:48:14'),
(18, 17, 'Cold Beverages', '250ml', '', 'assets/uploads/menu/361921454-H.jpg', 'Yes', 'Yes', '2020-08-04 15:48:25'),
(19, 17, 'Hot Beverages', '250ml', '', 'assets/uploads/menu/hot_beverages.jpg', 'Yes', 'Yes', '2020-08-04 15:48:33'),
(20, 17, 'Sweets', '', '', 'assets/uploads/menu/sweets.jpg', 'Yes', 'Yes', '2020-08-04 15:48:44'),
(21, 17, 'South Indian Snacks', '', '', 'assets/uploads/menu/South_indian_snacks.jpg', 'No', 'Yes', '2020-08-04 15:49:00'),
(22, 17, 'Uthapams', '', '', 'assets/uploads/menu/uttapam-recipes_806x605_81507637803.jpg', 'No', 'Yes', '2020-08-04 15:49:11'),
(23, 17, 'Dosas', '', '', 'assets/uploads/menu/dosa-recipe-500x500.jpg', 'No', 'Yes', '2020-08-04 15:49:23'),
(24, 17, 'VEG Fixed Thali', '', '', 'assets/uploads/menu/veg_thali.jpg', 'No', 'Yes', '2020-08-04 15:49:37'),
(25, 17, 'North Indian Snacks', '', '', 'assets/uploads/menu/north_indian_snacks.jpg', 'No', 'Yes', '2020-08-04 15:49:50'),
(27, 23, 'Chinese ', 'Steamed', '', 'assets/uploads/menu/e4pkjtqcuyrrc2h1sdod.jpg', 'Yes', 'Yes', '2020-08-25 21:21:52'),
(32, 17, 'Rice', 'Hot Server Item', '', 'assets/uploads/menu/images.jpg', 'Yes', 'Yes', '2020-09-17 09:25:22'),
(33, 24, 'ROTI  ITEMS', 'Hot Served', '', 'assets/uploads/menu/indian-chapati-roti-being-prepared-35010889.jpg', 'Yes', 'Yes', '2020-09-18 09:49:27'),
(34, 24, 'Fried Rice and Noodles', 'Hot Served', '', 'assets/uploads/menu/download_(5).jpg', 'Yes', 'Yes', '2020-09-18 09:59:25'),
(35, 24, 'Biryani Items', 'Hot Served', '', 'assets/uploads/menu/download_(10).jpg', 'Yes', 'Yes', '2020-09-18 10:11:54'),
(36, 25, 'Shakes', '', '', '', 'Yes', 'Yes', '2020-09-22 13:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` text,
  `price_desc` text,
  `food_type` varchar(100) NOT NULL,
  `is_publish` enum('Yes','No') DEFAULT 'Yes',
  `is_availaible` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `menu_id`, `name`, `description`, `image`, `price`, `price_desc`, `food_type`, `is_publish`, `is_availaible`, `created_at`) VALUES
(1, 1, 'item1', 'desc1', '', '700', NULL, 'veg', 'Yes', 'Yes', NULL),
(2, 1, 'item2', 'desc2', '', '700', NULL, 'non-veg', 'Yes', 'Yes', NULL),
(3, 2, 'item2', 'desc3', '', '700', NULL, 'non-veg', 'Yes', 'Yes', NULL),
(5, 5, 'Test Item 1', 'Test Item 1', '', '120', NULL, 'veg', 'Yes', 'Yes', '2020-06-14 10:09:04'),
(8, 9, 'ice cream', 'chocolate', 'assets/uploads/menu_items/download.jpg', '[\"100\",\"200\"]', '[\"half\",\"full\"]', 'egg', 'Yes', 'Yes', '2020-07-19 09:46:47'),
(9, 10, 'Chicken', '123123', 'assets/uploads/menu_items/IMG_7261_1724159036_center.jpg', '[\"300\",\"250\",\"100\"]', '[\"Full\",\"half\",\"Qtr\"]', 'non-veg', 'Yes', 'Yes', '2020-06-21 12:28:18'),
(10, 10, 'kabab', 'fff', 'assets/uploads/menu_items/chicken_seekh.jpg', '[\"10\"]', '[\"Qtr\"]', 'non-veg', 'Yes', 'Yes', '2020-06-21 12:29:40'),
(12, 11, 'Vegetarian christmas starter ', 'This is a dish with fish with pepper', 'assets/uploads/menu_items/2.jpg', '[\"400\",\"200\",\"125\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 09:20:11'),
(13, 11, 'Paneer tikka dry', 'High quality paneer with a twist of spices. This dish is gently spicy and very delicious', 'assets/uploads/menu_items/paneer-tikka-dry-recipe.jpg', '[\"300\",\"150\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-06-26 09:22:57'),
(14, 11, 'Crispy chicken', 'This dish contains quality chicken and deep fried in oil and has a crisp on the top.', 'assets/uploads/menu_items/crispy-chicken-starter-recipe-main-photo.jpg', '[\"600\",\"300\",\"150\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 09:25:54'),
(15, 11, 'Mutton sheek kebab', 'This dish is a mutton grounded meat mixed with many spices and barbecued.', 'assets/uploads/menu_items/kebabs.png', '[\"350\",\"175\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 09:30:54'),
(16, 11, 'Pan-fried scallops', 'Pan-fried scallops with crisp pancetta, watercress and lemon crème fraîche', 'assets/uploads/menu_items/letterbox_Pan-fried_20scallops.jpg', '[\"800\",\"400\",\"200\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 09:32:41'),
(17, 12, 'Enchilada Cups', 'This dish contains mixed vegetables and covered with cheeze', 'assets/uploads/menu_items/cups.jpg', '[\"300\",\"150\",\"75\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'veg', 'Yes', 'Yes', '2020-06-26 09:35:16'),
(18, 12, 'Mozerella cheese sticks', 'Loaded with cheese and covered with bread crumbs', 'assets/uploads/menu_items/cheese_sticks.jpeg', '[\"300\",\"150\",\"75\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'veg', 'Yes', 'Yes', '2020-06-26 09:40:31'),
(19, 12, 'Nacho cheese bites', 'This dish is a  burst of cheese covered with crispy layer', 'assets/uploads/menu_items/Nacho-Cheese-Bites.jpg', '[\"500\",\"250\",\"125\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'veg', 'Yes', 'Yes', '2020-06-26 09:42:39'),
(20, 12, 'Onion rings', 'Fried onion and covered with spicy layer', 'assets/uploads/menu_items/onion_rings.jpg', '[\"200\",\"100\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-06-26 09:43:50'),
(21, 12, 'Spanish tortilla', 'Russet potato cooked in extra-virgin olive oil, onions, salt large eggs', 'assets/uploads/menu_items/tortilla.jpeg', '[\"400\",\"200\"]', '[\"Full\",\"Half\"]', 'egg', 'Yes', 'Yes', '2020-06-26 09:50:29'),
(22, 13, ' Caprese grilled cheese sandwich', '4 slices bread basil pesto with fresh mozzarella', 'assets/uploads/menu_items/CapreseGrilledCheeseSandwich5002161.jpg', '[\"400\",\"200\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-06-26 09:53:37'),
(23, 13, 'Bacon & Pimento Cheese Grilled Cheese', 'Pimento cheese is back, and we couldn\'t be more thrilled! ', 'assets/uploads/menu_items/grilled_cheese_and_bacon.jpg', '[\"400\"]', '[\"Full\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 09:57:07'),
(24, 13, 'Bread Omlette Sandwitch', 'Crumbled eggs with veggies', 'assets/uploads/menu_items/bread-omelette-500x375.jpg', '[\"300\"]', '[\"Full\"]', 'egg', 'Yes', 'Yes', '2020-06-26 10:01:59'),
(25, 13, 'Salami Sandwitch', 'Easy salami sandwitch mixed meat and veggies', 'assets/uploads/menu_items/salami_sandwitch.jpg', '[\"200\"]', '[\"Full\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 10:04:54'),
(26, 13, 'Cabbage bacon sandwitch', '2 pcs of sandwitch with extra cheese and veggies loaded', 'assets/uploads/menu_items/cabbage-bacon-sandwich-faacdb5e-0819_sq.jpg', '[\"600\"]', '[\"Full\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 10:08:11'),
(27, 14, 'Truffle Chicken Gratin', 'Quality chicken marinated and cooked with indian spices', 'assets/uploads/menu_items/truffle_chicken_gratin.jpg', '[\"700\",\"350\",\"175\"]', '[\"Full\",\"Half\",\"Quarter\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 10:13:18'),
(28, 14, 'Chicken Noodles', 'Noodles tossed and grilled with chicken', 'assets/uploads/menu_items/noodles.jpeg', '[\"400\",\"200\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 10:14:21'),
(29, 14, 'Spaghetti Bolognese', 'Italian noodles with meat balls', 'assets/uploads/menu_items/spegatii_bolonese.jpg', '[\"500\",\"250\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 10:15:40'),
(30, 14, 'Cheeze Burst Pizza', 'This dish an italian cheese loaded pizza with veggies', 'assets/uploads/menu_items/pizza.jpg', '[\"600\",\"300\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-06-26 10:17:28'),
(31, 14, 'Spicy Prawns', 'Prawns cooked and tossed with pepper and garlic', 'assets/uploads/menu_items/prawns.jpeg', '[\"600\",\"300\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-06-26 10:51:38'),
(32, 15, 'Chocolate Mousse', 'Thick dark chocolate sweet dish', 'assets/uploads/menu_items/mooze.jpg', '[\"100\"]', '[\"Full\"]', 'egg', 'Yes', 'Yes', '2020-06-26 10:53:45'),
(33, 15, 'Cuban Pudding Dessert', 'Cuban pudding dessert', 'assets/uploads/menu_items/pudding.jpg', '[\"300\"]', '[\"Cuban Pudding Dessert\"]', 'veg', 'Yes', 'Yes', '2020-06-26 10:55:57'),
(34, 15, 'Gulab Jamun', 'Famous indian dish with cashews topped', 'assets/uploads/menu_items/gulab_jamun.jpg', '[\"100\",\"50\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-06-26 10:59:06'),
(35, 15, 'Carrot Halwa', 'Grazed carrot with dry fruits and condensed milk', 'assets/uploads/menu_items/Gajar-Ka-Halwa-Simple-Indian-Carrot-Dessert.jpg', '[\"200\"]', '[\"Full\"]', 'veg', 'Yes', 'Yes', '2020-06-26 11:01:44'),
(36, 15, 'Rice Kheer', 'Rice cooked with thick milk and condensed milk with dry fruits', 'assets/uploads/menu_items/rice_kheer.jpg', '[\"100\"]', '[\"Full\"]', 'veg', 'Yes', 'Yes', '2020-06-26 11:05:11'),
(37, 16, 'Fresh Lime Juice', '', 'assets/uploads/menu_items/lime-juice.jpg', '[\"10\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-09-17 19:32:35'),
(38, 16, 'Mango Juice', '', 'assets/uploads/menu_items/mango.jpg', '[\"110\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 15:56:42'),
(39, 16, 'Pineapple Juice', '', 'assets/uploads/menu_items/pineapple-drink-500x500.jpg', '[\"100\"]', '[\"250ml\"]', 'veg', 'No', 'Yes', '2020-08-04 15:57:20'),
(40, 16, 'Orange Juice', '', 'assets/uploads/menu_items/orangejuice-1.jpg', '[\"90\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 15:57:53'),
(41, 16, 'Grape Juice', '', 'assets/uploads/menu_items/grape-juice.jpg', '[\"140\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 15:58:25'),
(42, 16, 'Watermelon Juice', '', 'assets/uploads/menu_items/watermelon-juice-500x500.jpg', '[\"95\"]', '[\"250ml\"]', 'veg', 'No', 'Yes', '2020-08-04 15:59:05'),
(47, 17, 'Banana Shake', '', 'assets/uploads/menu_items/30feb94b41ab8ab.jpg', '[\"100\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:12:02'),
(48, 17, 'Strawberry Milkshake', '', 'assets/uploads/menu_items/Strawberry-Milkshake-5.jpg', '[\"110\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:12:37'),
(49, 17, 'Vanilla Milkshake', '', 'assets/uploads/menu_items/190523-vanilla-milkshake-050-square-1559169406.png', '[\"110\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:13:10'),
(50, 17, 'Apple Milkshake', '', 'assets/uploads/menu_items/apple-milkshake-500x500.jpg', '[\"100\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:13:40'),
(51, 17, 'Chickoo Milkshake', '', 'assets/uploads/menu_items/chickoo1.jpg', '[\"90\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:14:17'),
(52, 18, 'Aam Panna', '', 'assets/uploads/menu_items/Aam-Panna-4.jpg', '[\"150\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:17:26'),
(53, 18, 'Masala Butter Milk', '', 'assets/uploads/menu_items/5eb265aa17765_pb.jpg', '[\"140\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:18:05'),
(54, 18, 'Badam Milk', '', 'assets/uploads/menu_items/badam-milk-2-500x500.jpg', '[\"160\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:18:29'),
(55, 18, 'Jal Jeera', '', 'assets/uploads/menu_items/jaljeera-masala-500x500.jpg', '[\"85\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:18:55'),
(56, 18, 'ICE Tea', '', 'assets/uploads/menu_items/montenegro-orange-ice-tea-50417412.jpg', '[\"140\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-04 16:19:55'),
(57, 19, 'Indian Coffee', '', 'assets/uploads/menu_items/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51_fit-76', '[\"160\"]', '[\"Cup\"]', 'veg', 'No', 'Yes', '2020-08-05 17:17:57'),
(58, 19, 'Masala Tea', '', 'assets/uploads/menu_items/Jaggery-masala-chai-2.jpg', '[\"60\"]', '[\"Cup\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:18:30'),
(59, 19, 'Hot Milk', '', 'assets/uploads/menu_items/milk_glass_of_pexels.jpeg', '[\"50\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:18:58'),
(60, 19, 'Kashmiri Kawa', '', 'assets/uploads/menu_items/biala-filizanka-z-czarna-kawa-510769-MT.jpg', '[\"140\"]', '[\"Cup\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:19:22'),
(61, 20, 'Hot Gulabjamun', 'Server hot with chashni', 'assets/uploads/menu_items/56a288e117d3f8_50310584.jpg', '[\"40\"]', '[\"2pc\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:24:40'),
(62, 20, 'Sponge Rasgulla', '', 'assets/uploads/menu_items/96812093_240726110544754_8294838566283242179_n.jpg', '[\"40\"]', '[\"2pc\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:25:54'),
(63, 20, 'Besan Laddu', '', 'assets/uploads/menu_items/besan-laddu.png', '[\"240\",\"340\"]', '[\"Half Kg\",\"One Kg\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:27:13'),
(64, 20, 'Motichoor Laddu', '', 'assets/uploads/menu_items/motichoor-655x477.jpg', '[\"230\",\"350\"]', '[\"Half Kg\",\"Full Kg\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:28:03'),
(65, 20, 'Rasmalai', '', 'assets/uploads/menu_items/Rasmalai-4.jpg', '[\"100\",\"200\"]', '[\"2pc\",\"4pc\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:28:39'),
(66, 20, 'Kaju Barfi', '', 'assets/uploads/menu_items/LREdit_Wordpress-7074.jpg', '[\"360\",\"720\"]', '[\"Half Kg\",\"Full Kg\"]', 'veg', 'Yes', 'Yes', '2020-08-05 17:29:33'),
(68, 27, 'Paneer Momo', 'Steamed', 'assets/uploads/menu_items/e4pkjtqcuyrrc2h1sdod.jpg', '[\"50\",\"30\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-08-25 21:03:03'),
(69, 27, 'Spring Rolls', 'Fried', 'assets/uploads/menu_items/spring-rolls-500x500.jpg', '[\"50\",\"30\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-08-25 21:17:06'),
(75, 32, 'Steamed Rice', 'Hot Served', 'assets/uploads/menu_items/download1.jpg', '[\"200\",\"100\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-09-17 09:27:26'),
(76, 33, 'Tandoori Roti', 'Hot Served', 'assets/uploads/menu_items/download_(2).jpg', '[\"10\"]', '[\"Full\"]', 'veg', 'Yes', 'Yes', '2020-09-18 09:51:55'),
(77, 33, 'Tandoori Butter Roti', 'Hot Served', 'assets/uploads/menu_items/download_(1).jpg', '[\"15\"]', '[\"Full\"]', 'veg', 'Yes', 'Yes', '2020-09-18 09:53:02'),
(78, 33, 'Paneer Paratha', 'Hot Served', 'assets/uploads/menu_items/download_(3).jpg', '[\"30\"]', '[\"Full\"]', 'veg', 'Yes', 'Yes', '2020-09-18 09:55:29'),
(79, 33, 'Aloo Paratha', 'Hot Served', 'assets/uploads/menu_items/download_(4).jpg', '[\"25\",\"\"]', '[\"Full\",\"\"]', 'veg', 'Yes', 'Yes', '2020-09-18 09:56:41'),
(80, 34, 'Veg Fried Rice', 'Hot Served', 'assets/uploads/menu_items/download_(6).jpg', '[\"65\",\"45\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-09-18 10:01:46'),
(81, 34, 'Egg Fried Rice', 'Hot Served', 'assets/uploads/menu_items/download_(7).jpg', '[\"90\",\"50\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-09-18 10:04:39'),
(82, 34, 'Chicken Fried Rice', 'Hot Served', 'assets/uploads/menu_items/download_(8).jpg', '[\"100\",\"65\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-09-18 10:07:20'),
(83, 34, 'Egg Hakka noodles', 'Hot Served', 'assets/uploads/menu_items/download_(9).jpg', '[\"70\",\"45\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-09-18 10:09:34'),
(84, 35, 'Chicken Biryani', 'Hot Served', 'assets/uploads/menu_items/download_(11).jpg', '[\"120\",\"80\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-09-18 10:13:27'),
(85, 35, 'Egg Biryani', 'Hot Served', 'assets/uploads/menu_items/download_(12).jpg', '[\"90\",\"60\"]', '[\"Full\",\"Half\"]', 'non-veg', 'Yes', 'Yes', '2020-09-18 10:15:22'),
(86, 35, 'Veg Biryani', 'Hot Served', 'assets/uploads/menu_items/download_(13).jpg', '[\"80\",\"50\"]', '[\"Full\",\"Half\"]', 'veg', 'Yes', 'Yes', '2020-09-18 10:17:21'),
(87, 36, 'Banana Shake', 'xyz', '', '[\"100\"]', '[\"250ml\"]', 'veg', 'Yes', 'Yes', '2020-09-22 13:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `res_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_phone_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_temp_details` longtext COLLATE utf8_unicode_ci,
  `total` text COLLATE utf8_unicode_ci NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=''open'',1=''confirm'',2=''close''',
  `payment_mode` int(11) NOT NULL COMMENT '1-Cash, 2-Online',
  `payment_status` int(11) NOT NULL COMMENT '1-paid, 2-pending',
  `txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `res_id`, `table_id`, `buyer_name`, `buyer_email`, `buyer_phone_number`, `order_type`, `item_details`, `item_temp_details`, `total`, `order_status`, `payment_mode`, `payment_status`, `txn_id`, `created_date`, `created_at`, `updated_at`) VALUES
(1, '10000001', 19, NULL, 'Shivangi', 'test@gmail.com', NULL, NULL, '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', NULL, '', 2, 1, 2, '', '2020-09-06', '2020-07-06 05:55:11', '2020-09-16 03:26:20'),
(2, '10000002', 19, NULL, 'Payment 2', 'gc.abhi@gmail.com', NULL, NULL, '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"2\"}}}', NULL, '', 0, 2, 2, '', NULL, '2020-07-06 10:33:39', '2020-07-06 10:33:39'),
(3, '10000003', 19, NULL, 'Payment 2', 'gc.abhi@gmail.com', NULL, NULL, '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"2\"}}}', NULL, '', 2, 2, 2, '', NULL, '2020-07-06 10:34:25', '2020-07-11 11:09:22'),
(4, '10000004', 19, NULL, 'Payment 3', 'gc.abhi@gmail.com', NULL, NULL, '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"2\"}}}', NULL, '', 0, 2, 2, '', NULL, '2020-07-06 10:39:08', '2020-07-11 10:58:04'),
(5, '10000005', 19, NULL, 'Payment 4', 'gc.abhi@gmail.com', NULL, NULL, '{\"20\":{\"Half\":{\"itemName\":\"Onion rings\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/onion_rings.jpg\",\"itemType\":\"Half\",\"itemCount\":\"1\"}}}', '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"2\"}},\"20\":{\"Half\":{\"itemName\":\"Onion rings\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/onion_rings.jpg\",\"itemType\":\"Half\",\"itemCount\":\"1\"}}}', '', 1, 2, 1, 'txn_1H1yJBLfcNO5LN3feA1dRP4V', NULL, '2020-07-06 10:40:37', '2020-07-11 11:08:27'),
(6, '10000006', 21, NULL, 'Tanvir Singh Jamwal', 'tanujamwal002@gmail.com', NULL, NULL, '{\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}},\"10\":{\"Qtr\":{\"itemName\":\"kabab\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"1\"}},\"8\":{\"half\":{\"itemName\":\"xyz\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download.jpg\",\"itemType\":\"half\",\"itemCount\":\"1\"}}}', NULL, '', 2, 1, 2, '', NULL, '2020-07-06 11:15:07', '2020-07-12 04:08:04'),
(7, '10000007', 21, NULL, 'Tanvir Singh Jamwal', 'tanujamwal002@gmail.com', NULL, NULL, '{\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}},\"10\":{\"Qtr\":{\"itemName\":\"kabab\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"1\"}},\"8\":{\"half\":{\"itemName\":\"xyz\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download.jpg\",\"itemType\":\"half\",\"itemCount\":\"1\"}}}', NULL, '', 2, 1, 2, '', NULL, '2020-07-06 11:15:36', '2020-07-12 04:08:47'),
(8, '10000008', 19, NULL, 'Shivangi', 'test@gmail.com', NULL, NULL, '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', NULL, '511', 0, 1, 2, '', NULL, '2020-07-07 01:03:41', '2020-07-07 01:03:41'),
(9, '10000009', 19, NULL, 'Shivangi', 'test@gmail.com', NULL, NULL, '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', NULL, '', 1, 2, 1, 'txn_1H2BurLfcNO5LN3f2J5Nrzcp', NULL, '2020-07-07 01:12:36', '2020-07-11 11:08:22'),
(10, '10000010', 19, NULL, 'test', 'test@gmail.com', NULL, NULL, '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', NULL, '438', 2, 2, 1, 'txn_1H2C1nLfcNO5LN3fgeTM8xjH', NULL, '2020-07-07 01:19:46', '2020-07-18 01:39:17'),
(11, '10000011', 19, NULL, 'Shivangi Verma', 'shivangiv227@gmail.com', NULL, NULL, '{\"20\":{\"Full\":{\"itemName\":\"Onion rings\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/onion_rings.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}},\"19\":{\"Half\":{\"itemName\":\"Nacho cheese bites\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Nacho-Cheese-Bites.jpg\",\"itemType\":\"Half\",\"itemCount\":\"1\"}}}', NULL, '657', 0, 1, 2, '', NULL, '2020-07-07 02:35:01', '2020-07-07 02:35:01'),
(12, '10000012', 21, NULL, 'Raman', 'raman@tajhotels.com', NULL, NULL, '{\"10\":{\"Qtr\":{\"itemName\":\"kabab\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"2\"}},\"39\":{\"Half\":{\"itemName\":\"chicken tikka\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh1.jpg\",\"itemType\":\"Half\",\"itemCount\":\"2\"}},\"38\":{\"Qtr\":{\"itemName\":\"paneer tikka\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chickentikkakebab.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"2\"}}}', NULL, '1220', 1, 1, 2, '', NULL, '2020-07-07 05:40:43', '2020-07-12 04:09:57'),
(13, '10000013', 21, NULL, 'Suchindra jamwal', 'tanujamwal002@gmail.com', NULL, NULL, '{\"9\":{\"half\":{\"itemName\":\"Chicken\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"half\",\"itemCount\":\"2\"}}}', NULL, '1500', 2, 2, 1, 'txn_1H2JRKLfcNO5LN3fItNvWfP7', NULL, '2020-07-07 09:14:21', '2020-07-12 04:09:44'),
(14, '10000014', 21, 60, 'Test', 'gc.abhi@gmail.com', NULL, NULL, '{\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"3\"}},\"39\":{\"Full\":{\"itemName\":\"chicken tikka\",\"itemPrice\":\"1000\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh1.jpg\",\"itemType\":\"Full\",\"itemCount\":\"2\"}}}', NULL, '2900', 2, 1, 2, '', NULL, '2020-07-11 00:08:21', '2020-07-12 06:11:54'),
(15, '10000015', 19, 25, 'Guru Charan Singh', 'gc.abhi@gmail.com', NULL, NULL, '{\"15\":{\"Half\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"175\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Half\",\"itemCount\":\"1\"}},\"19\":{\"Quarter\":{\"itemName\":\"Nacho cheese bites\",\"itemPrice\":\"125\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Nacho-Cheese-Bites.jpg\",\"itemType\":\"Quarter\",\"itemCount\":\"1\"}},\"12\":{\"Quarter\":{\"itemName\":\"Vegetarian christmas starter \",\"itemPrice\":\"125\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/2.jpg\",\"itemType\":\"Quarter\",\"itemCount\":\"1\"}}}', '{\"15\":{\"Half\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"175\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Half\",\"itemCount\":\"1\"}},\"19\":{\"Quarter\":{\"itemName\":\"Nacho cheese bites\",\"itemPrice\":\"125\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Nacho-Cheese-Bites.jpg\",\"itemType\":\"Quarter\",\"itemCount\":\"1\"}},\"12\":{\"Quarter\":{\"itemName\":\"Vegetarian christmas starter \",\"itemPrice\":\"125\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/2.jpg\",\"itemType\":\"Quarter\",\"itemCount\":\"1\"}}}', '622', 1, 1, 2, '', NULL, '2020-07-18 22:46:26', '2020-07-18 03:05:17'),
(16, '10000016', 19, 25, 'Guru Charan Singh', 'gc.abhi@gmail.com', NULL, NULL, '{\"14\":{\"Full\":{\"itemName\":\"Crispy chicken\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/crispy-chicken-starter-recipe-main-photo.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '{\"14\":{\"Full\":{\"itemName\":\"Crispy chicken\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/crispy-chicken-starter-recipe-main-photo.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '876', 0, 2, 1, '', NULL, '2020-07-18 10:24:35', '2020-07-18 03:03:09'),
(17, '10000017', 19, 25, 'Guru Charan Singh', 'gurucharan.singh@bicsl.com', NULL, NULL, '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '511', 1, 2, 1, '', NULL, '2020-07-15 10:26:20', '2020-07-18 03:04:38'),
(18, '10000018', 19, 25, 'Guru Charan Singh', 'gurucharan.singh@bicsl.com', NULL, NULL, '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '511', 0, 2, 1, 'txn_1H5EOSLfcNO5LN3fT9LoT2Kr', NULL, '2020-07-15 10:27:42', '2020-07-15 10:27:44'),
(19, '10000019', 21, 62, 'Suchindra jamwal', 'suchindrajamwal01@gmail.com', NULL, NULL, '{\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"},\"half\":{\"itemName\":\"Chicken\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"half\",\"itemCount\":\"1\"},\"Qtr\":{\"itemName\":\"Chicken\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"3\"}}}', '{\"39\":{\"Half\":{\"itemName\":\"chicken tikka\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh1.jpg\",\"itemType\":\"Half\",\"itemCount\":\"2\"}},\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"},\"half\":{\"itemName\":\"Chicken\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"half\",\"itemCount\":\"1\"},\"Qtr\":{\"itemName\":\"Chicken\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"3\"}}}', '1943', 2, 1, 2, '', NULL, '2020-07-16 20:48:47', '2020-07-16 20:51:19'),
(20, '10000020', 21, 62, 'Suchindra jamwal', 'acd@gmail.com', NULL, NULL, '{\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"},\"half\":{\"itemName\":\"Chicken\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"half\",\"itemCount\":\"1\"}},\"10\":{\"Qtr\":{\"itemName\":\"kabab\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"1\"}},\"39\":{\"Half\":{\"itemName\":\"chicken tikka\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh1.jpg\",\"itemType\":\"Half\",\"itemCount\":\"2\"}}}', '{\"9\":{\"Full\":{\"itemName\":\"Chicken\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"},\"half\":{\"itemName\":\"Chicken\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"half\",\"itemCount\":\"1\"}},\"10\":{\"Qtr\":{\"itemName\":\"kabab\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh.jpg\",\"itemType\":\"Qtr\",\"itemCount\":\"1\"}},\"39\":{\"Half\":{\"itemName\":\"chicken tikka\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh1.jpg\",\"itemType\":\"Half\",\"itemCount\":\"2\"}}}', '1638', 2, 1, 2, '', NULL, '2020-07-16 20:56:16', '2020-07-16 20:57:28'),
(21, '10000021', 19, 25, 'Shivangi', 'shivangi@gmail.com', NULL, NULL, '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '438', 0, 1, 2, '', NULL, '2020-07-18 01:53:41', '2020-07-18 01:53:41'),
(22, '10000022', 19, 25, 'Test', 'test@gmail.com', NULL, NULL, '{\"20\":{\"Full\":{\"itemName\":\"Onion rings\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/onion_rings.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '{\"20\":{\"Full\":{\"itemName\":\"Onion rings\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/onion_rings.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', '292', 2, 1, 2, '', NULL, '2020-07-18 01:54:50', '2020-07-18 03:05:36'),
(23, '10000023', 21, 62, 'Taj', 'raman@tajhotels.com', NULL, NULL, '{\"8\":{\"full\":{\"itemName\":\"ice cream\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download.jpg\",\"itemType\":\"full\",\"itemCount\":\"1\"}}}', '{\"8\":{\"full\":{\"itemName\":\"ice cream\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download.jpg\",\"itemType\":\"full\",\"itemCount\":\"1\"}}}', '200', 2, 1, 2, '', NULL, '2020-07-19 04:52:58', '2020-07-19 09:33:28'),
(24, '10000024', 19, 85, 'Tanvir Jamwal', 'tanujamwal001@gmail.com', NULL, NULL, '{\"26\":{\"Full\":{\"itemName\":\"Cabbage bacon sandwitch\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cabbage-bacon-sandwich-faacdb5e-0819_sq.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"29\":{\"Full\":{\"itemName\":\"Spaghetti Bolognese\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spegatii_bolonese.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"32\":{\"Full\":{\"itemName\":\"Chocolate Mousse\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/mooze.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"egg\",\"itemCount\":\"1\"}}}', '{\"26\":{\"Full\":{\"itemName\":\"Cabbage bacon sandwitch\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cabbage-bacon-sandwich-faacdb5e-0819_sq.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"29\":{\"Full\":{\"itemName\":\"Spaghetti Bolognese\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spegatii_bolonese.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"32\":{\"Full\":{\"itemName\":\"Chocolate Mousse\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/mooze.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"egg\",\"itemCount\":\"1\"}}}', '1260', 2, 1, 2, '', NULL, '2020-07-27 02:03:37', '2020-07-27 02:04:48'),
(25, '10000025', 19, 85, 'Suchindra jamwal', 'suchindrajamwal01@gmail.com', NULL, NULL, '{\"13\":{\"Half\":{\"itemName\":\"Paneer tikka dry\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/paneer-tikka-dry-recipe.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"15\":{\"Half\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"175\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Half\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}},\"29\":{\"Full\":{\"itemName\":\"Spaghetti Bolognese\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spegatii_bolonese.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}},\"35\":{\"Full\":{\"itemName\":\"Carrot Halwa\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Gajar-Ka-Halwa-Simple-Indian-Carrot-Dessert.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"34\":{\"Half\":{\"itemName\":\"Gulab Jamun\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/gulab_jamun.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"13\":{\"Half\":{\"itemName\":\"Paneer tikka dry\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/paneer-tikka-dry-recipe.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"15\":{\"Half\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"175\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Half\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}},\"29\":{\"Full\":{\"itemName\":\"Spaghetti Bolognese\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spegatii_bolonese.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}},\"35\":{\"Full\":{\"itemName\":\"Carrot Halwa\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Gajar-Ka-Halwa-Simple-Indian-Carrot-Dessert.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"34\":{\"Half\":{\"itemName\":\"Gulab Jamun\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/gulab_jamun.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '1838', 0, 1, 2, '', NULL, '2020-07-27 06:14:49', '2020-07-27 06:14:49'),
(26, '10000026', 19, 84, 'Tanvir Jamwal', 'tanujamwal002@gmail.com', NULL, NULL, '{\"30\":{\"Full\":{\"itemName\":\"Cheeze Burst Pizza\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pizza.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"29\":{\"Full\":{\"itemName\":\"Spaghetti Bolognese\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spegatii_bolonese.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}}}', '{\"30\":{\"Full\":{\"itemName\":\"Cheeze Burst Pizza\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pizza.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"29\":{\"Full\":{\"itemName\":\"Spaghetti Bolognese\",\"itemPrice\":\"500\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spegatii_bolonese.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}}}', '1680', 0, 1, 2, '', NULL, '2020-07-27 08:04:05', '2020-07-27 08:04:05'),
(27, '10000027', 19, 84, 'Test', 'tr@gmail.com', NULL, NULL, '{\"30\":{\"Full\":{\"itemName\":\"Cheeze Burst Pizza\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pizza.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"30\":{\"Full\":{\"itemName\":\"Cheeze Burst Pizza\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pizza.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '630', 0, 1, 2, '', NULL, '2020-08-01 11:37:41', '2020-08-01 11:37:41'),
(28, '10000028', 19, 84, 'test', 'test@gmail.com', NULL, NULL, '{\"19\":{\"Quarter\":{\"itemName\":\"Nacho cheese bites\",\"itemPrice\":\"125\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Nacho-Cheese-Bites.jpg\",\"itemType\":\"Quarter\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"21\":{\"Half\":{\"itemName\":\"Spanish tortilla\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/tortilla.jpeg\",\"itemType\":\"Half\",\"itemFoodType\":\"egg\",\"itemCount\":\"1\"}}}', '{\"19\":{\"Quarter\":{\"itemName\":\"Nacho cheese bites\",\"itemPrice\":\"125\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Nacho-Cheese-Bites.jpg\",\"itemType\":\"Quarter\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"21\":{\"Half\":{\"itemName\":\"Spanish tortilla\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/tortilla.jpeg\",\"itemType\":\"Half\",\"itemFoodType\":\"egg\",\"itemCount\":\"1\"}}}', '341', 2, 1, 2, '', NULL, '2020-08-02 09:24:03', '2020-09-20 06:22:40'),
(29, '10000029', 17, 94, 'Tesy', 'yesy@gmail.com', NULL, NULL, '{\"64\":{\"Full Kg\":{\"itemName\":\"Motichoor Laddu\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/motichoor-655x477.jpg\",\"itemType\":\"Full Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"64\":{\"Full Kg\":{\"itemName\":\"Motichoor Laddu\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/motichoor-655x477.jpg\",\"itemType\":\"Full Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '700', 2, 1, 2, '', NULL, '2020-08-06 08:29:24', '2020-08-06 08:31:38'),
(30, '10000030', 17, 94, 'Test', 'test@gmail.com', NULL, NULL, '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"64\":{\"Half Kg\":{\"itemName\":\"Motichoor Laddu\",\"itemPrice\":\"230\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/motichoor-655x477.jpg\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"65\":{\"2pc\":{\"itemName\":\"Rasmalai\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Rasmalai-4.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"60\":{\"Cup\":{\"itemName\":\"Kashmiri Kawa\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/biala-filizanka-z-czarna-kawa-510769-MT.jpg\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"64\":{\"Half Kg\":{\"itemName\":\"Motichoor Laddu\",\"itemPrice\":\"230\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/motichoor-655x477.jpg\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"65\":{\"2pc\":{\"itemName\":\"Rasmalai\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Rasmalai-4.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"60\":{\"Cup\":{\"itemName\":\"Kashmiri Kawa\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/biala-filizanka-z-czarna-kawa-510769-MT.jpg\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '987', 2, 1, 2, '', NULL, '2020-08-09 03:14:42', '2020-08-09 03:16:13'),
(31, '10000031', 17, 94, 'Harshvardhan Singh Jasrotia', 'amokharsh5@gmail.com', NULL, NULL, '{\"66\":{\"Half Kg\":{\"itemName\":\"Kaju Barfi\",\"itemPrice\":\"360\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/LREdit_Wordpress-7074.jpg\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"66\":{\"Half Kg\":{\"itemName\":\"Kaju Barfi\",\"itemPrice\":\"360\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/LREdit_Wordpress-7074.jpg\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '378', 2, 1, 2, '', NULL, '2020-08-16 05:10:10', '2020-08-16 05:11:13'),
(32, '10000032', 17, 98, 'Bineet Kumar', 'test@gmail.com', NULL, NULL, '{\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '336', 2, 1, 2, '', NULL, '2020-08-16 08:04:30', '2020-08-16 08:05:36'),
(33, '10000033', 17, 94, 'Tanvir', 'test@gmail.com', NULL, NULL, '{\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '210', 0, 1, 2, '', NULL, '2020-08-23 21:59:28', '2020-08-23 21:59:28'),
(34, '10000034', 17, 94, 'Tanvir', 'test@gmail.com', NULL, NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"63\":{\"Half Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"240\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"61\":{\"2pc\":{\"itemName\":\"Hot Gulabjamun\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/56a288e117d3f8_50310584.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"63\":{\"Half Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"240\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"61\":{\"2pc\":{\"itemName\":\"Hot Gulabjamun\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/56a288e117d3f8_50310584.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '446', 2, 1, 2, '', NULL, '2020-08-24 03:00:40', '2020-08-24 03:02:20'),
(35, '10000035', 17, 94, 'Tanvir', 'test@gmail.com', NULL, NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-08-24 19:59:26', '2020-08-24 19:59:26'),
(36, '10000036', 17, 95, 'Test', 'tr@gmail.com', NULL, NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 0, 1, 2, '', NULL, '2020-08-24 20:01:30', '2020-08-24 20:01:30'),
(37, '10000037', 17, 94, 'Tanvir', 'tr@gmail.com', NULL, NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 0, 1, 2, '', NULL, '2020-08-24 20:03:45', '2020-08-24 20:03:45'),
(38, '10000038', 19, 84, 'Test', 'tr@gmail.com', NULL, NULL, '{\"14\":{\"Full\":{\"itemName\":\"Crispy chicken\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/crispy-chicken-starter-recipe-main-photo.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}}}', '{\"14\":{\"Full\":{\"itemName\":\"Crispy chicken\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/crispy-chicken-starter-recipe-main-photo.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}}}', '998', 0, 1, 2, '', NULL, '2020-08-24 20:19:08', '2020-08-24 20:19:08'),
(39, '10000039', 17, 94, 'Test', 'test@test.om', NULL, NULL, '{\"40\":{\"250ml\":{\"itemName\":\"Orange Juice\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/orangejuice-1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"40\":{\"250ml\":{\"itemName\":\"Orange Juice\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/orangejuice-1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '189', 0, 1, 2, '', NULL, '2020-08-24 23:44:11', '2020-08-24 23:44:11'),
(40, '10000040', 17, 94, 'Test', 'tesy@test.com', NULL, NULL, '{\"39\":{\"250ml\":{\"itemName\":\"Pineapple Juice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pineapple-drink-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"39\":{\"250ml\":{\"itemName\":\"Pineapple Juice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pineapple-drink-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '210', 0, 1, 2, '', NULL, '2020-08-25 00:25:15', '2020-08-25 00:25:15'),
(41, '10000041', 17, 94, 'Test', 'test@gmail.com', NULL, NULL, '{\"62\":{\"2pc\":{\"itemName\":\"Sponge Rasgulla\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/96812093_240726110544754_8294838566283242179_n.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"62\":{\"2pc\":{\"itemName\":\"Sponge Rasgulla\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/96812093_240726110544754_8294838566283242179_n.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '84', 0, 1, 2, '', NULL, '2020-08-25 00:28:15', '2020-08-25 00:28:15'),
(42, '10000042', 17, 94, 'tertr', 'test@gmail.com', NULL, NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '294', 0, 1, 2, '', NULL, '2020-08-25 07:55:36', '2020-08-25 07:55:36'),
(43, '10000043', 17, 94, 'Test', 'tr@gmail.com', NULL, NULL, '[]', '[]', '', 1, 1, 2, '', NULL, '2020-08-25 07:57:26', '2020-08-25 09:01:34'),
(44, '10000044', 23, 102, 'Tanvir', 'test@gmail.com', NULL, NULL, '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"69\":{\"Half\":{\"itemName\":\"Spring Rolls\",\"itemPrice\":\"30\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spring-rolls-500x500.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"69\":{\"Half\":{\"itemName\":\"Spring Rolls\",\"itemPrice\":\"30\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spring-rolls-500x500.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '80', 0, 1, 2, '', NULL, '2020-08-25 08:54:53', '2020-08-25 08:54:53'),
(45, '10000045', 23, 102, 'Sahil Gautam', 'sahilgautam.sg@gmail.com', NULL, NULL, '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '50', 2, 1, 2, '', NULL, '2020-08-25 09:00:19', '2020-08-25 09:01:24'),
(46, '10000046', 23, 102, 'Sahil Gautam', 'sahilgautam.sg@gmail.com', NULL, NULL, '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '50', 0, 1, 2, '', NULL, '2020-08-26 02:47:57', '2020-08-26 02:47:57'),
(47, '10000047', 23, 102, 'Amandeep', 'amandeep.kr1010@gmail.con', NULL, NULL, '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '50', 2, 1, 2, '', NULL, '2020-08-27 00:32:29', '2020-08-27 00:33:51'),
(48, '10000048', 23, 102, 'Dhananjay', 'ravi33375@gmail.com', NULL, NULL, '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"69\":{\"Full\":{\"itemName\":\"Spring Rolls\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spring-rolls-500x500.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"69\":{\"Full\":{\"itemName\":\"Spring Rolls\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/spring-rolls-500x500.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '100', 2, 1, 2, '', NULL, '2020-08-27 02:04:07', '2020-08-27 02:05:21'),
(49, '10000049', 23, 102, 'Rajnish Kumar Singh', 'kumarsingh12rajnish@gmail.com', NULL, NULL, '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"68\":{\"Full\":{\"itemName\":\"Paneer Momo\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/e4pkjtqcuyrrc2h1sdod.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '50', 2, 1, 2, '', NULL, '2020-08-27 04:19:51', '2020-08-27 04:20:39'),
(50, '10000050', 17, 94, 'Majeed', '', '9535777717', NULL, '{\"62\":{\"2pc\":{\"itemName\":\"Sponge Rasgulla\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/96812093_240726110544754_8294838566283242179_n.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"62\":{\"2pc\":{\"itemName\":\"Sponge Rasgulla\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/96812093_240726110544754_8294838566283242179_n.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '84', 2, 1, 2, '', NULL, '2020-08-29 10:46:18', '2020-08-29 11:25:12'),
(51, '10000051', 17, 94, 'Majeed new', 'mmd07@gmail.com', '9535777717', NULL, '{\"60\":{\"Cup\":{\"itemName\":\"Kashmiri Kawa\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/biala-filizanka-z-czarna-kawa-510769-MT.jpg\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"60\":{\"Cup\":{\"itemName\":\"Kashmiri Kawa\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/biala-filizanka-z-czarna-kawa-510769-MT.jpg\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '294', 2, 1, 2, '', NULL, '2020-08-29 10:47:42', '2020-08-29 11:18:48'),
(52, '10000052', 17, 94, 'Tanvir', '', '8527144522', NULL, '{\"56\":{\"250ml\":{\"itemName\":\"ICE Tea\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/montenegro-orange-ice-tea-50417412.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"56\":{\"250ml\":{\"itemName\":\"ICE Tea\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/montenegro-orange-ice-tea-50417412.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '147', 0, 1, 2, '', NULL, '2020-08-29 11:26:51', '2020-08-29 11:26:51'),
(53, '10000053', 17, 94, 'Tanvir', 'test@gmail.com', '8527144522', NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"38\":{\"250ml\":{\"itemName\":\"Mango Juice\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/mango.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"40\":{\"250ml\":{\"itemName\":\"Orange Juice\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/orangejuice-1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"38\":{\"250ml\":{\"itemName\":\"Mango Juice\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/mango.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"40\":{\"250ml\":{\"itemName\":\"Orange Juice\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/orangejuice-1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '467', 0, 1, 2, '', NULL, '2020-08-29 11:46:03', '2020-08-29 11:46:03'),
(54, '10000054', 17, 94, 'Test', 'tr@gmail.com', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-08-29 11:50:40', '2020-08-29 11:50:40'),
(55, '10000055', 17, 94, 'Test2', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"39\":{\"250ml\":{\"itemName\":\"Pineapple Juice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pineapple-drink-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"39\":{\"250ml\":{\"itemName\":\"Pineapple Juice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pineapple-drink-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '215', 2, 1, 2, '', NULL, '2020-08-30 11:56:37', '2020-08-29 12:30:04'),
(56, '10000056', 17, 94, 'Test3', 'tr@gmail.com', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"51\":{\"250ml\":{\"itemName\":\"Chickoo Milkshake\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chickoo1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"51\":{\"250ml\":{\"itemName\":\"Chickoo Milkshake\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chickoo1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '205', 0, 1, 2, '', NULL, '2020-08-29 12:03:49', '2020-08-29 12:03:49'),
(57, '10000057', 17, 94, 'Test4', '', '8527144522', NULL, '{\"48\":{\"250ml\":{\"itemName\":\"Strawberry Milkshake\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Strawberry-Milkshake-5.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"48\":{\"250ml\":{\"itemName\":\"Strawberry Milkshake\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Strawberry-Milkshake-5.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '116', 0, 1, 2, '', NULL, NULL, '2020-08-29 12:06:15'),
(58, '10000058', 17, 94, 'Test5', '', '8527144522', NULL, '{\"39\":{\"250ml\":{\"itemName\":\"Pineapple Juice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pineapple-drink-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"39\":{\"250ml\":{\"itemName\":\"Pineapple Juice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/pineapple-drink-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '105', 2, 1, 2, '', NULL, '2020-08-30 00:43:31', '2020-08-29 12:29:50'),
(59, '10000059', 17, 94, 'Test', '', '8527144522', NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '147', 2, 1, 2, '', NULL, '2020-08-30 00:58:27', '2020-08-29 12:29:33'),
(60, '10000060', 17, 94, 'Test5', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 0, 1, 2, '', NULL, '2020-08-30 14:20:53', '2020-08-30 01:50:53'),
(61, '10000061', 17, 94, 'Test4', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 2, 1, 'txn_1HLmabLfcNO5LN3f2Hb84iTL', NULL, NULL, '2020-08-30 02:12:41'),
(62, '10000062', 17, 94, 'Test123', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 2, 1, 'txn_1HLmdnLfcNO5LN3fS0mOHHSn', NULL, NULL, '2020-08-30 02:15:59'),
(63, '10000063', 17, 94, 'Test11', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 0, 1, 2, '', NULL, '2020-08-30 14:49:05', '2020-08-30 02:19:05'),
(64, '10000064', 17, 94, 'Sanjeev', '', '9211110882', NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}},\"57\":{\"Cup\":{\"itemName\":\"Indian Coffee\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51_fit-76\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}},\"57\":{\"Cup\":{\"itemName\":\"Indian Coffee\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51_fit-76\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '536', 2, 1, 2, '', NULL, '2020-08-30 14:58:31', '2020-08-30 02:30:14');
INSERT INTO `orders` (`id`, `order_id`, `res_id`, `table_id`, `buyer_name`, `buyer_email`, `buyer_phone_number`, `order_type`, `item_details`, `item_temp_details`, `total`, `order_status`, `payment_mode`, `payment_status`, `txn_id`, `created_date`, `created_at`, `updated_at`) VALUES
(65, '10000065', 17, 94, 'Majeed', 'mmd07@gmail.com', '9535777717', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 2, 1, 'txn_1HLnNBLfcNO5LN3fqsSkCd1j', NULL, NULL, '2020-08-30 03:02:53'),
(66, '10000066', 17, 94, 'Test10', '', '8527144522', NULL, '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"59\":{\"250ml\":{\"itemName\":\"Hot Milk\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/milk_glass_of_pexels.jpeg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"57\":{\"Cup\":{\"itemName\":\"Indian Coffee\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51_fit-76\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"59\":{\"250ml\":{\"itemName\":\"Hot Milk\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/milk_glass_of_pexels.jpeg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"57\":{\"Cup\":{\"itemName\":\"Indian Coffee\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51_fit-76\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '378', 2, 2, 1, 'txn_1HLna4LfcNO5LN3f4yfEYPVo', NULL, '2020-08-30 15:46:11', '2020-08-30 03:17:42'),
(67, '10000067', 17, 94, 'Tanvir', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '404', 2, 1, 2, '', NULL, '2020-09-01 15:13:24', '2020-09-01 02:59:44'),
(68, '10000068', 17, 94, 'Test3', 'test@gmail.com', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '262', 2, 2, 1, 'txn_1HMWYgLfcNO5LN3fkGdDt4S8', NULL, '2020-09-01 15:47:44', '2020-09-01 03:57:59'),
(69, '10000069', 17, 94, 'tanu', '', '1234567890', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '112', 0, 1, 2, '', NULL, '2020-09-03 22:50:44', '2020-09-03 10:20:44'),
(70, '10000070', 17, 94, 'majeed', '', '1234567890', NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '300', 0, 1, 2, '', NULL, '2020-09-03 23:01:40', '2020-09-03 10:31:40'),
(71, '10000071', 17, 94, 'Test123', '', '8527144522', NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '321', 2, 1, 2, '', NULL, '2020-09-05 20:17:01', '2020-09-05 07:51:02'),
(72, '10000072', 17, 105, 'Sahil Gautam', 'sahilgautam.sg@gmail.com', '+919540893', NULL, '{\"51\":{\"250ml\":{\"itemName\":\"Chickoo Milkshake\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chickoo1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"51\":{\"250ml\":{\"itemName\":\"Chickoo Milkshake\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chickoo1.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 2, 1, 2, '', NULL, '2020-09-06 12:11:16', '2020-09-05 23:42:59'),
(73, '10000073', 17, 104, 'Rakhi', '', '9075775987', NULL, '{\"63\":{\"One Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"340\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"One Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"63\":{\"One Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"340\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"One Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '364', 2, 1, 2, '', NULL, '2020-09-06 13:41:38', '2020-09-06 08:57:06'),
(74, '10000074', 17, 94, 'Tanvir', '', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 2, 2, 1, 'txn_1HOQV6LfcNO5LN3fN0cX668S', NULL, '2020-09-06 21:43:54', '2020-09-06 09:15:30'),
(75, '10000075', 17, 94, 'test', '', '1234567890', NULL, '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}},\"55\":{\"250ml\":{\"itemName\":\"Jal Jeera\",\"itemPrice\":\"85\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/jaljeera-masala-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}},\"55\":{\"250ml\":{\"itemName\":\"Jal Jeera\",\"itemPrice\":\"85\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/jaljeera-masala-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '404', 2, 1, 2, '', NULL, '2020-09-07 14:09:42', '2020-09-07 01:42:20'),
(76, '10000076', 17, 94, 'maj', 'asdf@gmail.com', '666666', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-09-10 07:14:49', '2020-09-09 18:44:49'),
(77, '10000077', 17, 94, 'Ff', 'mmdkhan007@gmail.com', '33333', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-09-10 08:24:03', '2020-09-09 19:54:03'),
(78, '10000078', 17, 94, 'Parul Sinha', '', '8744029409', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 2, 1, 2, '', NULL, '2020-09-13 18:31:29', '2020-09-13 06:04:22'),
(79, '10000079', 17, 94, 'Test', '', '8527144522', NULL, '{\"56\":{\"250ml\":{\"itemName\":\"ICE Tea\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/montenegro-orange-ice-tea-50417412.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"56\":{\"250ml\":{\"itemName\":\"ICE Tea\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/montenegro-orange-ice-tea-50417412.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"54\":{\"250ml\":{\"itemName\":\"Badam Milk\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/badam-milk-2-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '315', 2, 1, 2, '', NULL, '2020-09-14 14:37:11', '2020-09-14 03:41:00'),
(80, '10000080', 17, 94, 'Test5', 'test@gmail.com', '8527144522', NULL, '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"3\"}},\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"3\"}},\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}}}', '630', 2, 1, 2, '', NULL, '2020-09-14 16:08:41', '2020-09-14 03:40:27'),
(81, '10000081', 17, 94, 'Test4', 'tr@gmail.com', '8527144522', NULL, '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"63\":{\"One Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"340\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"One Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"63\":{\"One Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"340\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"One Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '462', 2, 1, 2, '', NULL, '2020-09-14 16:24:26', '2020-09-14 03:55:21'),
(82, '10000082', 17, 94, 'Test5', 'test@gmail.com', '8527144522', NULL, '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '215', 2, 1, 2, '', '2020-09-06', '2020-09-15 20:49:02', '2020-09-16 03:27:36'),
(83, '10000083', 17, 218, 'Test3', '', '8527144522', NULL, '{\"63\":{\"Half Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"240\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"63\":{\"Half Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"240\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"Half Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '252', 0, 1, 2, '', NULL, '2020-09-15 21:49:40', '2020-09-15 09:19:40'),
(84, '10000084', 17, 218, 'Test5', 'test@gmail.com', '8527144522', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 0, 1, 2, '', NULL, '2020-09-16 21:01:00', '2020-09-16 08:31:00'),
(85, '10000085', 17, 219, 'Ajeet KR thakur', 'ajeetthakur706@gmail.com', '8240386882', NULL, '{\"75\":{\"Half\":{\"itemName\":\"Steamed Rice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download1.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"58\":{\"Cup\":{\"itemName\":\"Masala Tea\",\"itemPrice\":\"60\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Jaggery-masala-chai-2.jpg\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"75\":{\"Half\":{\"itemName\":\"Steamed Rice\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download1.jpg\",\"itemType\":\"Half\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"58\":{\"Cup\":{\"itemName\":\"Masala Tea\",\"itemPrice\":\"60\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Jaggery-masala-chai-2.jpg\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '168', 2, 1, 2, '', NULL, '2020-09-17 09:42:00', '2020-09-16 21:15:23'),
(86, '10000086', 17, 218, 'Maj new', 'mmd07@gmail.com', '33333', NULL, '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '257', 0, 1, 2, '', NULL, '2020-09-17 15:43:18', '2020-09-17 03:13:18'),
(87, '10000087', 17, 218, 'Maj new', '', '33333', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-09-17 15:49:12', '2020-09-17 03:19:12'),
(88, '10000088', 17, 218, 'Mj', '', '33333', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-09-17 15:54:30', '2020-09-17 03:24:30'),
(89, '10000089', 17, 218, 'K', '', '326528', NULL, '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 0, 1, 2, '', NULL, '2020-09-17 16:00:06', '2020-09-17 03:30:06'),
(90, '10000090', 17, 218, 'Ok', '', '326528', NULL, '[]', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '', 2, 1, 2, '', NULL, '2020-09-17 16:02:48', '2020-09-17 04:24:15'),
(91, '10000091', 17, 218, 'Acdf', '', '6639985', 'take-away', '[]', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '', 2, 1, 2, '', NULL, '2020-09-17 16:05:39', '2020-09-17 04:22:07'),
(92, '10000092', 17, 219, 'Test5', 'test@gmail.com', '8527144522', NULL, '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '215', 2, 1, 2, '', NULL, '2020-09-17 16:08:13', '2020-09-17 04:21:22'),
(93, '10000093', 17, 218, 'Majeed', '', '326528', 'dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '110', 2, 1, 2, '', NULL, '2020-09-17 16:09:56', '2020-09-17 04:17:44'),
(94, '10000094', 17, 219, 'Test4', 'tr@gmail.com', '1234', 'Take Away', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '105', 2, 1, 2, '', NULL, '2020-09-17 16:29:21', '2020-09-17 04:17:27'),
(95, '10000095', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-17 22:28:44', '2020-09-17 09:58:44'),
(96, '10000096', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-17 22:30:12', '2020-09-17 10:00:12'),
(97, '10000097', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-17 22:32:33', '2020-09-17 10:02:33'),
(98, '10000098', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-17 22:56:29', '2020-09-17 10:26:29'),
(99, '10000099', 24, 226, 'Thakur', 'shubhambelmohan@gmail.com', '5363214585', 'Dine-in', '{\"84\":{\"Full\":{\"itemName\":\"Chicken Biryani\",\"itemPrice\":\"120\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download_(11).jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"85\":{\"Full\":{\"itemName\":\"Egg Biryani\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download_(12).jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}}}', '{\"84\":{\"Full\":{\"itemName\":\"Chicken Biryani\",\"itemPrice\":\"120\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download_(11).jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"85\":{\"Full\":{\"itemName\":\"Egg Biryani\",\"itemPrice\":\"90\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/download_(12).jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}}}', '238', 2, 1, 2, '', NULL, '2020-09-18 10:38:47', '2020-09-17 22:12:18'),
(100, '10000100', 17, 218, 'Tanvir', '', '8527144322', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-18 10:59:44', '2020-09-17 22:29:44'),
(101, '10000101', 17, 218, 'Tanvir', '', '8527144322', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-18 11:01:03', '2020-09-17 22:31:03'),
(102, '10000102', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"48\":{\"250ml\":{\"itemName\":\"Strawberry Milkshake\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Strawberry-Milkshake-5.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"49\":{\"250ml\":{\"itemName\":\"Vanilla Milkshake\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/190523-vanilla-milkshake-050-square-1559169406.png\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"53\":{\"250ml\":{\"itemName\":\"Masala Butter Milk\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/5eb265aa17765_pb.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"59\":{\"250ml\":{\"itemName\":\"Hot Milk\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/milk_glass_of_pexels.jpeg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"63\":{\"One Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"340\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"One Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"61\":{\"2pc\":{\"itemName\":\"Hot Gulabjamun\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/56a288e117d3f8_50310584.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"65\":{\"4pc\":{\"itemName\":\"Rasmalai\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Rasmalai-4.jpg\",\"itemType\":\"4pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"48\":{\"250ml\":{\"itemName\":\"Strawberry Milkshake\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Strawberry-Milkshake-5.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"49\":{\"250ml\":{\"itemName\":\"Vanilla Milkshake\",\"itemPrice\":\"110\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/190523-vanilla-milkshake-050-square-1559169406.png\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"53\":{\"250ml\":{\"itemName\":\"Masala Butter Milk\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/5eb265aa17765_pb.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"59\":{\"250ml\":{\"itemName\":\"Hot Milk\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/milk_glass_of_pexels.jpeg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"63\":{\"One Kg\":{\"itemName\":\"Besan Laddu\",\"itemPrice\":\"340\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/besan-laddu.png\",\"itemType\":\"One Kg\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"61\":{\"2pc\":{\"itemName\":\"Hot Gulabjamun\",\"itemPrice\":\"40\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/56a288e117d3f8_50310584.jpg\",\"itemType\":\"2pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"65\":{\"4pc\":{\"itemName\":\"Rasmalai\",\"itemPrice\":\"200\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Rasmalai-4.jpg\",\"itemType\":\"4pc\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '1250', 2, 1, 2, '', NULL, '2020-09-20 14:49:24', '2020-09-20 02:20:35'),
(103, '10000103', 19, 92, 'Tesy', 'test@tets.com', '9876451230', 'Take Away', '{\"12\":{\"Full\":{\"itemName\":\"Vegetarian christmas starter \",\"itemPrice\":\"400\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/2.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}},\"18\":{\"Full\":{\"itemName\":\"Mozerella cheese sticks\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cheese_sticks.jpeg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}},\"22\":{\"Full\":{\"itemName\":\" Caprese grilled cheese sandwich\",\"itemPrice\":\"400\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/CapreseGrilledCheeseSandwich5002161.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"26\":{\"Full\":{\"itemName\":\"Cabbage bacon sandwitch\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cabbage-bacon-sandwich-faacdb5e-0819_sq.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"28\":{\"Full\":{\"itemName\":\"Chicken Noodles\",\"itemPrice\":\"400\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/noodles.jpeg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"31\":{\"Full\":{\"itemName\":\"Spicy Prawns\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/prawns.jpeg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}}}', '{\"12\":{\"Full\":{\"itemName\":\"Vegetarian christmas starter \",\"itemPrice\":\"400\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/2.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"2\"}},\"18\":{\"Full\":{\"itemName\":\"Mozerella cheese sticks\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cheese_sticks.jpeg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"2\"}},\"22\":{\"Full\":{\"itemName\":\" Caprese grilled cheese sandwich\",\"itemPrice\":\"400\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/CapreseGrilledCheeseSandwich5002161.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"26\":{\"Full\":{\"itemName\":\"Cabbage bacon sandwitch\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cabbage-bacon-sandwich-faacdb5e-0819_sq.jpg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"28\":{\"Full\":{\"itemName\":\"Chicken Noodles\",\"itemPrice\":\"400\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/noodles.jpeg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}},\"31\":{\"Full\":{\"itemName\":\"Spicy Prawns\",\"itemPrice\":\"600\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/prawns.jpeg\",\"itemType\":\"Full\",\"itemFoodType\":\"non-veg\",\"itemCount\":\"1\"}}}', '3570', 1, 1, 2, '', NULL, '2020-09-20 18:54:41', '2020-09-20 06:25:32'),
(104, '10000104', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '158', 1, 1, 2, '', NULL, '2020-09-21 09:22:12', '2020-09-20 20:52:54'),
(105, '10000105', 17, 219, 'Sahil Gautam', 'sahilgautam.sg@gmail.com', '+919540893', 'Take Away', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 2, 1, 2, '', NULL, '2020-09-21 16:43:16', '2020-09-21 04:16:33'),
(106, '10000106', 17, 219, 'Paras Kumar', 'raiparas1995@gmail.com', '0955578783', 'Take Away', '{\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"50\":{\"250ml\":{\"itemName\":\"Apple Milkshake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/apple-milkshake-500x500.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '210', 2, 1, 2, '', NULL, '2020-09-21 16:56:37', '2020-09-21 04:32:28'),
(107, '10000107', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-21 23:06:20', '2020-09-21 10:36:20'),
(108, '10000108', 17, 218, 'Tanvir', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-22 16:55:48', '2020-09-22 04:25:48'),
(109, '10000109', 17, 218, 'Tanvir', '', '1234', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-22 17:45:45', '2020-09-22 05:15:45'),
(110, '10000110', 17, 218, 'Guru charan singh', 'gc.abhi@gmail.com', '8565003201', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-22 17:46:57', '2020-09-22 05:16:57'),
(111, '10000111', 17, 218, 'Test', '', '8527144522', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '11', 0, 2, 1, '', NULL, '2020-09-22 18:05:49', '2020-09-22 05:35:49'),
(112, '10000112', 17, 219, 'Sahil Gautam', 'sahilgautam.sg@gmail.com', '+919540893', 'Dine-in', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"10\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"47\":{\"250ml\":{\"itemName\":\"Banana Shake\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/30feb94b41ab8ab.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', '116', 2, 1, 2, '', NULL, '2020-09-22 20:26:58', '2020-09-22 07:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `payment_setup`
--

CREATE TABLE `payment_setup` (
  `pid` int(10) NOT NULL,
  `rest_id` int(10) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `pub_key` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_setup`
--

INSERT INTO `payment_setup` (`pid`, `rest_id`, `mode`, `secret_key`, `pub_key`, `status`, `date_created`) VALUES
(2, 19, 'test', 'sk_test_j5k0976GOLSOtiRzbDLpKqat00og5iM3cY', 'pk_test_5f6jfFP2ZV5U9TXQYG0vtqFJ00eFVWNoRX', 'on', '2020-07-15 10:03:02'),
(3, 17, 'Online', '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', 'pk_live_51HJsEGJMWNTDp0AmGrfqWDj1ONoj6DdEAFVF79bmfLs82AnoKKwNL53EAaI5NzRkAv8MLvgsff96s6Pg3BUs4bob00j4Ff9koM', 'on', '2020-08-24 19:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `qr_config`
--

CREATE TABLE `qr_config` (
  `con_id` int(10) NOT NULL,
  `rest_id` int(10) NOT NULL,
  `bg_img` varchar(255) NOT NULL,
  `bg_status` int(10) NOT NULL,
  `logo_status` int(10) NOT NULL,
  `custom_msg` longtext NOT NULL,
  `table_name_status` int(10) NOT NULL,
  `venue_name_staus` int(10) NOT NULL,
  `welcome_msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_config`
--

INSERT INTO `qr_config` (`con_id`, `rest_id`, `bg_img`, `bg_status`, `logo_status`, `custom_msg`, `table_name_status`, `venue_name_staus`, `welcome_msg`) VALUES
(5, 21, 'assets/uploads/qrconfig/21/B612_20200610_085639_976.jpg', 1, 1, 'TAJ Palace', 1, 0, 'For contact less menu Scan the Qr below'),
(6, 17, 'assets/uploads/qrconfig/17/34641760-vertical-background-texture-of-white-wooden-wall.jpg', 1, 1, 'Powered by Fligobeam Networks.', 1, 1, 'Scan QR below for Contact-less orders'),
(7, 19, 'assets/uploads/qrconfig/19/ayqp0vni1p2qatsdasr6.png', 1, 1, 'test2', 1, 1, 'test'),
(8, 23, 'assets/uploads/qrconfig/23/afgani_momos.jpg', 1, 1, 'Powered by Fligobeam Networks.', 1, 1, 'Scan QR Below For Contact-less Orders'),
(9, 24, 'assets/uploads/qrconfig/24/jashn1.jpg', 1, 1, 'we are happy to serve you', 1, 1, 'welcome to jashn');

-- --------------------------------------------------------

--
-- Table structure for table `res_table`
--

CREATE TABLE `res_table` (
  `table_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `table_name` varchar(500) NOT NULL,
  `table_type` int(11) NOT NULL,
  `table_qr` varchar(50) NOT NULL,
  `con_id` int(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `res_table`
--

INSERT INTO `res_table` (`table_id`, `rest_id`, `table_name`, `table_type`, `table_qr`, `con_id`, `token`, `created_at`, `updated_at`) VALUES
(13, 13, 'Rm34', 1, '', 0, '', '2020-06-11 13:36:06', '2020-06-12 17:18:48'),
(17, 13, 'Rm7', 2, '', 0, '', '2020-06-11 13:36:06', '2020-06-11 13:36:06'),
(18, 13, 'Rm8', 2, '', 0, '', '2020-06-11 13:36:06', '2020-06-11 13:36:06'),
(19, 13, 'test2', 2, '', 0, '', '2020-06-11 03:46:00', '2020-06-11 03:46:00'),
(20, 13, 'test3', 2, '', 0, '', '2020-06-11 03:46:00', '2020-06-11 03:46:00'),
(21, 13, 'test4', 2, '', 0, '', '2020-06-11 03:46:00', '2020-06-11 03:46:00'),
(60, 21, 'Table No.1', 1, 'global/tmp/qr_codes/1267605480.png', 5, 'e15e6784ec7b3fc91630c3d700323446', '2020-07-02 06:45:04', '2020-07-24 22:45:25'),
(61, 21, 'Table No.2', 2, 'global/tmp/qr_codes/553510915.png', 5, '3b41592d435ecaa445f3a0427edaf68c', '2020-07-02 06:45:04', '2020-07-24 22:45:25'),
(62, 21, 'Table No.3', 2, 'global/tmp/qr_codes/1844975950.png', 5, '51a52c27d15c5cc4126eb5caa877cbbd', '2020-07-02 06:45:04', '2020-07-24 22:45:26'),
(63, 21, 'Table No.4', 2, 'global/tmp/qr_codes/932625593.png', 5, '16677bb076740d7c05ae24c5378526e8', '2020-07-02 06:45:04', '2020-07-24 22:45:26'),
(64, 21, 'Table No.5', 2, 'global/tmp/qr_codes/1044487088.png', 5, 'a39a96e8d74cf703648aae4c56d6a5aa', '2020-07-02 06:45:04', '2020-07-24 22:45:26'),
(65, 21, 'Table No.10', 2, 'global/tmp/qr_codes/2029985296.png', 5, '547277ee1bdfd42a0995c77a1f1ae4f4', '2020-07-02 06:45:43', '2020-07-24 21:33:10'),
(66, 21, 'Table No.11', 2, 'global/tmp/qr_codes/1373773206.png', 5, '3676013f50f0e663e947c12e8f6fa972', '2020-07-02 06:45:43', '2020-07-24 21:33:10'),
(67, 21, 'Table No.6', 2, 'global/tmp/qr_codes/2145084870.png', 5, 'e62030c5971a806f0edc3bcb1d30c43b', '2020-07-02 06:51:22', '2020-07-24 21:33:10'),
(68, 21, 'Table No.7', 2, 'global/tmp/qr_codes/1055270108.png', 5, '2bef0b21cce2dbcdd1ddf2a0815feb3c', '2020-07-02 06:51:22', '2020-07-24 21:33:11'),
(79, 21, 'Pool1', 3, 'global/tmp/qr_codes/734166924.png', 5, '5a295899024c1815699c100d364962e6', '2020-07-06 11:08:18', '2020-07-24 21:33:11'),
(80, 21, 'Pool2', 3, '', 0, 'ef8b92caef5b275ac93bf21ef32eb179', '2020-07-06 11:08:18', '2020-07-06 11:08:18'),
(81, 21, 'table199', 3, '', 0, '4e47a9f51581c00285c6be247b89ba33', '2020-07-12 22:29:07', '2020-07-12 22:29:07'),
(82, 21, 'table200', 3, '', 0, 'd13d8542b60d234fd26d580ebf126805', '2020-07-12 22:29:07', '2020-07-12 22:29:07'),
(83, 21, 'GOA 2', 4, '', 0, '', '2020-07-12 22:31:12', '2020-07-12 22:31:12'),
(84, 19, 'Room No.101', 2, 'global/tmp/qr_codes/152942136.png', 7, '2477967232f88a2dbb38bdb960a388ea', '2020-07-27 01:48:59', '2020-09-20 00:22:04'),
(85, 19, 'Room No.102', 2, 'global/tmp/qr_codes/1697606354.png', 7, '289d2fca34b58fbc83ee96c775acd02e', '2020-07-27 01:48:59', '2020-09-20 00:20:59'),
(86, 19, 'Room No.103', 2, 'global/tmp/qr_codes/1871682506.png', 7, 'bf89cd234a61765c283cb2e1cef8dac4', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(87, 19, 'Room No.104', 2, 'global/tmp/qr_codes/1565701199.png', 7, '4189291be47dc1f79819528297bdd264', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(88, 19, 'Room No.105', 2, 'global/tmp/qr_codes/978670431.png', 7, 'd2e5fb5f7f23789166b4fbf8b8bb9bee', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(89, 19, 'Room No.106', 2, 'global/tmp/qr_codes/1667485459.png', 7, 'c1277536f0633bbe6d2b805906d5930a', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(90, 19, 'Room No.107', 2, 'global/tmp/qr_codes/96650317.png', 7, '392643e15eadf19dd2997564da833171', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(91, 19, 'Room No.108', 2, 'global/tmp/qr_codes/1931974801.png', 7, 'b7a618947a4b92bcdad2f91711437b81', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(92, 19, 'Room No.109', 2, 'global/tmp/qr_codes/677711827.png', 7, '6732895db91955a2e554efcaca2bfd9b', '2020-07-27 01:48:59', '2020-09-20 06:23:07'),
(93, 19, 'Room No.110', 2, 'global/tmp/qr_codes/1857266103.png', 7, '8e7640a42eae5a0d9337008e6d795d37', '2020-07-27 01:48:59', '2020-08-24 20:14:56'),
(102, 23, 'Streetreat', 1, 'global/tmp/qr_codes/2106264935.png', 8, '20a1bbb96e45602fd2980fdeb079fbcb', '2020-08-25 08:52:37', '2020-08-27 20:18:45'),
(218, 17, 'Test', 1, 'global/tmp/qr_codes/1612383252.png', 6, 'cb2656338095cdb1207d782df7203f19', '2020-09-15 08:31:30', '2020-09-22 04:23:54'),
(219, 17, 'Table No.10', 1, 'global/tmp/qr_codes/1585763409.png', 6, '6d5a033932636618ecfe6dd0e60a40a2', '2020-09-15 09:25:07', '2020-09-22 07:55:04'),
(220, 17, 'Table No.11', 1, 'global/tmp/qr_codes/1186252452.png', 6, '0d184c69e57eb527b83a76ab12b34873', '2020-09-15 09:25:07', '2020-09-16 21:04:41'),
(221, 17, 'Table No.12', 1, 'global/tmp/qr_codes/1502882861.png', 6, '6bc2fc1c63f1458a45c88f546b1b2fd7', '2020-09-15 09:25:07', '2020-09-15 09:25:17'),
(222, 17, 'Table No.13', 1, 'global/tmp/qr_codes/1470218329.png', 6, '467f14265d1da1bbfd01a70212ac4180', '2020-09-15 09:25:07', '2020-09-15 10:19:13'),
(223, 17, 'Table No.14', 1, 'global/tmp/qr_codes/890165296.png', 6, 'e556ea6978de3776440e70e93de43b63', '2020-09-15 09:25:07', '2020-09-15 09:25:17'),
(224, 17, 'Table No.15', 1, 'global/tmp/qr_codes/1056461392.png', 6, 'fb8264928324b50f962200742ef2fab9', '2020-09-15 09:25:07', '2020-09-15 09:25:17'),
(225, 24, 'Table No.1', 1, 'global/tmp/qr_codes/204117577.png', 9, 'de60447caffdab943d4ad1394934b764', '2020-09-17 21:58:31', '2020-09-17 22:03:39'),
(226, 24, 'Table No.2', 1, 'global/tmp/qr_codes/1145512110.png', 9, '433adb188ebbbf384f463ec422e5099f', '2020-09-17 21:59:27', '2020-09-17 22:03:39'),
(227, 24, 'Table No.3', 1, 'global/tmp/qr_codes/872191627.png', 9, 'f33406ed368d157c19a1baf9d7e62652', '2020-09-17 22:03:15', '2020-09-17 22:03:39'),
(228, 17, 'Table No.200', 1, '', 0, '137b5af6265c6ff397e2e43dd0c00c1e', '2020-09-19 22:09:48', '2020-09-19 22:09:48'),
(229, 17, 'Table No.201', 1, '', 0, '107ed97839731b73bafb5f4535433ab2', '2020-09-19 22:09:48', '2020-09-19 22:09:48'),
(230, 17, 'Table No.202', 1, '', 0, 'b2cf16a58a16892a653b9e8792ac703f', '2020-09-19 22:09:48', '2020-09-19 22:09:48'),
(231, 17, 'Table No.203', 1, '', 0, 'a236e740529069a03e763322d1319ea4', '2020-09-19 22:09:48', '2020-09-19 22:09:48'),
(232, 17, 'Table No.204', 1, '', 0, '151021eb307b90def52fd45ceb7a9554', '2020-09-19 22:09:48', '2020-09-19 22:09:48'),
(233, 17, 'Table No.205', 1, '', 0, '87bf5731a1a93202ed429ac9d04b9bc0', '2020-09-19 22:09:48', '2020-09-19 22:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `res_tax`
--

CREATE TABLE `res_tax` (
  `tax_id` int(11) NOT NULL,
  `rest_id` int(11) DEFAULT NULL,
  `tax_type` varchar(250) DEFAULT NULL,
  `tax_percent` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_tax`
--

INSERT INTO `res_tax` (`tax_id`, `rest_id`, `tax_type`, `tax_percent`, `created_at`) VALUES
(10, 24, 'SERVICE', '3', '2020-09-08 17:07:59'),
(8, 17, 'GST', '5', '2020-09-06 16:11:22'),
(5, 19, 'GST', '5', '2020-07-27 08:45:55'),
(11, 24, 'GST', '5', '2020-09-08 17:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(10) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax` int(20) NOT NULL,
  `rest_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_name`, `tax`, `rest_id`, `created_at`) VALUES
(2, 'CGST', 7, 19, '2020-07-05 10:39:05'),
(3, 'SGST', 5, 19, '2020-07-05 10:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `rest_id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_exp_month` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `card_exp_year` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `card_last_4` int(20) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `paid_amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `rest_id`, `name`, `email`, `phone`, `card_type`, `card_exp_month`, `card_exp_year`, `card_last_4`, `item_name`, `item_number`, `item_price`, `paid_amount`, `paid_amount_currency`, `txn_id`, `receipt_url`, `payment_status`, `created`, `modified`) VALUES
(9, 19, 'Guru', 'test@gnail.com', NULL, 'Visa', '4', '2058', 4242, 'Shopping', '<div> TEST THE Receipt</div>', 1133.00, '1133', 'inr', 'txn_1H1xrsLfcNO5LN3fBwD56WxD', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H1xrsLfcNO5LN3fohptOez5/rcpt_HbACGHeDWtSnZnLjjfeJcPO5Il65H9f', 'succeeded', '2020-07-06 17:12:36', '2020-07-06 17:12:36'),
(10, 19, 'Payment 2', 'gc.abhi@gmail.com', NULL, 'Visa', '12', '2025', 4242, 'Shopping', '<div> TEST THE Receipt</div>', 876.00, '876', 'inr', 'txn_1H1yCHLfcNO5LN3frwdpPG2a', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H1yCGLfcNO5LN3fxUfhWEdb/rcpt_HbAXExfsEYyKQdHBzNlbMCHoNa0BG7c', 'succeeded', '2020-07-06 17:33:41', '2020-07-06 17:33:41'),
(11, 19, 'Payment 4', 'gc.abhi@gmail.com', NULL, 'Visa', '12', '2025', 4242, 'Shopping', '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"2\"}},\"20\":{\"Half\":{\"itemName\":\"Onion rings\",\"itemPrice\":\"100\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/onion_rings.jpg\",\"itemType\":\"Half\",\"itemCount\":\"1\"}}}', 1022.00, '1022', 'inr', 'txn_1H1yJBLfcNO5LN3feA1dRP4V', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H1yJALfcNO5LN3fM0vLtrDe/rcpt_HbAeYKtXp4m3Kc74uWCsJ5urKsORRA3', 'succeeded', '2020-07-06 17:40:49', '2020-07-06 17:40:49'),
(12, 19, 'Shivangi', 'test@gmail.com', NULL, 'Visa', '7', '2022', 4242, 'Shopping', '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', 511.00, '511', 'inr', 'txn_1H2BurLfcNO5LN3f2J5Nrzcp', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H2BurLfcNO5LN3fdTluBTNK/rcpt_HbOiIiHeGMPgpgaxY1ZnVsLZAkZ2t3v', 'succeeded', '2020-07-07 08:12:37', '2020-07-07 08:12:37'),
(13, 19, 'test', 'test@gmail.com', NULL, 'Visa', '2', '2022', 4242, 'Shopping', '{\"17\":{\"Full\":{\"itemName\":\"Enchilada Cups\",\"itemPrice\":\"300\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/cups.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', 438.00, '438', 'inr', 'txn_1H2C1nLfcNO5LN3fgeTM8xjH', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H2C1nLfcNO5LN3fOBgl7Ggz/rcpt_HbOp5fCuD2k1nhiYGAYf1z0iSMz1mDY', 'succeeded', '2020-07-07 08:19:48', '2020-07-07 08:19:48'),
(14, 21, 'Suchindra jamwal', 'tanujamwal002@gmail.com', NULL, 'Visa', '12', '2021', 4242, 'Shopping', '{\"39\":{\"Full\":{\"itemName\":\"chicken tikka\",\"itemPrice\":\"1000\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/chicken_seekh1.jpg\",\"itemType\":\"Full\",\"itemCount\":\"1\"}},\"9\":{\"half\":{\"itemName\":\"Chicken\",\"itemPrice\":\"250\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/IMG_7261_1724159036_center.jpg\",\"itemType\":\"half\",\"itemCount\":\"2\"}}}', 1500.00, '1500', 'inr', 'txn_1H2JRKLfcNO5LN3fItNvWfP7', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H2JRJLfcNO5LN3fyYDyDlNh/rcpt_HbWUeqSIxiUSGaQOFAMzPsqrwaqEx2a', 'succeeded', '2020-07-07 16:14:38', '2020-07-07 16:14:38'),
(15, 19, 'Guru Charan Singh', 'gurucharan.singh@bicsl.com', NULL, 'Visa', '2', '2042', 4242, 'Shopping', '{\"15\":{\"Full\":{\"itemName\":\"Mutton sheek kebab\",\"itemPrice\":\"350\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/kebabs.png\",\"itemType\":\"Full\",\"itemCount\":\"1\"}}}', 511.00, '511', 'inr', 'txn_1H5EOSLfcNO5LN3fT9LoT2Kr', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1H5EORLfcNO5LN3f3vD9taUA/rcpt_HeXTsW49mlVTyMQkAGJmIp8ZyL3GOm1', 'succeeded', '2020-07-15 17:27:44', '2020-07-15 17:27:44'),
(16, 17, 'Test4', '', '8527144522', 'Visa', '12', '2020', 4242, 'Shopping', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', 110.00, '110', 'inr', 'txn_1HLmabLfcNO5LN3f2Hb84iTL', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1HLmaaLfcNO5LN3f3UgOvXVq/rcpt_HvdsgSgUWwnyOhTrVMHhx1GgCcNkF4h', 'succeeded', '2020-08-30 14:42:41', '2020-08-30 14:42:41'),
(17, 17, 'Test123', '', '8527144522', 'Visa', '5', '2021', 4242, 'Shopping', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', 110.00, '110', 'inr', 'txn_1HLmdnLfcNO5LN3fS0mOHHSn', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1HLmdmLfcNO5LN3f1FTUiPoI/rcpt_HvdvHTWgYQhQIItQOdg9xqZiUfYGLIH', 'succeeded', '2020-08-30 14:45:59', '2020-08-30 14:45:59'),
(18, 17, 'Majeed', 'mmd07@gmail.com', '9535777717', 'Visa', '4', '2022', 4242, 'Shopping', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', 110.00, '110', 'inr', 'txn_1HLnNBLfcNO5LN3fqsSkCd1j', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1HLnNALfcNO5LN3fne7mBgrR/rcpt_HvegjRxAm8NE60CHUDFB9A26ppO1GhR', 'succeeded', '2020-08-30 15:32:53', '2020-08-30 15:32:53'),
(19, 17, 'Test10', '', '8527144522', 'Visa', '12', '2020', 4242, 'Shopping', '{\"52\":{\"250ml\":{\"itemName\":\"Aam Panna\",\"itemPrice\":\"150\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/Aam-Panna-4.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"59\":{\"250ml\":{\"itemName\":\"Hot Milk\",\"itemPrice\":\"50\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/milk_glass_of_pexels.jpeg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"57\":{\"Cup\":{\"itemName\":\"Indian Coffee\",\"itemPrice\":\"160\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51_fit-76\",\"itemType\":\"Cup\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', 378.00, '378', 'inr', 'txn_1HLna4LfcNO5LN3f4yfEYPVo', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1HLna3LfcNO5LN3f7KFW9hWG/rcpt_HvetSLWbUh2jEYVvqdDbzNVdG4ZziDR', 'succeeded', '2020-08-30 15:46:12', '2020-08-30 15:46:12'),
(20, 17, 'Test3', 'test@gmail.com', '8527144522', 'Visa', '12', '2020', 4242, 'Shopping', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', 262.00, '262', 'inr', 'txn_1HMWYgLfcNO5LN3fkGdDt4S8', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1HMWYgLfcNO5LN3frp7FxamA/rcpt_HwPNAke62KH6vLMosUEFt4X7JhVXSLm', 'succeeded', '2020-09-01 15:47:46', '2020-09-01 15:47:46'),
(21, 17, 'Tanvir', '', '8527144522', 'Visa', '12', '2020', 4242, 'Shopping', '{\"37\":{\"250ml\":{\"itemName\":\"Fresh Lime Juice\",\"itemPrice\":\"105\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/lime-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}},\"41\":{\"250ml\":{\"itemName\":\"Grape Juice\",\"itemPrice\":\"140\",\"itemImage\":\"assets\\/uploads\\/menu_items\\/grape-juice.jpg\",\"itemType\":\"250ml\",\"itemFoodType\":\"veg\",\"itemCount\":\"1\"}}}', 257.00, '257', 'inr', 'txn_1HOQV6LfcNO5LN3fN0cX668S', 'https://pay.stripe.com/receipts/acct_1FNMWrLfcNO5LN3f/ch_1HOQV6LfcNO5LN3fDgynIhld/rcpt_HyNFgXjzb2EkxJVMU1YFbuyLG5HKgNC', 'succeeded', '2020-09-06 21:43:57', '2020-09-06 21:43:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `erp_user`
--
ALTER TABLE `erp_user`
  ADD PRIMARY KEY (`rest_id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`menu_id`,`title`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_setup`
--
ALTER TABLE `payment_setup`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `qr_config`
--
ALTER TABLE `qr_config`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `res_table`
--
ALTER TABLE `res_table`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `res_tax`
--
ALTER TABLE `res_tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erp_user`
--
ALTER TABLE `erp_user`
  MODIFY `rest_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `payment_setup`
--
ALTER TABLE `payment_setup`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qr_config`
--
ALTER TABLE `qr_config`
  MODIFY `con_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `res_table`
--
ALTER TABLE `res_table`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `res_tax`
--
ALTER TABLE `res_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `tax_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu_category` (`menu_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
