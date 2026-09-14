/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.servlet;

import co.edu.sena.SVIS.config.AppContext;
import co.edu.sena.SVIS.dto.ApiError;
import co.edu.sena.SVIS.dto.UsuarioEditRequest;
import co.edu.sena.SVIS.dto.UsuarioRequest;
import co.edu.sena.SVIS.service.UsuarioService;
import co.edu.sena.SVIS.util.JsonUtil;
import java.io.IOException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * GET /api/usuarios -> lista de usuarios} POST /api/usuarios/{id} -> edita un
 * usuario POST /api/usuarios -> crea un usuario
 */
@WebServlet("/api/usuarios/*")
public class UsuarioServlet extends BaseApiServlet {

    private final UsuarioService usuarioService = AppContext.get().getUsuarioService();

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws IOException {

        try {

            String path = req.getPathInfo();

            if (path == null || path.equals("/")) {
                writeJson(resp, 200, usuarioService.listar());
            }

        } catch (NumberFormatException ex) {
            writeJson(resp, 500, new ApiError("ERROR", ex.getMessage()));
        }

    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws IOException {

        try {
            String path = req.getPathInfo();
            String jsonBody = readBody(req);

            if (path == null || path.equals("/")) {

                UsuarioRequest requestDto = JsonUtil.fromJson(jsonBody, UsuarioRequest.class);
                usuarioService.MtCrear(requestDto);
                writeJson(resp, 201, new MensajeRespuesta("Usuario creado exitosamente"));
            } else {
                UsuarioEditRequest requestEditDto = JsonUtil.fromJson(jsonBody, UsuarioEditRequest.class);
                int id = Integer.parseInt(path.substring(1));

                requestEditDto.Id = id;
                usuarioService.MtEditar(requestEditDto);
                writeJson(resp, 200, new MensajeRespuesta("Usuario actualizado exitosamente"));
            }

        } catch (NumberFormatException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", "El ID del usuario no es válido"));
        } catch (IllegalArgumentException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", ex.getMessage()));
        } catch (Exception ex) {
            writeJson(resp, 500, new ApiError("INTERNAL_ERROR", "Error en el servidor: " + ex.getMessage()));
        }
    }

}
