<?php

namespace Tests;

use App\User;
use App\ThreeDS\Constants\DeviceChannel;
use App\ThreeDS\Constants\MessageCategory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use ReflectionClass;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;
    use CreatesApplication;

    const PROTOCOL_VERSIONS = ['2.1.0', '2.2.0'];
    const DEVICE_CHANNELS = ['01', '02', '03'];
    const MESSAGE_TYPES = ['AReq', 'ARes', 'CReq', 'CRes', 'PReq', 'PRes', 'RReq', 'RRes', 'Erro'];

    const ACQUIRER_MERCHANT_ID = '9876543210001';
    const ACQUIRER_BIN = '000000999';

    const ECI = '05';

    const THREEDS_REQUESTOR_AUTHENTICATION_IND = '01';
    const THREEDS_REQUESTOR_ID = '6456';
    const THREEDS_REQUESTOR_NAME = 'EMVCo 3DS Test Requestor';
    const THREEDS_SERVER_REF_NUMBER = '3DS_LOA_SER_PPFU_020100_00008';
    const THREEDS_REQUESTOR_URL = 'http://www.google.com';
    const THREEDS_SERVER_OPERATOR_ID = '1jpeeLAWgGFgS1Ri9tX9';
    const THREEDS_SERVER_TRANS_ID = '8a880dc0-d2d2-4067-bcb1-b08d1690b26e';

    const THREEDS_SERVER_URL = 'http://www.google.com';

    const FRICTIONLESS_ACCT_NUMBER = '4444444444444';

    const MCC = '7922';
    const ACC_TYPE = '03';
    const BROAD_INFO = '{"message":"TLS 1.x will be turned off starting summer 2019"}';
    const MERCHANT_COUNTRY_CODE = '840';
    const MERCHANT_NAME = 'Ticket Service';

    const PURCHASE_AMOUNT = '101';
    const PURCHASE_CURRENCY = '978';
    const PURCHASE_EXPONENT = '2';
    const PURCHASE_DATE = '20170316141312';

    const RECURRING_EXPIRY = '20180131';
    const RECURRING_FREQUENCY = '6';

    const SDK_APP_ID = 'dbd64fcb-c19a-4728-8849-e3d50bfdde39';
    const SDK_EPHEM_PUB_KEY = [
        'kty' => 'EC',
        'crv' => 'P-256',
        'x' => 'JZ6M72jmi0IR-cJzKxoIrIVAB3W_M4Walp3vWsdRGo',
        'y' => '93EaQVJEm5i4NBMTBOC2BAeMQ996598B2v_0U7wV4ns',
    ];
    const SDK_MAX_TIMEOUT = '10';
    const SDK_REFERENCE_NUMBER = '3DS_LOA_SDK_PPFU_020100_00007';
    const SDK_TRANS_ID = 'b2385523-a66c-4907-ac3c-91848e8c0067';

    const BROWSER_ACCEPT_HEADER = 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
    const BROWSER_JAVA_ENABLED = true;
    const BROWSER_LANGUAGE = 'en';
    const BROWSER_COLOR_DEPTH = '48';
    const BROWSER_SCREEN_HEIGHT = '400';
    const BROWSER_SCREEN_WIDTH = '600';
    const BROWSER_TZ = '0';
    const BROWSER_USER_AGENT = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0';

    const DS_TRANS_ID = 'bd2cbad1-6ccf-48e3-bb92-bc9961bc011e';
    const DS_REFERENCE_NUMBER = 'DS_LOA_DIS_PPFU_020100_00010';

    const ACS_CHALLENGE_MANDATED = 'Y';
    const ACS_RENDERING_TYPE = [
        'acsInterface' => '01',
        'acsUiTemplate' => '02',
    ];
    const ACS_SIGNED_CONTENT = 'eyJhbGciOiJQUzI1NiIsIng1YyI6Ik1JSURlVENDQW1HZ0F3SUJBZ0lRYlM0QzRCU...';

    const AUTHENTICATION_VALUE = 'qØ\0HQí{$ÇH`á± Å';

    const TRANS_TYPE = '01';

    const SHIP_ADDR_STATE = 'CO';
    const SHIP_ADDR_COUNTRY = '840';

    const CARDHOLDER_INFO = 'Additional authentication is needed for this transaction, please contact (Issuer Name) at xxx-xxx-xxxx.';

    const DEVICE_INFO = 'ew0KCSJEViI6ICIxLjAiLA0KCSJERCI6IHsNCgkJIkMwMDEiOiAiQW5kcm9pZCIsDQoJCSJDMDAyIjogIkhUQyBPbmVfTTgiLA0KCQkiQzAwNCI6ICI1LjAuMSIsDQoJCSJDMDA1IjogImVuX1VTIiwNCgkJIkMwMDYiOiAiRWFzdGVybiBTdGFuZGFyZCBUaW1lIiwNCgkJIkMwMDciOiAiMDY3OTc5MDMtZmI2MS00MWVkLTk0YzItNGQyYjc0ZTI3ZDE4IiwNCgkJIkMwMDkiOiAiSm9obidzIEFuZHJvaWQgRGV2aWNlIg0KCX0sDQoJIkRQTkEiOiB7DQoJCSJDMDEwIjogIlJFMDEiLA0KCQkiQzAxMSI6ICJSRTAzIg0KCX0sDQoJIlNXIjogWyJTVzAxIiwgIlNXMDQiXQ0KfQ0K';

    const MESSAGE_EXTESION = [
        [
            "name" => "extensionField1",
            "id" => "ID1",
            "criticalityIndicator" => true,
            "data" => [
                "valueOne" => "value",
            ],
        ],
        [
            "name" => "extensionField2",
            "id" => "ID2",
            "criticalityIndicator" => true,
            "data" => [
                "valueOne" => "value1",
                "valueTwo" => "value2",
            ],
        ],
        [
            "name" => "sharedData",
            "id" => "ID3",
            "criticalityIndicator" => false,
            "data" => [
                "value3" => "IkpTT05EYXRhIjogew0KImRhdGExIjogInNvbWUgZGF0YSIsDQoiZGF0YTIiOiAic29tZSBvdGhlciBkYXRhIg0KfQ==",
            ],
        ],
    ];

    const DEVICE_RENDER_OPTIONS = [
        "sdkInterface" => "03",
        "sdkUiType" => ["01", "02", "03", "04", "05"],
    ];

    /**
     * @var User
     */
    protected $defaulUser;

    public function deviceInfo($data = [])
    {
        $deviceInfo = [
            "DV" => "1.0",
            "DD" => [
                "C001" => "Android",
                "C002" => "HTC One_M8",
                "C004" => "8.1",
                "C005" => "en_US",
                "C006" => "Eastern Standard Time",
                "C007" => "06797903-fb61-41ed-94c2-4d2b74e27d18",
                "C009" => "John's Android Device",
            ],
            "DPNA" =>  [
                "C010" => "RE01",
                "C011" => "RE03",
            ],
            "SW" => [
                ["SW01", "SW04"],
            ],
        ];

        $deviceInfo = array_replace_recursive($deviceInfo, $data);

        return base64_encode(json_encode($deviceInfo, true));
    }

    private function buildDataFromCurrentBuilder($deviceChannel, $messageCategory)
    {
        return $this->buildDataFromBuilder($deviceChannel, $messageCategory, static::TEST_MESSAGE_BUILDER_IMPLEMENTATION);
    }

    private function buildDataFromBuilder($deviceChannel, $messageCategory, $builder)
    {
        $builderClass = new ReflectionClass($builder);
        $property = $builderClass->getProperty('requiredFields');
        $property->setAccessible(true);

        $builder = new $builder([], '', '');

        $field = $property->getValue($builder);
        $fields = $field[$deviceChannel][$messageCategory];

        $data = [];

        foreach ($fields as $field) {
            $data[$field] = '';
        }

        $replacements = [
            'threeDSCompInd' => 'Y',
            'threeDSRequestorAuthenticationInd' => self::THREEDS_REQUESTOR_AUTHENTICATION_IND,
            'threeDSRequestorID' => self::THREEDS_REQUESTOR_ID,
            'threeDSRequestorName' => self::THREEDS_REQUESTOR_NAME,
            'threeDSRequestorURL' => self::THREEDS_REQUESTOR_URL,
            'threeDSServerRefNumber' => self::THREEDS_SERVER_REF_NUMBER,
            'threeDSServerTransID' => (string)Str::uuid(),
            'threeDSServerURL' => self::THREEDS_SERVER_URL,
            'acquirerBIN' => self::ACQUIRER_BIN,
            'acquirerMerchantID' => self::ACQUIRER_MERCHANT_ID,
            'acctNumber' => self::FRICTIONLESS_ACCT_NUMBER,
            'deviceChannel' => $deviceChannel,
            'mcc' => self::MCC,
            'merchantCountryCode' => self::MERCHANT_COUNTRY_CODE,
            'merchantName' => self::MERCHANT_NAME,
            'messageCategory' => $messageCategory,
            'messageType' => ($builder::MESSAGE)::MESSAGE_TYPE,
            'messageVersion' => static::TEST_MESSAGE_VERSION,
            'purchaseAmount' => self::PURCHASE_AMOUNT,
            'purchaseCurrency' => self::PURCHASE_CURRENCY,
            'purchaseExponent' => self::PURCHASE_EXPONENT,
            'purchaseDate' => self::PURCHASE_DATE,
            'sdkAppID' => self::SDK_APP_ID,
            'sdkEphemPubKey' => self::SDK_EPHEM_PUB_KEY,
            'sdkMaxTimeout' => self::SDK_MAX_TIMEOUT,
            'sdkReferenceNumber' => self::SDK_REFERENCE_NUMBER,
            'sdkTransID' => self::SDK_TRANS_ID,
            'browserAcceptHeader' => self::BROWSER_ACCEPT_HEADER,
            'browserJavaEnabled' => self::BROWSER_JAVA_ENABLED,
            'browserLanguage' => self::BROWSER_LANGUAGE,
            'browserColorDepth' => self::BROWSER_COLOR_DEPTH,
            'browserScreenHeight' => self::BROWSER_SCREEN_HEIGHT,
            'browserScreenWidth' => self::BROWSER_SCREEN_WIDTH,
            'browserTZ' => self::BROWSER_TZ,
            'browserUserAgent' => self::BROWSER_USER_AGENT,
            'notificationURL' => 'https://notification-url.com',
            'browserJavascriptEnabled' => false,
            'deviceRenderOptions' => self::DEVICE_RENDER_OPTIONS,
        ];

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $replacements)) {
                $data[$key] = $replacements[$key];
            }
        }

        return $data;
    }

    public function requiredFieldsProvider(): array
    {
        $provider = [];

        $_data = $this->data(DeviceChannel::APP, MessageCategory::PA);

        while (($value = current($_data)) !== false) {
            $data = $_data;
            unset($data[key($_data)]);
            $provider[key($_data)] = ['Undefined index: ' . key($_data), $data];
            next($_data);
        }

        return $provider;
    }

    public function __call($name, $args)
    {
        switch ($name) {
            case 'data':
                switch (count($args)) {
                    case 2:
                        return call_user_func_array([$this, 'buildDataFromCurrentBuilder'], $args);
                    case 3:
                        return call_user_func_array([$this, 'buildDataFromBuilder'], $args);
                }
        }

        throw new \ErrorException('Call to undefined method ' . __CLASS__ .'::'. $name);
    }

    public function defaultUser()
    {
        if ($this->defaulUser) {
            return $this->defaulUser;
        } else {
            return $this->defaulUser = factory(User::class)->create();
        }
    }
}
