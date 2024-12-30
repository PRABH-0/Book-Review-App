@extends('layout.app')

@section('main')


<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            
            @include('layout.sidebar')    

        </div>
        <div class="col-md-9">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    My Reviews
                </div>
                <div class="card-body pb-0">            
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Book</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Status</th>                                  
                                <th width="100">Action</th>
                            </tr>
                            <tbody>
                                
                                @if($reviews->isNotEmpty())
                                @foreach ($reviews as $review)
                                    
                                <tr>
                                    <td>{{ $review->book->title }}</td>
                                    <td>{{ $review->review }}</td>                                        
                                    <td>{{ $review->rating }}</td>
                                    <td>
                                        @if($review->status == 1)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Block</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="edit-review.html" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('account.deleteReview',$review->id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                               @endif                                   
                            </tbody>
                        </thead>
                    </table>   
                    {{ $reviews->links() }}                  
                </div>
                
            </div>                
        </div>
    </div>
@endsection
