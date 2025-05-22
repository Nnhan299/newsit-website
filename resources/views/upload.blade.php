@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Upload Ảnh</h1>

    <form id="upload-image-form" action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Chọn ảnh:</label>
            <input type="file" name="image" id="image" class="w-full p-2 border rounded" accept="image/*" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
    </form>

    <div id="upload-result" class="mt-4"></div>
</div>

<script>
const form = document.getElementById('upload-image-form');
const resultDiv = document.getElementById('upload-result');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const response = await fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    });

    const data = await response.json();

    if (data.success) {
        resultDiv.innerHTML =
            `<p>Upload thành công! Đường dẫn: <a href="${data.image_path}" target="_blank">${data.image_path}</a></p>`;
    } else {
        resultDiv.innerHTML = '<p>Upload thất bại!</p>';
    }
});
</script>
@endsection