/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.dto;

import java.util.List;

/**
 *
 * @author Admin
 */
public class EncuestaView {
    
    private int Id;
    private String Titulo;
    private String Descripcion;
    private String Estado;
    private String Jornada;
    private List<OpcionesEncuestaView> opciones;

    public List<OpcionesEncuestaView> getOpciones() {
        return opciones;
    }

    public void setOpciones(List<OpcionesEncuestaView> opciones) {
        this.opciones = opciones;
    }

    
  

    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }

    public String getTitulo() {
        return Titulo;
    }

    public void setTitulo(String Titulo) {
        this.Titulo = Titulo;
    }

    public String getDescripcion() {
        return Descripcion;
    }

    public void setDescripcion(String Descripcion) {
        this.Descripcion = Descripcion;
    }

    public String getEstado() {
        return Estado;
    }

    public void setEstado(String Estado) {
        this.Estado = Estado;
    }

    public String getJornada() {
        return Jornada;
    }

    public void setJornada(String Jornada) {
        this.Jornada = Jornada;
    }
    
    
}
