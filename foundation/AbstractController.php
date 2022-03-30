<?php declare(strict_types = 1);

namespace Ssil\Foundation;

use Ssil\Foundation\Router\Router;

abstract class AbstractController
{
    protected function redirect(string $name, array $data = []): void
    {
        header(sprintf('Location: %s', Router::get($name, $data)));
        die;
    }
}
