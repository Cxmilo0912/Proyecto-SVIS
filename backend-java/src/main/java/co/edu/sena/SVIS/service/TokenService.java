/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.model.Encuesta;
import co.edu.sena.SVIS.model.Token;
import co.edu.sena.SVIS.model.Usuario;
import co.edu.sena.SVIS.repositorio.TokensRepositorio;
import co.edu.sena.SVIS.util.ConexionDB;
import java.security.SecureRandom;
import java.sql.Connection;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;
import java.util.UUID;

/**
 *
 * @author julil
 */
public class TokenService {

    private final TokensRepositorio tokenRepositorio;

    public TokenService(TokensRepositorio tokenRepositorio) {
        this.tokenRepositorio = tokenRepositorio;
    }

    public void MtCrear(int idEncuesta, List<Integer> idsUsuariosHabilitados) {

        List<Token> tokens = new ArrayList<>();

        LocalDateTime fechaExpiracion = LocalDateTime.now().plusDays(3);

        for (int idUsuario : idsUsuariosHabilitados) {

            Token oToken = new Token();

            Encuesta oEncuesta = new Encuesta();
            oEncuesta.setId(idEncuesta);
            oToken.setEncuesta(oEncuesta);

            Usuario oUsuario = new Usuario();
            oUsuario.setId(idUsuario);
            oToken.setUsuario(oUsuario);

            String codigo = UUID.randomUUID().toString().substring(0, 8).toUpperCase();
            oToken.setToken(codigo);
            oToken.setFechaExpiracion(fechaExpiracion);
            tokens.add(oToken);

        }
        tokenRepositorio.Crear(tokens);
    }

    public void validarYConsumirToken(String codigoToken, int idEncuesta) {
        Connection cn = null;
        try {
            cn = ConexionDB.getConnection();
            cn.setAutoCommit(false);

            Token tokenBusqueda = new Token();
            tokenBusqueda.setToken(codigoToken);
            Encuesta encuesta = new Encuesta();
            encuesta.setId(idEncuesta);
            tokenBusqueda.setEncuesta(encuesta);

            Token oToken = tokenRepositorio.MtBuscarYBloquear(cn, tokenBusqueda);

            if (oToken == null) {
                throw new IllegalArgumentException("El token ingresado no es válido o no pertenece a esta encuesta.");
            }

            if ("Usado".equalsIgnoreCase(oToken.getEstado())) {
                throw new IllegalArgumentException("Este token ya fue utilizado anteriormente.");
            }

            if (oToken.getFechaExpiracion() != null && oToken.getFechaExpiracion().isBefore(LocalDateTime.now())) {
                throw new IllegalArgumentException("El token ha expirado.");
            }

            tokenRepositorio.MtMarcarComoUsado(cn, oToken.getId());

            cn.commit();

        } catch (SQLException | RuntimeException ex) {
            if (cn != null) {
                try {
                    cn.rollback();
                } catch (SQLException rollbackEx) {
                    rollbackEx.printStackTrace();
                }
            }
            throw new RuntimeException(ex.getMessage(), ex);
        } finally {
            if (cn != null) {
                try {
                    cn.setAutoCommit(true);
                    cn.close();
                } catch (SQLException closeEx) {
                    closeEx.printStackTrace();
                }
            }
        }
    }

    public String MtBuscarTokenUsuario(int idEncuesta, int idUsuario) {
        return tokenRepositorio.MtBuscarTokenUsuario(idEncuesta, idUsuario);
    }
}
