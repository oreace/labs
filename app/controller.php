<?php
$url = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
//print_r($url);
if (empty($url[0])) 
{
require_once('home.php');
}else
{ 
    if (isset($url[2])) {
    $hack = "app/".$url[0] .".php";
    
    if (file_exists($hack)) {
       require_once($hack);
       if (function_exists('hack2'))
       {
      //  hack2($url[2]);
       }
       else
       {
        error();
       }
       } else {
     error();    
  }
  }        
  
    if (isset($url[1])) {
    $hack = "app/".$url[0] .".php";
    
    if (file_exists($hack)) {
        require_once($hack);
       if (function_exists('hack1'))
       {
      //  hack1($url[1]);
       }
       else
       {
        error();
       }
       } 
       else 
       {
    
    $admin = "qa/". $url[1]. ".php";
    if (file_exists($admin)) 
    {
    require_once($admin);
    }
    else
    {
     error();
    }
    
    }
    }       
   
   
      $file = $url[0] .".php";
       if (file_exists($file)) {
       $hack = "app/".$url[0] .".php";
       if (file_exists($hack))
       {
        require_once($hack);
       }     
        require_once($file);
        } else {
         $admin = "qa/". $url[1]. ".php";
         if (!file_exists($admin)) 
         {
         error();
         }
    }
      
}   
function error()
{
    echo "<script>window.open('../404','_self')</script>";
}    

?>