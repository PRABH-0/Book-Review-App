<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    //This method will show reviews in backend
    public function index(){
        $reviews = Review::with('book','user')->orderBy('created_at','DESC')->paginate(10);
        return view('account.reviews.list',[
            'reviews' =>$reviews
        ]); 
    }
    
    // This method will delete review from database
    public function deleteReview(Request $request){

        $id = $request->id;

        $review = Review::findOrFail($id);

        if($review == null){
            session()->flash('error','Review not Found');
            return response()->json([
                'status' => false
            ]);
        }else{
            $review->delete();

            session()->flash('success','Review delete successfully');
            return response()->json([
                'status' => false
            ]);
        }
    }
}
