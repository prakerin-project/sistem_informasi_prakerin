@extends('layouts.index')
@section('title', 'Perusahaan')
@section('content')
    <div class="row">
        <div class="col d-flex align-items-center justify-content-between mb-3">
            <div>
                <h1>Perusahaan</h1>
            </div>
            @if (auth()->user()->role == 'hubin')
                <button type="button" class="btn btn-primary rounded-4" data-bs-toggle="modal"
                    data-bs-target="#tambah-ps-modal"><i class="iconsax" type="linear" stroke-width="1.5"
                        icon="buildings-2"></i> Tambah
                </button>
            @endif

            <!-- Tambah Perusahaan Modal -->
            <div class="modal fade" id="tambah-ps-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Perusahaan</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-ps-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama-perusahaan">Nama Perusahaan</label>
                                    <input type="text" id="nama-perusahaan" class="form-control mb-3" autofocus
                                        name="nama_perusahaan" required />
                                    <label for="j-perusahaan">Jenis Perusahaan</label>
                                    <select name="id_jenis_perusahaan" id="j-perusahaan" class="form-select mb-3" required>
                                        <option selected value="">Pilih jenis perusahaan</option>
                                        @foreach ($jenis_perusahaan as $jp)
                                            <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control mb-3" required
                                        autocomplete="off">
                                    <label for="link_website">Link website</label>
                                    <input type="text" id="link_website" name="link_website" class="form-control mb-3"
                                        autocomplete="off">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" style="height:
                                    100px"></textarea>
                                    <label class="d-block mt-3">Foto </label>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-4">
                                            <label for="fileUpload" class="btn flex p-2 btn-outline-success form-control"><i
                                                    class="bi-camera-fill"></i> Upload
                                                Foto </label>
                                            <input type="file" accept="image/*" multiple name="foto[]" id="fileUpload"
                                                class="d-none form-control">
                                        </div>
                                        <div class="col p-0">
                                            <p class="fileName m-0 d-inline-block"></p>
                                        </div>
                                    </div>
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" form="tambah-ps-form">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
                <tr>
                    <th class="text-uppercase">Nama Perusahaan</th>
                    <th class="text-uppercase">Jenis Perusahaan</th>
                    <th class="text-uppercase">Email</th>
                    <th class="text-uppercase">Link website</th>
                    <th class="text-uppercase">Alamat</th>
                    <th class="text-uppercase">Foto</th>
                    @if (auth()->user()->role == 'hubin')
                        <th class="text-uppercase">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($perusahaan as $p)
                    <tr idPerusahaan='{{ $p->id }}'>
                        <td>{{ $p->nama_perusahaan }}</td>
                        <td>{{ $p->jenis_perusahaan->nama }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            <a href="//{{ $p->link_website }}" target="_blank">{{ $p->link_website }}</a>
                        </td>
                        <td>{{ $p->alamat }}</td>
                        <td class="justify-content-center">
                            <div class="d-flex align-items-center justify-content-center">
                                @if (isset($p->foto) && count($p->foto) > 0)
                                    <img src="{{ route('displayImage', ['uri' => $p->foto[0]->path, 'folder' => 'perusahaan']) }}"
                                        width="160px" height="150px" alt="Foto perusahaan" style="object-fit: cover;">
                                @else
                                    No data available
                                @endif
                            </div>
                        </td>
                        @if (auth()->user()->role == 'hubin')
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ url("/dashboard/perusahaan/$p->id") }}"
                                        class="link-underline flex-shrink-1 link-underline-opacity-0">
                                        <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="eye"></i></h4>
                                    </a>
                                    <!-- Button trigger edit modal -->
                                    <a href="" class="editBtn text-warning link-underline link-underline-opacity-0"
                                        data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $p->id }}"
                                        idPerusahaan="{{ $p->id }}">
                                        <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="edit-1"></i>
                                        </h4>
                                    </a>
                                    <a href="#"
                                        class="text-danger hapusBtn cursor-pointer link-underline link-underline-opacity-0">
                                        <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="trash"></i>
                                        </h4>
                                    </a>
                                </div>
                            </td>
                        @endif
                    </tr>

                    <!-- Edit Perusahaan Modal -->
                    <div class="modal fade" id="edit-modal-{{ $p->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Perusahaan</h1>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-ps-form-{{ $p->id }}" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama-perusahaan">Nama Perusahaan</label>
                                            <input type="text" id="nama-perusahaan" class="form-control mb-3"
                                                autofocus name="nama_perusahaan" required
                                                value="{{ $p->nama_perusahaan }}" />
                                            <label for="j-perusahaan">Jenis Perusahaan</label>
                                            <select name="id_jenis_perusahaan" id="j-perusahaan" class="form-select mb-3"
                                                required>
                                                @foreach ($jenis_perusahaan as $jp)
                                                    <option value="{{ $jp->id }}"
                                                        @if ($jp->id === $p->id_jenis_perusahaan) selected @endif>
                                                        {{ $jp->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control mb-3" required autocomplete="off"
                                                value="{{ $p->email }}">
                                            <label for="link_website">Link website</label>
                                            <input type="text" id="link_website" name="link_website"
                                                class="form-control mb-3" required autocomplete="off"
                                                value="{{ $p->link_website }}">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control" style="height:
                               100px">{{ $p->alamat }}</textarea>
                                            @csrf
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary submit-btn"
                                        form="edit-ps-form-{{ $p->id }}">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false
        });

        // Failed : function untuk upload multiple foto
        // let fotos = [];
        // $('input[type=file]').on('change', function (e) {
        //     for (let i = 0; i < this.files.length; i++) {
        //         fotos.push(this.files[i]);
        //     }

        //     console.log(fotos);
        //     // fotos.map((f) => {
        //     //     console.log(f.nama)
        //     // })
        //     // console.log(fotos)
        // })

        /*-------------------------- TAMBAH PERUSAHAAN -------------------------- */
        $('#tambah-ps-form').on('submit', function(e) {
            e.preventDefault(this);
            let data = new FormData(e.target);
            // Untuk mendapatkan foto-foto yang diupload
            let file = $('#fileUpload')[0].files;

            // Menggabungkan foto ke dalam data
            data.append('foto', file);

            console.log(Object.fromEntries(data));
            axios.post('/api/perusahaan', data)
                .then((res) => {
                    // console.log(res);
                    $('#tambah-ps-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function() {
                        location.reload();
                    })
                })
                .catch(({
                    response
                }) => {
                    let message = '';
                    console.log(response)

                    Object.values(response.data).flat().map((e) =>
                        message += `<strong class="text-danger d-block">${e}</strong>`
                    );

                    swal.fire('Gagal tambah data!', `${message}`, 'warning');
                });
        })

        /*-------------------------- EDIT PERUSAHAAN -------------------------- */
        $('.editBtn').on('click', function(e) {
            $('input[type=file]').trigger('change');

            e.preventDefault();
            let idPerusahaan = $(this).attr('idPerusahaan');
            $(`#edit-ps-form-${idPerusahaan}`).on('submit', function(e) {
                e.preventDefault(this);
                let data = new FormData(e.target);
                const value = Object.fromEntries(data.entries());
                // Update perusahaan tidak termasuk foto
                axios.put(`http://localhost:8000/api/perusahaan/${idPerusahaan}`, value)
                    .then(() => {
                        $(`#edit-modal-${idPerusahaan}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function() {
                            location.reload();
                        })
                    })
                    .catch(({
                        response
                    }) => {
                        console.log(response)
                        let message = '';

                        Object.values(response.data).flat().map((e) =>
                            message += `<strong class="text-danger d-block">${e}</strong>`
                        );

                        swal.fire('Gagal tambah data!', `${message}`, 'warning');
                    })
            })
        })

        /*-------------------------- HAPUS PERUSAHAAN -------------------------- */
        $('.table').on('click', '.hapusBtn', function(e) {
            e.preventDefault(this)
            let idPerusahaan = $(this).closest('tr').attr('idPerusahaan');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    //dilakukan proses hapus
                    axios.delete(`http://localhost:8000/api/perusahaan/${idPerusahaan}`)
                        .then(function(response) {
                            console.log(response);
                            if (response.data.status == 'success') {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            } else {
                                swal.fire('Gagal di hapus!', '', 'warning');
                            }
                        }).catch(function() {
                            swal.fire('Data gagal di hapus!', '', 'error').then(function() {
                                //Refresh Halaman
                                location.reload();
                            });
                        });
                }
            });
        })
    </script>
@endsection
