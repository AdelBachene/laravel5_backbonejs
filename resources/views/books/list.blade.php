@extends('layouts.'.$parentLayout)

@section('content')
<h2>Books</h2>
<a href="{{ route('book.create') }}" class="btn btn-primary pull-right">Add a book</a>
<div style="clear:both;height:20px;"></div>
@if(Session::has('success_message'))
<div class="alert alert-success" role="alert">{{ Session::get('success_message') }} </div>
@endif
<table cellspacing="0" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($books as $book)
    <tr>
      <td>{{ $book->title }}</td>
      <td>{{ $book->author }}</td>
      <td>
        <a title="Edit the book" class="action-edit" href="{{ route('book.edit', ['id' => $book->id]) }}">
          <span class="glyphicon glyphicon-pencil" ></span>
        </a>

        <form method="POST" class="action-delete" action="{{ route('book.destroy', ['id' => $book->id]) }}" style="display:inline;">
          <input type="hidden" name="_method" value="DELETE" />
          {{ csrf_field() }}
          <button type="submit" title="Delete the book" class="glyphicon glyphicon-trash" style="color:red;border:0;background-color:transparent"></button>
        </form>
      </td>
    </tr>
    @endforeach
    @if(count($books) == 0)
    <tr>
      <td colspan="3">Empty dataset.</td>
    </tr>
    @endif
  </tbody>
</table>
@endsection