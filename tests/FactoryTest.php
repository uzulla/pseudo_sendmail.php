<?php
declare(strict_types=1);

namespace PseudoSendmail\Tests;

use PHPUnit\Framework\TestCase;
use PseudoSendmail\Factory;

class FactoryTest extends TestCase
{
    public function testArgParse()
    {
        $mailer = Factory::createFromArgv(
            [ // ./test.php -it -fasdf@example.jp
                0 => './test.php',
                1 => '-it',
                2 => '-fasdf@example.jp',
            ]
        );

        $this->assertEquals(sys_get_temp_dir() . "/pseudo_mail.eml", $mailer->output_path);
        $this->assertEquals(true, $mailer->appendFlag);

        $mailer = Factory::createFromArgv(
            [ // ./test.php -it -fasdf@example.jp -o/bar
                0 => './test.php',
                1 => '-it',
                2 => '-fasdf@example.jp',
                3 => '-o/bar',
            ]
        );

        $this->assertEquals('/bar', $mailer->output_path);
        $this->assertEquals(true, $mailer->appendFlag);

        $mailer = Factory::createFromArgv(
            [ // ./test.php -it -fasdf@example.jp -nc
                0 => './test.php',
                1 => '-it',
                2 => '-fasdf@example.jp',
                3 => '-na',
            ]
        );

        $this->assertEquals(false, $mailer->appendFlag);
    }
}