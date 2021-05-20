<?php
declare(strict_types=1);

namespace PseudoSendmail;

class Writer
{
    /** @var string */
    public $output_path;
    /** @var bool */
    public $appendFlag;

    public function __construct(
        string $output_path,
        bool $appendFlag
    )
    {
        $this->output_path = $output_path;
        $this->appendFlag = $appendFlag;
    }

    public function run()
    {
        // read from stdin
        $fh = fopen("php://stdin", 'rb') or die;

        $raw = "";
        while (!feof($fh)) {
            $raw .= fread($fh, 1024);
        }

        // write
        file_put_contents($this->output_path, $raw, $this->appendFlag ? FILE_APPEND : 0);
    }
}
