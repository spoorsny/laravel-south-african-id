![Repository+Banner](https://banners.beyondco.de/South%20African%20ID%20for%20Laravel.png?theme=light&packageManager=composer+require&packageName=spoorsny%2Flaravel-south-african-id&pattern=circuitBoard&style=style_1&description=Validation+rules+and+an+Eloquent+Model+attribute+cast+to+value+object+encapsulating+a+South+African+government-issued+personal+identification+number,+for+Laravel.&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spoorsny/laravel-south-african-id.svg?style=flat-square)](https://packagist.org/packages/spoorsny/laravel-south-african-id)
[![Total Downloads](https://img.shields.io/packagist/dt/spoorsny/laravel-south-african-id.svg?style=flat-square)]("https://packagist.org/packages/spoorsny/laravel-south-african-id")
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spoorsny/laravel-south-african-id/continuous-integration.yml?branch=master&label=tests&style=flat-square)](https://github.com/spoorsny/laravel-south-african-id/actions?query=workflow%3Acontinuous-integration+branch%3Amaster)
[![PHPUnit Code Coverage](https://github.com/spoorsny/laravel-south-african-id/blob/image-data/coverage.svg)](https://github.com/spoorsny/laravel-south-african-id/actions?query=workflow%3Acontinuous-integration+branch%3Amaster)

# South African ID for Laravel

The validator will pass values generated by the Faker
[idNumber](https://fakerphp.org/locales/en_ZA/#fakerprovideren_zaperson)
formatter that is part of the English (South Africa) or `en_ZA` locale.
Validation rules and an Eloquent Model attribute cast to value object encapsulating a South African government-issued personal identification number, for Laravel.

## Install

Use [Composer](https://getcomposer.org) to install the package.

```shell
composer require spoorsny/laravel-south-african-id
```

## Usage

### Validation Rules

A value submitted in a request can be validated to be a South African ID.

```php
use Spoorsny\Laravel\Rules\SouthAfricanId;

$request->validate([
    'id_number' => ['required', 'string', new SouthAfricanId()],
]);
```

If the request also contains a birth date field, that field can be validated to
match the South African ID using the `BirthDateMatchSouthAfricanId` rule. In
this case, the field containing the South African ID, must be named
`south_african_id`.

```php
use Spoorsny\Laravel\Rules\BirthDateMatchSouthAfricanId;
use Spoorsny\Laravel\Rules\SouthAfricanId;

$request->validate([
    'south_african_id' => ['required', 'string', new SouthAfricanId()],
    'birth_date' => [
        'date_format:Y-m-d',
        'before_or_equal:today',
        new BirthDateMatchSouthAfricanId()
    ],
]);
```

### Cast

An attribute of an
[Eloquent](https://laravel.com/docs/11.x/eloquent#generating-model-classes)
model can be cast to an instance of the South African ID
value object (`\Spoorsny\ValueObjects\SouthAfricanId` provided by Composer
package
[`spoorsny/south-african-id`](https://packagist.org/packages/spoorsny/south-african-id)).

```php
use Spoorsny\Laravel\Casts\AsSouthAfricanId;

/**
 * Get the attributes that should be cast.
 *
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'south_african_id' => AsSouthAfricanId::class,
    ];
}
```

## Contributing

To contribute to the package, see the [Contributing Guide](CONTRIBUTING.md).

## License

Copyright &copy; 2024 Geoffrey Bernardo van Wyk [https://geoffreyvanwyk.dev](https://geoffreyvanwyk.dev)

This file is part of package spoorsny/laravel-south-african-id.

Package spoorsny/laravel-south-african-id is free software: you can redistribute it
and/or modify it under the terms of the GNU General Public License as
published by the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Package spoorsny/laravel-south-african-id is distributed in the hope that it will be
useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
Public License for more details.

You should have received a copy of the GNU General Public License along with
package spoorsny/laravel-south-african-id. If not, see <https://www.gnu.org/licenses/>.

For a copy of the license, see the [LICENSE](LICENSE) file in this repository.
