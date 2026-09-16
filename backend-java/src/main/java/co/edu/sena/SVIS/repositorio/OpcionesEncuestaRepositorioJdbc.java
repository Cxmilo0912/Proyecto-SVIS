/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.model.OpcionesEncuesta;
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
public class OpcionesEncuestaRepositorioJdbc implements OpcionesEncuestaRepositorio {

    @Override
    public List<OpcionesEncuesta> ListarPorEncuesta(int IdEncuesta) {
        String sql = "Select * From opcionesencuesta where IdEncuesta = ?";
        List<OpcionesEncuesta> lista = new ArrayList<>();
        try (Connection c = ConexionDB.getConnection(); PreparedStatement ps = c.prepareStatement(sql)) {
            ps.setInt(1, IdEncuesta);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    OpcionesEncuesta oOpciones = new OpcionesEncuesta();
                    oOpciones.setId(rs.getInt("Id"));
                    oOpciones.setOpcion(rs.getString("Opcion"));
                    oOpciones.setVotosAcumulados(rs.getInt("VotosAcumulados"));

                    lista.add(oOpciones);
                }
            }
        } catch (SQLException e) {
            throw new RuntimeException("Error al consultar las opciones", e);
        }
        return lista;
    }

    @Override
    public void ActualizarConteoVotos(Connection cn, int idOpcion) throws SQLException {
        String sql = "update opcionesencuesta set VotosAcumulados = VotosAcumulados + 1 where Id = ?";
        try (PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, idOpcion);
            int filas = ps.executeUpdate();
            if (filas == 0) {
                throw new SQLException("No se encontró la opción de encuesta con ID " + idOpcion);
            }
        }
    }

}
