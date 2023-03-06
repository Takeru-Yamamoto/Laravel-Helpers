<?php

use App\Models\User;

if (!function_exists('isLoggedIn')) {

    /**
     * ログインしているかどうか
     */
    function isLoggedIn(): bool
    {
        return auth()->check();
    }
}


if (!function_exists('userCan')) {

    /**
     * user に attribute の権限が付与されているか
     *
     * @param string $attribute
     * @param User|null $user
     */
    function userCan(string $attribute, User $user = null): bool
    {
        if (is_null($user)) $user = authUser();
        return $user->can($attribute);
    }
}


if (!function_exists('isSystem')) {

    /**
     * user に system権限が付与されているか
     *
     * @param User|null $user
     */
    function isSystem(User $user = null): bool
    {
        return userCan("system", $user);
    }
}


if (!function_exists('isAdmin')) {

    /**
     * user に admin権限が付与されているか
     *
     * @param User|null $user
     */
    function isAdmin(User $user = null): bool
    {
        return userCan("admin", $user);
    }
}


if (!function_exists('isUser')) {

    /**
     * user に user権限が付与されているか
     *
     * @param User|null $user
     */
    function isUser(User $user = null): bool
    {
        return userCan("user", $user);
    }
}


if (!function_exists('isAdminHigher')) {

    /**
     * user に admin-higher権限が付与されているか
     *
     * @param User|null $user
     */
    function isAdminHigher(User $user = null): bool
    {
        return userCan("admin-higher", $user);
    }
}


if (!function_exists('isUserHigher')) {

    /**
     * user に user-higher権限が付与されているか
     *
     * @param User|null $user
     */
    function isUserHigher(User $user = null): bool
    {
        return userCan("user-higher", $user);
    }
}


if (!function_exists('authUser')) {

    /**
     * ログイン中のユーザを取得
     */
    function authUser(): User
    {
        return auth()->user();
    }
}


if (!function_exists('authUserProperty')) {

    /**
     * ログイン中のユーザのプロパティを取得
     */
    function authUserProperty(string $key): mixed
    {
        return isset(authUser()->$key) ? authUser()->$key : null;
    }
}


if (!function_exists('authUserId')) {

    /**
     * ログイン中のユーザの id を取得
     */
    function authUserId(string $key = null): mixed
    {
        return authUserProperty(is_string($key) ? $key : "id");
    }
}


if (!function_exists('authUserName')) {

    /**
     * ログイン中のユーザの name を取得
     */
    function authUserName(string $key = null): mixed
    {
        return authUserProperty(is_string($key) ? $key : "name");
    }
}


if (!function_exists('authUserRole')) {

    /**
     * ログイン中のユーザの role を取得
     */
    function authUserRole(string $key = null): mixed
    {
        return authUserProperty(is_string($key) ? $key : "role");
    }
}
