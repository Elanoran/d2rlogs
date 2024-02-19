-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Vært: localhost:3306
-- Genereringstid: 19. 02 2024 kl. 18:30:42
-- Serverversion: 8.0.36-0ubuntu0.22.04.1
-- PHP-version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d2r`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `areas`
--

CREATE TABLE `areas` (
  `area_number` int NOT NULL,
  `area_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `areas`
--

INSERT INTO `areas` (`area_number`, `area_name`) VALUES
(0, 'None'),
(1, 'Rogue Encampment'),
(2, 'Blood Moor'),
(3, 'Cold Plains'),
(4, 'Stony Field'),
(5, 'Dark Wood'),
(6, 'Black Marsh'),
(7, 'Tamoe Highland'),
(8, 'Den Of Evil'),
(9, 'Cave Level 1'),
(10, 'Underground Passage Level 1'),
(11, 'Hole Level 1'),
(12, 'Pit Level 1'),
(13, 'Cave Level 2'),
(14, 'Underground Passage Level 2'),
(15, 'Hole Level 2'),
(16, 'Pit Level 2'),
(17, 'Burial Grounds'),
(18, 'Crypt'),
(19, 'Mausoleum'),
(20, 'Forgotten Tower'),
(21, 'Tower Cellar Level 1'),
(22, 'Tower Cellar Level 2'),
(23, 'Tower Cellar Level 3'),
(24, 'Tower Cellar Level 4'),
(25, 'Tower Cellar Level 5'),
(26, 'Monastery Gate'),
(27, 'Outer Cloister'),
(28, 'Barracks'),
(29, 'Jail Level 1'),
(30, 'Jail Level 2'),
(31, 'Jail Level 3'),
(32, 'Inner Cloister'),
(33, 'Cathedral'),
(34, 'Catacombs Level 1'),
(35, 'Catacombs Level 2'),
(36, 'Catacombs Level 3'),
(37, 'Catacombs Level 4'),
(38, 'Tristram'),
(39, 'Moo Moo Farm'),
(40, 'Lut Gholein'),
(41, 'Rocky Waste'),
(42, 'Dry Hills'),
(43, 'Far Oasis'),
(44, 'Lost City'),
(45, 'Valley Of Snakes'),
(46, 'Canyon Of The Magi'),
(47, 'A2 Sewers Level 1'),
(48, 'A2 Sewers Level 2'),
(49, 'A2 Sewers Level 3'),
(50, 'Harem Level 1'),
(51, 'Harem Level 2'),
(52, 'Palace Cellar Level 1'),
(53, 'Palace Cellar Level 2'),
(54, 'Palace Cellar Level 3'),
(55, 'Stony Tomb Level 1'),
(56, 'Halls Of The Dead Level 1'),
(57, 'Halls Of The Dead Level 2'),
(58, 'Claw Viper Temple Level 1'),
(59, 'Stony Tomb Level 2'),
(60, 'Halls Of The Dead Level 3'),
(61, 'Claw Viper Temple Level 2'),
(62, 'Maggot Lair Level 1'),
(63, 'Maggot Lair Level 2'),
(64, 'Maggot Lair Level 3'),
(65, 'Ancient Tunnels'),
(66, 'Tal Rashas Tomb #1'),
(67, 'Tal Rashas Tomb #2'),
(68, 'Tal Rashas Tomb #3'),
(69, 'Tal Rashas Tomb #4'),
(70, 'Tal Rashas Tomb #5'),
(71, 'Tal Rashas Tomb #6'),
(72, 'Tal Rashas Tomb #7'),
(73, 'Duriels Lair'),
(74, 'Arcane Sanctuary'),
(75, 'Kurast Docktown'),
(76, 'Spider Forest'),
(77, 'Great Marsh'),
(78, 'Flayer Jungle'),
(79, 'Lower Kurast'),
(80, 'Kurast Bazaar'),
(81, 'Upper Kurast'),
(82, 'Kurast Causeway'),
(83, 'Travincal'),
(84, 'Spider Cave'),
(85, 'Spider Cavern'),
(86, 'Swampy Pit Level 1'),
(87, 'Swampy Pit Level 2'),
(88, 'Flayer Dungeon Level 1'),
(89, 'Flayer Dungeon Level 2'),
(90, 'Swampy Pit Level 3'),
(91, 'Flayer Dungeon Level 3'),
(92, 'A3 Sewers Level 1'),
(93, 'A3 Sewers Level 2'),
(94, 'Ruined Temple'),
(95, 'Disused Fane'),
(96, 'Forgotten Reliquary'),
(97, 'Forgotten Temple'),
(98, 'Ruined Fane'),
(99, 'Disused Reliquary'),
(100, 'Durance Of Hate Level 1'),
(101, 'Durance Of Hate Level 2'),
(102, 'Durance Of Hate Level 3'),
(103, 'The Pandemonium Fortress'),
(104, 'Outer Steppes'),
(105, 'Plains Of Despair'),
(106, 'City Of The Damned'),
(107, 'River Of Flame'),
(108, 'Chaos Sanctuary'),
(109, 'Harrogath'),
(110, 'Bloody Foothills'),
(111, 'Frigid Highlands'),
(112, 'Arreat Plateau'),
(113, 'Crystalized Passage'),
(114, 'Frozen River'),
(115, 'Glacial Trail'),
(116, 'Drifter Cavern'),
(117, 'Frozen Tundra'),
(118, 'Ancient\'s Way'),
(119, 'Icy Cellar'),
(120, 'Arreat Summit'),
(121, 'Nihlathaks Temple'),
(122, 'Halls Of Anguish'),
(123, 'Halls Of Pain'),
(124, 'Halls Of Vaught'),
(125, 'Abaddon'),
(126, 'Pit Of Acheron'),
(127, 'Infernal Pit'),
(128, 'The Worldstone Keep Level 1'),
(129, 'The Worldstone Keep Level 2'),
(130, 'The Worldstone Keep Level 3'),
(131, 'Throne Of Destruction'),
(132, 'The Worldstone Chamber'),
(133, 'Matron\'s Den'),
(134, 'Fogotten Sands'),
(135, 'Furnace of Pain'),
(136, 'Tristram');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `bots`
--

