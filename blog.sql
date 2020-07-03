-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Juillet 2020 à 17:09
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  `titre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`, `titre`) VALUES
(1, 'On prend souvent autonomie et liberté pour des synonymes, car dans les deux cas il s’agit de n’être pas assujetti ni dépendant d’autrui. Pour autant, une différence majeure de sens existe entre ces deux concepts, et l’étymologie sera ici notre meilleur guide. En effet, autonomie vient de auto nomos, c’est-à-dire le fait de se donner sa propre loi. Il y a dans l’autonomie des règles que l’on s’applique, et cela signifie que nous nous auto-limitons. Or, ce qui caractère la liberté est précisément l’absence de limite, voire l’absence de référence extérieure à soi. Donc si la liberté est ce qui n’a ni règle ni limite, l’autonomie quant à elle relève de l’auto-discipline.', 1, 1, '2020-07-02 10:49:18', 'Autonomie et liberté'),
(2, 'La banalité du mal est un concept théorisé par Hannah Arendt.Avancé lors du procès d''Eichmann, ce concept a fait scandale. Car le mal, à travers Eichmann, était considéré comme une monstruosité, c’est-à-dire comme quelque chose d’inhumain et d’extraordinaire à la fois. Or Arendt avance que c’est au contraire dans la médiocrité, l’absence de pensée et de courage, dans ce qui peut trouver sa source en chacun de nous, que peut se nicher le mal le plus extrême.', 1, 1, '2020-07-02 10:59:28', 'La banalité du mal'),
(3, 'L’obligation et le devoir ont en commun d’être quelque chose qui nous contraint, qui nous pousse à obéir. C’est au niveau de leur source que la différence se joue. Car la source de l’obligation nous est extérieure : il s’agit d’obéir à une règle, une loi, un ordre, quand la source du devoir est intérieure : il y a un assentiment aux règles et aux contraintes que nous nous donnons. ', 1, 1, '2020-07-02 11:12:37', 'Obligation et devoir'),
(4, 'Le phénomène est un concept kantien qui nous permet de penser notre rapport à la réalité : avons-nous directement accès à elle ou bien sommes-nous toujours séparés d’elle ? Si l’interrogation philosophique a depuis l’antiquité accusé nos sensations corporelles d’être un obstacle à la saisie du réel, Kant avance que ce décalage est consubstantiel à notre esprit. Car pour percevoir, notre esprit voit la réalité à travers des catégories : celles-ci sont déterminées par la nature de l’esprit et imposent leur “moule” à ce que nous percevons. Le phénomène est donc ce qui est perçu et modifié par notre perception, quand le noumène est la réalité indépendante de notre regard.', 1, 1, '2020-07-02 11:14:47', 'Phénomène'),
(5, 'Cette opposition est très platonicienne. La rhétorique consiste en la forme du discours, elle est un art maîtrisé par les sophistes qui s’en servent pour s’enrichir et pour flatter les sentiments de leurs auditoires. Il s’agit de faire impression par la parole. La dialectique, quant à elle, relève du fond du discours : ce qui compte c’est le sens et son adéquation avec la vérité.', 1, 1, '2020-07-02 11:18:43', 'Rhétorique et dialectique'),
(6, 'Le contresens le plus commun que nous faisons sur l’épicurisme repose sur la transposition que nous faisons du sens du mot “plaisir” de notre époque à sa philosophie. Pour nous le plaisir est une sensation agréable, et c’est ce qui l’oppose à la douleur qui, elle, est une sensation désagréable. Or pour Épicure le plaisir est simplement tout ce que n’est pas douleur. Le plaisir épicurien a donc une extension plus grande que “notre” plaisir, car même la quiétude, la tiédeur sont considérées comme appartenant au plaisir.', 1, 2, '2020-07-02 11:33:48', 'Épicurisme et plaisir'),
(7, 'Pour Platon, la recherche de la vérité suppose d’aller au-delà des apparences, c’est-à-dire d’aller au-delà de ce que nous percevons par nos sens. La vérité est uniquement intelligible et cela signifie qu’elle est uniquement accessible par notre raison. Avec cet idéalisme qui rejette l’expérience, il s’oppose à l’empirisme qui considère que la connaissance s’obtient par observation du réel.', 1, 2, '2020-07-02 11:35:19', 'Platon et la critique des apparences'),
(8, 'Alors que la doxa du temps de Rousseau encensait le progrès des Lumières, Rousseau s’inscrivit à contre-courant en affirmant que la société, loin d’être un facteur de progrès, est plutôt un facteur de décadence. Car la société nous éloigne de la nature, et de notre nature supposée. Notre nature serait celle qui se cantonne à nos besoins, et à une empathie vis-à-vis des autres qui serait occasionnelle mais nécessaire. Or la société nous conduit au luxe, à la compétition, au futile, ce qui pour Rousseau n’est ni un progrès, ni une chose heureuse.', 1, 2, '2020-07-02 11:36:15', 'Rousseau et la société'),
(9, 'Plutôt changer son regard sur les choses que l’ordre des choses. C’est en substance ce que propose le stoïcisme. Cette idée se fonde sur une conception de la nature comme étant pure nécessité. De ce fait, nous n’avons de liberté que sur nos représentations. Et c’est pour cela que pour être heureux il ne faut pas vouloir changer l’inchangeable, mais agir sur ce qui dépend de nous.', 1, 2, '2020-07-02 11:37:14', 'Les stoïciens et ce qui dépend de nous'),
(10, 'Dans La condition ouvrière, Simone Veil fait l’expérience du travail à l’usine. Pendant toute cette expérimentation, elle tient un journal dans lequel elle relate son état physique ainsi que ses capacités mentales. Pourtant agrégée et hautement cultivée, elle constate que le caractère répétitif et fatiguant du travail ouvrier appauvrit ses capacités réflexives. L’esprit, loin d’exister en-dehors du corps, dépend de la disponibilité de son temps et de son énergie. Ainsi, l’intelligence et la pensée sont tributaires du travail et de nos conditions matérielles d’existence.', 1, 2, '2020-07-02 11:38:26', 'Simone Veil et le travail ouvrier'),
(11, 'Les biais cognitifs nous à produire des erreurs de raisonnement. Ignorer leur existence, c’est prendre le risque de se tromper, voire de développer ou de propager des préjugés. Un exemple classique de biais cognitif est la confusion entre corrélation et causalité. Lorsque nous voyons deux événements se produire de manière proche ou simultanée, nous inférons qu’il y a un lien de causalité entre eux. Ainsi, la superstition est souvent le produit d’une telle confusion.', 1, 3, '2020-07-02 11:39:41', 'Les biais cognitifs'),
(12, 'Un raisonnement fallacieux est un raisonnement dont la forme apparaît logique, mais qui pourtant vise à tromper, à induire en erreur ou à avoir le dessus dans une discussion. On peut donner comme exemple le sophisme de l’homme de paille, qui consiste à caricaturer une thèse adverse pour facilement la faire tomber. Ou bien l’argument d’autorité, qui fait appel à une référence respectée plutôt que de produire une argumentation.', 1, 3, '2020-07-02 11:40:42', 'Les raisonnements fallacieux');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Concepts'),
(2, 'Auteurs'),
(3, 'Autodéfense intellectuelle');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'Autre exemple de raisonnement fallacieux : l''argument circulaire. C''est lorsque l''on suppose ce que l''on veut montrer...', 12, 2, '2020-07-03 14:53:55');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1338 ;

--
-- Contenu de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'admin', '$2y$10$XTI4xywxY3ZCtHI1Z2CH1eqsQ6W9v6o7jEmnDbBnKPu5vr8kAZRdy', 'admin@admin', 1337),
(2, 'Cecile', '$2y$10$TOG.HNetkM5oEFOpiXjKculqPmE3SBBbZNwQlEWQqsNFpp5gPI5Aq', 'cecile@cecile', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
