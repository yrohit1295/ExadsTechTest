# PHP Developer Candidate Exercise (EXADS)
---
## Project Overview

This project consists of multiple PHP scripts and a MySQL database, implemented using Docker. The functionalities include:

- **Prime Numbers** - PHP script that prints all integer values from 1 to 100. Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
only multiple of itself then print “[PRIME]”.
- **ASCII Array** - PHP script to generate a random array containing all the ASCII characters from comma (“,”) to pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.
Write the code to efficiently determine the missing character.
- **TV Series Scheduler** - Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an inputted time-date, and that can be optionally filtered by TV Series title.
- **A/B Testing** - Write a snippet of PHP code that redirects end users to the different designs based on the data provided by this library: packagist.org/exads/ab-test-data

---

## Prerequisites

Ensure you have the following installed:

- **Docker Desktop** ([Download & Install](https://www.docker.com/products/docker-desktop))

---

## Directory Structure

```
.
├── db                    # Database setup scripts
│   ├── tv_schedule.php   # SQL script to create and populate DB
├── docker                # Docker configuration
│   ├── apache
│   │   └── my-000-default.conf  # Apache VirtualHost configuration
│   ├── mysql
│   │   ├── Dockerfile           # Dockerfile for MySQL container
│   │   └── my.cnf               # MySQL custom configuration
├── logs                  # Application logs
├── public                # Public-facing PHP scripts
│   ├── index.php         # Entry point for A/B testing
│   ├── design.php        # Displays selected design
│   ├── schedule.php      # Retrieves the next TV show
├── src                   # Application source code
│   ├── ASCIIArray
│   │   └── ASCIIArray.php
│   ├── Helper
│   │   ├── DBHelper.php
│   │   └── LogHelper.php
│   ├── Interfaces
│   │   ├── ABTestInterface.php
│   │   └── ScheduleInterface.php
│   ├── Models
│   │   ├── ABTestDesign.php
│   │   └── TVSeriesSchedule.php
│   ├── PrimeNumbers
│   │   └── PrimeNumbers.php
├── vendor                # Composer dependencies
├── .gitignore
├── config.php            # Configuration file
├── composer.json         # Composer dependencies
├── docker-compose.yml    # Docker Compose setup
├── Dockerfile            # PHP-Apache setup
└── Readme.md             # Project documentation
```

---

## Setup Instructions and Running Programs

### 1. Start Docker Desktop

### 2. Clone the Repository

```sh
git clone https://github.com/yrohit1295/ExadsTechTest.git
cd ExadsTechTest
```

### 3. Start Docker Containers

```sh
docker compose up --build -d
```
Images and containers will be visible in docker desktop

### 4. Import database

```sh
docker cp db/tv_schedule.sql mysql_latest:/tmp/tv_schedule.sql
docker exec -i mysql_latest bash -c "mysql -uroot -proot < /tmp/tv_schedule.sql"
```

**Note:** 

- If you want to connect the database in docker, use the following command
```sh
docker exec -it mysql_latest mysql -uroot -p
```

- To exit MySQL: 
```
exit;
```

- To connect in workbench
```

host: localhost
port: 3307
username: root
password: root
```
### 5. Run Prime Number Script
```
docker exec -it php_latest php src/PrimeNumbers/PrimeNumbers.php
```
### 6. Run ASCII Array Script
```
docker exec -it php_latest php src/ASCIIArray/ASCIIArray.php
```

### 7. TV Series
Access via: http://localhost:8080/schedule.php
Example:
```
http://localhost:8080/schedule.php
http://localhost:8080/schedule.php?title=Game+of+Thrones
http://localhost:8080/schedule.php?title=Breaking+Bad&date=2024-02-15%2015:00:00
```

### 8. AB Test
Access via: http://localhost:8080/index.php?promotion_id=PROMOTIONID
Example:
```
http://localhost:8080/index.php?promotion_id=1
http://localhost:8080/index.php?promotion_id=2
```
---

## Stop containers
```
docker-compose down
```
---
## Logs
Check logs at ```logs/custom.log```
