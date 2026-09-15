/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.dto.EncuestaRequest;
import co.edu.sena.SVIS.dto.EncuestaView;
import co.edu.sena.SVIS.dto.OpcionesEncuestaView;
import co.edu.sena.SVIS.model.Encuesta;
import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.model.OpcionesEncuesta;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorio;
import co.edu.sena.SVIS.repositorio.OpcionesEncuestaRepositorio;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author Admin
 */
public class EncuestaService {

    private final EncuestaRepositorio encuestaRepositorio;
    private final OpcionesEncuestaRepositorio opcionesEncuestaRepositorio;

    public EncuestaService(EncuestaRepositorio encuestaRepositorio, OpcionesEncuestaRepositorio opcionesEncuestaRepositorio) {
        this.encuestaRepositorio = encuestaRepositorio;
        this.opcionesEncuestaRepositorio = opcionesEncuestaRepositorio;
    }

    public void MtCrear(EncuestaRequest req) {

        MtValidar(req.Titulo, req.Descripcion, req.Opciones);

        Encuesta oEncuesta = new Encuesta();
        oEncuesta.setTitulo(req.Titulo);
        oEncuesta.setDescripcion(req.Descripcion);
        oEncuesta.setEstado(req.Estado);
        Jornada jornada = new Jornada();
        jornada.setId(req.IdJornada);
        oEncuesta.setJornada(jornada);

        encuestaRepositorio.Crear(oEncuesta, req.Opciones);
    }

    public void MtEditar(EncuestaRequest req) {
        MtValidar(req.Titulo, req.Descripcion, req.Opciones);
        Encuesta oEncuesta = new Encuesta();
        oEncuesta.setId(req.Id);
        oEncuesta.setTitulo(req.Titulo);
        oEncuesta.setDescripcion(req.Descripcion);
        oEncuesta.setEstado(req.Estado);
        Jornada jornada = new Jornada();
        jornada.setId(req.IdJornada);
        oEncuesta.setJornada(jornada);
        encuestaRepositorio.Editar(oEncuesta, req.Opciones);
    }

    public List<EncuestaView> MtListarPorJornada(int idJornada) {
        List<Encuesta> lista = encuestaRepositorio.ListarPorJornada(idJornada);
        List<EncuestaView> listaVista = new ArrayList<>();
        for (Encuesta e : lista) {
            EncuestaView vista = new EncuestaView();
            vista.setId(e.getId());
            vista.setTitulo(e.getTitulo());
            vista.setDescripcion(e.getDescripcion());
            vista.setEstado(e.getEstado());
            listaVista.add(vista);
        }
        return listaVista;
    }

    public List<EncuestaView> MtListarTodas() {
        List<Encuesta> lista = encuestaRepositorio.ListarTodas();
        List<EncuestaView> listaVista = new ArrayList<>();
        for (Encuesta e : lista) {
            EncuestaView vista = new EncuestaView();
            vista.setId(e.getId());
            vista.setTitulo(e.getTitulo());
            vista.setDescripcion(e.getDescripcion());
            vista.setEstado(e.getEstado());
            
            List<OpcionesEncuesta> listaModelosOpciones = opcionesEncuestaRepositorio.ListarPorEncuesta(vista.getId());


            List<OpcionesEncuestaView> opcionesTexto = new ArrayList<>();

            for (OpcionesEncuesta opModel : listaModelosOpciones) {
                OpcionesEncuestaView opView = new OpcionesEncuestaView();
                opView.setId(opModel.getId());
                opView.setOpcion(opModel.getOpcion());
                opView.setVotosAcumulados(opModel.getVotosAcumulados());
                opcionesTexto.add(opView);
            }
            vista.setOpciones(opcionesTexto);
            
            listaVista.add(vista);
        }
        return listaVista;
    }

    public List<EncuestaView> MtListarEncuesta(int IdEncuesta) {
        List<Encuesta> lista = encuestaRepositorio.ListarEncuesta(IdEncuesta);
        List<EncuestaView> listaVista = new ArrayList<>();
        for (Encuesta e : lista) {
            EncuestaView vista = new EncuestaView();
            vista.setId(e.getId());
            vista.setTitulo(e.getTitulo());
            vista.setDescripcion(e.getDescripcion());
            vista.setEstado(e.getEstado());

            List<OpcionesEncuesta> listaModelosOpciones = opcionesEncuestaRepositorio.ListarPorEncuesta(vista.getId());


            List<OpcionesEncuestaView> opcionesTexto = new ArrayList<>();

            for (OpcionesEncuesta opModel : listaModelosOpciones) {
                OpcionesEncuestaView opView = new OpcionesEncuestaView();
                opView.setId(opModel.getId());
                opView.setOpcion(opModel.getOpcion());
                opView.setVotosAcumulados(opModel.getVotosAcumulados());
                opcionesTexto.add(opView);
            }
            vista.setOpciones(opcionesTexto);
            listaVista.add(vista);
        }
        return listaVista;
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
