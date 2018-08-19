# Blackout

This is my take on the refactoring of **XNova** script, an open source clone of
OGame. Probably totally pointless as the original is not just dated, its codebase
was terrible even back in the days.

![Screenshot](http://sobak.pl/assets/images/blackout.png)

I still wanted to approach this challenge to check how far can XNova be modernized
and how to handle it without getting myself mentall illness. Feel free to browse
the code, commits history and outcoming result. It is now the Laravel project which
can be run using simple `php artisan serve` and heading to index. Installer will take
care of rest, all you need is PHP (with Composer) and MySQL.

> **Warning:** This is not production ready project (neither is XNova, though).

For the final note, this repository does not show the perfect way to refactor old code.
Doing that properly should start with covering everything with tests so that nothing
gets actidentially broken (or fixed) along the way.

## Implementation
The most cryptic and interesting part of the implementation might be a _proxy_
between old XNova's code and Laravel application that allows to refactor the
system step by step. To check how it's done I suggest to start the journey from
[`index.php`][index] file.

[index]: https://github.com/Sobak/blackout/blob/master/public/index.php
