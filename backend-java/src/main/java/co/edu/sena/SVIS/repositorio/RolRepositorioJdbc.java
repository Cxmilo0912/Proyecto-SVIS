/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Rol;
import co.edu.sena.SVIS.util.ConexionDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author julil
 */
public class RolRepositorioJdbc implements RolRepositorio {

    @Override
    public List<Rol> ListarRol() {

        String sql = "Select Id, Nombre From rol";

        List<Rol> lista = new ArrayList<>();

        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {

            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {

                    Rol oRol = new Rol();
                    oRol.setId(rs.getInt("Id"));
                    oRol.setNombre(rs.getString("Nombre"));

                    lista.add(oRol);

                }
            }

        } catch (Exception e) {

            throw new RuntimeException("No se pudieron listar los roles debido a un error inesperado", e);

        }

        return lista;

    }

}
