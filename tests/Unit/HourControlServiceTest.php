<?php

namespace Tests\Unit;

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
        $hourControl = (object) [
            'id' => 1,
            'hour_id' => 1,
            'updated_at' => now()->subMinutes(5)->format('Y-m-d H:i:s'),
        ];

        $hour_control_repository_mock = $this->mockHourControlRepository(
            $this->eloquentCollection([$hourControl])
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

    private function mockHourControlRepository($return = null)
    {

        $mock = $this->getMockBuilder(\App\Repositories\HourControlRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getHourControl', 'deleteByHourControlId'])
            ->getMock();
        
        if ($return !== null) {
            $mock->method('getHourControl')->willReturn($return);
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
}
