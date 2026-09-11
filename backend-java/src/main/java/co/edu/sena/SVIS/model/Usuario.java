/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.model;

/**
 *
 * @author Admin
 */
public class Usuario {
    private int Id;
    private String Documento;
    private String Nombre;
    private String Apellido;
    private String Email;
    private String Celular;
    private String Contrasena;
    private Rol Rol;
    private Jornada Jornada;

    public Usuario() {
    }

    public Usuario(String Documento, String Nombre, String Apellido, String Email, String Celular, String Contraseña, Rol Rol, Jornada Jornada) {
        this.Documento = Documento;
        this.Nombre = Nombre;
        this.Apellido = Apellido;
        this.Email = Email;
        this.Celular = Celular;
        this.Contrasena = Contraseña;
        this.Rol = Rol;
        this.Jornada = Jornada;
    }

    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }

    public String getDocumento() {
        return Documento;
    }

    public void setDocumento(String Documento) {
        this.Documento = Documento;
    }

    public String getNombre() {
        return Nombre;
    }

    public void setNombre(String Nombre) {
        this.Nombre = Nombre;
    }

    public String getApellido() {
        return Apellido;
    }

    public void setApellido(String Apellido) {
        this.Apellido = Apellido;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String Email) {
        this.Email = Email;
    }

    public String getCelular() {
        return Celular;
    }

    public void setCelular(String Celular) {
        this.Celular = Celular;
    }

    public String getContrasena() {
        return Contrasena;
    }

    public void setContrasena(String Contraseña) {
        this.Contrasena = Contraseña;
    }

    public Rol getRol() {
        return Rol;
    }

    public void setRol(Rol Rol) {
        this.Rol = Rol;
    }

    public Jornada getJornada() {
        return Jornada;
    }

    public void setJornada(Jornada Jornada) {
        this.Jornada = Jornada;
    }
    
    
}
