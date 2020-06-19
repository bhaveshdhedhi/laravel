<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Hobbies</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($users) > 0)                          
       
            @foreach($users as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{ucfirst($user->gender)}}</td>
              <td>{{$user->hobbies}}</td>
              <td><a href="#" class="btn btn-primary">Friend</a></td>
            </tr>          
            @endforeach    
        @else 
            <tr >
              <td colspan="6" class="text-center">No Users found</td>
            </tr>
        @endif
    </tbody>
</table>