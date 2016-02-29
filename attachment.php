<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once __DIR__ . '/application.php';
$application->bootstrap('autoloader');

$g_download = Input::Get('g_download', 'int', 0, true);
$g_show_in_browser = Input::Get('g_show_in_browser', 'int', 0, true);
if (preg_match('!attachment.*/(.+)$!U', $_SERVER['REQUEST_URI'], $match)) {
    $attachment = $match[1];
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404: File not found';
    exit;
}

// Remove any GET parameters
if (($questionMark = strpos($attachment, '?')) !== false) {
    $attachment = substr($attachment, 0, $questionMark);
}

// Remove all attempts to get at other parts of the file system
$attachment = str_replace('/../', '/', $attachment);
$filename = urldecode(basename($attachment));

$extension = '';
if (($extensionStart = strrpos($attachment, '.')) !== false) {
    $extension = strtolower(substr($attachment, $extensionStart + 1));
    $attachment = substr($attachment, 0, $extensionStart);
}
$attachmentId = (int)ltrim($attachment, " 0\t\n\r\0");

$attachmentObj = new Attachment($attachmentId);
if (!$attachmentObj->exists()) {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404: File not found';
    exit;
}

header('Content-Type: ' . $attachmentObj->getMimeType());
if ($g_download == 1) {
    header('Content-Disposition: ' . $attachmentObj->getContentDisposition()
                    . '; filename="' . $attachmentObj->getFileName()).'"';
} else if ($g_show_in_browser == 1) {
    header('Content-Disposition: inline; filename="' . $attachmentObj->getFileName()).'"';
} else {
    if (!$attachmentObj->getContentDisposition() &&
            strstr($attachmentObj->getMimeType(), 'image/') &&
            (strstr($_SERVER['HTTP_ACCEPT'], $attachmentObj->getMimeType()) ||
            (strstr($_SERVER['HTTP_ACCEPT'], '*/*')))) {
        header('Content-Disposition: inline; filename="' . $attachmentObj->getFileName()).'"';
    } else {
        header('Content-Disposition: ' . $attachmentObj->getContentDisposition()
                        . '; filename="' . $attachmentObj->getFileName()).'"';
    }
}
header('Content-Length: ' . $attachmentObj->getSizeInBytes());

$filePath = $attachmentObj->getStorageLocation();
if (file_exists($filePath)) {
    readfile($filePath);
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404: File not found';
    exit;
}

