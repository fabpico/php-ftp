# PHP FTP

## Requirements

- Docker

## Configure

Create a `.env` file in the project root (see `.env.sample`).

- `MOUNT_PATH`: General usage is current directory `./`. You may want to access files more high in the tree, so use
  e.g. `../../`.

## Usage

1. Bash into php `docker-compose up -d`, `docker-compose exec php bash`.
2. Run command `cd project`, `php cli.php [host] [username] [password] [action] [sourceFolder] [targetFolder]`

### Commands

#### clearFolder

Remove content of source folder recursively.

`php cli.php example.com exampleUsername examplePassword clearFolder /httpdocs`

#### uploadFolder

Upload content of source folder to target folder.

`php cli.php example.com exampleUsername examplePassword uploadFolder /build /httpdocs`