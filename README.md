# SymfonyConsoleModule

Symfony Console Module for Zend Framework. Note that this is a full replacement for the Zend Console so your zend commands will not work any longer.

See [Symfony Console](http://symfony.com/doc/2.0/components/console/index.html) on how to write commands.

## Installation

Installation of DoctrineModule uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

  1. `cd my/project/directory`
  2. create or modify the `composer.json` file within your ZF2 application file with
     following contents:

     ```json
     {
         "require": {
             "wfk/symfony-console-module": "*"
         }
     }
     ```
  3. install composer via `curl -s https://getcomposer.org/installer | php` (on windows, download
     https://getcomposer.org/installer and execute it with PHP). Then run `php composer.phar install`
  4. open `my/project/directory/configs/application.config.php` and add the following key to your `modules`:

     ```php
     'SymfonyConsoleModule',
     ```

## Register commands

All commands registered in config[console][commands] get pulled from the service locator and placed in the Symfony console application.

```php
<?php
return array(
    'console' => array(
        'commands' => array(
            'MyService\LocatorAlias\ToCommand'
        )
    )
);
```

## Running commands

To run your console app simply run index.php. From your project root:

`php public/index.php <arguments>`


## Extra configuration

The following extra configurations are optional for the Symfony console application.

```php
<?php
return array(
    'console' => array(
        'name' => 'Some console title',
        'version' => 'Some console version',
        'commands' => array(
            // ...
        ),
    )
);
```