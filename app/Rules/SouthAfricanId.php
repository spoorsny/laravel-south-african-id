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

namespace Spoorsny\Laravel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use InvalidArgumentException;
use Spoorsny\ValueObjects\SouthAfricanId as SouthAfricanIdValueObject;

/**
 * Rule that validates that a string is a South African identity number.
 *
 * @see        {@link https://laravel.com/docs/11.x/validation#using-rule-objects}
 *
 * @author     Geoffrey Bernardo van Wyk <geoffrey@vanwyk.biz>
 * @copyright  2024 Geoffrey Bernardo van Wyk {@link https://geoffreyvanwyk.dev}
 * @license    {@link http://www.gnu.org/copyleft/gpl.html} GNU GPL v3 or later
 */
class SouthAfricanId implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            new SouthAfricanIdValueObject($value);
        } catch (InvalidArgumentException $e) {
            $fail($e->getMessage());
        }
    }
}
