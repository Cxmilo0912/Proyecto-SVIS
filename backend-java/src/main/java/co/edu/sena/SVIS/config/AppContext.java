package co.edu.sena.SVIS.config;

import co.edu.sena.SVIS.repositorio.EncuestaRepositorio;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorioJdbc;
import co.edu.sena.SVIS.service.EncuestaService;

/**
 * @author Admin
 */
public class AppContext {
    
    private static final AppContext INSTANCE = new AppContext();
    
    private final EncuestaService encuestaService;
    
   
    private AppContext() {
        
        EncuestaRepositorio encuestaRepo = new EncuestaRepositorioJdbc();
        
        
        this.encuestaService = new EncuestaService(encuestaRepo);
    }
    
    public static AppContext get() {
        return INSTANCE;
    }
    
    public EncuestaService getEncuestaService() {
        return encuestaService;
    }
}