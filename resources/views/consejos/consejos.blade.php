@if(!empty($consejos))
    <h3>Consejos de Salud Personalizados:</h3>
    <p>{{ $consejos }}</p>
@else
    <p>No tenemos consejos adicionales en este momento.</p>
@endif
