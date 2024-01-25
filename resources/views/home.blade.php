@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
