<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

   

    <div class=" table-responsive">
        <table class="min-w-full   border border-gray-300 shadow-md rounded-lg p-2" id="pacientesTable">
            <thead class=" from-blue-500 to-blue-600 text-white ">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">ID</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Expediente</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Nombre</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Segundo Nombre</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Primer Apellido</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Segundo Apellido</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">No. Cédula</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Edad</th>
                    <th class="px-6 py-3 text-left text-base font-medium tracking-wider border-b border-gray-200">Acciones</th>
                  </tr>
            </thead>
            <hr>
            <tbody class=" divide-y divide-gray-200">
              {{-- Los datos se cargan acá dinámicamente por datatable server-side --}}
            </tbody>
      </table>
          
    </div>
    

    
</div>

