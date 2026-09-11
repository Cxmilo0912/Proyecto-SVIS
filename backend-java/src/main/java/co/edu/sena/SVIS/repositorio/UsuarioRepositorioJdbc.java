/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.model.Rol;
import co.edu.sena.SVIS.model.Usuario;
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
public class UsuarioRepositorioJdbc implements UsuarioRepositorio {

    @Override
    public List<Usuario> ListarUsuarios() {

        String sql = "Select u.Id, u.Documento, u.Nombre, u.Apellido, u.Email, u.Celular, r.Nombre as NombreRol, j.Jornada as NombreJornada From usuario u "
                + "Inner Join rol r "
                + "ON "
                + "u.IdRol = r.Id "
                + "Inner Join jornada j "
                + "ON "
                + "u.IdJornada = j.Id ";

        List<Usuario> lista = new ArrayList<>();

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql);) {

            try (ResultSet rs = ps.executeQuery()) {

                while (rs.next()) {
                    Usuario oUsuario = new Usuario();
                    oUsuario.setId(rs.getInt("Id"));
                    oUsuario.setDocumento(rs.getString("Documento"));
                    oUsuario.setNombre(rs.getString("Nombre"));
                    oUsuario.setApellido(rs.getString("Apellido"));
                    oUsuario.setEmail(rs.getString("Email"));
                    oUsuario.setCelular(rs.getString("Celular"));
                    Rol oRol = new Rol();
                    oRol.setNombre(rs.getString("NombreRol"));
                    Jornada oJornada = new Jornada();
                    oJornada.setNombre(rs.getString("NombreJornada"));
                    oUsuario.setRol(oRol);
                    oUsuario.setJornada(oJornada);

                    lista.add(oUsuario);
                }

            }
        } catch (SQLException e) {
            throw new RuntimeException("No se pudieron listar los usuarios ", e);
        }

        return lista;
    }

    @Override
    public void Crear(Usuario usuario) {

        String sql = "Inser into usuario(Documento, Nombre, Apellido, Email, Celular, Contraseña, IdRol, IdJornada) "
                + "Values(?, ?, ?, ?, ?, ?, ?, ?)";

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            ps.setString(1, usuario.getDocumento());
            ps.setString(2, usuario.getNombre());
            ps.setString(3, usuario.getApellido());
            ps.setString(4, usuario.getEmail());
            ps.setString(5, usuario.getCelular());
            ps.setString(6, usuario.getContrasena());
            ps.setInt(7, usuario.getRol().getId());
            ps.setInt(8, usuario.getJornada().getId());
            ps.executeUpdate();
        } catch (Exception e) {
            throw new RuntimeException("No se pudo crear el usuario ", e);
        }

    }

    @Override
    public void Editar(Usuario usuario) {

        String sql = "Update usuario set Documento = ?, Nombre = ?, Apellido = ?, Email = ?, Celular = ?, IdJornada = ? Where Id = ? "
                + "";

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            ps.setString(1, usuario.getDocumento());
            ps.setString(2, usuario.getNombre());
            ps.setString(3, usuario.getApellido());
            ps.setString(4, usuario.getEmail());
            ps.setString(5, usuario.getCelular());
            ps.setInt(6, usuario.getJornada().getId());
            ps.setInt(7, usuario.getId());
            ps.executeUpdate();
        } catch (Exception e) {

            throw new RuntimeException("No se pudo actualizar la informacion del usuario ", e);
        }
    }

    @Override
    public String ValidarCredenciales(String email) {

        String sql = "Select Contraseña From usuario Where Email = ?";

        String contrasenaUsuario = "";

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            ps.setString(1, email);

            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    contrasenaUsuario = rs.getString("Contrasena");
                }
            }

        } catch (Exception e) {
            
            throw new RuntimeException("No se pudo obtener la informacion del usuario para su validacion", e);
        }
        return contrasenaUsuario;


    }

}
