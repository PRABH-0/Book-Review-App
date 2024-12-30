@extends('layout.app')

@section('main')

<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layout.sidebar')
        </div>
        
        <div class="col-md-9">
            @include('layout.message')

            <div class="card border-0 shadow" style="background-color: white">
                <div class="card-header">
                    Books
                </div>
                <div class="card-body pb-0">    
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Add Book Button -->
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
                        
                        <!-- Search Form -->
                        <div class="d-flex">
                            <form action="" method="get" class="d-flex">
                                <input type="text" class="form-control" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Keyword">
                                <button type="submit" class="btn btn-primary ms-2">Search</button>
                                @if (Request::get('keyword'))
                                <a href="{{ route('books.index') }}"  class=" btn btn-primary ms-2">Clear</a>
                                    
                                @endif
                            </form>
                        </div>
                    </div>
                </div>        

                <div class="m-2">
                    <table class="table table-striped mt-4" style="padding: 5px;">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($books->isNotEmpty())
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>3.0 (3 Reviews)</td>
                                        <td>
                                            @if( $book->status == 1 )
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                            <a href="{{ route('books.edit',$book->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="{{ route('books.destroy',$book->id) }}" onclick="deleteBook({{ $book->id }})" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Books not found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>   

                    @if ($books->isNotEmpty())
                        {{ $books->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>       
</div>

@endsection

@section('script')

<script>
    function deleteBook(id){
        if(confirm("Are you sure you want to delete")){
            $.ajax({
                url:'{{ route("books.destroy") }}',
                type:'delete',
                data:{id:id},
                headers:{
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                success:function(response){
                    window.location.href = '{{ route("books.index") }}';
                }
            });
        }
    }
</script>

@endsection