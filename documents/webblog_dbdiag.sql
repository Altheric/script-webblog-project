CREATE TABLE `Articles` (
  `id` INTEGER UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `article_post_date` DATE,
  `article_update_date` DATE,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT(20000) NOT NULL,
  `premium_article` BIT DEFAULT 0,
  `category_id` INTEGER,
  `user_id` INTEGER
);

CREATE TABLE `Categories` (
  `id` INTEGER UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `category_name` VARCHAR NOT NULL
);

CREATE TABLE `Users` (
  `id` INTEGER UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(60) UNIQUE NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `premium_user` BIT DEFAULT 0
);

CREATE TABLE `Comments` (
  `id` INTEGER UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `comment` VARCHAR(300) NOT NULL,
  `comment_post_date` DATE,
  `article_id` INTEGER,
  `user_id` INTEGER
);

CREATE TABLE `Images` (
  `id` INTEGER UNIQUE PRIMARY KEY AUTO_INCREMENT,
  `image_data` MEDIUMBLOB NOT NULL,
  `image_alt` VARCHAR(255) NOT NULL,
  `image_subtitle` VARCHAR(255) DEFAULT null,
  `article_id` INTEGER
);

CREATE TABLE `Categories_Articles` (
  `Categories_id` INTEGER,
  `Articles_category_id` INTEGER,
  PRIMARY KEY (`Categories_id`, `Articles_category_id`)
);

ALTER TABLE `Categories_Articles` ADD FOREIGN KEY (`Categories_id`) REFERENCES `Categories` (`id`);

ALTER TABLE `Categories_Articles` ADD FOREIGN KEY (`Articles_category_id`) REFERENCES `Articles` (`category_id`);


ALTER TABLE `Articles` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

ALTER TABLE `Articles` ADD FOREIGN KEY (`id`) REFERENCES `Comments` (`article_id`);

ALTER TABLE `Users` ADD FOREIGN KEY (`id`) REFERENCES `Comments` (`user_id`);

ALTER TABLE `Images` ADD FOREIGN KEY (`article_id`) REFERENCES `Articles` (`id`);
