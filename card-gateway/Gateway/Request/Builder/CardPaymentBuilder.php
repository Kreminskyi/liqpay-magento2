<?php
/**
 * Copyright © Pronko Consulting (https://www.pronkoconsulting.com)
 * See LICENSE for the license details.
 */
declare(strict_types=1);

namespace Pronko\LiqPayGateway\Gateway\Request\Builder;

use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Pronko\LiqPaySdk\Api\RequestFieldsInterface as RequestFields;

/**
 * Class CardPaymentBuilder
 */
class CardPaymentBuilder implements BuilderInterface
{
    /**
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        /** @var OrderAdapterInterface $order */
        $order = $buildSubject['payment']->getOrder();
        return [
            RequestFields::CARD => '4731195301524634',
            RequestFields::CARD_CVV => 123,
            RequestFields::CARD_EXP_MONTH => 12,
            RequestFields::CARD_EXP_YEAR => 22,
            RequestFields::AMOUNT => $order->getGrandTotalAmount(),
            RequestFields::CURRENCY => $order->getCurrencyCode(),
            RequestFields::PHONE => $this->getPhone($order),
        ];
    }

    /**
     * @param OrderAdapterInterface $orderAdapter
     * @return string
     */
    private function getPhone(OrderAdapterInterface $orderAdapter): string
    {
        return (string) $orderAdapter->getBillingAddress()->getTelephone();
    }
}