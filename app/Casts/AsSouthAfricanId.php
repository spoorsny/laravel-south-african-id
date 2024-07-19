<?php

// This file is part of package spoorsny/laravel-south-african-id.
//
// Package spoorsny/laravel-south-african-id is free software: you can
// redistribute it and/or modify it under the terms of the GNU General Public
// License as published by the Free Software Foundation, either version 3 of
// the License, or (at your option) any later version.
//
// Package spoorsny/laravel-south-african-id is distributed in the hope that it
// will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
// of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
// Public License for more details.
//
// You should have received a copy of the GNU General Public License along with
// package spoorsny/laravel-south-african-id. If not, see <https://www.gnu.org/licenses/>.

namespace Spoorsny\Laravel\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Spoorsny\ValueObjects\SouthAfricanId;

/**
 * Casts a string Eloquent Model attribute to an instance of \Spoorsny\ValueObjects\SouthAfricanId.
 *
 * @see        {@link https://laravel.com/docs/11.x/eloquent-mutators#value-object-casting}
 *
 * @author     Geoffrey Bernardo van Wyk <geoffrey@vanwyk.biz>
 * @copyright  2024 Geoffrey Bernardo van Wyk {@link https://geoffreyvanwyk.dev}
 * @license    {@link http://www.gnu.org/copyleft/gpl.html} GNU GPL v3 or later
 */
class AsSouthAfricanId implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): SouthAfricanId
    {
        return new SouthAfricanId($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return [$key => strval($value)];
    }
}
