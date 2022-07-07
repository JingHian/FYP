<?php
class Validation
{

  function validateSpace($data) //check if input has spaces
  {
    if (preg_match("/[^\S*$]/",$data) == true)
    {
      return false;
    }
    return true;
  }

  function trimAndStrip($data) //trim and strip input
  {
    $retval = trim($data);
    $retval = stripslashes($retval);
    return $retval;
  }
}
 ?>
