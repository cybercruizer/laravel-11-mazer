<x-app-layout>
    <x-slot:title>
        {{$title}}
    </x-slot>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{$title}}</h3>
                    <p class="text-subtitle text-muted">{{$subtitle}}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="">{{$title}}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Daftar Device Presensi</h4>
                    <div class="modal-primary me-1 mb-1 d-inline-block">
                        <!-- Button trigger for primary themes modal -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#primary">
                            Tambah Device
                        </button>

                        <!--primary theme Modal -->
                        <div class="modal fade text-left" id="primary" tabindex="-1"
                            aria-labelledby="myModalLabel160" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <form action="{{ route('device.store') }}" method="post">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title white" id="myModalLabel160">Tambah Device
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18">
                                                    </line>
                                                    <line x1="6" y1="6" x2="18" y2="18">
                                                    </line>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="device_name">Device Name</label>
                                                <input type="text" class="form-control" id="device_name"
                                                    name="device_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="device_location">Device Location</label>
                                                <input type="text" class="form-control" id="device_location"
                                                    name="device_location">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Batal</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Tambahkan</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col">Nama Device</th>
                                    <th scope="col">Device ID</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($devices as $device)
                                    <tr class="">
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $device->device_name }}</td>
                                        <td>{{ $device->device_id }}</td>
                                        <td>{{ $device->device_location }}</td>
                                        <td>
                                            @if($device->is_active == 1)
                                                <span class="badge bg-success"><i class="bi bi-wifi"></i></span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-wifi-off"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('device.edit', $device->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('device.destroy', $device->id) }}"
                                                class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
</x-app-layout>
