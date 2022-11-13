# PHP FTP

A lightweight tool, to execute FTP commands over the CLI.

## Requirements

- Docker

## Configure

### Environment variables

Create a `.env` file in the project root (see `.env.sample`).

- `FTP_HOST`
- `FTP_USERNAME`
- `FTP_PASSWORD`
- `MOUNT_PATH`
    - General usage is current directory `./`.  
      You may want to access files more high in the tree, so use e.g. `../../`.

## Usage

1. Bash into php `docker-compose up -d`, `docker-compose exec php bash`.
2. Run command, `php ftp/cli.php [action] [sourceFolder] [targetFolder]`

### Commands

#### clearFolder

Remove content of source folder recursively.

Example: `php ftp/cli.php clearFolder /httpdocs`

#### uploadFolder

Upload content of source folder to target folder.

Example: `php ftp/cli.php uploadFolder /build /httpdocs`