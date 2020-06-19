@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                        
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}                            
                </div>
            @endif

            <h1>Users</h1>

            <form action="{{ route('home') }}" method="GET">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Gender</strong>                                    
                            <select name="gender" id="gender" class="form-control">
                                <option value="">All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Hobby</strong>                                    
                            <select name="hobby_id" id="hobby_id" class="form-control">    
                                <option value="" selected="selected">All</option>           
                                    @foreach ($hobbies as $hobby)                                            
                                    <option value="{{ $hobby->hobby_id }}">{{ $hobby->hobby_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">   
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <input id="submit_btn" type="button" class="btn btn-primary" value="Search">
                        </div>
                    </div>
                </div>
            </form>
            <div id="result">
                                   
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')

<script type="text/javascript">
$(document).ready(function(){
    loadUsers();    
    // First Time Click Button and show the users without no filter
    $("#submit_btn").trigger('click');
    
});

function loadUsers(){

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $("#submit_btn").on('click', function(){
        var gender = $('#gender').val();
        var hobby_id = $('#hobby_id').val();
        $.ajax({
            url: "{{ route('indexajax') }}",
            type: 'GET',
            data: {
                'gender': gender,
                'hobby_id': hobby_id,
            },
            success: function(response){        
                $('#result').html(response);
            }
        });
    });
}
</script>
@endsection