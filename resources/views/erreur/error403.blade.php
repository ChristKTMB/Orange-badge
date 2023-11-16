@extends('layouts.app')
@section('title')
    403 Error Page
@endsection
@push('page_css')
@endpush
@section('content')
    <div class="error-page">
        <h2 class="headline text-danger"> 403</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Accès refusé !</h3>
            <p>
                Désolé, mais vous n'avez pas l'autorisation d'accéder à cette page.
                Si vous pensez qu'il s'agit d'une erreur, veuillez contacter l'administrateur.
                En attendant, vous pouvez <a href="javascript:history.back()">retourner à la page précédente</a>.
            </p>
        </div>
    </div>
@endsection
