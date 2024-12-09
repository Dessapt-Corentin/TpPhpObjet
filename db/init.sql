CREATE TABLE `equipments` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `label` varchar(50)
);

CREATE TABLE `accommodations` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `adresse_id` int,
    `price` decimal(6, 2),
    `id_type` int,
    `size` int,
    `description` text,
    `beds` int(2),
    `owner_id` int,
    `image` varchar(50)
);

CREATE TABLE `users` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `email` varchar(50),
    `password` varchar(128),
    `firstname` varchar(50),
    `lastname` varchar(50),
    `phone_number` varchar(20),
    `role` bool
);

CREATE TABLE `rentals` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `user_id` int,
    `accommodation_id` int,
    `date_start` datetime,
    `date_end` datetime
);

CREATE TABLE `types_accommodations` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `type_accomodation` int
);

CREATE TABLE `adresses` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `country` varchar(50),
    `city` varchar(50),
    `adress` varchar(50),
    `postal_code` int(5)
);

CREATE TABLE `accommodations_equipments` (
    `accommodation_id` int,
    `equipments_id` int,
    PRIMARY KEY (
        `accommodation_id`,
        `equipments_id`
    )
);

ALTER TABLE `accommodations_equipments`
ADD FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`);

ALTER TABLE `accommodations_equipments`
ADD FOREIGN KEY (`equipments_id`) REFERENCES `equipments` (`id`);

ALTER TABLE `accommodations`
ADD FOREIGN KEY (`id_type`) REFERENCES `types_accommodations` (`id`);

ALTER TABLE `accommodations`
ADD FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

ALTER TABLE `rentals`
ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `rentals`
ADD FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`);

ALTER TABLE `accommodations`
ADD FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id`);