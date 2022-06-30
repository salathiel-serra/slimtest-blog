# SLIMTEST-BLOG

This is a study project, developed during the course: 'Creating Websites with PHP Slim Framework'.

Note: To run the project, you must have Docker and Docker Compose installed on your machine:

## Installation:
1. Clone the project:
```
https://github.com/salathiel-serra/slimtest-blog.git
```

2. Run in the project root via terminal:
```
docker-compose up -d
```

3. Wait a few moments and you will have:
```
Creating sblog_nginx ... done
Creating sblog_mysql ... done
Creating sblog_app ... done

```

4. To restore the database, access the **sblog_mysql** container:
```
docker exec -it sblog_mysql bash

command: mysql -uroot -p < /home/scripts-db/sblog.sql
password: r00t
```

5. To install the necessary dependencies for the application, access the **sblog_app** container
```
docker exec -it sblog_app bash

command: composer install
```

