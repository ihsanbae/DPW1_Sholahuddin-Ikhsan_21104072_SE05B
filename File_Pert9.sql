CREATE TABLE `User` (
  `user_id` INT PRIMARY KEY,
  `username` VARCHAR(50),
  `password` VARCHAR(50),
  `role_id` INT
);

CREATE TABLE `Role` (
  `role_id` INT PRIMARY KEY,
  `role_name` VARCHAR(50)
);

CREATE TABLE `Karyawan` (
  `karyawan_id` INT PRIMARY KEY,
  `user_id` INT,
  `division_id` INT,
  `tugas_harian` VARCHAR(100)
);

CREATE TABLE `Divisi` (
  `division_id` INT PRIMARY KEY,
  `division_name` VARCHAR(50),
  `ketua_divisi_id` INT
);

CREATE TABLE `Ketua_Divisi` (
  `ketua_divisi_id` INT PRIMARY KEY,
  `user_id` INT
);

ALTER TABLE `User` ADD FOREIGN KEY (`role_id`) REFERENCES `Role` (`role_id`);

ALTER TABLE `Karyawan` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);

ALTER TABLE `Karyawan` ADD FOREIGN KEY (`division_id`) REFERENCES `Divisi` (`division_id`);

ALTER TABLE `Divisi` ADD FOREIGN KEY (`ketua_divisi_id`) REFERENCES `Ketua_Divisi` (`ketua_divisi_id`);

ALTER TABLE `Ketua_Divisi` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);
