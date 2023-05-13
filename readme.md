## BasicMVC - Getting Started

## Requirements
- PHP 7.4 or newer
- MySQL database

## Installation
1. Clone the repository:
```
git clone https://github.com/yourusername/BasicMVC
```

2. Navigate to the project folder:
```
cd BasicMVC
```

3. Configure your `config/database.php` with your database connection details.

## Usage
Here are a few examples of how you can use the BasicMVC framework.

### Create a new controller
To create a new controller, use the `make:controller` command:
```
./basic make:controller ExampleController
```
This will create a new controller at `app/controllers/ExampleController.php`.

### Create a new model
To create a new model, use the `make:model` command:
```
./basic make:model ExampleModel
```
This will create a new model at `app/models/ExampleModel.php`.

### Create a new migration
To create a new migration, use the `make:migration` command:
```
./basic make:migration example_migration
```
This will create a new migration file at `database/migrations/example_migration.php`.

### Migrate the database
To apply all pending migrations, use the `migrate` command:
```
./basic migrate
```
This will execute the `up` method of all migration classes that have not yet been applied.

### Serving your application
To serve your application, use the `serve` command:
```
./basic serve 8000
```
This will start a development server at `localhost:8000`.

## Routing
In BasicMVC, you can define all of your route-to-controller mappings in the `routes` directory. Here's a basic example:

```php
// routes/web.php
return [
    'GET' => [
        '/' => 'HomeController@index',
        '/about' => 'AboutController@index',
    ],
    'POST' => [
        //...
    ],
];

// routes/api.php
return [
    'GET' => [
        '/users' => 'UserController@index',
    ],
    'POST' => [
        //...
    ],
];
```

In this example, visiting 'http://localhost:8000/' will trigger the `index` method on `HomeController`, visiting 'http://localhost:8000/about' will trigger the `index` method on `AboutController`, and making a GET request to 'http://localhost:8000/api/users' will trigger the `index` method on `UserController`.