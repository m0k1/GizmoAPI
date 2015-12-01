<?php namespace Pisa\GizmoAPI\Adapters;

use Exception;
use GuzzleHttp\Psr7\Response;
use Pisa\GizmoAPI\Contracts\HttpResponse;

class GuzzleResponseAdapter implements HttpResponse
{
    protected $response;
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getHeaders()
    {
        return $this->response->getHeaders();
    }

    public function getBody($autodetect = true)
    {
        if ($autodetect === false) {
            return (string) $this->response->getBody();
        } else {
            $contentType = explode(';', $this->getType())[0];
            if ($contentType === 'application/json') {
                return $this->getJson();
            } else {
                return $this->getString();
            }
        }
    }

    public function getString()
    {
        return (string) $this->response->getBody();
    }

    public function getJson()
    {
        $json = json_decode($this->getBody(false), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $json;
        } else {
            throw new Exception("Json error " . json_last_error_msg());
        }
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    public function getReasonPhrase()
    {
        return $this->response->getReasonPhrase();
    }

    public function getType()
    {
        return $this->response->getHeaderLine('Content-Type');
    }

    public function __toString()
    {
        return $this->getString();
    }

    /**
     * Check that http response body was an array.
     * @return void
     * @throws Exception                        if the body was unexpected
     * @internal                                Intended to use with repositories to validate the responses
     */
    public function assertArray()
    {
        if (!is_array($this->getBody())) {
            throw new Exception("Unexpected response body " . gettype($this->getBody()) . ". Expecting array");
        }
    }

    /**
     * Check that http response body was a boolean.
     * @return void
     * @throws Exception                        if the body was unexpected
     * @internal                                Intended to use with repositories to validate the responses
     */
    public function assertBoolean()
    {
        if (!is_bool($this->getBody())) {
            throw new Exception("Unexpected response body " . gettype($this->getBody()) . ". Expecting boolean");
        }
    }

    /**
     * Check that http response body was empty.
     * @return void
     * @throws Exception                        if the body was unexpected
     * @internal                                Intended to use with repositories to validate the responses
     */
    public function assertEmpty()
    {
        if ($this->getBody() != '') {
            throw new Exception("Unexpected response body " . gettype($this->getBody()) . ". Expecting none");
        }
    }

    /**
     * Check that http response body was an integer.
     * @return void
     * @throws Exception                        if the body was unexpected
     * @internal                                Intended to use with repositories to validate the responses
     */
    public function assertInteger()
    {
        if (!is_int($this->getBody())) {
            throw new Exception("Unexpected response body " . gettype($this->getBody()) . ". Expecting integer");
        }
    }

    /**
     * Check that http response status codes match the codes we are expecting for.
     * @param  int|array           $statusCodes Array of status codes to be expected. Can be a single status code too.
     * @return void
     * @throws Exception                        if the status code was unexpected
     * @internal                                Intended to use with repositories to validate the responses
     */
    public function assertStatusCodes($statusCodes = [])
    {
        if (is_numeric($statusCodes)) {
            $statusCodes = [(int) $statusCodes];
        }

        if (!in_array($this->getStatusCode(), $statusCodes)) {
            throw new Exception("Unexpected HTTP Code " . $this->getStatusCode() . ". Expecting " . implode(',', $statusCodes));
        }
    }

}
