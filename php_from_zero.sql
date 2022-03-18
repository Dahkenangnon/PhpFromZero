-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2022 at 09:34 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_from_zero`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `authorid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `title`, `content`, `authorid`) VALUES
(1, 'Qu\'est-ce que le Lorem Ipsum?', 'Le Lorem Ipsum est simplement du faux texte employÃ© dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les annÃ©es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour rÃ©aliser un livre spÃ©cimen de polices de texte. Il n\'a pas fait que survivre cinq siÃ¨cles, mais s\'est aussi adaptÃ© Ã  la bureautique informatique, sans que son contenu n\'en soit modifiÃ©. Il a Ã©tÃ© popularisÃ© dans les annÃ©es 1960 grÃ¢ce Ã  la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus rÃ©cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 2),
(2, 'D\'oÃ¹ vient-il?', 'Contrairement Ã  une opinion rÃ©pandue, le Lorem Ipsum n\'est pas simplement du texte alÃ©atoire. Il trouve ses racines dans une oeuvre de la littÃ©rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s\'est intÃ©ressÃ© Ã  un des mots latins les plus obscurs, consectetur, extrait d\'un passage du Lorem Ipsum, et en Ã©tudiant tous les usages de ce mot dans la littÃ©rature classique, dÃ©couvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" (Des SuprÃªmes Biens et des SuprÃªmes Maux) de CicÃ©ron. Cet ouvrage, trÃ¨s populaire pendant la Renaissance, est un traitÃ© sur la thÃ©orie de l\'Ã©thique. Les premiÃ¨res lignes du Lorem Ipsum, \"Lorem ipsum dolor sit amet...\", proviennent de la section 1.10.32.\r\n\r\nL\'extrait standard de Lorem Ipsum utilisÃ© depuis le XVIÃ¨ siÃ¨cle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" de CicÃ©ron sont aussi reproduites dans leur version originale, accompagnÃ©e de la traduction anglaise de H. Rackham (1914).', 2),
(3, 'Pourquoi l\'utiliser?', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empÃªche de se concentrer sur la mise en page elle-mÃªme. L\'avantage du Lorem Ipsum sur un texte gÃ©nÃ©rique comme \'Du texte. Du texte. Du texte.\' est qu\'il possÃ¨de une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du franÃ§ais standard. De nombreuses suites logicielles de mise en page ou Ã©diteurs de sites Web ont fait du Lorem Ipsum leur faux texte par dÃ©faut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'Ã  leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).\r\n\r\n', 2),
(4, 'OÃ¹ puis-je m\'en procurer?', 'Plusieurs variations de Lorem Ipsum peuvent Ãªtre trouvÃ©es ici ou lÃ , mais la majeure partie d\'entre elles a Ã©tÃ© altÃ©rÃ©e par l\'addition d\'humour ou de mots alÃ©atoires qui ne ressemblent pas une seconde Ã  du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez Ãªtre sÃ»r qu\'il n\'y a rien d\'embarrassant cachÃ© dans le texte. Tous les gÃ©nÃ©rateurs de Lorem Ipsum sur Internet tendent Ã  reproduire le mÃªme extrait sans fin, ce qui fait de lipsum.com le seul vrai gÃ©nÃ©rateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour gÃ©nÃ©rer un Lorem Ipsum irrÃ©prochable. Le Lorem Ipsum ainsi obtenu ne contient aucune rÃ©pÃ©tition, ni ne contient des mots farfelus, ou des touches d\'humour.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `photo`, `age`, `role`) VALUES
(1, 'Me', 'me@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$dGdiOUJHZk1oQk9BYS5ERg$8qjsJnXXA/kAV6E82DgSqEyLr1nFxgh8x/pVLNH1E4M', '1647594589.jpg', 24, 'ROLE_COPAIN'),
(2, 'You', 'you@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZFNqZ1pNRmNlTUtZc3o3VA$suxyPrLVT5icZ+yn8jbMz5XzH9f7iAUZD8vnIi4NBBI', '1647594616.jpg', 21, 'ROLE_COPAIN');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
