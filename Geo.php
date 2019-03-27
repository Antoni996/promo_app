<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 18/07/18
 * Time: 15.56
 */

session_start();

class Geo
{
    protected  $api = 'http://ip-api.com/json/%s';

    protected $properties = [];

    //protected $city;
    public function __get($key)
    {
        // TODO: Implement __get() method.
         //echo $key;

        if (isset($this->properties[$key]))
        {
            return $this->properties[$key];
        }
        echo null;

    }


    public function request($ip)
    {
        $url  = sprintf($this->api, $ip);
        $data = $this->sendRequest($url);

        $this->properties = json_decode($data, true);

        //var_dump($this->properties);


    }

    protected function sendRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        return curl_exec($curl);
    }

    public function like_match($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }

}

?>

