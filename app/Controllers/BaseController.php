<?php declare(strict_types = 1);

namespace App\Controllers;

use Faker\Factory;
use Ssil\Foundation\AbstractController;
use Ssil\Foundation\View;

class BaseController extends AbstractController
{
    public function index(): void
    {
        $faker = Factory::create();
        View::render('index', [
            'city' => $faker->city,
        ]);
    }
}
