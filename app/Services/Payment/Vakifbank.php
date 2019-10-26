<?php

namespace App\Services\Payment;

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
        $this->purchaseAmount = $purchaseAmount;

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


}
