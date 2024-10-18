<div>
 
    <div class="row mb-2">
        <div class="col-lg-6">
            <input type="text" wire:model="searchDoctor" placeholder="Buscar por nombre o apellido del doctor" class="form-control" />
        </div>
        <div class="col-lg-6">
            <select wire:model="searchDia" class="form-control ">
                <option value="">Selecciona un día</option>
                @foreach($dias as $dia)
                    <option value="{{ $dia }}">{{ ucfirst($dia) }}</option>
                @endforeach
            </select>
        </div>
    </div>



@if($horarios->isNotEmpty())
<div class="table-responsive">
    <table id="horariosTable" class="table-bordered w-100 min-w-full border border-gray-300 shadow-md rounded-lg p-2">
        <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
            <tr>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Doctor</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Especialidad</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Consultorio</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Hora Inicio</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Hora Fin</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Duración de Cita</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Día de la Semana</th>
                <th class="p-2 px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
                <tr>   

                    <td class="p-2 px-6 py-4 border-b border-gray-200">{{ $horario->id }}</td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="font-bold text-gray-700">{{ $horario->doctor->primer_nombre }} {{ $horario->doctor->primer_apellido }}</span>
                    </td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="badge badge-pill badge-info text-white">
                            {{ $horario->doctor->especialidad->nombre ?? 'Sin Especialidad' }}
                        </span>
                    </td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="badge badge-pill badge-primary text-white">
                            {{ $horario->consultorio->nombre ?? 'Sin Consultorio' }}
                        </span>
                    </td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="text-green-600 font-semibold">{{ $horario->hora_inicio }}</span>
                    </td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="text-red-600 font-semibold">{{ $horario->hora_fin }}</span>
                    </td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="badge badge-pill badge-success">
                            {{ $horario->duracion_cita }} minutos
                        </span>
                    </td>
                    <td class="p-2 px-6 py-4 border-b border-gray-200">
                        <span class="badge badge-pill badge-warning text-white">
                            {{ ucfirst($horario->dia_semana) }}
                        </span>
                    </td>

                    <td> 
                    <a href="{{ route('horarios-doctor.show', $horario->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editHorarioForm{{ $horario->id }}">
                            <i class="fas fa-edit"></i> 
                        </button>
                        <form action="{{ route('horarios-doctor.destroy', $horario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este horario?');">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </form>
                        
                    </td>
                </tr>

                <!-- Modal for editing schedule -->
                <div class="modal fade" id="editHorarioForm{{ $horario->id }}" tabindex="-1" role="dialog" aria-labelledby="editHorarioFormModalLabel{{ $horario->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="editHorarioFormModalLabel{{ $horario->id }}">Editar Horario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('horarios-doctor.update', $horario->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method to update -->
                                    <div class="row">
                                        <!-- Día de la Semana -->
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="dia_semana">Día de la Semana</label>
                                                <select name="dia_semana" id="dia_semana" class="form-control" required>
                                                    <option value="">Selecciona un día</option>
                                                    @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                                                        <option value="{{ $dia }}" {{ old('dia_semana', $horario->dia_semana) == $dia ? 'selected' : '' }}>
                                                            {{ ucfirst($dia) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('dia_semana'))
                                                    <div class="text-danger">{{ $errors->first('dia_semana') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Hora Inicio -->
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="hora_inicio">Hora Inicio</label>
                                                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>
                                                @if ($errors->has('hora_inicio'))
                                                    <div class="text-danger">{{ $errors->first('hora_inicio') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Hora Fin -->
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="hora_fin">Hora Fin</label>
                                                <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ old('hora_fin', $horario->hora_fin) }}" required>
                                                @if ($errors->has('hora_fin'))
                                                    <div class="text-danger">{{ $errors->first('hora_fin') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Duración de la Cita -->
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="duracion_cita">Duración de la Cita (min)</label>
                                                <input type="number" name="duracion_cita" id="duracion_cita" class="form-control" value="{{ old('duracion_cita', $horario->duracion_cita) }}" required>
                                                @if ($errors->has('duracion_cita'))
                                                    <div class="text-danger">{{ $errors->first('duracion_cita') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Doctor -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="doctor_id">Doctor</label>
                                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                                    <option value="">Selecciona un Doctor</option>
                                                    @foreach($doctores as $doctor)
                                                        <option value="{{ $doctor->id }}" {{ old('doctor_id', $horario->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                                            {{ $doctor->primer_nombre }} {{ $doctor->primer_apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('doctor_id'))
                                                    <div class="text-danger">{{ $errors->first('doctor_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Consultorio -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="consultorio_id">Consultorio</label>
                                                <select name="consultorio_id" id="consultorio_id" class="form-control" required>
                                                    <option value="">Selecciona un Consultorio</option>
                                                    @foreach($consultorios as $consultorio)
                                                        <option value="{{ $consultorio->id }}" {{ old('consultorio_id', $horario->consultorio_id) == $consultorio->id ? 'selected' : '' }}>
                                                            {{ $consultorio->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('consultorio_id'))
                                                    <div class="text-danger">{{ $errors->first('consultorio_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar Horario</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $horarios->links() }} <!-- Aquí se añade el enlace de paginación -->
    </div>
</div>
@else
    <div class="alert alert-warning" role="alert">
        No hay horarios disponibles.
    </div>
@endif
</div>

