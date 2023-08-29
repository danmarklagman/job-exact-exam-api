<?php

namespace App\Exceptions;

use Exception;

/**
 * Class HttpJsonResponseException
 * @package App\Exceptions
 */
class HttpJsonResponseException extends Exception
{
    /**
     * @var int $status
     */
    protected int $status;

    /**
     * @var string $errorCode
     */
    protected string $errorCode;

    /**
     * @var array $errors
     */
    protected array $errors;

    /**
     * @var array $data
     */
    protected array $data;

    /**
     * HttpJsonResponseException constructor.
     * @param  int  $status
     * @param  string  $errorCode
     * @param  string  $message
     * @param  array  $errors
     * @param  array  $data
     */
    public function __construct(int $status, string $errorCode, $message = '', array $errors = [], array $data = [])
    {
        parent::__construct($message);

        $this->status = $status;
        $this->errorCode = $errorCode;
        $this->errors = $errors;
        $this->data = $data;
    }

    /**
     * Get HTTP status.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Get error code.
     *
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * Get a list of errors.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get request data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
