<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\User;
use App\Models\BookStock;
use App\Models\BookHistory;
use DB;

class BookController extends Controller
{

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
// dd('yes');
        
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
        $result = $data->save();

        return redirect(url('sell_book'))->with('success', 'Book Sell Successfully.');
    }


    public function BookHistory(){
        $page_title = 'Book History';

        $sellbookshistory = DB::table('book_histories')
        ->Join('books', 'books.id','=','book_histories.book_stock_id')
        ->Join('users', 'users.id','=','book_histories.user_id')
        ->get();

        // dd($getbooks);

        return view('books.sell_book_history', compact('sellbookshistory', 'page_title'));

    }
}
