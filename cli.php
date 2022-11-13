<?php declare(strict_types=1);

require_once __DIR__ . "/src/FTP.php";

$cliArguments = $argv;
$ftpHost = $_ENV['FTP_HOST'];
$ftpUsername = $_ENV['FTP_USERNAME'];
$ftpPassword = $_ENV['FTP_PASSWORD'];
$action = $cliArguments[1];
$remotePath = $cliArguments[2];
$localPath = $cliArguments[3] ?? null;
$ftp = new FTP($ftpHost, $ftpUsername, $ftpPassword);

switch ($action) {
    case 'clearFolder':
        echo "Clearing $remotePath\n";
        $ftp->clearFolder($remotePath);
        break;
    case 'uploadFolder':
        echo "Uploading to $remotePath from $localPath\n";
        $ftp->uploadFolder($remotePath, __DIR__ . "/$localPath");
        break;
    case 'remove':
        echo "Removing $remotePath\n";
        $ftp->remove($remotePath);
        break;
}
echo "Done\n";