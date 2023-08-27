@extends('layouts.app')

@section('title', 'View DPA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View DPA</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of DPAs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor DPA</th>
                            <th>Urusan Pemerintahan</th>
                            <th>Bidang Urusan</th>
                            <th>Program</th>
                            <th>Kegiatan</th>
                            <th>Dana Yang Dibutuhkan</th>
                            <th>PPTK</th>
                            <th>Actions</th>
                            @hasrole('PPTK')
                            <th>Pejabat Pengadaan</th>
                            <th>Pembantu PPTK</th>
                            @endhasrole
                            @hasrole(['Pembantu PPTK', 'PPTK'])
                            <th>Kelengkapan Dokumen</th>
                            @endhasrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpaData as $dpa)
                            <tr class="row-clickable" data-dpa-id="{{ $dpa->id }}">
                                <td>{{ $dpa->id }}</td>
                                <td>{{ $dpa->nomor_dpa }}</td>
                                <td>{{ $dpa->urusan_pemerintahan }}</td>
                                <td>{{ $dpa->bidang_urusan }}</td>
                                <td>{{ $dpa->program }}</td>
                                <td>{{ $dpa->kegiatan }}</td>
                                <td>
                                    @if (is_numeric($dpa->dana))
                                        Rp{{ number_format(floatval($dpa->dana), 2, ',', '.') }}
                                    @else
                                        {{ $dpa->dana }}
                                    @endif
                                </td>
                                <td>
                                    @if ($dpa->assignedUser)
                                        {{ $dpa->assignedUser->full_name }}
                                    @else
                                        <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                            Assign PPTK
                                        </button>
                                        <div class="dropdown-menu">
                                            @foreach ($users as $user)
                                                <a class="dropdown-item" href="{{ route('ViewDPA.assignDpa', ['dpaId' => $dpa->id, 'userId' => $user->id]) }}">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @hasrole('Admin')
                                        <a href="{{ route('editDPA', ['id' => $dpa->id]) }}" class="btn btn-primary edit-btn">Edit</a>
                                        @endhasrole
                                        <a href="{{ asset('uploads/'.$dpa->id.'/'.$dpa->id.'.pdf') }}" class="btn btn-info view-pdf-btn" target="_blank">View PDF</a>
                                    </div>
                                </td>

                                @hasrole('PPTK')
                                <td>
                                    <!-- Assign Pejabat pengadaan -->
                                    <div class="btn-group">
                                        @if ($dpa->user_id2 && $dpa->pejabatPengadaanUser)
                                            {{ $dpa->pejabatPengadaanUser->first_name }} {{ $dpa->pejabatPengadaanUser->last_name }}
                                        @else
                                            <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                                Assign Pejabat Pengadaan
                                            </button>
                                            <div class="dropdown-menu">
                                                @foreach ($pejabatPengadaanUsers as $pejabatPengadaanUser)
                                                    <a class="dropdown-item" href="{{ route('ViewDPA.assignPP', ['dpaId' => $dpa->id, 'userId' => $pejabatPengadaanUser->id]) }}">
                                                        {{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                        <div class="btn-group d-flex justify-content-center mt-4">
                                            <a href="#" class="btn btn-info lihat-deskripsi-btn">Lihat Deskripsi</a>
                                        </div>
                                </td>
                                <td>
                                    <!-- Assign Pembantu PPTK -->
                                    <div class="btn-group">
                                        @if ($dpa->user_id3 && $dpa->pembantupptkUsers)
                                            {{ $dpa->pembantupptkUsers->first_name }} {{ $dpa->pembantupptkUsers->last_name }}
                                        @else
                                            <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                                Assign Pembantu PPTK
                                            </button>
                                            <div class="dropdown-menu">
                                                @foreach ($pembantupptkUsers as $pembantupptkUser)
                                                    <a class="dropdown-item" href="{{ route('ViewDPA.assignPPPTK', ['dpaId' => $dpa->id, 'userId' => $pembantupptkUser->id]) }}">
                                                        {{ $pembantupptkUser->first_name }} {{ $pembantupptkUser->last_name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                @endhasrole
                                
                                @hasrole(['Pembantu PPTK', 'PPTK'])
                                    <td>
                                        <!-- Lihat Kelengkapan -->
                                        <div class="btn-group">
                                            <a href="{{ route('PembantuPPTKView.dokumenpembantupptk', ['dpaId' => $dpa->id]) }}" class="btn btn-info lihat-kelengkapan-btn">
                                                Lihat Kelengkapan
                                            </a>
                                        </div>
                                    </td>
                                @endhasrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.row-clickable');
    rows.forEach(row => {
        row.addEventListener('click', function (event) {
            const dpaId = row.getAttribute('data-dpa-id');
            const assignBtn = row.querySelector('.assign-btn');

            if (event.target.classList.contains('assign-btn')) {
                if (assignBtn.classList.contains('assigned')) {
                    // Handle Pejabat Pengadaan button click
                    const assignedName = row.querySelector('.assigned-name');
                    const userFullName = assignedName.textContent.trim();
                    alert(`Assigned Pejabat Pengadaan: ${userFullName}`);
                } else {
                    // Handle PPTK button click
                    const userLink = assignBtn.nextElementSibling.querySelector('.assign-user-link');
                    const userId = getUserIdFromLink(userLink.getAttribute('href'));
                    alert(`Assigned PPTK: UserID - ${userId}`);
                }
            } else {
                // Handle row click to navigate to the DPA detail page
                window.location.href = `{{ route('ViewDPA.show', ['dpa' => ':dpaId']) }}`.replace(':dpaId', dpaId);
                window.location.href = `{{ route('PembantuPPTKView.dokumenpembantupptk', ['dpaId' => ':dpaId']) }}`.replace(':dpaId', dpaId);
            }
        });
    });
        // Prevent click event propagation for Edit and View PDF buttons
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        const viewPdfButtons = document.querySelectorAll('.view-pdf-btn');
        viewPdfButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    });
</script>

@endsection
<style>
    
    .custom-table {
        border: 1px solid #000 !important; /* Set the border color to black (#000) with !important */
        border-collapse: collapse; /* Collapse borders into a single line */
    }

    .custom-table thead tr th {
        font-size: 1.2rem;
        font-weight: bold;
        background-color: #f7f7f7;
        color: #333;
        text-align: center;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Override Bootstrap's default styles for table border color */
    .table-bordered th,
    .table-bordered td {
        border-color: #000 !important; /* Set the border color to black (#000) with !important */
    }

    /* Style for the modal */
    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        background-color: #007bff;
        color: #fff;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-title {
        font-size: 1.5rem;
    }

    .modal-body p {
        font-size: 1.1rem;
        line-height: 1.5;
    }

    .modal-body p strong {
        color: #007bff;
    }

    .modal-body p.mb-0 {
        margin-bottom: 0;
    }

    .modal-body p.mb-2 {
        margin-bottom: 0.5rem;
    }
    .separator-row td {
        border-bottom: 1px solid #ddd;
    }
    .table-bordered tr:not(:last-child) {
        border-bottom: 1px solid #dee2e6;
    }
    
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
    }
    .custom-table {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .custom-table__column {
        flex: 1;
        padding: 10px;
        border: 1px solid #dee2e6;
    }

    .custom-table__column--uraian {
        flex-basis: 70%;
    }

    .custom-table__column--jumlah {
        flex-basis: 30%;
    }
</style>
</style>