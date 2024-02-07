@extends('layouts.index')
@section('title', 'Prakerin')
@section('content')

    <div class="row">
        <h1>Prakerin</h1>
    </div>
    <div class="row mb-4">
        <div class="col-4">
            <a href="{{ url('/dashboard/prakerin/semua') }}" class="text-decoration-none">
                <div class="card border-0" style="background-color: #006fee">
                    <div class="card-body d-flex text-white" style="height: 120px">
                        <div class="w-100 d-flex flex-column justify-content-center">
                            <h1>{{ $all_prakerin }}</h1>
                            <h4 class="m-0">Semua Prakerin</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5" icon="teacher"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ url('/dashboard/prakerin/berlangsung') }}" class="text-decoration-none">
                <div class="card border-0" style="background-color: #7828c8">
                    <div class="card-body d-flex text-white" style="height: 120px">
                        <div class="w-100 d-flex flex-column justify-content-center">
                            <h1>{{ $prakerinBerlangsung }}</h1>
                            <h4 class="m-0">Berlangsung</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5" icon="hourglass"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ url('/dashboard/prakerin/selesai') }}" class="text-decoration-none">
                <div class="card border-0" style="background-color: #17c964">
                    <div class="card-body d-flex text-white" style="height: 120px">
                        <div class="w-100 d-flex flex-column justify-content-center">
                            <h1>{{ $prakerinSelesai }}</h1>
                            <h4 class="m-0">Selesai</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                            <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5" icon="task-square"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>List prakerin terbaru</h3>
            <table class="table table-bordered rounded overflow-hidden">
                <thead class="table-secondary">
                    <tr>
                        <th>ID Prakerin</th>
                        <th>NIS</th>
                        <th>Nama siswa</th>
                        <th>Pembimbing</th>
                        <th>Status</th>
                        <th>Tanggal mulai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $prakerin)
                        <tr>
                            <td>{{ $prakerin->id }}</td>
                            <td>{{ $prakerin->id_pengajuan }}</td>
                            <td>{{ $prakerin->siswa->nama }}</td>
                            <td>{{ $prakerin->pembimbing_sekolah->nama }}</td>
                            <td>{{ $prakerin->status }}</td>
                            <td>{{ $prakerin->tanggal_mulai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false
        })
    </script>
@endsection
