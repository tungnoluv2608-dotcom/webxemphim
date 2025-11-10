@extends('layouts.app')

@section('content')
    <table class="table" id="tableuser">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Email</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['user.destroy', $user->id],
                            'onsubmit' => 'return confirm("Bạn có chắc muốn xóa người dùng này?")',
                        ]) !!}
                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection