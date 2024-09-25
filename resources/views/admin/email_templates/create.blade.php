<x-auth-layout>


    <form action="{{ route('email-templates.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Template Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Template Content</label>
            <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Template</button>
    </form>



</x-auth-layout>
