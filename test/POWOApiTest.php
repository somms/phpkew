<?php

namespace Somms\Tests\PHPKew;

use Somms\PHPKew\POWO\Enums\Characteristic;
use Somms\PHPKew\POWO\Enums\Filters;
use Somms\PHPKew\POWO\Enums\Geography;
use Somms\PHPKew\POWO\Enums\Name;
use Somms\PHPKew\POWO\POWOApi;

class POWOApiTest extends \PHPUnit\Framework\TestCase
{
    private $powoApi;

    protected function setUp(): void {
        $this->powoApi = new POWOApi();
    }

    public function testBasicSearch() {
        $result = $this->powoApi->search('Poa Annua');
        $this->assertGreaterThanOrEqual(2, $result->size());
        while($result->current() && $result->current()["accepted"] == false)
        {
            $result->next();
        }
        $this->assertEquals('urn:lsid:ipni.org:names:320035-2', $result->current()['fqId']);
    }

    public function testAdvancedNameSearch() {
        $query = [Name::GENUS => 'Poa', Name::SPECIES => 'annua', Name::AUTHOR => 'L.'];
        $result = $this->powoApi->search($query);
        $this->assertEquals(1, $result->size());
        while($result->current() && $result->current()["accepted"] == false)
        {
            $result->next();
        }
        $this->assertEquals('urn:lsid:ipni.org:names:320035-2', $result->current()['fqId']);
    }

    // Resto de los tests para las funciones de POWOApi

    // Tests para los enumerados (Constantes de clase)
    public function testNameConstants() {
        $this->assertEquals('name', Name::FULL_NAME);
        // Agrega más aserciones para las demás constantes de Name
    }

    public function testCharacteristicConstants() {
        $this->assertEquals('summary', Characteristic::SUMMARY);
        // Agrega más aserciones para las demás constantes de Characteristic
    }

    public function testGeographyConstants() {
        $this->assertEquals('location', Geography::DISTRIBUTION);
    }

    public function testFiltersConstants() {
        $this->assertEquals('accepted_names', Filters::ACCEPTED);
        // Agrega más aserciones para las demás constantes de Filters
    }
}