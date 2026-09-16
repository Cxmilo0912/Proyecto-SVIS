/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.dto.UsuarioEditRequest;
import co.edu.sena.SVIS.dto.UsuarioRequest;
import co.edu.sena.SVIS.dto.UsuarioView;
import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.model.Rol;
import co.edu.sena.SVIS.model.Usuario;
import co.edu.sena.SVIS.repositorio.UsuarioRepositorio;
import co.edu.sena.SVIS.util.Validador;
import java.util.List;
import java.util.stream.Collectors;
import org.mindrot.jbcrypt.BCrypt;

/**
 *
 * @author julil
 */
public class UsuarioService {

    private final UsuarioRepositorio usuarioRepositorio;

    public UsuarioService(UsuarioRepositorio usuarioRepositorio) {
        this.usuarioRepositorio = usuarioRepositorio;
    }

    public List<UsuarioView> listar() {
        return usuarioRepositorio.ListarUsuarios().stream()
                .map(this::toView)
                .collect(Collectors.toList());
    }

    public void MtCrear(UsuarioRequest req) {

        MtValidarDatos(req);

        String contraseñaHash = BCrypt.hashpw(req.Contrasena, BCrypt.gensalt());

        Usuario oUsuario = new Usuario();
        oUsuario.setDocumento(req.Documento);
        oUsuario.setNombre(req.Nombre);
        oUsuario.setApellido(req.Apellido);
        oUsuario.setCelular(req.Celular);
        oUsuario.setContrasena(contraseñaHash);
        oUsuario.setEmail(req.Email);
        Rol oRol = new Rol();
        oRol.setId(req.idRol);
        oUsuario.setRol(oRol);
        Jornada oJornada = new Jornada();
        oJornada.setId(req.idJornada);
        oUsuario.setJornada(oJornada);

        usuarioRepositorio.Crear(oUsuario);

    }

    public void MtEditar(UsuarioEditRequest req) {

        Usuario oUsuario = new Usuario();
        oUsuario.setId(req.Id);
        oUsuario.setDocumento(req.Documento);
        oUsuario.setNombre(req.Nombre);
        oUsuario.setApellido(req.Apellido);
        oUsuario.setCelular(req.Celular);
        oUsuario.setEmail(req.Email);
        Jornada oJornada = new Jornada();
        oJornada.setId(req.idJornada);
        oUsuario.setJornada(oJornada);

        usuarioRepositorio.Editar(oUsuario);

    }

    public Usuario validarCredenciales(String email, String contrasenaIngresada) {

        Usuario oUser = usuarioRepositorio.ValidarCredenciales(email);

        if (oUser == null) {
            return null;
        }
        boolean contrasenaValidada = BCrypt.checkpw(contrasenaIngresada, oUser.getContrasena());

        if (contrasenaValidada) {
            return oUser;
        } else {
            return null;
        }

    }

    private void MtValidarDatos(UsuarioRequest req) {
        if (req == null) {
            throw new IllegalArgumentException("Los datos del socio son obligatorios.");
        }

        if (Validador.esVacio(req.Documento)) {
            throw new IllegalArgumentException("El documento es obligatorio");
        }

        if (Validador.esVacio(req.Nombre)) {
            throw new IllegalArgumentException("El nombre es obligatorio");
        }
        if (!Validador.esNumero(req.Documento)) {
            throw new IllegalArgumentException("El documento debe estar constituido unicamente por números");
        }

        if (!Validador.esNumero(req.Celular)) {
            throw new IllegalArgumentException("El telefono debe estar constituido unicamente por números");
        }

        if (!Validador.esEmailValido(req.Email)) {
            throw new IllegalArgumentException("El formato del correo electrónico no es válido");
        }

    }

    private UsuarioView toView(Usuario u) {

        UsuarioView v = new UsuarioView();
        v.Id = u.getId();
        v.Documento = u.getDocumento();
        v.Nombre = u.getNombre();
        v.Apellido = u.getApellido();
        v.Email = u.getEmail();
        v.Celular = u.getCelular();
        v.Rol = u.getRol().getNombre();
        v.Jornada = u.getJornada().getNombre();
        v.IdJornada = u.getJornada().getId();

        return v;
    }
}
