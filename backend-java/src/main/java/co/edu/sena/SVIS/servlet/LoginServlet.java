/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.servlet;

import co.edu.sena.SVIS.config.AppContext;
import co.edu.sena.SVIS.dto.ApiError;
import co.edu.sena.SVIS.dto.LoginRequest;
import co.edu.sena.SVIS.model.Usuario;
import co.edu.sena.SVIS.service.UsuarioService;
import co.edu.sena.SVIS.util.JsonUtil;
import java.io.IOException;
import java.util.stream.Collectors;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author julil
 */
@WebServlet("/api/login")
public class LoginServlet extends BaseApiServlet {

    private final UsuarioService usuarioService = AppContext.get().getUsuarioService();

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws IOException {

        try {

            String jsonBody = req.getReader().lines().collect(Collectors.joining(System.lineSeparator()));
            LoginRequest dto = JsonUtil.fromJson(jsonBody, LoginRequest.class);

            Usuario oUser = usuarioService.validarCredenciales(dto.Email, dto.Contrasena);

            if (oUser != null) {
                writeJson(resp, 200, oUser);
            } else {
                writeJson(resp, 401, new ApiError("UNAUTHORIZED", "Correo o contraseña incorrectos"));
            }
        } catch (NumberFormatException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", "Las credenciales no son validas"));
        } catch (IllegalArgumentException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", ex.getMessage()));
        } catch (Exception ex) {
            writeJson(resp, 500, new ApiError("INTERNAL_ERROR", "Error en el servidor: " + ex.getMessage()));
        }

    }

}
