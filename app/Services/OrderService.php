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
        $order_session = $this->getDataSession();

        $order = [];

        $order['service'] = $this->service_service->getServicesByIdToOrderSummary($order_session['services_id']);
        $order['professional'] = $this->professional_service->getProfessionalsByIdToOrderSummary($order_session['professional_id']);
        $order['hour'] = $this->hour_service->getHourByIdToOrderSummary($order_session['hours_id']);

        return $order;
    }

    public function getDataSession(): array
    {
        return [
            'services_id' => $this->session->get('order.service_id'),
            'professional_id' => $this->session->get('order.professional_id'),
            'hours_id' => $this->session->get('order.hour_id'),
            'name_client' => $this->session->get('order.name_client'),
            'telephone_client' => $this->session->get('order.telephone_client'),
        ];
    }
}