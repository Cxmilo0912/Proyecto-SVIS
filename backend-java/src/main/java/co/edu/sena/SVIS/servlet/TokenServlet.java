/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.servlet;

import co.edu.sena.SVIS.config.AppContext;
import co.edu.sena.SVIS.dto.ApiError;
import co.edu.sena.SVIS.dto.ConsumirTokenRequest;
import co.edu.sena.SVIS.dto.PadronToken;
import co.edu.sena.SVIS.service.TokenService;
import co.edu.sena.SVIS.util.JsonUtil;
import java.io.IOException;
import java.util.stream.Collectors;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * GET /api/tokens -> busca el token del usuario segun la encuesta que haya
 * elegido. POST /api/tokens/idEncuesta y usuariosHabilitados -> crea y genera
 * el padron de tokens de una encuesta. POST /api/usuarios/token y encuesta ->
 * consume el token
 */
@WebServlet("/api/tokens/*")
public class TokenServlet extends BaseApiServlet {

    private final TokenService tokenService = AppContext.get().getTokenService();

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws IOException {
        try {
            String path = req.getPathInfo();

            String idEncuestaStr = req.getParameter("idEncuesta");
            String idUsuarioStr = req.getParameter("idUsuario");

            if (idEncuestaStr == null || idUsuarioStr == null || idEncuestaStr.isEmpty() || idUsuarioStr.isEmpty()) {
                writeJson(resp, 400, new ApiError("BAD_REQUEST", "Faltan los parámetros idEncuesta e idUsuario"));
                return;
            }

            int idEncuesta = Integer.parseInt(idEncuestaStr);
            int idUsuario = Integer.parseInt(idUsuarioStr);

            String token = tokenService.MtBuscarTokenUsuario(idEncuesta, idUsuario);

            if (token != null) {
                writeJson(resp, 200, token);
            } else {
                writeJson(resp, 404, new ApiError("NOT_FOUND", "No se encontró un token asignado para este usuario en la encuesta."));
            }
        } catch (NumberFormatException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", "Los identificadores numéricos no son válidos"));
        } catch (IllegalArgumentException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", ex.getMessage()));
        } catch (Exception ex) {
            writeJson(resp, 500, new ApiError("INTERNAL_ERROR", "Error en el servidor: " + ex.getMessage()));
        }
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws IOException {

        try {
            String path = req.getPathInfo();

            if (path != null && !path.equals("/")) {
                String[] partes = path.split("/");
                if (partes.length >= 3) {
                    int idEncuesta = Integer.parseInt(partes[1]);
                    String token = partes[2];

                    String jsonBody = readBody(req);
                    ConsumirTokenRequest reqDto = JsonUtil.fromJson(jsonBody, ConsumirTokenRequest.class);

                    if (reqDto == null || reqDto.idOpcion <= 0) {
                        writeJson(resp, 400, new ApiError("BAD_REQUEST", "Falta la opción seleccionada"));
                        return;
                    }
                    tokenService.validarYConsumirToken(token, idEncuesta,reqDto.idOpcion);
                    writeJson(resp, 200, new MensajeRespuesta("El token se ha consumido correctamente"));
                }
            } else {
                String jsonBody = req.getReader().lines().collect(Collectors.joining(System.lineSeparator()));

                PadronToken padronTokenDto = JsonUtil.fromJson(jsonBody, PadronToken.class);

                if (padronTokenDto == null || padronTokenDto.idEncuesta <= 0 || padronTokenDto.idJornada <= 0) {
                    writeJson(resp, 400, new ApiError("BAD_REQUEST", "Faltan datos obligatorios de la encuesta o la jornada"));
                    return;
                }

                tokenService.MtCrear(padronTokenDto.idEncuesta, padronTokenDto.idJornada, padronTokenDto.numeroDias);
                writeJson(resp, 200, new MensajeRespuesta("El padron de tokens se ha generado correctamente"));

            }
        } catch (NumberFormatException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", "El ID de la encuesta no es válido"));
        } catch (IllegalArgumentException ex) {
            writeJson(resp, 400, new ApiError("BAD_REQUEST", ex.getMessage()));
        } catch (Exception ex) {
            writeJson(resp, 500, new ApiError("INTERNAL_ERROR", "Error en el servidor: " + ex.getMessage()));
        }

    }
}
