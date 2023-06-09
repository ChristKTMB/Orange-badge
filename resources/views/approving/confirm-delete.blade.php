@extends('layouts.app')
@section('title')
@endsection
@section('content')
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="float-start">
      </div>
      <div class="text-right mx-4 mb-3">
        <a class="btn btn-outline-secondary" href="{{ route('approving.index') }}"><i class="fas fa-times"></i></a>
     </div>
   </div>
</div>
@if ($message = Session::get('error'))
<div class="alert alert-danger">
   <p>{{ $message }}</p>
</div>
@endif
<div class="card">
   <div class="card-body">
      <h3 class="card-title">Confirmation de suppression</h3>
      <p>Êtes-vous sûr de vouloir supprimer toutes les données d'approbation ? Cette action ne peut pas être annulée.</p>
      <form action="{{ route('approving.delete') }}" method="POST">
         @csrf
         <div class="text-right">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
         </div>
      </form>
   </div>
</div>
@endsection