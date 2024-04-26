-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vytvořeno: Sob 27. dub 2024, 01:19
-- Verze serveru: 5.7.33-0ubuntu0.16.04.1
-- Verze PHP: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `RP`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(100) NOT NULL,
  `planned_id` int(100) NOT NULL,
  `log_from` time DEFAULT NULL,
  `log_to` time DEFAULT NULL,
  `pause_from` varchar(255) DEFAULT NULL,
  `pause_to` varchar(255) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `com_from` varchar(255) DEFAULT NULL,
  `com_to` varchar(255) DEFAULT NULL,
  `delay_arr` int(100) DEFAULT NULL,
  `delay_dep` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `board`
--

CREATE TABLE `board` (
  `id_board` int(11) NOT NULL,
  `caption` text,
  `content` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  `employee_full` int(11) NOT NULL,
  `employee_part` int(11) NOT NULL,
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `create_shift`
--

CREATE TABLE `create_shift` (
  `id_shift` int(100) NOT NULL,
  `start_shift` date NOT NULL,
  `rep_non` int(1) NOT NULL,
  `monday` int(1) NOT NULL,
  `mon_from` time NOT NULL,
  `mon_to` time NOT NULL,
  `tuesday` int(1) NOT NULL,
  `tue_from` time NOT NULL,
  `tue_to` time NOT NULL,
  `wednesday` int(1) NOT NULL,
  `wed_from` time NOT NULL,
  `wed_to` time NOT NULL,
  `thursday` int(11) NOT NULL,
  `thu_from` time NOT NULL,
  `thu_to` time NOT NULL,
  `friday` int(11) NOT NULL,
  `fri_from` time NOT NULL,
  `fri_to` time NOT NULL,
  `saturday` int(11) NOT NULL,
  `sat_from` time NOT NULL,
  `sat_to` time NOT NULL,
  `sunday` int(11) NOT NULL,
  `sun_from` time NOT NULL,
  `sun_to` time NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `object_id` int(100) NOT NULL,
  `object_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `IPS`
--

CREATE TABLE `IPS` (
  `id_ip` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `ip_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `list_of_objects`
--

CREATE TABLE `list_of_objects` (
  `id_object` int(100) NOT NULL,
  `object_name` varchar(255) NOT NULL,
  `superior_object_name` varchar(255) NOT NULL,
  `superior_object_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `list_of_tables`
--

CREATE TABLE `list_of_tables` (
  `id_tables` int(10) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `real_table_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `manager_rights`
--

CREATE TABLE `manager_rights` (
  `id_right` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `object_id` int(100) NOT NULL,
  `object_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `OBJECTS_BACKUP`
--

CREATE TABLE `OBJECTS_BACKUP` (
  `ID_OBJ_BACKUP` int(10) UNSIGNED NOT NULL,
  `ID_OBJECT` int(11) NOT NULL,
  `OBJECT_NAME` varchar(255) NOT NULL,
  `SUPERIOR_OBJECT_ID` int(11) NOT NULL,
  `SUPERIOR_OBJECT_NAME` varchar(255) NOT NULL,
  `ID_INTIALIZE` int(11) NOT NULL,
  `DATE_INTIALIZE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `permanent_time_options`
--

CREATE TABLE `permanent_time_options` (
  `id_permanent` int(11) NOT NULL,
  `monday` int(11) NOT NULL,
  `mon_from` time NOT NULL,
  `mon_to` time NOT NULL,
  `tuesday` int(11) NOT NULL,
  `tue_from` time NOT NULL,
  `tue_to` time NOT NULL,
  `wednesday` int(11) NOT NULL,
  `wed_from` time NOT NULL,
  `wed_to` time NOT NULL,
  `thursday` int(11) NOT NULL,
  `thu_from` time NOT NULL,
  `thu_to` time NOT NULL,
  `friday` int(11) NOT NULL,
  `fri_from` time NOT NULL,
  `fri_to` time NOT NULL,
  `saturday` int(11) NOT NULL,
  `sat_from` time NOT NULL,
  `sat_to` time NOT NULL,
  `sunday` int(11) NOT NULL,
  `sun_from` time NOT NULL,
  `sun_to` time NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `PLANNED_SHIFTS_BACKUP`
--

CREATE TABLE `PLANNED_SHIFTS_BACKUP` (
  `ID_PLAN_BACKUP` int(10) UNSIGNED NOT NULL,
  `ID_PLAN` int(11) NOT NULL,
  `SAVED_DATE` date NOT NULL,
  `ID_SHIFT` int(11) NOT NULL,
  `SAVED_FROM` time NOT NULL,
  `SAVED_TO` time NOT NULL,
  `UP_TIMESTAMP` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `USER_NAME` varchar(255) NOT NULL,
  `COMMENTS` text,
  `ID_INTIALIZE` int(11) NOT NULL,
  `DATE_INTIALIZE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `saved_shift`
--

CREATE TABLE `saved_shift` (
  `id_saved_shift` int(11) NOT NULL,
  `saved_date` date NOT NULL,
  `id_of_shift` int(11) NOT NULL,
  `saved_name` varchar(255) NOT NULL,
  `saved_from` time NOT NULL,
  `saved_to` time NOT NULL,
  `up_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `saved_shift_data`
--

CREATE TABLE `saved_shift_data` (
  `id` int(100) NOT NULL,
  `saved_date` date NOT NULL,
  `id_of_shift` int(11) NOT NULL,
  `saved_from` time NOT NULL,
  `saved_to` time NOT NULL,
  `up_timestamp` int(100) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `att_from` time DEFAULT NULL,
  `att_to` time DEFAULT NULL,
  `pause_from` varchar(255) DEFAULT NULL,
  `pause_to` varchar(255) DEFAULT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `SHIFTS_BACKUP`
--

CREATE TABLE `SHIFTS_BACKUP` (
  `ID_SHI_BACKUP` int(10) UNSIGNED NOT NULL,
  `ID_SHIFT` bigint(20) NOT NULL,
  `START_SHIFT` date NOT NULL,
  `REP_NON` int(11) NOT NULL,
  `MONDAY` int(11) NOT NULL,
  `MON_FROM` time NOT NULL,
  `MON_TO` time NOT NULL,
  `TUESDAY` int(11) NOT NULL,
  `TUE_FROM` time NOT NULL,
  `TUE_TO` time NOT NULL,
  `WEDNESDAY` int(11) NOT NULL,
  `WED_FROM` time NOT NULL,
  `WED_TO` time NOT NULL,
  `THURSDAY` int(11) NOT NULL,
  `THU_FROM` time NOT NULL,
  `THU_TO` time NOT NULL,
  `FRIDAY` int(11) NOT NULL,
  `FRI_FROM` time NOT NULL,
  `FRI_TO` time NOT NULL,
  `SATURDAY` int(11) NOT NULL,
  `SAT_FROM` time NOT NULL,
  `SAT_TO` time NOT NULL,
  `SUNDAY` int(11) NOT NULL,
  `SUN_FROM` time NOT NULL,
  `SUN_TO` time NOT NULL,
  `SHIFT_NAME` varchar(255) NOT NULL,
  `COLOR` varchar(255) NOT NULL,
  `ID_OBJECT` int(11) NOT NULL,
  `OBJECT_NAME` varchar(255) NOT NULL,
  `ID_INTIALIZE` int(11) NOT NULL,
  `DATE_INTIALIZE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_assignment`
--

CREATE TABLE `shift_assignment` (
  `id_assignment` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `shift_id` int(100) NOT NULL,
  `shift_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_check`
--

CREATE TABLE `shift_check` (
  `id_check` int(100) NOT NULL,
  `id_shift` int(100) NOT NULL,
  `year_shift` varchar(255) NOT NULL,
  `month_shift` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `time_options`
--

CREATE TABLE `time_options` (
  `id_option` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `saved_date` date NOT NULL,
  `opt_from` time NOT NULL,
  `opt_to` time NOT NULL,
  `up_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlename` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `countryCode` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `USER_BACKUP`
--

CREATE TABLE `USER_BACKUP` (
  `ID_USER_BACKUP` int(10) UNSIGNED NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) NOT NULL,
  `MIDDLE_NAME` varchar(255) NOT NULL,
  `LAST_NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD_HASH` varchar(255) NOT NULL,
  `COUNTRY_CODE` int(11) NOT NULL,
  `PHONE` int(11) NOT NULL,
  `POSITION` varchar(255) NOT NULL,
  `ID_INTIALIZE` int(11) NOT NULL,
  `DATE_INTIALIZE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlename` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `countryCode` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `verificationCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Klíče pro tabulku `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id_board`);

--
-- Klíče pro tabulku `create_shift`
--
ALTER TABLE `create_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Klíče pro tabulku `IPS`
--
ALTER TABLE `IPS`
  ADD PRIMARY KEY (`id_ip`);

--
-- Klíče pro tabulku `list_of_objects`
--
ALTER TABLE `list_of_objects`
  ADD PRIMARY KEY (`id_object`);

--
-- Klíče pro tabulku `list_of_tables`
--
ALTER TABLE `list_of_tables`
  ADD PRIMARY KEY (`id_tables`);

--
-- Klíče pro tabulku `manager_rights`
--
ALTER TABLE `manager_rights`
  ADD PRIMARY KEY (`id_right`);

--
-- Klíče pro tabulku `OBJECTS_BACKUP`
--
ALTER TABLE `OBJECTS_BACKUP`
  ADD PRIMARY KEY (`ID_OBJ_BACKUP`);

--
-- Klíče pro tabulku `permanent_time_options`
--
ALTER TABLE `permanent_time_options`
  ADD PRIMARY KEY (`id_permanent`);

--
-- Klíče pro tabulku `PLANNED_SHIFTS_BACKUP`
--
ALTER TABLE `PLANNED_SHIFTS_BACKUP`
  ADD PRIMARY KEY (`ID_PLAN_BACKUP`);

--
-- Klíče pro tabulku `saved_shift`
--
ALTER TABLE `saved_shift`
  ADD PRIMARY KEY (`id_saved_shift`);

--
-- Klíče pro tabulku `saved_shift_data`
--
ALTER TABLE `saved_shift_data`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `SHIFTS_BACKUP`
--
ALTER TABLE `SHIFTS_BACKUP`
  ADD PRIMARY KEY (`ID_SHI_BACKUP`);

--
-- Klíče pro tabulku `shift_assignment`
--
ALTER TABLE `shift_assignment`
  ADD PRIMARY KEY (`id_assignment`);

--
-- Klíče pro tabulku `shift_check`
--
ALTER TABLE `shift_check`
  ADD PRIMARY KEY (`id_check`);

--
-- Klíče pro tabulku `time_options`
--
ALTER TABLE `time_options`
  ADD PRIMARY KEY (`id_option`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Klíče pro tabulku `USER_BACKUP`
--
ALTER TABLE `USER_BACKUP`
  ADD PRIMARY KEY (`ID_USER_BACKUP`);

--
-- Klíče pro tabulku `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pro tabulku `board`
--
ALTER TABLE `board`
  MODIFY `id_board` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pro tabulku `create_shift`
--
ALTER TABLE `create_shift`
  MODIFY `id_shift` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;
--
-- AUTO_INCREMENT pro tabulku `IPS`
--
ALTER TABLE `IPS`
  MODIFY `id_ip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pro tabulku `list_of_objects`
--
ALTER TABLE `list_of_objects`
  MODIFY `id_object` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pro tabulku `list_of_tables`
--
ALTER TABLE `list_of_tables`
  MODIFY `id_tables` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pro tabulku `manager_rights`
--
ALTER TABLE `manager_rights`
  MODIFY `id_right` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT pro tabulku `OBJECTS_BACKUP`
--
ALTER TABLE `OBJECTS_BACKUP`
  MODIFY `ID_OBJ_BACKUP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `permanent_time_options`
--
ALTER TABLE `permanent_time_options`
  MODIFY `id_permanent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `PLANNED_SHIFTS_BACKUP`
--
ALTER TABLE `PLANNED_SHIFTS_BACKUP`
  MODIFY `ID_PLAN_BACKUP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `saved_shift`
--
ALTER TABLE `saved_shift`
  MODIFY `id_saved_shift` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `saved_shift_data`
--
ALTER TABLE `saved_shift_data`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2978;
--
-- AUTO_INCREMENT pro tabulku `SHIFTS_BACKUP`
--
ALTER TABLE `SHIFTS_BACKUP`
  MODIFY `ID_SHI_BACKUP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `shift_assignment`
--
ALTER TABLE `shift_assignment`
  MODIFY `id_assignment` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pro tabulku `shift_check`
--
ALTER TABLE `shift_check`
  MODIFY `id_check` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT pro tabulku `time_options`
--
ALTER TABLE `time_options`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pro tabulku `USER_BACKUP`
--
ALTER TABLE `USER_BACKUP`
  MODIFY `ID_USER_BACKUP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
