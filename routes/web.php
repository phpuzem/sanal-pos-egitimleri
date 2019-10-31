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

    $data = (new \App\Services\Payment\Vakifbank())
        ->setMerchantID("000100000013498")
        ->setMerchantPassword("VAKIFTEST")
        ->setPan(4289450189088488)
        ->setBrandName(100)
        ->setCurrency(949)
        ->setExpiryDate(2304)
        ->setSuccessURL("http://sanalpos.test/success")
        ->setFailureURL("http://sanalpos.test/failure")
        ->setPurchaseAmount(100)
        ->setVerifyEnrollmentRequestID(md5(rand(0, 100))) //order id
        ->check();

    $data = $data->Message->VERes;

    return view('paraq', compact('data'));
});

Route::post('/success', function (\Illuminate\Http\Request $request) {


    $result = (new \App\Services\Payment\Vakifbank())->pay($request);
    if ($result->original->ResultCode != '0000') {
        // Para çekimi başarısız.

        dd($result);
        return response()->json([
            'message' => $result->original->ResultDetail,
        ]);
    }

    // Para başarılı bir şekilde çekilmiştir.

    dd($result);
});

Route::post('/failure', function () {

    dd(request()->all());

});




