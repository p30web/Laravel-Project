<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Log;
use SoapClient;
use SoapFault;

class GatewayController extends BaseController
{
    private $client;
    private $userName = "user642";
    private $userPassword = "89451384";
    public $wsdl_Link = "http://banktest.ir/gateway/mellat/ws?wsdl";
    public $RequestPaymentLink = "http://banktest.ir/gateway/mellat/gate";
    private $callBackUrl = "http://127.0.0.1:8000/gateway/verifyRequest";
    private $terminalId = '642';
//    protected $SoapClient;
    private $token;


    public function __construct()
    {
        $params = array(
            'encoding' => 'UTF-8',
            'verifypeer' => false,
            'verifyhost' => false,
            'soap_version' => SOAP_1_1,
            'trace' => 1,
            'exceptions' => 1,
            'connection_timeout' => 180,
        );

        try {
            $this->client = new SoapClient($this->wsdl_Link, $params);
        } catch (SoapFault $e) {
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function requestGateway()
    {
        $localDate = Carbon::now()->setTimezone('Asia/Tehran')->format('Ymd');
        $localTime = Carbon::now()->setTimezone('Asia/Tehran')->format('Gis');

        $additionalData = "p30web.org";

        $PayRequestID = rand(1, 10) . rand(1, 90) . rand(5, 30);

        $parameters = array(
            'terminalId' => $this->terminalId,
            'userName' => $this->userName,
            'userPassword' => $this->userPassword,
            'orderId' => $PayRequestID,
            'amount' => 50000,
            'localDate' => $localDate,
            'localTime' => $localTime,
            'additionalData' => $additionalData,
            'callBackUrl' => $this->callBackUrl,
            'payerId' => auth()->user()->id
        );

        try {
            $response =  $this->client->bpPayRequest($parameters);
            if (isset($response)) {
                $response = explode(',', $response->return);
                if ($response[0] == 0) {
                    $this->SetToken($response[1]); // update transaction reference id
                    echo $this->sendResponse($this->generateForm());
                } else {
                    return 'bla bla bla';
                }

            } else {
                var_dump($response->return);
            }

        } catch (SoapFault $e) {
            throw new Exception('SoapFault: ' . $e->getMessage() . ' #' . $e->getCode(), $e->getCode());
        }

    }


    protected function SetToken($token)
    {
        $this->token = $token;
    }

    protected function generateForm()
    {
        $response = [
            'endPoint' => $this->RequestPaymentLink,
            'refId' => $this->token,
            'autoSubmit' => boolval(1)
        ];

        return $response;
    }

    public function store()
    {
        $this->requestGateway();
    }

    public function BankCheek($Array, $KeyName)
    {
        $NewInfo = (isset($Array[$KeyName]) && $Array[$KeyName] != "") ? $Array[$KeyName] : "NotSet ot Empty $KeyName";
        return $NewInfo;
    }


    public function verifyRequest(Request $request)
    {
        $receivedFromBank = $request->all();
        $receivedFromBank['ip'] = request()->ip();
        if (empty($receivedFromBank)) {
            return false;
        }

        $ResCode = $this->BankCheek($receivedFromBank, 'ResCode');

        switch ($ResCode){
            case 0 :
                return $this->VerifyPay($receivedFromBank);
                break;
            default :
                return $this->DefaultPay($ResCode);
        }
    }


    private function VerifyPay($receivedFromBank){

        $orderId = $this->BankCheek($receivedFromBank, 'SaleOrderId');

        $SaleReferenceId = $this->BankCheek($receivedFromBank, 'SaleReferenceId');
        $parameters = array(
            'terminalId' => $this->terminalId,
            'userName' => $this->userName,
            'userPassword' => $this->userPassword,
            'orderId' => $orderId,
            'saleOrderId' => $orderId,
            'saleReferenceId' => $SaleReferenceId
        );


        try {
            $result = $this->client->bpVerifyRequest($parameters);

            if (isset($result->return)) {

                if($result->return == '0') {
                    dd('swdsd');
                } else {
                  dd('adasd');
                }
            }

        } catch (SoapFault $e) {
            throw new Exception('SoapFault: ' . $e->getMessage() . ' #' . $e->getCode(), $e->getCode());
        }
    }



}
