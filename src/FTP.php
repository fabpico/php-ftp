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
            $this->remove($childPath);
        }
    }

    public function uploadFolder(string $remoteFolderPath, string $localFolderPath): void
    {
        $files = scandir($localFolderPath);
        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $localFilePath = "$localFolderPath/$file";
            $remoteFilePath = "$remoteFolderPath/$file";
            if (is_dir($localFilePath)) {
                ftp_mkdir($this->connection, $remoteFilePath);
                $this->uploadFolder($remoteFilePath, $localFilePath);
                continue;
            }
            ftp_put($this->connection, $remoteFilePath, $localFilePath);
        }
    }

    public function remove(string $remotePath): void
    {
        $pathFragments = explode('/', $remotePath);
        $file = end($pathFragments);
        $isFolder = !str_contains($file, '.');
        if ($isFolder) {
            $this->clearFolder($remotePath);
            ftp_rmdir($this->connection, $remotePath);
            return;
        }
        ftp_delete($this->connection, $remotePath);
    }
}
