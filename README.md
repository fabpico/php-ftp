# PHP FTP

## Requirements

- Docker

## Usage

1. Bash into php `docker-compose up -d`, `docker-compose exec php bash`.
2. Run command `cd project`, `php cli.php [host] [username] [password] [action] [sourceFolder] [targetFolder]`

### Available commands

#### clearFolder - Remove content of source folder recursively

`php cli.php example.com exampleUsername examplePassword clearFolder /httpdocs`

#### uploadFolder - Remove content of source folder to target folder

`php cli.php example.com exampleUsername examplePassword uploadFolder /../../../build /httpdocs`