UPGRADE FROM 1.x to 2.0
=======================

File Limit
-------

 * The `AbstractLogger::setSizeLimit()` method is removed. Use
   `AbstractLogger::setSizeLimitInBytes()` or `AbstractLogger::setSizeLimitInMB()`
   instead.

   Before:

   ```php
   $logger = new NormaLogger();

   $logger->setSizeLimit(42);
   ```

   After:

   ```php
   $logger = new NormaLogger();
   $logger->setSizeLimitInBytes(1024);
   ```

   or ...

   ```php
   $logger = new NormaLogger();
   $logger->setSizeLimitInMB(1);
   ```
