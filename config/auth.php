<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el "guard" de autenticación predeterminado y las
    | opciones de restablecimiento de contraseñas para tu aplicación.
    |
    */

    'defaults' => [
        'guard' => 'web',  // Guard por defecto
        'passwords' => 'users',  // Configuración para restablecer contraseñas
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Aquí defines todos los guards de autenticación para tu aplicación.
    | La configuración por defecto usa almacenamiento de sesiones y 
    | el proveedor de usuarios Eloquent.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Aquí defines los proveedores de usuarios, que determinan cómo se obtienen
    | los usuarios de la base de datos o de otro almacenamiento.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Modelo de usuario
        ],

        // Si deseas usar el proveedor basado en base de datos
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configuraciones para el restablecimiento de contraseñas.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',  // Tabla que almacena los tokens
            'expire' => 60,  // Tiempo de expiración de los tokens
            'throttle' => 60,  // Tiempo de espera entre intentos
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Aquí defines la cantidad de segundos antes de que una confirmación
    | de contraseña caduque y el usuario necesite ingresar su contraseña nuevamente.
    |
    */

    'password_timeout' => 10800,

];
