<?php declare(strict_types = 1);

namespace Ssil\Foundation;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class View
{
    public static function render(string $view, array $data = []): void
    {
        $view = str_replace('.', '/', $view);
        if (!static::viewExists($view)) {
            throw new \InvalidArgumentException(
                sprintf('La vue %s n\'existe pas', $view)
            );
        }
        $twig = static::initTwig();
        echo $twig->render(
            sprintf('%s.%s', $view, Config::get('twig.template_extension')),
            $data
        );
    }

    protected static function viewExists(string $view): bool
    {
        return file_exists(
            sprintf('%s/resources/views/%s.%s', ROOT, $view, Config::get('twig.template_extension'))
        );
    }

    protected static function initTwig(): Environment
    {
        $loader = new FilesystemLoader(ROOT.'/resources/views');
        $twig = new Environment($loader, [
            'cache' => ROOT.'/cache/twig',
            'auto_reload' => true,
        ]);
        foreach (Config::get('twig.functions') as $helper) {
            $twig->addFunction(new TwigFunction($helper, $helper));
        }
        return $twig;
    }

    public static function csrfField(): string
    {
        return sprintf('<input type="hidden" name="_token" value="%s">', Session::get('_token'));
    }

    public static function method(string $httpMethod): string
    {
        return sprintf('<input type="hidden" name="_method" value="%s">', $httpMethod);
    }

    public static function old(string $key, mixed $default = null): mixed
    {
        $old = Session::getFlash(Session::OLD);
        return $old[$key] ?? $default;
    }
}
