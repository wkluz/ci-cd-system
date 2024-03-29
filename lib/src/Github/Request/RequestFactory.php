<?php

namespace App\Github\Request;

use Psr\Http\Message\RequestInterface;

class RequestFactory
{
    /** @param RequestCreatorInterface[] $requestCreators */
    public function __construct(private readonly array $requestCreators)
    {
    }

    public function create(RequestType $type, ?object $subject, array $context = []): ?RequestInterface
    {
        foreach ($this->requestCreators as $requestCreator) {
            if ($requestCreator->supports($type, $subject)) {
                return $requestCreator->create($type, $subject, $context);
            }
        }

        return null;
    }
}
