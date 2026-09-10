/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.model;

/**
 *
 * @author Admin
 */
public class Encuesta {
    private int Id;
    private String Titulo;
    private String Descripcion;
    private String Estado;
    private Jornada Jornada;

    public Encuesta() {
    }

    public Encuesta(String Titulo, String Descripcion, String Estado, Jornada Jornada) {
        this.Titulo = Titulo;
        this.Descripcion = Descripcion;
        this.Estado = Estado;
        this.Jornada = Jornada;
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

    public Jornada getJornada() {
        return Jornada;
    }

    public void setJornada(Jornada Jornada) {
        this.Jornada = Jornada;
    }
    
    
    
    
}
