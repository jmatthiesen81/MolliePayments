<?php declare(strict_types=1);

namespace Shopware\Core\Checkout\Payment\Exception;
if (class_exists(__NAMESPACE__ . '/PaymentProcessException')) {
    return;
}
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

#[Package('checkout')]
abstract class PaymentProcessException extends ShopwareHttpException
{
    private string $orderTransactionId;

    public function __construct(
        string $orderTransactionId,
        string $message,
        array $parameters = [],
        ?\Throwable $e = null
    ) {
        $this->orderTransactionId = $orderTransactionId;

        parent::__construct($message, $parameters, $e);
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    public function getOrderTransactionId(): string
    {
        return $this->orderTransactionId;
    }
}
