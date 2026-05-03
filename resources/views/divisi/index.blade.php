@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4">Daftar Divisi</h2>
    <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef5fc;
      /*padding: 50px;*/
    }

    .import-btn {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    /* Modal styling */
    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      z-index: 1000;
    }

    .modal input[type="file"] {
      display: block;
      margin-top: 10px;
    }

    .modal .close-btn {
      background: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      margin-top: 15px;
      border-radius: 5px;
      cursor: pointer;
    }

    .modal-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }
  </style>
</head>
<body>

  <form action="/divisi/import" method="POST" enctype="multipart/form-data"> 
    {{ csrf_field() }}
    <input type="file" name="file" id="fileInput" style="visibility:hidden; position:absolute; left:-9999px;" required>
    <button type="button" id="importBtn" class="btn btn-success mb-3">Import</button>
    <button type="submit" id="submitBtn" style="display:none;"></button>
</form>

<script>
    document.getElementById('importBtn').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('submitBtn').click();
        }
    });
</script>

    <a href="{{ route('divisi.create') }}" class="btn btn-primary mb-3">Tambah Divisi</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <table class="table table-bordered">
    <thead>
        <tr>
            <th style="background-color: rgb(205, 212, 219);">No</th>
            <th style="background-color: rgb(205, 212, 219);">Kode Divisi</th>
            <th style="background-color: rgb(205, 212, 219);">Nama Divisi</th>
            <th style="background-color: rgb(205, 212, 219);">Deskripsi</th>
            <th style="background-color: rgb(205, 212, 219);">Created At</th>
            <th style="background-color: rgb(205, 212, 219);">Updated At</th>
            <th style="background-color: rgb(205, 212, 219);">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($divisi as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->kode_divisi }}</td>
                <td>{{ $item->nama_divisi }}</td>
                <td>{{ $item->deskripsi ?? '-' }}</td>
                <td>{{ $item->created_at ? $item->created_at->format('Y-m-d H:i:s') : '-' }}</td>
                <td>{{ $item->updated_at ? $item->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                <td>
                    <a href="{{ route('divisi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('divisi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus divisi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection