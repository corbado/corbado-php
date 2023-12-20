<?php

namespace Corbado\Webhook\Entities;

class CommonRequest
{
    public string $id;
    public string $projectID;
    public string $action;

    /**
     * @deprecated
     */
    public string $requestID;
}
