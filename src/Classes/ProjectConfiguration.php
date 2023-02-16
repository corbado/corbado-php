<?php

namespace Corbado\Classes;

class ProjectConfiguration {

    public string $externalName;
    public string $emailFrom;
    public string $smsFrom;
    public string $externalApplicationProtocolVersion;
    public string $webhookURL;
    public string $webhookUsername;
    public string $webhookPassword;
    public string $webhookCheckInvalidUsername;
    public string $webhookCheckValidUsername;
    public string $webhookCheckValidPassword;
    public string $externalApplicationUsername;
    public string $externalApplicationPassword;
    public string $legacyAuthMethodsUrl;
    public string $passwordVerifyUrl;
    public string $authSuccessRedirectUrl;
    public string $passwordResetUrl;
    public bool $allowUserRegistration;
    public bool $allowIPStickiness;
    public string $passkeyAppendInterval;
    public string $fallbackLanguage;
    public bool $autoDetectLanguage;
    public bool $integrationModeHosted;
    public bool $integrationModeAPI;
    public bool $integrationModeWebComponent;
    public string $applicationUrl;
    public bool $useCli;

}