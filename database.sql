CREATE DATABASE blog;
CREATE USER 'blog'@'localhost' IDENTIFIED BY 'blog';
GRANT ALL PRIVILEGES ON blog.* TO 'blog'@'localhost';

CREATE TABLE `user` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `email` varchar(255) NOT NULL,
                     `password` varchar(255) NOT NULL,
                     `name` varchar(255) DEFAULT NULL,
                     `surname` varchar(255) DEFAULT NULL,
                     `about` TEXT DEFAULT NULL,
                     `phone` varchar(255) DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `article` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `userId` int(20) unsigned NOT NULL,
                     `title` varchar(255) NOT NULL,
                     `content` TEXT NOT NULL,
                     `img` varchar(255) DEFAULT NULL,
                     `createdAt` DATETIME DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE user add isAdmin tinyint default 0;

UPDATE user SET isAdmin = 1 WHERE id = 4;

CREATE TABLE `comment` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `userId` int(20) unsigned DEFAULT NULL,
                     `articleId` int(20) unsigned NOT NULL,
                     `content` TEXT NOT NULL,
                     `isModerative` TINYINT unsigned DEFAULT 0,
                     `createdAt` DATETIME DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `category` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `name` varchar(255) NOT NULL,
                     `createdAt` DATETIME DEFAULT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO category SET name = 'News', createdAt = NOW();

INSERT INTO category SET name = 'Articles', createdAt = NOW();

ALTER TABLE article ADD categoryId int(11) default null;

ALTER TABLE article ADD isPublished tinyint default 1;

ALTER TABLE article ADD views INT(11) DEFAULT 0;

ALTER TABLE article ADD likes int(11) default 0;

CREATE TABLE `likes` (`id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                     `userId` int(20) unsigned NOT NULL,
                     `ip` varchar(255) NOT NULL,
                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE likes ADD articleId int(11) default null;

ALTER TABLE likes CHANGE userId userId INT(11) DEFAULT NULL;

ALTER TABLE likes ADD createdAt DATETIME DEFAULT NULL;

ALTER TABLE likes ADD updateAt DATETIME DEFAULT NULL;
