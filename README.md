# phpKew

Library for easy access to Kew's nomenclatural and taxonomic services. Hides the intricacies of using the HTTP API.
This library provides the same functionality as the Python library [pykew](https://github.com/RBGKew/pykew), being just a translation to PHP.

## Features

- Perform the same tasks as the Python library pykew.
- Access and manipulate data from Kew's Python API using PHP.

## Installation

To use this library, you need to have PHP installed on your system. You can then install the library using [Composer](https://getcomposer.org/).

1. Open a terminal and navigate to your project directory.
2. Run the following command to install the library:

   ````
   composer require somms/phpkew
   ```

3. Include the library in your PHP code:

   ````php
   require_once 'vendor/autoload.php';
   ```

## Usage

Here's an example of how to use the library with the POWO API:

```php
// Include the library
require_once 'vendor/autoload.php';

use Somms\PHPKew\POWO\Enums\Characteristic;
use Somms\PHPKew\POWO\Enums\Filters;
use Somms\PHPKew\POWO\Enums\Geography;
use Somms\PHPKew\POWO\Enums\Name;
use Somms\PHPKew\POWO\POWOApi;

// Create a new instance of the pykew-php library
$powoApi = new POWOApi();

// Do a basic search
$result = $powoApi->search('Poa annua');

// $result extends ArrayIterator class

// Do an advanced search, filtering by several fields.
$query = [Name::GENUS => 'Poa', Name::SPECIES => 'annua', Name::AUTHOR => 'L.'];
$result = $powoApi->search($query);

```

IPNI and KPL are pretty similar. Enums of each API include available filters for each API.


## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

## Project Status

This project is actively maintained and welcomes contributions from the community.

---