@extends('master')

@section('title', 'Register - Portal Berita')

@section('body')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        
        <!-- Box Form Register -->
        <div class="card rounded-0 border-0 shadow-sm">
            <!-- Header Hitam dengan Garis Merah -->
            <div class="card-header bg-black text-white rounded-0 border-bottom border-4 border-danger py-3">
                <h5 class="mb-0 fw-bolder text-uppercase">Register Akun Baru</h5>
            </div>
            
            <div class="card-body p-4 bg-white border border-top-0">
                
                <!-- Pesan Error Validasi (Misal: email sudah dipakai/password kurang panjang) -->
                @if($errors->any())
                    <div class="alert alert-danger rounded-0 small fw-bold">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">NAMA LENGKAP</label>
                        <input type="text" name="name" class="form-control rounded-0" placeholder="Nama anda..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">EMAIL</label>
                        <input type="email" name="email" class="form-control rounded-0" placeholder="Email aktif..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">PASSWORD (Min. 8 Karakter)</label>
                        <input type="password" name="password" class="form-control rounded-0" placeholder="***" required minlength="8">
                    </div>
                    <button type="submit" class="btn btn-danger w-100 rounded-0 fw-bold py-2 mb-3" style="background-color: #cc0000;">REGISTER SEKARANG</button>
                </form>
                
                <div class="text-center small fw-bold text-secondary border-top pt-3">
                    SUDAH PUNYA AKUN? 
                    <a href="{{ url('/login') }}" class="text-cnn-red text-decoration-none">LOG IN DI SINI</a>
                </div>
                
            </div>
        </div>
        
    </div>
</div>
@endsection