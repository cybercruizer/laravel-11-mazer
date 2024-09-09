<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                    <p class="text-subtitle text-muted">{{ $subtitle }}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="">{{ $title }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Daftar hari kerja</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Hari Aktif</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jamkerjas as $jamkerja)
                                    <tr class="" id="index_{{ $jamkerja->id }}">
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $jamkerja->hari }}</td>
                                        <td>{{ $jamkerja->jam_masuk }}</td>
                                        <td>{{ $jamkerja->jam_pulang }}</td>
                                        <td>
                                            @if ($jamkerja->is_libur == 1)
                                                <span class="badge bg-danger"><i class="bi bi-x-circle-fill"></i></span>
                                            @else
                                                <span class="badge bg-success"><i
                                                        class="bi bi-check-circle-fill"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" id="btn-edit-jamkerja"
                                                data-id="{{ $jamkerja->id }}" class="btn btn-primary btn-sm">EDIT</a>
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
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="editForm" action="{{ route('jamkerja.update') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jam</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="jamid" name="jamid"></input>
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <input type="text" name="hari" class="form-control" id="hari" disabled></input>
                        </div>
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk"></input>
                        </div>
                        <div class="form-group">
                            <label for="jam_pulang">Jam Pulang</label>
                            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang"></input>
                        </div>
                        <div class="form-group">
                            <label for="is_libur">Status Hari</label>
                            <select class="form-select" name="is_libur" id="is_libur">
                                <option value="1">Libur</option>
                                <option value="0">Hari kerja</option>
                            </select>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //button create post event
        $('body').on('click', '#btn-edit-jamkerja', function() {

            let jamkerja_id = $(this).data('id');
            //console.log(jamkerja_id);
            //fetch detail post with ajax
            $.ajax({
                url: "/jamkerja/show/" + jamkerja_id,
                type: "GET",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#jamid').val(response.data.id).attr('value', response.data.id);
                    $('#hari').val(response.data.hari).attr('value', response.data.hari);
                    $('#jam_masuk').val(response.data.jam_masuk).attr('value', response.data.jam_masuk);
                    $('#jam_pulang').val(response.data.jam_pulang).attr('value', response.data.jam_pulang);
                    $('#is_libur').val(response.data.is_libur).attr('value', response.data.is_libur);

                    //open modal
                    $('#modal-edit').modal('show');
                }
            });
        });
    </script>
</x-app-layout>
