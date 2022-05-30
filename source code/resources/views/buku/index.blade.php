@extends('buku.layout')
 
@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Test Table</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('buku.create') }}"> Create New book</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>judul</th>
            <th>cover</th>
            <th>penulis</th>
            <th>penerbit</th>
            <th>tahun terbit</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($buku as $b)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->cover }}</td>
            <td>{{ $b->penulis }}</td>
            <td>{{ $b->penerbit }}</td>
            <td>{{ $b->tahun_terbit }}</td>
            <td>
                <form action="{{ route('buku.destroy',$b->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('buku.show',$b->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('buku.edit',$b->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="row text-center">
        {!! $buku->links() !!}
    </div>
      
@endsection