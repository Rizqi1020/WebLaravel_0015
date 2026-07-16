@extends('master')

@section('body')
<div class="row pt-3">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white border-bottom py-3">
                <h4 class="mb-0 fw-bold">Tambah Berita Baru</h4>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-0">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Judul Berita</label>
                        <input type="text" class="form-control rounded-1" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label fw-bold">Kategori</label>
                            <select class="form-select rounded-1" id="category" name="category">
                                <option value="NASIONAL" {{ old('category') == 'NASIONAL' ? 'selected' : '' }}>NASIONAL</option>
                                <option value="TEKNOLOGI" {{ old('category') == 'TEKNOLOGI' ? 'selected' : '' }}>TEKNOLOGI</option>
                                <option value="EKONOMI" {{ old('category') == 'EKONOMI' ? 'selected' : '' }}>EKONOMI</option>
                                <option value="OLAHRAGA" {{ old('category') == 'OLAHRAGA' ? 'selected' : '' }}>OLAHRAGA</option>
                                <option value="HIBURAN" {{ old('category') == 'HIBURAN' ? 'selected' : '' }}>HIBURAN</option>
                                <option value="KESEHATAN" {{ old('category') == 'KESEHATAN' ? 'selected' : '' }}>KESEHATAN</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="publisher" class="form-label fw-bold">Penulis / Redaksi</label>
                            <input type="text" class="form-control rounded-1" id="publisher" name="publisher" value="{{ old('publisher', 'Redaksi') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Link URL Gambar (Opsional)</label>
                        <input type="url" class="form-control rounded-1" id="image" name="image" value="{{ old('image') }}" placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label fw-bold">Isi Berita</label>
                        <textarea class="form-control rounded-1" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger px-4 fw-bold rounded-1">Simpan Berita</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary px-4 fw-bold rounded-1">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
