@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lists Categories') }}</div>

                {{-- report success --}}
                @if (session('msg'))
                <div class="alert alert-success m-3" role="alert">
                    {{ session('msg') }}
                </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Active</th>
                            <th>Edit</th>
                            <th width="10%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($categories))
                            @foreach ($categories as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->slug}}</td>
                                    <td>
                                        @if ( $item->active == 1 )
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">No Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.edit', [$item->id]) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('categories.destroy', [$item->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" onclick="return confirm('Sure to delete');" value="Delete" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="10" class="text-center text-danger">No data</td></tr>    
                        @endif
                    </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
