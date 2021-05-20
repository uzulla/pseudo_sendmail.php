<?php
declare(strict_types=1);

namespace PseudoSendmail;

class Factory
{
    public static function createFromArgv(array $argv): Writer
    {
        $file_name = sys_get_temp_dir() . "/pseudo_mail.eml";
        $append_flag = true;
        foreach ($argv as $arg) {
            if (preg_match("|^-o(.+)$|u", $arg, $_)) {
                $file_name = $_[1];
            }
            if (preg_match("|^-na$|u", $arg)) {
                $append_flag = false;
            }
        }

        return new Writer(
            $file_name,
            $append_flag
        );
    }
}
