<?php

namespace App\Services;

use App\Interfaces\SessionInterface;
use App\Repositories\AppointmentRepository;
use App\Services\Site\ServiceService;
use App\Services\ProfessionalService;

class OrderService
{
    public function __construct(
        private SessionInterface $session,
        private ServiceService $service_service,
        private ProfessionalService $professional_service,
        private HourService $hour_service,
        private AppointmentRepository $appointment_repository
    ) {}

    public function getOrderSummary(): array
    {
        $summary = [];

        $order_session = $this->getDataSession();

        $professional = $this->professional_service->getProfessionalsByIdToOrderSummary($order_session['professional_id']);

        $summary['professional'] = [
            'id' => $professional->id,
            'name' => $professional->name,
        ];
 
        $summary['client'] = [
            'name' => $order_session['name_client'],
            'telephone' => $order_session['telephone_client'],
        ];

        $price = 00.00;

        foreach ($order_session['hours_id'] as $service_id => $hour_id) {
            $service = $this->service_service->getServicesByIdToOrderSummary((int) $service_id);
            $hour = $this->hour_service->getHourByIdToOrderSummary((int) $hour_id);

            $price += $service->price;

            $summary['orders'][] = [
                'service' => [
                    'id' => (int) $service->id,
                    'name' => (string) $service->name,
                ],
                'hour' => [
                    'id' => (int) $hour_id,
                    'date' => (string) $hour->date,
                    'time' => (string) $hour->time,
                ],
                'price' => (string) number_format($service->price, 2, ','),
            ]; 
        }

        $summary['subtotal'] = number_format($price, 2, ',');
        $summary['total'] = number_format($price, 2, ',');

        $summary['title'] = 'Serviço';

        if (count($summary['orders']) > 1) {
            $summary['title'] = 'Serviços';
        }

        return $summary;
    }

    private function getDataSession(): array
    {
        return [
            'services_id' => $this->session->get('order.service_id') ?? [],
            'professional_id' => $this->session->get('order.professional_id') ?? [],
            'hours_id' => $this->session->get('order.hour_id') ?? [],
            'name_client' => $this->session->get('order.name_client') ?? [],
            'telephone_client' => $this->session->get('order.telephone_client') ?? [],
        ];
    }

    public function createAppointments(array $data)
    {
        $appointments = [];
        $now = now();

        foreach ($data['orders'] as $service_id => $hour_id) {
            $appointments[] = [
                'hour_id' => (int) $hour_id,
                'professional_id' => (int) $data['professional_id'],
                'service_id' => (int) $service_id,
                'name_client' => (string) $data['name_client'],
                'telephone_client' => (string) $data['telephone_client'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        $created =  $this->appointment_repository->createAppointments($appointments);

        if ($created) {
            $this->hour_service->checkHours($data['orders']);
        }
    }
}