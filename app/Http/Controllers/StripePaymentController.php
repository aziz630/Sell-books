<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\BookHistory;
use Illuminate\Support\Facades\Auth;

       
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        $qty = $request->input('quantity');
        $stock_id = $request->input('stock_id');
        $book_id = $request->input('book_id');
        $price = $request->input('price');
        // dd($price);
        return view('stripe', compact('qty', 'stock_id', 'book_id', 'price'));
    }
      
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                "amount" => $request->input('price') * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "New Order payment Received Successfully." 
        ]);
                
        $data = new BookHistory();
        $data->user_id = Auth::user()->id;
        $data->book_stock_id = $request->input('book_id');
        $data->status = 0;
        $data->quantity = $request->input('quantity'); 
        $data->date = date('Y-m-d');
        $result = $data->save();

        return back()
                ->with('success', 'Payment successful!');
    }
}