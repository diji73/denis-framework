<?php declare(strict_types = 1);

use Ssil\Foundation\Authentication;
use Ssil\Foundation\Router\Router;
use Ssil\Foundation\Session;
use Ssil\Foundation\View;

if (!function_exists('auth')) {
    function auth(): Authentication
    {
        return new Authentication();
    }
}

if (!function_exists('route')) {
    function route(string $name, array $data = []): string
    {
        return Router::get($name, $data);
    }
}

if (!function_exists('errors')) {
    function errors(?string $field = null): ?array
    {
        $errors = Session::getFlash(Session::ERRORS);
        if ($field) {
            return $errors[$field] ?? null;
        }
        return $errors;
    }
}

if (!function_exists('status')) {
    function status(): ?string
    {
        return Session::getFlash(Session::STATUS);
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return View::csrfField();
    }
}

if (!function_exists('method')) {
    function method(string $httpMethod): string
    {
        return View::method($httpMethod);
    }
}

if (!function_exists('old')) {
    function old(string $key, mixed $default = null): mixed
    {
        return View::old($key, $default);
    }
}
