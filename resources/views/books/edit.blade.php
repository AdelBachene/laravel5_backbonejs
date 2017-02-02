@extends('layouts.'.$parentLayout)

@section('content')
<h2>{{ $book->id ? 'Edit the book' : 'Add a book' }}</h2>
<div style="clear:both;height:20px;"></div>
<form method="POST" action="{{ $book->id ? route('book.update', ['id' => $book->id]) : route('book.store') }}">
  @if($book->id)
  <input type="hidden" name="_method" value="PUT" />
  @endif
  {{ csrf_field() }}
  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="control-label">Book title *</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" />
  </div>
  <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
    <label for="author" class="control-label">Book author *</label>
    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" />
  </div>
  <div class="form-group">
    <input type="submit" name="submit" value="Save" class="btn btn-primary" />
  </div>
</form>
@endsection