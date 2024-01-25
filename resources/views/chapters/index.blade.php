@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lists Chapters') }}</div>

                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-success" role="alert">
                        {{ '' }}
                    </div>
                    @endif

                    <table class="table table-dark table-striped">
                        
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th width="25%">Information</th>
                                <th width="35%">Sumary</th>
                                <th>Active</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (!empty($chapters))
                                @foreach ($chapters as $key => $item)          
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <p>Name: <span>{{ $item->title }}</span></p>
                                            <p>Slug: <span>{{ $item->slug }}</span></p>
                                            <p>Comic: <span>{{ $item->comic->name }}</span></p>
                                        </td>
                                        <td>
                                            <p>{{ $item->sumary }}</p>
                                        </td>
                                        <td>
                                            @if ($item->active == 1)
                                                <p class="text-success">Active</p>
                                            @else
                                                <p class="text-danger">No Active</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('chapters.edit', [$item->id]) }}" class="btn btn-warning">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('chapters.destroy', [$item->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td class="text-center text-danger" colspan="10">No data</td></tr>
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