CREATE TABLE `bots` (
  `id` int NOT NULL,
  `bot_name` varchar(255) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `game_number` int NOT NULL,
  `start_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `running_char` varchar(255) NOT NULL,
  `run_list` varchar(255) NOT NULL,
  `in_area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `characters`
--

CREATE TABLE `characters` (
  `id` int NOT NULL,
  `character_name` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `level` int NOT NULL,
  `spec` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `configuration`
--

CREATE TABLE `configuration` (
  `id` int NOT NULL,
  `logsPerPage` int DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `configuration`
--

INSERT INTO `configuration` (`id`, `logsPerPage`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ItemConditions`
--

CREATE TABLE `ItemConditions` (
  `id` int NOT NULL,
  `item_type_id` int NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_comment` varchar(255) DEFAULT NULL,
  `condition_type` enum('unique','set') NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `ItemConditions`
--

INSERT INTO `ItemConditions` (`id`, `item_type_id`, `item_name`, `item_comment`, `condition_type`, `item_id`) VALUES
(29, 1, 'Nagelring', 'comment', 'unique', 120),
(32, 1, 'stone of jordan', 'comment', 'unique', 122),
(35, 1, 'dwarf star', 'comment', 'unique', 274),
(36, 1, 'raven frost', 'comment', 'unique', 275),
(37, 1, 'bul-kathos\' wedding band', 'comment', 'unique', 268),
(38, 1, 'angelic halo', 'comment', 'set', 52),
(39, 1, 'cathan\'s seal', 'comment', 'set', 29),
(47, 6, 'Trang-Oul\'s Claws', 'comment', 'set', 88);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ItemQualities`
--

CREATE TABLE `ItemQualities` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `ItemQualities`
--

INSERT INTO `ItemQualities` (`id`, `name`) VALUES
(1, 'lowquality'),
(2, 'normal'),
(3, 'superior'),
(4, 'magic'),
(5, 'set'),
(6, 'rare'),
(7, 'unique'),
(8, 'crafted');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_quality` varchar(55) DEFAULT NULL,
  `ethereal` int DEFAULT NULL,
  `bot_char_name` varchar(255) DEFAULT NULL,
  `stats` json DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `item_lookup` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ItemTypes`
--

CREATE TABLE `ItemTypes` (
  `id` int NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `ItemTypes`
--

INSERT INTO `ItemTypes` (`id`, `type_name`) VALUES
(1, 'ring'),
(2, 'amulet'),
(3, 'lightgauntlets'),
(6, 'heavybracers');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `item_properties`
--

CREATE TABLE `item_properties` (
  `id` int NOT NULL,
  `item_id` int DEFAULT NULL,
  `prop_name` varchar(255) DEFAULT NULL,
  `prop_min` int DEFAULT NULL,
  `prop_max` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `item_type_names`
--

CREATE TABLE `item_type_names` (
  `item_id` int NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `lowercase_name` varchar(255) DEFAULT NULL,
  `divided_name` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `item_type_names`
--

INSERT INTO `item_type_names` (`item_id`, `item_name`, `lowercase_name`, `divided_name`, `image_name`) VALUES
(1, 'RingMail', 'ringmail', 'Ring Mail', 'ringmail.png'),
(2, 'Sabre', 'sabre', 'Sabre', 'sabre.png'),
(3, 'Ring', 'ring', 'Ring', 'ring.png'),
(4, 'Amulet', 'amulet', 'Amulet', 'amulet.png'),
(5, 'SkullCap', 'skullcap', 'Skull Cap', 'skullcap.png'),
(6, 'LightPlate', 'lightplate', 'Light Plate', 'lightplate.png'),
(7, 'WarStaff', 'warstaff', 'War Staff', 'warstaff.png'),
(8, 'QuiltedArmor', 'quiltedarmor', 'Quilted Armor', 'quiltedarmor.png'),
(9, 'LightBelt', 'lightbelt', 'Light Belt', 'lightbelt.png'),
(10, 'LightGauntlets', 'lightgauntlets', 'Light Gauntlets', 'lightgauntlets.png'),
(11, 'ShortWarBow', 'shortwarbow', 'Short War Bow', 'shortwarbow.png'),
(12, 'Helm', 'helm', 'Helm', 'helm.png'),
(13, 'SplintMail', 'splintmail', 'Splint Mail', 'splintmail.png'),
(14, 'DoubleAxe', 'doubleaxe', 'Double Axe', 'doubleaxe.png'),
(15, 'Ring', 'ring', 'Ring', 'ring.png'),
(16, 'ChainMail', 'chainmail', 'Chain Mail', 'chainmail.png'),
(17, 'Mask', 'mask', 'Mask', 'mask.png'),
(18, 'GrandScepter', 'grandscepter', 'Grand Scepter', 'grandscepter.png'),
(19, 'LargeShield', 'largeshield', 'Large Shield', 'largeshield.png'),
(20, 'LongSword', 'longsword', 'Long Sword', 'longsword.png'),
(21, 'ChainGloves', 'chaingloves', 'Chain Gloves', 'chaingloves.png'),
(22, 'SmallShield', 'smallshield', 'Small Shield', 'smallshield.png'),
(23, 'WarSword', 'warsword', 'War Sword', 'warsword.png'),
(24, 'LeatherGloves', 'leathergloves', 'Leather Gloves', 'leathergloves.png'),
(25, 'Sash', 'sash', 'Sash', 'sash.png'),
(26, 'Buckler', 'buckler', 'Buckler', 'buckler.png'),
(27, 'Belt', 'belt', 'Belt', 'belt.png'),
(28, 'ChainBoots', 'chainboots', 'Chain Boots', 'chainboots.png'),
(29, 'Cap', 'cap', 'Cap', 'cap.png'),
(30, 'GrimWand', 'grimwand', 'Grim Wand', 'grimwand.png'),
(31, 'HeavyBelt', 'heavybelt', 'Heavy Belt', 'heavybelt.png'),
(32, 'Crown', 'crown', 'Crown', 'crown.png'),
(33, 'BroadSword', 'broadsword', 'Broad Sword', 'broadsword.png'),
(34, 'FullHelm', 'fullhelm', 'Full Helm', 'fullhelm.png'),
(35, 'BreastPlate', 'breastplate', 'Breast Plate', 'breastplate.png'),
(36, 'GothicShield', 'gothicshield', 'Gothic Shield', 'gothicshield.png'),
(37, 'KiteShield', 'kiteshield', 'Kite Shield', 'kiteshield.png'),
(38, 'AncientArmor', 'ancientarmor', 'Ancient Armor', 'ancientarmor.png'),
(39, 'WarScepter', 'warscepter', 'War Scepter', 'warscepter.png'),
(40, 'GreatHelm', 'greathelm', 'Great Helm', 'greathelm.png'),
(41, 'GothicPlate', 'gothicplate', 'Gothic Plate', 'gothicplate.png'),
(42, 'Greaves', 'greaves', 'Greaves', 'greaves.png'),
(43, 'TowerShield', 'towershield', 'Tower Shield', 'towershield.png'),
(44, 'PlatedBelt', 'platedbelt', 'Plated Belt', 'platedbelt.png'),
(45, 'Gauntlets', 'gauntlets', 'Gauntlets', 'gauntlets.png'),
(46, 'BoneHelm', 'bonehelm', 'Bone Helm', 'bonehelm.png'),
(47, 'FullPlateMail', 'fullplatemail', 'Full Plate Mail', 'fullplatemail.png'),
(48, 'Boots', 'boots', 'Boots', 'boots.png'),
(49, 'MilitaryPick', 'militarypick', 'Military Pick', 'militarypick.png'),
(50, 'LongBattleBow', 'longbattlebow', 'Long Battle Bow', 'longbattlebow.png'),
(51, 'LeatherArmor', 'leatherarmor', 'Leather Armor', 'leatherarmor.png'),
(52, 'LightPlatedBoots', 'lightplatedboots', 'Light Plated Boots', 'lightplatedboots.png'),
(53, 'HuntersGuise', 'huntersguise', 'Hunters Guise', 'huntersguise.png'),
(54, 'BattleBoots', 'battleboots', 'Battle Boots', 'battleboots.png'),
(55, 'ShadowPlate', 'shadowplate', 'Shadow Plate', 'shadowplate.png'),
(56, 'JaggedStar', 'jaggedstar', 'Jagged Star', 'jaggedstar.png'),
(57, 'ColossusBlade', 'colossusblade', 'Colossus Blade', 'colossusblade.png'),
(58, 'MythicalSword', 'mythicalsword', 'Mythical Sword', 'mythicalsword.png'),
(59, 'WarHat', 'warhat', 'War Hat', 'warhat.png'),
(60, 'StuddedLeather', 'studdedleather', 'Studded Leather', 'studdedleather.png'),
(61, 'HeavyBoots', 'heavyboots', 'Heavy Boots', 'heavyboots.png'),
(62, 'BrambleMitts', 'bramblemitts', 'Bramble Mitts', 'bramblemitts.png'),
(63, 'DuskShroud', 'duskshroud', 'Dusk Shroud', 'duskshroud.png'),
(64, 'DemonhideBoots', 'demonhideboots', 'Demonhide Boots', 'demonhideboots.png'),
(65, 'MithrilCoil', 'mithrilcoil', 'Mithril Coil', 'mithrilcoil.png'),
(66, 'OrnatePlate', 'ornateplate', 'Ornate Plate', 'ornateplate.png'),
(67, 'Corona', 'corona', 'Corona', 'corona.png'),
(68, 'Caduceus', 'caduceus', 'Caduceus', 'caduceus.png'),
(69, 'VortexShield', 'vortexshield', 'Vortex Shield', 'vortexshield.png'),
(70, 'Cuirass', 'cuirass', 'Cuirass', 'cuirass.png'),
(71, 'ReinforcedMace', 'reinforcedmace', 'Reinforced Mace', 'reinforcedmace.png'),
(72, 'Ward', 'ward', 'Ward', 'ward.png'),
(73, 'SpiredHelm', 'spiredhelm', 'Spired Helm', 'spiredhelm.png'),
(74, 'GrandCrown', 'grandcrown', 'Grand Crown', 'grandcrown.png'),
(75, 'Bill', 'bill', 'Bill', 'bill.png'),
(76, 'TigulatedMail', 'tigulatedmail', 'Tigulated Mail', 'tigulatedmail.png'),
(77, 'WarBelt', 'warbelt', 'War Belt', 'warbelt.png'),
(78, 'AvengerGuard', 'avengerguard', 'Avenger Guard', 'avengerguard.png'),
(79, 'OgreMaul', 'ogremaul', 'Ogre Maul', 'ogremaul.png'),
(80, 'SacredArmor', 'sacredarmor', 'Sacred Armor', 'sacredarmor.png'),
(81, 'WarGauntlets', 'wargauntlets', 'War Gauntlets', 'wargauntlets.png'),
(82, 'WarBoots', 'warboots', 'War Boots', 'warboots.png'),
(83, 'Diadem', 'diadem', 'Diadem', 'diadem.png'),
(84, 'GrandMatronBow', 'grandmatronbow', 'Grand Matron Bow', 'grandmatronbow.png'),
(85, 'KrakenShell', 'krakenshell', 'Kraken Shell', 'krakenshell.png'),
(86, 'BattleGauntlets', 'battlegauntlets', 'Battle Gauntlets', 'battlegauntlets.png'),
(87, 'SharkskinBelt', 'sharkskinbelt', 'Sharkskin Belt', 'sharkskinbelt.png'),
(88, 'GrimHelm', 'grimhelm', 'Grim Helm', 'grimhelm.png'),
(89, 'ScissorsSuwayyah', 'scissorssuwayyah', 'Scissors Suwayyah', 'scissorssuwayyah.png'),
(90, 'LoricatedMail', 'loricatedmail', 'Loricated Mail', 'loricatedmail.png'),
(91, 'MeshBoots', 'meshboots', 'Mesh Boots', 'meshboots.png'),
(92, 'Circlet', 'circlet', 'Circlet', 'circlet.png'),
(93, 'HellforgePlate', 'hellforgeplate', 'Hellforge Plate', 'hellforgeplate.png'),
(94, 'ElderStaff', 'elderstaff', 'Elder Staff', 'elderstaff.png'),
(95, 'WingedHelm', 'wingedhelm', 'Winged Helm', 'wingedhelm.png'),
(96, 'RoundShield', 'roundshield', 'Round Shield', 'roundshield.png'),
(97, 'SharkskinGloves', 'sharkskingloves', 'Sharkskin Gloves', 'sharkskingloves.png'),
(98, 'BattleBelt', 'battlebelt', 'Battle Belt', 'battlebelt.png'),
(99, 'BoneWand', 'bonewand', 'Bone Wand', 'bonewand.png'),
(100, 'HeavyGloves', 'heavygloves', 'Heavy Gloves', 'heavygloves.png'),
(101, 'Basinet', 'basinet', 'Basinet', 'basinet.png'),
(102, 'CrypticSword', 'crypticsword', 'Cryptic Sword', 'crypticsword.png'),
(103, 'BalrogSkin', 'balrogskin', 'Balrog Skin', 'balrogskin.png'),
(104, 'SwirlingCrystal', 'swirlingcrystal', 'Swirling Crystal', 'swirlingcrystal.png'),
(105, 'DeathMask', 'deathmask', 'Death Mask', 'deathmask.png'),
(106, 'LacqueredPlate', 'lacqueredplate', 'Lacquered Plate', 'lacqueredplate.png'),
(107, 'MeshBelt', 'meshbelt', 'Mesh Belt', 'meshbelt.png'),
(108, 'BoneVisage', 'bonevisage', 'Bone Visage', 'bonevisage.png'),
(109, 'ChaosArmor', 'chaosarmor', 'Chaos Armor', 'chaosarmor.png'),
(110, 'CantorTrophy', 'cantortrophy', 'Cantor Trophy', 'cantortrophy.png'),
(111, 'TrollBelt', 'trollbelt', 'Troll Belt', 'trollbelt.png'),
(112, 'HeavyBracers', 'heavybracers', 'Heavy Bracers', 'heavybracers.png'),
(113, 'VampireboneGloves', 'vampirebonegloves', 'Vampirebone Gloves', 'vampirebonegloves.png'),
(114, 'Vambraces', 'vambraces', 'Vambraces', 'vambraces.png'),
(115, 'OgreGauntlets', 'ogregauntlets', 'Ogre Gauntlets', 'ogregauntlets.png'),
(116, 'DemonhideSash', 'demonhidesash', 'Demonhide Sash', 'demonhidesash.png'),
(117, 'SpiderwebSash', 'spiderwebsash', 'Spiderweb Sash', 'spiderwebsash.png'),
(118, 'Vampirefang', 'vampirefang', 'Vampirefang', 'vampirefang.png'),
(119, 'SharkskinBoots', 'sharkskinboots', 'Sharkskin Boots', 'sharkskinboots.png'),
(120, 'ScarabshellBoots', 'scarabshellboots', 'Scarabshell Boots', 'scarabshellboots.png'),
(121, 'BoneweaveBoots', 'boneweaveboots', 'Boneweave Boots', 'boneweaveboots.png'),
(122, 'MyrmidonGreaves', 'myrmidongreaves', 'Myrmidon Greaves', 'myrmidongreaves.png'),
(123, 'Sallet', 'sallet', 'Sallet', 'sallet.png'),
(124, 'Casque', 'casque', 'Casque', 'casque.png'),
(125, 'Shako', 'shako', 'Shako', 'shako.png'),
(126, 'Demonhead', 'demonhead', 'Demonhead', 'demonhead.png'),
(127, 'Tiara', 'tiara', 'Tiara', 'tiara.png'),
(128, 'SerpentskinArmor', 'serpentskinarmor', 'Serpentskin Armor', 'serpentskinarmor.png'),
(129, 'MeshArmor', 'mesharmor', 'Mesh Armor', 'mesharmor.png'),
(130, 'RussetArmor', 'russetarmor', 'Russet Armor', 'russetarmor.png'),
(131, 'TemplarCoat', 'templarcoat', 'Templar Coat', 'templarcoat.png'),
(132, 'SharktoothArmor', 'sharktootharmor', 'Sharktooth Armor', 'sharktootharmor.png'),
(133, 'WireFleece', 'wirefleece', 'Wire Fleece', 'wirefleece.png'),
(134, 'BarbedShield', 'barbedshield', 'Barbed Shield', 'barbedshield.png'),
(135, 'Pavise', 'pavise', 'Pavise', 'pavise.png'),
(136, 'GrimShield', 'grimshield', 'Grim Shield', 'grimshield.png'),
(137, 'Luna', 'luna', 'Luna', 'luna.png'),
(138, 'Monarch', 'monarch', 'Monarch', 'monarch.png'),
(139, 'TrollNest', 'trollnest', 'Troll Nest', 'trollnest.png'),
(140, 'FangedKnife', 'fangedknife', 'Fanged Knife', 'fangedknife.png'),
(141, 'LegendSpike', 'legendspike', 'Legend Spike', 'legendspike.png'),
(142, 'Tulwar', 'tulwar', 'Tulwar', 'tulwar.png'),
(143, 'PhaseBlade', 'phaseblade', 'Phase Blade', 'phaseblade.png'),
(144, 'ChampionSword', 'championsword', 'Champion Sword', 'championsword.png'),
(145, 'Tomahawk', 'tomahawk', 'Tomahawk', 'tomahawk.png'),
(146, 'EttinAxe', 'ettinaxe', 'Ettin Axe', 'ettinaxe.png'),
(147, 'BerserkerAxe', 'berserkeraxe', 'Berserker Axe', 'berserkeraxe.png'),
(148, 'ShortSiegeBow', 'shortsiegebow', 'Short Siege Bow', 'shortsiegebow.png'),
(149, 'GothicBow', 'gothicbow', 'Gothic Bow', 'gothicbow.png'),
(150, 'WardBow', 'wardbow', 'Ward Bow', 'wardbow.png'),
(151, 'HydraBow', 'hydrabow', 'Hydra Bow', 'hydrabow.png'),
(152, 'Arbalest', 'arbalest', 'Arbalest', 'arbalest.png'),
(153, 'Ballista', 'ballista', 'Ballista', 'ballista.png'),
(154, 'Maul', 'maul', 'Maul', 'maul.png'),
(155, 'MartelDeFer', 'marteldefer', 'Martel De Fer', 'marteldefer.png'),
(156, 'TyrantClub', 'tyrantclub', 'Tyrant Club', 'tyrantclub.png'),
(157, 'Scourge', 'scourge', 'Scourge', 'scourge.png'),
(158, 'LegendaryMallet', 'legendarymallet', 'Legendary Mallet', 'legendarymallet.png'),
(159, 'ThunderMaul', 'thundermaul', 'Thunder Maul', 'thundermaul.png'),
(160, 'Halberd', 'halberd', 'Halberd', 'halberd.png'),
(161, 'Poleaxe', 'poleaxe', 'Poleaxe', 'poleaxe.png'),
(162, 'Partizan', 'partizan', 'Partizan', 'partizan.png'),
(163, 'BecDeCorbin', 'becdecorbin', 'Bec de Corbin', 'becdecorbin.png'),
(164, 'OgreAxe', 'ogreaxe', 'Ogre Axe', 'ogreaxe.png'),
(165, 'Thresher', 'thresher', 'Thresher', 'thresher.png'),
(166, 'CrypticAxe', 'crypticaxe', 'Cryptic Axe', 'crypticaxe.png'),
(167, 'GiantThresher', 'giantthresher', 'Giant Thresher', 'giantthresher.png'),
(168, 'MightyScepter', 'mightyscepter', 'Mighty Scepter', 'mightyscepter.png'),
(169, 'Pike', 'pike', 'Pike', 'pike.png'),
(170, 'Lance', 'lance', 'Lance', 'lance.png'),
(171, 'Warfork', 'warfork', 'Warfork', 'warfork.png'),
(172, 'Warspear', 'warspear', 'Warspear', 'warspear.png'),
(173, 'Fuscina', 'fuscina', 'Fuscina', 'fuscina.png'),
(174, 'Yari', 'yari', 'Yari', 'yari.png'),
(175, 'WarPike', 'warpike', 'War Pike', 'warpike.png'),
(176, 'Quarterstaff', 'quarterstaff', 'Quarterstaff', 'quarterstaff.png'),
(177, 'FlyingAxe', 'flyingaxe', 'Flying Axe', 'flyingaxe.png'),
(178, 'WingedKnife', 'wingedknife', 'Winged Knife', 'wingedknife.png'),
(179, 'WingedAxe', 'wingedaxe', 'Winged Axe', 'wingedaxe.png'),
(180, 'BalrogSpear', 'balrogspear', 'Balrog Spear', 'balrogspear.png'),
(181, 'GhostGlaive', 'ghostglaive', 'Ghost Glaive', 'ghostglaive.png'),
(182, 'WingedHarpoon', 'wingedharpoon', 'Winged Harpoon', 'wingedharpoon.png'),
(183, 'LichWand', 'lichwand', 'Lich Wand', 'lichwand.png'),
(184, 'UnearthedWand', 'unearthedwand', 'Unearthed Wand', 'unearthedwand.png'),
(185, 'CeremonialBow', 'ceremonialbow', 'Ceremonial Bow', 'ceremonialbow.png'),
(186, 'CeremonialJavelin', 'ceremonialjavelin', 'Ceremonial Javelin', 'ceremonialjavelin.png'),
(187, 'MatriarchalBow', 'matriarchalbow', 'Matriarchal Bow', 'matriarchalbow.png'),
(188, 'GreaterTalons', 'greatertalons', 'Greater Talons', 'greatertalons.png'),
(189, 'FeralClaws', 'feralclaws', 'Feral Claws', 'feralclaws.png'),
(190, 'WristSword', 'wristsword', 'Wrist Sword', 'wristsword.png'),
(191, 'SlayerGuard', 'slayerguard', 'Slayer Guard', 'slayerguard.png'),
(192, 'ConquerorCrown', 'conquerorcrown', 'Conqueror Crown', 'conquerorcrown.png'),
(193, 'SkySpirit', 'skyspirit', 'Sky Spirit', 'skyspirit.png'),
(194, 'EarthSpirit', 'earthspirit', 'Earth Spirit', 'earthspirit.png'),
(195, 'HierophantTrophy', 'hierophanttrophy', 'Hierophant Trophy', 'hierophanttrophy.png'),
(196, 'SuccubusSkull', 'succubusskull', 'Succubus Skull', 'succubusskull.png'),
(197, 'BloodlordSkull', 'bloodlordskull', 'Bloodlord Skull', 'bloodlordskull.png'),
(198, 'GildedShield', 'gildedshield', 'Gilded Shield', 'gildedshield.png'),
(199, 'SacredRondache', 'sacredrondache', 'Sacred Rondache', 'sacredrondache.png'),
(200, 'ZakarumShield', 'zakarumshield', 'Zakarum Shield', 'zakarumshield.png'),
(201, 'EldritchOrb', 'eldritchorb', 'Eldritch Orb', 'eldritchorb.png'),
(202, 'DimensionalShard', 'dimensionalshard', 'Dimensional Shard', 'dimensionalshard.png'),
(203, 'Jewel', 'jewel', 'Jewel', 'jewel.png');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  `bot_name` varchar(30) DEFAULT NULL,
  `bot_char_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `StatConditions`
--

CREATE TABLE `StatConditions` (
  `id` int NOT NULL,
  `item_condition_id` int NOT NULL,
  `stat_name` varchar(50) NOT NULL,
  `comparison_operator` varchar(2) NOT NULL,
  `stat_value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `StatConditions`
--

INSERT INTO `StatConditions` (`id`, `item_condition_id`, `stat_name`, `comparison_operator`, `stat_value`) VALUES
(46, 32, 'maxmanapercent', '>=', 25),
(49, 35, 'maxhp', '>=', 40),
(50, 36, 'dexterity', '>=', 20),
(51, 36, 'tohit', '>=', 150),
(52, 37, 'lifeleech', '>=', 3),
(53, 37, 'itemallskills', '==', 1),
(83, 29, 'itemmagicbonus', '>=', 30),
(85, 39, 'lifeleech', '==', 6),
(86, 39, 'normaldamagereduction', '==', 2),
(88, 38, 'maxlife', '==', 20),
(90, 47, 'defense', '>=', 23);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `stat_mapping`
--

CREATE TABLE `stat_mapping` (
  `id` int NOT NULL,
  `stat_name` varchar(255) DEFAULT NULL,
  `real_stat_string` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `stat_mapping`
--

INSERT INTO `stat_mapping` (`id`, `stat_name`, `real_stat_string`) VALUES
(0, 'Strength', 'Strength'),
(1, 'Energy', 'Energy'),
(2, 'Dexterity', 'Dexterity'),
(3, 'Vitality', 'Vitality'),
(4, 'StatPoints', 'Stat Points'),
(5, 'SkillPoints', 'Skill Points'),
(6, 'Life', 'Life'),
(7, 'MaxLife', 'Max Life'),
(8, 'Mana', 'Mana'),
(9, 'MaxMana', 'Max Mana'),
(10, 'Stamina', 'Stamina'),
(11, 'MaxStamina', 'Max Stamina'),
(12, 'Level', 'Level'),
(13, 'Experience', 'Experience'),
(14, 'Gold', 'Gold'),
(15, 'StashGold', 'Stash Gold'),
(16, 'EnhancedDefense', 'Enhanced Defense'),
(17, 'EnhancedDamageMax', 'Enhanced Damage Max'),
(18, 'EnhancedDamage', 'Enhanced Damage'),
(19, 'AttackRating', 'Attack Rating'),
(20, 'ChanceToBlock', 'Chance To Block'),
(21, 'MinDamage', 'Min Damage'),
(22, 'MaxDamage', 'Max Damage'),
(23, 'TwoHandedMinDamage', 'Two-Handed Min Damage'),
(24, 'TwoHandedMaxDamage', 'Two-Handed Max Damage'),
(25, 'DamagePercent', 'Damage Percent'),
(26, 'ManaRecovery', 'Mana Recovery'),
(27, 'ManaRecoveryBonus', 'Mana Recovery Bonus'),
(28, 'StaminaRecoveryBonus', 'Stamina Recovery Bonus'),
(29, 'LastExp', 'Last Exp'),
(30, 'NextExp', 'Next Exp'),
(31, 'Defense', 'Defense'),
(32, 'DefenseVsMissiles', 'Defense Vs Missiles'),
(33, 'DefenseVsHth', 'Defense Vs Hth'),
(34, 'NormalDamageReduction', 'Normal Damage Reduction'),
(35, 'MagicDamageReduction', 'Magic Damage Reduction'),
(36, 'DamageReduced', 'Damage Reduced'),
(37, 'MagicResist', 'Magic Resist'),
(38, 'MaxMagicResist', 'Max Magic Resist'),
(39, 'FireResist', 'Fire Resist'),
(40, 'MaxFireResist', 'Max Fire Resist'),
(41, 'LightningResist', 'Lightning Resist'),
(42, 'MaxLightningResist', 'Max Lightning Resist'),
(43, 'ColdResist', 'Cold Resist'),
(44, 'MaxColdResist', 'Max Cold Resist'),
(45, 'PoisonResist', 'Poison Resist'),
(46, 'MaxPoisonResist', 'Max Poison Resist'),
(47, 'DamageAura', 'Damage Aura'),
(48, 'FireMinDamage', 'Fire Min Damage'),
(49, 'FireMaxDamage', 'Fire Max Damage'),
(50, 'LightningMinDamage', 'Lightning Min Damage'),
(51, 'LightningMaxDamage', 'Lightning Max Damage'),
(52, 'MagicMinDamage', 'Magic Min Damage'),
(53, 'MagicMaxDamage', 'Magic Max Damage'),
(54, 'ColdMinDamage', 'Cold Min Damage'),
(55, 'ColdMaxDamage', 'Cold Max Damage'),
(56, 'ColdLength', 'Cold Length'),
(57, 'PoisonMinDamage', 'Poison Min Damage'),
(58, 'PoisonMaxDamage', 'Poison Max Damage'),
(59, 'PoisonLength', 'Poison Length'),
(60, 'LifeSteal', 'Life Steal'),
(61, 'LifeStealMax', 'Life Steal Max'),
(62, 'ManaSteal', 'Mana Steal'),
(63, 'ManaStealMax', 'Mana Steal Max'),
(64, 'StaminaDrainMinDamage', 'Stamina Drain Min Damage'),
(65, 'StaminaDrainMaxDamage', 'Stamina Drain Max Damage'),
(66, 'StunLength', 'Stun Length'),
(67, 'VelocityPercent', 'Velocity Percent'),
(68, 'AttackRate', 'Attack Rate'),
(69, 'OtherAnimRate', 'Other Anim Rate'),
(70, 'Quantity', 'Quantity'),
(71, 'Value', 'Value'),
(72, 'Durability', 'Durability'),
(73, 'MaxDurability', 'Max Durability'),
(74, 'ReplenishLife', 'Replenish Life'),
(75, 'MaxDurabilityPercent', 'Max Durability Percent'),
(76, 'MaxLifePercent', 'Max Life Percent'),
(77, 'MaxManaPercent', 'Max Mana Percent'),
(78, 'AttackerTakesDamage', 'Attacker Takes Damage'),
(79, 'GoldFind', 'Gold Find'),
(80, 'MagicFind', 'Magic Find'),
(81, 'Knockback', 'Knockback'),
(82, 'TimeDuration', 'Time Duration'),
(83, 'AddClassSkills', 'Add Class Skills'),
(84, 'Unused84', 'Unused 84'),
(85, 'AddExperience', 'Add Experience'),
(86, 'LifeAfterEachKill', 'Life After Each Kill'),
(87, 'ReducePrices', 'Reduce Prices'),
(88, 'DoubleHerbDuration', 'Double Herb Duration'),
(89, 'LightRadius', 'Light Radius'),
(90, 'LightColor', 'Light Color'),
(91, 'Requirements', 'Requirements'),
(92, 'LevelRequire', 'Level Require'),
(93, 'IncreasedAttackSpeed', 'Increased Attack Speed'),
(94, 'LevelRequirePercent', 'Level Require Percent'),
(95, 'LastBlockFrame', 'Last Block Frame'),
(96, 'FasterRunWalk', 'Faster Run Walk'),
(97, 'NonClassSkill', 'Non Class Skill'),
(98, 'State', 'State'),
(99, 'FasterHitRecovery', 'Faster Hit Recovery'),
(100, 'PlayerCount', 'Player Count'),
(101, 'PoisonOverrideLength', 'Poison Override Length'),
(102, 'FasterBlockRate', 'Faster Block Rate'),
(103, 'BypassUndead', 'Bypass Undead'),
(104, 'BypassDemons', 'Bypass Demons'),
(105, 'FasterCastRate', 'Faster Cast Rate'),
(106, 'BypassBeasts', 'Bypass Beasts'),
(107, 'SingleSkill', 'Single Skill'),
(108, 'SlainMonstersRestInPeace', 'Slain Monsters Rest In Peace'),
(109, 'CurseResistance', 'Curse Resistance'),
(110, 'PoisonLengthReduced', 'Poison Length Reduced'),
(111, 'NormalDamage', 'Normal Damage'),
(112, 'HitCausesMonsterToFlee', 'Hit Causes Monster To Flee'),
(113, 'HitBlindsTarget', 'Hit Blinds Target'),
(114, 'DamageTakenGoesToMana', 'Damage Taken Goes To Mana'),
(115, 'IgnoreTargetsDefense', 'Ignore Targets Defense'),
(116, 'TargetDefense', 'Target Defense'),
(117, 'PreventMonsterHeal', 'Prevent Monster Heal'),
(118, 'HalfFreezeDuration', 'Half Freeze Duration'),
(119, 'AttackRatingPercent', 'Attack Rating Percent'),
(120, 'MonsterDefensePerHit', 'Monster Defense Per Hit'),
(121, 'DemonDamagePercent', 'Demon Damage Percent'),
(122, 'UndeadDamagePercent', 'Undead Damage Percent'),
(123, 'DemonAttackRating', 'Demon Attack Rating'),
(124, 'UndeadAttackRating', 'Undead Attack Rating'),
(125, 'Throwable', 'Throwable'),
(126, 'FireSkills', 'Fire Skills'),
(127, 'AllSkills', 'All Skills'),
(128, 'AttackerTakesLightDamage', 'Attacker Takes Light Damage'),
(129, 'IronMaidenLevel', 'Iron Maiden Level'),
(130, 'LifeTapLevel', 'Life Tap Level'),
(131, 'ThornsPercent', 'Thorns Percent'),
(132, 'BoneArmor', 'Bone Armor'),
(133, 'BoneArmorMax', 'Bone Armor Max'),
(134, 'FreezesTarget', 'Freezes Target'),
(135, 'OpenWounds', 'Open Wounds'),
(136, 'CrushingBlow', 'Crushing Blow'),
(137, 'KickDamage', 'Kick Damage'),
(138, 'ManaAfterKill', 'Mana After Kill'),
(139, 'HealAfterDemonKill', 'Heal After Demon Kill'),
(140, 'ExtraBlood', 'Extra Blood'),
(141, 'DeadlyStrike', 'Deadly Strike'),
(142, 'AbsorbFirePercent', 'Absorb Fire Percent'),
(143, 'AbsorbFire', 'Absorb Fire'),
(144, 'AbsorbLightningPercent', 'Absorb Lightning Percent'),
(145, 'AbsorbLightning', 'Absorb Lightning'),
(146, 'AbsorbMagicPercent', 'Absorb Magic Percent'),
(147, 'AbsorbMagic', 'Absorb Magic'),
(148, 'AbsorbColdPercent', 'Absorb Cold Percent'),
(149, 'AbsorbCold', 'Absorb Cold'),
(150, 'SlowsTarget', 'Slows Target'),
(151, 'Aura', 'Aura'),
(152, 'Indestructible', 'Indestructible'),
(153, 'CannotBeFrozen', 'Cannot Be Frozen'),
(154, 'SlowerStaminaDrain', 'Slower Stamina Drain'),
(155, 'Reanimate', 'Reanimate'),
(156, 'Pierce', 'Pierce'),
(157, 'MagicArrow', 'Magic Arrow'),
(158, 'ExplosiveArrow', 'Explosive Arrow'),
(159, 'ThrowMinDamage', 'Throw Min Damage'),
(160, 'ThrowMaxDamage', 'Throw Max Damage'),
(161, 'SkillHandofAthena', 'Skill Hand of Athena'),
(162, 'SkillStaminaPercent', 'Skill Stamina Percent'),
(163, 'SkillPassiveStaminaPercent', 'Skill Passive Stamina Percent'),
(164, 'SkillConcentration', 'Skill Concentration'),
(165, 'SkillEnchant', 'Skill Enchant'),
(166, 'SkillPierce', 'Skill Pierce'),
(167, 'SkillConviction', 'Skill Conviction'),
(168, 'SkillChillingArmor', 'Skill Chilling Armor'),
(169, 'SkillFrenzy', 'Skill Frenzy'),
(170, 'SkillDecrepify', 'Skill Decrepify'),
(171, 'SkillArmorPercent', 'Skill Armor Percent'),
(172, 'Alignment', 'Alignment'),
(173, 'Target0', 'Target0'),
(174, 'Target1', 'Target1'),
(175, 'GoldLost', 'Gold Lost'),
(176, 'ConverisonLevel', 'Converison Level'),
(177, 'ConverisonMaxHP', 'Converison Max HP'),
(178, 'UnitDooverlay', 'Unit Dooverlay'),
(179, 'AttackVsMonType', 'Attack Vs Mon Type'),
(180, 'DamageVsMonType', 'Damage Vs Mon Type'),
(181, 'Fade', 'Fade'),
(182, 'ArmorOverridePercent', 'Armor Override Percent'),
(183, 'Unused183', 'Unused 183'),
(184, 'Unused184', 'Unused 184'),
(185, 'Unused185', 'Unused 185'),
(186, 'Unused186', 'Unused 186'),
(187, 'Unused187', 'Unused 187'),
(188, 'AddSkillTab', 'Add Skill Tab'),
(189, 'Unused189', 'Unused 189'),
(190, 'Unused190', 'Unused 190'),
(191, 'Unused191', 'Unused 191'),
(192, 'Unused192', 'Unused 192'),
(193, 'Unused193', 'Unused 193'),
(194, 'NumSockets', 'Num Sockets'),
(195, 'SkillOnAttack', 'Skill On Attack'),
(196, 'SkillOnKill', 'Skill On Kill'),
(197, 'SkillOnDeath', 'Skill On Death'),
(198, 'SkillOnHit', 'Skill On Hit'),
(199, 'SkillOnLevelUp', 'Skill On Level Up'),
(200, 'Unused200', 'Unused 200'),
(201, 'SkillOnGetHit', 'Skill On Get Hit'),
(202, 'Unused202', 'Unused 202'),
(203, 'Unused203', 'Unused 203'),
(204, 'ItemChargedSkill', 'Item Charged Skill'),
(205, 'Unused205', 'Unused 205'),
(206, 'Unused206', 'Unused 206'),
(207, 'Unused207', 'Unused 207'),
(208, 'Unused208', 'Unused 208'),
(209, 'Unused209', 'Unused 209'),
(210, 'Unused210', 'Unused 210'),
(211, 'Unused211', 'Unused 211'),
(212, 'Unused212', 'Unused 212'),
(213, 'Unused213', 'Unused 213'),
(214, 'DefensePerLevel', 'Defense Per Level'),
(215, 'ArmorPercentPerLevel', 'Armor Percent Per Level'),
(216, 'LifePerLevel', 'Life Per Level'),
(217, 'ManaPerLevel', 'Mana Per Level'),
(218, 'MaxDamagePerLevel', 'Max Damage Per Level'),
(219, 'MaxDamagePercentPerLevel', 'Max Damage Percent Per Level'),
(220, 'StrengthPerLevel', 'Strength Per Level'),
(221, 'DexterityPerLevel', 'Dexterity Per Level'),
(222, 'EnergyPerLevel', 'Energy Per Level'),
(223, 'VitalityPerLevel', 'Vitality Per Level'),
(224, 'AttackRatingPerLevel', 'Attack Rating Per Level'),
(225, 'AttackRatingPercentPerLevel', 'Attack Rating Percent Per Level'),
(226, 'ColdDamageMaxPerLevel', 'Cold Damage Max Per Level'),
(227, 'FireDamageMaxPerLevel', 'Fire Damage Max Per Level'),
(228, 'LightningDamageMaxPerLevel', 'Lightning Damage Max Per Level'),
(229, 'PoisonDamageMaxPerLevel', 'Poison Damage Max Per Level'),
(230, 'ResistColdPerLevel', 'Resist Cold Per Level'),
(231, 'ResistFirePerLevel', 'Resist Fire Per Level'),
(232, 'ResistLightningPerLevel', 'Resist Lightning Per Level'),
(233, 'ResistPoisonPerLevel', 'Resist Poison Per Level'),
(234, 'AbsorbColdPerLevel', 'Absorb Cold Per Level'),
(235, 'AbsorbFirePerLevel', 'Absorb Fire Per Level'),
(236, 'AbsorbLightningPerLevel', 'Absorb Lightning Per Level'),
(237, 'AbsorbPoisonPerLevel', 'Absorb Poison Per Level'),
(238, 'ThornsPerLevel', 'Thorns Per Level'),
(239, 'ExtraGoldPerLevel', 'Extra Gold Per Level'),
(240, 'MagicFindPerLevel', 'Magic Find Per Level'),
(241, 'RegenStaminaPerLevel', 'Regen Stamina Per Level'),
(242, 'StaminaPerLevel', 'Stamina Per Level'),
(243, 'DamageDemonPerLevel', 'Damage Demon Per Level'),
(244, 'DamageUndeadPerLevel', 'Damage Undead Per Level'),
(245, 'AttackRatingDemonPerLevel', 'Attack Rating Demon Per Level'),
(246, 'AttackRatingUndeadPerLevel', 'Attack Rating Undead Per Level'),
(247, 'CrushingBlowPerLevel', 'Crushing Blow Per Level'),
(248, 'OpenWoundsPerLevel', 'Open Wounds Per Level'),
(249, 'KickDamagePerLevel', 'Kick Damage Per Level'),
(250, 'DeadlyStrikePerLevel', 'Deadly Strike Per Level'),
(251, 'FindGemsPerLevel', 'Find Gems Per Level'),
(252, 'ReplenishDurability', 'Replenish Durability'),
(253, 'ReplenishQuantity', 'Replenish Quantity'),
(254, 'ExtraStack', 'Extra Stack'),
(255, 'FindItem', 'Find Item'),
(256, 'SlashDamage', 'Slash Damage'),
(257, 'SlashDamagePercent', 'Slash Damage Percent'),
(258, 'CrushDamage', 'Crush Damage'),
(259, 'CrushDamagePercent', 'Crush Damage Percent'),
(260, 'ThrustDamage', 'Thrust Damage'),
(261, 'ThrustDamagePercent', 'Thrust Damage Percent'),
(262, 'AbsorbSlash', 'Absorb Slash'),
(263, 'AbsorbCrush', 'Absorb Crush'),
(264, 'AbsorbThrust', 'Absorb Thrust'),
(265, 'AbsorbSlashPercent', 'Absorb Slash Percent'),
(266, 'AbsorbCrushPercent', 'Absorb Crush Percent'),
(267, 'AbsorbThrustPercent', 'Absorb Thrust Percent'),
(268, 'ArmorByTime', 'Armor By Time'),
(269, 'ArmorPercentByTime', 'Armor Percent By Time'),
(270, 'LifeByTime', 'Life By Time'),
(271, 'ManaByTime', 'Mana By Time'),
(272, 'MaxDamageByTime', 'Max Damage By Time'),
(273, 'MaxDamagePercentByTime', 'Max Damage Percent By'),
(274, 'StrengthByTime', 'Strength By Time'),
(275, 'DexterityByTime', 'Dexterity By Time'),
(276, 'EnergyByTime', 'Energy By Time'),
(277, 'VitalityByTime', 'Vitality By Time'),
(278, 'AttackRatingByTime', 'Attack Rating By Time'),
(279, 'AttackRatingPercentByTime', 'Attack Rating Percent By Time'),
(280, 'ColdDamageMaxByTime', 'Cold Damage Max By Time'),
(281, 'FireDamageMaxByTime', 'Fire Damage Max By Time'),
(282, 'LightningDamageMaxByTime', 'Lightning Damage Max By Time'),
(283, 'PoisonDamageMaxByTime', 'Poison Damage Max By Time'),
(284, 'ResistColdByTime', 'Resist Cold By Time'),
(285, 'ResistFireByTime', 'Resist Fire By Time'),
(286, 'ResistLightningByTime', 'Resist Lightning By Time'),
(287, 'ResistPoisonByTime', 'Resist Poison By Time'),
(288, 'AbsorbColdByTime', 'Absorb Cold By Time'),
(289, 'AbsorbFireByTime', 'Absorb Fire By Time'),
(290, 'AbsorbLightningByTime', 'Absorb Lightning By Time'),
(291, 'AbsorbPoisonByTime', 'Absorb Poison By Time'),
(292, 'FindGoldByTime', 'Find Gold By Time'),
(293, 'MagicFindByTime', 'Magic Find By Time'),
(294, 'RegenStaminaByTime', 'Regen Stamina By Time'),
(295, 'StaminaByTime', 'Stamina By Time'),
(296, 'DamageDemonByTime', 'Damage Demon By Time'),
(297, 'DamageUndeadByTime', 'Damage Undead By Time'),
(298, 'AttackRatingDemonByTime', 'Attack Rating Demon By Time'),
(299, 'AttackRatingUndeadByTime', 'Attack Rating Undead By Time'),
(300, 'CrushingBlowByTime', 'Crushing Blow By Time'),
(301, 'OpenWoundsByTime', 'Open Wounds By Time'),
(302, 'KickDamageByTime', 'Kick Damage By Time'),
(303, 'DeadlyStrikeByTime', 'Deadly Strike By Time'),
(304, 'FindGemsByTime', 'Find Gems By Time'),
(305, 'PierceCold', 'Pierce Cold'),
(306, 'PierceFire', 'Pierce Fire'),
(307, 'PierceLightning', 'Pierce Lightning'),
(308, 'PiercePoison', 'Pierce Poison'),
(309, 'DamageVsMonster', 'Damage Vs Monster'),
(310, 'DamagePercentVsMonster', 'Damage Percent Vs Monster'),
(311, 'AttackRatingVsMonster', 'Attack Rating Vs Monster'),
(312, 'AttackRatingPercentVsMonster', 'Attack Rating Percent Vs Monster'),
(313, 'AcVsMonster', 'Ac Vs Monster'),
(314, 'AcPercentVsMonster', 'Ac Percent Vs Monster'),
(315, 'FireLength', 'Fire Length'),
(316, 'BurningMin', 'Burning Min'),
(317, 'BurningMax', 'Burning Max'),
(318, 'ProgressiveDamage', 'Progressive Damage'),
(319, 'ProgressiveSteal', 'Progressive Steal'),
(320, 'ProgressiveOther', 'Progressive Other'),
(321, 'ProgressiveFire', 'Progressive Fire'),
(322, 'ProgressiveCold', 'Progressive Cold'),
(323, 'ProgressiveLightning', 'Progressive Lightning'),
(324, 'ExtraCharges', 'Extra Charges'),
(325, 'ProgressiveAttackRating', 'Progressive Attack Rating'),
(326, 'PoisonCount', 'Poison Count'),
(327, 'DamageFrameRate', 'Damage Frame Rate'),
(328, 'PierceIdx', 'Pierce Index'),
(329, 'FireSkillDamage', 'Fire Skill Damage'),
(330, 'LightningSkillDamage', 'Lightning Skill Damage'),
(331, 'ColdSkillDamage', 'Cold Skill Damage'),
(332, 'PoisonSkillDamage', 'Poison Skill Damage'),
(333, 'EnemyFireResist', 'Enemy Fire Resist'),
(334, 'EnemyLightningResist', 'Enemy Lightning Resist'),
(335, 'EnemyColdResist', 'Enemy Cold Resist'),
(336, 'EnemyPoisonResist', 'Enemy Poison Resist'),
(337, 'PassiveCriticalStrike', 'Passive Critical Strike'),
(338, 'PassiveDodge', 'Passive Dodge'),
(339, 'PassiveAvoid', 'Passive Avoid'),
(340, 'PassiveEvade', 'Passive Evade'),
(341, 'PassiveWarmth', 'Passive Warmth'),
(342, 'PassiveMasteryMeleeAttackRating', 'Passive Mastery Melee Attack Rating'),
(343, 'PassiveMasteryMeleeDamage', 'Passive Mastery Melee Damage'),
(344, 'PassiveMasteryMeleeCritical', 'Passive Mastery Melee Critical'),
(345, 'PassiveMasteryThrowAttackRating', 'Passive Mastery Throw Attack Rating'),
(346, 'PassiveMasteryThrowDamage', 'Passive Mastery Throw Damage'),
(347, 'PassiveMasteryThrowCritical', 'Passive Mastery Throw Critical'),
(348, 'PassiveWeaponBlock', 'Passive Weapon Block'),
(349, 'SummonResist', 'Summon Resist'),
(350, 'ModifierListSkill', 'Modifier List Skill'),
(351, 'ModifierListLevel', 'Modifier List Level'),
(352, 'LastSentHPPercent', 'Last Sent HP Percent'),
(353, 'SourceUnitType', 'Source Unit Type'),
(354, 'SourceUnitID', 'Source Unit ID'),
(355, 'ShortParam1', 'Short Param 1'),
(356, 'QuestItemDifficulty', 'Quest Item Difficulty'),
(357, 'PassiveMagicMastery', 'Passive Magic Mastery'),
(358, 'PassiveMagicPierce', 'Passive Magic Pierce');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `unique_items`
--

CREATE TABLE `unique_items` (
  `id` int NOT NULL,
  `index_name` varchar(255) DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `version` int DEFAULT NULL,
  `enabled` int DEFAULT NULL,
  `rarity` int DEFAULT NULL,
  `level` int DEFAULT NULL,
  `level_req` int DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `cost_mult` int DEFAULT NULL,
  `cost_add` int DEFAULT NULL,
  `expansion` int DEFAULT NULL,
  `line_number` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_number`);

--
-- Indeks for tabel `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bot_name` (`bot_name`);

--
-- Indeks for tabel `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_config` (`id`);

--
-- Indeks for tabel `ItemConditions`
--
ALTER TABLE `ItemConditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_type_id` (`item_type_id`);

--
-- Indeks for tabel `ItemQualities`
--
ALTER TABLE `ItemQualities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `ItemTypes`
--
ALTER TABLE `ItemTypes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `item_properties`
--
ALTER TABLE `item_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks for tabel `item_type_names`
--
ALTER TABLE `item_type_names`
  ADD PRIMARY KEY (`item_id`);

--
-- Indeks for tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indeks for tabel `StatConditions`
--
ALTER TABLE `StatConditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_condition_id` (`item_condition_id`);

--
-- Indeks for tabel `stat_mapping`
--
ALTER TABLE `stat_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `unique_items`
--
ALTER TABLE `unique_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `bots`
--
ALTER TABLE `bots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tilføj AUTO_INCREMENT i tabel `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Tilføj AUTO_INCREMENT i tabel `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `ItemConditions`
--
ALTER TABLE `ItemConditions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Tilføj AUTO_INCREMENT i tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- Tilføj AUTO_INCREMENT i tabel `ItemTypes`
--
ALTER TABLE `ItemTypes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tilføj AUTO_INCREMENT i tabel `item_properties`
--
ALTER TABLE `item_properties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `item_type_names`
--
ALTER TABLE `item_type_names`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- Tilføj AUTO_INCREMENT i tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111;

--
-- Tilføj AUTO_INCREMENT i tabel `StatConditions`
--
ALTER TABLE `StatConditions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Tilføj AUTO_INCREMENT i tabel `unique_items`
--
ALTER TABLE `unique_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `ItemConditions`
--
ALTER TABLE `ItemConditions`
  ADD CONSTRAINT `ItemConditions_ibfk_1` FOREIGN KEY (`item_type_id`) REFERENCES `ItemTypes` (`id`);

--
-- Begrænsninger for tabel `item_properties`
--
ALTER TABLE `item_properties`
  ADD CONSTRAINT `item_properties_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `unique_items` (`item_id`);

--
-- Begrænsninger for tabel `StatConditions`
--
ALTER TABLE `StatConditions`
  ADD CONSTRAINT `StatConditions_ibfk_1` FOREIGN KEY (`item_condition_id`) REFERENCES `ItemConditions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
