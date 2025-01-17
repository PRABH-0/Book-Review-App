@extends('layout.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <!-- Sidebar Section -->
        <div class="col-md-3">
            @include('layout.sidebar')
        </div>

        <!-- Main Content Section -->
        <div class="col-md-9">
            <div class="card border-0 shadow">
                <div class="card-header text-white">
                    Reviews
                </div>
                <div class="card-body pb-0">
                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Book</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Created_at</th>
                                <th>Status</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($reviews->isNotEmpty())
                            @foreach ($reviews as $review)
                                
                            
                            <tr>
                                <td>{{ $review->book->title }}</td>
                                <td>{{ $review->review }}
                                    <br/><strong>{{ $review->user->name }}  </strong>
                                </td>
                                <td>{{ $review->rating }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($review->created_at)->format('d M,Y') }}
                                </td>
                                <td>
                                    @if($review->status == 1)
                                    <span class="text-success">Active</span>
                                    @else
                                    <span class="text-warning">Block</span>

                                    @endif
                                </td>
                                <td>
                                    {{-- <a href="{{ route('account.reviews.edit',$review->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a> --}}

                                    {{-- <a href="{{ route('account.reviews.deleteReview') }}" onclick="deleteReview({{ $review->id }})" class="btn btn-danger btn-sm"> --}}
                                        <a href="javascript:void(0);" onclick="deleteReview({{ $review->id }})" class="btn btn-danger btn-sm">

                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>

                    <div style="background-color: white">
                        {{ $reviews->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function deleteReview(id) {
    if (confirm("Are you sure you want to delete?")) {
        $.ajax({
            url: '{{ route("account.reviews.deleteReview", ":id") }}'.replace(':id', id),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                // Redirect or update the UI
                window.location.href = '{{ route("account.reviews") }}';
            },
            error: function (xhr, status, error) {
                alert("Something went wrong: " + xhr.responseText);
            }
        });
    }
}

</script>
@endsection