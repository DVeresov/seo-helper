<?php
declare(strict_types=1);


namespace Framework\Exception;

class HttpException extends \Exception
{
    protected $message;
    private int $statusCode;

    /**
     * @param int $statusCode
     */
    public function __construct($message, int $statusCode=500)
    {
        $this->statusCode = $statusCode;
        parent::__construct($message, $statusCode);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): HttpException
    {
        $this->statusCode = $statusCode;
        return $this;
    }

}