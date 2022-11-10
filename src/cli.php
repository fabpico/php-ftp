<?php declare(strict_types=1);

require_once "FTP.php";

$cliArguments = $argv;
$ftpHost = $cliArguments[1];
$ftpUsername = $cliArguments[2];
$ftpPassword = $cliArguments[3];
$action = $cliArguments[4];
$sourceFolder = $cliArguments[5];
$targetFolder = $cliArguments[6];
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
