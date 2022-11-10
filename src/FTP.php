<?php declare(strict_types=1);

final class FTP
{
    private \FTP\Connection $connection;

    public function __construct(string $host, string $username, string $password)
    {
        $connection = ftp_connect($host);
        ftp_login($connection, $username, $password);
        ftp_pasv($connection, true); // to let work ftp_nlist
        $this->connection = $connection;
    }

    public function clearFolder(string $path): void
    {
        $rawChildPaths = ftp_nlist($this->connection, $path);
        $childPaths = array_filter($rawChildPaths, function (string $childPath) {
            $childPathFragments = explode('/', $childPath);
            $file = end($childPathFragments);
            return !in_array($file, ['.', '..']);
        });
        foreach ($childPaths as $childPath) {
            $childPathFragments = explode('/', $childPath);
            $file = end($childPathFragments);
            $isFolder = !str_contains($file, '.');
            if ($isFolder) {
                $this->clearFolder($childPath);
                ftp_rmdir($this->connection, $childPath);
                continue;
            }
            ftp_delete($this->connection, $childPath);
        }
    }

    public function uploadFolder(string $sourceFolderPath, string $targetFolderPath): void
    {
        $files = scandir($sourceFolderPath);
        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $sourceFilePath = "$sourceFolderPath/$file";
            $targetFilePath = "$targetFolderPath/$file";
            if (is_dir($sourceFilePath)) {
                ftp_mkdir($this->connection, $targetFilePath);
                $this->uploadFolder($sourceFilePath, $targetFilePath);
                continue;
            }
            ftp_put($this->connection, $targetFilePath, $sourceFilePath);
        }
    }
}
