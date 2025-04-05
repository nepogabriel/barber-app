<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HourControlServiceTest extends TestCase
{
    public function test_validate_hour_control_with_duplicate_hours()
    {
        $hour_control_service = $this->getMockedHourControlService();
        
        $result = $hour_control_service->validateHourControl([1 => 1, 2 => 1], []);
        
        $expected = [
            'alert_user' => true,
            'message' => 'Ops! Não permitido o mesmo horário para serviços diferentes.'
        ];

        $this->assertEquals($expected, $result);
    }

    public function test_validate_hour_control_with_available_hours()
    {
        $hour_control_repository_mock = $this->mockHourControlRepository(
            $this->eloquentCollection()
        );

        $hour_control_service = $this->getMockedHourControlService($hour_control_repository_mock);
        
        $result = $hour_control_service->validateHourControl([1 => 1, 2 => 2], []);
        
        $expected = [
            'alert_user' => false,
            'message' => ''
        ];

        $this->assertEquals($expected, $result);
    }

    public function test_validate_hour_control_with_unavailable_hours()
    {
        $hour_control = (object) [
            'id' => 1,
            'hour_id' => 1,
            'updated_at' => now()->subMinutes(5)->format('Y-m-d H:i:s'),
        ];

        $hour_control_repository_mock = $this->mockHourControlRepository(
            $this->eloquentCollection([$hour_control])
        );

        $hour_control_service = $this->getMockedHourControlService(
            $hour_control_repository_mock,
            $this->mockServiceService($this->eloquentCollection([(object) ['id' => 1, 'name' => 'Serviço Teste']]))
        );
        
        $result = $hour_control_service->validateHourControl([1 => 1, 2 => 2], []);
        
        $expected = [
            'alert_user' => true,
            'message' => 'Desculpe! Outro usuário escolheu o mesmo horário. Serviço: Serviço Teste'
        ];

        $this->assertEquals($expected, $result);
    }

    #[DataProvider('checkSameHourTestCases')]
    public function test_check_same_hour_with_duplicates(array $input, bool $expected): void
    {
        $service = $this->getMockedHourControlService();
        
        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('checkSameHour');
        $method->setAccessible(true);
        
        $result = $method->invokeArgs($service, [$input]);
        
        $this->assertSame($expected, $result);
    }

    // Testes para checkIfHourIsAvaliable
    public function test_check_if_hour_is_available_with_expired_time()
    {
        $hour_control = (object) [
            'id' => 1,
            'hour_id' => 1,
            'updated_at' => now()->subMinutes(11)->format('Y-m-d H:i:s'),
        ];

        $hour_control_repository_mock = $this->mockHourControlRepository(
            $this->eloquentCollection([$hour_control])
        );

        $hour_control_repository_mock->expects($this->once())
            ->method('deleteByHourControlId')
            ->with([1]);

        $hour_control_service = $this->getMockedHourControlService(
            $hour_control_repository_mock,
        );

        $method = new \ReflectionMethod($hour_control_service, 'checkIfHourIsAvaliable');
        $method->setAccessible(true);
        
        $result = $method->invokeArgs($hour_control_service, [
            $this->eloquentCollection([$hour_control]),
            []
        ]);

        $expected = [
            'alert_user' => false,
            'hours_id' => []
        ];
        
        $this->assertEquals($expected, $result);
    }

    private function getMockedHourControlService($hour_control_repository_mock = null, $service_service_mock = null)
    {
        $session_mock = $this->createMock(\App\Interfaces\SessionInterface::class);
        
        // Se não for passado, cria um mock padrão
        $hour_control_repository_mock ??= $this->mockHourControlRepository();
        $service_service_mock ??= $this->mockServiceService();
        
        return new \App\Services\HourControlService(
            $session_mock,
            $hour_control_repository_mock,
            $service_service_mock
        );
    }

    private function mockHourControlRepository($return = null, $method = 'getHourControl')
    {

        $mock = $this->getMockBuilder(\App\Repositories\HourControlRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getHourControl', 'deleteByHourControlId'])
            ->getMock();
        
        if ($return !== null) {
            $mock->method($method)->willReturn($return);
        }
        
        return $mock;
    }

    private function mockServiceService($return = [])
    {
        $service_repository_mock = $this->createMock(\App\Repositories\ServiceRepository::class);
        $service_repository_mock->method('getNameOfServicesById')
        ->willReturn($return);
    
        return new \App\Services\ServiceService($service_repository_mock);
    }

    protected function EloquentCollection(array $data = [])
    {
        return new \Illuminate\Database\Eloquent\Collection($data);
    }

    public static function checkSameHourTestCases(): array
    {
        return [
            'Dois IDs iguais (duplicados)' => [
                'input' => [1 => 1, 2 => 1],
                'expected' => true,
            ],
            'Dois IDs diferentes' => [
                'input' => [1 => 1, 2 => 2],
                'expected' => false,
            ],
            'Apenas um ID' => [
                'input' => [1 => 1],
                'expected' => false,
            ],
            'Array vazio' => [
                'input' => [],
                'expected' => false,
            ],
            'Três Ids, sendo dois duplicados' => [
                'input' => [1 => 1, 2 => 2, 3 => 1],
                'expected' => true,
            ],
        ];
    }
}
