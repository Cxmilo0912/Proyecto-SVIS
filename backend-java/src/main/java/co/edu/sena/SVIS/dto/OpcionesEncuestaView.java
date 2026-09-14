/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.dto;

/**
 *
 * @author Admin
 */
public class OpcionesEncuestaView {
    private int Id;
    private String Opcion;
    private int VotosAcumulados;

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

    public int getVotosAcumulados() {
        return VotosAcumulados;
    }

    public void setVotosAcumulados(int VotosAcumulados) {
        this.VotosAcumulados = VotosAcumulados;
    }
    
    
}
