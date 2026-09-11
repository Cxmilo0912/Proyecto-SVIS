/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Encuesta;
import co.edu.sena.SVIS.util.ConexionDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author julil
 */
public class EncuestaRepositorioJdbc implements EncuestaRepositorio{
    
    private static final String COLUMNAS="Id,Titulo,Descripcion,Estado,IdJornada";
            

    @Override
    public List<Encuesta> ListarPorJornada(int id) {
      String sql = "Select "+COLUMNAS+"From encuesta Where IdJornada = ?";
      List<Encuesta> lista = new ArrayList<>();
      
      return lista;
              
    }

    @Override
    public Encuesta Crear(Encuesta encuesta) {
        throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
    }

    @Override
    public List<Encuesta> ListarTodas() {
        throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
    }

    @Override
    public Encuesta Editar(Encuesta encuesta) {
        throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
    }
    
    private Encuesta map(ResultSet rs)throws SQLException{
        Encuesta oEncuesta = new Encuesta();
       return  oEncuesta;
               
    }
    
}
