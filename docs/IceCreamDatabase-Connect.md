[API Index](ApiIndex.md)


IceCreamDatabase\Connect
---------------


**Class name**: Connect

**Namespace**: IceCreamDatabase







    This is how you connect to the database of your choice.

    Configuration is an array of driver => config:

<pre>
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
  'sqlite' => [ 'templ_file' => ':memory' ]
]
</pre>

This is then passed into constructor and the associated connections are created.

You then have access to db() method where you can pass in a connection name of mysql or psql
to get the associated connection or pass in nothing and get the default connection.

This is a thin wrapper around PDO so you have access to all the PDO methods and are responsible
for handling how you disconnect, which you can do by: $conn->manager->closeAllConnections() to close
all database connections.





Properties
----------


**$_databaseDrivers**





    private  $_databaseDrivers = array()






**$_connectionManager**





    private  $_connectionManager = null






Methods
-------


public **__construct** ( array $config )


Connect to the database.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $config | array |  |

--

public **db** ( String $name )


Get the database connection.

If no name is passed in, we return the derfault connection.






**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | String | &lt;p&gt;name - optional&lt;/p&gt; |

--

public **manager** (  )


Get the database connection manager.








--

protected **connect** (  $config )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $config | array |  |

--

protected **getDatabaseHandlers** (  $config )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $config | array |  |

--

public **getConnections** (  )


Get an array of connections.

This method is only public for testing purposes to be able to mock the method
and return fake PDO objects. You should enevr call this directly.






--

[API Index](ApiIndex.md)
