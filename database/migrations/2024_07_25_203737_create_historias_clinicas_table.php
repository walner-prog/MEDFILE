<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id'); // Relación con la tabla pacientes

            $table->time('hora')->nullable();
            $table->string('archivo_examen')->nullable();
            $table->string('sala')->nullable();
          
            $table->string('no_cama')->nullable();
         
            $table->string('lugar_nacimiento')->nullable();
        
            $table->string('procedencia')->nullable();
            $table->string('religion')->nullable();
        
            $table->string('escolaridad')->nullable();             // por ajax 
            $table->string('direccion_habitual')->nullable();       // por ajax 
            $table->string('nombre_padre')->nullable();
            $table->string('fuente_informacion')->nullable();
            $table->string('profesion_oficio')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->string('confiabilidad')->nullable();
            $table->text('motivo_consulta')->nullable();

            $table->text('historia_enfermedad_actual')->nullable();
            $table->text('interrogatorio_aparatos_sistemas')->nullable();
            $table->text('enfermedades_infecto_contagiosas')->nullable();
            $table->text('enfermedades_hereditarias')->nullable();
            $table->boolean('inmunizaciones_completas')->nullable();
            $table->text('detalle_inmunizaciones')->nullable();
            $table->integer('horas_sueno')->nullable();
            $table->integer('horas_laborales')->nullable();
            $table->text('tipo_hora_actividad_fisica')->nullable();

            $table->boolean('tabaco')->nullable();
            $table->string('tipo_tabaco')->nullable();
            $table->integer('edad_inicio_tabaco')->nullable();
            $table->integer('cantidad_frecuencia_tabaco')->nullable();
            $table->integer('edad_abandono_tabaco')->nullable();
            $table->integer('duracion_habito_tabaco')->nullable();

            $table->boolean('alcohol')->nullable();    
            $table->string('tipo_alcohol')->nullable();
            $table->integer('cantidad_frecuencia_alcohol')->nullable();
            $table->integer('edad_inicio_alcohol')->nullable();
            $table->integer('edad_abandono_alcohol')->nullable();
            $table->integer('duracion_habito_alcohol')->nullable();

            $table->boolean('drogas_ilegales')->nullable();
            $table->string('tipo_drogas')->nullable();
            $table->integer('cantidad_frecuencia_drogas')->nullable();
            $table->integer('edad_inicio_drogas')->nullable();
            $table->integer('edad_abandono_drogas')->nullable();
            $table->integer('duracion_habito_drogas')->nullable();

            $table->boolean('farmacos')->nullable();
            $table->integer('edad_abandono_farmacos')->nullable();
            $table->integer('cantidad_frecuencia_farmacos')->nullable();
            $table->integer('duracion_habito_farmacos')->nullable();

            $table->integer('num_medicamentos_actuales')->nullable();
            $table->text('nombre_posologia_farmacos')->nullable();
            $table->text('enfermedades_infecto')->nullable();
            $table->text('otros_habitos')->nullable();
            $table->text('enfermedades_cronicas')->nullable();
            $table->text('cirugias_previas')->nullable();
            $table->text('hospitalizaciones')->nullable();

            $table->string('menarca')->nullable();
            $table->string('gesta')->nullable();
            $table->string('fur')->nullable();
            $table->string('inicio_vida_sexual')->nullable();
            $table->string('para')->nullable();
            $table->string('cesarea')->nullable();
            $table->string('num_companeros_sexuales')->nullable();
            $table->string('aborto')->nullable();
            $table->string('legrado')->nullable();
            $table->string('semanas_amenorrea')->nullable();
            $table->boolean('menopausia')->nullable();
            $table->date('fecha_menopausia')->nullable();
            $table->boolean('planificacion_familiar')->nullable();
            $table->string('metodo_planificacion')->nullable();
            $table->boolean('sustitucion_hormonal')->nullable();
            $table->string('especificar_sustitucion_hormonal')->nullable();
            $table->boolean('pap')->nullable();
            $table->string('resultado_fecha_pap')->nullable();

            $table->boolean('trabajo_actual')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->string('area_labora')->nullable();
            $table->string('oficio_categoria')->nullable();
            $table->integer('anos_oficio_trabajo_actual')->nullable();
            $table->integer('dia_laboral_horas')->nullable();
            $table->string('tipo_horario')->nullable();
            $table->integer('horas_semanales')->nullable();
            $table->text('descripcion_trabajo_actual')->nullable();
            $table->boolean('exposicion_sustancias')->nullable();
            $table->text('descripcion_exposicion')->nullable();
            $table->text('frecuencia_intensidad_tarea')->nullable();
            $table->string('posicion_trabajo')->nullable();

            $table->boolean('trabajos_fuera_empleo')->nullable();
            $table->integer('horas_extras')->nullable();
            
            $table->boolean('antecedentes_laborales')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('puesto_trabajo')->nullable();
            $table->integer('anos_trabajados')->nullable();
            $table->date('fecha_conclusion')->nullable();
        
            $table->string('fc')->nullable();
            $table->string('fr')->nullable();
            $table->string('ta')->nullable();
            $table->string('temperatura')->nullable();
        
            $table->string('peso')->nullable();
            $table->string('talla')->nullable();
            $table->string('area_superficie_corporal')->nullable();
            $table->string('imc')->nullable();
            $table->text('aspecto_general')->nullable();
            $table->text('piel_mucosas')->nullable();

            $table->text('craneo')->nullable();
            $table->text('ojos')->nullable();
            $table->text('orejas')->nullable();
            $table->text('nariz')->nullable();
            $table->text('boca')->nullable();
            $table->text('cuello')->nullable();
            $table->text('caja_toracica')->nullable();
           
            $table->text('mamas')->nullable();
            $table->text('campos_pulmonares')->nullable();
            $table->text('cardiaco')->nullable();
            $table->text('abdomen_pelvis')->nullable();
            $table->text('extremidades_superiores')->nullable();
            $table->text('extremidades_inferiores')->nullable();
            $table->text('genitourinario')->nullable();
            $table->text('examen_ginecologico')->nullable();
            $table->text('examen_neurologico')->nullable();
            $table->text('observaciones_analisis')->nullable();
            $table->text('diagnosticos_problemas')->nullable();
            $table->string('nombre_elabora_historia')->nullable();
            $table->string('firma_codigo_sello')->nullable();
            $table->timestamps();

            // Llave foránea
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historias_clinicas');
    }
}
