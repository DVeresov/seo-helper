<?php
declare(strict_types=1);


namespace Framework\Container\Execptions;

use Psr\Container\ContainerExceptionInterface;

class ContainerException extends \Exception implements ContainerExceptionInterface
{
}