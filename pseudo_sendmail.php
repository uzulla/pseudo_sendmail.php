#!/usr/bin/env php
<?php
require_once __DIR__.'/vendor/autoload.php';


foreach($_SERVER['argv'] as &$token){
    // this is dirty patch.
    // PHP will add return-path(-f) option that like as `-fjhondoe@example.com`.
    // commando library can handle `-f jhondoe@...`, BUT can't `-fjhondoe@...` .
    if(preg_match('/^\-f.+@/u', $token)){
        $token = preg_replace('/^\-f/', '-f ', $token);
    }
}

// default
define('DEFAULT_OUTPUT_FILENAME', '/tmp/mail.eml');

// parse params
$cmd = new Commando\Command();

$cmd->option('f')
    ->aka('return_path')
    ->describedAs('return-path addr.')
    ->default('NO_RETURN_PATH');

$cmd->option('o')
    ->aka('output_filename')
    ->default(DEFAULT_OUTPUT_FILENAME)
    ->describedAs('output file name, base dir require.')
    ->must(function ($path) {
        $dir = basename($path);
        return file_exists($dir) && filetype($dir) === 'dir';
    });

$cmd->option('n')
    ->aka('no_file_output')
    ->describedAs('no file output')
    ->boolean();

$cmd->option('t')
    ->aka('through_stdout')
    ->describedAs('through stdout')
    ->boolean();

$cmd->option('a')
    ->aka('append')
    ->describedAs('append output.(erase before output, when not append on.)')
    ->boolean();

// read stdin
$raw = file_get_contents('php://stdin');

// TODO: beauty parse.

// write
if(!$cmd['no_file_output']){
    file_put_contents($cmd['output_filename'], $raw, $cmd['append'] ? FILE_APPEND : null);
}
if($cmd['through_stdout']){echo $raw;}

