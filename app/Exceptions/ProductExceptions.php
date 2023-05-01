<?php
namespace App\Exceptions;

use JsonSerializable;
use Mockery\Exception;

class ProductExceptions extends Exception implements JsonSerializable{

    private $exception_list = [
        "ProductExceptions", // code : 0
        "ProductPriceMisMatchException", // code : 1
        "ProductCashbackException", // code : 2
        "ProductTotalPriceException", // code : 3
        "ProductEwalletException", // code : 4
        "ProductAddressException" // code : 5
    ];
    private $meta_data;
    public $exception_type;

    public function __construct(array $e = [])
    {
        $message = $e['message'] ?? null;
        $code = $e['code'] ?? 0;
        $previous = $e['previous'] ?? null;
        $this->exception_type = $this->exception_list[$code];
        $this->meta_data = $e['meta-data'] ?? null;
        parent::__construct($message, $code, $previous);
    }

    public function jsonSerialize()
    {
        return $this->returnException();
    }
    public function getMetaData()
    {
        return $this->meta_data;
    }
    public function getException()
    {
        return $this->{$this->exception_type}();
    }
    public function returnException() {
        return [
            "message" => $this->getMessage(),
            "line" => $this->getLine(),
            "code" => $this->getCode(),
            "file" => $this->getFile(),
            "Exception" => get_class($this),
            "ExceptionType" => $this->exception_type,
            "meta-data" => $this->getMetaData(),
        ];
    }



    public function ProductExceptions()
    {
        return $this->returnException();
    }
    public function ProductPriceMisMatchException()
    {
        return $this->returnException();
    }
    public function ProductCashbackException()
    {
        return $this->returnException();
    }
    public function ProductTotalPriceException()
    {
        return $this->returnException();
    }
    public function ProductEwalletException()
    {
        return $this->returnException();
    }
    public function ProductAddressException()
    {
        return $this->returnException();
    }

}



