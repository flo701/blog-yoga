-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 18 fév. 2023 à 22:03
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_yoga`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `creation_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `image`, `category`, `title`, `text`, `creation_date`) VALUES
(1, '/blog-yoga/image/femme-yogi-3.jpg', 'D&eacute;buter le yoga', 'Les bienfaits du yoga', 'Le yoga nous est toujours b&eacute;n&eacute;fique quel que soit notre condition physique. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis modi natus iste, facere, laudantium voluptas quam cum, doloribus illo. Quia sequi a et natus veritatis repudiandae ducimus molestiae soluta perferendis placeat, esse debitis quidem nostrum error distinctio totam facere deleniti nulla, expedita vel accusamus reprehenderit delectus molestias. Fugiat, facere adipisci aliquam eveniet doloremque perferendis porro, ratione alias eum a error repellat amet asperiores aliquid nihil commodi provident repudiandae, facilis illo optio dolore tempora. Rerum, fugit. Quasi assumenda dolores repudiandae repellat earum quisquam commodi neque est incidunt inventore! Aut aliquid sed natus blanditiis tempore voluptatibus impedit consequatur obcaecati. Maiores, sunt accusamus quos nesciunt exercitationem tempora, dolorum molestiae vitae nobis natus hic libero in? Quos amet in cumque inventor', '2023-02-05'),
(21, '/blog-yoga/image/respirer-2.jpg', 'Respiration', 'Respirer &agrave; pleins poumons !', 'Une bonne oxyg&eacute;nation des cellules est essentielle pour une bonne sant&eacute;. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis modi natus iste, facere, laudantium voluptas quam cum, doloribus illo. Quia sequi a et natus veritatis repudiandae ducimus molestiae soluta perferendis placeat, esse debitis quidem nostrum error distinctio totam facere deleniti nulla, expedita vel accusamus reprehenderit delectus molestias. Fugiat, facere adipisci aliquam eveniet doloremque perferendis porro, ratione alias eum a error repellat amet asperiores aliquid nihil commodi provident repudiandae, facilis illo optio dolore tempora. Rerum, fugit. Quasi assumenda dolores repudiandae repellat earum quisquam commodi neque est incidunt inventore! Aut aliquid sed natus blanditiis tempore voluptatibus impedit consequatur obcaecati. Maiores, sunt accusamus quos nesciunt exercitationem tempora, dolorum molestiae vitae nobis natus hic libero in? Quos amet in cumque inventore magni quaerat vero atque, asperiores consequatur? Ut provident voluptas quis placeat qui aliquam nemo necessitatibus! Quod, officiis! Repellat fugit neque, eum rerum odio fuga itaque possimus nemo ab placeat necessitatibus? Dolor, tempore.', '2023-02-07'),
(27, '/blog-yoga/image/femme-yogi-4.jpg', 'Conscience', 'La pleine conscience', 'S&#039;entra&icirc;ner &agrave; la pleine conscience dans les moindres t&acirc;ches de notre quotidien. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis modi natus iste, facere, laudantium voluptas quam cum, doloribus illo. Quia sequi a et natus veritatis repudiandae ducimus molestiae soluta perferendis placeat, esse debitis quidem nostrum error distinctio totam facere deleniti nulla, expedita vel accusamus reprehenderit delectus molestias. Fugiat, facere adipisci aliquam eveniet doloremque perferendis porro, ratione alias eum a error repellat amet asperiores aliquid nihil commodi provident repudiandae, facilis illo optio dolore tempora. Rerum, fugit. Quasi assumenda dolores repudiandae repellat earum quisquam commodi neque est incidunt inventore! Aut aliquid sed natus blanditiis tempore voluptatibus impedit consequatur obcaecati. Maiores, sunt accusamus quos nesciunt exercitationem tempora, dolorum molestiae vitae nobis natus hic libero in? Quos amet in cumque inventore magni quaerat vero atque, asperiores consequatur? Ut provident voluptas quis placeat qui aliquam nemo necessitatibus! Quod, officiis! Repellat fugit neque, eum rerum odio fuga itaque possimus nemo ab placeat necessitatibus? Dolor, tempore.', '2023-02-03'),
(29, '/blog-yoga/image/equilibre-sur-la-tete.jpg', 'Postures', 'L&#039;&eacute;quilibre sur la t&ecirc;te', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis modi natus iste, facere, laudantium voluptas quam cum, doloribus illo. Quia sequi a et natus veritatis repudiandae ducimus molestiae soluta perferendis placeat, esse debitis quidem nostrum error distinctio totam facere deleniti nulla, expedita vel accusamus reprehenderit delectus molestias. Fugiat, facere adipisci aliquam eveniet doloremque perferendis porro, ratione alias eum a error repellat amet asperiores aliquid nihil commodi provident repudiandae, facilis illo optio dolore tempora. Rerum, fugit. Quasi assumenda dolores repudiandae repellat earum quisquam commodi neque est incidunt inventore! Aut aliquid sed natus blanditiis tempore voluptatibus impedit consequatur obcaecati. Maiores, sunt accusamus quos nesciunt exercitationem tempora, dolorum molestiae vitae nobis natus hic libero in? Quos amet in cumque inventore magni quaerat vero atque, asperiores consequatur? Ut provident voluptas quis placeat qui aliquam nemo necessitatibus! Quod, officiis! Repellat fugit neque, eum rerum odio fuga itaque possimus nemo ab placeat necessitatibus? Dolor, tempore.', '2023-02-03'),
(30, '/blog-yoga/image/femme-yogi-1.jpg', 'Postures', 'La salutation au soleil', 'La salutation au soleil est un encha&icirc;nement de postures &agrave; effectuer en coordination avec la respiration. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis modi natus iste, facere, laudantium voluptas quam cum, doloribus illo. Quia sequi a et natus veritatis repudiandae ducimus molestiae soluta perferendis placeat, esse debitis quidem nostrum error distinctio totam facere deleniti nulla, expedita', '2023-02-18'),
(32, '/blog-yoga/image/nutrition.jpg', 'Nutrition', 'Une bonne nutrition pour une belle &eacute;nergie', 'Apporter &agrave; nos cellules les bons ingr&eacute;dients est primordial pour maintenir une belle &eacute;nergie. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis modi natus iste, facere, laudantium voluptas quam cum, doloribus illo. Quia sequi a et natus veritatis repudiandae ducimu', '2023-02-05'),
(35, '/blog-yoga/image/femme-yogi-2.jpg', 'Postures', 'Les positions d&#039;&eacute;quilibre', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, vel. Asperiores voluptatem repudiandae recusandae labore quo eveniet vero quos, ut adipisci. Odit possimus dolor, dicta obcaecati rem est consectetur dolores reprehenderit eius, iste dolorem labore? Voluptatibus sint consectetur nesciunt esse officia. Nemo dicta doloribus odio? Architecto est eos dolore quam, labore laboriosam nam aspernatur? Nobis autem eveniet nam fugit reiciendis mo', '2023-02-04');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `firstname`, `lastname`, `email`, `password`, `status`) VALUES
(27, 'Florence', 'Leclercq', 'flo@gmail.com', '$2y$10$ZL7Zhni3Lnty2s6/avRgk.L/c7pVRxnVNpHqq7KtRpifnsKvU7ndu', 1),
(28, 'Jean', 'Bon', 'jean@gmail.com', '$2y$10$0NKPYR0K5MBTuTpngHUj5OODo622FIUJHIQYYgcDjBou4FleSUDzq', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
