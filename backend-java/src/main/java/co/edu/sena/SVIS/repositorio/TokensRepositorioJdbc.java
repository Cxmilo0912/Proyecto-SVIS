/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Token;
import co.edu.sena.SVIS.util.ConexionDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.time.LocalDateTime;
import java.util.List;

/**
 *
 * @author julil
 */
public class TokensRepositorioJdbc implements TokensRepositorio {

    @Override
    public void Crear(List<Token> tokens) {

        String sql = "Insert Into tokens(IdEncuesta,IdUsuario,Token,FechaExpiracion)"
                + " Values(?, ?, ?, ?)";

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            for (Token t : tokens) {
                ps.setInt(1, t.getEncuesta().getId());
                ps.setInt(2, t.getUsuario().getId());
                ps.setString(3, t.getToken());
                ps.setObject(4, t.getFechaExpiracion());
                ps.addBatch();
            }

            ps.executeBatch();

        } catch (Exception e) {

            throw new RuntimeException("No se pudo crear el token", e);
        }

    }

    @Override
    public Token MtBuscarYBloquear(Connection cn, Token oToken) {

        String sql = "SELECT Id, IdEncuesta, IdUsuario, Token, Estado, FechaExpiracion, FechaUso "
                + "FROM tokens "
                + "WHERE Token = ? AND IdEncuesta = ? "
                + "FOR UPDATE";

        try (PreparedStatement ps = cn.prepareStatement(sql)) {

            ps.setString(1, oToken.getToken());
            ps.setInt(2, oToken.getEncuesta().getId());

            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    Token token = new Token();
                    token.setId(rs.getInt("Id"));
                    token.setToken(rs.getString("Token"));
                    token.setEstado(rs.getString("Estado"));

                    return token;
                }
            }

            return null;
        } catch (Exception e) {

            throw new RuntimeException("No se pudo obtener la informacion", e);
        }

    }

    @Override
    public void MtMarcarComoUsado(int idToken) {

        String sql = "Update tokens set Estado = 'Usado', FechaUso = NOW() Where Id = ? ";

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            ps.setInt(1, idToken);
            ps.executeUpdate();

        } catch (Exception e) {

            throw new RuntimeException("No se pudo realizar la actualización del voto", e);
        }
    }

    @Override
    public boolean MtEmitirVoto() {
        throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
    }

    @Override
    public String MtBuscarTokenUsuario(int idEncuesta, int idUsuario) {

        String sql = "Select Token From tokens Where IdEncuesta = ?, IdUsuario = ?";

        String token = "";
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            ps.setInt(1, idEncuesta);
            ps.setInt(2, idUsuario);

            try (ResultSet rs = ps.executeQuery()) {

                if (rs.next()) {
                    token = rs.getString("Token");
                }
                
            }

        } catch (Exception e) {
            
            throw new RuntimeException("Error al obtener el token para la encuesta", e);
            
        }
        
        return token;

    }

}
