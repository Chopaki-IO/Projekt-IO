 <?php
function __autoload($className)
{
   require($className.'.class.php');
} // end __autoload();

    ?>