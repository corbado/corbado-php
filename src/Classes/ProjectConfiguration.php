<?php

namespace Corbado\Classes;

class ProjectConfiguration {

    public string $externalName;
    public string $emailFrom;
    public string $smsFrom;
    public ?string $externalApplicationProtocolVersion = null;
    public ?string $webhookURL = null;
    public ?string $webhookUsername = null;
    public ?string $webhookPassword = null;
    public ?string $webhookCheckInvalidUsername = null;
    public ?string $webhookCheckValidUsername = null;
    public ?string $webhookCheckValidPassword = null;
    public ?string $externalApplicationUsername = null;
    public ?string $externalApplicationPassword = null;
    public ?string $legacyAuthMethodsUrl = null;
    public ?string $passwordVerifyUrl = null;
    public ?string $authSuccessRedirectUrl = null;
    public ?string $passwordResetUrl = null;
    public ?string $allowUserRegistration = null;
    public bool $allowIPStickiness = true;
    public ?string $passkeyAppendInterval = null;
    public ?string $fallbackLanguage = null;
    public bool $autoDetectLanguage = true;
    public bool $integrationModeHosted = false;
    public bool $integrationModeAPI = false;
    public bool $integrationModeWebComponent = false;
    public ?string $applicationUrl = null;
    public bool $useCli = false;

}