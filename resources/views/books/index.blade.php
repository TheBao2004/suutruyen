@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lists Books') }}</div>

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
                                <th>Information</th>
                                <th width="15%">Image</th>
                                <th>Active</th>
                                <th>Time</th>
                                {{-- <th>Status</th> --}}
                                <th>Options</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (!empty($books))
                                @foreach ($books as $key => $item)          
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>

                                            <ul>
                                                <li><span>Name: <span>{{ $item->name }}</span></span></li>
                                                <li><span>Slug: <span>{{ $item->slug }}</span></span></li>
                                                {{-- <li><span>Author: <span>{{ $item->author }}</span></span></li> --}}
                                                {{-- <li><span>Category: <span>{{ $item->category->name }}</span></span></li> --}}
                                                <li><span>View: <span>{{ $item->view }}</span></span></li>
                                            </ul>
                                
                                        </td>
                                        <td>
                                            <img src="{{ asset('upload/image').'/'.$item->image }}" alt="Error" class="" width="80%">
                                        </td>
                                        <td>
                                            @if ($item->active == 1)
                                                <p class="text-success">Active</p>
                                            @else
                                                <p class="text-danger">No Active</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p>Create: <span>{{ $item->created_at->diffForHumans() }}</span></p>
                                            @if ($item->updated_at != '')
                                            <p>Update: <span>{{ $item->updated_at->diffForHumans() }}</span></p>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <div class="mb-3">
                                            <label for="">Outstanding</label>
                                            <form action="" method="post">
                                                @csrf
                                                <select name="outstanding" class="form-select outstanding" size="2" data-id="{{ $item->id }}" aria-label="size 3 select example">

                                                    <option value="2" {{ $item->outstanding == '2' ? 'selected' : ''}}>Outstanding</option>
                                                    <option value="1" {{ $item->outstanding == '1' ? 'selected' : '' }}>Comic New</option>

                                                </select>

                                            </form>
                                            </div>
                                            <div class="mb-3">  
                                                <label for="">Full</label>
                                                <form action="" method="post">
                                                    @csrf
                                                    <select name="full" class="form-select full" size="2" data-id="{{ $item->id }}" aria-label="size 3 select example">
    
                                                        <option value="1" {{ $item->full == '1' ? 'selected' : ''}}>Full</option>
                                                        <option value="0" {{ $item->full == '0' ? 'selected' : '' }}>Update</option>
    
                                                    </select>
    
                                                </form>
                                                </div>
                                        </td> --}}
                                        
                                        <td>

                                            <a href="{{ route('books.edit', [$item->slug]) }}" class="btn btn-warning">Edit</a>

                                            <hr>

                                            <form action="{{ route('books.destroy', [$item->id]) }}" method="post">
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
