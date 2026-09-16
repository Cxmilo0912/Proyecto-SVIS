package co.edu.sena.SVIS.config;

import co.edu.sena.SVIS.model.OpcionesEncuesta;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorio;
import co.edu.sena.SVIS.repositorio.EncuestaRepositorioJdbc;
import co.edu.sena.SVIS.repositorio.RolRepositorio;
import co.edu.sena.SVIS.repositorio.RolRepositorioJdbc;
import co.edu.sena.SVIS.repositorio.TokensRepositorio;
import co.edu.sena.SVIS.repositorio.TokensRepositorioJdbc;
import co.edu.sena.SVIS.repositorio.UsuarioRepositorio;
import co.edu.sena.SVIS.repositorio.UsuarioRepositorioJdbc;
import co.edu.sena.SVIS.service.EncuestaService;
import co.edu.sena.SVIS.service.RolService;
import co.edu.sena.SVIS.service.TokenService;
import co.edu.sena.SVIS.service.UsuarioService;
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
    private final UsuarioService usuarioService;
    private final RolService rolService;
    private final TokenService tokenService;
    private final JornadaService jornadaService;

    private AppContext() {

        EncuestaRepositorio encuestaRepo = new EncuestaRepositorioJdbc();
        UsuarioRepositorio usuarioRepositorio = new UsuarioRepositorioJdbc();
        RolRepositorio rolRepositorio = new RolRepositorioJdbc();
        TokensRepositorio tokenRepositorio = new TokensRepositorioJdbc();
        OpcionesEncuestaRepositorio opcionesRepositorio = new OpcionesEncuestaRepositorioJdbc();

        OpcionesEncuestaRepositorio opcionesRepo = new OpcionesEncuestaRepositorioJdbc();
        JornadaRepositorio jornadaRepo = new JornadaRepositorioJdbc();

        this.usuarioService = new UsuarioService(usuarioRepositorio);
        this.rolService = new RolService(rolRepositorio);
        this.tokenService = new TokenService(tokenRepositorio, usuarioRepositorio,opcionesRepositorio);
        this.encuestaService = new EncuestaService(encuestaRepo, opcionesRepo);
        this.jornadaService = new JornadaService(jornadaRepo);
    }

    public static AppContext get() {
        return INSTANCE;
    }

    public EncuestaService getEncuestaService() {
        return encuestaService;
    }

    public UsuarioService getUsuarioService() {
        return usuarioService;
    }

    public RolService getRolService() {
        return rolService;
    }

    public TokenService getTokenService() {
        return tokenService;
    }

    public JornadaService getJornadaService() {
        return jornadaService;
    }

}
