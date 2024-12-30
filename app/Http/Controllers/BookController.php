<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    //This method will show books listing page
    public function index(Request $request){

        $books = Book::orderBy('created_at','DESC');

        if(!empty($request->keyword)){
            $books->where('title','like','%'.$request->keyword.'%');
        }

        $books = $books->paginate(5);

        return view('books.list',[
            'books' => $books
        ]);
    }

    // This method will show create book page
    public function create(){

        return view('books.create',);
    }

    // This method will store book in database
    public function store(Request $request){
        $rules = [
            'title' =>'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required',
        ];

        if(!empty($request->image)){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('books.create')->withInput()->withErrors($validator);
        }

        //Save book in DB
        $book = new Book(); 
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        // Upload Image Here
        if(!empty($request->image)){
            $image = $request->image;
            $ext =  $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;

            $image->move(public_path('uploads/books'),$imageName);

            $book->image=$imageName;
            $book->save();

        }

        return redirect()->route('books.index')->with('success','Book added successfully');

    }

    // This method will show edit book page
    public function edit($id){
        $book = Book::findOrFail($id);
        // dd($book);
        return view('books.edit',[
            'book'=>$book
        ]);
    }

    // This method update a book details
    public function update($id,Request $request){
        $book = Book::findOrFail($id);

        $rules = [
            'title' =>'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required',
        ];

        if(!empty($request->image)){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('books.edit',$book->id)->withInput()->withErrors($validator);
        }

        //Update book in DB
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        // Upload Image Here
        if(!empty($request->image)){

            // This will delete old book image from directry
            File::delete(public_path('uploads/books'),$book->image);

            $image = $request->image;
            $ext =  $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;

            $image->move(public_path('uploads/books'),$imageName);

            $book->image=$imageName;
            $book->save();
        }
        return redirect()->route('books.index')->with('success','Book Updated successfully');
    }


    // // This method will delete book from db
    public function destroy(Request $request){
        $book = Book::find($request->id);

        if($book == null){
            session()->flash('error','Book not found');
            return response()->json([
                'status' => false,
                'message' =>'Book not found' 
            ]);
        }else{
            File::delete(public_path('uploads/books/'.$book->image));
            $book->delete();

            session()->flash('success','Book deleted successfully');

            return response()->json([
                'status' => true,
                'message' =>'Book deleted successfully' 
            ]);
        }
    }

    // This method will show book details
    public function detail($id){
        return view('book-detail');
    }
}