[API Index](ApiIndex.md)


IceCreamDatabase\Drivers\DriverFactory
---------------


**Class name**: DriverFactory

**Namespace**: IceCreamDatabase\Drivers







    Returns the appropriate driver for the connection.

    Simple factory to determine if we need a PSQL or MYSQL driver
returned based on the type.





Properties
----------


**$_type**





    private  $_type






**$_configuration**





    private  $_configuration






Methods
-------


public **__construct** ( String $type, Array $configuration )


Accepts the type and the configuration to return a driver.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $type | String |  |
| $configuration | Array |  |

--

public **createDriverInstance** (  )


Creates a driver instance for connecting to the database.








--

[API Index](ApiIndex.md)
