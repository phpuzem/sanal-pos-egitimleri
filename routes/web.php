<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {


    dd((new \App\Services\Payment\Vakifbank())
        ->setMerchantID(1234)
        ->setMerchantPassword(12312)
        ->setPan(4242424242424242)
        ->setBrandName(100)
        ->setCurrency(949)
        ->setExpiryDate(0221)
        ->setSuccessURL("http://sanalpos.test/succcess")
        ->setFailureURL("http://sanalpos.test/failure")
        ->setPurchaseAmount(100)
        ->setVerifyEnrollmentRequestID(12345)

    );


});
