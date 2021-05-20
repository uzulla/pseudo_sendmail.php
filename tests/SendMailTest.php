<?php
declare(strict_types=1);

namespace PseudoSendmail\Tests;

use PHPUnit\Framework\TestCase;
use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;

class SendMailTest extends TestCase
{
    public function testSend()
    {
        $sendmail_path = realpath(__DIR__ . "/../bin/sendmail");

        $transport = new Swift_SendmailTransport("{$sendmail_path} -ti -na -o".__DIR__.'/test.eml');

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message())
            ->setSubject("test subject")
            ->setFrom(['from@example.jp' => 'from name'])
            ->setTo(['to@example.jp' => 'to name'])
            ->setBody("this is test mail");

        $resultNum = $mailer->send($message);

        $this->assertEquals(1, $resultNum);

        $eml = file_get_contents(__DIR__.'/test.eml');

        $this->assertStringContainsString('test subject', $eml);
        $this->assertStringContainsString('from@example.jp', $eml);
        $this->assertStringContainsString('to@example.jp', $eml);
        $this->assertStringContainsString('this is test mail', $eml);
    }
}