<?php

namespace PhpFromZero\Http;

/**
 * 
 * The HTTP response to send to the browser
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class Response
{


    /**
     * @var string The page content
     */
    protected $content;

    /**
     * @var array The HTTP response header
     */
    protected $headers;

    /**
     * @var int The HTTP response status code
     */
    protected $status;

    /**
     * @var int The HTTP response status code text
     */
    protected $statusText;





    public function __construct(?string $content = '', int $status = 200, string $statusText = "Not Found", array $headers = [])
    {
        $this->setContent($content);
        $this->setStatus($status);
        $this->setStatusText($statusText);
        $this->setHeaders($headers);
    }



    /**
     * 
     * Send the response headers
     * 
     * @return self
     */
    public function sendHeaders()
    {
        //If header is already send skipped
        if (headers_sent()) {
            return $this;
        }

        // Set header
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }

        // Set status
        header(sprintf('HTTP/1.0 %s %s',  $this->status, $this->statusText), true, $this->status);

        return $this;
    }



    /**
     * Send the page content to the browser
     * 
     * @return self
     */
    public function sendContent()
    {
        echo $this->content;

        return $this;
    }

    /**
     * Send request => Send the headers and content, then finish the request
     *
     *  @return self
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
        return $this;
    }



    /**
     * Get the value of content
     * 
     * @return string The HTTP response content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * 
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Get the value of status
     * 
     * @return int The HTTP status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param int The HTTP response status code
     * 
     * 
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of statusText
     * 
     * 
     * @return  The HTTP response status text
     */
    public function getStatusText()
    {
        return $this->statusText;
    }

    /**
     * Set the value of statusText
     *
     * @param int The HTTP response status text
     * 
     * 
     * 
     */
    public function setStatusText($statusText)
    {
        $this->statusText = $statusText;

        return $this;
    }

    /**
     * Get the value of headers
     * 
     *  @return  array The response headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @param array $headers The HTTP response header
     * 
     * 
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }
}
