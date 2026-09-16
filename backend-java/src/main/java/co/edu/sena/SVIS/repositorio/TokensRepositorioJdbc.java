/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.dto.PadronTokenView;
import co.edu.sena.SVIS.model.Token;
import co.edu.sena.SVIS.util.ConexionDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.time.LocalDateTime;
import java.util.ArrayList;
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
                    token.setFechaExpiracion(rs.getObject("FechaExpiracion", LocalDateTime.class));

                    return token;
                }
            }

            return null;
        } catch (Exception e) {

            throw new RuntimeException("No se pudo obtener la informacion", e);
        }

    }

    @Override
    public void MtMarcarComoUsado(Connection cn, int idToken) { // Recibe la conexión activa
        String sql = "UPDATE tokens SET Estado = 'Usado', FechaUso = NOW() WHERE Id = ?";

        try (PreparedStatement ps = cn.prepareStatement(sql)) { // Usa la conexión de la transacción
            ps.setInt(1, idToken);
            ps.executeUpdate();
        } catch (Exception e) {
            throw new RuntimeException("No se pudo realizar la actualización del token", e);
        }
    }

    @Override
    public String MtBuscarTokenUsuario(int idEncuesta, int idUsuario) {

        String sql = "Select Token From tokens Where IdEncuesta = ? and IdUsuario = ?";

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

    @Override
    public List<PadronTokenView> MtListarLoteTokens() {

        String sql = "SELECT "
                + "    e.Id AS IdEncuesta, "
                + "    e.Titulo AS TituloEncuesta, "
                + "    COUNT(t.Id) AS TotalAsignados, "
                + "    SUM(CASE WHEN t.FechaUso IS NULL THEN 1 ELSE 0 END) AS Disponibles, "
                + "    SUM(CASE WHEN t.FechaUso IS NOT NULL THEN 1 ELSE 0 END) AS Usados "
                + "FROM encuesta e "
                + "LEFT JOIN tokens t ON e.Id = t.IdEncuesta "
                + "GROUP BY e.Id, e.Titulo;";

        List<PadronTokenView> lista = new ArrayList<>();

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            try (ResultSet rs = ps.executeQuery()) {

                while (rs.next()) {

                    PadronTokenView oPadron = new PadronTokenView();
                    oPadron.idEncuesta = rs.getInt("IdEncuesta");
                    oPadron.Encuesta = rs.getString("TituloEncuesta");
                    oPadron.totalAsignados = rs.getInt("TotalAsignados");
                    oPadron.disponibles = rs.getInt("Disponibles");
                    oPadron.usados = rs.getInt("Usados");
                    lista.add(oPadron);

                }

            }

        } catch (Exception e) {
            
            throw new RuntimeException("No se pudo listar la informacion de los padornes de tokens", e);
        }
        return lista;

    }

}
