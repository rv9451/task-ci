# TaskCI - CodeIgniter 3 Project Setup Guide

This is a CodeIgniter 3 application for task management.

## Prerequisites

- PHP 5.6 or higher
- MySQL or compatible database
- Web server (Apache recommended)
- XAMPP or similar local development environment

## Installation Steps

### 1. Download CodeIgniter 3

Download CodeIgniter 3 from the official website: [https://codeigniter.com/download](https://codeigniter.com/download)

### 2. Extract Files

Extract the downloaded CodeIgniter 3 archive inside your web server's document root directory (htdocs for XAMPP).

For example, if using XAMPP:
- Extract to: `C:\xampp\htdocs\taskci`

### 3. Configure Base URL

Open `application/config/config.php` and set the base URL to match your project root:

```php
$config['base_url'] = 'http://localhost/taskci/';
```

Replace `taskci` with your actual project folder name.

### 4. Enable Configuration Settings

#### Database Configuration
Open `application/config/database.php` and configure your database settings:

```php
$db['default'] = array(
    'dsn'      => '',
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'your_database_name',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

#### Autoload Configuration
Open `application/config/autoload.php` to enable autoloading:

```php
$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'form');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array();
```

#### Hooks Configuration
Open `application/config/hooks.php` to enable hooks if needed:

```php
$hook['pre_controller'] = array(
    'class'    => 'Task_hook',
    'function' => 'pre_controller',
    'filename' => 'Task_hook.php',
    'filepath' => 'hooks'
);
```

#### Routes Configuration
Routes are defined in `application/config/routes.php`. Key routes include:

- Default controller: `$route['default_controller'] = 'welcome';`
- 404 override: `$route['404_override'] = '';`
- Translate URI dashes: `$route['translate_uri_dashes'] = FALSE;`

Custom routes can be added here, for example:
```php
$route['tasks'] = 'task_controller/index';
$route['tasks/create'] = 'task_controller/create';
```

#### Other Important Configurations

- **Constants**: `application/config/constants.php` - Define application constants
- **Mimes**: `application/config/mimes.php` - MIME types configuration
- **Profiler**: `application/config/profiler.php` - Enable/disable profiler
- **Migration**: `application/config/migration.php` - Database migration settings
- **Memcached**: `application/config/memcached.php` - Caching configuration

### 5. Set Up Database

Create a database in MySQL and run any SQL files in the project if provided.

### 6. Access the Application

Open your browser and navigate to: `http://localhost/taskci`

## Project Structure

- `application/controllers/` - Controller files
- `application/models/` - Model files
- `application/views/` - View files
- `application/config/` - Configuration files
- `application/libraries/` - Custom libraries
- `application/helpers/` - Helper functions
- `assets/` - CSS, JS, images
- `system/` - CodeIgniter core files

## Key Features

- Task management system
- User authentication
- Dashboard view
- File upload functionality

## Development Notes

- Environment is set to 'production' by default in `index.php`
- Change to 'development' for debugging: `define('ENVIRONMENT', 'development');`
- Logs are stored in `application/logs/`

## Troubleshooting

- Ensure PHP version compatibility
- Check file permissions for writable directories (logs, cache, uploads)
- Verify database connection settings
- Clear browser cache if experiencing issues