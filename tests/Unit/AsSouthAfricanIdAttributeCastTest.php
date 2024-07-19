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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

use Spoorsny\Laravel\Casts\AsSouthAfricanId;
use Spoorsny\Laravel\Tests\TestCase;
use Spoorsny\ValueObjects\SouthAfricanId;

/**
 * Unit test for attribute cast \Spoorsny\Laravel\Casts\AsSouthAfricanId.
 *
 * @author     Geoffrey Bernardo van Wyk <geoffrey@vanwyk.biz>
 * @copyright  2024 Geoffrey Bernardo van Wyk {@link https://geoffreyvanwyk.dev}
 * @license    {@link http://www.gnu.org/copyleft/gpl.html} GNU GPL v3 or later
 */
#[CoversClass(AsSouthAfricanId::class)]
class AsSouthAfricanIdAttributeCastTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $db = new DB();

        $db->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);

        $db->bootEloquent();
        $db->setAsGlobal();

        $this->createSchema();
    }

    protected function createSchema(): void
    {
        Model::getConnectionResolver()->connection()->getSchemaBuilder()->create('people', function ($table) {
            $table->increments('id');
            $table->time('south_african_id');
            $table->timestamps();
        });
    }

    /**
     * When attribute value is retrieved from the database, it is cast to a
     * \Spoorsny\ValueObject\SouthAfricanId instance.
     */
    #[Test]
    public function it_casts_attribute_to_value_object_when_getting_value_from_database(): void
    {
        // Arrange
        Person::create(['south_african_id' => '9308062469083']);

        // Act
        $person = Person::first();

        // Assert
        $this->assertTrue($person->south_african_id instanceof SouthAfricanId);
    }

    /**
     * When attribute value is inserted into the database, it is cast to a string.
     */
    #[Test]
    public function it_casts_attribute_to_a_string_when_setting_value_into_database(): void
    {
        // Arrange
        $person = new Person();

        // Act
        $person->south_african_id = new SouthAfricanId('9308062469083');

        // Assert
        $this->assertEquals($person->getAttributes()['south_african_id'], '930806 2469 083');
    }
}

class Person extends Model
{
    protected $guarded = [];

    protected $casts = [
        'south_african_id' => AsSouthAfricanId::class,
    ];
}
