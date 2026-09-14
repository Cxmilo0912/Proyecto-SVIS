/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.servlet;

import co.edu.sena.SVIS.config.AppContext;
import co.edu.sena.SVIS.dto.ApiError;
import co.edu.sena.SVIS.service.RolService;
import java.io.IOException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * GET /api/eventos -> lista de roles para la creacion de un usuario
 */
@WebServlet("/api//*")
public class RolServlet extends BaseApiServlet {

    private final RolService rolService = AppContext.get().getRolService();

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws IOException {
        try {
            writeJson(resp, 200, rolService.MtListar());
        } catch (Exception ex) {
            writeJson(resp, 500, new ApiError("INTERNAL_ERROR", "Error al listar roles: " + ex.getMessage()));
        }
    }

}
