<?php declare(strict_types = 1);

namespace Ssil\Foundation\Exceptions;

use Ssil\Foundation\View;

class HttpException extends \Exception
{
    public static function render(int $httpCode = 404, string $message = 'Page non trouvée'): void
    {
        http_response_code($httpCode);
        View::render('errors.default', [
            'httpCode' => $httpCode,
            'message' => $message,
        ]);
        die;
    }
}
