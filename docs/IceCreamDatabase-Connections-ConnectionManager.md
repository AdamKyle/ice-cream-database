[API Index](ApiIndex.md)


IceCreamDatabase\Connections\ConnectionManager
---------------


**Class name**: ConnectionManager

**Namespace**: IceCreamDatabase\Connections







    Manage database connections.

    We store a seet of connections based on your connection array and then
allow you the developer to handle how those connections are managed.

When storing one or more, we use the first connection as the default connection.
This can be changed via the setDefaultConnection method.

Its important to know that connections must be closed by the developer, we do not handle
closing and opening connections.





Properties
----------


**$_connections**





    private  $_connections = array()






**$_driverInstances**





    private  $_driverInstances = array()






**$_defaultConnection**





    private  $_defaultConnection = null






**$_currentConnectionName**





    private  $_currentConnectionName = ''






Methods
-------


public **__construct** ( array $connections )


Takes in a set of connections and stores them.

Connections cannot be empty.

Connections are a associative array of name =&gt; \PDO connection.






**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $connections | array |  |

--

public **getAllConnections** (  )


Get all the connections registered.

Some connections may be NULL, due to being closed.






--

public **getConnection** ( String $name )


Get the specified connection, default connection or return null








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | String | &lt;p&gt;name - optional&lt;/p&gt; |

--

public **setDefaultConnection** ( String $name )


Set a default connection other then whats already set.

By default if you have more then one connection the first connection is the default.
How ever you can set a different connection as a default.

If the connection cannot be found we return false.






**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $name | String | &lt;p&gt;name&lt;/p&gt; |

--

public **getCurrentConnectionName** (  )


Returns the current connection name.








--

protected **storeAllContections** (  $connections )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $connections | array |  |

--

[API Index](ApiIndex.md)
