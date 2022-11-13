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
2. Run command, `php ftp/cli.php [action] [remotePath] [localPath]`

### Commands

#### clearFolder

Remove content of remote folder recursively.

Example: `php ftp/cli.php clearFolder /httpdocs`

#### uploadFolder

Upload content to remote folder from local folder.

Example: `php ftp/cli.php uploadFolder /httpdocs build`

#### remove

Remove file or folder.

Example: `php ftp/cli.php remove /httpdocs/build`