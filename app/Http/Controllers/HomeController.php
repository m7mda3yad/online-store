<?php
namespace App\Http\Controllers;
use App\Services\MediaService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Entities\Admin\Order;
use App\Entities\Admin\Product;
use App\Entities\Admin\Customer;
use App\Entities\Admin\OrderProduct;
use App\Entities\Admin\OrderPayment;
use App\Services\PayMobServices;
use App\Services\FatoorahServices;
class HomeController extends Controller{

    private $fatoorahServices;
    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices=$fatoorahServices;
    }

    public function index()
    {
        $data['categories']     = \DB::table('categories')->count();
        $data['users']    = \DB::table('users')->count();
        $data['products'] = \DB::table('products')->count();
        $data['sub_categories'] = \DB::table('sub_categories')->count();
        return view('home',compact('data'));
    }

    public function checkout(Request $request)
    {
        $order = Order::create([
            'user_id'=>\Auth::guard('customer')->user()->id,
            'date'=>now()
        ]);
        $price=0;
        foreach((array) session('cart') as $id => $details)
        {

            $product=Product::findOrFail($id);
            $orderPrice=0;
            if($details['key']!=null)
                $orderPrice = getPriceByKey($details['key']);
            else
                $orderPrice = $product->real_price;
            $price+=$details['quantity'] * $orderPrice;

            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'amount'=>$details['quantity'],
                'price'=>$orderPrice,
                'key'=>$details['key']??null
            ]);
            \DB::table('product_sup_filters')->
            where('key',$details['key'])->
            decrement('amount',$details['quantity']);
        }
        $payment = new OrderPayment();
        $data = [
            "CustomerName" => \Auth::guard('customer')->user()->name??'myname',
            "Notificationoption"=> "LNK",              "Invoicevalue" =>$price,
            "CustomerEmail" => \Auth::guard('customer')->user()->email,            "CalLBackUrl"=>route('callback'),
            "Errorurl"=> route('error'),      "Languagn"=> 'en',        "DisplayCurrencyIna"=>'SAR'
        ];
        $response = $this->fatoorahServices->sendPayment($data);
         if(isset($response['IsSuccess']))
        if($response['IsSuccess']==true){
            OrderPayment::create([
                'InvoiceId'=> $response['Data']['InvoiceId'],
                'InvoiceURL'=> $response['Data']['InvoiceURL'],
                'order_id'=>$order->id,
                'customer_id'=>auth()->guard('customer')->user()->id,
                'price'=>$price,
            ]);}
            request()->session()->put('cart', []);

            return redirect($response['Data']['InvoiceURL']);


        // $payMob = new PayMobServices($price);
        // $token=$payMob->getToken();
        // $id=$payMob->get_id();
        // $url=$payMob->make_order(\Auth::guard('customer')->user());
        // $payment->InvoiceId = $id;
        // $payment->TransactionDate=\Str::singular(now());
        // $payment->InvoiceURL = $url;
        // $payment->customer_id = \Auth::guard('customer')->user()->id;
        // $payment->order_id = $order->id;
        // $payment->save();
        // $url = "https://accept.paymob.com/api/acceptance/iframes/369178?payment_token=".$url;
        // return ($url);
    }



    public function orders()
    {
        return view('orders');
    }
    public function order_show($id)
    {
        $order=auth()->guard('customer')->user()->orders->find($id);
        if($order==null)
        abort(404);
        return view('order_show',compact('order'));
    }
    public function callback(Request $request)
    {
        $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
        $postFields = [
            'Key'     => $request->paymentId,
            'KeyType' => 'paymentId'
            ];
            $response = $this->fatoorahServices->callAPI("https://apitest.myfatoorah.com/v2/getPaymentStatus", $apiKey, $postFields);
            $response = json_decode($response);
            if(!isset($response->Data->InvoiceId))
                return response()->json(["error" => 'error','status' =>false],404);
                $paymeny =  OrderPayment::where(['InvoiceId'=> $response->Data->InvoiceId ])->first();
                if($response->IsSuccess==true){
                    if($response->Data->InvoiceStatus=="Paid"||$response->Data->InvoiceStatus=='Pending')
                    if( $paymeny->price==$response->Data->InvoiceValue){
                        $paymeny->InvoiceStatus="Paid";
                        $paymeny->IsSuccess=true;
                        $paymeny->TransactionDate = $response->Data->CreatedDate;
                        $paymeny->save();
                            Order::where('id',$paymeny->order_id)->update(['paid_type'=>1]);
                        return view('payment.success_payment');
                    }
                }
                return view('payment.faild_payment');
    }


            public function contact(){
                return view('customer.contact');
            }

            public function aboutProject(){
                return view('customer.aboutProject');
            }

            public function about(){
                return view('customer.about');
            }

            public function profile(){
                return view('customer.profile');
            }

            public function profile_update(Request $request){

                $cutomer =Customer::where('id', \Auth::guard('customer')->user()->id)->update($request->only('name','email','phone','name'));
                $cutomer = Customer::findOrFail(\Auth::guard('customer')->user()->id);
                $request->password!=null?$cutomer->password =$request->password:'';
                if($request->hasFile('photo')){
                    $secvice=new MediaService();
                    $cutomer->photo=$secvice->delete_image($cutomer->photo);
                    $cutomer->photo=$secvice->fileUpload('customers',$request->photo);
                }
                $cutomer->save();
                    return redirect()->route('profile');
            }



}
