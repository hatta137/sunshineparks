<?php


// represents the basic view - extracts parameters and passes them to the view
class View
{
   public static function render($viewPath, $params) :void{
      extract($params);

      $body = '';

      ob_start(); {
         include $viewPath;
      }


      $body = ob_get_clean();

      echo $body;
   }




}
