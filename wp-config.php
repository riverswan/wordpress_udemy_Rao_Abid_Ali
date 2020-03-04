<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wpdub' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h3!wiclyXCL%sKd!v):K5S_Q8j6MQNR[A>mLB%!O&6AS(M[FH88<p4CyE3}>zn}1' );
define( 'SECURE_AUTH_KEY',  'bx:]Rm.9F]UQoD%~9[/s5R#-|~)W4dugBC,9^]o8QX 0W$Nj7C,+CMp0u}x$X_,V' );
define( 'LOGGED_IN_KEY',    '>74)_:`)a! 2z-H)&#H J*Y*#.4Q7>JL$<Ow/f!JAZo*%,JkIrnzzyVtL/zDHX$*' );
define( 'NONCE_KEY',        'U[Y~B)tSboWUw@@_8i*9{~f5khYE;qM#$fr)wKw:,3<jA2l5ntc%@.UjWJJc%+UB' );
define( 'AUTH_SALT',        '2cO+rq-c[D+GQGrf(nE=%Zw+N|#U$9[hFyozh^s%^VXVq g]4Dhea&1V=+A}*rg5' );
define( 'SECURE_AUTH_SALT', 'H[FIax^ad)O7%c9,*>w7BLI?gZk28cL5^d 3;=12IOowvjq]|}F61Okwn`_O[G5C' );
define( 'LOGGED_IN_SALT',   '/2#2[lmuaQj}@@1z;6>N|b-bjCD*grBplz01pr2k&lvvQjwYj;b??kwU^<eb`G%g' );
define( 'NONCE_SALT',       'TY9=~4r%&L=VL>kUX?>jwKNCI4RB`@@20yU.2v?n<;lJLkmBLI~uXlY~h1%LiSR0' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
