[API Index](ApiIndex.md)


IceCreamDatabase\Drivers\PgSql\PgSqlDriver
---------------


**Class name**: PgSqlDriver

**Namespace**: IceCreamDatabase\Drivers\PgSql


**Parent class**: [IceCreamDatabase\Drivers\BaseDriver](IceCreamDatabase-Drivers-BaseDriver.md)





    Creates the connection string for PgSql.

    Responsible for storing basic information about the driver
and how to connect to it.

Creates the basic configiuration string (some drivers may need to do some extra work)
and stores the user name and password for the connection to the database which should
come from the enviroment file.





Properties
----------


**$_charSet**





    private  $_charSet = ''






**$_configurationString**





    protected  $_configurationString = ''






**$_username**





    protected  $_username = ''






**$_password**





    protected  $_password = ''






Methods
-------


public **__construct** ( array $configuration )


Configuration informatiuon for the database.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $configuration | array |  |

--

public **connectionString** (  )


This function returns the $_configurationString

Use this functions to append information to the protected $_configurationString
and then return that as the connection string.


This method is **abstract**.




--

public **username** (  )


Gets the username for the database.








--

public **password** (  )


Gets the password for the database.








--

protected **createConfigurationString** (  $configuration )











**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $configuration | array |  |

--

[API Index](ApiIndex.md)
