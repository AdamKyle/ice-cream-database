# Ice Cream Database

[![Build Status](https://travis-ci.org/AdamKyle/ice-cream-database.svg?branch=master)](https://travis-ci.org/AdamKyle/ice-cream-database)
[![Packagist](https://img.shields.io/packagist/v/ice-cream/database.svg)](https://packagist.org/packages/ice-cream/database)
[![Maintenance](https://img.shields.io/maintenance/yes/2017.svg)]()
[![Made With Love](https://img.shields.io/badge/Made%20With-Love-green.svg)]()

**Actual Version: 1.4.0**


A DBAL at the most simplest of terms. Its a thin wrapper around PDO, while returning a connected PDO object.

We can connect to multiple database instances of either PGSQL or MYSQL (see below) and create open connections to each.

- Requires PHP 7
- Is Standalone

## Install

`composer require ice-cream/database`

## Purpose?

I wanted to understand PDO, and I still have a lot to learn about it. I could have used and created a thin wrapper around Doctrines DBAL, much like I did with [Ice Cream Router](https://github.com/AdamKyle/ice-cream-router) in the sense that I did a thin wrapper around Symfony's router.

But I thought I could build something super simple, super easy to get started with and something that
allowed me to understand exactly how PHP connects to a database.

While this isn't as fully flushed out as a regular DBAL, it is a good step in the process. You open a connection, get a db object back, do your work and you move on with your life.

There is room for growth here and room for improvement and your feedback and help will help to shape Ice Cream components into a framework.

## Configuration

Create a new connection instance:

```PHP
use IceCreamDatabase\Connect;

// Similar to that of Laravel if you are familiar.
$connections = [
  'mysql' => [
    'host' => '127.0.0.1',
    'port' => 3306,
    'database' => '',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
  ],
  'pgsql' => [
    'host' => '127.0.0.1',
    'port' => 5432,
    'dbname' => 'scotchbox',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
  ],
  'sqlite' => [
    'temp_file' => ':memory'
  ]
]

// At this time I have made the choice to only support mysql and pgsql as well as sqlite connections.
// More can be added in the future, simplicity was the game here.

$con = new Connect($connections);
```

This will throw a PDO exception if we cannot connect to the database. This constructor will also connect to all databases registered in the connection array.

> ## ATTN!!
>
> At this time the options you see specified in the array are the only ones we accept.
> I wanted to get this component out the door in a couple of days and decided to keep it
> as simple as possible for the first iteration.

So now that we are connected what can we do?

```php
$con->db()->exec( ... );

// Should you have multiple databases configured you can do:

$con->db('mysql')->exec( ... );
$con->db('pgsql')->exec( ... );
$con->db('sqlite')->exec( ... );
```

> ## ATTN!!
>
> Notice in the configuration how we have the key as `mysql` or `pgsql` as well as `sqlite`?
>
> This is important because these correlate to the supported drivers that create the
> connection strings to connect to the database in question.
>
> These names are also whats stored in the associated connections manager that manages all connections.
