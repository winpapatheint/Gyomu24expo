@extends('layouts.admin')

@section('content')
<h1>Edit Email Template</h1>

<form action="{{ route('email-templates.update', $template) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ $template->name }}" required>
    </div>
    <div>
        <label>Content</label>
        <textarea name="content" required>{{ $template->content }}</textarea>
    </div>
    <button type="submit">Update</button>
</form>
@endsection
