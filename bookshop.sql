-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2023 at 06:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` varchar(9999) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `page_length` int(11) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `price`, `stock`, `image_path`, `description`, `publisher`, `publication_date`, `page_length`, `language`, `isbn`) VALUES
(1, 'The Brothers Karamazov', 'Fyodor Dostoevsky', '19.99', 151, 'product_images/karamazov.jpg', 'The Brothers Karamazov is a murder mystery, a courtroom drama, and an exploration of erotic rivalry in a series of triangular love affairs involving the “wicked and sentimental” Fyodor Pavlovich Karamazov and his three sons―the impulsive and sensual Dmitri; the coldly rational Ivan; and the healthy, red-cheeked young novice Alyosha. Through the gripping events of their story, Dostoevsky portrays the whole of Russian life, is social and spiritual striving, in what was both the golden age and a tragic turning point in Russian culture.', 'Penguin Classics', '2003-02-27', 1056, 'English', '9780140449242'),
(2, 'Republic', 'Plato', '24.99', 68, 'product_images/republic.jpg', 'The Republic is a Socratic dialogue, authored by Plato around 375 BCE, concerning justice, the order and character of the just city-state, and the just man. It is Plato\'s best-known work, and one of the world\'s most influential works of philosophy and political theory, both intellectually and historically.', 'Oxford University Press', '2008-05-15', 560, 'English', '9780199535767'),
(3, 'War and Peace', 'Leo Tolstoy', '45.99', 85, 'product_images/war-and-peace.jpg', 'War and Peace broadly focuses on Napoleon’s invasion of Russia in 1812 and follows three of the most well-known characters in literature: Pierre Bezukhov, the illegitimate son of a count who is fighting for his inheritance and yearning for spiritual fulfillment; Prince Andrei Bolkonsky, who leaves his family behind to fight in the war against Napoleon; and Natasha Rostov, the beautiful young daughter of a nobleman who intrigues both men.', 'Penguin Classics', '2009-12-02', 1225, 'English', '1400079985'),
(4, 'The Stranger', 'Albert Camus', '15.00', 20, 'product_images/stranger.jpg', 'The Stranger, also published in English as The Outsider, is a 1942 novella written by French author Albert Camus. The first of Camus\' novels published in his lifetime, the story follows Meursault, an indifferent settler in French Algeria, who, weeks after his mother\'s funeral, kills an unnamed Arab man in Algiers.', ' Knopf Doubleday Publishing Group ', '1989-03-13', 123, 'English', ' 9780679720201 '),
(5, 'The Odyssey', 'Homer', '9.99', 49, 'product_images/odyssey.jpg', 'The Odyssey is one of two major ancient Greek epic poems attributed to Homer. It is one of the oldest extant works of literature still widely read by modern audiences. As with the Iliad, the poem is divided into 24 books. It follows the Greek hero Odysseus, king of Ithaca, and his journey home after the Trojan War.', 'Penguin Classics', '2003-04-29', 416, 'English', '9780140449112'),
(6, 'Moby-Dick', 'Herman Melville', '29.99', 10, 'product_images/moby-dick.jpg', '\"It is the horrible texture of a fabric that should be woven of ships\' cables and hawsers. A Polar wind blows through it, and birds of prey hover over it.\"\r\n\r\nSo Melville wrote of his masterpiece, one of the greatest works of imagination in literary history. In part, Moby-Dick is the story of an eerily compelling madman pursuing an unholy war against a creature as vast and dangerous and unknowable as the sea itself. But more than just a novel of adventure, more than an encyclopaedia of whaling lore and legend, the book can be seen as part of its author\'s lifelong meditation on America. Written with wonderfully redemptive humour, Moby-Dick is also a profound inquiry into character, faith, and the nature of perception.', 'Penguin Classics', '2002-12-31', 720, 'English', '142437247'),
(7, 'The Book of Disquiet', 'Fernando Pessoa', '19.49', 15, 'product_images/disquiet.jpg', 'The Book of Disquiet is a work by the Portuguese author Fernando Pessoa. Published posthumously, The Book of Disquiet is a fragmentary lifetime project, left unedited by the author, who introduced it as a \"factless autobiography.\"', 'Penguin Classics', NULL, NULL, NULL, NULL),
(8, 'Anna Karenina', 'Leo Tolstoy', '19.49', 80, 'product_images/anna.jpg', NULL, 'Penguin Classics', NULL, NULL, NULL, NULL),
(9, 'Industrial Society and Its Future', 'Ted Kaczynski', '9.99', 56, 'product_images/unabomber_manifesto.jpg', ' In 1971 Dr. Theodore Kaczynski rejected modern society and moved to a primitive cabin in the woods of Montana. There, he began building bombs, which he sent to professors and executives to express his disdain for modern society, and to work on his magnum opus, Industrial Society and Its Future, forever known to the world as the Unabomber Manifesto. Responsible for three deaths and more than twenty casualties over two decades, he was finally identifed and apprehended when his brother recognized his writing style while reading the \'Unabomber Manifesto.\' The piece, written under the pseudonym FC (Freedom Club) was published in the New York Times after his promise to cease the bombing if a major publication printed it in its entirety. ', 'Freedom Club', '1995-09-19', 90, 'English', '‎1595948155'),
(10, 'Crime and Punishment', 'Fyodor Dostoevsky', '14.99', 120, 'product_images/crime-punishment.jpeg', 'Raskolnikov, a destitute and desperate former student, wanders through the slums of St Petersburg and commits a random murder without remorse or regret. He imagines himself to be a great man, a Napoleon: acting for a higher purpose beyond conventional moral law. But as he embarks on a dangerous game of cat and mouse with a suspicious police investigator, Raskolnikov is pursued by the growing voice of his conscience and finds the noose of his own guilt tightening around his neck. Only Sonya, a downtrodden prostitute, can offer the chance of redemption', 'Penguin Classics', '2002-12-31', 720, 'English', '0140449132'),
(11, 'The Idiot', 'Fyodor Dostoevsky', '19.49', 50, 'product_images/idiot.jpg', 'Returning to Russia from a sanitarium in Switzerland, the Christ-like epileptic Prince Myshkin finds himself enmeshed in a tangle of love, torn between two women—the notorious kept woman Nastasya and the pure Aglaia—both involved, in turn, with the corrupt, money-hungry Ganya. In the end, Myshkin’s honesty, goodness, and integrity are shown to be unequal to the moral emptiness of those around him. In her revision of the Garnett translation, Anna Brailovsky has corrected inaccuracies wrought by Garnett’s drastic anglicization of the novel, restoring as much as possible the syntactical structure of the original story.', 'Penguin Classics', '2004-08-31', 768, 'English', '14044792'),
(12, 'The Divine Comedy', 'Dante Alighieri', '13.99', 95, 'product_images/divine_comedy.jpg', 'The Divine Comedy begins in a shadowed forest on Good Friday in the year 1300. It proceeds on a journey that, in its intense recreation of the depths and the heights of human experience, has become the key with which Western civilization has sought to unlock the mystery of its own identity. \n\nAllen Mandelbaum’s astonishingly Dantean translation, which captures so much of the life of the original, renders whole for us the masterpiece of that genius whom our greatest poets have recognized as a central model for all poets.', ' Everyman\'s Library ', '1995-08-01', 798, 'English', '0679433139'),
(13, 'Don Quixote', 'Miguel de Cervantes', '13.99', 10, 'product_images/don-quixote.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'The Great Gatsby', 'F. Scott Fitzgerald', '7.29', 10, 'product_images/Gatsby.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Hamlet', 'William Shakespeare', '9.99', 12, 'product_images/hamlet.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Iliad', 'Homer', '13.29', 23, 'product_images/iliad.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'In Search of Lost Time', 'Marcel Proust', '85.00', 12, 'product_images/in-search-of-lost-time.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Infinite Jest', 'David Foster Wallace', '15.00', 22, 'product_images/jest.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'The Count Of Monte Cristo', 'Alexandre Dumas', '17.99', 25, 'product_images/monte-cristo.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Paradise Lost', 'John Milton', '12.99', 38, 'product_images/paradise_lost.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(21, '1984', 'George Orwell', '12.99', 199, 'product_images/1984.jpg', '\"1984\" is a classic dystopian novel written by George Orwell. Set in a totalitarian society, the story follows the life of Winston Smith, an ordinary citizen who begins to question the ruling party\'s oppressive regime and their control over every aspect of people\'s lives. The book explores themes of government oppression, surveillance, propaganda, and the power of language to shape reality. Orwell\'s vivid portrayal of a bleak future serves as a warning against totalitarianism and the dangers of giving unchecked power to those in authority.', 'Penguin Classics', '1949-06-08', 328, 'English', '9780451524935'),
(22, 'Stoner', 'John Edward Williams', '14.99', 18, 'product_images/Stoner.jpg', 'William Stoner is born at the end of the nineteenth century into a dirt-poor Missouri farming family. Sent to the state university to study agronomy, he instead falls in love with English literature and embraces a scholar’s life, so different from the hardscrabble existence he has known. And yet as the years pass, Stoner encounters a succession of disappointments: marriage into a “proper” family estranges him from his parents; his career is stymied; his wife and daughter turn coldly away from him; a transforming experience of new love ends under threat of scandal. Driven ever deeper within himself, Stoner rediscovers the stoic silence of his forebears and confronts an essential solitude.', 'NYRB Classics', '2006-06-20', 288, 'English', '1590171993'),
(23, 'Ulysses', 'James Joyce', '45.99', 33, 'product_images/ulysses.jpg', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Mein Kampf', 'Adolf Hitler', '9.99', 69, 'product_images/mein_kampf.jpg', 'Mein Kampf, (German: “My Struggle”) political manifesto written by Adolf Hitler. It was his only complete book, and the work became the bible of National Socialism (Nazism) in Germany’s Third Reich. It was published in two volumes in 1925 and 1927, and an abridged edition appeared in 1930. By 1939 it had sold 5,200,000 copies and had been translated into 11 languages.', NULL, '1925-07-18', 720, 'English', NULL),
(25, 'The Catcher in the Rye', 'J. D. Salinger', '4.49', 20, 'product_images/catcher.jpg', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `shipping_address`, `order_date`, `order_status`) VALUES
(10, 2, 'Sylhet', '2023-05-12 01:21:20', 'Delivered'),
(11, 2, 'Sylhet', '2023-05-12 02:10:26', 'Delivered'),
(16, 10, 'Dhaka', '2023-05-12 16:40:44', 'Delivered'),
(20, 2, 'Dhaka', '2023-05-12 20:14:05', 'Shipped'),
(22, 1, 'Dhaka', '2023-05-12 21:14:33', 'Shipped'),
(23, 14, 'Dhaka', '2023-05-12 22:47:33', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(14, 10, 9, 1, '9.99'),
(15, 11, 2, 1, '24.99'),
(20, 16, 1, 1, '19.99'),
(24, 20, 4, 1, '15.00'),
(26, 22, 12, 1, '13.99'),
(27, 23, 21, 1, '12.99');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `user_id`, `username`, `book_id`, `quantity`, `date_added`) VALUES
(74, 1, 'admin', 17, 1, '2023-05-12 21:15:08'),
(77, 1, 'admin', 2, 1, '2023-05-12 22:04:29'),
(78, 13, 'user2', 7, 1, '2023-05-12 22:30:29'),
(79, 13, 'user2', 16, 1, '2023-05-12 22:30:41'),
(81, 14, 'user3', 20, 1, '2023-05-12 22:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `first_name`, `last_name`, `address`, `user_role`) VALUES
(1, 'admin', 'admin@bookshop.com', '$2y$10$LmE.jNqAKhuk8JSQax9WlObYSCVoND/AnosR3j9OOMq6kJaI.due2', 'Bookshop', 'Admin', 'Dhaka', 'admin'),
(2, 'sarwar', 'gmail@sarwar.com', '$2y$10$jLJNGN2N67xLuFZWufX9YenIGQquFq8uqsJOl5AHAV123evP5TNM6', 'Sarwar ', 'Uddin', 'Dhaka', 'admin'),
(3, 'asma', 'asma@bookshop.com', '$2y$10$uVT9oEmjROWzuDxJwbcBAuTy.iuwZFo7JQRCYVmDsu89uaPCEtfdq', 'Asma', 'Omar', 'Dhaka', 'admin'),
(4, 'subha', 'subha@maisha.com', '$2y$10$6d3UMFYltX.us4Xc8le3EO4gMZ4cLQ8c55aL/09aUrSASQmhGkHce', 'Maisha', 'Subha', 'Dhaka', 'admin'),
(10, 'user1', 'user1@gmail.com', '$2y$10$nlgbP/3WlfbsBd7BhteW9uskhgLTAOZbQiZ6jUTDp6snw54XUutQK', 'user', '1', 'Dhaka', 'user'),
(13, 'user2', 'user2@bookshop.com', '$2y$10$PCwpxm0PTrMGLMCZL.1bOOV7eUa34EbDz8redCUrvGgz7aH8oZOwS', 'user', '2', 'Dhaka', 'user'),
(14, 'user3', 'user3@northsouth.edu', '$2y$10$G.GTkgD/YCu5Rj8.3dA3SOASZIgTKV2bDct19FdIiSmH8bbY/nLfq', '', '', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_items_ibfk_1` (`order_id`),
  ADD KEY `order_items_ibfk_2` (`book_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uc_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
