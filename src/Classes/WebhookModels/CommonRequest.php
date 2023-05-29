<?php

namespace Corbado\Classes\WebhookModels;

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
