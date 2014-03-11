<?php

namespace Buzz\Client;

use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Exception\ClientException;
use Buzz\Exception\LogicException;

class Curl extends AbstractCurl
{
    private $lastCurl;

    public function send(RequestInterface $request, MessageInterface $response, array $options = array())
    {
        if (is_resource($this->lastCurl)) {
            curl_close($this->lastCurl);
        }

        $this->lastCurl = static::createCurlHandle();
        $this->prepare($this->lastCurl, $request, $options);
//        curl_setopt($this->lastCurl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($this->lastCurl, CURLINFO_HEADER_OUT, true);

        $data = curl_exec($this->lastCurl);

        
        if (false === $data) {
            $errorMsg = curl_error($this->lastCurl);
            $errorNo  = curl_errno($this->lastCurl);

//            echo '<hr /><textarea>';
//        print_r($data);
//        echo '</textarea><br /><textarea>'.(curl_getinfo($this->lastCurl,CURLINFO_HEADER_OUT)).'</textarea><textarea>'.$errorMsg."\n".$errorNo.'</textarea><hr /><br />';
            throw new ClientException($errorMsg, $errorNo);
        }else{
//            echo '<textarea>';
//        print_r($data);
//        echo '</textarea><br /><textarea>'.(curl_getinfo($this->lastCurl,CURLINFO_HEADER_OUT)).'</textarea><br/><hr/>';
        }

        static::populateResponse($this->lastCurl, $data, $response);
    }

    /**
     * Introspects the last cURL request.
     *
     * @see curl_getinfo()
     */
    public function getInfo($opt = 0)
    {
        if (!is_resource($this->lastCurl)) {
            throw new LogicException('There is no cURL resource');
        }

        return curl_getinfo($this->lastCurl, $opt);
    }

    public function __destruct()
    {
        if (is_resource($this->lastCurl)) {
            curl_close($this->lastCurl);
        }
    }
}
