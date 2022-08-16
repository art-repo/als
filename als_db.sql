-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2022 at 12:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `als_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertOscyaDetails` (IN `oid` VARCHAR(20), IN `uid` VARCHAR(20), IN `ln` VARCHAR(30), IN `fn` VARCHAR(30), IN `mn` VARCHAR(30), IN `ext` VARCHAR(10), IN `fname` VARCHAR(255), IN `bd` DATE, IN `age` INT(11), IN `sex` VARCHAR(10), IN `cs` VARCHAR(10), IN `rel` VARCHAR(50), IN `eml` VARCHAR(50), IN `cpnum` VARCHAR(16), IN `fb` VARCHAR(50), IN `st` VARCHAR(255), IN `br` VARCHAR(255), IN `dist` VARCHAR(15), IN `ct` VARCHAR(50), IN `stt` VARCHAR(50), IN `zc` VARCHAR(15), IN `pst` VARCHAR(255), IN `pbr` VARCHAR(255), IN `pdist` VARCHAR(15), IN `pct` VARCHAR(50), IN `pstt` VARCHAR(50), IN `pzc` VARCHAR(15), IN `gflln` VARCHAR(60), IN `geml` VARCHAR(50), IN `gcp` VARCHAR(16), IN `gf` VARCHAR(50), IN `educ` VARCHAR(255), IN `rs` TEXT, IN `ors` TEXT, IN `dsa` TEXT, IN `ipwd` TINYINT(1), IN `hpwdid` TINYINT(1), IN `odsa` TEXT, IN `dss` TEXT, IN `isemp` TINYINT(1), IN `isfps` TINYINT(1), IN `isin` TINYINT(1), IN `mppdate` DATE)  BEGIN
        	START TRANSACTION;
                
                INSERT INTO `oscya_info`(`oscya_id`, `lastname`, `firstname`, `middlename`, `extension`, `fullname`,`birthdate`, `age`, `gender`, `civil_status`, `religion`) VALUES ( oid, ln, fn, mn, ext, fname, bd, age, sex, cs, rel);
                
                INSERT INTO `oscya_contact`(`oscya_id`, `email`, `contact`, `facebook`, `street`, `brgy`, `district`, `city`, `state`, `zip_code`, `p_street`, `p_barangay`, `p_district`, `p_city`, `p_state`, `p_zip_code`) VALUES (oid, eml, cpnum, fb, st, br, dist, ct, stt, zc, pst, pbr, pdist, pct, pstt, pzc);
                
                INSERT INTO `oscya_guardian`(`oscya_id`, `fullname`, `email`, `contact`, `facebook`) VALUES (oid, gflln, geml, gcp, gf);
                
                INSERT INTO `oscya_mapping`(`oscya_id`, `user_id`, `educ_attainment`, `reason`, `other_reason`, `disability`, `is_pwd`, `has_pwd_id`, `disease`, `is_employed`, `is_fps_member`, `is_interested`, `mapping_date`) VALUES (oid, uid, educ, rs, ors, dsa, ipwd, hpwdid, dss, isemp, isfps, isin, mppdate);
                
                INSERT INTO `oscya_counseling`(`oscya_id`) VALUES (oid);
                


                
                COMMIT;
            END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertStaff` (IN `uid` VARCHAR(20), IN `cid` VARCHAR(20), IN `usn` VARCHAR(20), IN `pass` VARCHAR(300), IN `eml` VARCHAR(50), IN `act_code` VARCHAR(10), IN `utype` VARCHAR(50), IN `imagePath` BLOB, IN `barangay` TEXT)  BEGIN
         START TRANSACTION;
			INSERT INTO `user`(`user_id`, `creator_id`, `username`, `password`, `activation_code`, `user_type`) 
			VALUES ( uid, cid, usn, pass, act_code, utype);
            
            INSERT INTO `info`(`user_id`, `image`) VALUES (uid, imagePath);
            
            INSERT INTO `contact`(`user_id`, `barangay`, `email`) VALUES (uid, barangay, eml);
		COMMIT;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_als_coord` (IN `acid` VARCHAR(250), IN `act_code` VARCHAR(250), IN `dist` INT, IN `ln` VARCHAR(30), IN `fn` VARCHAR(30), IN `eml` VARCHAR(50), IN `usn` VARCHAR(50), IN `pass` VARCHAR(300), IN `id_loc` TEXT)  BEGIN
        START TRANSACTION;
			INSERT INTO `als_coordinator`(`user_id`, `is_evaluated`,`activation_code`, `isActivated`,`email`, `is_email_activated`, `username`, `password`) 
            VALUES 
            (acid, 0, act_code, 0, eml, 1, usn, pass);
            INSERT INTO `als_coordinator_contact`(`user_id`, `district`, `email`) VALUES (acid, dist, eml);
            INSERT INTO `als_coordinator_info`(`user_id`, `lastname`, `firstname`) VALUES (acid, ln, fn);
            INSERT INTO `als_coordinator_credential`(`user_id`, `tch_id`) VALUES (acid, id_loc);
		COMMIT;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_als_teacher` (IN `tid` VARCHAR(250), IN `act_code` VARCHAR(250), IN `dist` INT, IN `ln` VARCHAR(30), IN `fn` VARCHAR(30), IN `eml` VARCHAR(50), IN `usn` VARCHAR(50), IN `pass` VARCHAR(300), IN `id_loc` TEXT)  BEGIN
        START TRANSACTION;
			INSERT INTO `teacher`(`user_id`, `is_evaluated`,`activation_code`, `isActivated`,`email`, `is_email_activated`, `username`, `password`) 
            VALUES 
            (tid, 0, act_code, 0, eml, 1, usn, pass);
            INSERT INTO `teacher_contact`(`user_id`, `district`, `email`) VALUES (tid, dist, eml);
            INSERT INTO `teacher_info`(`user_id`, `lastname`, `firstname`) VALUES (tid, ln, fn);
            INSERT INTO `teacher_credential`(`user_id`, `id_loc`) VALUES (tid, id_loc);
		COMMIT;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_coord` (IN `cid` VARCHAR(250), IN `act_code` VARCHAR(50), IN `dist` INT, IN `brgy` TEXT, IN `ln` VARCHAR(30), IN `fn` VARCHAR(30), IN `eml` VARCHAR(50), IN `usn` VARCHAR(50), IN `pass` VARCHAR(300), IN `id_loc` TEXT)  BEGIN
        START TRANSACTION;
			INSERT INTO `user`(`user_id`, `is_evaluated`, `activation_code`, `isActivated`, `email`, `is_email_activated`,`username`, `password`, `user_type`) VALUES (cid, 0,act_code, 0, eml, 1, usn, pass, 'Coordinator');
            INSERT INTO `contact`(`user_id`, `barangay`, `district`, `email`) VALUES (cid, brgy, dist, eml);
            INSERT INTO `info`(`user_id`, `lastname`, `firstname`) VALUES (cid, ln, fn);
            INSERT INTO `barangay`(`user_id`, `barangay`) VALUES (cid, brgy);
            INSERT INTO `credential`(`user_id`, `brgy_id_loc`) VALUES (cid, id_loc);
		COMMIT;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_staff` (IN `cid` VARCHAR(250), IN `act_code` VARCHAR(50), IN `dist` INT, IN `brgy` TEXT, IN `ln` VARCHAR(30), IN `fn` VARCHAR(30), IN `eml` VARCHAR(50), IN `usn` VARCHAR(50), IN `pass` VARCHAR(300), IN `id_loc` TEXT)  BEGIN
        START TRANSACTION;
			INSERT INTO `user`(`user_id`, `is_evaluated`, `activation_code`, `isActivated`, `email`, `is_email_activated`,`username`, `password`, `user_type`) VALUES (cid, 0,act_code, 0, eml, 1, usn, pass, 'Staff');
            INSERT INTO `contact`(`user_id`, `barangay`, `district`, `email`) VALUES (cid, brgy, dist, eml);
            INSERT INTO `info`(`user_id`, `lastname`, `firstname`) VALUES (cid, ln, fn);
            INSERT INTO `barangay`(`user_id`, `barangay`) VALUES (cid, brgy);
            INSERT INTO `credential`(`user_id`, `brgy_id_loc`) VALUES (cid, id_loc);
		COMMIT;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `migrate_oscya` (IN `o_id` VARCHAR(20), IN `s_id` VARCHAR(20), IN `t_id` VARCHAR(20), IN `fname` VARCHAR(255), IN `age` INT(11), IN `bday` DATE, IN `sex` VARCHAR(10), IN `c_status` VARCHAR(10), IN `st` VARCHAR(255), IN `brgy` VARCHAR(255), IN `dist` VARCHAR(255), IN `rel` VARCHAR(50), IN `gfname` VARCHAR(60), IN `gcontact` VARCHAR(16), IN `e_attainment` VARCHAR(255), IN `rs` TEXT, IN `ispwd` TINYINT(1), IN `ds_ability` TEXT, IN `hpwdid` TINYINT(1), IN `isemp` TINYINT(1), IN `isfps` TINYINT(1), IN `isin` TINYINT(1), IN `map_date` DATE, IN `cs_date` DATE)  BEGIN
	START TRANSACTION;
		INSERT INTO `oscya_info`(`oscya_id`, `fullname`,`birthdate`, `age`, `gender`, `civil_status`, `religion`) VALUES ( o_id, fname, bday, age, sex, c_status, rel);
                
                INSERT INTO `oscya_contact`(`oscya_id`, `street`, `brgy`, `district`) VALUES (o_id, st, brgy, dist);
                
                INSERT INTO `oscya_guardian`(`oscya_id`, `fullname`, `contact`) VALUES (o_id, gfname, gcontact);
                
                INSERT INTO `oscya_mapping`(`oscya_id`, `user_id`, `educ_attainment`, `reason`,  `is_pwd`, `disability`, `has_pwd_id`, `is_employed`, `is_fps_member`, `is_interested`, `mapping_date`) VALUES (o_id, s_id, e_attainment, rs, ispwd, ds_ability,  hpwdid, isemp, isfps, isin, map_date);
                
                INSERT INTO `oscya_counseling`(`oscya_id`, `teacher_id`, `is_interested`, `is_counseled`, `counsel_date` ) VALUES (o_id, t_id, isin, 1, cs_date);
               
                COMMIT;
            END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `activity_id` varchar(50) NOT NULL,
  `facility_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `activity_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `als_coordinator`
--

CREATE TABLE `als_coordinator` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `creator_id` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_email_activated` tinyint(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `is_evaluated` tinyint(1) NOT NULL,
  `activation_code` varchar(15) NOT NULL,
  `isActivated` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `als_coordinator`
--

INSERT INTO `als_coordinator` (`id`, `user_id`, `creator_id`, `email`, `is_email_activated`, `username`, `password`, `is_evaluated`, `activation_code`, `isActivated`, `status`) VALUES
(1, 'AID-XM67AB', '', 'artantonio39@gmail.com', 1, '@district5', '$2y$10$KFBN4XLWSv.x9LbiZPlhNutle/1l1/9Pl2JM..gtH3UH/b49CXw.6', 1, 'XXX-XXXX-XXX', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `als_coordinator_contact`
--

CREATE TABLE `als_coordinator_contact` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `street` text COLLATE utf8_unicode_ci NOT NULL,
  `barangay` text COLLATE utf8_unicode_ci NOT NULL,
  `district` int(3) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `als_coordinator_contact`
--

INSERT INTO `als_coordinator_contact` (`id`, `user_id`, `email`, `facebook`, `contact_no`, `street`, `barangay`, `district`, `zip_code`, `city`) VALUES
(1, 'AID-XM67AB', 'artantonio39@gmail.com', '', '', '', '', 5, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `als_coordinator_credential`
--

CREATE TABLE `als_coordinator_credential` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `tch_id` text NOT NULL,
  `psa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `als_coordinator_credential`
--

INSERT INTO `als_coordinator_credential` (`id`, `user_id`, `tch_id`, `psa`) VALUES
(1, 'AID-XM67AB', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `als_coordinator_info`
--

CREATE TABLE `als_coordinator_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `suffix` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `civil_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `religion` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `als_coordinator_info`
--

INSERT INTO `als_coordinator_info` (`id`, `user_id`, `lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image`) VALUES
(1, 'AID-XM67AB', 'Antonio', 'Art', 'Acebuche', '', '2000-02-11', 22, 'Male', 'Single', 'Catholic', 'AID-XM67AB/1652612666_2dab22a69b80fe7ce78f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `creator_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `audience` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `creator_id`, `date_created`, `image`, `content`, `audience`) VALUES
(1, 'CID-43MTZP', '2022-05-08 04:24:33', '', '<p><br></p>', 'all'),
(2, 'CID-43MTZP', '2022-05-08 04:24:35', '', '<p><br></p>', 'all'),
(3, 'CID-43MTZP', '2022-05-11 13:55:52', 'CID-43MTZP/1651760668_6622a9d52bcec56c1d6e.zip', '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis porro esse placeat vero et suscipit. Nihil quae commodi enim, quisquam reprehenderit vitae numquam illum facilis et, ab rem. Dolore ex, maxime, ipsum minus sit ducimus recusandae sed magnam voluptate, error architecto itaque.</p>', 'both'),
(4, 'CID-43MTZP', '2022-05-11 13:30:42', 'CID-43MTZP/1651760720_93f72babc4c559edd1fc.jpg', '<h1><strong>Meow</strong></h1>', 'both'),
(5, 'CID-43MTZP', '2022-05-08 02:33:15', 'CID-43MTZP/1651816417_92e54ff6cda23ddb6c39.jpg', '<h2><strong>Sample post</strong></h2>', 'staff'),
(6, 'CID-43MTZP', '2022-05-08 02:32:48', 'CID-43MTZP/1651939205_bab65d42fb5d391b01f8.jpg', '<p>Meowie Pie</p>', 'all'),
(7, 'CID-43MTZP', '2022-05-10 04:54:51', 'CID-43MTZP/1651984006_65296ecd668d97c9e593.jpg', '<h2><strong style=\"color: rgb(230, 0, 0);\">Groupings</strong></h2>', 'both'),
(8, 'CID-43MTZP', '2022-05-08 02:37:04', 'CID-43MTZP/1651936246_e8aee73375bebc2f4302.png', '<h2><strong style=\"color: rgb(230, 0, 0);\">All teachers Only!!!</strong></h2>', 'teacher'),
(9, 'CID-43MTZP', '2022-05-08 12:23:39', '', '<h2><span style=\"color: rgb(107, 36, 178);\">Lorem Ipsum</span></h2><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis porro esse placeat vero et suscipit. Nihil quae commodi enim, quisquam reprehenderit vitae numquam illum facilis et, ab rem.&nbsp;Dolore ex, maxime, ipsum minus sit ducimus recusandae sed magnam voluptate, error architecto itaque.</p><p><br></p>', 'both');

-- --------------------------------------------------------

--
-- Table structure for table `backup_setting`
--

CREATE TABLE `backup_setting` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `choose` varchar(255) NOT NULL,
  `backup_loc` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `barangay` text COLLATE utf8_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_page` text COLLATE utf8_unicode_ci NOT NULL,
  `official_web` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_photo` text COLLATE utf8_unicode_ci NOT NULL,
  `img_1` text COLLATE utf8_unicode_ci NOT NULL,
  `img_2` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`id`, `user_id`, `barangay`, `about`, `address`, `contact_no`, `from`, `to`, `email`, `facebook_page`, `official_web`, `logo`, `cover_photo`, `img_1`, `img_2`) VALUES
(1, 'CID-43MTZP', 'Bagbag', '                                                                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus commodi, voluptatum in sed esse tempora sit iste veritatis ullam fuga, impedit quos porro voluptate sunt quibusdam quis error adipisci. Autem, nam! Molestias a consectetur exercitationem odit, earum qui necessitatibus voluptatibus sequi modi fugiat optio? Nobis eius possimus tempora vero illum?                                                                                                                            ', 'blk 2 lot 9 kasayahan street', '09353363543', '08:01', '17:00', '', 'https://www.facebook.com/', 'https://www.facebook.com/', 'CID-43MTZP/1652709250_f468b6349caa127ae766.png', 'CID-43MTZP/1652763628_02233a3d4027fa8b71b9.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `street` text COLLATE utf8_unicode_ci NOT NULL,
  `barangay` text COLLATE utf8_unicode_ci NOT NULL,
  `district` int(3) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `email`, `facebook`, `contact_no`, `street`, `barangay`, `district`, `zip_code`, `city`) VALUES
(1, 'CID-43MTZP', 'art.acebuche.antonio.qcu@gmail.com', '', '', '', 'Bagbag', 5, 0, ''),
(2, 'SID-16QIOF', 'artantonio39@gmail.com', '', '09353363543', 'Blk 02, lot 09 Kasayahan Street', 'Bagbag', 5, 1116, 'Q.C.'),
(3, 'SID-51VWQG', 'artantonio39@gmail.com', '', '', '', 'Bagbag', 5, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `credential`
--

CREATE TABLE `credential` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `brgy_id_loc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credential`
--

INSERT INTO `credential` (`id`, `user_id`, `brgy_id_loc`) VALUES
(1, 'CID-43MTZP', 'CID-43MTZP/gerero.png'),
(2, 'SID-16QIOF', 'SID-16QIOF/gerero.png'),
(3, 'SID-51VWQG', 'SID-51VWQG/1651514876_318225818c2c730bc8b6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `about` longtext NOT NULL,
  `logo` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `cover_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(11) NOT NULL,
  `facility_id` varchar(250) NOT NULL,
  `coordinator_id` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `type` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`id`, `facility_id`, `coordinator_id`, `address`, `name`, `description`, `type`, `image`) VALUES
(1, 'FID-63LKDM', 'CID-43MTZP', 'Brgy. sample street, San Bartolome, Quezon City', 'SB Covered Court', 'sample', 'Covered Court', 'CID-43MTZP/1651511672_9db335254d04dcebc8d8.png');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `suffix` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `civil_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `religion` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `user_id`, `lastname`, `firstname`, `middlename`, `suffix`, `birth`, `age`, `gender`, `civil_status`, `religion`, `image`) VALUES
(1, 'CID-43MTZP', 'Antonio', 'Art', '', '', '0000-00-00', 0, '', '', '', 'CID-43MTZP/1651588636_a7fb454f1392ba1979ea.png'),
(2, 'SID-16QIOF', 'Petras', 'Ace', 'Dela Rosa', 'III', '2000-02-11', 22, 'Male', 'Single', 'Catholic', 'SID-16QIOF/1652152309_88b6a52b3d7508514139.jpg'),
(3, 'SID-51VWQG', 'Gratil', 'Rinil', '', '', '0000-00-00', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message_creator` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_reply` int(11) DEFAULT NULL,
  `reply_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message_recipient`
--

CREATE TABLE `message_recipient` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notif_content` text NOT NULL,
  `notif_type` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `brgy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oscya_admission`
--

CREATE TABLE `oscya_admission` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `oscya_id` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `pis_score` varchar(30) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `learning_mode` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `date_counseled` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oscya_contact`
--

CREATE TABLE `oscya_contact` (
  `id` int(20) NOT NULL,
  `oscya_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brgy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `p_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_barangay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_district` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `p_city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `p_state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `p_zip_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oscya_contact`
--

INSERT INTO `oscya_contact` (`id`, `oscya_id`, `email`, `contact`, `facebook`, `street`, `brgy`, `district`, `city`, `state`, `zip_code`, `p_street`, `p_barangay`, `p_district`, `p_city`, `p_state`, `p_zip_code`) VALUES
(1, 'OID-78XKJT', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(2, 'OID-53PJWE', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(3, 'OID-71PSKE', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(4, 'OID-31PRTU', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(5, 'OID-42HTWZ', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(6, 'OID-53TNOF', '', '', '', 'BICOL CMPD', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(7, 'OID-24TPZV', '', '', '', '595 BLAS ROQUE ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(8, 'OID-89IAVO', '', '', '', '03 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(9, 'OID-53DZQN', '', '', '', '29 OLD PALIGUAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(10, 'OID-10OYGT', '', '', '', '598 MARIDES ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(11, 'OID-63RAUJ', '', '', '', '598 ST. MARIDES ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(12, 'OID-21XQOD', '', '', '', '438 C. FRANCO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(13, 'OID-74ICXK', '', '', '', '438 C. FRANCO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(14, 'OID-04JUWH', '', '', '', '438 C. FRANCO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(15, 'OID-02REBF', '', '', '', '625 INT C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(16, 'OID-31LCQD', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(17, 'OID-68FGVW', '', '', '', '625 INT. C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(18, 'OID-50JZGA', '', '', '', '625 INT. C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(19, 'OID-13XEIG', '', '', '', '625 INT. C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(20, 'OID-86IKCA', '', '', '', '626 INT. C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(21, 'OID-51ASGV', '', '', '', '625 INT C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(22, 'OID-70IVTX', '', '', '', '625 INT. C. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(23, 'OID-30MNFI', '', '', '', '625 INT. C', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(24, 'OID-13MUGJ', '', '', '', '625 INT. PAGKABUHAY ROAD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(25, 'OID-04HOQF', '', '', '', '625 INT C. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(26, 'OID-61EUKR', '', '', '', '625 INT. C', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(27, 'OID-06OMKE', '', '', '', '625 INT. C.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(28, 'OID-07VPDL', '', '', '', '625 INT. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(29, 'OID-32XHZO', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(30, 'OID-74CFQW', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(31, 'OID-13XACF', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(32, 'OID-62NZRC', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(33, 'OID-97GDIB', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(34, 'OID-46HAWX', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(35, 'OID-09IWEC', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(36, 'OID-01UWFS', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(37, 'OID-95SGXD', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(38, 'OID-78GSYL', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(39, 'OID-38PTHA', '', '', '', '625 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(40, 'OID-01ABPE', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(41, 'OID-83QNTC', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(42, 'OID-01SXLT', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(43, 'OID-97TZBH', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(44, 'OID-83EJQP', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(45, 'OID-91MBDA', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(46, 'OID-29MIAY', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(47, 'OID-85AUSZ', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(48, 'OID-69YLGF', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(49, 'OID-80DEVU', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(50, 'OID-40FLJI', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(51, 'OID-14PDWK', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(52, 'OID-60FPXT', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(53, 'OID-46EMFV', '', '', '', '625 INT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(54, 'OID-43RZXK', '', '', '', 'D-7 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(55, 'OID-73ILFH', '', '', '', 'B-A DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(56, 'OID-93NHBM', '', '', '', 'B-2 DON JULIO GREGORIO ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(57, 'OID-43UZXK', '', '', '', '#3 APOLLO ST. REMARVILLE', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(58, 'OID-29KNLC', '', '', '', 'KING CHRISTOPHER ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(59, 'OID-39DPIQ', '', '', '', '#085 IBAYO 2 ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(60, 'OID-78LANS', '', '', '', 'A-146 IBAYO 2', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(61, 'OID-35NPJT', '', '', '', 'A-146 IBAYO 2', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(62, 'OID-01COWV', '', '', '', '03 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(63, 'OID-37QSGE', '', '', '', '439 INT. 99 CAMP. GREZAR ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(64, 'OID-03TUPQ', '', '', '', ' ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(65, 'OID-03YOSZ', '', '', '', '99 LEON CLEOFAS', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(66, 'OID-95CFXP', '', '', '', '84 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(67, 'OID-36TZSC', '', '', '', '26 URBANO ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(68, 'OID-60MVQR', '', '', '', '625 INT. C. PAROKYA NG PAGKABUHAY ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(69, 'OID-56JIAW', '', '', '', 'E-15 ABBEY ROAD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(70, 'OID-89XJYS', '', '', '', ' G-34 ABBEY ROAD', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(71, 'OID-26SENK', '', '', '', 'E-46 ABBEY ROAD', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(72, 'OID-84OFBQ', '', '', '', 'E-47 ABBEY ROAD', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(73, 'OID-49MQTB', '', '', '', 'E-48 ABBEY ROAD', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(74, 'OID-32SHAZ', '', '', '', 'E-56 ABBEY ROAD', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(75, 'OID-87CHXE', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(76, 'OID-72CTXS', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(77, 'OID-70AZGE', '', '', '', '615 INT.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(78, 'OID-12KVCU', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(79, 'OID-53HKQW', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(80, 'OID-92GNVD', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(81, 'OID-46WTSU', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(82, 'OID-96UPYE', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(83, 'OID-59AJMV', '', '', '', '615 INT.O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(84, 'OID-56YDWV', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(85, 'OID-94LZJR', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(86, 'OID-53JXOY', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(87, 'OID-01HFDN', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(88, 'OID-72RCPI', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(89, 'OID-38UTHD', '', '', '', '84 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(90, 'OID-50VWFS', '', '', '', '18-3 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(91, 'OID-50DHKZ', '', '', '', '71 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(92, 'OID-32EHWD', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(93, 'OID-91RGIT', '', '', '', '88 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(94, 'OID-53ELOM', '', '', '', '18-F LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(95, 'OID-12YABL', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(96, 'OID-94ZCAT', '', '', '', '84 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(97, 'OID-97VTWA', '', '', '', '81 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(98, 'OID-61ISVP', '', '', '', '86 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(99, 'OID-65GWJV', '', '', '', '84 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(100, 'OID-93ZOYA', '', '', '', '84 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(101, 'OID-80SJHP', '', '', '', '86 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(102, 'OID-37JOKH', '', '', '', '18-E LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(103, 'OID-68PJST', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(104, 'OID-02JDLP', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(105, 'OID-94VUZD', '', '', '', '5 BERNARDINO ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(106, 'OID-12XUCT', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(107, 'OID-60ZILQ', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(108, 'OID-94YDBU', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(109, 'OID-85VDLQ', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(110, 'OID-57KVGT', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(111, 'OID-57RTHP', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(112, 'OID-57UWAG', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(113, 'OID-84AILS', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(114, 'OID-30UERH', '', '', '', '94 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(115, 'OID-39FOYW', '', '', '', '94 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(116, 'OID-10VZPT', '', '', '', '94 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(117, 'OID-50XMFR', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(118, 'OID-08PWND', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(119, 'OID-05NLIQ', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(120, 'OID-82JPAH', '', '', '', '80 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(121, 'OID-12FPYJ', '', '', '', '615 INT. O.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(122, 'OID-65PCRG', '', '', '', '615 INT. O. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(123, 'OID-54UMEN', '', '', '', '27 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(124, 'OID-52AZKW', '', '', '', '27 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(125, 'OID-57PGJC', '', '', '', '119 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(126, 'OID-14VAIH', '', '', '', '007 MALIGAYA', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(127, 'OID-76RLCH', '', '', '', '007 MALIGAYA', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(128, 'OID-13FISP', '', '', '', '010 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(129, 'OID-01JMPH', '', '', '', '81 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(130, 'OID-03CXUD', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(131, 'OID-63IEXD', '', '', '', '55 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(132, 'OID-98UNOP', '', '', '', '65 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(133, 'OID-65FWXO', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(134, 'OID-58ECSR', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(135, 'OID-82GIYN', '', '', '', '55 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(136, 'OID-73CDSN', '', '', '', 'CELINA DRIVE ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(137, 'OID-60PKVO', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(138, 'OID-28RUKS', '', '', '', '89 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(139, 'OID-51CJXQ', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(140, 'OID-19UMPB', '', '', '', '81 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(141, 'OID-61WDJY', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(142, 'OID-14XSVZ', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(143, 'OID-95SMNK', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(144, 'OID-43ADIB', '', '', '', 'MAGNO ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(145, 'OID-87YTUJ', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(146, 'OID-07UFXQ', '', '', '', '017 MALIGAYA ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(147, 'OID-54PMYK', '', '', '', 'ABBEY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(148, 'OID-50KERP', '', '', '', '017 MALIGAYS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(149, 'OID-36VCJU', '', '', '', '9 DIAMOND ST. GOLDHILL VILLAS', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(150, 'OID-47GCJA', '', '', '', 'MARIDES ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(151, 'OID-57AQUJ', '', '', '', '595 BLAS ROQUE ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(152, 'OID-80APUO', '', '', '', '22 MOSES ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(153, 'OID-85XFMO', '', '', '', '22 MOSES ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(154, 'OID-96FLYJ', '', '', '', '84 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(155, 'OID-50CKPI', '', '', '', 'A-5  ROAD 1', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(156, 'OID-73QFIB', '', '', '', 'MARIDES ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(157, 'OID-75WZHQ', '', '', '', '29-A IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(158, 'OID-09ZDQM', '', '', '', '625 PAROKYA RAOD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(159, 'OID-29LIAF', '', '', '', 'ABBEY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(160, 'OID-57RHWO', '', '', '', 'G-7 ABBEY ROAD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(161, 'OID-45SCTL', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(162, 'OID-64EIZO', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(163, 'OID-23VUJM', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(164, 'OID-15UGDM', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(165, 'OID-82HJWG', '', '', '', 'ROAD 1', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(166, 'OID-82CNHB', '', '', '', 'ROAD 1', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(167, 'OID-85BMIE', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(168, 'OID-96DCRI', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(169, 'OID-45NHTV', '', '', '', 'LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(170, 'OID-70RKQC', '', '', '', '57 IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(171, 'OID-81CEJQ', '', '', '', '57 IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(172, 'OID-20DVWM', '', '', '', '02 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(173, 'OID-06BUXY', '', '', '', '625 BIGLANG-AWA ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(174, 'OID-07ZRAD', '', '', '', '625 BIGLANG-AWA ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(175, 'OID-90MYQE', '', '', '', 'BLK 3 LOT 3 ST. MICHAEL HOMES', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(176, 'OID-12IMVU', '', '', '', '52 SEMINARY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(177, 'OID-72CDPF', '', '', '', '52 SEMINARY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(178, 'OID-74KFSP', '', '', '', '52 SEMINARY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(179, 'OID-92ABSM', '', '', '', '52 SEMINARY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(180, 'OID-07UGIH', '', '', '', '581 WINGS', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(181, 'OID-38TZAR', '', '', '', 'G-57 ABBEY ROAD. .', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(182, 'OID-52MTRG', '', '', '', '120 NARRA ST. IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(183, 'OID-79RHZI', '', '', '', '12 NARRA ST.. IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(184, 'OID-50GERT', '', '', '', '12 I NARRA ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(185, 'OID-84JRNS', '', '', '', '#54 IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(186, 'OID-79VUAL', '', '', '', 'MALIGAYA ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(187, 'OID-75LYOI', '', '', '', '12 K NARRA ST. IBAYO II', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(188, 'OID-09CBTL', '', '', '', '12- O NARRA ST. IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(189, 'OID-54RVBC', '', '', '', '12- O NARRA ST. IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(190, 'OID-75ZXAC', '', '', '', '12- O NARRA ST. IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(191, 'OID-09MXQW', '', '', '', '12- O NARRA ST. IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(192, 'OID-06PCXL', '', '', '', 'KATIPUNAN KALIWA', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(193, 'OID-37TKLG', '', '', '', '# 52 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(194, 'OID-31WCLH', '', '', '', '438 C. FRANCO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(195, 'OID-95HSWV', '', '', '', '438 C. FRANCO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(196, 'OID-64NZXH', '', '', '', 'F 21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(197, 'OID-08RUZJ', '', '', '', '12- O NARRA ST. IBAYO II ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(198, 'OID-89HXVO', '', '', '', '12- K NARRA IBAYO ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(199, 'OID-37YQGW', '', '', '', '12- K NARRA IBAYO ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(200, 'OID-14FUMH', '', '', '', '# 6 ZODIAC ST. REMARVILLE', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(201, 'OID-62DICP', '', '', '', 'A-21 ABBEY ROAD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(202, 'OID-08XKEA', '', '', '', '147 MALIGAYA DULO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(203, 'OID-39MTQL', '', '', '', '147 MALIGAYA DULO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(204, 'OID-10OUJP', '', '', '', '29 URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(205, 'OID-71VAMY', '', '', '', '29 URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(206, 'OID-79TOFJ', '', '', '', 'BICOL CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(207, 'OID-97ZMWK', '', '', '', 'ROAD 4', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(208, 'OID-97YTBS', '', '', '', '925 KING CONSTANTINE KINGSPOINT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(209, 'OID-96KAJM', '', '', '', '29 URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(210, 'OID-06EXNF', '', '', '', 'PANGILINAN ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(211, 'OID-80RITF', '', '', '', 'KATIPUNAN KALIWA', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(212, 'OID-93YAEV', '', '', '', 'A-12 ROAD 1 DON JULIO GREGORIO ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(213, 'OID-63SUEV', '', '', '', 'MANGGAHAN ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(214, 'OID-78ATCN', '', '', '', 'FRANCO CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(215, 'OID-84XHTP', '', '', '', 'ROAD 3 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(216, 'OID-12ZWOU', '', '', '', 'LOT 2 BLK 39 KING CHARLES ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(217, 'OID-53QZUH', '', '', '', 'CAMP GREZAR', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(218, 'OID-27NRJK', '', '', '', 'NARRA ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(219, 'OID-37ANWL', '', '', '', 'DON JULIO GREGORIO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(220, 'OID-80MOSB', '', '', '', '625 CEMETERY', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(221, 'OID-32JCET', '', '', '', 'ABBEY ROAD. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(222, 'OID-64ASNK', '', '', '', 'DANIAC COURT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(223, 'OID-75VUNB', '', '', '', 'MALOLES', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(224, 'OID-95HCTL', '', '', '', 'D-6 DON JULIO GREGORIO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(225, 'OID-13SQRU', '', '', '', 'G-9 ABBEY ROAD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(226, 'OID-68PRTF', '', '', '', 'NARRA ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(227, 'OID-41EPRD', '', '', '', '27 URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(228, 'OID-02JIDP', '', '', '', 'WINGS CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(229, 'OID-10WUCY', '', '', '', 'REMARVILLE ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(230, 'OID-38YMTZ', '', '', '', 'FRANCISCO CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(231, 'OID-30UZAH', '', '', '', 'BICOL CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(232, 'OID-17JPKU', '', '', '', 'A-12 DON JULIO GREGORIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(233, 'OID-50EWFP', '', '', '', 'BICOL CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(234, 'OID-60KCAF', '', '', '', '595 BLAS ROQUE ST', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(235, 'OID-81BNEW', '', '', '', '03 IBAYO  ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(236, 'OID-74ZFKS', '', '', '', '29 OLD PALIGUAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(237, 'OID-18OMUC', '', '', '', '52 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(238, 'OID-13MHLJ', '', '', '', '52 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(239, 'OID-57NXPH', '', '', '', '37-A LEON CLOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(240, 'OID-23VDBQ', '', '', '', '37-A LEON CLOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(241, 'OID-71CJXD', '', '', '', '08 REMARVILLE AVE.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(242, 'OID-98HUXD', '', '', '', '99 CAMP. GREZAR BAGBAG', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(243, 'OID-16IJXM', '', '', '', 'ROQUE CMPD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(244, 'OID-59GALR', '', '', '', '66 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(245, 'OID-36PJKM', '', '', '', '37-A LEON CLOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(246, 'OID-35BQCR', '', '', '', '62 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(247, 'OID-81XDMO', '', '', '', '52 LEON CLEOFAS ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(248, 'OID-80UEDI', '', '', '', 'G-57 ABBEY ROAD. .', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(249, 'OID-48IMQB', '', '', '', '12-I NARRA ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(250, 'OID-43BDIM', '', '', '', 'G-57 ABBEY ROAD. .', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(251, 'OID-86GVBH', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(252, 'OID-23KNZM', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(253, 'OID-41HKOD', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(254, 'OID-98HCMO', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(255, 'OID-70DUML', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(256, 'OID-08QTOB', '', '', '', 'E-21 ABBEY ROAD.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(257, 'OID-27YCWO', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(258, 'OID-84QKBY', '', '', '', '438 C FRANCO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(259, 'OID-65LMPK', '', '', '', 'DANIAC COURT', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(260, 'OID-54BQVS', '', '', '', '22 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(261, 'OID-74ESBM', '', '', '', '36 URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(262, 'OID-94KALD', '', '', '', 'URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(263, 'OID-37WSHA', '', '', '', '36 URBANO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(264, 'OID-13HQTF', '', '', '', '93 LEON CLEOFAS ST. ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(265, 'OID-39PYMS', '', '', '', '106 FELIPE ST. REMARVILLE.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(266, 'OID-59MQVE', '', '', '', '106 FELIPE ST. REMARVILLE.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(267, 'OID-24JXVR', '', '', '', '106 FELIPE ST. REMARVILLE.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(268, 'OID-59NSTY', '', '', '', '106 FELIPE ST. REMARVILLE.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(269, 'OID-69MURY', '', '', '', '620 INT. CELINA DRIVE', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(270, 'OID-12ZHBE', '', '', '', '620 CELINA DRIVE', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(271, 'OID-73MEDC', '', '', '', 'A-18 DON JULIO GREGORIO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(272, 'OID-75WFJM', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(273, 'OID-94LPKE', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(274, 'OID-43EKSZ', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(275, 'OID-81IKWD', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(276, 'OID-23NKSV', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(277, 'OID-47IWPX', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(278, 'OID-49DUCN', '', '', '', '22 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(279, 'OID-39UZGB', '', '', '', '22 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(280, 'OID-34ZYFH', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(281, 'OID-27BUDP', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(282, 'OID-21MGTL', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(283, 'OID-27ASDG', '', '', '', '21 KATIPUNAN KANAN', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(284, 'OID-48AUTI', '', '', '', 'KATIPUNAN KALIWA', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(285, 'OID-57PQSI', '', '', '', '615 INTO ', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(286, 'OID-56BEFX', '', '', '', 'A-35 DUPAX COMPUND', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(287, 'OID-70DWZC', '', '', '', 'B3 DON JULIO GREGORIO ST.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(288, 'OID-93FGLX', '', '', '', '591 DON JULIO', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(289, 'OID-08XQPF', '', '', '', '13-A DUPAX COMP.', 'BAGBAG', '5', '', '', '', '', '', '', '', '', ''),
(290, 'OID-82DERG', '', '', '', '439 COMP. GREZAR', 'BAGBAG', '5', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `oscya_counseling`
--

CREATE TABLE `oscya_counseling` (
  `id` int(20) NOT NULL,
  `oscya_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lrn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formal` tinyint(1) NOT NULL,
  `informal` tinyint(1) NOT NULL,
  `is_interested` tinyint(1) NOT NULL,
  `is_counseled` tinyint(1) NOT NULL,
  `counsel_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oscya_counseling`
--

INSERT INTO `oscya_counseling` (`id`, `oscya_id`, `lrn`, `teacher_id`, `formal`, `informal`, `is_interested`, `is_counseled`, `counsel_date`) VALUES
(1, 'OID-78XKJT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(2, 'OID-53PJWE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(3, 'OID-71PSKE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(4, 'OID-31PRTU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(5, 'OID-42HTWZ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(6, 'OID-53TNOF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(7, 'OID-24TPZV', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(8, 'OID-89IAVO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(9, 'OID-53DZQN', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(10, 'OID-10OYGT', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(11, 'OID-63RAUJ', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(12, 'OID-21XQOD', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(13, 'OID-74ICXK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(14, 'OID-04JUWH', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(15, 'OID-02REBF', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(16, 'OID-31LCQD', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(17, 'OID-68FGVW', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(18, 'OID-50JZGA', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(19, 'OID-13XEIG', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(20, 'OID-86IKCA', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(21, 'OID-51ASGV', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(22, 'OID-70IVTX', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(23, 'OID-30MNFI', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(24, 'OID-13MUGJ', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(25, 'OID-04HOQF', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(26, 'OID-61EUKR', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(27, 'OID-06OMKE', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(28, 'OID-07VPDL', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(29, 'OID-32XHZO', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(30, 'OID-74CFQW', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(31, 'OID-13XACF', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(32, 'OID-62NZRC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(33, 'OID-97GDIB', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(34, 'OID-46HAWX', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(35, 'OID-09IWEC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(36, 'OID-01UWFS', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(37, 'OID-95SGXD', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(38, 'OID-78GSYL', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(39, 'OID-38PTHA', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(40, 'OID-01ABPE', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(41, 'OID-83QNTC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(42, 'OID-01SXLT', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(43, 'OID-97TZBH', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(44, 'OID-83EJQP', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(45, 'OID-91MBDA', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(46, 'OID-29MIAY', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(47, 'OID-85AUSZ', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(48, 'OID-69YLGF', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(49, 'OID-80DEVU', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(50, 'OID-40FLJI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(51, 'OID-14PDWK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(52, 'OID-60FPXT', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(53, 'OID-46EMFV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(54, 'OID-43RZXK', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(55, 'OID-73ILFH', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(56, 'OID-93NHBM', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(57, 'OID-43UZXK', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(58, 'OID-29KNLC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(59, 'OID-39DPIQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(60, 'OID-78LANS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(61, 'OID-35NPJT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(62, 'OID-01COWV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(63, 'OID-37QSGE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(64, 'OID-03TUPQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(65, 'OID-03YOSZ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(66, 'OID-95CFXP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(67, 'OID-36TZSC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(68, 'OID-60MVQR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(69, 'OID-56JIAW', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(70, 'OID-89XJYS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(71, 'OID-26SENK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(72, 'OID-84OFBQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(73, 'OID-49MQTB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(74, 'OID-32SHAZ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(75, 'OID-87CHXE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(76, 'OID-72CTXS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(77, 'OID-70AZGE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(78, 'OID-12KVCU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(79, 'OID-53HKQW', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(80, 'OID-92GNVD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(81, 'OID-46WTSU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(82, 'OID-96UPYE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(83, 'OID-59AJMV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(84, 'OID-56YDWV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(85, 'OID-94LZJR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(86, 'OID-53JXOY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(87, 'OID-01HFDN', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(88, 'OID-72RCPI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(89, 'OID-38UTHD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(90, 'OID-50VWFS', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(91, 'OID-50DHKZ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(92, 'OID-32EHWD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(93, 'OID-91RGIT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(94, 'OID-53ELOM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(95, 'OID-12YABL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(96, 'OID-94ZCAT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(97, 'OID-97VTWA', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(98, 'OID-61ISVP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(99, 'OID-65GWJV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(100, 'OID-93ZOYA', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(101, 'OID-80SJHP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(102, 'OID-37JOKH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(103, 'OID-68PJST', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(104, 'OID-02JDLP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(105, 'OID-94VUZD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(106, 'OID-12XUCT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(107, 'OID-60ZILQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(108, 'OID-94YDBU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(109, 'OID-85VDLQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(110, 'OID-57KVGT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(111, 'OID-57RTHP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(112, 'OID-57UWAG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(113, 'OID-84AILS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(114, 'OID-30UERH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(115, 'OID-39FOYW', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(116, 'OID-10VZPT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(117, 'OID-50XMFR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(118, 'OID-08PWND', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(119, 'OID-05NLIQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(120, 'OID-82JPAH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(121, 'OID-12FPYJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(122, 'OID-65PCRG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(123, 'OID-54UMEN', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(124, 'OID-52AZKW', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(125, 'OID-57PGJC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(126, 'OID-14VAIH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(127, 'OID-76RLCH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(128, 'OID-13FISP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(129, 'OID-01JMPH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(130, 'OID-03CXUD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(131, 'OID-63IEXD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(132, 'OID-98UNOP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(133, 'OID-65FWXO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(134, 'OID-58ECSR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(135, 'OID-82GIYN', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(136, 'OID-73CDSN', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(137, 'OID-60PKVO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(138, 'OID-28RUKS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(139, 'OID-51CJXQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(140, 'OID-19UMPB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(141, 'OID-61WDJY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(142, 'OID-14XSVZ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(143, 'OID-95SMNK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(144, 'OID-43ADIB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(145, 'OID-87YTUJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(146, 'OID-07UFXQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(147, 'OID-54PMYK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(148, 'OID-50KERP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(149, 'OID-36VCJU', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(150, 'OID-47GCJA', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(151, 'OID-57AQUJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(152, 'OID-80APUO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(153, 'OID-85XFMO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(154, 'OID-96FLYJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(155, 'OID-50CKPI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(156, 'OID-73QFIB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(157, 'OID-75WZHQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(158, 'OID-09ZDQM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(159, 'OID-29LIAF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(160, 'OID-57RHWO', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(161, 'OID-45SCTL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(162, 'OID-64EIZO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(163, 'OID-23VUJM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(164, 'OID-15UGDM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(165, 'OID-82HJWG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(166, 'OID-82CNHB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(167, 'OID-85BMIE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(168, 'OID-96DCRI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(169, 'OID-45NHTV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(170, 'OID-70RKQC', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(171, 'OID-81CEJQ', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(172, 'OID-20DVWM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(173, 'OID-06BUXY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(174, 'OID-07ZRAD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(175, 'OID-90MYQE', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(176, 'OID-12IMVU', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(177, 'OID-72CDPF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(178, 'OID-74KFSP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(179, 'OID-92ABSM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(180, 'OID-07UGIH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(181, 'OID-38TZAR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(182, 'OID-52MTRG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(183, 'OID-79RHZI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(184, 'OID-50GERT', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(185, 'OID-84JRNS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(186, 'OID-79VUAL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(187, 'OID-75LYOI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(188, 'OID-09CBTL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(189, 'OID-54RVBC', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(190, 'OID-75ZXAC', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(191, 'OID-09MXQW', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(192, 'OID-06PCXL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(193, 'OID-37TKLG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(194, 'OID-31WCLH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(195, 'OID-95HSWV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(196, 'OID-64NZXH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(197, 'OID-08RUZJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(198, 'OID-89HXVO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(199, 'OID-37YQGW', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(200, 'OID-14FUMH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(201, 'OID-62DICP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(202, 'OID-08XKEA', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(203, 'OID-39MTQL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(204, 'OID-10OUJP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(205, 'OID-71VAMY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(206, 'OID-79TOFJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(207, 'OID-97ZMWK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(208, 'OID-97YTBS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(209, 'OID-96KAJM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(210, 'OID-06EXNF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(211, 'OID-80RITF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(212, 'OID-93YAEV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(213, 'OID-63SUEV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(214, 'OID-78ATCN', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(215, 'OID-84XHTP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(216, 'OID-12ZWOU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(217, 'OID-53QZUH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(218, 'OID-27NRJK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(219, 'OID-37ANWL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(220, 'OID-80MOSB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(221, 'OID-32JCET', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(222, 'OID-64ASNK', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(223, 'OID-75VUNB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(224, 'OID-95HCTL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(225, 'OID-13SQRU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(226, 'OID-68PRTF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(227, 'OID-41EPRD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(228, 'OID-02JIDP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(229, 'OID-10WUCY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(230, 'OID-38YMTZ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(231, 'OID-30UZAH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(232, 'OID-17JPKU', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(233, 'OID-50EWFP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(234, 'OID-60KCAF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(235, 'OID-81BNEW', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(236, 'OID-74ZFKS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(237, 'OID-18OMUC', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(238, 'OID-13MHLJ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(239, 'OID-57NXPH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(240, 'OID-23VDBQ', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(241, 'OID-71CJXD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(242, 'OID-98HUXD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(243, 'OID-16IJXM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(244, 'OID-59GALR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(245, 'OID-36PJKM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(246, 'OID-35BQCR', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(247, 'OID-81XDMO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(248, 'OID-80UEDI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(249, 'OID-48IMQB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(250, 'OID-43BDIM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(251, 'OID-86GVBH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(252, 'OID-23KNZM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(253, 'OID-41HKOD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(254, 'OID-98HCMO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(255, 'OID-70DUML', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(256, 'OID-08QTOB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(257, 'OID-27YCWO', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(258, 'OID-84QKBY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(259, 'OID-65LMPK', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(260, 'OID-54BQVS', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(261, 'OID-74ESBM', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(262, 'OID-94KALD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(263, 'OID-37WSHA', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(264, 'OID-13HQTF', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(265, 'OID-39PYMS', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(266, 'OID-59MQVE', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(267, 'OID-24JXVR', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(268, 'OID-59NSTY', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(269, 'OID-69MURY', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(270, 'OID-12ZHBE', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(271, 'OID-73MEDC', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(272, 'OID-75WFJM', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(273, 'OID-94LPKE', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(274, 'OID-43EKSZ', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(275, 'OID-81IKWD', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(276, 'OID-23NKSV', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(277, 'OID-47IWPX', '', 'TID-38OCUN', 0, 0, 1, 1, '2021-01-01'),
(278, 'OID-49DUCN', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(279, 'OID-39UZGB', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(280, 'OID-34ZYFH', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(281, 'OID-27BUDP', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(282, 'OID-21MGTL', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(283, 'OID-27ASDG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(284, 'OID-48AUTI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(285, 'OID-57PQSI', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(286, 'OID-56BEFX', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(287, 'OID-70DWZC', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(288, 'OID-93FGLX', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(289, 'OID-08XQPF', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01'),
(290, 'OID-82DERG', '', 'TID-38OCUN', 0, 0, 0, 1, '2021-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `oscya_guardian`
--

CREATE TABLE `oscya_guardian` (
  `id` int(20) NOT NULL,
  `oscya_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oscya_guardian`
--

INSERT INTO `oscya_guardian` (`id`, `oscya_id`, `fullname`, `email`, `contact`, `facebook`) VALUES
(1, 'OID-78XKJT', 'GEORGIA BURAC', '', '9999567287', ''),
(2, 'OID-53PJWE', 'CRISANTA S. JIMENEZ', '', '9700987793', ''),
(3, 'OID-71PSKE', 'MELANIE R. ABALUNA', '', ' ', ''),
(4, 'OID-31PRTU', 'MARIELY ABALUNA', '', '9103199560', ''),
(5, 'OID-42HTWZ', 'MARIELY ABALUNA', '', '9103199560', ''),
(6, 'OID-53TNOF', ' ', '', ' ', ''),
(7, 'OID-24TPZV', 'RAQUEL QUILAPIO', '', ' ', ''),
(8, 'OID-89IAVO', ' ', '', ' ', ''),
(9, 'OID-53DZQN', ' ', '', ' ', ''),
(10, 'OID-10OYGT', 'MARILYN P. SANTILLAN', '', '9701515213', ''),
(11, 'OID-63RAUJ', 'NELSON C. BARTOLAY', '', '929329481', ''),
(12, 'OID-21XQOD', 'MARICAR NAZARENO', '', '9051767023', ''),
(13, 'OID-74ICXK', 'JOHANNA YUKI', '', '9102449547', ''),
(14, 'OID-04JUWH', 'BERNARDIta B. ALODIA', '', '9632281423', ''),
(15, 'OID-02REBF', 'MILAGROS B. ATIENZA', '', '9510763960', ''),
(16, 'OID-31LCQD', 'GLORIA P. DAUBA', '', '92981640553', ''),
(17, 'OID-68FGVW', 'ANNABELLE P. ARANETE', '', '9513330406', ''),
(18, 'OID-50JZGA', 'PRECY DIMACULANAGAN', '', '9098897792', ''),
(19, 'OID-13XEIG', 'MELMA PRADO', '', '9380662691', ''),
(20, 'OID-86IKCA', 'VILMA SAMSON', '', '9706509774', ''),
(21, 'OID-51ASGV', 'VERGELIA T. TALIPING', '', '9286743091', ''),
(22, 'OID-70IVTX', 'VERGELIA T. TALIPING', '', '9286743091', ''),
(23, 'OID-30MNFI', 'VERGELIA T. TALIPING', '', '9286743091', ''),
(24, 'OID-13MUGJ', 'EUFEMIA ARROYO', '', '9103958480', ''),
(25, 'OID-04HOQF', 'MARITA PETILOS', '', '9488610143', ''),
(26, 'OID-61EUKR', 'MELMA PRADO', '', '9380662691', ''),
(27, 'OID-06OMKE', 'EDEN R. VERDIDA', '', '9306645800', ''),
(28, 'OID-07VPDL', 'NENITA NEBRIAGA', '', '9636217952', ''),
(29, 'OID-32XHZO', 'LETICIA SOLLERA', '', '9205337578', ''),
(30, 'OID-74CFQW', 'SHIRLY BIRASES', '', '9606042615', ''),
(31, 'OID-13XACF', 'ARDITA VERACES', '', '9637216623', ''),
(32, 'OID-62NZRC', 'LORNA ACUNA', '', '9606042615', ''),
(33, 'OID-97GDIB', 'OLSAM BARCENILLA', '', '9095451907', ''),
(34, 'OID-46HAWX', 'LOLITA SAMPOANG', '', '9122520641', ''),
(35, 'OID-09IWEC', 'ROSALIE SAMPOANG', '', '9705672561', ''),
(36, 'OID-01UWFS', 'JULIET OSORIO', '', ' ', ''),
(37, 'OID-95SGXD', 'JOSEPHINE PIGA', '', '9633077867', ''),
(38, 'OID-78GSYL', 'ARANOLD TULID', '', '9707815477', ''),
(39, 'OID-38PTHA', 'ROY VILLEAGAS', '', '9700986579', ''),
(40, 'OID-01ABPE', 'GINA ARANETA', '', '93975998711', ''),
(41, 'OID-83QNTC', 'GINA ARANETA', '', '9397578711', ''),
(42, 'OID-01SXLT', 'MARY ANN CRUZ', '', ' ', ''),
(43, 'OID-97TZBH', 'GLORIA DAUBA', '', ' ', ''),
(44, 'OID-83EJQP', 'EVANGELINE PARADO', '', '9338212957', ''),
(45, 'OID-91MBDA', 'LEONIDA DAUBA', '', '9155002097', ''),
(46, 'OID-29MIAY', 'LEONIDA DAUBA', '', '9155002097', ''),
(47, 'OID-85AUSZ', 'MARICAR ARANETA', '', '9488441882', ''),
(48, 'OID-69YLGF', 'ANGELITA REAS', '', '9705659710', ''),
(49, 'OID-80DEVU', 'MERILYN SARMIIENTO', '', '9108109628', ''),
(50, 'OID-40FLJI', 'MILAGROS ATIENZA', '', ' ', ''),
(51, 'OID-14PDWK', 'JONATHAN MANARES', '', ' ', ''),
(52, 'OID-60FPXT', 'ROLDAN ARIOLA', '', ' ', ''),
(53, 'OID-46EMFV', 'CYRENE AZAÑA', '', ' ', ''),
(54, 'OID-43RZXK', 'LUZONIA DUCAY', '', '9219279538', ''),
(55, 'OID-73ILFH', 'ARACELI S. AREJA', '', ' ', ''),
(56, 'OID-93NHBM', 'EDITHA MONTECLARO', '', ' ', ''),
(57, 'OID-43UZXK', 'DEBBIE SANCHEZ', '', ' ', ''),
(58, 'OID-29KNLC', 'RAUL REPRIAL', '', '9955484997', ''),
(59, 'OID-39DPIQ', 'ELIZA C. DURANA', '', '9495653514', ''),
(60, 'OID-78LANS', 'ROWENA S. DELOS SANTOS', '', ' ', ''),
(61, 'OID-35NPJT', 'ROWENA S. DELOS SANTOS', '', ' ', ''),
(62, 'OID-01COWV', 'CLARITA N. BALUYA', '', '9757257310', ''),
(63, 'OID-37QSGE', 'SOL MOLINO MARFIL', '', '9463801986', ''),
(64, 'OID-03TUPQ', 'ROSALINA  NACION', '', ' ', ''),
(65, 'OID-03YOSZ', ' ', '', ' ', ''),
(66, 'OID-95CFXP', 'CYRENE AZAÑA', '', '9105655739', ''),
(67, 'OID-36TZSC', 'DARWIN H. ECHON', '', '9068634571', ''),
(68, 'OID-60MVQR', ' ', '', '9308318916', ''),
(69, 'OID-56JIAW', 'HAZEL ANN CABICO', '', '9072419020', ''),
(70, 'OID-89XJYS', 'RICHARD P. GEPIGA', '', '9511545127', ''),
(71, 'OID-26SENK', 'NOEL BORITO M.', '', '9275740555', ''),
(72, 'OID-84OFBQ', 'MARITES V. TINDOC', '', '9303299320', ''),
(73, 'OID-49MQTB', 'VILMA DIANELA', '', ' ', ''),
(74, 'OID-32SHAZ', 'ELVIRA TALAGTAG', '', '9569981065', ''),
(75, 'OID-87CHXE', ' ', '', ' ', ''),
(76, 'OID-72CTXS', ' ', '', ' ', ''),
(77, 'OID-70AZGE', 'RENIE LUMONTAD', '', '9169167525', ''),
(78, 'OID-12KVCU', 'MICHAEL ALUETA', '', '9122565958', ''),
(79, 'OID-53HKQW', 'OFELIA SUARTO', '', ' ', ''),
(80, 'OID-92GNVD', 'DEBBIE DEFENIO', '', '9070501305', ''),
(81, 'OID-46WTSU', 'DEBBIE DEFENIO', '', '9070501305', ''),
(82, 'OID-96UPYE', 'DEBBIE DEFENIO', '', '9070501305', ''),
(83, 'OID-59AJMV', 'JOSEPHINE AGUILLAR', '', '9632559365', ''),
(84, 'OID-56YDWV', 'MARJORIE AGACAOILI', '', '9107779962', ''),
(85, 'OID-94LZJR', 'BARTOLOME GLORIA', '', ' ', ''),
(86, 'OID-53JXOY', 'ANLAYN NAVALIS', '', '9637389093', ''),
(87, 'OID-01HFDN', 'NIÑA ALBENTO', '', ' ', ''),
(88, 'OID-72RCPI', 'EVANGELINE G. COLUMNA', '', '9300289794', ''),
(89, 'OID-38UTHD', ' ', '', ' ', ''),
(90, 'OID-50VWFS', ' ', '', ' ', ''),
(91, 'OID-50DHKZ', ' ', '', ' ', ''),
(92, 'OID-32EHWD', ' ', '', ' ', ''),
(93, 'OID-91RGIT', ' ', '', ' ', ''),
(94, 'OID-53ELOM', ' ', '', ' ', ''),
(95, 'OID-12YABL', ' ', '', ' ', ''),
(96, 'OID-94ZCAT', ' ', '', ' ', ''),
(97, 'OID-97VTWA', ' ', '', ' ', ''),
(98, 'OID-61ISVP', ' ', '', ' ', ''),
(99, 'OID-65GWJV', 'CYRENE AZAÑA', '', '9105655739', ''),
(100, 'OID-93ZOYA', 'CYRENE AZAÑA', '', '9105655739', ''),
(101, 'OID-80SJHP', 'AIDA LOMOTAN', '', '9155190972', ''),
(102, 'OID-37JOKH', ' ', '', ' ', ''),
(103, 'OID-68PJST', ' ', '', ' ', ''),
(104, 'OID-02JDLP', ' ', '', ' ', ''),
(105, 'OID-94VUZD', ' ', '', ' ', ''),
(106, 'OID-12XUCT', ' ', '', ' ', ''),
(107, 'OID-60ZILQ', 'CRISANTA S. JIMENEZ', '', '9294969352', ''),
(108, 'OID-94YDBU', 'MELANY GONZALES ABALUNA', '', '9509412006', ''),
(109, 'OID-85VDLQ', 'CRISANTA S. JIMENEZ', '', '9489467784', ''),
(110, 'OID-57KVGT', 'SUSAN C. TAYOBA', '', ' ', ''),
(111, 'OID-57RTHP', 'MARY JANE ISON CAMPOS', '', '9972307877', ''),
(112, 'OID-57UWAG', 'CRISANTA S. JIMENEZ', '', '9279484744', ''),
(113, 'OID-84AILS', 'JESSICA ZAMORA', '', '910939564', ''),
(114, 'OID-30UERH', 'SANTOS RAFALLO', '', ' ', ''),
(115, 'OID-39FOYW', 'SANTOS RAFALLO', '', ' ', ''),
(116, 'OID-10VZPT', 'SANTOS RAFALLO', '', ' ', ''),
(117, 'OID-50XMFR', 'RICARDO RUIZ', '', ' ', ''),
(118, 'OID-08PWND', 'RICARDO RUIZ', '', ' ', ''),
(119, 'OID-05NLIQ', ' ', '', ' ', ''),
(120, 'OID-82JPAH', 'RICARDO RUIZ', '', ' ', ''),
(121, 'OID-12FPYJ', 'EVANGELINE PUROG', '', ' ', ''),
(122, 'OID-65PCRG', 'ARACELI CAMBE', '', '9303618239', ''),
(123, 'OID-54UMEN', 'RIZALINA VISCAYNO', '', '9382472177', ''),
(124, 'OID-52AZKW', 'JENNIVIE JUNDIS', '', '9504855528', ''),
(125, 'OID-57PGJC', 'JENALYN PUOD', '', '9556950536', ''),
(126, 'OID-14VAIH', 'JOSEPHINE MANABAT', '', '9569703269', ''),
(127, 'OID-76RLCH', 'JOSEPHINE MANABAT', '', '9569703269', ''),
(128, 'OID-13FISP', 'JOCELYN BAGTAS', '', '9380796413', ''),
(129, 'OID-01JMPH', 'BRIGIDO MANAYAN SR.', '', '9477266289', ''),
(130, 'OID-03CXUD', 'CELY DELOS SANTOS', '', ' ', ''),
(131, 'OID-63IEXD', 'NELSON GARCIA', '', ' ', ''),
(132, 'OID-98UNOP', 'MERCY MERCADO', '', ' ', ''),
(133, 'OID-65FWXO', 'MARJORIE ALANAO', '', ' ', ''),
(134, 'OID-58ECSR', 'CELY DELOS SANTOS', '', ' ', ''),
(135, 'OID-82GIYN', ' ', '', ' ', ''),
(136, 'OID-73CDSN', ' ', '', ' ', ''),
(137, 'OID-60PKVO', 'LETICIA G. RUIZ', '', ' ', ''),
(138, 'OID-28RUKS', ' ', '', ' ', ''),
(139, 'OID-51CJXQ', ' ', '', ' ', ''),
(140, 'OID-19UMPB', ' ', '', ' ', ''),
(141, 'OID-61WDJY', 'BELEN BAGTAS', '', ' ', ''),
(142, 'OID-14XSVZ', 'BELEN BAGTAS', '', ' ', ''),
(143, 'OID-95SMNK', 'SONIA MERCADO', '', ' ', ''),
(144, 'OID-43ADIB', 'MARCELINA DIZON', '', ' ', ''),
(145, 'OID-87YTUJ', ' ', '', ' ', ''),
(146, 'OID-07UFXQ', 'DANILO E. REGOSO', '', ' ', ''),
(147, 'OID-54PMYK', 'MERCIDETA FRANCISCO', '', ' ', ''),
(148, 'OID-50KERP', 'MELANY GONZALES ABALUNA', '', ' ', ''),
(149, 'OID-36VCJU', 'MARIVIC N. VIÑAS', '', '9171389143', ''),
(150, 'OID-47GCJA', 'AVELINA V. TAMBA', '', ' ', ''),
(151, 'OID-57AQUJ', 'JESUS PARUNGAO', '', ' ', ''),
(152, 'OID-80APUO', 'NATIVIDAD BORJA', '', ' ', ''),
(153, 'OID-85XFMO', 'ESTER BARRIENTOS GENERAL', '', '9307362124', ''),
(154, 'OID-96FLYJ', 'VIRGIE MANAYAN', '', '9485324552', ''),
(155, 'OID-50CKPI', 'ROSEMARIE VALERIO', '', '907082445', ''),
(156, 'OID-73QFIB', ' ', '', ' ', ''),
(157, 'OID-75WZHQ', 'MARY JANE OMPACAN', '', ' ', ''),
(158, 'OID-09ZDQM', ' ', '', ' ', ''),
(159, 'OID-29LIAF', 'THELMA CANLAS', '', ' ', ''),
(160, 'OID-57RHWO', ' ', '', ' ', ''),
(161, 'OID-45SCTL', 'MARLENE J. LIMASIACO', '', ' ', ''),
(162, 'OID-64EIZO', 'MIGUELITO JIMENEZ', '', ' ', ''),
(163, 'OID-23VUJM', 'EMILDA A. VINGNO', '', ' ', ''),
(164, 'OID-15UGDM', 'JESSICA LIMSIACO', '', ' ', ''),
(165, 'OID-82HJWG', 'JESSICA LIMSIACO', '', ' ', ''),
(166, 'OID-82CNHB', 'MIGUELITO JIMENEZ', '', ' ', ''),
(167, 'OID-85BMIE', 'CRISANTA S. JIMENEZ', '', ' ', ''),
(168, 'OID-96DCRI', 'MIGUELITO JIMENEZ', '', ' ', ''),
(169, 'OID-45NHTV', 'NENITA RUIZ', '', ' ', ''),
(170, 'OID-70RKQC', 'BELEN NARO', '', '9121899694', ''),
(171, 'OID-81CEJQ', 'BELEN NARO', '', '9108402238', ''),
(172, 'OID-20DVWM', 'LORETA ARQUEROS', '', '912899694', ''),
(173, 'OID-06BUXY', 'JOSEPHINE DRILON', '', '9101855463', ''),
(174, 'OID-07ZRAD', 'BERNADETTE C. ALAYON', '', '9514410401', ''),
(175, 'OID-90MYQE', 'DECEASED', '', ' ', ''),
(176, 'OID-12IMVU', 'LOIDA ORPEZA', '', '9517244587', ''),
(177, 'OID-72CDPF', 'LOIDA ORPEZA', '', '9517244587', ''),
(178, 'OID-74KFSP', 'LOIDA ORPEZA', '', '9517244587', ''),
(179, 'OID-92ABSM', 'LOIDA ORPEZA', '', '9517244587', ''),
(180, 'OID-07UGIH', ' ', '', ' ', ''),
(181, 'OID-38TZAR', 'SAIFRED A. BLACO', '', '9484431109', ''),
(182, 'OID-52MTRG', 'LOVENZA ATABAY', '', '9674630253', ''),
(183, 'OID-79RHZI', 'TESSIE OMADLE', '', ' ', ''),
(184, 'OID-50GERT', 'JULIET C. TRAWAT', '', '9263288400', ''),
(185, 'OID-84JRNS', ' ', '', ' ', ''),
(186, 'OID-79VUAL', ' ', '', ' ', ''),
(187, 'OID-75LYOI', 'MARGERIE C. CHICANO', '', '9318760707', ''),
(188, 'OID-09CBTL', ' ', '', ' ', ''),
(189, 'OID-54RVBC', 'ARMANDO MANANGHAYA', '', '9301007621', ''),
(190, 'OID-75ZXAC', 'CHRISTINA SANCHES BLANCO', '', '9637351469', ''),
(191, 'OID-09MXQW', 'ARMANDO MANANGHAYA', '', '9301007621', ''),
(192, 'OID-06PCXL', ' ', '', ' ', ''),
(193, 'OID-37TKLG', 'ESFER MALLARI', '', ' ', ''),
(194, 'OID-31WCLH', ' ', '', ' ', ''),
(195, 'OID-95HSWV', ' ', '', ' ', ''),
(196, 'OID-64NZXH', 'DECEASED', '', ' ', ''),
(197, 'OID-08RUZJ', 'CHRYSTIAN DAVE C. COYO', '', '9978118680', ''),
(198, 'OID-89HXVO', 'MARY GRACE BRAZAL', '', '9122972939', ''),
(199, 'OID-37YQGW', 'LANI SAUZA', '', ' ', ''),
(200, 'OID-14FUMH', ' ', '', ' ', ''),
(201, 'OID-62DICP', ' ', '', ' ', ''),
(202, 'OID-08XKEA', ' ', '', ' ', ''),
(203, 'OID-39MTQL', ' ', '', ' ', ''),
(204, 'OID-10OUJP', ' ', '', ' ', ''),
(205, 'OID-71VAMY', ' ', '', ' ', ''),
(206, 'OID-79TOFJ', ' ', '', ' ', ''),
(207, 'OID-97ZMWK', ' ', '', ' ', ''),
(208, 'OID-97YTBS', ' ', '', ' ', ''),
(209, 'OID-96KAJM', ' ', '', ' ', ''),
(210, 'OID-06EXNF', ' ', '', ' ', ''),
(211, 'OID-80RITF', ' ', '', ' ', ''),
(212, 'OID-93YAEV', ' ', '', ' ', ''),
(213, 'OID-63SUEV', ' ', '', ' ', ''),
(214, 'OID-78ATCN', ' ', '', ' ', ''),
(215, 'OID-84XHTP', ' ', '', ' ', ''),
(216, 'OID-12ZWOU', ' ', '', ' ', ''),
(217, 'OID-53QZUH', ' ', '', ' ', ''),
(218, 'OID-27NRJK', ' ', '', ' ', ''),
(219, 'OID-37ANWL', ' ', '', ' ', ''),
(220, 'OID-80MOSB', ' ', '', ' ', ''),
(221, 'OID-32JCET', ' ', '', ' ', ''),
(222, 'OID-64ASNK', ' ', '', ' ', ''),
(223, 'OID-75VUNB', ' ', '', ' ', ''),
(224, 'OID-95HCTL', ' ', '', ' ', ''),
(225, 'OID-13SQRU', ' ', '', ' ', ''),
(226, 'OID-68PRTF', ' ', '', ' ', ''),
(227, 'OID-41EPRD', ' ', '', ' ', ''),
(228, 'OID-02JIDP', ' ', '', ' ', ''),
(229, 'OID-10WUCY', ' ', '', ' ', ''),
(230, 'OID-38YMTZ', ' ', '', ' ', ''),
(231, 'OID-30UZAH', ' ', '', ' ', ''),
(232, 'OID-17JPKU', 'MARILYN  D. ABALUNA', '', ' ', ''),
(233, 'OID-50EWFP', ' ', '', ' ', ''),
(234, 'OID-60KCAF', 'RAQUEL QUILAPIO', '', ' ', ''),
(235, 'OID-81BNEW', ' ', '', ' ', ''),
(236, 'OID-74ZFKS', ' ', '', ' ', ''),
(237, 'OID-18OMUC', ' ', '', ' ', ''),
(238, 'OID-13MHLJ', ' ', '', ' ', ''),
(239, 'OID-57NXPH', ' ', '', ' ', ''),
(240, 'OID-23VDBQ', ' ', '', ' ', ''),
(241, 'OID-71CJXD', ' ', '', ' ', ''),
(242, 'OID-98HUXD', ' ', '', ' ', ''),
(243, 'OID-16IJXM', ' ', '', ' ', ''),
(244, 'OID-59GALR', 'CELY FERRER', '', ' ', ''),
(245, 'OID-36PJKM', 'AURELIA GOROSPE', '', ' ', ''),
(246, 'OID-35BQCR', ' ', '', ' ', ''),
(247, 'OID-81XDMO', ' ', '', ' ', ''),
(248, 'OID-80UEDI', 'YSMAEL CANDELARIA', '', ' ', ''),
(249, 'OID-48IMQB', 'EVA MANANGHAYA', '', '9638960361', ''),
(250, 'OID-43BDIM', 'ISABELITA BLACO', '', '9638456893', ''),
(251, 'OID-86GVBH', 'MARICAR NAZARENO', '', '9614870203', ''),
(252, 'OID-23KNZM', 'ANDREA FABLO', '', '9614870203', ''),
(253, 'OID-41HKOD', ' ', '', ' ', ''),
(254, 'OID-98HCMO', ' ', '', ' ', ''),
(255, 'OID-70DUML', 'REGINA A. PIAMONTE', '', '9091319755', ''),
(256, 'OID-08QTOB', 'ERLINDA BARRIOS GELEN', '', ' ', ''),
(257, 'OID-27YCWO', ' ', '', ' ', ''),
(258, 'OID-84QKBY', 'REGINA A. PIAMONTE', '', ' ', ''),
(259, 'OID-65LMPK', 'HASMINE ANDUYO', '', ' ', ''),
(260, 'OID-54BQVS', ' ', '', ' ', ''),
(261, 'OID-74ESBM', 'ROSE ACILLYN M. BAYANI', '', '9694765351', ''),
(262, 'OID-94KALD', ' ', '', '9380645988', ''),
(263, 'OID-37WSHA', 'MARICAR DE DIOS', '', '9260798637', ''),
(264, 'OID-13HQTF', ' ', '', ' ', ''),
(265, 'OID-39PYMS', 'ERIC E. FELIPE', '', '95520785662', ''),
(266, 'OID-59MQVE', 'VANGIE G. VELEZ', '', '9317911596', ''),
(267, 'OID-24JXVR', 'MA. ANGELICA FELIPE', '', '9274788737', ''),
(268, 'OID-59NSTY', 'LETICIA E. FELIPE', '', '9095438728', ''),
(269, 'OID-69MURY', ' ', '', ' ', ''),
(270, 'OID-12ZHBE', 'DOLORES DELA CRUZ', '', ' ', ''),
(271, 'OID-73MEDC', 'LETICIA T. FEDILUS', '', '9460218345', ''),
(272, 'OID-75WFJM', ' ', '', ' ', ''),
(273, 'OID-94LPKE', ' ', '', ' ', ''),
(274, 'OID-43EKSZ', ' ', '', ' ', ''),
(275, 'OID-81IKWD', 'MARIO F. DE DIOS', '', '9511504636', ''),
(276, 'OID-23NKSV', 'LEONIDA BABINA', '', '9511504636', ''),
(277, 'OID-47IWPX', ' ', '', '9511504636', ''),
(278, 'OID-49DUCN', 'LEONIDA B. VERA', '', '9380799254', ''),
(279, 'OID-39UZGB', 'LEONIDA B. VERA', '', '9380799254', ''),
(280, 'OID-34ZYFH', ' ', '', ' ', ''),
(281, 'OID-27BUDP', ' ', '', ' ', ''),
(282, 'OID-21MGTL', 'RAYNALDO BRIZO', '', ' ', ''),
(283, 'OID-27ASDG', ' ', '', ' ', ''),
(284, 'OID-48AUTI', 'DOMINGO ODONES', '', ' ', ''),
(285, 'OID-57PQSI', 'KAREN PINTO', '', '932559463', ''),
(286, 'OID-56BEFX', 'JOANNA ROSE BARRETO', '', ' ', ''),
(287, 'OID-70DWZC', 'JANINE LAGARAS', '', '9514579945', ''),
(288, 'OID-93FGLX', 'LANY SANTOS MARASIGAN', '', ' ', ''),
(289, 'OID-08XQPF', 'ELORNA B. PASCUA', '', '9104003902', ''),
(290, 'OID-82DERG', 'MANUEL BA. SANTOS', '', ' ', '');

-- --------------------------------------------------------

--
-- Table structure for table `oscya_info`
--

CREATE TABLE `oscya_info` (
  `id` int(20) NOT NULL,
  `oscya_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `civil_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oscya_info`
--

INSERT INTO `oscya_info` (`id`, `oscya_id`, `lastname`, `firstname`, `middlename`, `extension`, `fullname`, `birthdate`, `age`, `gender`, `civil_status`, `religion`) VALUES
(1, 'OID-78XKJT', 'BURAC', 'JERICHO', '', '', 'BURAC, JERICHO  ', '1999-12-28', 21, 'MALE', 'SINGLE', 'DATING DAAN'),
(2, 'OID-53PJWE', '', '', '', '', 'JIMENEZ, ANGEL SUYOD', '2002-02-20', 19, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(3, 'OID-71PSKE', '', '', '', '', 'RABAGO, CARLO ABALUNA', '1994-09-02', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(4, 'OID-31PRTU', '', '', '', '', 'ABALUNA, CARLA MAE GONZALES', '1996-08-21', 25, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(5, 'OID-42HTWZ', '', '', '', '', 'ABALUNA, JENNICA ANN GONZALES', '1998-01-10', 24, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(6, 'OID-53TNOF', '', '', '', '', 'BARCENAL, JOHN VINCENT N/A', '2005-02-28', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(7, 'OID-24TPZV', '', '', '', '', 'QUILAPIO, CARL ASHLY N/A', '2005-11-18', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(8, 'OID-89IAVO', '', '', '', '', 'JABAT, CHRISTELLE JAYE', '2004-04-25', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(9, 'OID-53DZQN', '', '', '', '', 'DEL MUNDO, VADERICK N/A', '2006-03-11', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(10, 'OID-10OYGT', '', '', '', '', 'SANTILLAN, REYNALYN PALAJE', '2000-01-08', 21, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(11, 'OID-63RAUJ', '', '', '', '', 'BARTOLAY, ANDREA BULOSAN', '1969-12-31', 21, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(12, 'OID-21XQOD', '', '', '', '', 'SONON, MICHAEL N.', '2005-10-09', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(13, 'OID-74ICXK', '', '', '', '', 'DE GUZMAN, NELSON YUKI', '2003-10-15', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(14, 'OID-04JUWH', '', '', '', '', 'ALODIA, RENATO BABASA', '2000-03-06', 21, 'MALE', 'SINGLE', 'CATHOLIC'),
(15, 'OID-02REBF', '', '', '', '', 'ATIENZA, ALONA BAUTISTA', '1969-12-31', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(16, 'OID-31LCQD', '', '', '', '', 'DAUBA, JESSICA PIGA', '1991-12-05', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(17, 'OID-68FGVW', '', '', '', '', 'ARANETA, ANAFHE PEGA', '1993-03-21', 28, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(18, 'OID-50JZGA', '', '', '', '', 'MANARES, RAZEL ARELLADO', '1993-10-21', 28, 'FEMALE', 'MARRIED', 'CHRISTIAN'),
(19, 'OID-13XEIG', '', '', '', '', 'PRADO, KRISHA MAY GARCIA', '1998-10-18', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(20, 'OID-86IKCA', '', '', '', '', 'SAMSON, APRIL ROSE', '1969-12-31', 25, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(21, 'OID-51ASGV', '', '', '', '', 'TALIPING, DENNIS TEMPLADO', '1991-12-07', 30, 'MALE', 'SINGLE', 'CATHOLIC'),
(22, 'OID-70IVTX', '', '', '', '', 'TALIPING,EDWARDO TEMPLADO', '2001-12-11', 24, 'MALE', 'SINGLE', 'CATHOLIC'),
(23, 'OID-30MNFI', '', '', '', '', 'TALIPING, JONATHAN TEMPLADO', '1996-03-07', 25, 'MALE', 'SINGLE', 'CATHOLIC'),
(24, 'OID-13MUGJ', '', '', '', '', 'CAPARIÑO, ARMIA ARROYO', '1995-04-25', 26, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(25, 'OID-04HOQF', '', '', '', '', 'PETILOS, JONALYN DE GUINIO', '1992-10-08', 29, 'FEMALE', 'SINGLE', 'BORN AGAIN'),
(26, 'OID-61EUKR', '', '', '', '', 'PRADO, BEVERLY GARCIA', '1998-10-18', 26, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(27, 'OID-06OMKE', '', '', '', '', 'VERDIDA, JECIELICA RETOBADO', '1994-10-21', 27, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(28, 'OID-07VPDL', '', '', '', '', 'NEBRIAGA, SHIELAMER CATILLO', '1996-07-18', 25, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(29, 'OID-32XHZO', '', '', '', '', 'BOHOL,APRILYN PAHID', '1992-04-19', 29, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(30, 'OID-74CFQW', '', '', '', '', 'BIRASES, LEONORA BARRO', '1992-02-23', 29, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(31, 'OID-13XACF', '', '', '', '', 'LANGUIDO, JOSIE VERACES', '1994-09-16', 27, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(32, 'OID-62NZRC', '', '', '', '', 'ACUNA, ROSALYN DELANA', '2001-06-22', 20, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(33, 'OID-97GDIB', '', '', '', '', 'BARCENILLA, THOMAS HACA', '2001-06-26', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(34, 'OID-46HAWX', '', '', '', '', 'SAMPOANG, LOREN ETANG', '1991-07-09', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(35, 'OID-09IWEC', '', '', '', '', 'LANUZA, ROSENELIT SAMPOANG', '1999-04-30', 21, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(36, 'OID-01UWFS', '', '', '', '', 'LANUZA, JOHN DAVE YU', '2003-06-15', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(37, 'OID-95SGXD', '', '', '', '', 'ALA, JOINA LIBOT', '1998-12-09', 21, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(38, 'OID-78GSYL', '', '', '', '', 'TULID, ARIEL MALASARTE', '1994-10-31', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(39, 'OID-38PTHA', '', '', '', '', 'VILLEGAS, JOAN APUNDAR', '1998-07-04', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(40, 'OID-01ABPE', '', '', '', '', 'ARANETA, SHEILA MAE YANSON', '1995-09-24', 26, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(41, 'OID-83QNTC', '', '', '', '', 'ARANETA, CHERRY ANN YANSON', '1996-12-13', 24, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(42, 'OID-01SXLT', '', '', '', '', 'CRUZ, ALENE', '1969-12-31', 20, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(43, 'OID-97TZBH', '', '', '', '', 'DAUBA, JESSIC PIGA', '1992-12-05', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(44, 'OID-83EJQP', '', '', '', '', 'BAISAC, HONEY MAE MANALANG ', '1993-07-28', 28, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(45, 'OID-91MBDA', '', '', '', '', 'DAUBA, ANGELO ABANES', '1998-07-21', 23, 'MALE', 'SINGLE', 'CATHOLIC'),
(46, 'OID-29MIAY', '', '', '', '', 'DAUBA, CIELO ABANES', '1997-07-04', 24, 'MALE', 'SINGLE', 'CATHOLIC'),
(47, 'OID-85AUSZ', '', '', '', '', 'ARANETA, MARICAR MAHINAY', '1994-06-07', 27, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(48, 'OID-69YLGF', '', '', '', '', 'REAS, JENNIFER DELA CRUZ', '1997-09-13', 24, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(49, 'OID-80DEVU', '', '', '', '', 'SARMIENTO, ANGELIKA LERIOS', '1998-03-25', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(50, 'OID-40FLJI', '', '', '', '', 'OCAMPO, LOUICITO ATIENZA', '2001-01-06', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(51, 'OID-14PDWK', '', '', '', '', 'MANARES, BON PADIOS', '1994-04-30', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(52, 'OID-60FPXT', '', '', '', '', 'ESTANGCO, RIZA', '1969-12-31', 21, 'FEMALE', 'SINGLE', 'BORN AGAIN'),
(53, 'OID-46EMFV', '', '', '', '', 'AZAÑA,RICO IAN RUIZ', '1998-01-08', 23, 'MALE', 'SINGLE', 'CATHOLIC'),
(54, 'OID-43RZXK', '', '', '', '', 'DUCAY, ROMMEL SERAFICA', '2004-09-30', 17, 'MALE', 'SINGLE', 'I.N.C.'),
(55, 'OID-73ILFH', '', '', '', '', 'AREJA, AJ TIM SANTOS', '2004-10-11', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(56, 'OID-93NHBM', '', '', '', '', 'MONTECLARO, DANIEL BORITO', '2006-10-11', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(57, 'OID-43UZXK', '', '', '', '', 'TANIO , WELFREDO PA-AS', '1994-11-04', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(58, 'OID-29KNLC', '', '', '', '', 'DE JESUS, ROSE ANN ', '2001-10-29', 21, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(59, 'OID-39DPIQ', '', '', '', '', 'DURANA, JHONMAR CARIASO', '2007-12-16', 14, 'MALE', 'SINGLE', 'CATHOLIC'),
(60, 'OID-78LANS', '', '', '', '', 'DELOS, SANTOS SALUNDAGA', '2006-10-20', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(61, 'OID-35NPJT', '', '', '', '', 'DELOS, SANTOS ANTHONY LEI SALUNDAGA', '1969-12-31', 14, 'MALE', 'SINGLE', 'CATHOLIC'),
(62, 'OID-01COWV', '', '', '', '', 'BALUYA, CT AGUILAR', '2005-09-11', 16, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(63, 'OID-37QSGE', '', '', '', '', 'CATLI, JHON ALBERT BERMAS', '2003-09-28', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(64, 'OID-03TUPQ', '', '', '', '', 'FELIPE, ROSALYN NACION', '1997-10-12', 25, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(65, 'OID-03YOSZ', '', '', '', '', 'SOLO, MARILYN DENULAN', '1969-12-31', 55, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(66, 'OID-95CFXP', '', '', '', '', 'AZAÑA, KRISTINE RUIZ', '1991-03-17', 30, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(67, 'OID-36TZSC', '', '', '', '', 'ECHON, DAN JERRICK MALLARI', '1969-12-31', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(68, 'OID-60MVQR', '', '', '', '', 'GARCIA, ANNALYN', '1977-06-17', 44, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(69, 'OID-56JIAW', '', '', '', '', 'CAPARAS RACHELL ANN MARIANO ', '1993-02-26', 28, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(70, 'OID-89XJYS', '', '', '', '', 'GEPIGA, KERVIE VALENZUELA', '2006-05-27', 15, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(71, 'OID-26SENK', '', '', '', '', 'NARRIDO, PATRICIA MORALES', '1999-10-16', 22, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(72, 'OID-84OFBQ', '', '', '', '', 'TINDOC, ANA MARIE VALENZUELA', '2000-08-25', 21, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(73, 'OID-49MQTB', '', '', '', '', 'DIANELA, VINCENT TALJA', '1998-03-28', 23, 'MALE', 'SINGLE', 'CATHOLIC'),
(74, 'OID-32SHAZ', '', '', '', '', 'TALAGTAG, CIARA PAPA', '1998-06-24', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(75, 'OID-87CHXE', '', '', '', '', 'HERNANDEZ, ALBERT PELEGARIA', '1965-03-09', 56, 'MALE', 'SINGLE', 'CATHOLIC'),
(76, 'OID-72CTXS', '', '', '', '', 'ABALUNA, MARIELY GONZALES', '1969-12-31', 40, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(77, 'OID-70AZGE', '', '', '', '', 'HIZO, JUZEPER', '2007-03-04', 15, 'MALE', 'SINGLE', 'INC'),
(78, 'OID-12KVCU', '', '', '', '', 'ALUETA, JOHN MICHAEL BEJOSANO', '1969-12-31', 14, 'MALE', 'SINGLE', 'CATHOLIC'),
(79, 'OID-53HKQW', '', '', '', '', 'VIOLADO, EDLDYMAR SUARTO', '2004-09-29', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(80, 'OID-92GNVD', '', '', '', '', 'SEGUI, CARLO D.', '2000-10-10', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(81, 'OID-46WTSU', '', '', '', '', 'SEGUI, JOSHUA', '2004-09-23', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(82, 'OID-96UPYE', '', '', '', '', 'SEGUI, CARREL D.', '2006-10-10', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(83, 'OID-59AJMV', '', '', '', '', 'BEJOSANO, RINNOEL JOHN AGUILLAR', '2002-04-22', 17, 'MALE', 'SINGLE', ' '),
(84, 'OID-56YDWV', '', '', '', '', 'TOLENTINO, DAN MAR AGACAOILI', '2010-09-10', 12, 'MALE', 'SINGLE', 'CATHOLIC'),
(85, 'OID-94LZJR', '', '', '', '', 'GLORIA, JOSEPH LUBAY', '2009-09-30', 12, 'MALE', 'SINGLE', 'CATHOLIC'),
(86, 'OID-53JXOY', '', '', '', '', 'NVALIS, JAYSON JETAJOBE', '2001-08-06', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(87, 'OID-01HFDN', '', '', '', '', 'CABUAG, ERICA ALBENTO', '2003-11-08', 16, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(88, 'OID-72RCPI', '', '', '', '', 'LOPING, ORLANDO GALVEZ', '2007-10-10', 15, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(89, 'OID-38UTHD', '', '', '', '', 'AZAÑA, CYRENE RUIZ', '1964-01-26', 58, 'FEMALE', 'WIDOW', 'CATHOLIC'),
(90, 'OID-50VWFS', '', '', '', '', 'REAZON, LILIA JAMERO', '1975-03-05', 46, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(91, 'OID-50DHKZ', '', '', '', '', 'DURAN, MELISSA RUIZ', '1981-06-24', 40, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(92, 'OID-32EHWD', '', '', '', '', 'RUIZ, ROSARIO CABAÑA', '1958-01-13', 64, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(93, 'OID-91RGIT', '', '', '', '', 'DELA CRUZ, JOSEPHINE BUENVENIDA', '1968-11-11', 57, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(94, 'OID-53ELOM', '', '', '', '', 'CAMPANIA, MA. PURITA SAYSON', '1959-09-04', 62, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(95, 'OID-12YABL', '', '', '', '', 'ILANAN, CEDELIO CAÑEGA', '1995-04-18', 26, 'MALE', 'SINGLE', 'CATHOLIC'),
(96, 'OID-94ZCAT', '', '', '', '', 'BULLOS, LIONHY ABUNDO', '1972-03-22', 50, 'FEMALE', 'WIDOW', 'CATHOLIC'),
(97, 'OID-97VTWA', '', '', '', '', 'NADALA, ARNEL AVELINO', '1978-09-17', 43, 'MALE', 'SINGLE', 'CATHOLIC'),
(98, 'OID-61ISVP', '', '', '', '', 'MALIGASA, SALVE OGALESCO', '1956-12-29', 65, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(99, 'OID-65GWJV', '', '', '', '', 'AZAÑA, RAYMOND RUIZ', '1986-11-05', 35, 'MALE', 'SINGLE', 'CATHOLIC'),
(100, 'OID-93ZOYA', '', '', '', '', 'AZAÑA, CHRISTIAN RUIZ', '1989-12-06', 32, 'MALE', 'SINGLE', 'CATHOLIC'),
(101, 'OID-80SJHP', '', '', '', '', 'LOMOTAN, JERVY DE GUZMAN', '1969-12-31', 32, 'MALE', 'MARRIED', 'CATHOLIC'),
(102, 'OID-37JOKH', '', '', '', '', 'NAVALES, LANIE BAYOTAS', '1969-12-31', 37, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(103, 'OID-68PJST', '', '', '', '', 'RUIZ, LAURO RECTO', '1967-09-26', 55, 'MALE', 'SINGLE', 'CATHOLIC'),
(104, 'OID-02JDLP', '', '', '', '', 'PASACAY, REBECCA RUIZ', '1957-12-09', 64, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(105, 'OID-94VUZD', '', '', '', '', 'FAMINIAL, LIGAYA RABE', '1961-11-05', 60, 'FEMALE', 'WIDOW', 'CATHOLIC'),
(106, 'OID-12XUCT', '', '', '', '', 'PASACAY, BENITO  RODAVIA', '1957-01-07', 65, 'MALE', 'MARRIED', 'CATHOLIC'),
(107, 'OID-60ZILQ', '', '', '', '', 'JIMENEZ, ANGEL SUYOD', '2002-02-20', 19, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(108, 'OID-94YDBU', '', '', '', '', 'RABAGO, JOHN CARLO ABALUNA', '1994-09-02', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(109, 'OID-85VDLQ', '', '', '', '', 'JIMENEZ, JOHN PAUL SUYOD', '1998-10-16', 24, 'MALE', 'SINGLE', 'CATHOLIC'),
(110, 'OID-57KVGT', '', '', '', '', 'CAPUTOL, JOHN REYQUINCO', '1998-11-25', 23, 'MALE', 'SINGLE', 'CATHOLIC'),
(111, 'OID-57RTHP', '', '', '', '', 'CAMPOS, NOTCIE ISON', '1994-10-05', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(112, 'OID-57UWAG', '', '', '', '', 'JIMENEZ, JAN MICHAEL SUYOD', '1995-01-04', 26, 'MALE', 'SINGLE', 'CATHOLIC'),
(113, 'OID-84AILS', '', '', '', '', 'ZAMORA, JESSIE JOHN LIMGIACO', '1995-08-19', 26, 'MALE', 'SINGLE', 'CATHOLIC'),
(114, 'OID-30UERH', '', '', '', '', 'RAFALLO, CELINA JACABAN', '1971-01-01', 51, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(115, 'OID-39FOYW', '', '', '', '', 'RAFALLO, RANDY JACABAN', '1981-01-21', 41, 'MALE', 'SINGLE', 'CATHOLIC'),
(116, 'OID-10VZPT', '', '', '', '', 'RAFALLO, SHARONA JACABAN', '1983-02-06', 40, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(117, 'OID-50XMFR', '', '', '', '', 'RUIZ, RUEL GAMORA', '1980-12-02', 42, 'MALE', 'SINGLE', 'CATHOLIC'),
(118, 'OID-08PWND', '', '', '', '', 'RUIZ, ALVIN GAMORA', '1992-10-23', 29, 'MALE', 'SINGLE', 'CATHOLIC'),
(119, 'OID-05NLIQ', '', '', '', '', 'RUIZ, LETICIA GAMORA', '1953-10-28', 68, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(120, 'OID-82JPAH', '', '', '', '', 'RUIZ, RODEL GAMORA', '1996-12-07', 25, 'MALE', 'SINGLE', 'CATHOLIC'),
(121, 'OID-12FPYJ', '', '', '', '', 'MILITANTE, CHRISTIAN PUROG', '1979-04-24', 42, 'MALE', 'MARRIED', 'CATHOLIC'),
(122, 'OID-65PCRG', '', '', '', '', 'CAMBE, NEWTON BEJOSANO', '2003-11-15', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(123, 'OID-54UMEN', '', '', '', '', 'VISCAYNO, ANDREA HART SANCHEZ', '2002-02-14', 20, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(124, 'OID-52AZKW', '', '', '', '', 'JUNDIS, FELIX JOHN ANTIPASADO', '1992-03-27', 29, 'MALE', 'SINGLE', 'CATHOLIC'),
(125, 'OID-57PGJC', '', '', '', '', 'PUOD, JULIAN MAE', '2005-03-31', 16, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(126, 'OID-14VAIH', '', '', '', '', 'COCJIN, JOEY MANABAT', '2007-01-14', 15, 'MALE', 'LIVE IN PA', 'CATHOLIC'),
(127, 'OID-76RLCH', '', '', '', '', 'MANABAT, MARK LESTER DULDULAO', '2003-09-11', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(128, 'OID-13FISP', '', '', '', '', 'BAGTAS, JOHN EDWARD', '2003-09-02', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(129, 'OID-01JMPH', '', '', '', '', 'MANAYAN, BRIGIDO JR. SAN JUAN', '1983-02-03', 39, 'MALE', 'SINGLE', 'CATHOLIC'),
(130, 'OID-03CXUD', '', '', '', '', 'ALANO, DENNIS DELOS SANTOS', '1969-12-31', 30, 'MALE', 'SINGLE', 'CATHOLIC'),
(131, 'OID-63IEXD', '', '', '', '', 'GARCIA, JAYNIEL ASTILLERO', '1969-12-31', 26, 'MALE', 'SINGLE', 'CATHOLIC'),
(132, 'OID-98UNOP', '', '', '', '', 'MERCADO, JOHN MARICK TAMAYO', '1993-09-05', 28, 'MALE', 'SINGLE', 'CATHOLIC'),
(133, 'OID-65FWXO', '', '', '', '', 'DELOS SANTOS, MARY GRACE ALANO', '1969-12-31', 26, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(134, 'OID-58ECSR', '', '', '', '', 'ALANO, MARJORIE', '1993-10-11', 29, 'MALE', 'SINGLE', 'CATHOLIC'),
(135, 'OID-82GIYN', '', '', '', '', 'CONSOLACION, AUGUSTINA OLASIMAN', '1972-08-03', 44, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(136, 'OID-73CDSN', '', '', '', '', 'MARIÑO, FLORDELIZA SENCIO', '1966-04-08', 55, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(137, 'OID-60PKVO', '', '', '', '', 'RUIZ, RCIHARD GAMORA', '1985-12-29', 35, 'MALE', 'SINGLE', 'CATHOLIC'),
(138, 'OID-28RUKS', '', '', '', '', 'BERGANTIN, MA. LOURDES DELA CRUZ', '1968-11-12', 53, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(139, 'OID-51CJXQ', '', '', '', '', 'ANTENDIDO, CARMELITA JOSE', '1959-07-05', 63, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(140, 'OID-19UMPB', '', '', '', '', 'MANAYAN, VIRGIE  AMADEO', '1959-02-06', 65, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(141, 'OID-61WDJY', '', '', '', '', 'BAGTAS, NIMFA', '1991-04-11', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(142, 'OID-14XSVZ', '', '', '', '', 'MERCADO, ROXANNE BAGTAS', '1969-12-31', 39, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(143, 'OID-95SMNK', '', '', '', '', 'MERCDO, ERNEST', '1969-12-31', 29, 'MALE', 'MARRIED', 'CATHOLIC'),
(144, 'OID-43ADIB', '', '', '', '', 'DIZON, FLORANTE MAURE', '1977-12-07', 44, 'MALE', 'SINGLE', 'CATHOLIC'),
(145, 'OID-87YTUJ', '', '', '', '', 'ZULUETA,DANIEL BANAL', '1990-03-31', 31, 'MALE', 'MARRIED', 'CATHOLIC'),
(146, 'OID-07UFXQ', '', '', '', '', 'REGOSO, JERICHO E.', '2006-09-13', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(147, 'OID-54PMYK', '', '', '', '', 'FRANCISCO, PRINCE JOHN SALVADOR', '2001-08-05', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(148, 'OID-50KERP', '', '', '', '', 'REGOSO, JOHN NIEL ABALUNA', '2004-06-06', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(149, 'OID-36VCJU', '', '', '', '', 'VIÑAS, OZZYBHER NARTATES', '2005-06-21', 17, 'MALE ', 'SINGLE', 'CATHOLIC'),
(150, 'OID-47GCJA', '', '', '', '', 'TAMBA, JONATHAN VALLEDO', '1970-09-05', 51, 'MALE', 'SINGLE', 'CATHOLIC'),
(151, 'OID-57AQUJ', '', '', '', '', 'PARUNGAO, ANALYN MONTERO', '1995-11-03', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(152, 'OID-80APUO', '', '', '', '', 'BORJA, DENNIS BORJA', '1969-12-31', 21, 'MALE ', 'SINGLE', 'CATHOLIC'),
(153, 'OID-85XFMO', '', '', '', '', 'GENERAL, JAY BARRIENTOS', '1969-12-31', 24, 'MALE', 'SINGLE', 'CATHOLIC'),
(154, 'OID-96FLYJ', '', '', '', '', 'GERONIMO, ROSALIA AMDEO', '1978-11-25', 44, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(155, 'OID-50CKPI', '', '', '', '', 'VALERIO, ANGELLE CAPILADOR', '2003-02-03', 18, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(156, 'OID-73QFIB', '', '', '', '', 'JUAB, FATIMA ORIAS', '1993-05-13', 29, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(157, 'OID-75WZHQ', '', '', '', '', 'OMPACAN, JHOMAR BUENAFLOR', '1994-07-17', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(158, 'OID-09ZDQM', '', '', '', '', 'CALIGNER, KENZO DOBLE', '1994-04-04', 28, 'MALE', 'SINGLE', 'CATHOLIC'),
(159, 'OID-29LIAF', '', '', '', '', 'DELA CRUZ, DAISY JAMES ABOGADO', '1995-01-01', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(160, 'OID-57RHWO', '', '', '', '', 'SUMATRA, MARJORIE BALDECASA', '2002-09-09', 20, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(161, 'OID-45SCTL', '', '', '', '', 'LIMSIACO, JESSICA JIMENEZ', '1969-12-31', 51, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(162, 'OID-64EIZO', '', '', '', '', 'JIMENEZ, ALJUN SUYOD', '1991-05-12', 30, 'MALE', 'SINGLE', 'CATHOLIC'),
(163, 'OID-23VUJM', '', '', '', '', 'DIYINAGRASYA, MARY JOY ALILAIN', '1996-09-22', 25, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(164, 'OID-15UGDM', '', '', '', '', 'ZAMORA, JOJIE LIMSIACO', '1992-04-20', 29, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(165, 'OID-82HJWG', '', '', '', '', 'ZAMORA, JENALYN LIMSIACO', '1993-04-07', 28, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(166, 'OID-82CNHB', '', '', '', '', 'JIMENEZ, CRISANTA SUYOD', '1978-12-13', 43, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(167, 'OID-85BMIE', '', '', '', '', 'EUSTAQUIO JEROME JIMENEZ', '2005-08-23', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(168, 'OID-96DCRI', '', '', '', '', 'JIMENEZ, LEAH SUYOD', '1981-12-12', 40, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(169, 'OID-45NHTV', '', '', '', '', 'RUIZ, CHRISTINA DEQUIROS', '1989-02-02', 33, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(170, 'OID-70RKQC', '', '', '', '', 'NARO, GEMALYN SEBLERO', '1998-11-25', 22, 'FEMALE', 'LIVE IN ', 'CATHOLIC'),
(171, 'OID-81CEJQ', '', '', '', '', 'SEBLERO, GERLVIN FRISVALLES', '1997-05-22', 25, 'MALE', 'SINGLE', 'CATHOLIC'),
(172, 'OID-20DVWM', '', '', '', '', 'ARQUEROS, HAIDEE BELLO', '1969-11-05', 53, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(173, 'OID-06BUXY', '', '', '', '', 'DRILON, LEANDRO CLARAVAL', '2006-03-08', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(174, 'OID-07ZRAD', '', '', '', '', 'ALAYON, MARC DANIEL CORTEZ', '2003-04-04', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(175, 'OID-90MYQE', '', '', '', '', 'MANGALINDAN, JUDITH LAS PINAS', '1968-09-27', 53, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(176, 'OID-12IMVU', '', '', '', '', 'ORPEZA, JULIE ANN DURIAN', '2001-11-19', 20, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(177, 'OID-72CDPF', '', '', '', '', 'MARCOSO, EDUARDO GLORIANTIE', '1998-10-05', 24, 'MALE', 'SINGLE', 'CATHOLIC'),
(178, 'OID-74KFSP', '', '', '', '', 'ORPEZA, JOHNY DURIAN ', '1999-06-23', 23, 'MALE', 'SINGLE', 'CATHOLIC'),
(179, 'OID-92ABSM', '', '', '', '', 'ORPEZA, LESLIE SORIO', '1972-11-19', 49, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(180, 'OID-07UGIH', '', '', '', '', 'TADEO, JOHN ALLEY', '2007-08-13', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(181, 'OID-38TZAR', '', '', '', '', 'DEL PACO, ANGELICA SAMANIEGO', '1998-10-22', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(182, 'OID-52MTRG', '', '', '', '', 'SALVADOR, CARMELA VALENZUELA', '2004-11-23', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(183, 'OID-79RHZI', '', '', '', '', 'ADVINCULA, KRISTIN JOY MANANGHAYA', '2006-10-17', 15, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(184, 'OID-50GERT', '', '', '', '', 'RAWAT, ALLAN CAREON JR.', '2006-07-04', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(185, 'OID-84JRNS', '', '', '', '', 'TOLENTINO, DARIUS JAMES', '2001-06-23', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(186, 'OID-79VUAL', '', '', '', '', 'MARAYA, MARK ANTHONY', '2002-03-16', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(187, 'OID-75LYOI', '', '', '', '', 'CHICANO JR, REYNALDO CABARAL', '1995-01-13', 27, 'MALE', 'SINGLE', 'CATHOLIC'),
(188, 'OID-09CBTL', '', '', '', '', 'BAGA, ELVIRA, BRIDNES', '1978-07-01', 42, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(189, 'OID-54RVBC', '', '', '', '', 'MANANGHALA, ALAYSA HAMBRE', '1995-09-10', 26, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(190, 'OID-75ZXAC', '', '', '', '', 'BLANCO, JUDY ANN PEREZ', '1998-09-05', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(191, 'OID-09MXQW', '', '', '', '', 'MANANGHAYA, JOHN ARMAN MAMBRE', '1998-06-25', 23, 'MALE', 'SINGLE', 'CATHOLIC'),
(192, 'OID-06PCXL', '', '', '', '', 'VILLASENCIO, JAMAICA N/A', '2006-06-23', 15, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(193, 'OID-37TKLG', '', '', '', '', 'SAMSON, RUBY MALLARI', '1972-06-11', 50, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(194, 'OID-31WCLH', '', '', '', '', 'DIAZ, JOHANNE ANGELO SEROJANO', '1998-10-18', 23, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(195, 'OID-95HSWV', '', '', '', '', 'NAZARENO, JOMAR ESCOPE', '1999-07-29', 22, 'MALE', 'SINGLE', 'CATHOLIC'),
(196, 'OID-64NZXH', '', '', '', '', 'GAVINO, MA. THERESA CAJANDAB', '1978-05-04', 44, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(197, 'OID-08RUZJ', '', '', '', '', 'COYO, ELMER CANIPE JR', '2006-01-25', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(198, 'OID-89HXVO', '', '', '', '', 'BERTE, MHARIELLA BRAZAL', '2005-04-16', 16, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(199, 'OID-37YQGW', '', '', '', '', 'ZAUSA,JONEL, OMADLE', '2005-07-28', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(200, 'OID-14FUMH', '', '', '', '', 'DIMALALUAN,LADY EVNIA BARRO', '2004-04-08', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(201, 'OID-62DICP', '', '', '', '', 'BARRIOS, RHEALYN HELENA', '2001-12-01', 19, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(202, 'OID-08XKEA', '', '', '', '', 'BACOLOD, JOHN CARLO ALBIA', '2005-01-06', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(203, 'OID-39MTQL', '', '', '', '', 'HERNANDEZ, CHRISTIAN KING N/A', '2019-04-03', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(204, 'OID-10OUJP', '', '', '', '', 'GUTTAN, REYNALDO', '2005-10-25', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(205, 'OID-71VAMY', '', '', '', '', 'HABAN, MICHAEL', '2005-07-10', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(206, 'OID-79TOFJ', '', '', '', '', 'EVANS, MARK CEDRICK', '2005-03-08', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(207, 'OID-97ZMWK', '', '', '', '', 'DE GUZMAN, JAMES', '2005-01-03', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(208, 'OID-97YTBS', '', '', '', '', 'HILARIO, JAMES MHYCO', '2005-08-19', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(209, 'OID-96KAJM', '', '', '', '', 'GUTTAN, JASPHER', '2004-01-19', 17, 'MALE ', 'SINGLE', 'CATHOLIC'),
(210, 'OID-06EXNF', '', '', '', '', 'AMANTE, KIM JERRY', '2003-08-04', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(211, 'OID-80RITF', '', '', '', '', 'ALVARES JAN NOEL DY', '2003-04-11', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(212, 'OID-93YAEV', '', '', '', '', 'ABALUNA, MARK JAYSON', '2000-03-03', 21, 'MALE ', 'SINGLE', 'CATHOLIC'),
(213, 'OID-63SUEV', '', '', '', '', 'FRANCISCO, PRINCE JOHN SALVADOR', '2001-08-05', 20, 'MALE ', 'SINGLE', 'CATHOLIC'),
(214, 'OID-78ATCN', '', '', '', '', 'CASTILLO, ANGEL', '2005-07-07', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(215, 'OID-84XHTP', '', '', '', '', 'SALVADOR JOMARI', '2002-10-05', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(216, 'OID-12ZWOU', '', '', '', '', 'FAVIS, CHESTER HONG', '2005-04-05', 16, 'MALE ', 'SINGLE', 'CATHOLIC'),
(217, 'OID-53QZUH', '', '', '', '', 'ABADILLA, RAXEL', '2004-03-01', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(218, 'OID-27NRJK', '', '', '', '', 'BATA, ELVIN JR.', '1995-10-14', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(219, 'OID-37ANWL', '', '', '', '', 'BATARA, KING', '2004-11-08', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(220, 'OID-80MOSB', '', '', '', '', 'NORDAN, DEN MARK', '2004-07-03', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(221, 'OID-32JCET', '', '', '', '', 'FRANDOZO, ABDULLAHALJABIN', '2003-05-09', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(222, 'OID-64ASNK', '', '', '', '', 'GAY, CARL VINCENT', '2001-02-16', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(223, 'OID-75VUNB', '', '', '', '', 'DELA CRUZ, DABOY', '2002-04-12', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(224, 'OID-95HCTL', '', '', '', '', 'DANCEL, EDRILYN', '2006-03-02', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(225, 'OID-13SQRU', '', '', '', '', 'BUENO, DARREN BALALA', '2003-12-02', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(226, 'OID-68PRTF', '', '', '', '', 'GONZALES, LESTER', '2002-07-05', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(227, 'OID-41EPRD', '', '', '', '', 'ECHON, DAN JERICK', '2003-07-14', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(228, 'OID-02JIDP', '', '', '', '', 'REDULFIN, JOHN BENEDICT', '2001-07-18', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(229, 'OID-10WUCY', '', '', '', '', 'CHAVEZ, FIONA KATE', '2003-08-14', 18, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(230, 'OID-38YMTZ', '', '', '', '', 'YU, CHRISTIAN', '2004-08-16', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(231, 'OID-30UZAH', '', '', '', '', 'FLAGNE, JOHN BENEDICT GARCIA', '2006-04-19', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(232, 'OID-17JPKU', '', '', '', '', 'DE JESUS, DAREN HAYES', '2003-11-23', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(233, 'OID-50EWFP', '', '', '', '', 'BARCEL, JOHN VINCENT', '2005-02-28', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(234, 'OID-60KCAF', '', '', '', '', 'QUILAPIO, CARL ASHLEY N/A', '2005-11-18', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(235, 'OID-81BNEW', '', '', '', '', 'JABAT, CHRISTELL JAYE', '2004-08-25', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(236, 'OID-74ZFKS', '', '', '', '', 'DEL MUNDO, VADERICK N/A', '2006-03-11', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(237, 'OID-18OMUC', '', '', '', '', 'MALLARI, RICARDO NAVARRO', '1956-10-08', 66, 'MALE', 'SINGLE', 'CATHOLIC'),
(238, 'OID-13MHLJ', '', '', '', '', 'MALLARIROBERTO NAVARRO', '1964-01-17', 58, 'MALE', 'SINGLE', 'CATHOLIC'),
(239, 'OID-57NXPH', '', '', '', '', 'GOROSPE, AURELIA MACATBAG', '1950-04-27', 64, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(240, 'OID-23VDBQ', '', '', '', '', 'GOROSPE,ROGELIO CORPUZ SR.', '1956-11-03', 66, 'MALE', 'MARRIED', 'CATHOLIC'),
(241, 'OID-71CJXD', '', '', '', '', 'TIRNAN, CARLO D.', '2005-03-13', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(242, 'OID-98HUXD', '', '', '', '', 'ONDO, JOMAR A.', '2005-01-03', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(243, 'OID-16IJXM', '', '', '', '', 'SIA, JANEA DINAE PEREZ', '2002-10-10', 18, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(244, 'OID-59GALR', '', '', '', '', 'BAUTISTA, MARICAR DELOS SANTOS', '1992-12-19', 30, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(245, 'OID-36PJKM', '', '', '', '', 'GOROSPRE, BENJIE MACATBAG', '1990-07-29', 32, 'MALE', 'MARRIED', 'CATHOLIC'),
(246, 'OID-35BQCR', '', '', '', '', 'XAGALAWAN, ANGELITA ARIOLA', '1945-07-17', 77, 'FEMALE', 'WIDOW', 'CATHOLIC'),
(247, 'OID-81XDMO', '', '', '', '', 'LLAGAS, ROSELLE MALLARI', '1970-06-06', 52, 'FEMALE', 'MARRIED', 'CATHOLIC'),
(248, 'OID-80UEDI', '', '', '', '', 'CANDELARIA, YSMAELLA MANAGHAYA', '1994-01-18', 28, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(249, 'OID-48IMQB', '', '', '', '', 'HAMBRE, CHARIZA MANANGHAYA', '2004-09-25', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(250, 'OID-43BDIM', '', '', '', '', 'BLANCO, ALBERT ALIBIO', '1993-08-23', 28, 'MALE', 'SINGLE', 'CATHOLIC'),
(251, 'OID-86GVBH', '', '', '', '', 'NAZARENO, CLARISA N/A', '2003-04-02', 18, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(252, 'OID-23KNZM', '', '', '', '', 'DULAY, NASROLYN N/A', '2004-04-13', 17, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(253, 'OID-41HKOD', '', '', '', '', 'IMPERIAL, SANDER ANGUE', '2004-10-14', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(254, 'OID-98HCMO', '', '', '', '', 'ALVARADO, DANICA JEAN LOZANO', '2004-06-04', 18, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(255, 'OID-70DUML', '', '', '', '', 'PIAMONTE, HECTOR ALCODIA', '1989-09-15', 30, 'MALE', 'SINGLE', 'CATHOLIC'),
(256, 'OID-08QTOB', '', '', '', '', 'GELENA, REALYN BARRIOS', '2001-12-01', 20, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(257, 'OID-27YCWO', '', '', '', '', 'BALA, CHRISTIAN ARIES ALCODIA', '1997-03-23', 25, 'MALE', 'SINGLE', 'CATHOLIC'),
(258, 'OID-84QKBY', '', '', '', '', 'PIAMONTE, CHEERY-AN', '1996-04-03', 24, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(259, 'OID-65LMPK', '', '', '', '', 'ANDUYO, HAROLD RAMIREZ', '2004-04-20', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(260, 'OID-54BQVS', '', '', '', '', 'ALEONAR, GLEEN LAURENCE MAPALO', '2004-06-15', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(261, 'OID-74ESBM', '', '', '', '', 'BAYANI, RUB RIEL  M.', '2003-12-07', 18, 'MALE', 'SINGLE', 'CHRISTIAN'),
(262, 'OID-94KALD', '', '', '', '', 'VENTURA,  RANA TOBIAS', '1996-08-22', 25, 'FEMALE', 'SINGLE', ' '),
(263, 'OID-37WSHA', '', '', '', '', 'DE DIOS, EURICKA MAY BRUAN', '1999-02-15', 22, 'FEMALE', 'SOLO PAREN', 'CATHOLIC'),
(264, 'OID-13HQTF', '', '', '', '', 'SOLO, JOHN ALVIN', '1984-11-05', 37, 'MALE', 'MARRIED', 'CATHOLIC'),
(265, 'OID-39PYMS', '', '', '', '', 'FELIPE, GERALD MIMAY', '2002-09-18', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(266, 'OID-59MQVE', '', '', '', '', 'VELEZ, FERNAN GUIM', '2001-05-08', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(267, 'OID-24JXVR', '', '', '', '', 'FELIPE, MICHAEL ANGELO ESPIRITU', '1998-05-17', 24, 'MALE', 'SINGLE', 'CATHOLIC'),
(268, 'OID-59NSTY', '', '', '', '', 'FELIPE, JEFFREY ESPIRITU', '1992-10-24', 29, 'MALE', 'MARRIED', 'CATHOLIC'),
(269, 'OID-69MURY', '', '', '', '', 'ALVAREZ, JOED SALUSA', '1997-06-24', 25, 'MALE', 'SINGLE', 'CATHOLIC'),
(270, 'OID-12ZHBE', '', '', '', '', 'DELA CRUZ, CHARLES PURID', '2002-12-30', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(271, 'OID-73MEDC', '', '', '', '', 'MANOIS, MICO ARSOL', '2002-08-17', 20, 'MALE', 'SINGLE', 'CATHOLIC'),
(272, 'OID-75WFJM', '', '', '', '', 'FLORES, ALEXIS ORO', '2001-12-10', 19, 'MALE', 'SINGLE', 'CATHOLIC'),
(273, 'OID-94LPKE', '', '', '', '', 'SANTIAGO, ARVIN JAKE TALIPING', '2002-09-18', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(274, 'OID-43EKSZ', '', '', '', '', 'MARTINEZ, LHIENECOLE PALOMAR', '2002-04-11', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(275, 'OID-81IKWD', '', '', '', '', 'DE DIOS, CLARK JEROME BIONG ', '2004-10-14', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(276, 'OID-23NKSV', '', '', '', '', 'VERA, JHON MICHAEL BABINA', '2004-11-16', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(277, 'OID-47IWPX', '', '', '', '', 'BRIZO, RYAN DE GUZMAN', '2003-09-10', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(278, 'OID-49DUCN', '', '', '', '', 'BABINA, JOHN MICHAEL HABONITTE', '2004-11-06', 17, 'MALE', 'SINGLE', 'CATHOLIC'),
(279, 'OID-39UZGB', '', '', '', '', 'BABINA, LAURENCE HABONITTE', '2007-02-10', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(280, 'OID-34ZYFH', '', '', '', '', 'BRIZO, RAYMOND DE GUZMAN', '2001-04-12', 21, 'MALE ', 'SINGLE', 'CATHOLIC'),
(281, 'OID-27BUDP', '', '', '', '', 'TOLENTINO, JAY MARSHAL MANUEL', '2003-06-15', 18, 'MALE', 'SINGLE', 'CATHOLIC'),
(282, 'OID-21MGTL', '', '', '', '', 'BRIZO, RENNIEL VELLEZA', '2006-06-12', 15, 'MALE', 'SINGLE', 'CATHOLIC'),
(283, 'OID-27ASDG', '', '', '', '', 'DE GUZMAN, RICOYAN BRIZO', '2005-10-11', 16, 'MALE', 'SINGLE', 'CATHOLIC'),
(284, 'OID-48AUTI', '', '', '', '', 'ODONES, OLIVER YLANORIA', '1969-12-31', 54, 'MALE', 'MARRIED', 'CATHOLIC'),
(285, 'OID-57PQSI', '', '', '', '', 'ROMMEL,PINTO BALUITAN', '1969-12-31', 42, 'MALE', 'MARRIED', 'CATHOLIC'),
(286, 'OID-56BEFX', '', '', '', '', 'BARRETO, MARY GRACE', '1979-10-11', 41, 'FEMALE', 'SINGLE', 'CATHOLIC'),
(287, 'OID-70DWZC', '', '', '', '', 'SADDI, FERNANDO RAYMUNDO', '1963-06-06', 57, 'MALE', 'MARRIED', 'CATHOLIC'),
(288, 'OID-93FGLX', '', '', '', '', 'SAN MIGUEL, RAMON KAPANGYARIHAN', '1959-02-03', 61, 'MALE', 'MARRIED', 'CATHOLIC'),
(289, 'OID-08XQPF', '', '', '', '', 'PASCUA, YODEL PEACE BRIGADE', '1967-01-01', 54, 'MALE', 'MARRIED', 'CATHOLIC'),
(290, 'OID-82DERG', '', '', '', '', 'SANTOS, MARIETTA MADDAWIN', '1969-12-31', 36, 'FEMALE', 'SINGLE', 'CATHOLIC');

-- --------------------------------------------------------

--
-- Table structure for table `oscya_mapping`
--

CREATE TABLE `oscya_mapping` (
  `id` int(20) NOT NULL,
  `oscya_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lrn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `educ_attainment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `other_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `disability` text COLLATE utf8_unicode_ci NOT NULL,
  `is_pwd` tinyint(1) NOT NULL,
  `has_pwd_id` tinyint(1) NOT NULL,
  `other_disability` text COLLATE utf8_unicode_ci NOT NULL,
  `disease` text COLLATE utf8_unicode_ci NOT NULL,
  `is_employed` tinyint(1) NOT NULL,
  `is_fps_member` tinyint(1) NOT NULL,
  `is_interested` tinyint(1) NOT NULL,
  `mapping_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oscya_mapping`
--

INSERT INTO `oscya_mapping` (`id`, `oscya_id`, `user_id`, `teacher_id`, `lrn`, `educ_attainment`, `reason`, `other_reason`, `disability`, `is_pwd`, `has_pwd_id`, `other_disability`, `disease`, `is_employed`, `is_fps_member`, `is_interested`, `mapping_date`) VALUES
(1, 'OID-78XKJT', 'SID-16QIOF', '', '', 'GRADE 10', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(2, 'OID-53PJWE', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(3, 'OID-71PSKE', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(4, 'OID-31PRTU', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(5, 'OID-42HTWZ', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(6, 'OID-53TNOF', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(7, 'OID-24TPZV', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(8, 'OID-89IAVO', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(9, 'OID-53DZQN', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(10, 'OID-10OYGT', 'SID-16QIOF', '', '', 'GRADE 9', 'MARRIAGE', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(11, 'OID-63RAUJ', 'SID-16QIOF', '', '', 'GRADE 11', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 1, 0, 1, '2021-01-01'),
(12, 'OID-21XQOD', 'SID-16QIOF', '', '', ' ', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(13, 'OID-74ICXK', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(14, 'OID-04JUWH', 'SID-16QIOF', '', '', 'GRADE 3', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(15, 'OID-02REBF', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(16, 'OID-31LCQD', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(17, 'OID-68FGVW', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(18, 'OID-50JZGA', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(19, 'OID-13XEIG', 'SID-16QIOF', '', '', 'GRADE 2', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(20, 'OID-86IKCA', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(21, 'OID-51ASGV', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(22, 'OID-70IVTX', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(23, 'OID-30MNFI', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(24, 'OID-13MUGJ', 'SID-16QIOF', '', '', 'GRADE 10', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(25, 'OID-04HOQF', 'SID-16QIOF', '', '', 'GRADE 10', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(26, 'OID-61EUKR', 'SID-16QIOF', '', '', 'GRADE 2', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(27, 'OID-06OMKE', 'SID-16QIOF', '', '', 'GRADE 10', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(28, 'OID-07VPDL', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(29, 'OID-32XHZO', 'SID-16QIOF', '', '', 'GRADE 8', 'DISTANCE OF THE SCHOOL', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(30, 'OID-74CFQW', 'SID-16QIOF', '', '', 'GRADE 7', 'DISEASE', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(31, 'OID-13XACF', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(32, 'OID-62NZRC', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(33, 'OID-97GDIB', 'SID-16QIOF', '', '', 'GRADE 6', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(34, 'OID-46HAWX', 'SID-16QIOF', '', '', 'GRADE 10', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(35, 'OID-09IWEC', 'SID-16QIOF', '', '', 'GRADE 10', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(36, 'OID-01UWFS', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(37, 'OID-95SGXD', 'SID-16QIOF', '', '', 'GRADE 11', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(38, 'OID-78GSYL', 'SID-16QIOF', '', '', 'GRADE 10', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(39, 'OID-38PTHA', 'SID-16QIOF', '', '', 'GRADE 11', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(40, 'OID-01ABPE', 'SID-16QIOF', '', '', 'GRADE 11', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(41, 'OID-83QNTC', 'SID-16QIOF', '', '', 'GARDE 11', 'DISEASE', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(42, 'OID-01SXLT', 'SID-16QIOF', '', '', 'GRADE 8', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(43, 'OID-97TZBH', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(44, 'OID-83EJQP', 'SID-16QIOF', '', '', 'GRADE 11', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(45, 'OID-91MBDA', 'SID-16QIOF', '', '', 'GRADE 11', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(46, 'OID-29MIAY', 'SID-16QIOF', '', '', 'GRAD 11', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(47, 'OID-85AUSZ', 'SID-16QIOF', '', '', 'GRADE 11', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(48, 'OID-69YLGF', 'SID-16QIOF', '', '', 'GRADE 11', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(49, 'OID-80DEVU', 'SID-16QIOF', '', '', 'GRADE 9', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(50, 'OID-40FLJI', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(51, 'OID-14PDWK', 'SID-16QIOF', '', '', 'GRADE 1', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(52, 'OID-60FPXT', 'SID-16QIOF', '', '', 'GRADE 5', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(53, 'OID-46EMFV', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(54, 'OID-43RZXK', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(55, 'OID-73ILFH', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(56, 'OID-93NHBM', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(57, 'OID-43UZXK', 'SID-16QIOF', '', '', 'GARDE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 1, 0, 1, '2021-01-01'),
(58, 'OID-29KNLC', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(59, 'OID-39DPIQ', 'SID-16QIOF', '', '', 'GRADE6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(60, 'OID-78LANS', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(61, 'OID-35NPJT', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(62, 'OID-01COWV', 'SID-16QIOF', '', '', 'GRADE9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(63, 'OID-37QSGE', 'SID-16QIOF', '', '', 'GRADE 11', 'EMPLOYMENT', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(64, 'OID-03TUPQ', 'SID-16QIOF', '', '', 'GRADE8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(65, 'OID-03YOSZ', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(66, 'OID-95CFXP', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(67, 'OID-36TZSC', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 1, 0, 1, '2021-01-01'),
(68, 'OID-60MVQR', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(69, 'OID-56JIAW', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(70, 'OID-89XJYS', 'SID-16QIOF', '', '', 'GRADE 10', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(71, 'OID-26SENK', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(72, 'OID-84OFBQ', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(73, 'OID-49MQTB', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(74, 'OID-32SHAZ', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(75, 'OID-87CHXE', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(76, 'OID-72CTXS', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(77, 'OID-70AZGE', 'SID-16QIOF', '', '', 'GRADE 7', 'DISEASE', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(78, 'OID-12KVCU', 'SID-16QIOF', '', '', 'NO STUDY SINCE BIRTHH', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(79, 'OID-53HKQW', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(80, 'OID-92GNVD', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(81, 'OID-46WTSU', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(82, 'OID-96UPYE', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(83, 'OID-59AJMV', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(84, 'OID-56YDWV', 'SID-16QIOF', '', '', 'NO STUDY SINCE BIRTHH', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(85, 'OID-94LZJR', 'SID-16QIOF', '', '', 'GRADE 3', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(86, 'OID-53JXOY', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(87, 'OID-01HFDN', 'SID-16QIOF', '', '', 'GRADE 11', 'FAMILY PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(88, 'OID-72RCPI', 'SID-16QIOF', '', '', 'GRADE 7', 'FAMILY PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(89, 'OID-38UTHD', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(90, 'OID-50VWFS', 'SID-16QIOF', '', '', 'NO STUDY SINCE BIRTHH', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(91, 'OID-50DHKZ', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(92, 'OID-32EHWD', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(93, 'OID-91RGIT', 'SID-16QIOF', '', '', 'GRADE 8', 'EMPLOYMENT', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(94, 'OID-53ELOM', 'SID-16QIOF', '', '', 'GRADE 3', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(95, 'OID-12YABL', 'SID-16QIOF', '', '', 'NO STUDY SINCE BIRTHH', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(96, 'OID-94ZCAT', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(97, 'OID-97VTWA', 'SID-16QIOF', '', '', 'GRADE 10', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(98, 'OID-61ISVP', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(99, 'OID-65GWJV', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(100, 'OID-93ZOYA', 'SID-16QIOF', '', '', 'GRADE 8', 'EMPLOYMENT', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(101, 'OID-80SJHP', 'SID-16QIOF', '', '', 'GRADE 8', 'EMPLOYMENT', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(102, 'OID-37JOKH', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(103, 'OID-68PJST', 'SID-16QIOF', '', '', 'GRADE 4', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(104, 'OID-02JDLP', 'SID-16QIOF', '', '', 'GRADE 7', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(105, 'OID-94VUZD', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(106, 'OID-12XUCT', 'SID-16QIOF', '', '', 'GRADE 7', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(107, 'OID-60ZILQ', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(108, 'OID-94YDBU', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(109, 'OID-85VDLQ', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(110, 'OID-57KVGT', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(111, 'OID-57RTHP', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(112, 'OID-57UWAG', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(113, 'OID-84AILS', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(114, 'OID-30UERH', 'SID-16QIOF', '', '', 'GRADE 6', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(115, 'OID-39FOYW', 'SID-16QIOF', '', '', 'GRADE 9', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(116, 'OID-10VZPT', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(117, 'OID-50XMFR', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(118, 'OID-08PWND', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(119, 'OID-05NLIQ', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(120, 'OID-82JPAH', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(121, 'OID-12FPYJ', 'SID-16QIOF', '', '', 'GRADE 3', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(122, 'OID-65PCRG', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(123, 'OID-54UMEN', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(124, 'OID-52AZKW', 'SID-16QIOF', '', '', 'GRADE 11', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(125, 'OID-57PGJC', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(126, 'OID-14VAIH', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(127, 'OID-76RLCH', 'SID-16QIOF', '', '', 'GRADE 10', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(128, 'OID-13FISP', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(129, 'OID-01JMPH', 'SID-16QIOF', '', '', 'GRADE 2', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(130, 'OID-03CXUD', 'SID-16QIOF', '', '', 'GRADE 5', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(131, 'OID-63IEXD', 'SID-16QIOF', '', '', 'GRADE 3', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(132, 'OID-98UNOP', 'SID-16QIOF', '', '', '1ST YEAR', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(133, 'OID-65FWXO', 'SID-16QIOF', '', '', 'GRADE 3', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(134, 'OID-58ECSR', 'SID-16QIOF', '', '', '1ST YEAR', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(135, 'OID-82GIYN', 'SID-16QIOF', '', '', 'GRADE 6', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(136, 'OID-73CDSN', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(137, 'OID-60PKVO', 'SID-16QIOF', '', '', '1ST YEAR', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(138, 'OID-28RUKS', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(139, 'OID-51CJXQ', 'SID-16QIOF', '', '', 'GRADE 5', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(140, 'OID-19UMPB', 'SID-16QIOF', '', '', 'GRADE 2', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(141, 'OID-61WDJY', 'SID-16QIOF', '', '', '3RD YEAR HS', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(142, 'OID-14XSVZ', 'SID-16QIOF', '', '', '3RD YEAR HS', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(143, 'OID-95SMNK', 'SID-16QIOF', '', '', '1ST YEAR', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(144, 'OID-43ADIB', 'SID-16QIOF', '', '', '2ND YEAR HS', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(145, 'OID-87YTUJ', 'SID-16QIOF', '', '', 'GRADE 10', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(146, 'OID-07UFXQ', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(147, 'OID-54PMYK', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(148, 'OID-50KERP', 'SID-16QIOF', '', '', 'GRADE 10', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(149, 'OID-36VCJU', 'SID-16QIOF', '', '', 'GRADE 9', 'DISTANCE OF THE SCHOOL', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(150, 'OID-47GCJA', 'SID-16QIOF', '', '', '2ND YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(151, 'OID-57AQUJ', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(152, 'OID-80APUO', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(153, 'OID-85XFMO', 'SID-16QIOF', '', '', 'GRADE 9', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(154, 'OID-96FLYJ', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(155, 'OID-50CKPI', 'SID-16QIOF', '', '', 'GRADE 5', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(156, 'OID-73QFIB', 'SID-16QIOF', '', '', 'GRADE 5', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(157, 'OID-75WZHQ', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(158, 'OID-09ZDQM', 'SID-16QIOF', '', '', '3RD YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(159, 'OID-29LIAF', 'SID-16QIOF', '', '', '4TH YR. HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(160, 'OID-57RHWO', 'SID-16QIOF', '', '', ' ', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(161, 'OID-45SCTL', 'SID-16QIOF', '', '', '1ST YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(162, 'OID-64EIZO', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(163, 'OID-23VUJM', 'SID-16QIOF', '', '', '2ND YEAR HS', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(164, 'OID-15UGDM', 'SID-16QIOF', '', '', '1ST YEAR HS', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(165, 'OID-82HJWG', 'SID-16QIOF', '', '', ' ', 'FAMILY RLATED CONCERN', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(166, 'OID-82CNHB', 'SID-16QIOF', '', '', '1ST YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(167, 'OID-85BMIE', 'SID-16QIOF', '', '', '1ST YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(168, 'OID-96DCRI', 'SID-16QIOF', '', '', '1ST YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(169, 'OID-45NHTV', 'SID-16QIOF', '', '', 'GRADE 1', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(170, 'OID-70RKQC', 'SID-16QIOF', '', '', '2ND YEAR HS', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(171, 'OID-81CEJQ', 'SID-16QIOF', '', '', '2ND YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(172, 'OID-20DVWM', 'SID-16QIOF', '', '', 'GRADE 3', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(173, 'OID-06BUXY', 'SID-16QIOF', '', '', 'GRADE 11', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(174, 'OID-07ZRAD', 'SID-16QIOF', '', '', 'GRADE 12', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(175, 'OID-90MYQE', 'SID-16QIOF', '', '', 'GRADE 11', 'DECEASED', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(176, 'OID-12IMVU', 'SID-16QIOF', '', '', 'GRADE 11', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(177, 'OID-72CDPF', 'SID-16QIOF', '', '', 'GRADE 10', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(178, 'OID-74KFSP', 'SID-16QIOF', '', '', 'GRADE 10', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(179, 'OID-92ABSM', 'SID-16QIOF', '', '', 'GRADE 5', 'EARLY PREGNANCY', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(180, 'OID-07UGIH', 'SID-16QIOF', '', '', 'GRADE 7', 'FAMILY RLATED CONCERN', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(181, 'OID-38TZAR', 'SID-16QIOF', '', '', 'GRADE 7`', 'MARRIAGE', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(182, 'OID-52MTRG', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(183, 'OID-79RHZI', 'SID-16QIOF', '', '', 'GRADE 8', 'DISEASE', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(184, 'OID-50GERT', 'SID-16QIOF', '', '', 'GRADE 7', 'DISEASE', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(185, 'OID-84JRNS', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(186, 'OID-79VUAL', 'SID-16QIOF', '', '', 'GRADE 5', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(187, 'OID-75LYOI', 'SID-16QIOF', '', '', 'GRADE 6', 'CANNOT COPE WITH SCHOOL WORKS', '', 'LEARNING DISABALITY', 1, 0, '', '', 0, 0, 0, '2021-01-01'),
(188, 'OID-09CBTL', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(189, 'OID-54RVBC', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 1, 0, '2021-01-01'),
(190, 'OID-75ZXAC', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(191, 'OID-09MXQW', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(192, 'OID-06PCXL', 'SID-16QIOF', '', '', 'GRADE 5', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(193, 'OID-37TKLG', 'SID-16QIOF', '', '', 'GRADE 10', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(194, 'OID-31WCLH', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(195, 'OID-95HSWV', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(196, 'OID-64NZXH', 'SID-16QIOF', '', '', 'GRADE 6', 'DECEASED', '', '', 0, 0, '', '', 1, 0, 0, '2021-01-01'),
(197, 'OID-08RUZJ', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(198, 'OID-89HXVO', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY PROBLEM', '', '', 0, 0, '', '', 0, 1, 0, '2021-01-01'),
(199, 'OID-37YQGW', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 1, 0, '2021-01-01'),
(200, 'OID-14FUMH', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(201, 'OID-62DICP', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(202, 'OID-08XKEA', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(203, 'OID-39MTQL', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(204, 'OID-10OUJP', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(205, 'OID-71VAMY', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(206, 'OID-79TOFJ', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(207, 'OID-97ZMWK', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(208, 'OID-97YTBS', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(209, 'OID-96KAJM', 'SID-16QIOF', '', '', 'GRADE 10', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(210, 'OID-06EXNF', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(211, 'OID-80RITF', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(212, 'OID-93YAEV', 'SID-16QIOF', '', '', 'GRADE 2', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(213, 'OID-63SUEV', 'SID-16QIOF', '', '', 'GRADE 3', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(214, 'OID-78ATCN', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(215, 'OID-84XHTP', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RLATED CONCERN', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(216, 'OID-12ZWOU', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(217, 'OID-53QZUH', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RLATED CONCERN', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(218, 'OID-27NRJK', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(219, 'OID-37ANWL', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(220, 'OID-80MOSB', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(221, 'OID-32JCET', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(222, 'OID-64ASNK', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RELATED CONCERNS', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(223, 'OID-75VUNB', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(224, 'OID-95HCTL', 'SID-16QIOF', '', '', 'GRADE 7', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(225, 'OID-13SQRU', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(226, 'OID-68PRTF', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(227, 'OID-41EPRD', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(228, 'OID-02JIDP', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(229, 'OID-10WUCY', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(230, 'OID-38YMTZ', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(231, 'OID-30UZAH', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(232, 'OID-17JPKU', 'SID-16QIOF', '', '', 'GRADE 5', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(233, 'OID-50EWFP', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(234, 'OID-60KCAF', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(235, 'OID-81BNEW', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(236, 'OID-74ZFKS', 'SID-16QIOF', '', '', 'GARDE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(237, 'OID-18OMUC', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(238, 'OID-13MHLJ', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(239, 'OID-57NXPH', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(240, 'OID-23VDBQ', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(241, 'OID-71CJXD', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(242, 'OID-98HUXD', 'SID-16QIOF', '', '', 'GRADE 9', 'FAMILY RLATED CONCERN', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(243, 'OID-16IJXM', 'SID-16QIOF', '', '', 'GRADE 8', 'FAMILY RLATED CONCERN', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(244, 'OID-59GALR', 'SID-16QIOF', '', '', 'ERD YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(245, 'OID-36PJKM', 'SID-16QIOF', '', '', 'ERD YEAR HS', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(246, 'OID-35BQCR', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(247, 'OID-81XDMO', 'SID-16QIOF', '', '', '3RD YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(248, 'OID-80UEDI', 'SID-16QIOF', '', '', '1ST YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(249, 'OID-48IMQB', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(250, 'OID-43BDIM', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(251, 'OID-86GVBH', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(252, 'OID-23KNZM', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(253, 'OID-41HKOD', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(254, 'OID-98HCMO', 'SID-16QIOF', '', '', '1ST YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(255, 'OID-70DUML', 'SID-16QIOF', '', '', '1ST YEAR HS', 'EMPLOYMENT', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(256, 'OID-08QTOB', 'SID-16QIOF', '', '', 'GRADE 9', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(257, 'OID-27YCWO', 'SID-16QIOF', '', '', '2ND YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(258, 'OID-84QKBY', 'SID-16QIOF', '', '', '2ND YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(259, 'OID-65LMPK', 'SID-16QIOF', '', '', 'GRADE 6', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(260, 'OID-54BQVS', 'SID-16QIOF', '', '', 'GRADE 8', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(261, 'OID-74ESBM', 'SID-16QIOF', '', '', 'GRADE 4', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(262, 'OID-94KALD', 'SID-16QIOF', '', '', '2ND YEAR HS', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(263, 'OID-37WSHA', 'SID-16QIOF', '', '', '4TH YR. HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(264, 'OID-13HQTF', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(265, 'OID-39PYMS', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(266, 'OID-59MQVE', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(267, 'OID-24JXVR', 'SID-16QIOF', '', '', 'GRADE 3', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(268, 'OID-59NSTY', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(269, 'OID-69MURY', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(270, 'OID-12ZHBE', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(271, 'OID-73MEDC', 'SID-16QIOF', '', '', 'GRADE', 'LACK OF PERSONAL INTEREST', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(272, 'OID-75WFJM', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(273, 'OID-94LPKE', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(274, 'OID-43EKSZ', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(275, 'OID-81IKWD', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(276, 'OID-23NKSV', 'SID-16QIOF', '', '', 'GRADE 8', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(277, 'OID-47IWPX', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 1, '2021-01-01'),
(278, 'OID-49DUCN', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(279, 'OID-39UZGB', 'SID-16QIOF', '', '', 'GRADE 1', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(280, 'OID-34ZYFH', 'SID-16QIOF', '', '', 'GRADE 1', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(281, 'OID-27BUDP', 'SID-16QIOF', '', '', 'GRADE 10', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(282, 'OID-21MGTL', 'SID-16QIOF', '', '', 'GRADE 1', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(283, 'OID-27ASDG', 'SID-16QIOF', '', '', 'GRADE 3', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(284, 'OID-48AUTI', 'SID-16QIOF', '', '', 'GRADE 6', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(285, 'OID-57PQSI', 'SID-16QIOF', '', '', 'GRADE 5', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(286, 'OID-56BEFX', 'SID-16QIOF', '', '', 'GRADE 7', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(287, 'OID-70DWZC', 'SID-16QIOF', '', '', 'UNDER GRADUATE', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(288, 'OID-93FGLX', 'SID-16QIOF', '', '', '2ND YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(289, 'OID-08XQPF', 'SID-16QIOF', '', '', 'UNDER GRADUATE', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01'),
(290, 'OID-82DERG', 'SID-16QIOF', '', '', '2ND YEAR HS', 'FINANCIAL PROBLEM', '', '', 0, 0, '', '', 0, 0, 0, '2021-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `report_setting`
--

CREATE TABLE `report_setting` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `file_loc` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_setting`
--

INSERT INTO `report_setting` (`id`, `user_id`, `filename`, `purpose`, `date_from`, `date_to`, `file_loc`, `date_created`) VALUES
(1, 'CID-43MTZP', 'file-62713c2b42dee', 'QCYDO Reference', '2021-01-03', '2022-05-31', 'CID-43MTZP/file-62713c2b42dee.pdf', '2022-05-03 14:28:59'),
(2, 'CID-43MTZP', '6273d41adaee4', 'ALS Counselling', '2020-01-01', '2022-05-31', 'CID-43MTZP/6273d41adaee4.xlsx', '2022-05-05 13:41:47'),
(3, 'CID-43MTZP', 'file-6277d9679a4a2', 'QCYDO Reference', '2021-01-01', '2022-12-31', 'CID-43MTZP/file-6277d9679a4a2.pdf', '2022-05-08 14:53:28'),
(4, 'CID-43MTZP', 'file-6281e52d02861', 'QCYDO Reference', '2021-01-01', '2022-12-31', 'CID-43MTZP/file-6281e52d02861.pdf', '2022-05-16 05:46:21'),
(5, 'CID-43MTZP', '6281e5d215c50', 'ALS Counselling', '2021-01-01', '2022-12-31', 'CID-43MTZP/6281e5d215c50.xlsx', '2022-05-16 05:49:06'),
(6, 'CID-43MTZP', 'file-6281e8a03f390', 'QCYDO Reference', '2022-05-01', '2022-05-31', 'CID-43MTZP/file-6281e8a03f390.pdf', '2022-05-16 06:01:04'),
(7, 'CID-43MTZP', 'file-6281e9bf53191', 'QCYDO Reference', '2022-05-01', '2022-05-31', 'CID-43MTZP/file-6281e9bf53191.pdf', '2022-05-16 06:05:51'),
(8, 'CID-43MTZP', 'file-6281eb7812b4e', 'QCYDO Reference', '2021-01-01', '2022-12-31', 'CID-43MTZP/file-6281eb7812b4e.pdf', '2022-05-16 06:13:12'),
(9, 'CID-43MTZP', 'file-6281ee92e8099', 'QCYDO Reference', '2021-01-01', '2022-05-31', 'CID-43MTZP/file-6281ee92e8099.pdf', '2022-05-16 06:26:27'),
(10, 'CID-43MTZP', 'file-6281eed211848', 'QCYDO Reference', '2020-01-01', '2022-12-31', 'CID-43MTZP/file-6281eed211848.pdf', '2022-05-16 06:27:30'),
(11, 'CID-43MTZP', '6281ef15b0f24', 'ALS Counselling', '2020-01-01', '2022-12-31', 'CID-43MTZP/6281ef15b0f24.xlsx', '2022-05-16 06:28:37'),
(12, 'CID-43MTZP', '6281f014e98ae', 'ALS Counselling', '2020-01-01', '2022-12-31', 'CID-43MTZP/6281f014e98ae.xlsx', '2022-05-16 06:32:53'),
(13, 'CID-43MTZP', '6281f04489d9f', 'ALS Counselling', '2020-01-01', '2022-05-31', 'CID-43MTZP/6281f04489d9f.xlsx', '2022-05-16 06:33:40'),
(14, 'CID-43MTZP', '6281f13606a06', 'ALS Counselling', '2020-01-01', '2022-12-31', 'CID-43MTZP/6281f13606a06.xlsx', '2022-05-16 06:37:42'),
(15, 'CID-43MTZP', '6281f631db240', 'ALS Counselling', '2020-01-01', '2022-12-31', 'CID-43MTZP/6281f631db240.xlsx', '2022-05-16 06:58:58'),
(16, 'CID-43MTZP', '6281f92912f7b', 'ALS Counselling', '2021-01-01', '2022-05-31', 'CID-43MTZP/6281f92912f7b.xlsx', '2022-05-16 07:11:37'),
(17, 'CID-43MTZP', 'file-62920f5ac3a6b', 'QCYDO Reference', '2020-01-01', '2022-05-31', 'CID-43MTZP/file-62920f5ac3a6b.pdf', '2022-05-28 12:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_evaluated` tinyint(1) NOT NULL,
  `resubmit` tinyint(1) NOT NULL,
  `activation_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `isActivated` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_email_activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `user_id`, `creator_id`, `username`, `password`, `user_type`, `is_evaluated`, `resubmit`, `activation_code`, `isActivated`, `status`, `email`, `is_email_activated`) VALUES
(1, 'TID-38OCUN', 'AID-XM67AB', '@drevs', '$2y$10$s0/nJHoPNCcl.DmQFXXa7OJEQAuW7jPR/nMZ4IKeeLokJ5Bx3qMSW', '', 1, 0, '827-OYM-426', 1, 1, 'artantonio39@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_contact`
--

CREATE TABLE `teacher_contact` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `contact_no` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `street` text NOT NULL,
  `barangay` text NOT NULL,
  `district` varchar(8) NOT NULL,
  `city` text NOT NULL,
  `zipcode` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_contact`
--

INSERT INTO `teacher_contact` (`id`, `user_id`, `contact_no`, `email`, `facebook`, `street`, `barangay`, `district`, `city`, `zipcode`) VALUES
(1, 'TID-38OCUN', '', 'artantonio39@gmail.com', '', '', '', '5', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_credential`
--

CREATE TABLE `teacher_credential` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `id_loc` text NOT NULL,
  `allow` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_credential`
--

INSERT INTO `teacher_credential` (`id`, `user_id`, `id_loc`, `allow`) VALUES
(1, 'TID-38OCUN', 'TID-38OCUN/1651511144_9f0a0768bb8b8b4f4f2f.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `ext` varchar(5) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`id`, `user_id`, `lastname`, `firstname`, `middlename`, `ext`, `birthdate`, `age`, `gender`, `image`) VALUES
(1, 'TID-38OCUN', 'Barrio', 'Drevs', '', '', '0000-00-00', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_task`
--

CREATE TABLE `teacher_task` (
  `id` int(11) NOT NULL,
  `als_coord_id` varchar(20) NOT NULL,
  `coord_id` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `brgy_facility` varchar(20) NOT NULL,
  `sched_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `is_done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_task`
--

INSERT INTO `teacher_task` (`id`, `als_coord_id`, `coord_id`, `user_id`, `staff_id`, `brgy_facility`, `sched_date`, `start_time`, `end_time`, `is_done`) VALUES
(1, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2021-01-03', '', '', 1),
(2, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-51VWQG', 'FID-63LKDM', '2022-05-12', '08:00', '21:00', 0),
(3, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2022-01-01', '', '', 1),
(4, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-01-01', '', '', 1),
(5, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-01-01', '', '', 1),
(6, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-01-01', '', '', 1),
(7, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2022-01-01', '', '', 1),
(8, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2000-02-11', '', '', 1),
(9, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-11', '', '', 1),
(10, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-02', '', '', 1),
(11, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-02', '', '', 1),
(12, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-02', '', '', 1),
(13, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-01-01', '', '', 1),
(14, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-02', '', '', 1),
(15, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-02', '', '', 1),
(16, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2020-02-02', '', '', 1),
(17, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-51VWQG', 'FID-63LKDM', '2021-01-01', '', '', 1),
(18, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2021-01-01', '', '', 1),
(19, '', 'CID-43MTZP', 'TID-38OCUN', 'SID-16QIOF', 'FID-63LKDM', '2021-01-01', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `creator_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_evaluated` tinyint(1) NOT NULL,
  `resubmit` tinyint(1) NOT NULL,
  `activation_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `isActivated` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_email_activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `creator_id`, `username`, `password`, `user_type`, `is_evaluated`, `resubmit`, `activation_code`, `isActivated`, `status`, `email`, `is_email_activated`) VALUES
(1, 'CID-43MTZP', 'AID-XM67AB', '@bagbag', '$2y$10$yZ5L7ae0Mf1pV6YsswKa5.xvWyVEM1xsoiQoU6ZLTvKvnzuPXGg8G', 'Coordinator', 1, 0, '731-HIC-134', 1, 1, 'art.acebuche.antonio.qcu@gmail.com', 1),
(2, 'SID-16QIOF', 'CID-43MTZP', 'bagbagstaff', '$2y$10$3H79qquR5Ix4.itYfdO6wO2V2HUnvzDfTgD8a5ZbwGEnk7N7QRWuS', 'Staff', 1, 0, '401-RDI-471', 1, 1, 'artantonio39@gmail.com', 1),
(3, 'SID-51VWQG', 'CID-43MTZP', '@rinil', '$2y$10$Z0rc5rB8MRy6dANWA.UsAO6vKHJ3aDJusS6F64vwWTO7D3/q/.Y5K', 'Staff', 1, 0, '129-XME-546', 1, 0, 'artantonio39@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `als_coordinator`
--
ALTER TABLE `als_coordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `als_coordinator_contact`
--
ALTER TABLE `als_coordinator_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `als_coordinator_credential`
--
ALTER TABLE `als_coordinator_credential`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `als_coordinator_info`
--
ALTER TABLE `als_coordinator_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_setting`
--
ALTER TABLE `backup_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credential`
--
ALTER TABLE `credential`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oscya_admission`
--
ALTER TABLE `oscya_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oscya_contact`
--
ALTER TABLE `oscya_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oscya_counseling`
--
ALTER TABLE `oscya_counseling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oscya_guardian`
--
ALTER TABLE `oscya_guardian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oscya_info`
--
ALTER TABLE `oscya_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oscya_mapping`
--
ALTER TABLE `oscya_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_setting`
--
ALTER TABLE `report_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_contact`
--
ALTER TABLE `teacher_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_credential`
--
ALTER TABLE `teacher_credential`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_task`
--
ALTER TABLE `teacher_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `als_coordinator`
--
ALTER TABLE `als_coordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `als_coordinator_contact`
--
ALTER TABLE `als_coordinator_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `als_coordinator_credential`
--
ALTER TABLE `als_coordinator_credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `als_coordinator_info`
--
ALTER TABLE `als_coordinator_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `backup_setting`
--
ALTER TABLE `backup_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credential`
--
ALTER TABLE `credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_recipient`
--
ALTER TABLE `message_recipient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oscya_admission`
--
ALTER TABLE `oscya_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oscya_contact`
--
ALTER TABLE `oscya_contact`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `oscya_counseling`
--
ALTER TABLE `oscya_counseling`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `oscya_guardian`
--
ALTER TABLE `oscya_guardian`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `oscya_info`
--
ALTER TABLE `oscya_info`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `oscya_mapping`
--
ALTER TABLE `oscya_mapping`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `report_setting`
--
ALTER TABLE `report_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_contact`
--
ALTER TABLE `teacher_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_credential`
--
ALTER TABLE `teacher_credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_task`
--
ALTER TABLE `teacher_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD CONSTRAINT `message_recipient_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
