# Psedo sendmail

This is pseudo `sendmail` command for mail-form developer.

Write raw mail(eml) to file, when send mail by php function.

# usage

setup and send mail by php.

will create `/tmp/mail.eml`.

FYI: mail.app can open .eml file well. `$ open /tmp/mail.eml`.

# setup

1, git clone and composer install.

2, change sendmail_path in `php.ini`.

```
sendmail_path = "/path/to/pseudo_sendmail.php"
```

FYI: `sendmail_path` is `PHP_INI_SYSTEM`. so, You can't set by `ini_set()`.

3, send mail.


# require

I just tested on php7.0 + OSX.

maybe work with PHP>=5.4 .

# do you need mail sending sample?

see and execute `text/test_send.php`.

# options

see `pseudo_sendmai.php --help`.

# LICENSE

MIT
