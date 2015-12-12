<?php
require __DIR__.'/../vendor/autoload.php';

\Swift::init(function () {
    \Swift_DependencyContainer::getInstance()
        ->register('mime.qpheaderencoder')
        ->asAliasOf('mime.base64headerencoder');
    \Swift_Preferences::getInstance()->setCharset('iso-2022-jp');
});

$message = \Swift_Message::newInstance()
    ->setSubject('件名')
    ->setFrom(['jhon_doe@example.jp' => 'テスト送信者'])
    ->setTo(['uzulla@example.jp'])
    ->setBody("メール本文です\n1234567890\nあいうえおかきくけko\n")
    ->setCharset('iso-2022-jp')
    ->setEncoder(new \Swift_Mime_ContentEncoder_PlainContentEncoder('7bit'));

$transport = \Swift_MailTransport::newInstance();
$mailer = \Swift_Mailer::newInstance($transport);
$mailer->send($message);

echo "sent\n";
