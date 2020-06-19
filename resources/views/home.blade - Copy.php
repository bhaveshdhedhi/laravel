@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}                            
                        </div>
                    @endif

                    <div id="result">
                        <h1>Posts</h1>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <hr>
                                            <h3><a href="/posts/{{$user->id}}">{{$user->title}}</a></h3>
                                            <div>
                                                {!! $user->body !!}
                                            </div>
                                            <span style="color:grey;"><b> {{$user->hobbies}} </b><span> 
                                            <small>Written on {{ date('d/m/Y', strtotime($user->created_at)) }} by {{$user->name}}</small>                                
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        @else
                            <p>No Users found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
