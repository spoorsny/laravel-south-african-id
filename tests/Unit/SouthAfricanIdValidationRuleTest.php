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

namespace Spoorsny\Laravel\Tests\Unit;

use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use Spoorsny\Laravel\Rules\SouthAfricanId;
use Spoorsny\Laravel\Tests\TestCase;
use Spoorsny\Tests\SouthAfricanIdDataProvider;

/**
 * Unit test for validation rule \Spoorsny\Laravel\Rules\SouthAfricanId.
 *
 * @author     Geoffrey Bernardo van Wyk <geoffrey@vanwyk.biz>
 * @copyright  2024 Geoffrey Bernardo van Wyk {@link https://geoffreyvanwyk.dev}
 * @license    {@link http://www.gnu.org/copyleft/gpl.html} GNU GPL v3 or later
 */
#[CoversClass(SouthAfricanId::class)]
class SouthAfricanIdValidationRuleTest extends TestCase
{
    /**
     * The validation rule passes a valid South African ID.
     */
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'validSouthAfricanIdNumbers')]
    #[Test]
    public function it_passes_valid_south_african_id(string $southAfricanId): void
    {
        $validator = Validator::make([
            'south_african_id' => $southAfricanId,
        ], [
            'south_african_id' => [new SouthAfricanId()],
        ]);

        $this->assertTrue($validator->passes());
    }

    /**
     * The validation rule fails an invalid South African ID.
     */
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'nonnumericStrings')]
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'fewerThan13Digits')]
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'moreThan13Digits')]
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'doesNotStartWithDate')]
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'invalidCitizenshipClassification')]
    #[DataProviderExternal(SouthAfricanIdDataProvider::class, methodName: 'invalidChecksumDigit')]
    #[Test]
    public function it_fails_valid_south_african_id(string $southAfricanId): void
    {
        $validator = Validator::make([
            'south_african_id' => $southAfricanId,
        ], [
            'south_african_id' => [new SouthAfricanId()],
        ]);

        $this->assertTrue($validator->fails());
    }
}
