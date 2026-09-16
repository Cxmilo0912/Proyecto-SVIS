/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.util.ConexionDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

/**
 *
 * @author Admin
 */
public class DashboardAdminRepositorioJdbc implements DashboardAdminRepositorio {

    public int MtEncuestasActivas() {
        String sql = "SELECT COUNT(Id) as EncuestasActivas FROM encuesta WHERE Estado = 'ACTIVA'";
        int total = 0;
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    total = rs.getInt("EncuestasActivas");
                }
            }

        } catch (SQLException e) {
            throw new RuntimeException("Error al contar las encuestas activas", e);
        }
        return total;
    }

    public int MtVotantesHabilitados() {
        String sql = "SELECT COUNT(IdUsuario)as VotantesHabilitados FROM tokens";
        int total = 0;
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    total = rs.getInt("VotantesHabilitados");
                }
            }

        } catch (SQLException e) {
            throw new RuntimeException("Error al contar los votantes habilitados", e);
        }
        return total;
    
    }

    public int MtSufragiosEmitidos() {
        String sql = "SELECT COUNT(IdUsuario)as Votos FROM tokens WHERE Estado ='USADO'";
        int total = 0;
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    total = rs.getInt("Votos");
                }
            }

        } catch (SQLException e) {
            throw new RuntimeException("Error al contar los sufragios emitidos", e);
        }
        return total;
    
    }

}
