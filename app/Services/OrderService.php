<?php

namespace App\Services;

use App\Interfaces\SessionInterface;
use App\Services\Site\ServiceService;
use App\Services\ProfessionalService;

class OrderService
{
    public function __construct(
        private SessionInterface $session,
        private ServiceService $service_service,
        private ProfessionalService $professional_service,
        private HourService $hour_service
    ) {}

    public function getOrderSummary(): array
    {
        $summary = [];

        $order_session = $this->getDataSession();

        $professional = $this->professional_service->getProfessionalsByIdToOrderSummary($order_session['professional_id']);

        $summary['professional'] = $professional->name;
 
        $summary['client'] = [
            'name' => $order_session['name_client'],
            'telephone' => $order_session['telephone_client'],
        ];

        $price = 00.00;

        foreach ($order_session['hours_id'] as $service_id => $hour_id) {
            $service = $this->service_service->getServicesByIdToOrderSummary((int) $service_id);
            $hour = $this->hour_service->getHourByIdToOrderSummary((int) $hour_id);

            $summary['orders'][] = [
                'service' => (string) $service->name,
                'price' => (string) number_format($service->price, 2, ','),
                'date' => (string) $hour->date,
                'time' => (string) $hour->time,
            ];

            $price += $service->price;
        }

        $summary['subtotal'] = number_format($price, 2, ',');
        $summary['total'] = number_format($price, 2, ',');

        $summary['title'] = 'Serviço';

        if (count($summary['orders']) > 1) {
            $summary['title'] = 'Serviços';
        }

        return $summary;
    }

    public function getDataSession(): array
    {
        return [
            'services_id' => $this->session->get('order.service_id') ?? [],
            'professional_id' => $this->session->get('order.professional_id') ?? [],
            'hours_id' => $this->session->get('order.hour_id') ?? [],
            'name_client' => $this->session->get('order.name_client') ?? [],
            'telephone_client' => $this->session->get('order.telephone_client') ?? [],
        ];
    }
}