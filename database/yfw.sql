-- ============================================================
-- YFW Haven Grand — Database Schema v2.0
-- Gold & Black Luxury Hotel Management System
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `yfw`;
CREATE DATABASE `yfw` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `yfw`;

-- ============================================================
-- TABLE: rooms
-- ============================================================
CREATE TABLE `rooms` (
  `room_id`         INT(11)       NOT NULL AUTO_INCREMENT,
  `room_type`       VARCHAR(50)   NOT NULL,
  `price`           INT(11)       NOT NULL,
  `total_rooms`     INT(11)       NOT NULL DEFAULT 5,
  `available_rooms` INT(11)       NOT NULL DEFAULT 5,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rooms` (`room_id`, `room_type`, `price`, `total_rooms`, `available_rooms`) VALUES
(1, 'Y Room',    850000,  40, 40),
(2, 'F Room',   2200000,  20, 20),
(3, 'W Suite',  5500000,  10, 10),
(4, 'Y Premium',3500000,  20, 20),
(5, 'F Pro',    4500000,  10, 10),
(6, 'W Pro Max',6500000,   5,  5);

-- ============================================================
-- TABLE: guests
-- ============================================================
CREATE TABLE `guests` (
  `guest_id`   INT(11)      NOT NULL AUTO_INCREMENT,
  `guest_name` VARCHAR(100) NOT NULL,
  `email`      VARCHAR(150) DEFAULT NULL,
  `phone`      VARCHAR(25)  NOT NULL,
  `created_at` TIMESTAMP    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `guests` (`guest_id`, `guest_name`, `email`, `phone`) VALUES
(1, 'Yarisunal Firdaus',   'yari@example.com',   '0822-9987-1645'),
(2, 'M. Fariel Abda',      'fariel@example.com', '0853-8073-7225'),
(3, 'Wida Sultan Utama',   'wida@example.com',   '0851-2106-9570'),
(4, 'Cornel',              'cornel@example.com', '0826-9458-7136');

-- ============================================================
-- TABLE: bookings
-- ============================================================
CREATE TABLE `bookings` (
  `booking_id`  INT(11)     NOT NULL AUTO_INCREMENT,
  `guest_id`    INT(11)     NOT NULL,
  `room_id`     INT(11)     NOT NULL,
  `check_in`    DATETIME    NOT NULL DEFAULT current_timestamp(),
  `check_out`   DATETIME    DEFAULT NULL,
  `status`      VARCHAR(50) NOT NULL DEFAULT 'Checked In',
  `created_at`  TIMESTAMP   NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`booking_id`),
  KEY `fk_booking_guest` (`guest_id`),
  KEY `fk_booking_room`  (`room_id`),
  CONSTRAINT `fk_booking_guest` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`),
  CONSTRAINT `fk_booking_room`  FOREIGN KEY (`room_id`)  REFERENCES `rooms`  (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bookings` (`booking_id`, `guest_id`, `room_id`, `check_in`, `check_out`, `status`) VALUES
(1, 1, 1, '2026-04-10 22:27:26', NULL,                   'Checked In'),
(2, 2, 2, '2026-04-10 22:33:49', NULL,                   'Checked In'),
(3, 3, 3, '2026-04-10 22:34:16', '2026-04-13 09:10:02', 'Checked Out'),
(4, 4, 6, '2026-04-13 09:11:34', NULL,                   'Checked In');

-- ============================================================
-- TABLE: reservations
-- ============================================================
CREATE TABLE `reservations` (
  `reservation_id`   INT(11)     NOT NULL AUTO_INCREMENT,
  `guest_id`         INT(11)     NOT NULL,
  `room_id`          INT(11)     NOT NULL,
  `reserve_date`     DATE        NOT NULL,
  `expected_checkin` DATE        DEFAULT NULL,
  `status`           VARCHAR(50) NOT NULL DEFAULT 'Pending',
  `created_at`       TIMESTAMP   NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reservation_id`),
  KEY `fk_reserve_guest` (`guest_id`),
  KEY `fk_reserve_room`  (`room_id`),
  CONSTRAINT `fk_reserve_guest` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`),
  CONSTRAINT `fk_reserve_room`  FOREIGN KEY (`room_id`)  REFERENCES `rooms`  (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- TABLE: payments
-- ============================================================
CREATE TABLE `payments` (
  `payment_id`   INT(11)     NOT NULL AUTO_INCREMENT,
  `booking_id`   INT(11)     NOT NULL,
  `amount`       BIGINT      NOT NULL DEFAULT 0,
  `nights`       INT(11)     NOT NULL DEFAULT 1,
  `method`       VARCHAR(50) NOT NULL DEFAULT 'Cash',
  `paid_at`      TIMESTAMP   NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`payment_id`),
  KEY `fk_payment_booking` (`booking_id`),
  CONSTRAINT `fk_payment_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert payment for checked-out guest (3 nights × Rp 5.500.000)
INSERT INTO `payments` (`payment_id`, `booking_id`, `amount`, `nights`, `method`) VALUES
(1, 3, 16500000, 3, 'Cash');

-- ============================================================
-- TABLE: visitors
-- ============================================================
CREATE TABLE `visitors` (
  `visitor_id`  INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(100) NOT NULL,
  `purpose`     VARCHAR(150) DEFAULT NULL,
  `check_in`    DATETIME     NOT NULL DEFAULT current_timestamp(),
  `check_out`   DATETIME     DEFAULT NULL,
  PRIMARY KEY (`visitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

-- ============================================================
-- SYNC: Recalculate available_rooms from live bookings.
-- Run this after import if the DB already has booking data.
-- ============================================================
UPDATE rooms r
SET r.available_rooms = r.total_rooms - (
    SELECT COUNT(*) FROM bookings b
    WHERE b.room_id = r.room_id AND b.status = 'Checked In'
);
