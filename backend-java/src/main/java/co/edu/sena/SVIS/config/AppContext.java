package co.edu.sena.SVIS.config;

import co.edu.sena.SVIS.model.OpcionesEncuesta;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorio;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorioJdbc;
import co.edu.sena.SVIS.repositorio.JornadaRepositorio;
import co.edu.sena.SVIS.repositorio.JornadaRepositorioJdbc;
import co.edu.sena.SVIS.repositorio.OpcionesEncuestaRepositorio;
import co.edu.sena.SVIS.repositorio.OpcionesEncuestaRepositorioJdbc;
import co.edu.sena.SVIS.service.EncuestaService;
import co.edu.sena.SVIS.service.JornadaService;

/**
 * @author Admin
 */
public class AppContext {
    
    private static final AppContext INSTANCE = new AppContext();
    
    private final EncuestaService encuestaService;
    private final JornadaService jornadaService;
    
   
    private AppContext() {
        
        EncuestaRepositorio encuestaRepo = new EncuestaRepositorioJdbc();
        OpcionesEncuestaRepositorio opcionesRepo = new OpcionesEncuestaRepositorioJdbc();
        JornadaRepositorio jornadaRepo = new JornadaRepositorioJdbc();
        
        
        this.encuestaService = new EncuestaService(encuestaRepo,opcionesRepo);
        this.jornadaService = new JornadaService(jornadaRepo);
    }
    
    public static AppContext get() {
        return INSTANCE;
    }
    
    public EncuestaService getEncuestaService() {
        return encuestaService;
    }

    public JornadaService getJornadaService() {
        return jornadaService;
    }
    
    
}