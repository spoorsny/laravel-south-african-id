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
use PHPUnit\Framework\Attributes\Test;
use Spoorsny\Laravel\Rules\BirthDateMatchSouthAfricanId;
use Spoorsny\Laravel\Tests\TestCase;

/**
 * Unit test for validation rule \Spoorsny\Laravel\Rules\BirthDateMatchSouthAfricanId.
 *
 * @author     Geoffrey Bernardo van Wyk <geoffrey@vanwyk.biz>
 * @copyright  2024 Geoffrey Bernardo van Wyk {@link https://geoffreyvanwyk.dev}
 * @license    {@link http://www.gnu.org/copyleft/gpl.html} GNU GPL v3 or later
 */
#[CoversClass(BirthDateMatchSouthAfricanId::class)]
class BirthDateMatchSouthAfricanIdRuleTest extends TestCase
{
    #[Test]
    public function it_passes_matching_date(): void
    {
        $validator = Validator::make([
            'south_african_id' => '240620 3710 097',
            'birth_date' => '1924-06-20',
        ], [
            'birth_date' => [new BirthDateMatchSouthAfricanId],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function it_fails_nonmatching_date(): void
    {
        $validator = Validator::make([
            'south_african_id' => '240620 3710 097',
            'birth_date' => '1925-06-20',
        ], [
            'birth_date' => [new BirthDateMatchSouthAfricanId],
        ]);

        $this->assertTrue($validator->fails());
    }

    #[Test]
    public function it_fails_invalid_date(): void
    {
        $validator = Validator::make([
            'south_african_id' => '240620 3710 097',
            'birth_date' => 'blurb',
        ], [
            'birth_date' => [new BirthDateMatchSouthAfricanId],
        ]);

        $this->assertTrue($validator->fails());
    }

    #[Test]
    public function it_fails_missing_south_african_id(): void
    {
        $validator = Validator::make([
            'birth_date' => '1924-06-20',
        ], [
            'birth_date' => [new BirthDateMatchSouthAfricanId],
        ]);

        $this->assertTrue($validator->fails());
    }
}
