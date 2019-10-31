<?php

namespace App\Services\Payment;

use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * Class Vakifbank
 * @package App\Services\Payment
 */
class  Vakifbank
{
    /**
     * @var
     */
    protected $merchantID;

    /**
     * @var
     */
    protected $merchantPassword;

    /**
     * @var
     */
    protected $verifyEnrollmentRequestID;

    /**
     * @var
     */
    protected $pan;

    /**
     * @var
     */
    protected $expiryDate;

    /**
     * @var
     */
    protected $purchaseAmount;

    /**
     * @var
     */
    protected $currency;

    /**
     * @var
     */
    protected $brandName;

    /**
     * @var
     */
    protected $successURL;

    /**
     * @var
     */
    protected $failureURL;


    /**
     * @param $verifyEnrollmentRequestID
     *
     * @return Vakifbank
     */
    public function setVerifyEnrollmentRequestID($verifyEnrollmentRequestID): Vakifbank
    {
        $this->verifyEnrollmentRequestID = $verifyEnrollmentRequestID;

        return $this;
    }

    /**
     * @param $pan
     *
     * @return Vakifbank
     */
    public function setPan($pan): Vakifbank
    {
        $this->pan = $pan;

        return $this;
    }

    /**
     * @param $expiryDate
     *
     * @return Vakifbank
     */
    public function setExpiryDate($expiryDate): Vakifbank
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * @param $purchaseAmount
     *
     * @return Vakifbank
     */
    public function setPurchaseAmount($purchaseAmount): Vakifbank
    {
        $this->purchaseAmount = number_format($purchaseAmount, 2);

        return $this;
    }

    /**
     * @param $currency
     *
     * @return Vakifbank
     */
    public function setCurrency($currency): Vakifbank
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param $brandName
     *
     * @return Vakifbank
     */
    public function setBrandName($brandName): Vakifbank
    {
        $this->brandName = $brandName;

        return $this;
    }

    /**
     * @param $successURL
     *
     * @return Vakifbank
     */
    public function setSuccessURL($successURL): Vakifbank
    {
        $this->successURL = $successURL;

        return $this;
    }

    /**
     * @param $failureURL
     *
     * @return Vakifbank
     */
    public function setFailureURL($failureURL): Vakifbank
    {
        $this->failureURL = $failureURL;

        return $this;
    }

    /**
     * @param string $merchantID
     *
     * @return Vakifbank
     */
    public function setMerchantID(string $merchantID): Vakifbank
    {
        $this->merchantID = $merchantID;

        return $this;
    }

    /**
     * @param string $merchantPassword
     *
     * @return Vakifbank
     */
    public function setMerchantPassword(string $merchantPassword): Vakifbank
    {
        $this->merchantPassword = $merchantPassword;

        return $this;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function check()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('VAKIFBANK_ENROLLMENT_URL'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type" => 'application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this));

        $result = curl_exec($ch);

        $xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);

        return $xml;
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function pay(Request $request)
    {
        $data = [
            'MerchantId'              => "000100000013498",
            'Password'                => "VAKIFTEST",
            'TerminalNo'              => "VP000578",
            'TransactionType'         => 'Sale',
            'TransactionId'           => $request->input('VerifyEnrollmentRequestId'),
            'ECI'                     => $request->input('Eci'),
            'CAVV'                    => $request->input('Cavv'),
            'MpiTransactionId'        => $request->input('VerifyEnrollmentRequestId'),
            'OrderId'                 => $request->input('VerifyEnrollmentRequestId'),
            'TransactionDeviceSource' => 0,
        ];

        $xml = ArrayToXml::convert($data, 'VposRequest', true, 'utf-8');


        $result = simplexml_load_string($this->curl($xml), "SimpleXMLElement", LIBXML_NOCDATA);

        return response()->json($result);
    }

    /**
     * @param $xml
     *
     * @return bool|string
     */
    public function curl($xml)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onlineodemetest.vakifbank.com.tr:4443/VposService/v3/Vposreq.aspx");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'prmstr=' . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_OPTIONS, ["CURLOPT_SSLVERSION" => "CURL_SSLVERSION_TLSv1_1"]);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


}
