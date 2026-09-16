/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Encuesta;
import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.util.ConexionDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author julil
 */
public class EncuestaRepositorioJdbc implements EncuestaRepositorio {

    @Override
    public List<Encuesta> ListarPorJornada(int IdJornada) {
        String sql = "Select e.Id,e.Titulo,e.Descripcion,e.Estado,j.Id as IdJornada, j.Nombre From encuesta e Inner Join jornada j on e.IdJornada = j.Id Where IdJornada = ?";
        List<Encuesta> lista = new ArrayList<>();
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, IdJornada);
            try (ResultSet rs = ps.executeQuery()){
                while (rs.next()) {
                    lista.add(MtMapeoEncuesta(rs));
                }
            }
        } catch (SQLException e) {
            throw new RuntimeException("Error al listar encuestas", e);
        }
        return lista;
    }

    @Override
    public List<Encuesta> ListarEncuesta(int IdEncuesta) {
         String sql = "Select e.Id,e.Titulo,e.Descripcion,e.Estado,j.Id as IdJornada, j.Nombre From encuesta e Inner Join jornada j on e.IdJornada = j.Id Where e.Id = ?";
        List<Encuesta> lista = new ArrayList<>();
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, IdEncuesta);
            try (ResultSet rs = ps.executeQuery()){
                while (rs.next()) {
                    lista.add(MtMapeoEncuesta(rs));
                }
            }
        } catch (SQLException e) {
            throw new RuntimeException("Error al listar encuestas", e);
        }
        return lista;

    }

    @Override
    public List<Encuesta> ListarTodas() {
         String sql = "Select e.Id,e.Titulo,e.Descripcion,e.Estado,j.Id as IdJornada, j.Nombre From encuesta e Inner Join jornada j on e.IdJornada = j.Id ";
        List<Encuesta> lista = new ArrayList<>();
        try (Connection cn = ConexionDB.getConnection(); PreparedStatement ps = cn.prepareStatement(sql)) {
            
            try (ResultSet rs = ps.executeQuery()){
                while (rs.next()) {
                    lista.add(MtMapeoEncuesta(rs));
                }
            }
        } catch (SQLException e) {
            throw new RuntimeException("Error al listar encuestas", e);
        }
        return lista;
    }

    private Encuesta MtMapeoEncuesta(ResultSet rs) throws SQLException {
        Encuesta oEncuesta = new Encuesta();

        oEncuesta.setId(rs.getInt("Id"));
        oEncuesta.setTitulo(rs.getString("Titulo"));
        oEncuesta.setDescripcion(rs.getString("Descripcion"));
         oEncuesta.setEstado(rs.getString("Estado")); 
        if (oEncuesta.getJornada() == null) {
            oEncuesta.setJornada(new Jornada());
        }
        oEncuesta.getJornada().setId(rs.getInt("IdJornada"));
        oEncuesta.getJornada().setNombre(rs.getString("Nombre"));
        return oEncuesta;
    }

    @Override
    public void Crear(Encuesta encuesta, String Opciones) {
        Connection cn = null;
        PreparedStatement psEncuesta = null;
        PreparedStatement psOpcion = null;
        ResultSet rsKeys = null;

        try {
            cn = ConexionDB.getConnection();
            cn.setAutoCommit(false);

            String sqlEncuesta = "INSERT INTO encuesta (Titulo, Descripcion, IdJornada, Estado) VALUES (?, ?, ?, 'ACTIVA')";
            psEncuesta = cn.prepareStatement(sqlEncuesta, Statement.RETURN_GENERATED_KEYS);
            psEncuesta.setString(1, encuesta.getTitulo());
            psEncuesta.setString(2, encuesta.getDescripcion());
            psEncuesta.setInt(3, encuesta.getJornada().getId());

            int filasAfectadas = psEncuesta.executeUpdate();
            if (filasAfectadas == 0) {
                throw new SQLException("Error al crear la encuesta, no se insertó ninguna fila.");
            }

            rsKeys = psEncuesta.getGeneratedKeys();
            int encuestaId = 0;
            if (rsKeys.next()) {
                encuestaId = rsKeys.getInt(1);
            } else {
                throw new SQLException("Error al obtener el ID de la encuesta generada.");
            }

            String[] arrayOpciones = Opciones.split(",");
            String sqlOpcion = "INSERT INTO opcionesencuesta (IdEncuesta, Opcion, VotosAcumulados) VALUES (?, ?, 0)";
            psOpcion = cn.prepareStatement(sqlOpcion);

            for (String opt : arrayOpciones) {
                String opcionLimpiada = opt.trim();
                if (!opcionLimpiada.isEmpty()) {
                    psOpcion.setInt(1, encuestaId);
                    psOpcion.setString(2, opcionLimpiada);
                    psOpcion.addBatch();
                }
            }

            psOpcion.executeBatch();

            cn.commit();

        } catch (Exception e) {

            if (cn != null) {
                try {
                    cn.rollback();
                } catch (SQLException ex) {
                    ex.printStackTrace();
                }
            }
            e.printStackTrace();
        } finally {

            try {
                if (rsKeys != null) {
                    rsKeys.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            try {
                if (psEncuesta != null) {
                    psEncuesta.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            try {
                if (psOpcion != null) {
                    psOpcion.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            try {
                if (cn != null) {
                    cn.setAutoCommit(true);
                    cn.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    @Override
    public void Editar(Encuesta encuesta, String OpcionesActualizadas) {
        Connection cn = null;
        PreparedStatement psEncuesta = null;
        PreparedStatement psDeleteOpciones = null;
        PreparedStatement psOpcion = null;

        try {

            cn = ConexionDB.getConnection();
            cn.setAutoCommit(false);

            String sqlEncuesta = "UPDATE  encuesta SET Titulo = ?,Descripcion = ?,IdJornada = ? WHERE id = ?";
            psEncuesta = cn.prepareStatement(sqlEncuesta);
            psEncuesta.setString(1, encuesta.getTitulo());
            psEncuesta.setString(2, encuesta.getDescripcion());
            psEncuesta.setInt(3, encuesta.getJornada().getId());
            psEncuesta.setInt(4, encuesta.getId());

            int filasAfectadas = psEncuesta.executeUpdate();
            if (filasAfectadas == 0) {
                throw new SQLException("Error al actualizar, la encuesta con ID " + encuesta.getId() + " no existe.");
            }

            String sqlDelete = "DELETE FROM opcionesencuesta WHERE IdEncuesta = ?";
            psDeleteOpciones = cn.prepareStatement(sqlDelete);
            psDeleteOpciones.setInt(1, encuesta.getId());
            psDeleteOpciones.executeUpdate();

            String[] arrayOpciones = OpcionesActualizadas.split(",");
            String sqlOpcion = "INSERT INTO opcionesencuesta (IdEncuesta,Opcion,VotosAcumulados) VALUES (?, ?, 0)";
            psOpcion = cn.prepareStatement(sqlOpcion);

            for (String opt : arrayOpciones) {
                String opcionLimpiada = opt.trim();
                if (!opcionLimpiada.isEmpty()) {
                    psOpcion.setInt(1, encuesta.getId());
                    psOpcion.setString(2, opcionLimpiada);
                    psOpcion.addBatch();
                }
            }

            psOpcion.executeBatch();

            cn.commit();

        } catch (Exception e) {

            if (cn != null) {
                try {
                    cn.rollback();
                } catch (SQLException ex) {
                    ex.printStackTrace();
                }
            }
            e.printStackTrace();
        } finally {

            try {
                if (psEncuesta != null) {
                    psEncuesta.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            try {
                if (psDeleteOpciones != null) {
                    psDeleteOpciones.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            try {
                if (psOpcion != null) {
                    psOpcion.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
            try {
                if (cn != null) {
                    cn.setAutoCommit(true);
                    cn.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

}
