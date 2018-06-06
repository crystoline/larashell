<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# larashell

Laravel: Run shell command without shell access over http

[![Say Thanks!](https://img.shields.io/badge/Say%20Thanks-!-1EAEDB.svg)](https://saythanks.io/to/crystoline)

## Requirement
* Laravel ^5.1
* PHP ^5.5

## Install

Via Composer

``` bash
$ composer require crystoline/larashell
```

Add the following provider to providers part of config/app.php

``` php
Crystoline\LaraShell\LarashellProvider::class
```
## Usage

Access the terminal via 

``` html
  http://your-url.com/larashell
``` 
## Note

LaraShell does not work exactlly like shell terminal. You have to run your commands on seperate line because it is not interrative. 
it does keep the state from previous command. 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
