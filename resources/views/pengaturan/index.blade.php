<x-app-layout>
    <x-slot:title>
        Profile
    </x-slot>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pengaturan Umum</h3>
                    <p class="text-subtitle text-muted">Silakan sesuaikan dengan instansi anda</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengaturan Sekolah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    @if ($pengaturan->logo)
                                        <img src="/img/{{ $pengaturan->logo }}" alt="avatar" class="avatar-img rounded-circle">
                                    @else
                                        <img src="assets/static/images/faces/2.jpg" alt="logo">
                                    @endif
                                </div>

                                <h3 class="mt-3">{{ $pengaturan->nama_sekolah }}</h3>
                                <p class="text-small">{{ $pengaturan->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="logo" class="form-label">Logo Sekolah</label>
                                    <input type="file" name="logo" id="logo" class="form-control"
                                        accept="image/*">
                                    @error('avatar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Sekolah</label>
                                    <input type="text" name="nama_sekolah" id="nama" class="form-control"
                                        placeholder="Nama Sekolah" value="{{ $pengaturan->nama_sekolah }}">
                                    @error('nama_sekolah')
                                        @if ($message == 'The name field is required.')
                                            <span class="text-danger">{{ $message }}</span>
                                        @else
                                            <span class="text-danger">The name field must be at least 3
                                                characters.</span>
                                        @endif
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control"
                                        placeholder="Alamat instansi" value="{{ $pengaturan->alamat }}">
                                    @error('alamat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Telp</label>
                                    <input type="text" name="telp" id="phone" class="form-control"
                                        placeholder="Your Phone" value="{{ $pengaturan->telp }}">
                                    @error('telp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
