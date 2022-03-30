<?php declare(strict_types = 1);

namespace Ssil\Foundation;

use App\Models\User;

class Authentication
{
    protected const SESSION_ID = 'user_id';

    public static function check(): bool
    {
        return (bool) Session::get(static::SESSION_ID);
    }

    public static function checkIsAdmin(): bool
    {
        return static::check() && static::get()->role === 'admin';
    }

    public static function verify(string $email, string $password): bool
    {
        $user = User::where('email', $email)->first();
        return $user && password_verify($password, $user->password);
    }

    public static function authenticate(int $id): void
    {
        Session::add(static::SESSION_ID, $id);
    }

    public static function logout(): void
    {
        Session::remove(static::SESSION_ID);
    }

    public static function id(): ?int
    {
        return Session::get(static::SESSION_ID);
    }

    public static function get(): ?User
    {
        return User::find(static::id());
    }
}
