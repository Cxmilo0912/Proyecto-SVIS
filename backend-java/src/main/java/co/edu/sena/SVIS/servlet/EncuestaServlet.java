package co.edu.sena.SVIS.servlet;

import co.edu.sena.SVIS.config.AppContext;
import co.edu.sena.SVIS.dto.ApiError;
import co.edu.sena.SVIS.dto.EncuestaRequest;
import co.edu.sena.SVIS.service.EncuestaService;
import co.edu.sena.SVIS.util.JsonUtil;

import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

/**
 * /api/encuestas      -> POST para crear
 * /api/encuestas/{id} -> PUT o POST con ID para editar
 */
@WebServlet("/api/encuestas/*")
public class EncuestaServlet extends BaseApiServlet {

    private final EncuestaService encuestaService = AppContext.get().getEncuestaService();

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws IOException {
        try {
            String path = req.getPathInfo(); 
            String jsonBody = readBody(req);
            EncuestaRequest requestDto = JsonUtil.fromJson(jsonBody, EncuestaRequest.class);

            if (path == null || path.equals("/")) {
                encuestaService.MtCrear(requestDto);
                writeJson(resp, 201, new MensajeRespuesta("Encuesta creada exitosamente"));
            } 
            else {
              
                writeJson(resp, 200, new MensajeRespuesta("Encuesta actualizada exitosamente"));
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

class MensajeRespuesta {
    public String mensaje;
    public MensajeRespuesta(String mensaje) {
        this.mensaje = mensaje;
    }
}