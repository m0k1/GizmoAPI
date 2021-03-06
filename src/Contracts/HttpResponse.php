<?php namespace Pisa\GizmoAPI\Contracts;

interface HttpResponse
{
    /**
     * Check that http response body was an array.
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the response body was unexpected
     */
    public function assertArray();

    /**
     * Check that http response body was a boolean.
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the response body was unexpected
     */
    public function assertBoolean();

    /**
     * Check that http response body was empty.
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the response body was unexpected
     */
    public function assertEmpty();

    /**
     * Check that http response body was an integer.
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the response body was unexpected
     */
    public function assertInteger();

    /**
     * Check that http response status codes match the codes we are expecting for.
     * @param  int|array $statusCodes Array of status codes to be expected. Can be a single status code too.
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the status code was unexpected
     */
    public function assertStatusCodes($statusCodes = []);

    /**
     * Check that http response body was string.
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the response body was unexpected
     */
    public function assertString();

    /**
     * Check that http response body is a time
     * @return void
     * @throws \Pisa\GizmoAPI\Exceptions\UnexpectedResponseException if the response body was unexpected
     */
    public function assertTime();

    /**
     * Gets the response body
     * @param  boolean $autodetect Autodetect the content type and give the response accordingly. Defaults to true
     * @return mixed               Response body. If autodetect is false it returns the response string.
     */
    public function getBody($autodetect = true);

    /**
     * Get single response header
     * @param   $header Header key
     * @return  string
     */
    public function getHeader($header);

    /**
     * Get the response headers
     * @return array
     */
    public function getHeaders();

    /**
     * Get the body json and decode it
     * @return mixed     Response
     */
    public function getJson();

    /**
     * Get the reason phrase for the according status code
     * @return string
     */
    public function getReasonPhrase();

    /**
     * Get the http status code
     * @return int
     */
    public function getStatusCode();

    /**
     * Get the body as a string
     * @return string
     */
    public function getString();

    /**
     * Get the content type
     * @return string
     */
    public function getType();
}
