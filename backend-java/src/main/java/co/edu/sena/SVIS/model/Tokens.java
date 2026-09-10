/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.model;

import java.time.LocalDateTime;

/**
 *
 * @author Admin
 */
public class Tokens {
    private int Id;
    private Encuesta Encuesta;
    private Usuario Usuario;
    private String Token;
    private String Estado;
    private LocalDateTime FechaUso;

    public Tokens() {
    }

    public Tokens(Encuesta Encuesta, Usuario Usuario, String Token, String Estado, LocalDateTime FechaUso) {
        this.Encuesta = Encuesta;
        this.Usuario = Usuario;
        this.Token = Token;
        this.Estado = Estado;
        this.FechaUso = FechaUso;
    }

    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }

    public Encuesta getEncuesta() {
        return Encuesta;
    }

    public void setEncuesta(Encuesta Encuesta) {
        this.Encuesta = Encuesta;
    }

    public Usuario getUsuario() {
        return Usuario;
    }

    public void setUsuario(Usuario Usuario) {
        this.Usuario = Usuario;
    }

    public String getToken() {
        return Token;
    }

    public void setToken(String Token) {
        this.Token = Token;
    }

    public String getEstado() {
        return Estado;
    }

    public void setEstado(String Estado) {
        this.Estado = Estado;
    }

    public LocalDateTime getFechaUso() {
        return FechaUso;
    }

    public void setFechaUso(LocalDateTime FechaUso) {
        this.FechaUso = FechaUso;
    }
    
    
    
}
