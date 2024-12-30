<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    //This method will show register page
    public function register(){
        return view('account.register');
    }

    // This method will register a user
    public function prosessRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);

        }

        // now register user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.login')->with('success','You have registered successfully');

    }

    public function login(){
        return view('account.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt(['email' => $request->email, 'password' =>$request->password])){

            return redirect()->route('account.profile');
        }else{
            return redirect()->route('account.login')->with('error','Either email/password is incorrect');

        }

    }

    // This method show user profile
    public function profile(){
        $user = USer::find(Auth::user()->id);
        // dd($user);

        return view('account.profile',[
            'user' =>$user
        ]);
    }

    // This method will update user profile
    public function updateProfile(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id . ',id',
        ];
    
        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->route('account.profile')->withInput()->withErrors($validator);
        }
    
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Save the user data without the image first
        $user->save();
    
        // Check and upload the image
        if (!empty($request->image)) {
            
            // Delete old image
            // File::delete(public_path('uploads/profile'),$user->image);
            File::delete(public_path('uploads/profile/').$user->image);


            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
    
            // Save the image file to the directory
            $image->move(public_path('uploads/profile'), $imageName);
    
            // Update the user's image field with the correct filename
            $user->image = $imageName;
            $user->save(); // Save the updated image name
        }
    
        return redirect()->route('account.profile')->with('success', 'Profile Updated Successfully');
    }
    

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function myReviews(){

        $reviews = Review::with('book')
                    ->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
        return view('account.reviews.my-reviews',[
            'reviews' =>$reviews
        ]);
    }

    public function deleteReview($id){
        $deleteReview = Review::destroy($id);
        if($deleteReview){
            session()->flash('success','Review Deleted successfully');
        }else{
            session()->flash('error','Review Not be Deleted ');
        }
        // return view('account.myReviews',);
        return redirect()->route('account.myReviews');
    }

}
