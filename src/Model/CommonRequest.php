<?php

namespace Corbado\Model;

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
