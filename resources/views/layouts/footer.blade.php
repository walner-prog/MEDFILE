<!-- resources/views/layouts/footer.blade.php -->
<div>
    <!-- Footer -->
    <footer class="text-light pt-5 mt-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Sección de enlaces rápidos -->
                <div class="col-md-4">
                    <h5>Enlaces rápidos</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a class="text-light" href="{{ url('/agendar-cita') }}">Agendar Cita</a>
                        </li>
                        <li>
                            <a class="text-light" href="{{ url('/citas-agendadas') }}">Citas Agendadas</a>
                        </li>
                        <li>
                            <a class="text-light" href="{{ url('/historial-citas') }}">Historial Citas</a>
                        </li>
                        <li>
                            <a class="text-light" href="{{ url('/notificaciones-pendientes') }}">Notificaciones</a>
                        </li>
                    </ul>
                </div>
  
                <!-- Sección de contacto -->
                <div class="col-md-4">
                    <h5>Contáctanos</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> +505 1234-5678</li>
                        <li><i class="fas fa-envelope"></i> soporte@medfile.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> Managua, Nicaragua</li>
                    </ul>
                </div>
  
                <!-- Sección de redes sociales -->
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="text-light">
                                <i class="fab fa-facebook fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-light">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-light">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Pie de página -->
            <div class="text-center mt-4">
                <p>&copy; 2024 MEDFILE. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</div>

<style>
 
</style>
