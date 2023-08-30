<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function AddUser(){
        $page_title = 'Add User';

        return view('users.add_user', compact('page_title'));
    }
    
    public function SaveUser(Request $request){
        
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->author;
        $data->password = Hash::make($request->password);
        $data->photo = $request->photo;
        $data->address = $request->address;
        
        if($request->file('photo')){
            $image = $request->file('photo');
            //  unlink(public_path('stdProfile',$model->stdImage));
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('upload/user_img'),$imageName);
        }
        $data->photo = $imageName;
        // dd($data);
        $data->save();

        return redirect(url('view_users'))->with('success', 'User Added Successfully.');
    
    }
    
    public function ViewUser(){
        
        $page_title = 'List Of Users';
        
        $viewusers = User::all();
        
        return view('users.view_users', compact('viewusers', 'page_title'));
    }
    
    public function EditUser($id){
        
        $data['user'] = User::where('id', $id)->get();
        $data['page_title'] = 'Edit User';
        // dd($data['user'][0]['name']);
        
        return view('users.edit_user', $data);
    }
    
    public function UpdateUser(Request $request){
        
        $id = $request->user_id;
        $oldImage = $request->old_image;
        $data = User::where('id', $id)->get()->first();
        // dd($data);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->phone = $request->phone;
        $data->address = $request->address;
        
        if($request->file('photo')){
            $image = $request->file('photo');
            //  unlink(public_path('stdProfile',$model->stdImage));
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('upload/user_img'),$imageName);
        }
        if($request->file('photo')){

            $data->photo = $imageName;
        }else{
            $data->photo = $oldImage;
        }
        // dd($data);
        $data->update();
        return redirect(url('view_users'))->with('success', 'User Updated Successfully.');

    }

    public function DeleteBook(Request $request, $id){

        // dd($id);
        $data = User::find($id);

        if ($data != null) {
            $data->delete();
 
            return redirect()->back()->with('success', 'User Deleted Successfully.');
        }

        return redirect()->back()->with('error', 'Wrong Id.');
    }
}
