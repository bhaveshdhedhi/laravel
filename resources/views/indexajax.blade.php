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
              <td>
                @if(in_array($user->id, $friendsIds))
                  <span class="text-success">Your Friend</span>                  
                @elseif(in_array($user->id, $sentfriendRequestIds))
                  <span class="text-success">Request sent</span>
                @elseif(in_array($user->id, $friendRequestIds))
                  <a href="#" class="btn btn-primary action_button accept_request" data-action="accept_request" id="{{$user->id}}" >Accept</a>
                @elseif(in_array($user->id, $blockedUsers))
                  <span class="text-danger">Blocked</span>
                @else
                  <a href="#" class="btn btn-primary action_button send_request" data-action="send_request" id="{{$user->id}}" >Send Friend Request</a>
                  <br />
                  <br />
                  <a href="#" class="btn btn-primary action_button block_user" data-action="block_user" id="{{$user->id}}">Block</a>
                @endif
              </td>
            </tr>          
            @endforeach    
        @else 
            <tr>
              <td colspan="6" class="text-center">No Users found</td>
            </tr>
        @endif
    </tbody>
</table>

<script type="text/javascript">
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $(".action_button").on('click', function(){
        var friend_id = $(this).attr('id');
        var action = $(this).data('action');
        var url = '';
        if(action == "send_request"){
          var url = "{{ route('sendrequest') }}";
        }
        else if(action == "accept_request"){
          var url = "{{ route('acceptrequest') }}";
        }
        else if(action == "block_user"){
          var url = "{{ route('blockuser') }}";
        }
        if(url != ''){     
          $.ajax({
              url: url,
              type: 'GET',
              data: {
                  'friend_id': friend_id,
              },
              success: function(response){       
                  location.reload();
              }
          });
        }
        else {
          alert('Please try again somethinng went wrong.');
        }
    });
   
</script>