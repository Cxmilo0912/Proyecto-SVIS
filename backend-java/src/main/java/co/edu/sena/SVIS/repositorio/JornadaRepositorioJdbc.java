/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Jornada;
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
public class JornadaRepositorioJdbc implements JornadaRepositorio {

    @Override
    public List<Jornada> ListarJornada() {
        String sql = "Select * From jornada ";
        List<Jornada> lista = new ArrayList<>();
        try (Connection c = ConexionDB.getConnection(); PreparedStatement ps = c.prepareStatement(sql); ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                Jornada oJornada = new Jornada();
                oJornada.setId(rs.getInt("Id"));
                oJornada.setNombre(rs.getString("Nombre"));
                lista.add(oJornada);
            }
        } catch (SQLException e) {
            throw new RuntimeException("Error al consultar las jornadas", e);
        }
        return lista;
    }

}
