# PHP FTP

This project was originally meant for use of automated deployment on hosts where automated `ssh` authentication
and `curl` upload were not supported.

## Requirements

- Docker

## Example

In your project:

1. Create a `scripts` folder in the root directory. Clone this FTP project in that folder.
2. In `scripts/php-ftp`, run `docker-compose up -d` to start the php container.
3. In `scripts/php-ftp`, bash into the container with `docker-compose exec php bash`.
4. In the php bash, `cd` to `project/scripts/php-ftp/src`.
5. Run FTP actions with `php cli.php [host] [username] [password] [action] [sourceFolder] [targetFolder]`

### Available actions

#### clearFolder

Remove content of source folder recursively.

Example: `php cli.php example.com exampleUsername examplePassword clearFolder /httpdocs`

#### uploadFolder

Remove content of source folder to target folder.

Example: `php cli.php example.com exampleUsername examplePassword uploadFolder /../../../build /httpdocs`