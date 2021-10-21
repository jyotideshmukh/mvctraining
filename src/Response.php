<?php


namespace App;
/***
 * Class Response
 * @package App
 */

class Response
{
    /**
     * @param int $statusCode
     */
        public  function setStatusCode(int $statusCode){
            http_response_code($statusCode);
        }

}