<?php declare(strict_types=1);

require_once __DIR__ . "/src/FTP.php";

$cliArguments = $argv;
$ftpHost = $_ENV['FTP_HOST'];
$ftpUsername = $_ENV['FTP_USERNAME'];
$ftpPassword = $_ENV['FTP_PASSWORD'];
$action = $cliArguments[1];
$sourceFolder = $cliArguments[2];
$targetFolder = $cliArguments[3] ?? null;
$ftp = new FTP($ftpHost, $ftpUsername, $ftpPassword);

if ($action === 'clearFolder') {
    echo "Clearing $sourceFolder\n";
    $ftp->clearFolder($sourceFolder);
    echo "Done";
    return;
}
if ($action === 'uploadFolder') {
    echo "Uploading $sourceFolder to $targetFolder\n";
    $ftp->uploadFolder(__DIR__ . $sourceFolder, $targetFolder);
    echo "Done";
}
