@extends('layouts.app')
@section('title')
    404 Error Page
@endsection
@push('page_css')
@endpush
@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oups ! Page non trouvée.</h3>
            <p>
                Nous n'avons pas pu trouver la page que vous cherchiez.
                Pendant ce temps, vous pouvez vous pouvez <a href="javascript:history.back()">retourner à la page précédente</a>.
            </p>
        </div>
    </div>
@endsection
