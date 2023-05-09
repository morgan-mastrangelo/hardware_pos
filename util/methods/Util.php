<?php

class Util
{


  public static function getDate($option): string
  {
    $timezone = new DateTimeZone("Asia/Colombo");
    $currentDateandTime = new DateTime("now", $timezone);
    if ($option == "today") {
      $formattedrightnow = $currentDateandTime->format('Y-m-d');
    }
    if ($option == "now") {
      $formattedrightnow = $currentDateandTime->format('Y-m-d H:i:s');
    }
    return $formattedrightnow;
  }
  public static function checkAllEmpty($array)
  {

    $count = count($array);
    $state = false;
    for ($i = 0; $i < $count; $i++) {

      if (empty($array[$i])) {
        $state = true;
      } else {
        $state = false;
        break;
      }
    }

    return $state;
  }
  public static function isInputsEmpty($array){

    $count = count($array);
    //default value is false which means inputs aren't empty
    $state = false;
    for ($i = 0; $i < $count; $i++) {

      if (empty($array[$i])) {
        $state = true;
        break;
      }
    }

    return $state;

  }
  public static function sumUpResultset($resultset, $columnName):int{

        $rowCount= count($resultset);
        $sum = 0;
        for ($i=0; $i <$rowCount ; $i++) { 
           $sum += $resultset[$i][$columnName];
        }
        return $sum; 
  }
}


