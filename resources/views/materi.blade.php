@extends('dashboard')
@section('table')
<div class="row mt-4">
  <div class="col-md-6 col-sm-6 text-left">

    <h2>Materi </h2>

  </div>
  <div class="col-md-6 col-sm-6 text-right">
    <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Tambah Materi
    </button>
  </div>
</div>
<!-- @if(session('status') != Null)
<div class="alert alert-success col-6" role="alert">
  {{session('status')}}
</div>
@endif -->
<table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Judul Materi</th>
      <th scope="col">Kategori</th>
      <th scope="col">Mentor</th>
      <th scope="col">Youtube</th>
      <th scope="col">Slug</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    ?>
@foreach($materis as $materi)
    <tr>
      <td scope="col">{{$i}}</td>
      <td scope="col">{{$materi->judul}}</th>
      <td scope="col">{{$materi->kategori}}</th>
      <td scope="col">{{$materi->mentor}}</th>
      <td scope="col"><iframe width="320" height="160" src="https://www.youtube.com/embed/{{$materi->youtube}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;controls=0; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></th>
      <td scope="col">{{$materi->slug}}</td>
      <td scope="col">
        <form method="POST" action="{{route('materi.destroy',$materi->slug)}}">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
        </form>
        <a href="/materi/edit/{{$materi->slug}}" class="btn btn-sm btn-outline-primary">Edit</a>
      </td>
    </tr>
    <?php
    $i++
    ?>
@endforeach
  </tbody>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mt-4 mb-3">
        </div>
        <form class="form-horizontal form-material" method="POST" action="{{route('materi.post')}}"  enctype="multipart/form-data">
          @csrf
          <div class="container mt-4">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Kategori</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="kategori" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Judul</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="judul" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Mentor</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="mentor" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Link youtube</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="youtube" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Ringkasan matei</label>
              <input type="file" class="form-control" id="exampleFormControlInput1" name="ringkasan" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

@endsection