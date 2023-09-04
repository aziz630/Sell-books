<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\User;
use App\Models\BookStock;
use App\Models\BookHistory;
use Illuminate\Support\Facades\Auth;
use DB;

class BookController extends Controller
{

    public function getAllBooks(Request $request){
        // $validated = $request->validate([
        //     'search' => 'search',
        // ]);
       

        
        $page_title = 'Book';
        
        if($request->search != null){
            // $get_all_books = Books::all();?
            $get_all_books = Books::where('book_title', $request->search)
            ->orWhere('book_title', 'like', '%' . $request->search . '%')->get();

        }else{
            $get_all_books = Books::all();

        }

        $search_field = $request->search;

        return view('welcome', compact('page_title', 'get_all_books', 'search_field'));
    }

    public function AddBook(){
        $page_title = 'Add Book';

        return view('books.add_book', compact('page_title'));
    }
    
    public function SaveBook(Request $request){
        // dd('yes');

        $data = new Books();
        $data->book_title = $request->book_title;
        $data->author = $request->author;
        $data->publisher = $request->publisher;
        $data->Place_of_publisher = $request->Place_of_publisher;
        $data->year = $request->year;
        $data->price = $request->price;
        
        if($request->file('photo')){
            $image = $request->file('photo');
            //  unlink(public_path('stdProfile',$model->stdImage));
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('upload/book_img'),$imageName);
        }
        $data->photo = $imageName;
        $data->quantity = $request->quantity;
        $result = $data->save();
        
        $id = $data->id;
        $quantity = $request->quantity;

        if($result){
            for($i=0; $i<$quantity; $i++){
                $dataArray = new BookStock();
                $dataArray->book_id = $id;
                $dataArray->date = date('Y-m-d');
                $dataArray->status = 1;
                $dataArray->save();
            }
        }

        return redirect(url('view_books'))->with('success', 'Book Added Successfully.');
    
    }

    public function ViewBook(){

        $page_title = 'List Of Books';
        
        $viewbooks = Books::all();
        // dd($books);
      
        return view('books.view_book', compact('viewbooks', 'page_title'));
    }

    public function EditBook($id){
        // dd('yes');

        $data['book'] = Books::where('id', $id)->get()->toArray();
        $data['page_title'] = 'Edit Book';

        // dd($data['book']);
        return view('books.edit_book', $data);
    }

    public function UpdateBook(Request $request){

        $id = $request->book_id;
        $oldImage = $request->old_image;
        $data = Books::where('id', $id)->get()->first();
        // dd($data);

        $data->book_title = $request->book_title;
        $data->author = $request->author;
        $data->publisher = $request->publisher;
        $data->Place_of_publisher = $request->Place_of_publisher;
        $data->year = $request->year;
        $data->price = $request->price;
        
        if($request->file('photo')){
            $image = $request->file('photo');
            //  unlink(public_path('stdProfile',$model->stdImage));
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('upload/book_img'),$imageName);
        }
        if($request->file('photo')){

            $data->photo = $imageName;
        }else{
            $data->photo = $oldImage;
        }
        // $data->quantity = $request->quantity;
        // dd($data);
        $data->update();
        return redirect(url('view_books'))->with('success', 'Book Updated Successfully.');

    }

    public function DeleteBook(Request $request, $id){

        // dd($id);
        $data = Books::find($id);

        if ($data != null) {
            $data->delete();
 
            return redirect()->back()->with('success', 'Book Deleted Successfully.');
        }

        return redirect()->back()->with('error', 'Wrong Id.');
    }


    public function BookStock(){


        $page_title = 'Books Stock';
        $bookStocks = DB::table('book_stocks')
        ->Join('books', 'books.id','=','book_stocks.book_id')
        ->select('book_stocks.*', 'books.*','book_id', DB::raw('count(*) as totalQty'))
        ->groupBy('book_id')
        ->get();

        // dd($bookStocks);
        
        return view('books.book_stock', compact('bookStocks', 'page_title'));
    }




    public function ViewBookStock($id){
        
        $page_title = 'View Book Stock';
       
        // $viewbookStock = BookStock::where('book_id', $id)->get()->toArray();
        $viewbookStock = BookStock::select('books.*','book_stocks.id as stock_id')
        ->Join('books', 'books.id','=','book_stocks.book_id')
        ->where('book_stocks.book_id', $id)
        ->get();

        // dd($viewbookStock);
        
        return view('books.view_book_stock', compact('viewbookStock', 'page_title'));
    }

    public function DeleteBookstock($id){

        $data = BookStock::find($id);

        if ($data != null) {
            $data->delete();
 
            return redirect()->back()->with('success', 'Book Deleted Successfully.');
        }

        return redirect()->back()->with('error', 'Wrong Id.');
    }


    public function SellBook(){
        $page_title = 'Sell Book';
        
        $getbooks = BookStock::select('books.*','book_stocks.id as stock_id')
        ->Join('books', 'books.id','=','book_stocks.book_id')
        ->where('book_stocks.status', 1)
        ->get();
        // $getbooks = Books::all();
        $getusers = User::all();
        
        return view('books.sell_book', compact('getbooks','getusers', 'page_title'));
    }

    public function bookSell(Request $request){
        
        $dataArray = BookStock::where('id', $request->Book_id)->get()->first();
        // dd($dataArray);
        $dataArray->status = 0;
        $dataArray->update();

        $data = new BookHistory();
        $data->user_id = $request->user_id;
        $data->book_stock_id = $request->Book_id;
        $data->date = date('Y-m-d');
        $data->status = 0;
        $result = $data->save();

        return redirect(url('sell_book'))->with('success', 'Book Sell Successfully.');
    }


    public function BookHistory(){
        $page_title = 'Book History';

        $sellbookshistory = DB::table('book_histories')
        ->Join('books', 'books.id','=','book_histories.book_stock_id')
        ->Join('users', 'users.id','=','book_histories.user_id')
        ->where('book_histories.status', 1)
        ->get();

        // dd($getbooks);

        return view('books.sell_book_history', compact('sellbookshistory', 'page_title'));

    }

    public function PandingOrders(){
        $page_title = 'Panding Orders';

        $pandingorders = DB::table('book_histories')
        ->Join('books', 'books.id','=','book_histories.book_stock_id')
        ->Join('users', 'users.id','=','book_histories.user_id')
        ->where('book_histories.status', 0)
        ->get();

        // dd($pandingorders);

        return view('books.panding_orders', compact('pandingorders', 'page_title'));

    }

    public function Reject_Order(Request $request, $id){

        // $data = BookHistory::find($id);
        $data = BookHistory::where('book_stock_id', $id)->get()->first();

        if ($data != null) {

            $dataArray = BookStock::where('book_id', $id)->where('status', 0)->get()->first();
            $dataArray->status = 1;
            $dataArray->update();

            $data->delete();
 
            return redirect()->back()->with('error', 'Order Rejected Successfully.');
        }

        return redirect()->back()->with('error', 'Wrong Id.');
    }

    public function Accept_Order(Request $request, $id){

        $data = BookHistory::where('book_stock_id', $id)->where('status', 0)->get()->first();
        
        if ($data != null) {

            $data->status = 1;
            $data->update();
            
 
            return redirect()->back()->with('success', 'Order Accepted Successfully.');
        }

        return redirect()->back()->with('error', 'Order Not Accepted.');
    }


    public function BuyBook($id){
        $page_title = 'Buy Book';

        // $book = Books::where('id', $id)->get()->toArray();

        $book = BookStock::select('books.*','book_stocks.id as stock_id', 'book_stocks.book_id')
        ->Join('books', 'books.id','=','book_stocks.book_id')
        ->where('book_stocks.book_id', $id)
        ->groupBy('book_id')
        ->get();

        // dd($book);

        return view('books.buy_book', compact('page_title', 'book'));

    }

    public function Place_Order(Request $request){

        // dd($request->stock_id);

        $dataArray = BookStock::where('id', $request->stock_id)->get()->first();
        $dataArray->status = 0;
        $dataArray->update();

        $data = new BookHistory();
        $data->user_id = Auth::user()->id;
        $data->book_stock_id = $request->book_id;
        $data->status = 0;
        $data->quantity = $request->quantity;
        $data->date = date('Y-m-d');

        // dd($data);
        $result = $data->save();

        return redirect(url('/'))->with('success', 'Your Order Is Placed Successfully. Admin will contact you soon');
    } 
}
