@extends('layout')
@section('content')
<div>
    <div class="card">
        <div class="card-header" style="font-size:27px;margin-bottom: 1%;padding:1%">
            <span style="margin-right: 10px;"><i class="bi bi-list-check h3"></i> List of Members </span>
        </div>
        <div class="card-body">
            <table class="table table-stripped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">UserRoll</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    @foreach($user as $user)
                    <tr>
                        <th scope="row">{{ $num }}</th>
                        <td>{{ $user->email}}</td>
                        <td>
                            @if($user->user_roll == 1)
                            Manager
                            @else
                            Staff
                            @endif
                        </td>
                        <td>
                            <form action="/user/{{$user->id}}" method="post">
                                @csrf
                                @Method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                            </form>

                        </td>
                        <?php $num++; ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

@endsection