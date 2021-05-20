# Pseudo sendmail

This is pseudo `sendmail` command for developer.

Write raw mail(eml) to file.

## setup

1. git clone and composer install.
2. set/change your sendmail path configuration.
3. send mail.

### php.ini sample

```
sendmail_path = "/{this dir}/bin/sendmail"
```

FYI: `sendmail_path` is `PHP_INI_SYSTEM`. so, You can't set by `ini_set()`.

### SwiftMailer sample

```
// ...
$transport = new Swift_SendmailTransport(""/{this dir}/bin/sendmail" -ti");
$mailer = new Swift_Mailer($transport);
// ...
```

> `-ti` is important. If use SwiftMailer default option `-bs`, the script will be hangup.  

## option / settings

- `-o/path/to/output` specify output file path
- `-na` not append eml. output file clear when every send reset.

```
sendmail -it -fasdf@example.jp -o/tmp/test.eml
sendmail -it -fasdf@example.jp -na -o/tmp
```

> `-i -t -f` or other options will be ignored.

> don't `-o /file`, must `-o/file`.

## require

- PHP>=7.4

## do you need mail sending sample?

see `tests/*`.

## LICENSE

MIT
