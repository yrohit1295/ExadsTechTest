DROP DATABASE IF EXISTS tv_schedule;

CREATE DATABASE tv_schedule;
USE tv_schedule;

-- Table: tv_series
CREATE TABLE tv_series
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    title   VARCHAR(255) NOT NULL,
    channel VARCHAR(100) NOT NULL,
    genre   VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: tv_series_intervals
CREATE TABLE tv_series_intervals
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    id_tv_series INT  NOT NULL,
    week_day     ENUM('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday') NOT NULL,
    show_time    TIME NOT NULL,
    FOREIGN KEY (id_tv_series) REFERENCES tv_series (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data into tv_series
INSERT INTO tv_series (title, channel, genre)
VALUES ('Breaking Bad', 'AMC', 'Crime Drama'),
       ('Stranger Things', 'Netflix', 'Science Fiction'),
       ('Game of Thrones', 'HBO', 'Fantasy');

-- Insert data into tv_series_intervals
INSERT INTO tv_series_intervals (id_tv_series, week_day, show_time)
VALUES (1, 'Monday', '20:00:00'),
       (1, 'Thursday', '22:00:00'),
       (2, 'Friday', '21:00:00'),
       (2, 'Sunday', '18:30:00'),
       (3, 'Wednesday', '19:00:00'),
       (3, 'Saturday', '20:30:00');
