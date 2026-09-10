/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.model;

/**
 *
 * @author Admin
 */
public class OpcionesEncuesta {
    
    private int Id;
    private String Opcion;
    private Encuesta Encuesta;
    private int VotosAcumulados;

    public OpcionesEncuesta() {
    }

    public OpcionesEncuesta(String Opcion, Encuesta Encuesta, int VotosAcumulados) {
        this.Opcion = Opcion;
        this.Encuesta = Encuesta;
        this.VotosAcumulados = VotosAcumulados;
    }

    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }

    public String getOpcion() {
        return Opcion;
    }

    public void setOpcion(String Opcion) {
        this.Opcion = Opcion;
    }

    public Encuesta getEncuesta() {
        return Encuesta;
    }

    public void setEncuesta(Encuesta Encuesta) {
        this.Encuesta = Encuesta;
    }

    public int getVotosAcumulados() {
        return VotosAcumulados;
    }

    public void setVotosAcumulados(int VotosAcumulados) {
        this.VotosAcumulados = VotosAcumulados;
    }
    
    
    
}
