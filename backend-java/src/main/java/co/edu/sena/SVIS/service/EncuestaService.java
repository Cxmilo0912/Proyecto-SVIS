/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.dto.EncuestaRequest;
import co.edu.sena.SVIS.model.Encuesta;
import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorio;

/**
 *
 * @author Admin
 */
public class EncuestaService {

    private final EncuestaRepositorio encuestaRepositorio;

    public EncuestaService(EncuestaRepositorio encuestaRepositorio) {
        this.encuestaRepositorio = encuestaRepositorio;
    }

    public void MtCrear(EncuestaRequest req) {

        MtValidar(req.Titulo, req.Descripcion, req.Opciones);

        Encuesta oEncuesta = new Encuesta();
        oEncuesta.setTitulo(req.Titulo);
        oEncuesta.setDescripcion(req.Descripcion);
        oEncuesta.setEstado("ACTIVA");
        Jornada jornada = new Jornada();
        jornada.setId(req.IdJornada);
        oEncuesta.setJornada(jornada);

        encuestaRepositorio.Crear(oEncuesta, req.Opciones);
    }

    private void MtValidar(String Titulo, String Descripcion, String Opciones) {
        if (Titulo == null || Titulo.trim().isEmpty()) {
            throw new IllegalArgumentException("El titulo de la encuesta no puede estar vacío");

        }
        if (Descripcion == null || Descripcion.trim().isEmpty()) {
            throw new IllegalArgumentException("La Descripcion de la encuesta no puede estar vacía");

        }
        if (Opciones == null || Opciones.trim().isEmpty()) {
            throw new IllegalArgumentException("Las opciones de las encuestas no puede estar vacías");

        }
    }
}
